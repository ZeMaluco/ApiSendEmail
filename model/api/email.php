<?php
class ModelApiEmail extends Model {

    public function addEmail($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "email SET  id = '" . (int)$data['id'] . "', name = '" . $this->db->escape($data['nome']) . "', data = '" . $this->db->escape($data['data']) . "', email = '" . $this->db->escape($data['email']) . "', descricao = '" . $this->db->escape($data['descricao'])  . "', date_added = NOW()");
    }

}
