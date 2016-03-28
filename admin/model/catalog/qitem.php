<?php
class ModelCatalogQitem extends Model {
  public function addQitem($data) {
    $this->event->trigger('pre.admin.qitem.add', $data);

    $this->db->query("INSERT INTO " . DB_PREFIX . "qitem SET 
      image = '" . $this->db->escape($data['image']) . "',
      quiz_id = '" . (int)$data['quiz_id'] . "',
      visibility = '" . (int)$data['visibility'] . "',
      status = '" . (int)$data['status'] . "',
      sort_order = '" . (int)$data['sort_order'] . "',
      date_added = NOW()");

    $qitem_id = $this->db->getLastId();
    foreach ($data['qitem_description'] as $language_id => $value) {
      $this->db->query("INSERT INTO " . DB_PREFIX . "qitem_description SET 
        qitem_id = '" . (int)$qitem_id . "', 
        language_id = '" . (int)$language_id . "', 
        title = '" . $this->db->escape($value['title']) . "',
        address = '" . $this->db->escape($value['address']) . "',
        description = '" . $this->db->escape($value['description']) . "', 
        meta_title = '" . $this->db->escape($value['meta_title']) . "', 
        meta_description = '" . $this->db->escape($value['meta_description']) . "', 
        meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'
      ");
    }

    if (isset($data['qitem_image'])) {
      foreach ($data['qitem_image'] as $qitem_image) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "qitem_image SET 
          qitem_id = '" . (int)$qitem_id . "', 
          link = '" .  $this->db->escape($qitem_image['link']) . "', 
          image = '" .  $this->db->escape($qitem_image['image']) . "', 
          sort_order = '" . (int)$qitem_image['sort_order'] . "'
        ");

        $qitem_image_id = $this->db->getLastId();

        foreach ($qitem_image['qitem_image_description'] as $language_id => $qitem_image_description) {
          $this->db->query("INSERT INTO " . DB_PREFIX . "qitem_image_description SET 
            qitem_image_id = '" . (int)$qitem_image_id . "', 
            language_id = '" . (int)$language_id . "', 
            qitem_id = '" . (int)$qitem_id . "', 
            title = '" .  $this->db->escape($qitem_image_description['title']) . "'
          ");
        }
      }
    }

    if (isset($data['qitem_question'])) {
      foreach ($data['qitem_question'] as $qitem_question) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "qitem_question SET 
          qitem_id = '" . (int)$qitem_id . "', 
          question_id = '" . (int)$qitem_question['question_id'] . "',
          image = '" .  $this->db->escape($qitem_question['image']) . "', 
          correct = '" . (int)$qitem_question['correct'] . "',
          sort_order = '" . (int)$qitem_question['sort_order'] . "'
        ");

        $qitem_question_id = $this->db->getLastId();

        foreach ($qitem_question['qitem_question_description'] as $language_id => $qitem_question_description) {
          $this->db->query("INSERT INTO " . DB_PREFIX . "qitem_question_description SET 
            qitem_question_id = '" . (int)$qitem_question_id . "', 
            language_id = '" . (int)$language_id . "', 
            qitem_id = '" . (int)$qitem_id . "', 
            answer_title = '" .  $this->db->escape($qitem_question_description['answer_title']) . "',
            answer_comment = '" .  $this->db->escape($qitem_question_description['answer_comment']) . "'
          ");
        }
      }
    }

    if (isset($data['keyword'])) {
      $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET 
        query = 'qitem_id=" . (int)$qitem_id . "', 
        keyword = '" . $this->db->escape($data['keyword']) . "'
      ");
    }
    $this->cache->delete('qitem');

    $this->event->trigger('post.admin.qitem.add', $qitem_id);

    return $qitem_id;
  }

  public function editQitem($qitem_id, $data) {
    $this->event->trigger('pre.admin.qitem.edit', $data);

    $this->db->query("UPDATE " . DB_PREFIX . "qitem SET 
      image = '" . $this->db->escape($data['image']) . "',
      quiz_id = '" . (int)$data['quiz_id'] . "',
      visibility = '" . (int)$data['visibility'] . "',
      status = '" . (int)$data['status'] . "',
      sort_order = '" . (int)$data['sort_order'] . "'
      WHERE qitem_id = '" . (int)$qitem_id . "'");

    $this->db->query("DELETE FROM " . DB_PREFIX . "qitem_description WHERE qitem_id = '" . (int)$qitem_id . "'");

    foreach ($data['qitem_description'] as $language_id => $value) {
      $this->db->query("INSERT INTO " . DB_PREFIX . "qitem_description SET 
        qitem_id = '" . (int)$qitem_id . "', 
        language_id = '" . (int)$language_id . "', 
        title = '" . $this->db->escape($value['title']) . "',
        address = '" . $this->db->escape($value['address']) . "',
        description = '" . $this->db->escape($value['description']) . "', 
        meta_title = '" . $this->db->escape($value['meta_title']) . "', 
        meta_description = '" . $this->db->escape($value['meta_description']) . "', 
        meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'
      ");
    }
    $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'qitem_id=" . (int)$qitem_id . "'");
    if ($data['keyword']) {
      $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET 
        query = 'qitem_id=" . (int)$qitem_id . "', 
        keyword = '" . $this->db->escape($data['keyword']) . "'
      ");
    }
    $this->db->query("DELETE FROM " . DB_PREFIX . "qitem_image WHERE qitem_id = '" . (int)$qitem_id . "'");
    $this->db->query("DELETE FROM " . DB_PREFIX . "qitem_image_description WHERE qitem_id = '" . (int)$qitem_id . "'");

    if (isset($data['qitem_image'])) {
      foreach ($data['qitem_image'] as $qitem_image) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "qitem_image SET 
          qitem_id = '" . (int)$qitem_id . "', 
          link = '" .  $this->db->escape($qitem_image['link']) . "', 
          image = '" .  $this->db->escape($qitem_image['image']) . "', 
          sort_order = '" . (int)$qitem_image['sort_order'] . "'
        ");

        $qitem_image_id = $this->db->getLastId();

        foreach ($qitem_image['qitem_image_description'] as $language_id => $qitem_image_description) {
          $this->db->query("INSERT INTO " . DB_PREFIX . "qitem_image_description SET 
            qitem_image_id = '" . (int)$qitem_image_id . "', 
            language_id = '" . (int)$language_id . "', 
            qitem_id = '" . (int)$qitem_id . "', 
            title = '" .  $this->db->escape($qitem_image_description['title']) . "'
          ");
        }
      }
    }

    $this->db->query("DELETE FROM " . DB_PREFIX . "qitem_question WHERE qitem_id = '" . (int)$qitem_id . "'");
    $this->db->query("DELETE FROM " . DB_PREFIX . "qitem_question_description WHERE qitem_id = '" . (int)$qitem_id . "'");
    

    
     if (isset($data['qitem_question'])) {
      foreach ($data['qitem_question'] as $qitem_question) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "qitem_question SET 
          qitem_id = '" . (int)$qitem_id . "', 
          question_id = '" . (int)$qitem_question['question_id'] . "',
          image = '" .  $this->db->escape($qitem_question['image']) . "', 
          correct = '" . (int)$qitem_question['correct'] . "',
          sort_order = '" . (int)$qitem_question['sort_order'] . "'
        ");

        $qitem_question_id = $this->db->getLastId();

        foreach ($qitem_question['qitem_question_description'] as $language_id => $qitem_question_description) {
          $this->db->query("INSERT INTO " . DB_PREFIX . "qitem_question_description SET 
            qitem_question_id = '" . (int)$qitem_question_id . "', 
            language_id = '" . (int)$language_id . "', 
            qitem_id = '" . (int)$qitem_id . "', 
            answer_title = '" .  $this->db->escape($qitem_question_description['answer_title']) . "',
            answer_comment = '" .  $this->db->escape($qitem_question_description['answer_comment']) . "'
          ");
        }
      }
    }

    $this->cache->delete('qitem');

    $this->event->trigger('post.admin.qitem.edit', $qitem_id);
  }

  public function deleteQitem($qitem_id) {
    $this->event->trigger('pre.admin.qitem.delete', $qitem_id);

    $this->db->query("DELETE FROM " . DB_PREFIX . "qitem WHERE qitem_id = '" . (int)$qitem_id . "'");
    $this->db->query("DELETE FROM " . DB_PREFIX . "qitem_description WHERE qitem_id = '" . (int)$qitem_id . "'");
    $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'qitem_id=" . (int)$qitem_id . "'");
    $this->db->query("DELETE FROM " . DB_PREFIX . "qitem_image WHERE qitem_id = '" . (int)$qitem_id . "'");
    $this->db->query("DELETE FROM " . DB_PREFIX . "qitem_image_description WHERE qitem_id = '" . (int)$qitem_id . "'");
    $this->db->query("DELETE FROM " . DB_PREFIX . "qitem_image WHERE qitem_id = '" . (int)$qitem_id . "'");
    $this->db->query("DELETE FROM " . DB_PREFIX . "qitem_image_description WHERE qitem_id = '" . (int)$qitem_id . "'");
    $this->cache->delete('qitem');
    $this->event->trigger('post.admin.qitem.delete', $qitem_id);
  }

  public function getQitem($qitem_id) {
    $query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'qitem_id=" . (int)$qitem_id . "') AS keyword FROM " . DB_PREFIX . "qitem d LEFT JOIN " . DB_PREFIX . "qitem_description dd ON (d.qitem_id = dd.qitem_id) WHERE d.qitem_id = '" . (int)$qitem_id . "' AND dd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

    return $query->row;
  }

  public function getQitems($data = array()) {
    $sql = "SELECT * FROM " . DB_PREFIX . "qitem d LEFT JOIN " . DB_PREFIX . "qitem_description dd ON (d.qitem_id = dd.qitem_id) WHERE dd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

    if (!empty($data['filter_name'])) {
      $sql .= " AND dd.title LIKE '" . $this->db->escape($data['filter_title']) . "%'";
    }
    if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
      $sql .= " AND d.status = '" . (int)$data['filter_status'] . "'";
    }
    $sort_data = array(
      'dd.title',
      'd.date_added',
      'd.visibility'
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

  public function getQitemDescriptions($qitem_id) {
    $qitem_description_data = array();

    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "qitem_description WHERE qitem_id = '" . (int)$qitem_id . "'");

    foreach ($query->rows as $result) {
      $qitem_description_data[$result['language_id']] = array(
        'title' => $result['title'],
        'description'      => $result['description'],
        'address'          => $result['address'],
        'meta_title'       => $result['meta_title'],
        'meta_description' => $result['meta_description'],
        'meta_keyword'     => $result['meta_keyword']
      );
    }

    return $qitem_description_data;
  }

  public function getTotalQitems() {
    $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "qitem");

    return $query->row['total'];
  }
  public function getQitemImages($qitem_id) {
    $qitem_image_data = array();
    
    $qitem_image_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "qitem_image WHERE qitem_id = '" . (int)$qitem_id . "' ORDER BY qitem_image_id ASC");
    
    foreach ($qitem_image_query->rows as $qitem_image) {
      $qitem_image_description_data = array();
       
      $qitem_image_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "qitem_image_description WHERE qitem_image_id = '" . (int)$qitem_image['qitem_image_id'] . "' AND qitem_id = '" . (int)$qitem_id . "'");
      
      foreach ($qitem_image_description_query->rows as $qitem_image_description) {      
        $qitem_image_description_data[$qitem_image_description['language_id']] = array(
          'title' => $qitem_image_description['title']
        );
      }
    
      $qitem_image_data[] = array(
        'qitem_image_description'   => $qitem_image_description_data,
        'link'                      => $qitem_image['link'],
        'image'                     => $qitem_image['image'],
        'sort_order'          => $qitem_image['sort_order'],
      );
    }
    
    return $qitem_image_data;
  }
  public function getQitemQuestions($qitem_id) {
    $qitem_question_data = array();
    
    $qitem_question_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "qitem_question WHERE qitem_id = '" . (int)$qitem_id . "' ORDER BY qitem_question_id ASC");
    
    foreach ($qitem_question_query->rows as $qitem_question) {
      $qitem_question_description_data = array();
       
      $qitem_question_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "qitem_question_description WHERE qitem_question_id = '" . (int)$qitem_question['qitem_question_id'] . "' AND qitem_id = '" . (int)$qitem_id . "'");
      
      foreach ($qitem_question_description_query->rows as $qitem_question_description) {      
        $qitem_question_description_data[$qitem_question_description['language_id']] = array(
          'answer_title'    => $qitem_question_description['answer_title'],
          'answer_comment'  => $qitem_question_description['answer_comment']
        );
      }
    
      $qitem_question_data[] = array(
        'qitem_question_description'   => $qitem_question_description_data,
        'question_id'          => $qitem_question['question_id'],
        'image'                     => $qitem_question['image'],
        'sort_order'          => $qitem_question['sort_order'],
        'correct'          => $qitem_question['correct']
      );
    }
    
    return $qitem_question_data;
  }
  public function getQs($quiz_id) {
    $query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "qitem WHERE quiz_id = '".(int)$quiz_id."'");

    return $query->rows;
  }

}