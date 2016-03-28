<?php
class ControllerDashboardStatsmerteam extends Controller {
	public function index() {
		//Подтянем все достижениея (чиновники)
		$this->load->model('catalog/achievement');
		$this->load->model('catalog/quiz');
		$this->load->model('tool/image');
		$this->document->addScript('assets/js/stupidtable.min.js');
		$data['achievements'] = array();
		$quiz_id = 11;
		//raiting_id = 9 чиновники
		$rating = 9;
		$filter_data = array(
			'filter_rating_id'   => $rating,
		);
		$placemans = $this->model_catalog_achievement->getAchievements($filter_data);

		foreach ($placemans as $placeman) {

			if (isset($placeman['image']) && is_file(DIR_IMAGE . $placeman['image'])) {
				$image = $this->model_tool_image->resize($placeman['image'], 60, 60,'h');
			}else{
				$image = $this->model_tool_image->resize('no_image.png', 60, 60,'w');
			}
			$data['achievements'][$placeman['achievement_id']] = array(
				'achievement_id' 		=> $placeman['achievement_id'],
				'placeman_name'        	=> $placeman['title'],
				'placeman_description'  => $placeman['description'],
				'placeman_image'		=> $image,
				'placeman_0'		=> 0,
				'placeman_1'		=> 0,
				'placeman_2'		=> 0,

			);
		}

		//подтянем результаты тестирования 
		$results_stats = $this->model_catalog_quiz->getStatsForQuiz($quiz_id);
		$data['count_voices'] = count($results_stats);
		foreach ($results_stats as $result) {
			$data_voice = array();
			$data_voice = unserialize($result['value']);
			// 0  - уволить
			// 1 - в команду
			// 2 - не знаю кто это
			foreach ($data_voice as $k => $voice) {
				if($voice == 0 && !empty($data['achievements'][$k])){
					$data['achievements'][$k]  = array(
						'achievement_id' 		=> $data['achievements'][$k]['achievement_id'],
						'placeman_name'        	=> $data['achievements'][$k]['placeman_name'],
						'placeman_description'  => $data['achievements'][$k]['placeman_description'],
						'placeman_image'		=> $data['achievements'][$k]['placeman_image'],
						'placeman_0'		    => $data['achievements'][$k]['placeman_0']+1,
						'placeman_1'		    => $data['achievements'][$k]['placeman_1'],
						'placeman_2'		    => $data['achievements'][$k]['placeman_2'],
					);
				}	
				if($voice == 1 && !empty($data['achievements'][$k])){
					$data['achievements'][$k]  = array(
						'achievement_id' 		=> $data['achievements'][$k]['achievement_id'],
						'placeman_name'        	=> $data['achievements'][$k]['placeman_name'],
						'placeman_description'  => $data['achievements'][$k]['placeman_description'],
						'placeman_image'		=> $data['achievements'][$k]['placeman_image'],
						'placeman_0'		    => $data['achievements'][$k]['placeman_0'],
						'placeman_1'		    => $data['achievements'][$k]['placeman_1']+1,
						'placeman_2'		    => $data['achievements'][$k]['placeman_2'],
					);
				}	
				if($voice == 2 && !empty($data['achievements'][$k])){
					$data['achievements'][$k]  = array(
						'achievement_id' 		=> $data['achievements'][$k]['achievement_id'],
						'placeman_name'        	=> $data['achievements'][$k]['placeman_name'],
						'placeman_description'  => $data['achievements'][$k]['placeman_description'],
						'placeman_image'		=> $data['achievements'][$k]['placeman_image'],
						'placeman_0'		    => $data['achievements'][$k]['placeman_0'],
						'placeman_1'		    => $data['achievements'][$k]['placeman_1'],
						'placeman_2'		    => $data['achievements'][$k]['placeman_2']+1,
					);
				}				
			}
			
		}
		
		usort($data['achievements'], 'sortByPlaceman');

		return $this->load->view('dashboard/stats_mer_team.tpl', $data);
	}

}