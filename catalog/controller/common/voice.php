<?php
class ControllerCommonVoice extends Controller {
	public function index(){
		//добавим 
		$n = 2;
		for ($i=0; $i < $n; $i++) { 
			//$this->placemans();
		}
		
		for ($i=1; $i < 1; $i++) { 
	//		$this->smajor();
		}
		for ($i=1; $i < 1; $i++) { 
	//		$this->lmajor();
		}
		for ($i=1; $i < 7; $i++) { 
			$this->addVoiceRating();
		}
		

	}
	public function addRating(){
		
		for ($i=0; $i < 1000; $i++) { 
		//	$this->addVoiceRating();
		}
	}
	private function addVoiceRating(){


		//ссформируем массив 
		$data_serialaze = array();
		$data_serialaze[] = 133;
		$data_serialaze[] = 129;
		$data_serialaze[] = 136;
		$data_serialaze[] = 135;
		$data_serialaze[] = 137;

		$data_serialaze[] = 139;
		$data_serialaze[] = 134;
		$data_serialaze[] = 130;
		$data_serialaze[] = 142;
		$data_serialaze[] = 141;

		$data_serialaze[] = 138;
		$data_serialaze[] = 132;
		$data_serialaze[] = 140;
		$data_serialaze[] = 131;
		$data_serialaze[] = 143;
		shuffle($data_serialaze);
		
		$data_serialaze = array_slice($data_serialaze, 0, 5);
		
		$this->load->model('catalog/raiting');
		//делаем запись голоса
		$customer_id = 0;
		$data_customer = array();

		$send_data = array();
		$send_data['achives'] = $data_serialaze;
		$send_data['rating_id'] = 11;
		
		print_r('<pre>');
		print_r($send_data);
		print_r('</pre>');
		
		$array_share = $this->model_catalog_raiting->addVoice($send_data,$data_customer,$customer_id);
		print_r('<pre>');
		print_r($array_share);
		print_r('</pre>');
	}
	private function placemans(){
		$quiz_id = 11;
		$raiting_id = 9;
		$this->load->model('catalog/achievement');
		$filter_data = array(
			'filter_status'    => 1,
			'filter_raiting_id' => $raiting_id
		);

		$result_achievements = $this->model_catalog_achievement->getAchievements($filter_data);
		$placemans = array();
		foreach ($result_achievements as $achievement) {
			
			$placemans[] = array(
				'achievement_id' 				=> $achievement['achievement_id'],
			);
		}
		shuffle($placemans);
		//добавим варианты голосования
		$var_voice = mt_rand(0,2);
		$data_serialaze = array();
		$var_voice = 1;
		switch ($var_voice) {
			case '0':
				//всем ставлю статус 0
				foreach ($placemans as $man) {
					$data_serialaze[$man['achievement_id']] = 0;
				}
				break;
			case '1':
				//беру максимум 5
				$count_placemans = count($placemans);
				foreach ($placemans as $man) {
					$data_serialaze[$man['achievement_id']] = 0;
				}
				$count_correct = mt_rand(1,5);
				$max_count = $count_placemans - $count_correct;
				$count_no_correct = mt_rand(1,$max_count);
				$count_other = $max_count - $count_no_correct;
				print_r('<pre>');
				print_r('в минус = '.$count_no_correct);
				print_r('</pre>');
				print_r('<pre>');
				print_r('в незнаю = '.$count_other);
				print_r('</pre>');
				
				print_r('<pre>');
				print_r('берем на работу = '.$count_correct);
				print_r('</pre>');
				print_r('<pre>');
				print_r('количество всех = '.$count_placemans);
				print_r('</pre>');
				
				foreach ($data_serialaze as $key => $val) {
					if($count_correct > 0){
						$data_serialaze[$key] = 1;
						$count_correct -=1;
					}else{
						if($count_no_correct > 0){
							$data_serialaze[$key] = 0;
							$count_no_correct -=1;
						}else{
							$data_serialaze[$key] = 2;
						}
						
					}
					
				}
				
				break;
			case '2':
				# никого не знаю
				foreach ($placemans as $k => $man) {
					$data_serialaze[$man['achievement_id']] = 2;

				}
				break;
			default:
				# code...
				break;
		}
		
		
		print_r('<pre>');
		print_r($data_serialaze);
		print_r('</pre>');
		//подключи ммоделки
		$this->load->model('catalog/quiz');
		//делаем запись голоса
		$customer_id = 0;
		$data_customer = array();
		$send_data = array();
		$send_data['answer'] = $data_serialaze;
		$send_data['quiz_id'] = $quiz_id;

		//$array_qshare = $this->model_catalog_quiz->addVoice($send_data,$data_customer,$customer_id);
		print_r('<pre>');
		print_r($array_qshare);
		print_r('</pre>');
		
		
	}
	private function smajor(){
		$quiz_id = 12;
		$var_voice = mt_rand(8,14);
		$arr_voice = array();
		for ($i=1; $i <= $var_voice; $i++) { 
			$arr_voice[$i] = 1; 
		}
		for ($i=0; $i < 14-$var_voice; $i++) { 
			$arr_voice[] = 0;
		}
		shuffle($arr_voice);
		$data_serialaze = array();
		$i=1;
		foreach ($arr_voice as $value) {
			$data_serialaze[$i] = $value;
			$i++;
		}
		$this->load->model('catalog/quiz');
		//делаем запись голоса
		$customer_id = 0;
		$data_customer = array();
		$send_data = array();
		$send_data['answer'] = $data_serialaze;
		$send_data['quiz_id'] = $quiz_id;
		print_r('<pre>');
		print_r($send_data['answer']);
		print_r('</pre>');
		$array_qshare = $this->model_catalog_quiz->addVoice($send_data,$data_customer,$customer_id);

		print_r('<pre>');
		print_r($array_qshare);
		print_r('</pre>');
		
	}
	private function lmajor(){
		$quiz_id = 12;
		$var_voice = mt_rand(1,6);
		$arr_voice = array();
		for ($i=1; $i <= $var_voice; $i++) { 
			$arr_voice[$i] = 1; 
		}
		for ($i=0; $i < 14-$var_voice; $i++) { 
			$arr_voice[] = 0;
		}
		shuffle($arr_voice);
		$data_serialaze = array();
		$i=1;
		foreach ($arr_voice as $value) {
			$data_serialaze[$i] = $value;
			$i++;
		}
		$this->load->model('catalog/quiz');
		//делаем запись голоса
		$customer_id = 0;
		$data_customer = array();
		$send_data = array();
		$send_data['answer'] = $data_serialaze;
		$send_data['quiz_id'] = $quiz_id;
		print_r('<pre>');
		print_r($send_data['answer']);
		print_r('</pre>');
		$array_qshare = $this->model_catalog_quiz->addVoice($send_data,$data_customer,$customer_id);
		print_r('<pre>');
		print_r($array_qshare);
		print_r('</pre>');
		
	}
}
