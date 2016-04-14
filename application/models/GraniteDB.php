<?php

class GraniteDB extends CI_Model {
    var $granite = null;
    var $graniteDetails = null;
    function GraniteDB()
    {
	    parent::__construct();
	    $this->granite = 'granite';
	    $this->graniteDetails = 'granite_details';
    }
    
    function deleteDetails($id = "") {
      if(empty($id)) {
        return 0;
      }
      $delete = $this->db->delete($this->graniteDetails, array('id' => $id));
      return $delete ? 1 : 0;   
    }
    
    function updateDetails() {
      $value = $_REQUEST['value'];
      $key_pair = $_REQUEST['id'];
      $key_pair = explode("-", $key_pair);
      $field = $key_pair[0];
      $id = $key_pair[1];
      $data = array();  
      $data[$field] = $value;
      $this->db->where('id', $id);
      $this->db->update($this->graniteDetails, $data); 
      echo $value;
    }
    
    function updateGeneral() {
      $value = $_REQUEST['value'];
      $key_pair = $_REQUEST['id'];
      $key_pair = explode("-", $key_pair);
      $field = $key_pair[0];
      $id = $key_pair[1];
      $data[$field] = $value;
      $this->db->where('id', $id);
      $this->db->update($this->granite, $data); 
      echo $value;
    }
    
    function getGranite($common_id, $array = false, $fields = true) {
      $sql = "SELECT * FROM ". $this->granite . " WHERE common_id= $common_id";
      $query = $this->db->query($sql);
      return $array ? $query->row_array() : $query->row();
    }

    function addGranite() {
        $data['common_id'] = $this->input->post('common_id');
        $data['container_type'] = $this->input->post('container_type');
        $data['place_of_survey'] = $this->input->post('place_of_survey');
        $data['date_of_survey'] = $this->input->post('date_of_survey');
        $data['description_of_cargo'] = $this->input->post('description_of_cargo');
        $data['vessel_name'] = $this->input->post('vessel_name');
        $data['voyage_no'] = $this->input->post('voyage_no');
        $data['exporter'] = $this->input->post('exporter');
        $data['consignee'] = $this->input->post('consignee');
        $data['invoice_no'] = $this->input->post('invoice_no');
        $data['marks_blocks'] = $this->input->post('marks_blocks');
        $data['port_of_loading'] = $_POST['port_of_loading'];
        $data['shipping_bill_no'] = $this->input->post('shipping_bill_no');
        $data['port_of_discharge'] = $this->input->post('port_of_discharge');
        $data['created_date'] = date("y-m-d");
        if($this->db->insert($this->granite, $data)) {
           return $this->db->insert_id();
        }
        return 0;
    }
   
    function addGraniteDetails() {
      if(!$this->input->post('container_no')) {
        return;
      }
      $data = array('container_no' => $this->input->post('container_no'),
      'gross_weight' => $this->input->post('gross_weight'),
      'payload_weight' => $this->input->post('payload_weight'),
      'cha_weight' => $this->input->post('cha_weight'),
      'no_of_blocks' => $this->input->post('no_of_blocks'),
      'blocks_numbers' => $this->input->post('blocks_numbers'),
      'customer_seal' => $this->input->post('customer_seal'),
      'line_seal' => $this->input->post('line_seal'),
      'year_of_mfg' => $this->input->post('year_of_mfg'),
      'flb_lenght' => $this->input->post('flb_lenght'),
      'flb_height' => $this->input->post('flb_height'),
      'flb_breath' => $this->input->post('flb_breath'),
      'flb_count' => $this->input->post('flb_count'),
      'front_end_wooden' => $this->input->post('front_end_wooden'),
      'rear_end_wooden' => $this->input->post('rear_end_wooden'),
      'left_side_framework' => $this->input->post('left_side_framework'),
      'left_side_bolster' => $this->input->post('left_side_bolster'),
      'right_side_framework' => $this->input->post('right_side_framework'),
      'right_side_bolster' => $this->input->post('right_side_bolster'),
      'common_id' => $this->input->post('common_id'));
      if($this->db->insert($this->graniteDetails, $data)) {
        return $this->db->insert_id();
      }
      return 0;
    }
    
    function getContainerDetails($common_id) {
      $sql = "SELECT * FROM ". $this->graniteDetails. " WHERE common_id = $common_id";      
      $query = $this->db->query($sql);
      return $query->result();  
    }
    
    function getSingleDetail($id) {
      $this->db->where('id', $id);
      $query = $this->db->get($this->graniteDetails);
      return $query->row();
    }
    
    function updateContainerDetails() {
      $value = $_REQUEST['value'];
      $key_pair = $_REQUEST['id'];
      $key_pair = explode("-", $key_pair);
      $field = $key_pair[0];
      $id = $key_pair[1];
      $data[$field] = $value;
      $this->db->where('id', $id);
      $this->db->update($this->granite, $data); 
      echo  $field == 'container_type' ?  getContainerTypeText($value) : $value;
  }
}
?>
