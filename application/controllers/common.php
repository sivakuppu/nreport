<?php
define("CONTAINER_40_GP",1);
define("CONTAINER_40_HC",2);
define("CONTAINER_20_GP",3);
define("CLIENT_CODE_1","SCH");
define("CLIENT_CODE_2","LEP");
define("SR_HEADING","STUFFING REPORT");
define("CSSR_HEADING","CONTAINER STUFFING SURVEY REPORT");
define("MARGIN_TOP","2");
define("MARGIN_RIGHT","1");
define("MARGIN_BOTTOM","0.50");
define("MARGIN_LEFT","1");
define("VISIBLE",FALSE);
define("FONT_NAME", 'Courier New');
define("FONT_SIZE", 12);
define("PARA_1","We, the undersigned marine surveyors, do hereby certify that at the request of %s. did attend at the %s on %s in order to, supervise the stuffing of cargo in 1 X %s container and after a careful examination we now report as follows.");
define("PARA_S","We, the undersigned marine surveyors, do hereby certify that at the request of %s. did attend at the %s on %s in order to, supervise the stuffing of cargo in  %s container and after a careful examination we now report as follows.");
define("PARA_2", "Prior to stuffing, we have carried out general inspection of container and found all the panels in sound condition, without heavy dents, cuts or holes with normal  wear and tear, door gaskets found intact, floorboard found dry and clean and free of odour and in our opinion the container is fit for stuffing general cargo. Understructure are not made available for inspection.");
define("PARA_3", "In our presence the cartons were stuffed into the container and the details are as follows:");
define("PARA_3_MULTI", "In our presence the cartons were stuffed into the containers and the details are as follows:");
define("REMARKS", "The cartons Stuffed externally in apparently sound condition at the time of our Survey.\nAs per our tally all the %s Pkgs were stuffed in the container in apparent sound condition.\nOn Completion of Stuffing operations the doors were properly closed and duly sealed by the customs officials Seal No. %s and liner Seal No. %s");
define("REMARKS_STUFFING", "The cartons Stuffed externally in sound condition at the time of our Survey. As per our tally all the %s CTNS were stuffed in %s container%s in apparently sound condition. On Completion of Stuffing operations the doors were properly closed and duly sealed.");
define("INSPECTION_HEAD","We, the undersigned Marine Surveyors, do hereby certify that at the request of %s %s carried out a container inspection survey at  %s.");
define("NOTE", "The fitness of the above container only at the time our survey, Ensure to block the container at your end" );
class Common extends CI_Controller {
  var $report_type_array = array();
  var $report_code_array =array();
  var $com = null;
  var $documents = null;
  var $report_path = null;
   
	function Common()
	{
	  parent::__construct();
	  $this->checkReportTargetFolder();	
	  $this->load->model('commonDB');
	  //$this->load->scaffolding('client');
	  $this->report_type_array[1] = 'stuffing';
    $this->report_type_array[2] = 'inspection';  
    $this->report_type_array[3] = 'tobacco';
    $this->report_type_array[4] = 'granite';
    
    $this->report_code_array[1] = 'S';
    $this->report_code_array[2] = 'CI';
    $this->report_code_array[3] = 'S';
    $this->report_code_array[4] = 'S';
    //$this->output->enable_profiler(TRUE);
	
  }
  
  function checkReportTargetFolder() 
  {
	$path_file = realpath(FCPATH . "/reportpath.txt");
	if(!file_exists($path_file)) {
		echo sprintf('Text file %s doesn\'t exists. Please create the file and mension report target folder path',$path_file);
		die();
	}
	$rpath = file_get_contents($path_file);
	$rpath = str_replace(PHP_EOL,"", $rpath);
	$rpath = trim($rpath);
	if(empty($rpath)) {
		echo sprintf('Text file %s was empty. Please mension report target folder path',$path_file);
		die();
	}
	$rpath = $rpath . "/". date('Y');
	if(!file_exists($rpath)) {
		mkdir($rpath);
	}
	$this->report_path = $rpath;
	$this->checkMonthFolder();
  }
  
  function checkMonthFolder(){
    $month = date('M');
    $month = strtoupper($month);
	$nes_path = $this->report_path . "/NES/$month"; 
	if(!file_exists($nes_path)) {
		mkdir($nes_path,0777,TRUE);
	}	
	$ce_path = $this->report_path . "/CE/$month";
	
	if(!file_exists($ce_path)) {
		mkdir($ce_path,0777,TRUE);
	}	
  }

  function index() {
    $date = $this->session->userdata('search_date');
    $data['common_header'] = $this->getCommonHeader();
    $data['search_date'] = isset($date) ? $date : date("y-m-d"); 
    $data['search_data'] = $this->commonDB->getSearchData($data['search_date']);
    $this->load->view('common', $data);
  }
  
  function getCommonHeader() {
    $client_id = $this->session->userdata('client_id');
    $client_refer_id = $this->session->userdata('client_refer_id');
    $data['client_option'] = $this->clientDropDown($client_id);
    $data['refer_option'] = $this->clientDropDown($client_refer_id);
    return $this->load->view('file', $data, true);
  }
  
  function delete($id) {
    if($id > 0) {
      $this->commonDB->deleteFile($id);
    }
    $this->clearSession();
    redirect('common');
  }
  
  function clearSession() {
    $this->session->set_userdata('report_type', 0);
    $this->session->set_userdata('client_id', 0);
    $this->session->set_userdata('client_refer_id', 0);
    $this->session->set_userdata('common_id', 0);
    $this->session->set_userdata('report_no', '');
  }
  
  
  function addfile() {
    $report_type = $this->input->post('report_type');
    $client_id = $this->input->post('client_id');
    $client_refer_id = $this->input->post('client_refer_id');
    if(($report_type == 0) || ($client_id == 0)) {
      redirect('common/index', 'refresh');
    }
      $this->session->set_userdata('report_type', $report_type);
      $this->session->set_userdata('client_id', $client_id);
      $this->session->set_userdata('client_refer_id', $client_refer_id);
      $report_no = $this->generateReportNo();
      $common_id = $this->commonDB->addReport($report_no, $date = '');
      $this->session->set_userdata('common_id', $common_id);
      redirect($this->report_type_array[$report_type], 'refresh');  
  }
  
  function searchByReportNo() {
     $reportNo = $this->input->post('target_file');
     if($reportNo) {
        $report = $this->commonDB->getByReportNo($reportNo);
        if(!empty($report)) {
        $this->session->set_userdata('report_type', $report->report_type);
        $this->session->set_userdata('client_id', $report->client_id);
        $this->session->set_userdata('common_id', $report->id);
        $this->session->set_userdata('report_no', $report->report_no);
        redirect($this->report_type_array[$report->report_type], 'refresh');
      }  
     }
     redirect('common');
  }
  
  function search(){
    $search_date = $this->input->post('search_date');
    if($search_date) {
      $this->session->set_userdata('search_date', $search_date);
    }
    redirect('common');
  }
  
  function getfile($id = 0) {
    if($id > 0){
      $this->clearSession();
      $report = $this->commonDB->getReport($id);
      if(!empty($report)) {
        $this->session->set_userdata('report_type', $report->report_type);
        $this->session->set_userdata('client_id', $report->client_id);
        $this->session->set_userdata('common_id', $report->id);
        $this->session->set_userdata('report_no', $report->report_no);
        redirect($this->report_type_array[$report->report_type], 'refresh');
      }  
    }
    redirect('common');
  }

  
  function generateReportNo() {
    $base_report_no = "NES/%s/%s/%s/%s";
    $report_type = $this->session->userdata('report_type');
    $client_id = $this->session->userdata('client_id');
    if(intval($report_type) == 0 && intval($client_id) == 0) {
      redirect('common/index', 'refresh');
    }
    $report_id = $this->commonDB->getLastReport($report_type, $client_id);
    $client_code = $this->commonDB->getClientCode($client_id);
    if($report_id == 1) {
      $report_id = sprintf("%'05s", '1');
    }
    else {
      $report_id = explode("/", $report_id);
      $report_id = intval($report_id[3]) + 1; 
      $report_id = sprintf("%'05s", $report_id);    
    }
    $report_code = $this->report_code_array[$report_type];
    if( intval(date("m")) < 3 || intval(date("m")) == 3  ) {
      $year =  (date("y") - 1) ."-" . (date('y',mktime(0, 0, 0, date("m"),   date("d"),   date("Y")+1)) - 1);
    }
    else {
      $year =  date("y") ."-" . date('y',mktime(0, 0, 0, date("m"),   date("d"),   date("Y")+1));
    }
    $report_no = sprintf($base_report_no, $client_code, $report_code, $report_id, $year);
    $report_no = strtoupper($report_no);
    $this->session->set_userdata('report_no', $report_no);
    return $report_no;
  }
  
  function client()
  { // BEGIN function client
  	$clients = $this->commonDB->getClients();
  	if(!empty($clients)) {
  	 foreach($clients as $client) {
  	   echo $client->name ."|". $client->id ."\n";
     }
    }
  } // END function client
  
  
  function clientDropDown($id = "")
  { // BEGIN function client
  	$clients = $this->commonDB->getAllClients();
  	$option = "";
  	if(!empty($clients)) {
  	 foreach($clients as $client) {
  	   $option .= "<option ";
  	   $option .= $id == $client->id ? " selected " : "";
  	   $option .= "value='" .$client->id. "' >";
  	   $option .= $client->display_code;
  	   $option .= "</option>";
     }
    }
    return $option;
  } // END function client
  
  function suffingPlace()
  {
  	$places = $this->commonDB->getPlaceOfSurvey(1);
  	if(!empty($places)) {
  	 foreach($places as $place) {
  	   echo $place->place_of_survey."\n";
     }
    }
  }
  
  function inspectionPlace()
  {
  	$places = $this->commonDB->getPlaceOfSurvey(1);
  	if(!empty($places)) {
  	 foreach($places as $place) {
  	   echo $place->place_of_survey."\n";
     }
    }
  }
  
  function word($font = '',$font_size = '', $margin_top = '')
  { // BEGIN function word
    $strPath = realpath(basename(getenv($_SERVER["SCRIPT_NAME"])));
    com_load_typelib('Word.Application');
    $this->com = new COM("Word.Application");
    $this->com->Application->Visible = VISIBLE;
    $this->documents = $this->com->Documents->Add();
    $this->com->Selection->PageSetup->LeftMargin = MARGIN_LEFT;
    $this->com->Selection->PageSetup->RightMargin = MARGIN_RIGHT;
    $this->com->Selection->PageSetup->TopMargin = $margin_top ? $margin_top : MARGIN_TOP;
    $this->com->Selection->PageSetup->BottomMargin = MARGIN_BOTTOM;

    if($font) {
      $this->com->Selection->Font->Name = $font;
    }
    else {
      $this->com->Selection->Font->Name = FONT_NAME;
    }
    
    $this->com->Selection->Font->Size = $font_size ? $font_size : FONT_SIZE;
	//$this->com->Selection->Headers(1)->PageNumbers.Add(1,TRUE);
  } // END function word
  function pageBreak() {
	$this->documents->Paragraphs->Add->Range->InsertBreak(7);  
	$this->getWhiteLine(2);
  }	  
  function saveAs($file)
  { // BEGIN function saveAs
    $path = $this->report_path;
	$file = $path ."/". $file;
	//print_r($this->com->Selection);
    $this->documents->SaveAs($file);  	
  } // END function saveAs
  
  function close()
  { // BEGIN function close
    $this->com->Application->Quit;
    //$this->com->ActiveDocument->Close(false);  
    $this->com = null;
  } // END function close
  
 
  function getWhiteLine($no = 1)
  { // BEGIN function getWhiteLine
  	$range = $this->documents->Paragraphs->Add->Range;  
  	$range->InsertBefore(str_repeat(chr(13),$no));
  } // END function getWhiteLine
    
  function getReportNo($report_no, $date, $tab = 6)
  { // BEGIN function getHeader
  	$range = $this->documents->Paragraphs->Add->Range;
	  $range->ParagraphFormat->SpaceAfter = 0;
  	$range->Font->Bold = TRUE;
  	$range->InsertBefore("$report_no". str_repeat("\t",$tab). "$date");
  } // END function getHeader
  
  function getHeader($header)     
  { // BEGIN function getHeader
  	$range = $this->documents->Paragraphs->Add->Range;
  	$range->ParagraphFormat->Alignment = 1;
	$range->ParagraphFormat->SpaceAfter = 30;
  	$range->Font->Bold = TRUE;
  	$range->Font->Size = "20";
  	$range->InsertBefore("$header");
  } // END function getHeader
    
  function getParagraph($text, $bold = false, $font = "", $before = 0, $after = 0, $indentationLeft = "0", $align = '')
  { // BEGIN function getParagraph
  	$range = $this->documents->Paragraphs->Add->Range;
	$range->ParagraphFormat->SpaceBefore = $before;
	$range->ParagraphFormat->SpaceAfter = $after;
	$range->ParagraphFormat->LeftIndent  = $indentationLeft;
	if($align) {
	    $range->ParagraphFormat->Alignment = $align;
	}
  	if($bold) {
  	 $range->Font->Bold = TRUE;
  	}
  	if($font) {
  	 $range->Font->Size = $font;
    }
  	$range->InsertBefore($text);
  } // END function getParagraph  
  
  function getParagraphUnderline($text, $bold = false, $font = "", $before = 0, $after = 0, $indentationLeft = "0", $align = '')
  { // BEGIN function getParagraph
  	$range = $this->documents->Paragraphs->Add->Range;
	$range->ParagraphFormat->SpaceBefore = $before;
	$range->ParagraphFormat->SpaceAfter = $after;
	$range->ParagraphFormat->LeftIndent  = $indentationLeft;
	if($align) {
	    $range->ParagraphFormat->Alignment = $align;
	}
  	if($bold) {
  	 $range->Font->Bold = TRUE;
  	}
  	if($font) {
  	 $range->Font->Size = $font;
    }
	$range->Font->Underline = TRUE;
  	$range->InsertBefore($text);
  } // END function getParagraph
  
  function middleParagraph($text, $bold = false, $size = "10",$before = 0, $after = 0)  
  { // BEGIN function getFirstFooter
  	$range = $this->documents->Paragraphs->Add->Range;
  	$range->ParagraphFormat->Alignment = 1;
	  $range->ParagraphFormat->SpaceAfter = $after;
	  $range->ParagraphFormat->SpaceBefore = $before;
  	if($bold) {
  	 $range->Font->Bold = TRUE;
  	}
  	$range->Font->Size = $size;
  	$range->InsertBefore($text);
  } // END function getFirstFooter

  function middleParagraphUnderline($text, $bold = false, $size = "10", $before = 0, $after = 0)  
  { // BEGIN function getFirstFooter
  	$range = $this->documents->Paragraphs->Add->Range;
  	$range->ParagraphFormat->Alignment = 1;
	  $range->ParagraphFormat->SpaceAfter = $before;
	  $range->ParagraphFormat->SpaceBefore = $after;
  	if($bold) {
  	 $range->Font->Bold = TRUE;
  	}
  	$range->Font->Size = $size;
	$range->Font->Underline = TRUE;
  	$range->InsertBefore($text);
  } // END function getFirstFooter
       
  function getFirstFooter()
  { // BEGIN function getFirstFooter
  	$range = $this->documents->Paragraphs->Add->Range;
  	$range->ParagraphFormat->Alignment = 1;
	$range->ParagraphFormat->SpaceBefore = 24;
  	$range->Font->Bold = TRUE;
  	$range->Font->Size = "12";
  	$range->InsertBefore("ISSUED WITHOUT PREJUDICE");
  } // END function getFirstFooter
  
  function getSecondFooter()
  { // BEGIN function getSecondFooter
  	$range = $this->documents->Paragraphs->Add->Range;
  	$range->ParagraphFormat->Alignment = 2;
  	$range->Font->Bold = TRUE;
  	$range->Font->Size = "12";
  	$range->InsertBefore("for Nireekshan Engineers & Surveyors".chr(13));
  } // END function getSecondFooter
  
  function getThirdFooter()
  { // BEGIN function getThirdFooter
  	$range = $this->documents->Paragraphs->Add->Range;
  	$range->ParagraphFormat->Alignment = 2;
  	$range->Font->Bold = TRUE;
  	$range->Font->Size = "12";
  	$range->InsertBefore("Authorized signatory".chr(13));
  } // END function getThirdFooter
  
  
  function generateTable($table_array, $right_bold = false, $left_bold = false)
  { // BEGIN function generateTable
     $col = count($table_array[0]);
  	 $row = count($table_array); 
  	 $range = $this->documents->Paragraphs->Add->Range;
  	 $table = $this->com->ActiveDocument->Tables->Add($range,$row,$col,1,2);
  	 foreach ($table_array as $index => $table_row_data) {
       $table_row = $index + 1;
    	 foreach ($table_row_data as $key => $value) {
        $header_col = $key +1;
        $value = empty($value) ? " - " : $value;
        $table->Cell($table_row,$header_col)->Range->InsertAfter($value);
        $table->Cell($table_row,$header_col)->Range->ParagraphFormat->Alignment = 0;
		if($right_bold && $header_col % 2 == 0) {
			$table->Cell($table_row,$header_col)->Range->Font->Bold=TRUE;
		}
		if($left_bold && $header_col % 1 == 0) {
			$table->Cell($table_row,$header_col)->Range->Font->Bold=TRUE;
		}	
      }
     }
  } // END function generateTable
  
  function generateTableAutoLastBold($table_array)
  { // BEGIN function generateTable
     $col = count($table_array[0]);
  	 $row = count($table_array); 
  	 $range = $this->documents->Paragraphs->Add->Range;
  	 $table = $this->com->ActiveDocument->Tables->Add($range,$row,$col,1,1);
  	 foreach ($table_array as $index => $table_row_data) {
		$table_row = $index + 1;
    	foreach ($table_row_data as $key => $value) {
        $header_col = $key +1;
        $value = empty($value) ? " - " : $value;
        $table->Cell($table_row,$header_col)->Range->InsertAfter($value);
        $table->Cell($table_row,$header_col)->Range->ParagraphFormat->Alignment = 0;
		$table->Cell($table_row,$col)->Range->Font->Bold=TRUE;
      }
     }
  } // END function generateTableWithAutoFit
  
  function getPatternTable($table_array) {
     $col = count($table_array[1]);
  	 $row = count($table_array); 
  	 $range = $this->documents->Paragraphs->Add->Range;
  	 $table = $this->com->ActiveDocument->Tables->Add($range,$row,$col,1,2);
  	 foreach ($table_array as $index => $table_row_data) {
       $table_row = $index + 0;
    	 foreach ($table_row_data as $key => $value) {
        $header_col = $key + 1;
        $value = empty($value) ? "  " : $value;
        $table->Cell($table_row,$header_col)->Range->InsertAfter($value);
        $table->Cell($table_row,$header_col)->Range->ParagraphFormat->Alignment = 0;
      }
     }
  }
  function getPatternTableType2($table_array) {
	$final_array = array();
	$final_a_1_row = array();
	$final_a_2_row = array();
	$final_a_3_row = array();	 
	$final_a_4_row = array();	
	$empty_row = array(6,10,14,18,22,26,30);
	 $final_index = 0;
     $col_1 = 3;
     $col = 2;
 	 $col_title = array(0 => "Top",1 => "Middle", 2 => "Bottom");  	 
 	 $col_left_title = array(0 => "T",1 => "M", 2 => "B");  	 

  	 foreach ($table_array as $index => $table_row_data) {
		if($index == 1) {
			$array_data = array_chunk($table_row_data,3);
			//array_unshift($array_data, array("Left","Middle","Right"));
			foreach($array_data as $y => $r) {
				$t = isset($col_left_title[$y]) ? $col_left_title[$y] : "";
				array_unshift($r, $t);
				$array_data[$y] = $r;
			}
		}
		else {
			$array_data = array_chunk($table_row_data,2);
			foreach($array_data as $y => $r) {
				$t = isset($col_title[$y]) ? $col_title[$y] : "";
				array_unshift($r, $t);
				$array_data[$y] = $r;
			}
			foreach($array_data as $y => $r) {
				$t = $y == 0 ? $index : "";
				array_unshift($r, $t);
				$array_data[$y] = $r;
			}			
		}
		$final_a_1_row = array_merge($final_a_1_row, $array_data[0]);
		$final_a_2_row = array_merge($final_a_2_row, $array_data[1]);
		$final_a_3_row = array_merge($final_a_3_row, $array_data[2]);
		//echo "<pre>" . print_r($array_data, TRUE) . "</pre>";

		
     }

$final_a_1_row_12 = array_chunk($final_a_1_row,12);
$final_a_2_row_12 = array_chunk($final_a_2_row,12);
$final_a_3_row_12 = array_chunk($final_a_3_row,12);
$dummy_array = array_fill(0,12,"");
foreach($final_a_1_row_12 as $kkk => $vvv) {
	if(isset($final_a_1_row_12[$kkk])) {
		$final_array[] = $final_a_1_row_12[$kkk];
	}
	if(isset($final_a_2_row_12[$kkk])) {
		$final_array[] = $final_a_2_row_12[$kkk];
	}
	if(isset($final_a_3_row_12[$kkk])) {
		$final_array[] = $final_a_3_row_12[$kkk];
	}
	$final_array[] = $dummy_array;
}	


	if(!empty($final_array)) {
	
	array_unshift($final_array, array_merge(array("","Left","Middle","Right"),array_fill(4,8,"")));
	array_unshift($final_array, $dummy_array);

     $col = count($final_array[1]);
  	 $row = count($final_array); 
	 //echo "ROW :: $row";
  	 $range = $this->documents->Paragraphs->Add->Range;
  	 $table = $this->com->ActiveDocument->Tables->Add($range,$row,$col,1,2);

  	 foreach ($final_array as $index => $table_row_data) {
		// To make 12 item 
		if(count($table_row_data) < 12) {
			foreach($dummy_array as $dk => $dv) {
				if(!isset($table_row_data[$dk])) {
					$table_row_data[$dk] = "";
				}
			}
		}	

        $table_row = $index + 1;
    	 foreach ($table_row_data as $key => $value) {
        $header_col = $key + 1;
        $cvalue = empty($value) ? "  " : $value;
        $table->Cell($table_row,$header_col)->Range->InsertAfter($cvalue);
		if(in_array($value, array("T","M","B","Left","Middle","Right","Top","Bottom"))) {
			$align = 0;
		}
		else {
			$align = 2;
		}	
        $table->Cell($table_row,$header_col)->Range->ParagraphFormat->Alignment = $align;
		if($table_row == 1) {
			$leftBool = $header_col == 1 ? TRUE : FALSE; 
			$rightBool = $header_col == 12 ? TRUE : FALSE; 
			if(!$leftBool) {
				$table->Cell($table_row,$header_col)->Borders(-2)->LineStyle = FALSE;
			}
			$table->Cell($table_row,$header_col)->Borders(-3)->LineStyle  = FALSE;
			if(!$rightBool) {
				$table->Cell($table_row,$header_col)->Borders(-4)->LineStyle  = FALSE;
			}
		}	
		elseif($table_row == 2) {
			$leftBool = $header_col == 1 ? TRUE : FALSE; 
			$rightBool = $header_col == 12 ? TRUE : FALSE;
			$bottomBool = $header_col == 2 || $header_col == 3 || $header_col == 4  || $header_col == 7  || $header_col == 8  || $header_col == 11  || $header_col == 12 ? TRUE : FALSE;
			if(!$bottomBool) {		
				$table->Cell($table_row,$header_col)->Borders(-3)->LineStyle  = FALSE;
			}
			if(!$leftBool) {
				$table->Cell($table_row,$header_col)->Borders(-2)->LineStyle = FALSE;
			}
			$table->Cell($table_row,$header_col)->Borders(-1)->LineStyle  = FALSE;
			if(!$rightBool) {
				$table->Cell($table_row,$header_col)->Borders(-4)->LineStyle  = FALSE;
			}
		}	
		elseif($table_row == 3 || $table_row == 4 || $table_row == 5) {
			$topBool  = $header_col == 2 || $header_col == 3 || $header_col == 4 || $header_col == 7 || $header_col == 8 || $header_col == 11 || $header_col == 12;
			
			$bottomBool  = $header_col == 2 || $header_col == 3 || $header_col == 4 || $header_col == 7 || $header_col == 8 || $header_col == 11 || $header_col == 12;
			
			$leftBool  = $header_col == 1 || $header_col == 2 || $header_col == 3 || $header_col == 4 || $header_col == 5 || $header_col == 6 ||$header_col == 7 || $header_col == 8 || $header_col == 9 || $header_col == 11 || $header_col == 12;
			
			$rightBool  = $header_col == 1 || $header_col == 2 || $header_col == 3 || $header_col == 4 || $header_col == 6 || $header_col == 7 || $header_col == 8 || $header_col == 10 ||$header_col == 11 || $header_col == 12;
			if(!$topBool) {
				$table->Cell($table_row,$header_col)->Borders(-1)->LineStyle  = FALSE;
			}
			if(!$bottomBool) {
				$table->Cell($table_row,$header_col)->Borders(-3)->LineStyle  = FALSE;
			}
			if(!$leftBool) {
				$table->Cell($table_row,$header_col)->Borders(-2)->LineStyle  = FALSE;
			}
			if(!$rightBool) {
				$table->Cell($table_row,$header_col)->Borders(-4)->LineStyle  = FALSE;
			}	
		}
		elseif($row == $table_row) {
			$leftBool = $header_col == 1 ? TRUE : FALSE; 
			$rightBool = $header_col == 12 ? TRUE : FALSE;
			$topBool  =  ($header_col == 3 || $header_col == 4 || $header_col == 7 || $header_col == 8 || $header_col == 11 || $header_col == 12) && (isset($final_array[$row-2][$header_col-2]) && empty($final_array[$row-1][$header_col-1]));
			if(!$topBool) {
				$table->Cell($table_row,$header_col)->Borders(-1)->LineStyle  = FALSE;
			}
			
			if(!$leftBool) {
				$table->Cell($table_row,$header_col)->Borders(-2)->LineStyle = FALSE;
			}
			if(!$rightBool) {
				$table->Cell($table_row,$header_col)->Borders(-4)->LineStyle  = FALSE;
			}
		}//end		
		else {
			if(empty($value) && !($table_row == 1 || $table_row == $row)) {
			$leftBool = $header_col == 1 || isset($final_array[$table_row-1][$header_col-2]) && !empty($final_array[$table_row-1][$header_col-2]);
			$rightBool = $header_col == 12;
			$topBool  =  ($header_col == 3 || $header_col == 4 || $header_col == 7 || $header_col == 8 || $header_col == 11 || $header_col == 12) && isset($final_array[$table_row-1][$header_col-1]) && empty($final_array[$table_row-1][$header_col-1]);
			$bottomBool =  $header_col == 3 || $header_col == 4 || $header_col == 7 || $header_col == 8 || $header_col == 11 || $header_col == 12;
			if(isset($final_array[$table_row-1][$header_col-1]) && empty($final_array[$table_row-1][$header_col-1])) {
				$bottomBool = true;
			}	
			if($table_row == 6 && $header_col == 2) {
				$topBool = true;
			}	
			if(!$topBool) {
				$table->Cell($table_row,$header_col)->Borders(-1)->LineStyle  = FALSE;
			}
			if(!$bottomBool) {
				$table->Cell($table_row,$header_col)->Borders(-3)->LineStyle  = FALSE;
			}
			if(!$leftBool) {
				$table->Cell($table_row,$header_col)->Borders(-2)->LineStyle  = FALSE;
			}
			if(!$rightBool) {
				$table->Cell($table_row,$header_col)->Borders(-4)->LineStyle  = FALSE;
			}	
		}
		else {
			
			$topBool  = $bottomBool =  $header_col == 3 || $header_col == 4 || $header_col == 7 || $header_col == 8 || $header_col == 11 || $header_col == 12;
			
			
			$leftBool  = $header_col == 1 || $header_col == 3 || $header_col == 4 ||  $header_col == 5 || $header_col == 7 || $header_col == 8 || $header_col == 9 ||$header_col == 11 || $header_col == 12;
			
			$rightBool  = $header_col == 2 || $header_col == 3 || $header_col == 4 ||  $header_col == 6 || $header_col == 7 || $header_col == 8 || $header_col == 9 ||$header_col == 10 ||$header_col ==	 11 || $header_col == 12;
			if(!$topBool) {
				$table->Cell($table_row,$header_col)->Borders(-1)->LineStyle  = FALSE;
			}
			
			if(!$leftBool) {
				$table->Cell($table_row,$header_col)->Borders(-2)->LineStyle  = FALSE;
			}
			if(!$rightBool) {
				$table->Cell($table_row,$header_col)->Borders(-4)->LineStyle  = FALSE;
			}		
		  }
		}// end	
      }
     }		
	}
  }
 
  function generateHeaderTable($table_array, $lasr_row = '')
  { // BEGIN function generateHeaderTable
     $col= count($table_array[0]);
  	 $row = count($table_array);
  	 $range = $this->documents->Paragraphs->Add->Range;
  	 $table = $this->com->ActiveDocument->Tables->Add($range,$row,$col,1,2);
  	 foreach ($table_array as $index => $table_row_data) {
       $table_row = $index + 1;
    	 foreach ($table_row_data as $key => $value) {
        $header_col = $key +1;
        //$value = empty($value) ? " - " : $value;
        $table->Cell($table_row,$header_col)->Range->InsertBefore($value);
        $table->Cell($table_row,$header_col)->Range->ParagraphFormat->Alignment = 1;
        $table->Cell($table_row,$header_col)->Range->Font->Size = 10;
        if($table_row == 1 || ($lasr_row && ($table_row == $row))) {
          $table->Cell($table_row,$header_col)->Range->Bold = TRUE;
        }
       }
     }
    
  } // END function generateHeaderTable
  
  /*function getClientCode($code = '') {
    $dropdown = "<select id='report_no' name='report_no' onchange='setClient();'>";
    $selected_1 =  CLIENT_CODE_1 == $code ? "selected" : "";
    $selected_2 =  CLIENT_CODE_2 == $code ? "selected" : "";
    $dropdown .= "<option value='".CLIENT_CODE_1."' $selected_1>".CLIENT_CODE_1."</option>";
    $dropdown .= "<option value='".CLIENT_CODE_2."' $selected_2>".CLIENT_CODE_2."</option>";
    $dropdown .= "</select>";
    return $dropdown;
  } */
  
  function getContainerType($checked = 2, $type = 0, $id = 0) {
    $container = "";
    $checked_1 =  CONTAINER_40_GP ==  $checked ? "checked" : "";
    $checked_2 =  CONTAINER_40_HC ==  $checked ? "checked" : "";
    $checked_3 =  CONTAINER_20_GP ==  $checked ? "checked" : "";
    
    $container .= "<input type='radio' name='number_of_container' value='".CONTAINER_40_GP."' $checked_1 onclick='return containerType($type, $id, ".CONTAINER_40_GP.");'> 40'GP ";
    $container .= "<input type='radio' name='number_of_container' value='".CONTAINER_40_HC."' $checked_2 onclick='return containerType($type, $id, ".CONTAINER_40_HC.");'> 40'HC ";
    $container .= "<input type='radio' name='number_of_container' value='".CONTAINER_20_GP."' $checked_3 onclick='return containerType($type, $id, ".CONTAINER_20_GP.");'> 20'GP ";
    return $container;
  }
  
  function getContainerTypeText($id) {
       switch($id) {
        case CONTAINER_40_GP :
          $return = "40'GP"; 
          break;
        case CONTAINER_40_HC :
          $return = "40'HC";
          break;  
        case CONTAINER_20_GP :
          $return = "20'GP";
          break;                      
       }
       return $return;
  }
  
  function getStatus($status, $filename, $path_file) {
    $message = $status  ?  "Report $filename created successfully " : "Unable to create the report";
    $ul = "<ul>";
    $ul .= "<li>$message</li>";
    //$ul .= $status ? "<li><a href='". base_url()."file/$path_file.doc'>Download the report $filename</a></li>" : "";
    //$ul .= "<li><a href='". base_url()."index.php/stuffing/add/$file_id'> Edit the report $filename</li>";
    //$ul .= "<li><a href='". base_url()."index.php/stuffing'>Create new report</a> </li>";
    $ul .= "</ul>";
    return $ul;
  }
  
  function getJobOrderNo($text = '')
  { // BEGIN function getJobOrderNo
  	$range = $this->documents->Paragraphs->Add->Range;
  	$range->ParagraphFormat->Alignment = 0;
  	$range->Font->Bold = TRUE;
  	$order = "JOB ORDER NO : $text";
  	$range->InsertBefore($order);
  } // END function getJobOrderNo
  
  function getClientName($id, $place = false) {
      $client = $this->commonDB->getClientDetails($id);
      if(!empty($client)) {
        $return = $client->name;
        $return .=  $client->place ? " ," . $client->place : "";
        //$return = $place ? " , A/C. " : " M/S "; 
        //$return .= trim($client->name, "m/s");
        //$return .= $place ? ", ". $client->place : "";
        return $return; 
      }
      return "";
  }
  
  function getDateFormat($date, $format = '%d.%m.%Y') {
     return $this->commonDB->getDateFormat($date, $format);
  }
  
  function splitDate($date)  {
     $total = explode(" ", $date);
     $date = $this->getDateFormat($total[0]);
     $total_time = explode(":" , $total[1]);
     $time = $total_time[0] . ":" . $total_time[1];
     return array($time, $date);
  }
  
  function arrayGroupByCount($_array, $sort = false) {
     $count_array = array();
     foreach (array_unique($_array) as $value) {
         $count = 0;
  		foreach ($_array as $element) {
  		    if ($element == $value)
  		        $count++;
  		}
  		$count_array[$value] = $count;
  	}
  	if ( $sort == 'desc' )
  		arsort($count_array);
  	elseif ( $sort == 'asc' )
  		asort($count_array);
	   return $count_array;
  }
  
  function convertNumberToString($number, $upper = true) {

    $number = (int) $number;      
    if (($number < 0) || ($number > 999999999)) 
    { 
     throw new Exception("Number is out of range");
    } 
    $Gn = floor($number / 1000000);  /* Millions (giga) */ 
    $number -= $Gn * 1000000; 
    $kn = floor($number / 1000);     /* Thousands (kilo) */ 
    $number -= $kn * 1000; 
    $Hn = floor($number / 100);      /* Hundreds (hecto) */ 
    $number -= $Hn * 100; 
    $Dn = floor($number / 10);       /* Tens (deca) */ 
    $n = $number % 10;               /* Ones */ 

    $res = ""; 

    if ($Gn) 
    { 
        $res .= convert_number($Gn) . " Million"; 
    } 

    if ($kn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($kn) . " Thousand"; 
    } 

    if ($Hn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($Hn) . " Hundred"; 
    } 

    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
        "Nineteen"); 
    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", 
        "Seventy", "Eigthy", "Ninety"); 

    if ($Dn || $n) 
    { 
        if (!empty($res)) 
        { 
            $res .= " and "; 
        } 

        if ($Dn < 2) 
        { 
            $res .= $ones[$Dn * 10 + $n]; 
        } 
        else 
        { 
            $res .= $tens[$Dn]; 

            if ($n) 
            { 
                $res .= "-" . $ones[$n]; 
            } 
        } 
    } 

    if (empty($res)) 
    { 
        $res = "zero"; 
    } 
    if($upper) { return strtoupper($res);} else {return $res;}
  }

  function getSORP($number){
    return intval($number) > 1 ? "s" : "";
  }


  
}// end of the class


function getContainerTypeText($id) {
       switch($id) {
        case CONTAINER_40_GP :
          $return = "40'GP"; 
          break;
        case CONTAINER_40_HC :
          $return = "40'HC";
          break;  
        case CONTAINER_20_GP :
          $return = "20'GP";
          break;                      
       }
       return $return;
}

  function getContainerType($checked = 2, $type = 0, $id = 0) {
    $container = "";
    $checked_1 =  CONTAINER_40_GP ==  $checked ? "checked" : "";
    $checked_2 =  CONTAINER_40_HC ==  $checked ? "checked" : "";
    $checked_3 =  CONTAINER_20_GP ==  $checked ? "checked" : "";
    
    $container .= "<input type='radio' name='container_type' value='".CONTAINER_40_GP."' $checked_1 > 40'GP ";
    $container .= "<input type='radio' name='container_type' value='".CONTAINER_40_HC."' $checked_2 > 40'HC ";
    $container .= "<input type='radio' name='container_type' value='".CONTAINER_20_GP."' $checked_3 > 20'GP ";
    return $container;
  }


?>