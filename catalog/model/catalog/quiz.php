<?php
class ModelCatalogQuiz extends Model {
	public function getQuiz($quiz_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'quiz_id=" . (int)$quiz_id . "') AS keyword FROM " . DB_PREFIX . "quiz d LEFT JOIN " . DB_PREFIX . "quiz_description dd ON (d.quiz_id = dd.quiz_id) WHERE d.quiz_id = '" . (int)$quiz_id . "' AND dd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getQuizs($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "quiz d LEFT JOIN " . DB_PREFIX . "quiz_description dd ON (d.quiz_id = dd.quiz_id) WHERE dd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND dd.title LIKE '" . $this->db->escape($data['filter_title']) . "%'";
		}
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND d.status = '" . (int)$data['filter_status'] . "'";
		}
		if (isset($data['filter_visibility']) && !is_null($data['filter_visibility'])) {
			$sql .= " AND d.visibility = '" . (int)$data['filter_visibility'] . "'";
		}

		$sort_data = array(
			'dd.title',
			'd.date_added',
			'd.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY d.sort_order";
		}

		if (isset($data['order']) && ($data['order'] == 'ASC')) {
			$sql .= " ASC";
		} else {
			$sql .= " DESC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
      if (!isset($data['start'])) {
        $data['start'] = 0;
      } else if ($data['start'] < 0) {
        $data['start'] = 0;
      }
      if (!isset($data['limit'])) {
        $data['limit'] = 20;
      } else if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getQuizDescriptions($quiz_id) {
		$quiz_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "quiz_description WHERE quiz_id = '" . (int)$quiz_id . "'");

		foreach ($query->rows as $result) {
			$quiz_description_data[$result['language_id']] = array(
				'title' => $result['title'],
				'description'      => $result['description'],
				'meta_title'       => $result['meta_title'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword']
			);
		}

		return $quiz_description_data;
	}

	public function getTotalQuizs() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "quiz");

		return $query->row['total'];
	}
	public function getStatsForQuiz($quiz_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "quiz_stats WHERE quiz_id = '" . (int)$quiz_id . "'");
		return $query->rows;
	}
	public function getQuizImages($quiz_id) {
		$quiz_image_data = array();

		$quiz_image_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "quiz_image WHERE quiz_id = '" . (int)$quiz_id . "' ORDER BY quiz_image_id ASC");

		foreach ($quiz_image_query->rows as $quiz_image) {
			$quiz_image_description_data = array();

			$quiz_image_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "quiz_image_description WHERE quiz_image_id = '" . (int)$quiz_image['quiz_image_id'] . "' AND quiz_id = '" . (int)$quiz_id . "'");

			foreach ($quiz_image_description_query->rows as $quiz_image_description) {
				$quiz_image_description_data[$quiz_image_description['language_id']] = array(
					'title' => $quiz_image_description['title']
				);
			}

			$quiz_image_data[] = array(
				'quiz_image_description'  	=> $quiz_image_description_data,
				'link'                     	=> $quiz_image['link'],
				'image'                    	=> $quiz_image['image'],
				'sort_order'			    => $quiz_image['sort_order'],
			);
		}

		return $quiz_image_data;
	}

	public function addVoice($data=array(),$data_customer=array(),$customer_id){
		//print_r($data['result']);
		//сгенирим token
		$qshare_id = sha1(uniqid(microtime(true), true));
		$quiz_id = 0;

		if(!empty($data['answer'])){
			$quiz_id = $data['quiz_id'];


      // print_r('<pre>');
      // print_r($data);
      // print_r('</pre>');
      // die();


			$this->db->query("INSERT INTO " . DB_PREFIX . "quiz_stats SET
				qshare_id = '" .  $this->db->escape($qshare_id) . "',
				customer_id = '" . (int)$customer_id . "',
				quiz_id = '" . (int)$quiz_id . "',
				value = '" .  $this->db->escape(serialize($data['answer']) )  . "',
				ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "',
		    date_added = NOW(),
        time = ".(!empty($data['timer']) ? $data['timer'] : 0)
			);
		}
		//возврашаем rshare_id
		return array(
			'qshare_id'=>$qshare_id,
			'quiz_id'=>$quiz_id
			);
	}
	public function getTotalQuizStats() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "quiz_stats");

		return $query->row['total'];
	}
	public function getTotalQuizStatsFor($quiz_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "quiz_stats WHERE quiz_id='".(int)$quiz_id."'");

		return $query->row['total'];
	}
	private function getTotalRshare($rshare_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "quiz_stats WHERE rshare_id = '" . $this->db->escape($rshare_id) . "'");

		return $query->row['total'];
	}
	public function getMyStatsForQuiz($qshare_id){
		$sql = "SELECT * FROM " . DB_PREFIX . "quiz_stats  WHERE qshare_id = '" . $this->db->escape($qshare_id) . "'";
		$query = $this->db->query($sql);
		return $query->row;
	}
	public function getQuizShare($quiz_id){
		$quiz_share_data = array();

	    $quiz_share_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "quiz_share WHERE quiz_id = '" . (int)$quiz_id . "' ORDER BY quiz_share_id ASC");

	    foreach ($quiz_share_query->rows as $quiz_share) {
	      $quiz_share_description_data = array();

	      $quiz_share_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "quiz_share_description WHERE language_id = '" . (int)$this->config->get('config_language_id') . "' AND quiz_share_id = '" . (int)$quiz_share['quiz_share_id'] . "' AND quiz_id = '" . (int)$quiz_id . "'");

	      foreach ($quiz_share_description_query->rows as $quiz_share_description) {
	        $quiz_share_description_data = array(
	          'share_title'    => $quiz_share_description['share_title'],
	          'share_comment'  => $quiz_share_description['share_comment']
	        );
	      }

	      $quiz_share_data[] = array(
	        'quiz_share_description'   	=> $quiz_share_description_data,
	        'percent_start'          		=> $quiz_share['percent_start'],
	        'percent_end'          			=> $quiz_share['percent_end'],
	        'image'                     => $quiz_share['image'],
	        'sort_order'          			=> $quiz_share['sort_order']

	      );
	    }

	    return $quiz_share_data;
	}
	public function getQuizAnswerWithComment($str_qitems){
		$sql = "SELECT * FROM " . DB_PREFIX . "qitem_question d LEFT JOIN " . DB_PREFIX . "qitem_question_description dd ON (d.qitem_question_id = dd.qitem_question_id) WHERE dd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND d.qitem_id IN ( ". $str_qitems ." ) ORDER BY sort_order ASC";

		$query = $this->db->query($sql);
		return $query->rows;
	}

	public function getQuizAnswer($str_qitems){
		$sql = "SELECT * FROM " . DB_PREFIX . "qitem_question WHERE qitem_id IN ( ". $str_qitems ." )";

		$query = $this->db->query($sql);
		return $query->rows;
	}
	public function getSteps($quiz_id){
		$sql = "SELECT * FROM " . DB_PREFIX . "qitem d LEFT JOIN " . DB_PREFIX . "qitem_description dd ON (d.qitem_id = dd.qitem_id) WHERE dd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND quiz_id = '".(int)$quiz_id ."' AND d.status = '1' ORDER BY sort_order ASC";
		$query = $this->db->query($sql);

		//получим инфу о вопросах
		$main_qitem = $query->rows;
		$data_qitems = array();
		if(!empty($main_qitem)){
				$str_qitems = "'";
		foreach ($main_qitem as $qitem) {
			$str_qitems = $str_qitems.$qitem['qitem_id']."','";
		}
		$sql = "SELECT * FROM " . DB_PREFIX . "qitem_question d LEFT JOIN " . DB_PREFIX . "qitem_question_description dd ON (d.qitem_question_id = dd.qitem_question_id) WHERE dd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND  d.qitem_id IN ( ". substr($str_qitems, 0, -2) ." ) ORDER BY sort_order ASC";

		$query = $this->db->query($sql);
		$desc_qitem = $query->rows;

		foreach ($main_qitem as $mq) {
				$d_qitems = array();
				foreach ($desc_qitem as $value) {
					if($value['qitem_id'] == $mq['qitem_id']){
						$d_qitems[] = array(
								'question_id' 		=> $value['question_id'],
          			'correct' 			=> $value['correct'],
								'answer_title'		=> $value['answer_title'],
		            'answer_comment'	=> $value['answer_comment'],
		            'image'				=> $value['image'],
		            'sort_order'		=> $value['sort_order']
						);
					}

				}
				$data_qitems[] = array(
					'qitem_id' 		 => $mq['qitem_id'],
					'title' 		 	 => $mq['title'],
					'image' 		 	 => $mq['image'],
					'ar_questions' => $d_qitems
				);
		}
		}

		return $data_qitems;
	}
}
