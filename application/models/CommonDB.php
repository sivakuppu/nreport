<?php
class CommonDB extends CI_Model {
    function CommonDB()
    {
	    parent::__construct();
	    $this->common = 'common';
	    $this->client = 'client';
	    $this->stuffing = 'stuffing';
	    $this->inspection = 'inspection';
	    $this->stuffingDetails = 'stuffing_details';
	    $this->inspectionDetails = 'inspection_details';
	    $this->table = array(1 => 'stuffing', 2 => 'inspection');
    } 
    
    function getReport($id) {
      $sql = "SELECT *, DATE_FORMAT(created_date, '%d.%m.%Y') as created_date_1  FROM ".$this->common ." WHERE id = $id";
      $query = $this->db->query($sql);
      return $query->row();
    }
    
    function getByReportNo($report_no) {
      $sql = "SELECT * FROM ".$this->common ." WHERE report_no = '$report_no'";
      $query = $this->db->query($sql);
      return $query->row();
    }
    
    function getSearchData($date) {
      $sql = "SELECT * FROM ".$this->common ." WHERE created_date = '$date'";
      $query = $this->db->query($sql);
      return $query->result();
    }
     
    function getCountOfReport() {
      $sql = "SELECT type, count(c.id) as serial FROM {$this->common} as c INNER JOIN {$this->client} as a ON (c.client_id = a.id) GROUP BY c.report_type, c.client_id";
      $query = $this->db->query($sql);
      $result = $query->result();
      if(!empty($result)) {
         $return = array(); 
         foreach($result as $value) {
             $return[$value->type] = $value->count; 
         }
      }
      else {
         $return = 1;
      }
      return $return;        
    }
        
    function getLastReport($report_type = '', $client_id = '') {
      $client_id_array = array($client_id);
      $client = $this->getClientDetails($client_id);
      if(!empty($client) && $client->code == "LEP" ) {
      	$clients = $this->getAllClientsByCode();
      	$client_id_list = -1;
      	if(!empty($clients)) {
      	    foreach($clients as $client) {
      	      $client_id_array[] = $client->id;
      	    }
      	}

      }
      $this->db->select('report_no');
      $this->db->where('report_type', $report_type);
      // Report Number Changes 
      $this->db->where_in('client_id', $client_id_array);
      $this->db->order_by('timestamp', 'desc');
      $this->db->limit(1);
      $query = $this->db->get($this->common);
      if($query->num_rows() > 0) { 
        return $query->row()->report_no;
      }
      else {
        return 1;
      }    
    }
    
    function addReport($report_no, $date = '') {
      $date = $date ? $date : date('Y-m-d');
      $data['client_id'] = $this->session->userdata('client_id');
      $data['report_type'] = $this->session->userdata('report_type');
      $data['report_no'] = $report_no;
      $data['created_date'] = $date;
      if($this->db->insert($this->common, $data)) {
       return $this->db->insert_id();    
      }
      return 0;
    }
    
    function getClientCode($client_id) {
       $this->db->where('id', $client_id);
       $query = $this->db->get($this->client);
       if($query->num_rows() > 0) {
        return $query->row()->code; 
       }
       return false;
    }
    
    function getClientDetails($client_id) {
       $this->db->where('id', $client_id);
       $query = $this->db->get($this->client);
       if($query->num_rows() > 0) {
        return $query->row(); 
       }
       return false;
    }
    
    function getClients() {
      $q = $_REQUEST['q'];
      $this->db->distinct();
      $this->db->like('name', $q);
      $query = $this->db->get($this->client);
      return $query->result();
    }
     function getAllClientsByCode($code = "LEP") {
      $this->db->distinct();
      $this->db->where('code', $code);
      $query = $this->db->get($this->client);
      return $query->result();
    }

    function getAllClients() {
      $this->db->distinct();
      $query = $this->db->get($this->client);
      return $query->result();
    }
    
    function getPlaceOfSurvey($id) {
      $q = $_REQUEST['q'];
      $this->db->distinct();
      $this->db->select('place_of_survey');
      $this->db->like('place_of_survey', $q);
      $query = $this->db->get($this->table[$id]);
      return $query->result();
    }
    
    function deleteFile($id){
      $this->db->delete($this->common, array('id' => $id));
      $report_type = $this->session->userdata('report_type');
        switch($report_type) {
          case 1:
            $this->db->delete($this->stuffing, array('common_id' => $id));
            $this->db->delete($this->stuffingDetails, array('common_id' => $id));
            break;
          case 2:
            $this->db->delete($this->inspection, array('common_id' => $id));
            $this->db->delete($this->inspectionDetails, array('common_id' => $id));
            break;
      }
    }
    function getDateFormat($date, $format) {
      $sql = "SELECT DATE_FORMAT('$date', '$format') as date ";
      $query = $this->db->query($sql);
      return $query->row()->date;
    }
    
}// end of the class
?>
