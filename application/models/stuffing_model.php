<?php

class stuffingDB extends CI_Model {
    var $table = null;
    function stuffingDB()
    {
	    parent::__construct();
	    $this->stuffing = 'stuffing_';
	    $this->stuffingDetails = 'stuffing_details';
    }
    
    function addstuffingDetails() {
       $this->db->insert($this->stuffingDetails, $this->input->post('stuffing_details'));
    }
}
?>
