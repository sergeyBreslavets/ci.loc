<?php
class ControllerDashboardStatswhoimoscowman extends Controller {
	public function index() {
		//статситика для теста Какой ты москвич?
		$this->load->model('catalog/quiz');
		$this->load->model('catalog/qitem');


		$data['voices'] = array();
		$quiz_id = 14;

		//стянем инфу о шаринге и процентах
    	$share_info           =   $this->model_catalog_quiz->getQuizShare($quiz_id);

		//подтянем результаты тестирования 
		$results_stats = $this->model_catalog_quiz->getStatsForQuiz($quiz_id);
		$data['count_voices'] = count($results_stats);
		
		///
		//делаем запрос 
		$qitem_real = $this->model_catalog_qitem->getQs($quiz_id);
	    $str_qitems = "'";
	    foreach ($qitem_real as $qitem) {
	      $str_qitems = $str_qitems.$qitem['qitem_id']."','";
	    }
	    $qitems = substr($str_qitems, 0, -2);
	    $result_data_answer = $this->model_catalog_quiz->getQuizAnswer($qitems);

	    $standard_data_answer = array();
	    foreach ($result_data_answer as $qitem_r) {
	      if($qitem_r['correct'] == 1){
	         $standard_data_answer[$qitem_r['qitem_id']] =  $qitem_r['question_id'];
	      }
	    }


		//всего 20 вопросов
		$count_all_q = 10;
		$my_choice= array();
		foreach ($results_stats as $re) {
			//unseriale 
			$arr_count_yes = 0;
			$arr_count_no  = 0;
			$un = unserialize($re['value']);
			
		    $arr_count_yes = 0;
		    $count_arr = count($un);
		    //добавить сравнение
		    foreach ($un as $k => $result) {
		      if($standard_data_answer[$k] == $result){
		         $arr_count_yes++;
		      }
		    }
		    //получим процент
		    $percent = ($arr_count_yes*100)/$count_arr;
		    
		    foreach ( $share_info as $value) {
		      if($percent >= $value['percent_start']  && $percent <= $value['percent_end']){

		      	if(!empty($my_choice[$value['percent_start'].'_'.$value['percent_end']])){
		      		$my_choice[$value['percent_start'].'_'.$value['percent_end']]= array(
			      		'share_title'   =>  $value['quiz_share_description']['share_title'],
			      		'count'			=>  $my_choice[$value['percent_start'].'_'.$value['percent_end']]['count']+1
	      			);
		      	}else{
		      		$my_choice[$value['percent_start'].'_'.$value['percent_end']]= array(
			      		'share_title'   =>  $value['quiz_share_description']['share_title'],
			      		'count'			=>  1
	      			);
		      	}
		      	
		        
		      }
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