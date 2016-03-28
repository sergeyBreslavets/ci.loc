<?php
class ControllerDashboardStatsbattlemer extends Controller {
	public function index() {
		//Подтянем все достижениея (чиновники)
		$this->load->model('catalog/quiz');

		$data['voices'] = array();
		$quiz_id = 12;

		/// /battle/luzhkov.png
		// /battle/sobyanin.png
		$data['image_l'] = $this->model_tool_image->resize('/battle/luzhkov.png', 150, 150,'h');
		$data['image_s'] = $this->model_tool_image->resize('/battle/sobyanin.png', 150, 150,'h');
		//подтянем результаты тестирования 
		$results_stats = $this->model_catalog_quiz->getStatsForQuiz($quiz_id);
		$data['count_voices'] = count($results_stats);
		$data['results_battle'] = array(
			'win_mer_1' => 0,
			'win_mer_2' => 0, 
			'friend'    => 0
		);
		//всего 14 вопросов
		$count_all_q = 14;

		foreach ($results_stats as $result) {
			$data_voice = array();
			$data_voice = unserialize($result['value']);
			// 0  - уволить
			// 1 - в команду
			// 2 - не знаю кто это
			
			$count_win_mer_1 = 0;
			foreach ($data_voice as $k => $voice) {
				if($voice == 1 ){
					$count_win_mer_1++;
				}			
			}
			if($count_win_mer_1 > 7){
				$data['results_battle'] = array(
					'win_mer_1' => $data['results_battle']['win_mer_1']+1,
					'win_mer_2' => $data['results_battle']['win_mer_2'], 
					'friend'    => $data['results_battle']['friend']
				);
			}
			if($count_win_mer_1 < 7){
				$data['results_battle'] = array(
					'win_mer_1' => $data['results_battle']['win_mer_1'],
					'win_mer_2' => $data['results_battle']['win_mer_2']+1, 
					'friend'    => $data['results_battle']['friend']
				);
			}
			if($count_win_mer_1 == 7){
				$data['results_battle'] = array(
					'win_mer_1' => $data['results_battle']['win_mer_1'],
					'win_mer_2' => $data['results_battle']['win_mer_2'], 
					'friend'    => $data['results_battle']['friend']+1
				);
			}
			
			
		}
		$_win_percent = ($data['results_battle']['win_mer_1']*100)/$data['count_voices'];
		$_fail_percent = ($data['results_battle']['win_mer_2']*100)/$data['count_voices'];
		$_friend_percent = ($data['results_battle']['friend']*100)/$data['count_voices'];

		$data['results_battle'] = array(
			'win_mer_1' => $data['results_battle']['win_mer_1'],
			'win_mer_2' => $data['results_battle']['win_mer_2'], 
			'friend'    => $data['results_battle']['friend'],
			'_win_percent' => $_win_percent,
			'_fail_percent' => $_fail_percent, 
			'_friend_percent'    => $_friend_percent

		);

		return $this->load->view('dashboard/stats_mer_battle.tpl', $data);
	}

}