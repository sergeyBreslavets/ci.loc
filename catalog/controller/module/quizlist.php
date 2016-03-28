<?php  
class ControllerModuleQuizlist extends Controller {
	public function index() {
		$this->language->load('module/quizlist');
		$this->load->model('catalog/quiz');
		
		
	 
		$data['heading_title'] = $this->language->get('heading_title');
	 	$filter_data = array(
			'filter_visibility'    => 1,
			'limit' => 5,
			'start' => 0
		);
		$quizs = $this->model_catalog_quiz->getQuizs($filter_data);
		$data['quizs'] = array();

		foreach ($quizs as $quiz) {
			
		
			$data['quizs'][] = array(
				'quiz_id' 		=> $quiz['quiz_id'],
				'status' 		  => $quiz['status'],
				'quiz_title'	=> html_entity_decode($quiz['title']),
				'quiz_href'		=> $this->url->link('information/quiz/view', 'quiz_id=' . $quiz['quiz_id']),
				'share_id'    => 'btn_'.$quiz['template_id']
			);
		}
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/quizlist.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/quizlist.tpl', $data);
		} else {
			return $this->load->view('default/template/module/quizlist.tpl', $data);
		}
	}
}