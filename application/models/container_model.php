<?php
class Container_model extends CI_Model {
    var $id =  '';
    var $file_id =  '';
    var $number =  '';
    var $size =  '';
    var $liner =  '';
    var $no_of_carton =  '';
    var $gross_weight =  '';
    var $net_weight =  '';
    var $commenced =  '';
    var $completed =  '';
    var $p_from =  '';
    var $p_to =  '';
    var $pattern = '';

    function Container_model()
    {
	    parent::__construct();
	    //$this->table = 'container';
    }

    function insert() {
      $this->id = null;
      $this->file_id = $_POST['file_id'];
      $this->number = $_POST['number'];
      $this->size = $_POST['size'];
      $this->liner = $_POST['liner'];
      $this->no_of_carton = $_POST['no_of_carton'];
      $this->gross_weight = $_POST['gross_weight'];
      $this->net_weight = $_POST['net_weight'];
      $this->commenced = $_POST['commenced'];
      $this->completed = $_POST['completed'];
      $this->p_from =  $_POST['p_from'];
      $this->p_to =  $_POST['p_to'];
      $this->pattern = serialize($_POST['pattern']);           
      $this->db->insert('container', $this);
      $file = $this->db->insert_id();
      return $file > 0 ? $file : null;
    }

    function getpattern($id) {
	 $this->db->select('pattern'); 
	 $this->db->where('id', $id);   
	 $query = $this->db->get('container');
         return $query->row();
      
    }
    
}
?>