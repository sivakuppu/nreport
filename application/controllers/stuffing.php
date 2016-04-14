<?php
include "common.php";
class Stuffing extends Common {

  var $com = null;
  var $document = null; 
	function Stuffing()
	{
	  parent::Common();
    $common_id = $this->session->userdata('common_id');
    if(empty($common_id) || $common_id == 0) {
      redirect('common');
    } 
	  $this->load->model('stuffingDB');
	  
    //$this->output->enable_profiler(TRUE);
  }
  
  function updateGeneral() {
    $this->stuffingDB->updateGeneral();
  }
  
  function updateDetails() {
    $this->stuffingDB->updateDetails();
  }
  
  function deleteDetails($id) {
    echo $this->stuffingDB->deleteDetails($id);
  }
  
  function index()
  { // BEGIN function index
      $common_id = $this->session->userdata('common_id');
      $data['report_no'] = $this->session->userdata('report_no');
      $data['common_id'] = $common_id;
      $general = $this->getStuffing($common_id);
      
      if(empty($general)) {
        $data['container_type'] = $this->getContainerType();
        $data['general_table'] = ""; 
      }
      else {
        $a = array();
        $a['general'] = $this->getStuffing($common_id);
  	    $a['container_type'] = $this->getContainerType($a['general']['number_of_container'], 1, $a['general']['id']);
        $data['general_table'] = $this->load->view('stuffing/s_general_table', $a, true);
      }
      
      $detail = $this->stuffingDB->getContainerDetails($common_id);
      if(empty($detail)) {
        $data['detail_table'] = ""; 
      }
      else {
        $a = array();
        $a['results'] = $detail;
        $data['detail_table'] = $this->load->view('stuffing/s_detail_table', $a, true);
      }
      $g = array();
      $g['container_type'] = $this->getContainerType();
      $data['general_form'] = $this->load->view('stuffing/s_general_form', $g, true); 
      $data['detail_form'] = $this->load->view('stuffing/s_detail_form', '', true);
      $data['form_action'] = "stuffing/generate/" .$data['common_id'];
      $data['common_header'] = $this->getCommonHeader();
      $this->load->view('stuffing/stuffing', $data);
  } // END function index
 
  function getStuffing($common_id) {
    return $this->stuffingDB->getStuffing($common_id, true, false);
  }
  
  function addStuffing() {
    $id = $this->stuffingDB->addStuffing();
    if($id > 0) {  
  	   $common_id = $this->session->userdata('common_id');
  	   $data['general'] = $this->getStuffing($common_id);
  	   $data['container_type'] = $this->getContainerType($data['general']['number_of_container'], 1, $data['general']['id']);
  	   echo $this->load->view('stuffing/s_general_table',$data, true); 
    } 
  }
  
  function updateStuffing($id) {
    $id = $this->stuffingDB->updateStuffing($id);
  }
  
  
  function addStuffingDetails()
  { // BEGIN function addStuffingDetails
  	$id = $this->stuffingDB->addStuffingDetails();
  	if($id > 0) {
  	   $a = array();
       $a['results'][] = $this->stuffingDB->getSingleDetail($id);   	   
  	   echo $this->load->view('stuffing/s_detail_table', $a, true); 
    } 
  	
  } // END function addStuffingDetails
  
  function generate($generate_id)
  { // BEGIN function generate
    $report = $this->commonDB->getReport($generate_id);
    $common_id = $report->id;
    $report_no = $report->report_no;
    $client_id = $report->client_id;
    $client_refer_id = $report->client_refer_id;
    $report_date = $report->created_date_1 ? $report->created_date_1 : date("d.m.Y");
    $c_f_agent = $this->getClientName($client_id);
    $c_f_refer_agent = $client_refer_id > 0 ? $this->getClientName($client_refer_id , true) : "";
    $agent = $c_f_agent ." " . $c_f_refer_agent;
    $file_name = str_replace("/","_", $report_no);
    
    $value = $this->stuffingDB->getStuffing($common_id, true);
    extract($value);
    $number_of_container =  $this->getContainerTypeText($number_of_container);    
    $this->word();
    $this->getHeader(SR_HEADING);
    $this->getReportNo($report_no, $report_date);
    $this->getParagraph(sprintf(PARA_1, $agent, $place_of_survey,$date_of_survey,$number_of_container), false, "", 6,6);
    $stuffing = array();
    $result = $this->stuffingDB->getContainerDetails($common_id);
    if(!empty($result)) {    
      $stuffing[] = array("S.B No & DATE", "MARKS & NOS", "SHIPPER", "CONSIGNEE", "GR.WT/Kgs", "NO OF PKGS", "MEASURE-MENT IN CBM", "CBM", "INSPECTION CNTS NOS");
      $total_gross_weight = 0;
      $total_no_of_package = 0;
      $total_cbm = 0;
      foreach($result as $key => $value){
        $local_array = array();
        $total_gross_weight =  $total_gross_weight + round($value->gross_weight, 3);
        $total_no_of_package = $total_no_of_package + $value->no_of_packages;
        $cmb = $value->no_of_packages * (($value->length * $value->breath * $value->height) / 1000000);
        $cmb = round($cmb, 3);
        $total_cbm = $total_cbm + $cmb;        
        $local_array[] = $value->s_b_no . " " . $value->new_date;//date("d.m.y",$value->date);
        $local_array[] = $value->marks;
        $local_array[] = $value->shipper;
        $local_array[] = $value->consignee;
        $local_array[] = round($value->gross_weight, 3);
        $local_array[] = $value->no_of_packages;
        $local_array[] = $value->length."x".$value->breath."x".$value->height;
        $local_array[] = $cmb;
        $local_array[] = $value->inspection;
        $stuffing[] = $local_array;     
      }
      $stuffing[] = array("","","","TOTAL",$total_gross_weight, $total_no_of_package,"", $total_cbm, "");
      
    } 
    
    $general = array();  
    $general[] = array("Vessel Name", $vessel_name);
    $general[] = array("Voyage Number", $voyage_number);
    $general[] = array("Container Number", $container_number ."/".$number_of_container); 
    $general[] = array("Port of Shipment", $port_of_shipment); 
    $general[] = array("Port of Discharge", $port_of_discharge); 
    $general[] = array("Total Cargo Cubics", $total_cbm);
    $general[] = array("Description of Cargo", $description);
    $general[] = array("Total Packages", $total_no_of_package); 
    $general[] = array("C & F Agent", $c_f_agent);
 	  $this->generateTable($general);
    $this->getParagraph(PARA_2, false,"",6,6);
    $this->getParagraph(PARA_3,false,"",0,6);
    if(!empty($stuffing)) {
      $this->generateHeaderTable($stuffing);
    }
    $this->getParagraph("REMARKS", true,"",6,0);
    $this->getParagraph(sprintf(REMARKS, $total_no_of_package, $official_seal, $liner_seal), false,"",6,6);
    $this->getParagraph(sprintf("STUFFING COMMENCED AT: %s Hrs. On %s", $commenced_time, $commenced_date));
    $this->getParagraph(sprintf("STUFFING COMPLETED AT: %s Hrs. On %s", $completed_time, $completed_date));
    $this->getFirstFooter();
    $this->getSecondFooter();
    $this->getThirdFooter();
    $status = true; 
    try {
      $month = date('M');
      $month = strtoupper($month);
      $this->saveAs("NES/$month/$file_name.doc");
     }
    catch(Exception $e) {
      $status = false;
      echo $e->getmessage();

    } 
    echo $this->getStatus($status,$report_no,$id,$file_name);
    $this->close();
    
  } // END function generate
  
  
  
  }
?>
