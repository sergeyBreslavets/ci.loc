<?php
class ModelCatalogQuiz extends Model {
	public function addQuiz($data) {
		$this->event->trigger('pre.admin.quiz.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "quiz SET 
			image = '" . $this->db->escape($data['image']) . "',
			template_id = '" . $this->db->escape($data['template_id']) . "',
			visibility = '" . (int)$data['visibility'] . "',
			type_id = '" . (int)$data['type_id'] . "',
			status = '" . (int)$data['status'] . "',
			sort_order = '" . (int)$data['sort_order'] . "',
			date_added = NOW()");

		$quiz_id = $this->db->getLastId();

		foreach ($data['quiz_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "quiz_description SET 
				quiz_id = '" . (int)$quiz_id . "', 
				language_id = '" . (int)$language_id . "', 
				title = '" . $this->db->escape($value['title']) . "', 
				meta_title = '" . $this->db->escape($value['meta_title']) . "', 
				meta_description = '" . $this->db->escape($value['meta_description']) . "', 
				meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'
			");
		}

		
		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET 
				query = 'quiz_id=" . (int)$quiz_id . "', 
				keyword = '" . $this->db->escape($data['keyword']) . "'
			");
		}
		
		if (isset($data['quiz_share'])) {
		      foreach ($data['quiz_share'] as $quiz_share) {
		        $this->db->query("INSERT INTO " . DB_PREFIX . "quiz_share SET 
		          quiz_id = '" . (int)$quiz_id . "',
		          percent_start = '" . (int)$quiz_share['percent_start'] . "', 
		          percent_end = '" . (int)$quiz_share['percent_end'] . "',
		          image = '" .  $this->db->escape($quiz_share['image']) . "', 
		          sort_order = '" . (int)$quiz_share['sort_order'] . "'
		        ");

		        $quiz_share_id = $this->db->getLastId();

		        foreach ($quiz_share['quiz_share_description'] as $language_id => $quiz_share_description) {
		          $this->db->query("INSERT INTO " . DB_PREFIX . "quiz_share_description SET 
		            quiz_share_id = '" . (int)$quiz_share_id . "', 
		            language_id = '" . (int)$language_id . "', 
		            quiz_id = '" . (int)$quiz_id . "', 
		            share_title = '" .  $this->db->escape($quiz_share_description['share_title']) . "',
		            share_comment = '" .  $this->db->escape($quiz_share_description['share_comment']) . "'
		          ");
		        }
		      }
		    }
		$this->event->trigger('post.admin.quiz.add', $quiz_id);

		return $quiz_id;
	}

	public function editQuiz($quiz_id, $data) {
		$this->event->trigger('pre.admin.quiz.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "quiz SET 
			image = '" . $this->db->escape($data['image']) . "',
			template_id = '" . $this->db->escape($data['template_id']) . "',
			type_id = '" . (int)$data['type_id'] . "',
			visibility = '" . (int)$data['visibility'] . "',
			status = '" . (int)$data['status'] . "',
			sort_order = '" . (int)$data['sort_order'] . "'
			WHERE quiz_id = '" . (int)$quiz_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "quiz_description WHERE quiz_id = '" . (int)$quiz_id . "'");

		foreach ($data['quiz_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "quiz_description SET 
				quiz_id = '" . (int)$quiz_id . "', 
				language_id = '" . (int)$language_id . "', 
				title = '" . $this->db->escape($value['title']) . "', 
				meta_title = '" . $this->db->escape($value['meta_title']) . "', 
				meta_description = '" . $this->db->escape($value['meta_description']) . "', 
				meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'
			");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'quiz_id=" . (int)$quiz_id . "'");
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET 
				query = 'quiz_id=" . (int)$quiz_id . "', 
				keyword = '" . $this->db->escape($data['keyword']) . "'
			");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "quiz_share WHERE quiz_id = '" . (int)$quiz_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "quiz_share_description WHERE quiz_id = '" . (int)$quiz_id . "'");
		    
		    
		     if (isset($data['quiz_share'])) {
		      foreach ($data['quiz_share'] as $quiz_share) {
		        $this->db->query("INSERT INTO " . DB_PREFIX . "quiz_share SET 
		          quiz_id = '" . (int)$quiz_id . "',
		          percent_start = '" . (int)$quiz_share['percent_start'] . "', 
		          percent_end = '" . (int)$quiz_share['percent_end'] . "',
		          image = '" .  $this->db->escape($quiz_share['image']) . "', 
		          sort_order = '" . (int)$quiz_share['sort_order'] . "'
		        ");

		        $quiz_share_id = $this->db->getLastId();

		        foreach ($quiz_share['quiz_share_description'] as $language_id => $quiz_share_description) {
		          $this->db->query("INSERT INTO " . DB_PREFIX . "quiz_share_description SET 
		            quiz_share_id = '" . (int)$quiz_share_id . "', 
		            language_id = '" . (int)$language_id . "', 
		            quiz_id = '" . (int)$quiz_id . "', 
		            share_title = '" .  $this->db->escape($quiz_share_description['share_title']) . "',
		            share_comment = '" .  $this->db->escape($quiz_share_description['share_comment']) . "'
		          ");
		        }
		      }
		    }

		$this->event->trigger('post.admin.quiz.edit', $quiz_id);
	}

	public function deleteQuiz($quiz_id) {
		$this->event->trigger('pre.admin.quiz.delete', $quiz_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "quiz WHERE quiz_id = '" . (int)$quiz_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "quiz_description WHERE quiz_id = '" . (int)$quiz_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'quiz_id=" . (int)$quiz_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "quiz_share WHERE quiz_id = '" . (int)$quiz_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "quiz_share_description WHERE quiz_id = '" . (int)$quiz_id . "'");
		$this->event->trigger('post.admin.quiz.delete', $quiz_id);
	}

	public function getQuiz($quiz_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'quiz_id=" . (int)$quiz_id . "') AS keyword FROM " . DB_PREFIX . "quiz d LEFT JOIN " . DB_PREFIX . "quiz_description dd ON (d.quiz_id = dd.quiz_id) WHERE d.quiz_id = '" . (int)$quiz_id . "' AND dd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getStatsForQuiz($quiz_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "quiz_stats WHERE quiz_id = '" . (int)$quiz_id . "'");
		return $query->rows;
	}

	public function getQuizAnswer($str_qitems){
		$sql = "SELECT * FROM " . DB_PREFIX . "qitem_question WHERE qitem_id IN ( ". $str_qitems ." )";
		
		$query = $this->db->query($sql); 
		return $query->rows;
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

	public function getQuizs($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "quiz d LEFT JOIN " . DB_PREFIX . "quiz_description dd ON (d.quiz_id = dd.quiz_id) WHERE dd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND dd.title LIKE '" . $this->db->escape($data['filter_title']) . "%'";
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
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
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

	public function getQuizImages($quiz_id){
		$quiz_share_data = array();

    $quiz_share_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "quiz_share WHERE quiz_id = '" . (int)$quiz_id . "' ORDER BY quiz_share_id ASC");

    foreach ($quiz_share_query->rows as $quiz_share) {
      $quiz_share_description_data = array();
       
      $quiz_share_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "quiz_share_description WHERE quiz_share_id = '" . (int)$quiz_share['quiz_share_id'] . "' AND quiz_id = '" . (int)$quiz_id . "'");
      
      foreach ($quiz_share_description_query->rows as $quiz_share_description) {      
        $quiz_share_description_data[$quiz_share_description['language_id']] = array(
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
}