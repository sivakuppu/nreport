<?php

class Category_model extends CI_Model {
  var $table = NULL;
	function __construct()
	{
		parent::__construct();
		$this->table = "category";
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
	
	function getAll() {
	 $query = $this->db->get($this->table);
	 return $query->result();
  }
  
  function getCategoryDropdown($id = 0) {
    $categories = $this->getAll();
    $option = "";  
    if(!empty($categories)) {
        foreach($categories as $category) {
         $option .= "<option ";
    	   $option .= $id == $category->id ? " selected " : "";
    	   $option .= "value='" .$category->id. "' >";
    	   $option .= $category->category_name;
    	   $option .= "</option>";
  	   }
    }
    return $option;
  }
}
?>