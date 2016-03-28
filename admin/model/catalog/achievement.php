<?php
class ModelCatalogAchievement extends Model {
	public function addAchievement($data) {
		$this->event->trigger('pre.admin.achievement.add', $data);
	
		$this->db->query("INSERT INTO " . DB_PREFIX . "achievement SET 
			image = '" . $this->db->escape($data['image']) . "',
			raiting_id = '" . (int)$data['raiting_id'] . "',
			score_id = '" . (int)$data['score_id'] . "',
			visibility = '" . (int)$data['visibility'] . "',
			status = '" . (int)$data['status'] . "',
			date_added = NOW()");

		$achievement_id = $this->db->getLastId();
		foreach ($data['achievement_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "achievement_description SET 
				achievement_id = '" . (int)$achievement_id . "', 
				language_id = '" . (int)$language_id . "', 
				title = '" . $this->db->escape($value['title']) . "',
				description = '" . $this->db->escape($value['description']) . "', 
				meta_title = '" . $this->db->escape($value['meta_title']) . "', 
				meta_description = '" . $this->db->escape($value['meta_description']) . "', 
				meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'
			");
		}

		if (isset($data['achievement_image'])) {
			foreach ($data['achievement_image'] as $achievement_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "achievement_image SET 
					achievement_id = '" . (int)$achievement_id . "', 
					link = '" .  $this->db->escape($achievement_image['link']) . "', 
					image = '" .  $this->db->escape($achievement_image['image']) . "', 
					sort_order = '" . (int)$achievement_image['sort_order'] . "'
				");

				$achievement_image_id = $this->db->getLastId();

				foreach ($achievement_image['achievement_image_description'] as $language_id => $achievement_image_description) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "achievement_image_description SET 
						achievement_image_id = '" . (int)$achievement_image_id . "', 
						language_id = '" . (int)$language_id . "', 
						achievement_id = '" . (int)$achievement_id . "', 
						title = '" .  $this->db->escape($achievement_image_description['title']) . "'
					");
				}
			}
		}
		/*
		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET 
				query = 'achievement_id=" . (int)$achievement_id . "', 
				keyword = '" . $this->db->escape($data['keyword']) . "'
			");
		}
		*/
		$this->cache->delete('achievement');

		$this->event->trigger('post.admin.achievement.add', $achievement_id);

		return $achievement_id;
	}

	public function editAchievement($achievement_id, $data) {
		$this->event->trigger('pre.admin.achievement.edit', $data);
		$this->db->query("UPDATE " . DB_PREFIX . "achievement SET 
			image = '" . $this->db->escape($data['image']) . "',
			raiting_id = '" . (int)$data['raiting_id'] . "',
			score_id = '" . (int)$data['score_id'] . "',
			visibility = '" . (int)$data['visibility'] . "',
			status = '" . (int)$data['status'] . "'
			WHERE achievement_id = '" . (int)$achievement_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "achievement_description WHERE achievement_id = '" . (int)$achievement_id . "'");

		foreach ($data['achievement_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "achievement_description SET 
				achievement_id = '" . (int)$achievement_id . "', 
				language_id = '" . (int)$language_id . "', 
				title = '" . $this->db->escape($value['title']) . "',
				description = '" . $this->db->escape($value['description']) . "', 
				meta_title = '" . $this->db->escape($value['meta_title']) . "', 
				meta_description = '" . $this->db->escape($value['meta_description']) . "', 
				meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'
			");
		}
		/*
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'achievement_id=" . (int)$achievement_id . "'");
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET 
				query = 'achievement_id=" . (int)$achievement_id . "', 
				keyword = '" . $this->db->escape($data['keyword']) . "'
			");
		}
		*/
		$this->db->query("DELETE FROM " . DB_PREFIX . "achievement_image WHERE achievement_id = '" . (int)$achievement_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "achievement_image_description WHERE achievement_id = '" . (int)$achievement_id . "'");

		if (isset($data['achievement_image'])) {
			foreach ($data['achievement_image'] as $achievement_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "achievement_image SET 
					achievement_id = '" . (int)$achievement_id . "', 
					link = '" .  $this->db->escape($achievement_image['link']) . "', 
					image = '" .  $this->db->escape($achievement_image['image']) . "', 
					sort_order = '" . (int)$achievement_image['sort_order'] . "'
				");

				$achievement_image_id = $this->db->getLastId();

				foreach ($achievement_image['achievement_image_description'] as $language_id => $achievement_image_description) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "achievement_image_description SET 
						achievement_image_id = '" . (int)$achievement_image_id . "', 
						language_id = '" . (int)$language_id . "', 
						achievement_id = '" . (int)$achievement_id . "', 
						title = '" .  $this->db->escape($achievement_image_description['title']) . "'
					");
				}
			}
		}

		$this->cache->delete('achievement');

		$this->event->trigger('post.admin.achievement.edit', $achievement_id);
	}

	public function deleteAchievement($achievement_id) {
		$this->event->trigger('pre.admin.achievement.delete', $achievement_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "achievement WHERE achievement_id = '" . (int)$achievement_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "achievement_description WHERE achievement_id = '" . (int)$achievement_id . "'");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'achievement_id=" . (int)$achievement_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "achievement_image WHERE achievement_id = '" . (int)$achievement_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "achievement_image_description WHERE achievement_id = '" . (int)$achievement_id . "'");

		$this->cache->delete('achievement');
		$this->event->trigger('post.admin.achievement.delete', $achievement_id);
	}

	public function getAchievement($achievement_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'achievement_id=" . (int)$achievement_id . "') AS keyword FROM " . DB_PREFIX . "achievement d LEFT JOIN " . DB_PREFIX . "achievement_description dd ON (d.achievement_id = dd.achievement_id) WHERE d.achievement_id = '" . (int)$achievement_id . "' AND dd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getAchievements($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "achievement d LEFT JOIN " . DB_PREFIX . "achievement_description dd ON (d.achievement_id = dd.achievement_id) WHERE dd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND dd.title LIKE '" . $this->db->escape($data['filter_title']) . "%'";
		}

		if (!empty($data['filter_rating_id'])) {
			$sql .= " AND d.raiting_id = '" . (int)$data['filter_rating_id'] . " '";
		}

		$sort_data = array(
			'dd.title',
			'd.date_added'
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