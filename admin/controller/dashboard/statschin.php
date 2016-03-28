<?php
class ControllerDashboardStatschin extends Controller {
	public function index() {
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



		
		$data['achievements'] = $final_array;

		return $this->load->view('dashboard/stats_mer_chin.tpl', $data);
	}

}