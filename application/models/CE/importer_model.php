<?php

class Importer_model extends CI_Model {
  var $table = NULL;
	function __construct()
	{
		parent::__construct();
		$this->table = 'importer';
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
	
	function search($q) {
	 $this->db->select('id,name');
	 $this->db->like('name', $q);
	 $query = $this->db->get($this->table);
	 $result = $query->result();
	 $str = "";
	 if(!empty($result)) {
	   foreach($result as $row) {
	      $str .= $row->name."|".$row->id."\n"; 
	   }
   }
	 return $str;
  }
  
  function get_search_data($text) {
	 $this->db->where('name', $text);
	 $this->db->limit(1);
	 $query = $this->db->get($this->table);
	 return $query->row();
  }
  
  function update($data, $id) {
    $this->db->where('id', $id);
    $this->db->update($this->table, $data);
  }
   function getName($id, $address_flag = true){
      if($id > 0 ) {
          $this->db->where('id', $id);
          $query = $this->db->get($this->table);
          $result = $query->row();
          if(!empty($result)) {
            if($address_flag) {
              $address = "";
              $address = $result->name;
              $address .= !empty($result->address1) ?  ", {$result->address1}" : "";
              $address .= !empty($result->address2) ?  ", {$result->address2}" : "";
              $address .= !empty($result->address3) ?  ", {$result->address3}" : "";
              $address .= !empty($result->city) ?  ", {$result->city}" : "";
              $address .= (!empty($result->city) && !empty($result->pincode)) ?  " - " : " ";
              $address .= !empty($result->pin_code) ?  "{$result->pin_code}" : "";
              $address .= !empty($result->contry) ?  ", {$result->contry}" : " ";
              return htmlspecialchars_decode($address);
            }
            return htmlspecialchars_decode($result->name);
          }
      }
      return "";
  }
}
?>