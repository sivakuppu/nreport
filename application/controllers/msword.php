<?php
class Msword extends CI_Controller {
	function Msword()
	{
	  parent::__construct(); 
    $this->load->library('word');
  }
  
  function gen()
  { // BEGIN function gen
  	$this->word->open("D:/xampplite/htdocs/work/Report/template/report3.dot");
  	//$this->word->open("D:/xampplite/htdocs/work/Report/template/report1.doc");
  	//$this->word->add();
  	$this->word->bookmarks("TODAYDATE", '23-11-2010');
   	$this->word->table(2,2);
  	$this->word->setTableHeader(array('First Name', 'Last Name'));
    $this->word->setTableBody(2,array('Siva', 'Kumar'));
    $this->word->setTableBody(3,array('Siva1', 'Kumar1'));
    $this->word->tableClose();
    
    $this->word->emptyParagraph();
   
    $this->word->table(2,3);
  	$this->word->setTableHeader(array('First Name', 'Last Name', 'Nothing'));
    $this->word->setTableBody(2,array('Siva', 'Kumar', 'Nothing'));
    $this->word->tableClose();
    
    $this->word->paragraph("Hello How are u?");
     
    $this->word->saveAs("D:/xampplite/htdocs/Report/file/report9.doc");
    $this->word->close();  
  } // END function gen
  function emptyCon()
  { // BEGIN function emptyCon
  
    $title = "EMPTY CONTAINER INSPECTION";
    $report_no = "NES/CPL/CI/0001/09-10";
    $date = "01.03.2010";
    $para = "We, the undersigned Marine Surveyors, do hereby certify that at the request of M/S. THE GLOBAL GREEN COMPANY LIMITED, A/C. LEAAP INTERNATIONAL PVT LTD, Chennai-1 carried out a container inspection survey at SATVA-2.";
    $place_of_survey = "PCT";
    $date_of_survey = "26.02.2010";
    $container_title = "CONTAINER DETAILS";
    $container_details = array();
    $container_details[]= array('CONTAINER NO','SIZE / TYPE','GROSS WT','TARE WT','NET WT','MFD','CUBIC','LINE');
    $container_details[]= array("TCKU: 180298-0","20’ GP/ 22  G1","30480","2230","28250","05/08","33.2","RCL");
    $container_details[]= array("TCKU: 180298-0","20’ GP/ 22  G1","30480","2230","28250","05/08","33.2","RCL");
    $container_details[]= array("TCKU: 180298-0","20’ GP/ 22  G1","30480","2230","28250","05/08","33.2","RCL");
    $container_details[]= array("TCKU: 180298-0","20’ GP/ 22  G1","30480","2230","28250","05/08","33.2","RCL");
    $container_condition_title = "CONTAINER CONDITION";
    $container_condition_data[] = array("LEFT SIDE","NORMAL WEAR & TEAR");
    $container_condition_data[] = array("RIGHT SIDE",	"NORMAL WEAR & TEAR");
    $container_condition_data[] = array("FRONT SIDE",	"NORMAL WEAR & TEAR");
    $container_condition_data[] = array("ROOF SIDE",	"NORMAL WEAR & TEAR");
    $container_condition_data[] = array("INTERIOR",	"NEATLY");
    $container_condition_data[] = array("REAR SIDE",	"NORMAL WEAR & TEAR");
    $container_condition_data[] = array("UNDERSTRUCTURE",	"NOT INSPECTED");
    $container_condition_data[] = array("NOTE", 	"The fitness of the above container only at the time our survey, 
    Ensure to block the container at your end.");
    $footer1 = "ISSUED WITHOUT PREJUDICE";
    $footer2 = "For Nireekshan Engineers & Surveyors";
    $footer3 = "Authorized signatory"; 

  	$this->word->add();
  	$this->getHeader($title);
  	$this->getReportNo($report_no, $date);
  	$this->getJobOrderNo();
  	$this->getParagraph($para);
   	$this->generatePlaceDateTable($place_of_survey, $date_of_survey);
    $this->getContainerDetailsTitle($container_title);
    $this->generateContainerDetailsTable($container_details);
    $this->getContainerConditionTitle($container_condition_title);
    $this->generateContainerConditionTable($container_condition_data);
    $this->getFirstFooter($footer1);
    $this->getSecondFooter($footer2);
    $this->getThirdFooter($footer3);
    try {
      $this->word->saveAs("D:/xampplite/htdocs/Report/file/test12.doc");
      echo "Report created <a href='". base_url()."file/test12.doc'>Click here</a> to Download";
    }
    catch(Exception $e) {
      echo "Unable to create the report";
    } 
    $this->word->close();

  } // END function emptyCon
  
  function getHeader($header)
  { // BEGIN function getHeader
  	$range = $this->word->document->Paragraphs->Add->Range;
  	$range->ParagraphFormat->Alignment = 1;
  	$range->Font->Bold = TRUE;
  	$range->Font->Size = "15";
  	$range->InsertBefore($header);
  } // END function getHeader
  
  function getReportNo($report_no, $date)
  { // BEGIN function getHeader
  	$range = $this->word->document->Paragraphs->Add->Range;
  	//$range->ParagraphFormat->Alignment = 0;
  	$range->Font->Bold = TRUE;
  	$range->Font->Size = "12";
  	$range->InsertBefore(chr(13).$report_no.str_repeat("\t",7).$date);
  } // END function getHeader
  
  function getJobOrderNo($text = '')
  { // BEGIN function getJobOrderNo
  	$range = $this->word->document->Paragraphs->Add->Range;
  	$range->ParagraphFormat->Alignment = 0;
  	$range->Font->Bold = TRUE;
  	$range->Font->Size = "12";
  	$order = "JOB ORDER NO : MA0931628";
  	$range->InsertBefore($order);
  } // END function getJobOrderNo
  
  function getContainerDetailsTitle($text)
  { // BEGIN function getContainerDetailsTitle
  	$range = $this->word->document->Paragraphs->Add->Range;
  	$range->ParagraphFormat->Alignment = 0;
  	$range->Font->Bold = TRUE;
  	$range->Font->Size = "12";
  	$range->InsertBefore(chr(13).$text);
  } // END function getContainerDetailsTitle
  
  function getContainerConditionTitle($text)
  { // BEGIN function getContainerConditionTitle
  	$range = $this->word->document->Paragraphs->Add->Range;
  	$range->ParagraphFormat->Alignment = 0;
  	$range->Font->Bold = TRUE;
  	$range->Font->Size = "12";
  	$range->InsertBefore(chr(13).$text);
  } // END function getContainerConditionTitle
  
  
  function getParagraph($text)
  { // BEGIN function getParagraph
  	$range = $this->word->document->Paragraphs->Add->Range;
  	$range->InsertBefore(chr(13).$text.chr(13));
  } // END function getParagraph
  
  function getFirstFooter($text)
  { // BEGIN function getFirstFooter
  	$range = $this->word->document->Paragraphs->Add->Range;
  	$range->ParagraphFormat->Alignment = 1;
  	$range->Font->Bold = TRUE;
  	$range->Font->Size = "12";
  	$range->InsertBefore(chr(13).$text.chr(13));
  } // END function getFirstFooter
  
  function getSecondFooter($text)
  { // BEGIN function getSecondFooter
  	$range = $this->word->document->Paragraphs->Add->Range;
  	$range->ParagraphFormat->Alignment = 2;
  	$range->Font->Bold = TRUE;
  	$range->Font->Size = "12";
  	$order = "JOB ORDER NO : MA0931628";
  	$range->InsertBefore($text.chr(13).chr(13));
  } // END function getSecondFooter
  
  function getThirdFooter($text)
  { // BEGIN function getThirdFooter
  	$range = $this->word->document->Paragraphs->Add->Range;
  	$range->ParagraphFormat->Alignment = 2;
  	$range->Font->Bold = TRUE;
  	$range->Font->Size = "12";
  	$range->InsertBefore($text.chr(13).chr(13));
  } // END function getThirdFooter
  
  
  function generatePlaceDateTable($place, $date)
  { // BEGIN function generatePlaceDateTable
     $range = $this->word->document->Paragraphs->Add->Range;
  	 $table = $this->word->com->ActiveDocument->Tables->Add($range,2,2,1,2);
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
  
  function generateContainerDetailsTable($table_array)
  { // BEGIN function generateContainerDetailsTable
     $col= count($table_array[0]);
  	 $row = count($table_array);
  	 $range = $this->word->document->Paragraphs->Add->Range;
  	 $table = $this->word->com->ActiveDocument->Tables->Add($range,$row,$col,1,2);
  	 foreach ($table_array as $index => $table_row_data) {
       $table_row = $index + 1;
    	 foreach ($table_row_data as $key => $value) {
        $header_col = $key +1;
        $table->Cell($table_row,$header_col)->Range->InsertAfter($value);
        $table->Cell($table_row,$header_col)->Range->ParagraphFormat->Alignment = 1;
        if($table_row == 1) {
          $table->Cell($table_row,$header_col)->Range->Bold = TRUE;
        }
       }
     }
  } // END function generateContainerDetailsTable
  
  function generateContainerConditionTable($table_array)
  { // BEGIN function generateContainerConditionTable
     $col = count($table_array[0]);
  	 $row = count($table_array); 
  	 $range = $this->word->document->Paragraphs->Add->Range;
  	 $table = $this->word->com->ActiveDocument->Tables->Add($range,$row,$col,1,2);
  	 foreach ($table_array as $index => $table_row_data) {
       $table_row = $index + 1;
    	 foreach ($table_row_data as $key => $value) {
        $header_col = $key +1;
        $table->Cell($table_row,$header_col)->Range->InsertAfter($value);
        $table->Cell($table_row,$header_col)->Range->ParagraphFormat->Alignment = 0;
      }
     }
  } // END function generateContainerConditionTable
}
?>
