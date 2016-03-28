<?php
class ControllerInformationQuiz extends Controller {
	private $error = array();
	public function in(){
		/*$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "quiz_stats WHERE quiz_id = 10 ORDER BY  qstat_id LIMIT 40000");

		$data =  $query->rows;

		$ser_data = array();
		foreach ($data as $value) {
				$ser_data[ $value['qshare_id'] ]['value'][ $value['answer_id'] ] = $value['value'];
				$ser_data[ $value['qshare_id'] ]['qshare_id'] = $value['qshare_id'];
				$ser_data[ $value['qshare_id'] ]['quiz_id'] = $value['quiz_id'].'0';
				$ser_data[ $value['qshare_id'] ]['ip'] = $value['ip'];
				$ser_data[ $value['qshare_id'] ]['date_added'] = $value['date_added'];
				$ser_data[ $value['qshare_id'] ]['customer_id'] = $value['customer_id'];
		}

		foreach ($ser_data as $val) {
			print_r('<pre>');
			print_r("DELETE FROM " . DB_PREFIX . "quiz_stats WHERE qshare_id = '" . $val['qshare_id'] . "' AND quiz_id = 10 ");
			$this->db->query("DELETE FROM " . DB_PREFIX . "quiz_stats WHERE qshare_id = '" . $val['qshare_id'] . "'");
			print_r('</pre>');

			print_r('<pre>');
			print_r("INSERT INTO " . DB_PREFIX . "quiz_stats SET qshare_id = '" .  $this->db->escape($val['qshare_id']) . "', customer_id = '" . (int)$val['customer_id'] . "', quiz_id = '" . (int)$val['quiz_id'] . "', value = '" .  $this->db->escape(serialize($val['value']) )  . "', ip = '" . $this->db->escape($val['ip']) . "',date_added ='" . $this->db->escape($val['date_added']) . "' ");
			$this->db->query("INSERT INTO " . DB_PREFIX . "quiz_stats SET qshare_id = '" .  $this->db->escape($val['qshare_id']) . "', customer_id = '" . (int)$val['customer_id'] . "', quiz_id = '" . (int)$val['quiz_id'] . "', value = '" .  $this->db->escape(serialize($val['value']) )  . "', ip = '" . $this->db->escape($val['ip']) . "',date_added ='" . $this->db->escape($val['date_added']) . "' ");
			print_r('</pre>');
		}
		print_r( count($ser_data) );

		$this->db->query("UPDATE  " . DB_PREFIX . "quiz_stats SET  `quiz_id`=10 WHERE quiz_id = '100'");
		$this->db->query("UPDATE  " . DB_PREFIX . "quiz_stats SET  `quiz_id`=11 WHERE quiz_id = '110'");
		$this->db->query("UPDATE  " . DB_PREFIX . "quiz_stats SET  `quiz_id`=12 WHERE quiz_id = '120'");*/
	}
	public function index() {
	//	$this->response->redirect($this->url->link('common/home', '', 'SSL'));
		$this->language->load('information/quiz');
		$this->load->model('tool/image');
		$this->load->model('catalog/quiz');
		$data['heading_title'] = $this->language->get('heading_title');
		$detect = new Mobile_Detect();
		// Если не планшет и не мобильное устройство


		//seo
		$this->document->setTitle($data['heading_title']);
		$this->document->setDescription($this->language->get('heading_description'));
		$this->document->setKeywords($this->language->get('heading_keywords'));
		//получим список аветивных рейтингов
		$filter_data = array(
			'filter_status'    => 1,
			'filter_visibility'    => 1
		);

		$quizs = $this->model_catalog_quiz->getQuizs($filter_data);
		$data['quizs'] = array();
		foreach ($quizs as $quiz) {
			if (!empty($quiz['image'])) {
				if( !$detect->isMobile() && !$detect->isTablet() ){
					$image = $this->model_tool_image->resize($quiz['image'], 1920,1080,'h');
				}else{
					$image = $this->model_tool_image->resize($quiz['image'], 1024,768,'h');
				}

			}else{
				$image 		= $this->model_tool_image->resize('placeholder.png', 1024,768,'h');
			}
			$random_csore = rand(2000, 2500);
			$data['quizs'][] = array(
				'quiz_id' 			=> $quiz['quiz_id'],
				'quiz_title' 		=> $quiz['title'],
				'quiz_voice' 		=> sprintf($this->language->get('text_quiz_voice'), $random_csore, getNumEnding($random_csore,array('человек', 'человека', 'человек'))),
				'quiz_image' 		=> $image,
				'quiz_href' 	 		=> $this->url->link('information/quiz/view', 'quiz_id=' . $quiz['quiz_id'])
			);
		}



		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/quiz/quizs_list.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/information/quiz/quizs_list.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/information/quiz/quizs_list.tpl', $data));
		}

	}


	public function view(){
		if (isset($this->request->get['quiz_id'])) {
			$quiz_id = (int)$this->request->get['quiz_id'];
		} else {
			$this->response->redirect($this->url->link('common/home', '', 'SSL'));
		}
		$data['poll'] = $this->load->controller('quiz/quiz'.$quiz_id);
	  $data['column_left'] = $this->load->controller('common/column_left');
    $data['column_right'] = $this->load->controller('common/column_right');
    $data['content_top'] = $this->load->controller('common/content_top');
    $data['content_bottom'] = $this->load->controller('common/content_bottom');
    $data['footer'] = $this->load->controller('common/footer');
    $data['header'] = $this->load->controller('common/header');
    //подтянем результаты тестирования



    if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/quiz/main_quiz_template.tpl')) {
      $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/information/quiz/main_quiz_template.tpl', $data));
    } else {
      $this->response->setOutput($this->load->view('default/template/information/quiz/main_quiz_template.tpl', $data));
		}
  }

	public function result(){

		if (isset($this->request->get['qshare_id']) ) {
			$qshare_id = $this->request->get['qshare_id'];
		}else{
			$this->response->redirect($this->url->link('common/home', '', 'SSL'));
		}
		$this->load->model('catalog/quiz');
		$result_quiz =  $this->model_catalog_quiz->getMyStatsForQuiz($qshare_id);
				/* временная заплатка */
				$quiz_id = $result_quiz['quiz_id'];
			$data['result_share'] = $this->load->controller('quiz/quiz'.$quiz_id.'/result');


			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/quiz/share_quiz_template.tpl')) {
			  $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/quiz/share_quiz_template.tpl', $data));
			} else {
			  $this->response->setOutput($this->load->view('default/template/quiz/share_quiz_template.tpl', $data));
			}

	}


	
	public function ajaxsendquiz(){
		//для теста узнай каккой ты москвич
		$json = array();
		$this->language->load('information/occasion');
		$this->load->model('catalog/quiz');
		$this->load->model('account/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			//делаем проверку есть ли такой пользователь
			$data_customer = array();

			if (!$this->customer->isLogged()) {
				$customer_id = 0;
				/*if ($this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
					$customer = $this->model_account_customer->getCustomerByEmail($this->request->post['email']);
					$customer_id = $customer['customer_id'];
				}else{
					$customer_id = $this->model_account_customer->addCustomer($this->request->post);
				}*/
				$data_customer = array();//$this->request->post;
			}else{
				$customer_id = $this->customer->getId();

				$data_customer = $this->model_account_customer->getCustomer($customer_id);
				//$data_customer['occasion_id'] = $this->request->post['occasion_id'];

			}
			//делаем запись голоса
			$array_qshare = $this->model_catalog_quiz->addVoice($this->request->post,$data_customer,$customer_id);
			//$this->session->data['success'] = $this->language->get('text_success');

			if (!empty($array_qshare) ) {
				$json['success'] = 1;
				$json['redirect'] = $this->url->link('information/quiz/result', 'qshare_id='.$array_qshare['qshare_id'], 'SSL');// str_replace('&amp;', '&', $this->url->link('information/quiz/result', '', 'SSL'))  ;
			}else{
				$this->error['warning'] = $this->language->get('error_warning');
				$json['error'] = $this->error;
			}

		}else {
			$json['error'] = $this->error;
        }
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	protected function validate() {
		if(!$this->customer->isLogged()){
			/*if ((utf8_strlen($this->request->post['firstname']) < 3) || (utf8_strlen($this->request->post['firstname']) > 100)) {
				$this->error['firstname'] = $this->language->get('error_customer_name');
			}
			if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 100)) {
				$this->error['telephone'] = $this->language->get('error_customer_phone');
			}
			if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->request->post['email'])) {
				$this->error['email'] = $this->language->get('error_customer_email');
			}*/
		}
		if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}
	}
}
