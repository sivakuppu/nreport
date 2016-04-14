<?php
class TobaccoDB extends CI_Model {
    function TobaccoDB()
    {
	    parent::__construct();
	    $this->tobacco = "tobacco";
      $this->tobaccoInvoice = "tobacco_invoice";
      $this->tobaccoDetails = "tobacco_details"; 
	  }
	  
	  function addGeneralDetails() {
  	   $data['common_id'] = $this->input->post('common_id');
  	   $data['place_of_stuffing'] = $this->input->post('place_of_stuffing');
  	   $data['start_date_of_stuffing'] = $this->input->post('start_date_of_stuffing');
  	   $data['end_date_of_stuffing'] = $this->input->post('end_date_of_stuffing');
  	   $data['port_of_discharge'] = $this->input->post('port_of_discharge');
  	   $data['description'] = $this->input->post('description');
  	   $data['official_seal'] = $this->input->post('official_seal');
  	   $data['liner_seal'] = $this->input->post('liner_seal');
  	   $data['remark'] = $this->input->post('remark');
  	   if(empty($data['common_id'])) {
        return 0;
       } 
       if($this->db->insert($this->tobacco, $data)) {
          return $this->db->insert_id();
       }
       return 0;
    }
    
    function addInvoiceDetails() {
     $data['common_id'] = $this->input->post('common_id');
	   $data['invoice_no'] = $this->input->post('invoice_no');
	   $data['invoice_date'] = $this->input->post('invoice_date');
	   $data['marks'] = $this->input->post('marks');
	   $data['shipper'] = $this->input->post('shipper');
	   $data['consignee'] = $this->input->post('consignee');
	   $data['gross_weight'] = $this->input->post('gross_weight');
	   $data['net_weight'] = $this->input->post('net_weight');
	   $data['no_of_package'] = $this->input->post('no_of_package');
	   $data['remark'] = $this->input->post('remark');
	   if(empty($data['invoice_no']) || empty($data['common_id'])) {
      return 0;
     } 
     if($this->db->insert($this->tobaccoInvoice, $data)) {
        return $this->db->insert_id();
     }
     return 0;
    }
	  
	  function addContainerDetails() {
	   $data = array(); 
	   $data['common_id'] = $this->input->post('common_id');
	   $data['container_no'] = $this->input->post('container_no');
	   $data['container_type'] = $this->input->post('container_type');
	   $data['line'] = $this->input->post('line');
	   $data['no_of_ctns'] = $this->input->post('no_of_ctns');
	   $data['gross_weight'] = $this->input->post('gross_weight');
	   $data['net_weight'] = $this->input->post('net_weight');
	   $data['stuffing_commenced'] = $_POST['stuffing_commenced'] ." ". $this->input->post('stuffing_commenced_hour').":". $this->input->post('stuffing_commenced_min') . ":00" ;
     $data['stuffing_completed'] = $this->input->post('stuffing_completed')." ".$this->input->post('stuffing_completed_hour').":".$this->input->post('stuffing_completed_min') . ":00" ;
	 $data['ptype'] = $this->input->post('pattern_type');
	 if($data['ptype'] == 2) {
		$pattern = $this->input->post('pattern2');
	 }
	 else {
		$pattern = $this->input->post('pattern'); 
	 }
	 
     $data['shipment'] = serialize($this->getShipment($pattern));
	 $data['stuffing_pattern'] = serialize($pattern);
     
     if(empty($data['container_no']) || empty($data['common_id'])) {
      return 0;
     } 
     if($this->db->insert($this->tobaccoDetails, $data)) {
        return $this->db->insert_id();
     }
     return 0;

    }
    
    function deleteInvoiceDetails($id) {
      if(empty($id)) {
        return 0;
      }
      $delete = $this->db->delete($this->tobaccoInvoice, array('id' => $id));
      return $delete ? 1 : 0;   
    }
    
    function deleteContainerDetails($id) {
      if(empty($id)) {
        return 0;
      }
      $delete = $this->db->delete($this->tobaccoDetails, array('id' => $id));
      return $delete ? 1 : 0; 
    }
    
  function getGeneralDetails($id) {
    $this->db->where('id', $id);
    $query = $this->db->get($this->tobacco);
    return $query->row();
  }
	
	function getInvoiceDetails($id) {
	  $this->db->where('id', $id);
    $query = $this->db->get($this->tobaccoInvoice);
    return $query->result();
  }

	function getContainerDetails($id) {
	  $this->db->where('id', $id);
    $query = $this->db->get($this->tobaccoDetails);
    return $query->result();
  }
  
  function getAllGeneralDetails($common_id) {
      $this->db->where('common_id', $common_id);
      $this->db->limit(1);
      $query = $this->db->get($this->tobacco);
      return $query->row();
  }
    
  function getAllInvoiceDetails($common_id) {
    $this->db->where('common_id', $common_id);
    $query = $this->db->get($this->tobaccoInvoice);
    return $query->result();
  }
  
  function getAllContainerDetails($common_id) {
    $this->db->where('common_id', $common_id);
    $query = $this->db->get($this->tobaccoDetails);
    return $query->result();
  }
  
  function getPatternFormData($id) {
    $this->db->select('stuffing_pattern');
    $this->db->where('id', $id);
    $query = $this->db->get($this->tobaccoDetails);
    return unserialize($query->row()->stuffing_pattern);
  }

  function getPatternType($id) {
    $this->db->select('ptype');
    $this->db->where('id', $id);
    $query = $this->db->get($this->tobaccoDetails);
    return $query->row()->ptype;
  }
  
  function updatePattern($id, $array) {
    $data['shipment'] = serialize($this->getShipment($array)); 
    $array = serialize($array);
    $data['stuffing_pattern'] = $array;
    $this->db->where('id', $id);
    return $this->db->update($this->tobaccoDetails, $data);
     
  }
  
  function updateGeneralDetails() {
      $value = $_REQUEST['value'];
      $key_pair = $_REQUEST['id'];
      $key_pair = explode("-", $key_pair);
      $field = $key_pair[0];
      $id = $key_pair[1];
      $data[$field] = $value;
      $this->db->where('id', $id);
      $this->db->update($this->tobacco, $data); 
      echo $value; 
  }
  
  function updateInvoiceDetails() {
      $value = $_REQUEST['value'];
      $key_pair = $_REQUEST['id'];
      $key_pair = explode("-", $key_pair);
      $field = $key_pair[0];
      $id = $key_pair[1];
      $data[$field] = $value;
      $this->db->where('id', $id);
      $this->db->update($this->tobaccoInvoice, $data); 
      echo $value; 
  }
  
  function updateContainerDetails() {
      $value = $_REQUEST['value'];
      $key_pair = $_REQUEST['id'];
      $key_pair = explode("-", $key_pair);
      $field = $key_pair[0];
      $id = $key_pair[1];
      $data[$field] = $value;
      $this->db->where('id', $id);
      $this->db->update($this->tobaccoDetails, $data); 
      echo  $field == 'container_type' ?  getContainerTypeText($value) : $value;
  }
  
  function getShipment($stuffing_pattern) {
  
   foreach($stuffing_pattern as $a) {
       foreach($a as $c) { 
        $b[] = $c;
       }
    }  
  
    sort($b); 
    $last = $b[0];
    $test = array(); 
    foreach($b as $key => $a) {
      if(($key+1) < count($b)) {
       if(((int) $b[$key + 1] - 1) != (int)$a ) {
          $count = ($a - $last) + 1;
          $test[] = array($last, $a, $count);  
          $last = $b[$key + 1];
       }
     }
     else {
          $count = ($a - $last) + 1;
          $test[] = array($last, $a, $count);
     }
    }
    return $test;
  }
   
    
}//end of the class  

?>
