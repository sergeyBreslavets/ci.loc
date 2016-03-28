<?php
class ControllerDashboardStatswhoimoscowman extends Controller {
	public function index() {
		//статситика для теста Какой ты москвич?
		$this->load->model('catalog/quiz');

		$data['voices'] = array();
		$quiz_id = 13;

		
		//подтянем результаты тестирования 
		$results_stats = $this->model_catalog_quiz->getStatsForQuiz($quiz_id);
		$data['count_voices'] = count($results_stats);
		
		//всего 20 вопросов
		$count_all_q = 10;
		$my_choice= array(
			'ch_1' =>0,
			'ch_2' =>0,
			'ch_3' =>0,
			'ch_4' =>0,
			'ch_5' =>0,
			'ch_6' =>0
			);
		foreach ($results_stats as $re) {
			//unseriale 
			$arr_count_yes = 0;
			$arr_count_no  = 0;
			$un = unserialize($re['value']);
			foreach ($un as $u) {
				switch ($u) {
					case '0':
						$arr_count_no++;
						break;
					case '1':
						$arr_count_yes++;
						break;
					default:
						break;
				}
			}
			$arr_count = $count_all_q;
			$result_procent = ($arr_count_yes/$arr_count)*100;
			if($arr_count_yes == 0){
				$my_choice= array(
				'ch_1' =>$my_choice['ch_1'],
				'ch_2' =>$my_choice['ch_2'],
				'ch_3' =>$my_choice['ch_3'],
				'ch_4' =>$my_choice['ch_4'],
				'ch_5' =>$my_choice['ch_5']+1,
				);
			}else if($arr_count_yes == $arr_count){
				$my_choice= array(
				'ch_1' =>$my_choice['ch_1']+1,
				'ch_2' =>$my_choice['ch_2'],
				'ch_3' =>$my_choice['ch_3'],
				'ch_4' =>$my_choice['ch_4'],
				'ch_5' =>$my_choice['ch_5'],
				);	
			}else if($result_procent < 100 && $result_procent > 70){
				$my_choice= array(
				'ch_1' =>$my_choice['ch_1'],
				'ch_2' =>$my_choice['ch_2']+1,
				'ch_3' =>$my_choice['ch_3'],
				'ch_4' =>$my_choice['ch_4'],
				'ch_5' =>$my_choice['ch_5'],
				);
			}else if($result_procent <= 70 && $result_procent > 50){
				$my_choice= array(
				'ch_1' =>$my_choice['ch_1'],
				'ch_2' =>$my_choice['ch_2'],
				'ch_3' =>$my_choice['ch_3']+1,
				'ch_4' =>$my_choice['ch_4'],
				'ch_5' =>$my_choice['ch_5'],
				);
			}else if($result_procent <= 50 && $result_procent > 30){
				$my_choice= array(
				'ch_1' =>$my_choice['ch_1'],
				'ch_2' =>$my_choice['ch_2'],
				'ch_3' =>$my_choice['ch_3'],
				'ch_4' =>$my_choice['ch_4']+1,
				'ch_5' =>$my_choice['ch_5'],
				);
			}else if($result_procent <= 30 && $result_procent > 0){
				$my_choice= array(
				'ch_1' =>$my_choice['ch_1'],
				'ch_2' =>$my_choice['ch_2'],
				'ch_3' =>$my_choice['ch_3'],
				'ch_4' =>$my_choice['ch_4'],
				'ch_5' =>$my_choice['ch_5']+1,
				);
			}


			
		}
		print_r('<pre>');
		print_r($my_choice);
		print_r('</pre>');
		die();
		//print_r('<pre>');
		//print_r($results_stats);
		//print_r('</pre>');
		//die();

		return $this->load->view('dashboard/stats_who_i_moscowman.tpl', $data);
	}

}