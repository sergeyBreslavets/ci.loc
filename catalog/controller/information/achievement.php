<?php
class ControllerInformationAchievement extends Controller {
	private $error = array();
	public function upload(){
		$json = array();
		$this->language->load('information/raiting');
		$this->load->model('catalog/raiting');
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
			$write_question = $this->model_catalog_raiting->addQuestion($this->request->post,$data_customer,$customer_id);
			//$this->session->data['success'] = $this->language->get('text_success');

			if ($write_question ) {
				$json['success'] = 1;
			}else{
				$json['error'] = $this->error;
			}
            
		}else {
			$json['error'] = $this->error;
        }
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	public function index(){
		
		$this->language->load('information/raiting');
		$this->load->model('tool/image');
		$this->load->model('catalog/raiting');
		$data['heading_title'] = $this->language->get('heading_title');
		$detect = new Mobile_Detect();
		// Если не планшет и не мобильное устройство
		

		//seo
		$this->document->setTitle($data['heading_title']);
		$this->document->setDescription($this->language->get('heading_description'));
		$this->document->setKeywords($this->language->get('heading_keywords'));
		//получим список статистики для достижений
		
		


		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/upload_achievement.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/information/upload_achievement.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/information/upload_achievement.tpl', $data));
		}
	}


	protected function validate() {
		if ((utf8_strlen($this->request->post['firstname']) < 3) || (utf8_strlen($this->request->post['firstname']) > 32)) {
			$this->error['firstname'] = $this->language->get('error_name');
		}

		if (!preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->request->post['email'])) {
			$this->error['email'] = $this->language->get('error_email');
		}

		if ((utf8_strlen($this->request->post['message']) < 3) || (utf8_strlen($this->request->post['message']) > 32)) {
			$this->error['message'] = $this->language->get('error_message');
		}

		if ($this->config->get('config_google_captcha_status')) {
			$recaptcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($this->config->get('config_google_captcha_secret')) . '&response=' . $this->request->post['g-recaptcha-response'] . '&remoteip=' . $this->request->server['REMOTE_ADDR']);

			$recaptcha = json_decode($recaptcha, true);

			if (!$recaptcha['success']) {
				$this->error['captcha'] = $this->language->get('error_captcha');
			}
		}

		return !$this->error;
	}
}