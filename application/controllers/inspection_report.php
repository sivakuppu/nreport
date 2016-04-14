<?php
include "common.php";
class Inspection_report extends Common {

	function Inspection_report()
	{
	  parent::Common(); 
	  $this->load->model('inspectionDB');
	  //$this->load->model('commonDB');
    //$this->output->enable_profiler(TRUE);
  }
  
  function index() {
        
  }
   
  function generate($generate_id)
  {
   
    $title = "EMPTY CONTAINER INSPECTION";
    $container_title = "CONTAINER DETAILS";
    $container_condition_title = "CONTAINER CONDITION";
          
    $report = $this->commonDB->getReport($generate_id);
    $common_id = $report->id;
    $report_no = $report->report_no;
    $client_id = $report->client_id;
    $client_refer_id = $report->client_refer_id;
    $report_date = $report->created_date ? $report->created_date : date("d.m.Y");
    $c_f_agent = $this->getClientName($client_id);
    $c_f_refer_agent = $client_refer_id > 0 ? $this->getClientName($client_refer_id , true) : "";
    $file_name = str_replace("/","_", $report_no);
    
    
      
    $general = $this->inspectionDB->getGeneralDetails($generate_id);
    extract($general);
    $para = sprintf(INSPECTION_HEAD,$c_f_agent, $c_f_refer_agent, $place_of_survey);   
    $details = $this->inspectionDB->getDetailsList($generate_id);
    $container_details = array();
    
    if(!empty($details))  {
      $container_details[]= array("CONTAINER NO","SIZE / TYPE","GROSS WT (in KGS)","TARE WT (in KGS)","NET WT (in KGS)","MFD","CUBIC Capacity","LINE");
      foreach($details as $value) {
        $local_array = array();
        $local_array[] = $value->container_no;
        $local_array[] = $value->size_type; 
        $local_array[] = $value->gross_weight;
        $local_array[] = $value->tare_weight;
        $local_array[] = $value->gross_weight - $value->tare_weight;
        $local_array[] = $value->mfd;
        $local_array[] = $value->cubic;  
        $local_array[] = $value->line;
        $container_details[] = $local_array; 
      }
      
    }
    
    $container_condition_data = array();
    $container_condition_data[] = array("LEFT SIDE",$left_side);
    $container_condition_data[] = array("RIGHT SIDE",	$right_side);
    $container_condition_data[] = array("FRONT SIDE",	$front_side);
    $container_condition_data[] = array("ROOF SIDE",	$roof_side);
    $container_condition_data[] = array("INTERIOR",	$interior);
    $container_condition_data[] = array("REAR SIDE",$rear_side);
    $container_condition_data[] = array("UNDERSTRUCTURE", $under_structure);
    $container_condition_data[] = array("NOTE", $note);

  	$this->word();
  	$this->getHeader($title); 
  	$this->getReportNo($report_no, $report_date);
  	$this->getJobOrderNo($job_order);
  	$this->getParagraph($para, false, "", 6,12);
   	$this->generatePlaceDateTable($place_of_survey, $date_of_survey);
	$this->getParagraph($container_title, true, 14,6,0);
    if(!empty($container_details)) {
      $this->generateHeaderTable($container_details);
    } 
   $this->getParagraph($container_condition_title, true, 14,6,0);
    $this->generateTable($container_condition_data);

    $this->getFirstFooter();
    $this->getSecondFooter();
    $this->getThirdFooter();
    try {
      $month = date('M');
      $month = strtoupper($month);
      $this->saveAs("NES/$month/$file_name.doc");
      $message = "Report created ";
    }
    catch(Exception $e) {
      $message = "Unable to create the report";
    } 
    $this->close();
    echo $message;
    }
    
    function generatePlaceDateTable($place, $date)
    { // BEGIN function generatePlaceDateTable
       $range = $this->documents->Paragraphs->Add->Range;
    	 $table = $this->com->ActiveDocument->Tables->Add($range,2,2,1,2);
    	 $table->Cell(1,1)->Range->InsertAfter("PLACE OF SURVEY");
       $table->Cell(1,1)->Range->Bold = TRUE;
       $table->Cell(1,1)->Range->ParagraphFormat->Alignment = 0;
       $table->Cell(1,2)->Range->InsertAfter($place);
       $table->Cell(1,2)->Range->ParagraphFormat->Alignment = 0;
       $table->Cell(2,1)->Range->InsertAfter("DATE OF SURVEY");
       $table->Cell(2,1)->Range->Bold = TRUE;
       $table->Cell(2,1)->Range->ParagraphFormat->Alignment = 0;
       $table->Cell(2,2)->Range->InsertAfter($date);
       $table->Cell(2,2)->Range->ParagraphFormat->Alignment = 0;
    } // END function generatePlaceDateTable
  
  }
?>
