<?php
class ModelCatalogAchievement extends Model {
	
	public function getAchievement($achievement_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'achievement_id=" . (int)$achievement_id . "') AS keyword FROM " . DB_PREFIX . "achievement d LEFT JOIN " . DB_PREFIX . "achievement_description dd ON (d.achievement_id = dd.achievement_id) WHERE d.achievement_id = '" . (int)$achievement_id . "' AND dd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getAchievements($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "achievement d LEFT JOIN " . DB_PREFIX . "achievement_description dd ON (d.achievement_id = dd.achievement_id) WHERE dd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND dd.title LIKE '" . $this->db->escape($data['filter_title']) . "%'";
		}
		if (!empty($data['filter_raiting_id'])) {
			$sql .= " AND d.raiting_id = '". (int)$data['filter_raiting_id'] ."'";
		}
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND d.status = '" . (int)$data['filter_status'] . "'";
		}
		
		
		$sort_data = array(
			'dd.title',
			'd.date_added',
			'd.score_id',
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY dd.title";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
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

	public function getAchievementDescriptions($achievement_id) {
		$achievement_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "achievement_description WHERE achievement_id = '" . (int)$achievement_id . "'");

		foreach ($query->rows as $result) {
			$achievement_description_data[$result['language_id']] = array(
				'title' => $result['title'],
				'description'      => $result['description'],
				'meta_title'       => $result['meta_title'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword']
			);
		}

		return $achievement_description_data;
	}

	public function getTotalAchievements() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "achievement");

		return $query->row['total'];
	}
	public function getZeroVoices($raiting_id){
		$query = $this->db->query("SELECT raiting_id,score_id FROM " . DB_PREFIX . "achievement WHERE raiting_id =  '" .(int)$raiting_id. "' ");

		return $query->rows;
	}
	public function getAchievementImages($achievement_id) {
		$achievement_image_data = array();
		
		$achievement_image_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "achievement_image WHERE achievement_id = '" . (int)$achievement_id . "' ORDER BY achievement_image_id ASC");
		
		foreach ($achievement_image_query->rows as $achievement_image) {
			$achievement_image_description_data = array();
			 
			$achievement_image_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "achievement_image_description WHERE achievement_image_id = '" . (int)$achievement_image['achievement_image_id'] . "' AND achievement_id = '" . (int)$achievement_id . "'");
			
			foreach ($achievement_image_description_query->rows as $achievement_image_description) {			
				$achievement_image_description_data[$achievement_image_description['language_id']] = array(
					'title' => $achievement_image_description['title']
				);
			}
		
			$achievement_image_data[] = array(
				'achievement_image_description'  	=> $achievement_image_description_data,
				'link'                     	=> $achievement_image['link'],
				'image'                    	=> $achievement_image['image'],
				'sort_order'			    => $achievement_image['sort_order'],
			);
		}
		
		return $achievement_image_data;
	}
}