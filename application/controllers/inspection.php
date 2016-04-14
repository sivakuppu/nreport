<?php
include 'common.php';
class Inspection extends Common {

  var $com = null;
  var $document = null; 
  var $common_id = null;
	function Inspection()
	{
	  parent::Common(); 
	  $this->load->model('inspectionDB');
    //$this->output->enable_profiler(TRUE);
    $this->common_id = $this->session->userdata('common_id');
    if(empty($this->common_id)) {
      redirect('common');
    }
  }
  
  function index(){
    $data['common_id'] = $this->common_id;
    $data['report_no'] = $this->session->userdata('report_no');
    $data['form_action'] = "inspection_report/generate/" .$this->common_id;
    $data['i_general'] = $this->getGeneral($this->common_id);
    $data['i_list'] = $this->getlist($this->common_id);
    $data['common_header'] = $this->getCommonHeader();
    $this->load->view('inspection/inspection', $data);
  }
  
  function edit() {

  }
  
  function add()
  { 
    $ajax = $this->input->post('ajax');
    $id = $this->inspectionDB->addGeneralDetails();
    
    if($ajax) {
      if($id > 0) {
        echo $this->getGeneral($this->common_id);
      }
    }
    else {
      redirect('index');
    }
  } 
  
  function getGeneral($id) {
     $data['general_details'] = $this->inspectionDB->getGeneralDetails($id);
     if(!empty($data['general_details'])) {
      return $this->load->view('inspection/i_g_content', $data, true);
     }
     else {
      return "";
     } 
  }
  
  function getList($id) {
    $data['results'] = $this->inspectionDB->getDetailsList($id);  
    $result['inpection_tbody'] = $this->load->view('inspection/i_d_single', $data, true);
    return $this->load->view('inspection/i_c_content', $result, true);
  }
  
  function gedit() {
    $this->inspectionDB->updateGeneral();
  }
  
  function dedit() {
    $this->inspectionDB->updateDetails();
  }
  
  function addDetails() {
    $id = $this->inspectionDB->addDetails();
    if($id > 0 ) {
      $data['results'] = $this->inspectionDB->singleDetails($id);  
      echo $this->load->view('inspection/i_d_single', $data, true);
    }
  }
  
  function deleteDetails($id) {
    echo $this->inspectionDB->deleteDetails($id);
  }
}//end of class
 