<?php
class ModelCatalogRaiting extends Model {
	public function addRaiting($data) {
		$this->event->trigger('pre.admin.raiting.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "raiting SET
			image = '" . $this->db->escape($data['image']) . "',
			visibility = '" . (int)$data['visibility'] . "',
            season_id = '" . (int)$data['season_id'] . "',
			status = '" . (int)$data['status'] . "',
			sort_order = '" . (int)$data['sort_order'] . "',
			date_added = NOW()");

		$raiting_id = $this->db->getLastId();

		foreach ($data['raiting_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "raiting_description SET
				raiting_id = '" . (int)$raiting_id . "',
				language_id = '" . (int)$language_id . "',
				title = '" . $this->db->escape($value['title']) . "',
				action_title = '" . $this->db->escape($value['action_title']) . "',
				meta_title = '" . $this->db->escape($value['meta_title']) . "',
				meta_description = '" . $this->db->escape($value['meta_description']) . "',
				meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'
			");
		}


		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET
				query = 'raiting_id=" . (int)$raiting_id . "',
				keyword = '" . $this->db->escape($data['keyword']) . "'
			");
		}

		$this->event->trigger('post.admin.raiting.add', $raiting_id);

		return $raiting_id;
	}

	public function editRaiting($raiting_id, $data) {
		$this->event->trigger('pre.admin.raiting.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "raiting SET
			image = '" . $this->db->escape($data['image']) . "',
			visibility = '" . (int)$data['visibility'] . "',
            season_id = '" . (int)$data['season_id'] . "',
			status = '" . (int)$data['status'] . "',
			sort_order = '" . (int)$data['sort_order'] . "'
			WHERE raiting_id = '" . (int)$raiting_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "raiting_description WHERE raiting_id = '" . (int)$raiting_id . "'");

		foreach ($data['raiting_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "raiting_description SET
				raiting_id = '" . (int)$raiting_id . "',
				language_id = '" . (int)$language_id . "',
				title = '" . $this->db->escape($value['title']) . "',
				action_title = '" . $this->db->escape($value['action_title']) . "',
				meta_title = '" . $this->db->escape($value['meta_title']) . "',
				meta_description = '" . $this->db->escape($value['meta_description']) . "',
				meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'
			");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'raiting_id=" . (int)$raiting_id . "'");
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET
				query = 'raiting_id=" . (int)$raiting_id . "',
				keyword = '" . $this->db->escape($data['keyword']) . "'
			");
		}


		$this->event->trigger('post.admin.raiting.edit', $raiting_id);
	}

	public function deleteRaiting($raiting_id) {
		$this->event->trigger('pre.admin.raiting.delete', $raiting_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "raiting WHERE raiting_id = '" . (int)$raiting_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "raiting_description WHERE raiting_id = '" . (int)$raiting_id . "'");

		$this->event->trigger('post.admin.raiting.delete', $raiting_id);
	}

	public function getRaiting($raiting_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'raiting_id=" . (int)$raiting_id . "') AS keyword FROM " . DB_PREFIX . "raiting d LEFT JOIN " . DB_PREFIX . "raiting_description dd ON (d.raiting_id = dd.raiting_id) WHERE d.raiting_id = '" . (int)$raiting_id . "' AND dd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getRaitings($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "raiting d LEFT JOIN " . DB_PREFIX . "raiting_description dd ON (d.raiting_id = dd.raiting_id) WHERE dd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

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

	public function getRaitingDescriptions($raiting_id) {
		$raiting_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "raiting_description WHERE raiting_id = '" . (int)$raiting_id . "'");

		foreach ($query->rows as $result) {
			$raiting_description_data[$result['language_id']] = array(
				'title' => $result['title'],
				'action_title'=>$result['action_title'],
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
}
