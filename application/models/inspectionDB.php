<?php
class InspectionDB extends CI_Model {
    var $inspection = null;
    var $inspectionDetails = null;
    function InspectionDB()
    {
	    parent::__construct();
	    $this->inspection = 'inspection';
	    $this->inspectionDetails = 'inspection_details';
    }
    function addGeneralDetails() {
      $data = $_POST;
      unset($data['add_inspection_general']);
      unset($data['ajax']);
      if($this->db->insert($this->inspection, $data)) {
        return $this->db->insert_id();
      }
      return 0;  
    }
    
    function getGeneralDetails($id) {
      $this->db->where('common_id', $id);
      $this->db->limit(1);
      $query = $this->db->get($this->inspection);
      return $query->row_array();
    }
    
    function updateGeneral() {
      $value = $_REQUEST['value'];
      $key_pair = $_REQUEST['id'];
      $key_pair = explode("-", $key_pair);
      $field = $key_pair[0];
      $id = $key_pair[1];
      $data[$field] = $value;
      $this->db->where('id', $id);
      $this->db->update($this->inspection, $data); 
      echo $value;
    }
    
    function updateDetails() {
      $value = $_REQUEST['value'];
      $key_pair = $_REQUEST['id'];
      $key_pair = explode("-", $key_pair);
      $field = $key_pair[0];
      $id = $key_pair[1];
      $data[$field] = $value;
      $this->db->where('id', $id);
      $this->db->update($this->inspectionDetails, $data); 
      echo $value;
    }
    
    function addDetails() {
      $data = $_POST;
      unset($data['add_inspection_details']);
      if($this->db->insert($this->inspectionDetails, $data)) {
        return $this->db->insert_id();
      }
      return 0;  
    }
    
    function deleteDetails($id = "") {
      if(empty($id)) {
        return 0;
      }
      $delete = $this->db->delete($this->inspectionDetails, array('id' => $id));
      return $delete ? 1 : 0;   
    }
    
    function singleDetails($id) {
      $this->db->where('id', $id);
      $query = $this->db->get($this->inspectionDetails);
      return $query->result();
    }
    
    function getDetailsList($common_id) {
      $this->db->where('common_id', $common_id);
      $query = $this->db->get($this->inspectionDetails);
      return $query->result();
    }
    
    
    
}
?>
