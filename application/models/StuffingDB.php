<?php

class StuffingDB extends CI_Model {
    var $stuffing = null;
    var $stuffingDetails = null;
    function StuffingDB()
    {
	    parent::__construct();
	    $this->stuffing = 'stuffing';
	    $this->stuffingDetails = 'stuffing_details';
    }
    
    function deleteDetails($id = "") {
      if(empty($id)) {
        return 0;
      }
      $delete = $this->db->delete($this->stuffingDetails, array('id' => $id));
      return $delete ? 1 : 0;   
    }
    
    function updateDetails() {
      $value = $_REQUEST['value'];
      $key_pair = $_REQUEST['id'];
      $key_pair = explode("-", $key_pair);
      $field = $key_pair[0];
      $id = $key_pair[1];
      $data = array();  
      if($field == "measurement"){
        list($length,$breath,$height) = explode("x", $value);
        $data['length'] = $length;
        $data['breath'] = $breath;
        $data['height'] = $height;  
      }
      else{
        $data[$field] = $value;
      } 
      $this->db->where('id', $id);
      $this->db->update($this->stuffingDetails, $data); 
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
      $this->db->update($this->stuffing, $data); 
      echo $value;
    }
    
    function getStuffing($common_id, $array = false, $fields = true) {
      $select = $fields ? " , DATE_FORMAT(date_of_survey,'%d.%m.%Y') as date_of_survey, DATE_FORMAT(stuffing_commenced,'%d.%m.%Y') as commenced_date ,DATE_FORMAT(stuffing_completed,'%d.%m.%Y') as completed_date, TIME(stuffing_commenced) as commenced_time,  TIME(stuffing_commenced) as completed_time " : "";
      $sql = "SELECT * $select FROM ". $this->stuffing . " WHERE common_id= $common_id";
      $query = $this->db->query($sql);
      return $array ? $query->row_array() : $query->row();
    }

    function addStuffing() {
        $data['common_id'] = $this->input->post('common_id');
        $data['place_of_survey'] = $this->input->post('place_of_survey');
        $data['date_of_survey'] = $this->input->post('date_of_survey');
        $data['number_of_container'] = $this->input->post('number_of_container');
        $data['vessel_name'] = $this->input->post('vessel_name');
        $data['voyage_number'] = $this->input->post('voyage_number');
        $data['container_number'] = $this->input->post('container_number');
        $data['port_of_shipment'] = $this->input->post('port_of_shipment');
        $data['port_of_discharge'] = $this->input->post('port_of_discharge');
        $data['description'] = $this->input->post('description');
        $data['stuffing_commenced'] = $_POST['stuffing_commenced'] ." ". $this->input->post('stuffing_commenced_hour').":". $this->input->post('stuffing_commenced_min') . ":00" ;
        $data['stuffing_completed'] = $this->input->post('stuffing_completed')." ".$this->input->post('stuffing_completed_hour').":".$this->input->post('stuffing_completed_min') . ":00" ;
        $data['official_seal'] = $this->input->post('official_seal');
        $data['liner_seal'] = $this->input->post('liner_seal');
        $data['remark'] = $this->input->post('remark', true); 
        $data['created_date'] = date("y-m-d");

          if($this->db->insert($this->stuffing, $data)) {
            return $this->db->insert_id();
          }
        return 0;
    }
    
    function updateStuffing($action = "") {
        $base_report_no = "NES/%s/S/%s/10-11";
        $report_no = $this->input->post('report_no');
        $current_id = $this->input->post('current_id'); 
        $data['report_no'] = strtoupper(sprintf($base_report_no, $report_no ,$current_id));
        //$data['agent'] = $this->input->post('agent_id');
        if($report_no == "SCH") {
            $data['agent'] = 1;
        }
        else if($report_no == "LEP"){
            $data['agent'] = 2;
        }
        $data['place_of_survey'] = $this->input->post('place_of_survey');
        $data['date_of_survey'] = $this->input->post('date_of_survey');
        $data['number_of_container'] = $this->input->post('number_of_container');
        $data['vessel_name'] = $this->input->post('vessel_name');
        $data['voyage_number'] = $this->input->post('voyage_number');
        $data['container_number'] = $this->input->post('container_number');
        $data['port_of_shipment'] = $this->input->post('port_of_shipment');
        $data['port_of_discharge'] = $this->input->post('port_of_discharge');
        //$data['total_cargo_cubics'] = $this->input->post('total_cargo_cubics');
        $data['description'] = $this->input->post('description');
        //$data['total_packages'] = $this->input->post('total_packages');
        $data['stuffing_commenced'] = $this->input->post('stuffing_commenced');
        $data['stuffing_completed'] = $this->input->post('stuffing_completed');
        $data['official_seal'] = $this->input->post('official_seal');
        $data['liner_seal'] = $this->input->post('liner_seal');
        $data['remark'] = $this->input->post('remark'); 
        $data['created_date'] = date("y-m-d");
        if($action > 0 ) {
           $this->db->where('id', $action);
           $this->db->update($this->stuffing, $data);  
        }
        
    }
    
    
    
    function addStuffingDetails() {
      if(!$this->input->post('s_b_no')) {
        return;
      }
      $data = array('s_b_no' => $this->input->post('s_b_no'),
      'date' => $this->input->post('date'),
      'marks' => $this->input->post('marks'),
      'shipper' => $this->input->post('shipper'),
      'consignee' => $this->input->post('consignee'),
      'gross_weight' => $this->input->post('gross_weight'),
      'no_of_packages' => $this->input->post('no_of_packages'),
      'length' => $this->input->post('length'),
      'breath' => $this->input->post('breath'),
      'height' => $this->input->post('height'),
      'inspection' => $this->input->post('inspection'),
      'common_id' => $this->input->post('common_id'));
      if($this->db->insert($this->stuffingDetails, $data)) {
        return $this->db->insert_id();
      }
      return 0;
    }
    
    function getContainerDetails($common_id) {
      $sql = "SELECT *, DATE_FORMAT(date, '%d.%m.%Y') AS new_date FROM ". $this->stuffingDetails. " WHERE common_id = $common_id";      
      $query = $this->db->query($sql);
      return $query->result();  
    }
    
    function getSingleDetail($id) {
      $this->db->where('id', $id);
      $query = $this->db->get($this->stuffingDetails);
      return $query->row();
    }
}
?>
