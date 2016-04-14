<?php
include "common.php";

class Granite extends Common {

  
	function Granite()
	{
	  parent::Common();
    $common_id = $this->session->userdata('common_id');
    if(empty($common_id) || $common_id == 0) {
      redirect('common');
    } 
	  $this->load->model('graniteDB');
    //$this->output->enable_profiler(TRUE);
  }
  
  function updateGeneral() {
    $this->graniteDB->updateGeneral();
  }
  
  function updateDetails() {
    $this->graniteDB->updateDetails();
  }
  
  function deleteDetails($id) {
    echo $this->graniteDB->deleteDetails($id);
  }
  
  function index()
  { // BEGIN function index
      $common_id = $this->session->userdata('common_id');
      $data['report_no'] = $this->session->userdata('report_no');
      $data['common_id'] = $common_id;
      $general = $this->getGranite($common_id);
      
      if(empty($general)) {
        $data['container_type'] = $this->getContainerType();
        $data['general_table'] = ""; 
      }
      else {
        $a = array();
        $a['general'] = $this->getGranite($common_id);
  	    $a['container_type'] = $this->getContainerType($a['general']['container_type'], 1, $a['general']['id']);
        $data['general_table'] = $this->load->view('granite/g_general_table', $a, true);
      }
      
      $detail = $this->graniteDB->getContainerDetails($common_id);
      if(empty($detail)) {
        $data['detail_table'] = ""; 
      }
      else {
        $a = array();
        $a['results'] = $detail;
        $data['detail_table'] = $this->load->view('granite/g_detail_table', $a, true);
      }
      $g = array();
      $g['container_type'] = $this->getContainerType();
      $data['general_form'] = $this->load->view('granite/g_general_form', $g, true); 
      $data['detail_form'] = $this->load->view('granite/g_detail_form', '', true);
      $data['form_action'] = "granite/generate/" .$data['common_id'];
      $data['common_header'] = $this->getCommonHeader();
      $this->load->view('granite/granite', $data);
  } // END function index
  
  function getGranite($common_id) {
    return $this->graniteDB->getGranite($common_id, true, false);
  }
  
  function addGranite() {
    $id = $this->graniteDB->addGranite();
    if($id > 0) {  
  	   $common_id = $this->session->userdata('common_id');
  	   $data['general'] = $this->getGranite($common_id);
  	   $data['container_type'] = $this->getContainerType($data['general']['container_type'], 1, $data['general']['id']);
  	   echo $this->load->view('granite/g_general_table',$data, true); 
    } 
  }
    
  function addGraniteDetails()
  { // BEGIN function addGraniteDetails
  	$id = $this->graniteDB->addGraniteDetails();
  	if($id > 0) {
  	   $a = array();
       $a['results'][] = $this->graniteDB->getSingleDetail($id);  
  	   echo $this->load->view('granite/g_detail_table', $a, true); 
    } 
  	
  } // END function addGraniteDetails
  
   function updateContainerDetails() {
      $this->graniteDB->updateContainerDetails(); 
   }
   
   function generate($generate_id) {
    include "granite_text.php";
    $report = $this->commonDB->getReport($generate_id);
    $common_id = $report->id;
    $report_no = $report->report_no;
    $client_id = $report->client_id;
    $report_date = $report->created_date_1 ? $report->created_date_1 : date("d.m.Y");
    $c_f_agent = $this->getClientName($client_id);
    $agent = $c_f_agent;
    $file_name = str_replace("/","_", $report_no);
     /**------------- general-----------------**/
    $value = $this->getGranite($generate_id);
    extract($value);
    $date_of_survey =   $this->getDateFormat($date_of_survey);
   
    /**--------------Container-----------------**/
    $graniteDetails = array();
    $graniteDetails_body = $this->graniteDB->getContainerDetails($common_id);
    $total_no_of_container = count($graniteDetails_body);
    $this_container_text = $this->getContainerTypeText($container_type);
    $container =  $total_no_of_container . " X " . $this_container_text;
    $total_no_of_granite = 0;
    $wooden = array(); 
    if(!empty($graniteDetails_body)) {
       $graniteDetails[] = $graniteDetails_header;
       foreach($graniteDetails_body as $key => $value) {
          $local_array = array();
          $local_array[] = $key+1;  
          $local_array[] = $value->container_no ;
          $local_array[] = $value->gross_weight; 
          $local_array[] = $value->payload_weight;
          $local_array[] = $value->cha_weight;  
          $local_array[] = $value->no_of_blocks ;
          $local_array[] = $value->blocks_numbers ;  
          $local_array[] = $value->customer_seal." / ". $value->line_seal;
          $local_array[] = $value->year_of_mfg;
          $graniteDetails[] = $local_array;
          $total_no_of_granite = $total_no_of_granite + $value->no_of_blocks ;
          //wooden work
          $text = '';
          $wooden[$key]['container'] = ($key+1).".".space(2).$value->container_no."/". $this_container_text;
	  $text .= sprintf($text_8_1,$value->flb_lenght, $value->flb_breath, $value->flb_height, $value->flb_count, $this->getSORP($value->flb_count));
          $text .= $text_8_2;
          $text .= !empty($value->left_side_bolster) ? sprintf($text_8_3,$this->convertNumberToString($value->left_side_bolster), $this->getSORP($value->left_side_bolster)) : "";     
          $text .= !empty($value->left_side_framework) ? (empty($value->left_side_bolster) ? str_repeat(chr(32), 9)."Left Side\t: " : "\t\t\t".str_repeat(chr(32), 2) ).sprintf($text_8_4,$this->convertNumberToString($value->left_side_framework), $this->getSORP($value->left_side_framework)) : "";
          $text .= !empty($value->right_side_bolster) ? sprintf($text_8_5,$this->convertNumberToString($value->right_side_bolster), $this->getSORP($value->right_side_bolster)) : "";
          $text .= !empty($value->right_side_framework) ? (empty($value->right_side_bolster) ? str_repeat(chr(32), 9)."Right Side\t: " : "\t\t\t".str_repeat(chr(32), 2) ) .sprintf($text_8_6,$this->convertNumberToString($value->right_side_framework), $this->getSORP($value->right_side_framework)) : "";
          $text .= $text_8_7;
          $text .= sprintf($text_8_8,$this->convertNumberToString($value->front_end_wooden),$this->getSORP($value->front_end_wooden), $this->convertNumberToString($value->rear_end_wooden), $this->getSORP($value->rear_end_wooden));
          $wooden[$key]['text'] =  $text;   
       }
    }
       
    /**--------------Report Start-----------------**/
    $this->word("Arial");
    $this->getHeader($heading_1);
    $this->getReportNo($report_no, $report_date);
    $this->getParagraph(sprintf($text_1_1,$agent, $place_of_survey, $date_of_survey), true, "", 6,0);
    $this->getParagraph($text_1_2,true, "", 6,0);
    $this->getParagraph($heading_2, true, "", 6,0);
       
    $general = array();  
    $general[] = array("Description of Cargo", $description_of_cargo);
    $general[] = array("Vessel Name", $vessel_name);
    $general[] = array("Voyage Number", $voyage_no);
    $general[] = array("Exporter", $exporter);
    $general[] = array("Consignee", $consignee);
    $general[] = array("Invoice Number", $invoice_no);
    $general[] = array("Marks & Number of Blocks",$marks_blocks);
    $general[] = array("Port of Loading", $port_of_loading);
    $general[] = array("Shipping Bill Number", $shipping_bill_no);
    $general[] = array("Port of Discharge", $port_of_discharge);
     
        
 	  $this->generateTable($general);
 	  $this->getParagraph($heading_3, true, "", 6,0);
    $this->getParagraph($text_3_1, true, "", 6,0);
    $this->getParagraph($heading_4, true, "", 6,0);
    $this->getParagraph(sprintf($text_4_1, $place_of_survey, $date_of_survey), true, "", 6,0);
    $this->getParagraph(sprintf($text_4_2, $container), true, "", 6,0);
    $this->getParagraph($heading_5, true, "", 6,0);
    $this->getParagraph(sprintf($text_5_1, $total_no_of_granite, $this->getSORP($total_no_of_granite) ), true, "", 6,0);
    $this->getParagraph($text_5_2, true, "", 6,0);
    $this->getParagraph($heading_6, true, "", 6,0);
    $this->getParagraph($text_6_1, true, "", 6,0);
    $this->getParagraph($text_6_2, true, "", 6,0);
    $this->getParagraph(sprintf($text_6_3, $date_of_survey), true, "", 6,0);
    $this->getParagraph($text_6_4, true, "", 6,0);
    $this->getParagraph($heading_7, true, "", 6,0);
    
    if(!empty($graniteDetails)) {
      $this->generateHeaderTable($graniteDetails);
    }
    $this->getParagraph($heading_8, true, "", 6,0);
    if(!empty($wooden)) {
      foreach($wooden as $value) {
        $this->getParagraph($value['container'], true, "", 6,0);
        $this->getParagraph($value['text']);  
      }
    }
    $this->getParagraph($heading_9, true, "", 6,0);
    $this->getParagraph(sprintf($text_9_1, $date_of_survey, $total_no_of_granite, $this->getSORP($total_no_of_granite), $container), true, "", 6,0);
    $this->getParagraph($heading_10, true, 10, 6,0);
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
    echo $this->getStatus($status, $report_no, $file_name);
    $this->close();
    
    
  }// end of the generate
  
}// end of the class
