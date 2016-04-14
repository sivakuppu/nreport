<?php
class file extends CI_Model {
    var $table = null;
    function file()
    {
	    parent::__construct();
	    $this->table = 'all_file';
    }

    function insert($data) {
      $this->db->set('status', INSERT_FILE_STATUS);
      $this->db->set('date', 'NOW()', FALSE);	
      $this->db->insert($this->table, $data);
      $file = $this->db->insert_id();
      return $file > 0 ? $file : null;
    }

    function exists($type, $text) {
      $this->db->where('type', $type); 
      $this->db->where('file_id', $text); 
      $query = $this->db->get($this->table);
      if ($query->num_rows() > 0) {
	$query->result_row();
      }
      else {
	return null;
      }
    }

    function update() {
    }
}
?>