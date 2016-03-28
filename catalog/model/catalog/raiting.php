<?php
class ModelCatalogRaiting extends Model {
	public function getRaiting($raiting_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'raiting_id=" . (int)$raiting_id . "') AS keyword FROM " . DB_PREFIX . "raiting d LEFT JOIN " . DB_PREFIX . "raiting_description dd ON (d.raiting_id = dd.raiting_id) WHERE d.raiting_id = '" . (int)$raiting_id . "' AND dd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getRaitings($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "raiting d LEFT JOIN " . DB_PREFIX . "raiting_description dd ON (d.raiting_id = dd.raiting_id) WHERE dd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND dd.title LIKE '" . $this->db->escape($data['filter_title']) . "%'";
		}
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND d.status = '" . (int)$data['filter_status'] . "'";
		}
		if (isset($data['filter_visibility']) && !is_null($data['filter_visibility'])) {
			$sql .= " AND d.visibility = '" . (int)$data['filter_visibility'] . "'";
		}
        if (isset($data['filter_season_id']) && !is_null($data['filter_season_id'])) {
            $sql .= " AND d.season_id = '" . (int)$data['filter_season_id'] . "'";
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

	public function getRaitingDescriptions($raiting_id) {
		$raiting_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "raiting_description WHERE raiting_id = '" . (int)$raiting_id . "'");

		foreach ($query->rows as $result) {
			$raiting_description_data[$result['language_id']] = array(
				'title' => $result['title'],
				'description'      => $result['description'],
				'meta_title'       => $result['meta_title'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword']
			);
		}

		return $raiting_description_data;
	}

	public function getTotalRaitings() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "raiting");

		return $query->row['total'];
	}
	public function getRaitingImages($raiting_id) {
		$raiting_image_data = array();

		$raiting_image_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "raiting_image WHERE raiting_id = '" . (int)$raiting_id . "' ORDER BY raiting_image_id ASC");

		foreach ($raiting_image_query->rows as $raiting_image) {
			$raiting_image_description_data = array();

			$raiting_image_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "raiting_image_description WHERE raiting_image_id = '" . (int)$raiting_image['raiting_image_id'] . "' AND raiting_id = '" . (int)$raiting_id . "'");

			foreach ($raiting_image_description_query->rows as $raiting_image_description) {
				$raiting_image_description_data[$raiting_image_description['language_id']] = array(
					'title' => $raiting_image_description['title']
				);
			}

			$raiting_image_data[] = array(
				'raiting_image_description'  	=> $raiting_image_description_data,
				'link'                     	=> $raiting_image['link'],
				'image'                    	=> $raiting_image['image'],
				'sort_order'			    => $raiting_image['sort_order'],
			);
		}

		return $raiting_image_data;
	}

	public function addVoice($data=array(),$data_customer=array(),$customer_id){
		//print_r($data['result']);
		//сгенирим token
		$rshare_id = sha1(uniqid(microtime(true), true));
		$raiting_id = 0;
		if(!empty($data['achives'])){
			$rating_id = $data['rating_id'];
			$this->db->query("INSERT INTO " . DB_PREFIX . "raiting_stats SET
				rshare_id = '" .  $this->db->escape($rshare_id) . "',
				customer_id = '" . (int)$customer_id . "',
				raiting_id = '" . (int)$rating_id . "',
				value = '" .  $this->db->escape(serialize($data['achives']) )  . "',
				ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "',
			    date_added = NOW()"
			);
		}
		//возврашаем rshare_id
		return array(
			'rshare_id'=>$rshare_id,
			'raiting_id'=>$raiting_id
			);
	}
	/*
	public function addVoice($data=array(),$data_customer=array(),$customer_id){
		//print_r($data['result']);
		//сгенирим token
		$rshare_id = sha1(uniqid(microtime(true), true));

		if(!empty($data['achives'])){
			$raiting_id = $data['raiting'];
				//добавить проверку на повтор токена
			foreach ($data['achives'] as $value) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "raiting_stats SET
					rshare_id = '" .  $this->db->escape($rshare_id) . "',
					customer_id = '" . (int)$customer_id . "',
					raiting_id = '" . (int)$raiting_id . "',
					achievement_id = '" . (int)$value . "',
					ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "',
				    date_added = NOW()");
			}
		}else{
				//добавить проверку на повтор токена
		foreach ($data['result'] as $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "raiting_stats SET
				rshare_id = '" .  $this->db->escape($rshare_id) . "',
				customer_id = '" . (int)$customer_id . "',
				raiting_id = '" . (int)$value['raiting_id'] . "',
				achievement_id = '" . (int)$value['achievement_id'] . "',
				ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "',
			    date_added = NOW()");
			}
		}
		//возврашаем rshare_id
		return $rshare_id;
	}
	*/
	public function addQuestion($data=array(),$data_customer=array(),$customer_id){
		$this->db->query("INSERT INTO " . DB_PREFIX . "add_stats SET
				email = '" .  $this->db->escape($data['email']) . "',
				customer_id = '" . (int)$customer_id . "',
				firstname = '" .  $this->db->escape($data['firstname']) . "',
				message = '" .  $this->db->escape($data['message']) . "',
				ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "',
			    date_added = NOW()");

		//возврашаем rshare_id
		return true;
	}
	private function getTotalRshare($rshare_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "raiting_stats WHERE rshare_id = '" . $this->db->escape($rshare_id) . "'");

		return $query->row['total'];
	}
	public function getStatsForRaiting($raiting_id,$data=array()){
		$sql = "SELECT stat_id,raiting_id,value FROM " . DB_PREFIX . "raiting_stats  WHERE raiting_id = '" . (int)($raiting_id) . "'";

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
		$sql .= " ORDER BY stat_id";
		$query = $this->db->query($sql);

		return $query->rows;
	}
	public function getMyStatsForRaiting($rshare_id,$data=array()){
		$sql = "SELECT * FROM " . DB_PREFIX . "raiting_stats  WHERE rshare_id = '" . $this->db->escape($rshare_id) . "'";
		$sql .= " ORDER BY stat_id";
		$sql .= " ASC";
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

		return $query->row;
	}
	public function getCountForRaiting(){
		$sql = "SELECT raiting_id,COUNT(raiting_id) AS total FROM " . DB_PREFIX . "raiting_stats GROUP BY raiting_id";
		$query = $this->db->query($sql);

		return $query->rows;
	}
	public function getStats($data = array()){
		$sql = "SELECT * FROM " . DB_PREFIX . "raiting_stats ";
		$sql .= " ORDER BY stat_id";
		$sql .= " ASC";
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
}
