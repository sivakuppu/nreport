<?php

class Certificate_model extends CI_Model { 
  var $table = NULL;
	function __construct()
	{
		parent::__construct();
		$this->table = "certificate";
	}
	
	// --------------------------------------------------------------------

      /** 
       * function SaveForm()
       *
       * insert form data
       * @param $form_data - array
       * @return Bool - TRUE or FALSE
       */

	function SaveForm($form_data)
	{
		$this->db->insert($this->table, $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			return $this->db->insert_id();
		}
		
		return FALSE;
	}
	
	function getData($id) {
	 if($id > 0) {
	   $this->db->where('id', $id);
	   $query = $this->db->get($this->table);
	   return $query->row();
	 }
	 return array();
  } 
	
	function UpdateForm($form_data , $id) {
	 $this->db->where('id', $id);
	 $this->db->update($this->table, $form_data);
  }
  
  function search($report_no) {
   $this->db->where('certificate_of_inspection_no', $report_no);
	 $query = $this->db->get($this->table);
	 $result = $query->row();
	 return !empty($result) ? $result->id : 0;
  }
  
  function delete($id) {            
    return $this->db->delete($this->table, array('id' => $id)); 
  }
  
  function getLastId() {
   $this->db->order_by('id', 'DESC');
   $this->db->limit(1); 
   $query = $this->db->get($this->table);
	return $query->row()->certificate_of_inspection_no;
  }
  
}
?>