<?php

class Item_model extends CI_Model {
  var $table = NULL;
	function __construct()
	{
		parent::__construct();
		$this->table = "item";
	}
	
	//  --------------------------------------------------------------------

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
		function search($q) {
	 $this->db->select('id,item_name');
	 $this->db->like('item_name', $q);
	 $query = $this->db->get($this->table);
	 $result = $query->result();
	 $str = "";
	 if(!empty($result)) {
	   foreach($result as $row) {
	     $str .= $row->item_name."|".$row->id."\n"; 
	   }
   }
	 return $str;
  }
  
  function get_search_data($item_id) {
	 $this->db->where('id', $item_id);
	 $this->db->limit(1);
	 $query = $this->db->get($this->table);
	 return $query->row();
  }
  
  function update($data, $id) {
    $this->db->where('id', $id);
    $this->db->update($this->table, $data);
    return;
  }
}

