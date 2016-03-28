<?php
class ControllerCommonDashboard extends Controller {
	public function index() {
		//$this->response->redirect($this->url->link('catalog/occasion', 'token=' . $this->session->data['token'], 'SSL'));
		$this->load->language('common/dashboard');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title'] = $this->language->get('heading_title');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		// Check install directory exists
		if (is_dir(dirname(DIR_APPLICATION) . '/install')) {
			$data['error_install'] = $this->language->get('error_install');
		} else {
			$data['error_install'] = '';
		}

		$data['token'] = $this->session->data['token'];

		

		//получим результы мерской команды
		$data['stats_mer_team'] = ""; //$this->load->controller('dashboard/statsmerteam');
		$data['stats_mer_chin'] =""; //$this->load->controller('dashboard/statschin');
		$data['stats_mer_battle'] = '';//$this->load->controller('dashboard/statsbattlemer');
		$data['stats_who_i_moscowman'] = '';//$this->load->controller('dashboard/statswhoimoscowman');
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['customer'] = $this->load->controller('dashboard/customer');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('common/dashboard.tpl', $data));
	}

	public function getInfo(){
		$id = 74;
		$quiz_id = 11;
		$this->load->model('catalog/quiz');
		$results_stats = $this->model_catalog_quiz->getStatsForQuiz($quiz_id);
		$result_id_array = array();
		foreach ($results_stats as $result) {
			$data_voice = array();
			$data_voice = unserialize($result['value']);
			foreach ($data_voice as $k => $voice) {
				if($k == $id){
					$result_id_array[] = array(
						'ip' => $result['ip'],
						'voice' => $voice
					);
				}	
						
			}
		}
		$final_array =array();
		foreach ($result_id_array as $final) {

			if (!empty($final_array[$final['ip']][$final['voice']]) ) {
				$final_array[$final['ip']][$final['voice']]=array(
					'count' => $final_array[$final['ip']][$final['voice']]['count']+1,
					'ip'   =>$final['ip'],
					'voice'=>$final['voice']
				);
			}else{
				$final_array[$final['ip']][$final['voice']]=array(
					'count' => 1,
					'ip'   =>$final['ip'],
					'voice'=>$final['voice']
				);
			}
			
		}



		print_r('<pre>');
		print_r($final_array);
		print_r('</pre>');
	}
}