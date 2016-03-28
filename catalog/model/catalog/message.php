<?php
class ModelCatalogMessage extends Model {
#===============================================================================
	public function addMessage($data=array()){
    $message_id = sha1(uniqid(microtime(true), true));
		$this->db->query("INSERT INTO " . DB_PREFIX . "message SET
        message_id = '" . $this->db->escape($message_id) . "',
        name = '" . $this->db->escape($data['name']) . "',
        age = '" . $this->db->escape($data['age']) . "',
        message = '" . $this->db->escape($data['message']) . "',
        ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "',
		    date_added = NOW()");

		//возврашаем rshare_id
		return true;
	}
}
