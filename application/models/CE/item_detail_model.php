<?php

class Item_detail_model extends CI_Model {  
  var $table = NULL;
	function __construct()
	{
		parent::__construct();
		$this->table = "item_detail";  
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
			return TRUE;
		}
		
		return FALSE;
	}
	
	function getAllRow($certificate_id) {     
	 $this->db->where('certificate_id', $certificate_id);
	 $query = $this->db->get($this->table);
	 return $query->result();
  }
  
  function update(){
      $value = $_REQUEST['value'];
      $key_pair = $_REQUEST['id'];
      $key_pair = explode("-", $key_pair);
      $field = $key_pair[0];
      $id = $key_pair[1];
      $data[$field] = $value;
      $this->db->where('id', $id);
      $this->db->update($this->table, $data); 
      echo $value; 
  }
  
  function search($search) {
    extract($search);
    $flag = false;
    if($item_name)  {
      $this->db->like('item_name', $item_name, 'both');
      $flag = true;
    }
    if($specification)  {
      $this->db->like('specification', $specification, 'both');
      $flag = true;
    } 
    if($make)  {
      $this->db->like('make', $make, 'both');
      $flag = true;
    } 
    if(!$flag) {
      return null;
    }
    $query = $this->db->get($this->table);
    return $query->result();
     
  }
  function delete($id) {
    $response =  $this->db->delete($this->table, array('id' => $id));
    echo $response ? 1 : 0;       
  }
}
?>