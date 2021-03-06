<?php
 include "common.php";
class Tobacco extends Common {
	var $name = array();

	function Tobacco()
	{
		parent::Common();	
		$this->load->model('tobaccoDB');
	//	$this->output->enable_profiler(TRUE);
	}
	
	function index()
	{   
	    $common_id = $this->session->userdata('common_id');
      $data['report_no'] = $this->session->userdata('report_no');
      $data['common_id'] = $common_id;  
	    $general = $this->getAllGeneralDetails($common_id);
      
      if(empty($general)) {
        $data['general_table'] = ""; 
      }
      else {
        $a = array();
        $a['results'] = $general;
        $data['general_table'] = $this->load->view('tobacco/t_general_table', $a, true);
      }
      
      $invoice = $this->getAllInvoiceDetails($common_id);
      $a = array();
      $a['results'] = $invoice;
      $data['invoice_table'] = $this->load->view('tobacco/t_invoice_table', $a, true);
      
      $detail = $this->getAllContainerDetails($common_id);
      if(empty($detail)) {
        $data['detail_table'] = ""; 
      }
      else {
        $a = array();
        $a['results'] = $detail;
        $data['detail_table'] = $this->load->view('tobacco/t_detail_table', $a, true);
      }
      
      $data['general_form'] = $this->load->view('tobacco/t_general_form',"" , true);
      $data['invoice_form'] = $this->load->view('tobacco/t_invoice_form', '', true);
      $d_f = array();
      $d_f['pattern'] = $this->getStuffingPatternEditTable(9, 11);      
      $data['detail_form'] = $this->load->view('tobacco/t_detail_form', $d_f, true);
      $data['form_action'] = "tobacco/generate/$common_id";
      $data['common_header'] = $this->getCommonHeader();
      $this->load->view('tobacco/tobacco', $data);
	}
  function addGeneralDetails() {
    $id = $this->tobaccoDB->addGeneralDetails();
  	 if($id > 0) {
  	   $d = array();
  	   $d['results'] = (array) $this->tobaccoDB->getGeneralDetails($id);
  	   echo $this->load->view('tobacco/t_general_table', $d, true);  
     }
  }
	
	function addInvoiceDetails() {
	 $id = $this->tobaccoDB->addInvoiceDetails();
	 if($id > 0) {
	   $d = array();
	   $d['results'] = $this->tobaccoDB->getInvoiceDetails($id);
	   echo $this->load->view('tobacco/t_invoice_table', $d, true);  
   }
  }
  
  
	
	function addContainerDetails() {
	 $id = $this->tobaccoDB->addContainerDetails();
	 if($id > 0) {
	   $d = array();
	   $d['results'] = $this->tobaccoDB->getContainerDetails($id);
	   echo $this->load->view('tobacco/t_detail_table', $d, true);  
   }
  }
  
  function getAllGeneralDetails($common_id) {
    return (array)$this->tobaccoDB->getAllGeneralDetails($common_id);
  }
  
  function getAllInvoiceDetails($common_id) {
    return $this->tobaccoDB->getAllInvoiceDetails($common_id);
  }
  
  function getAllContainerDetails($common_id) {
    return $this->tobaccoDB->getAllContainerDetails($common_id);
  }
  function deleteInvoiceDetails($id) {
    echo  $this->tobaccoDB->deleteInvoiceDetails($id);
  } 
  
  function deleteContainerDetails($id) {
    echo $this->tobaccoDB->deleteContainerDetails($id);
  }
  	
	function getStuffingPatternEditTable($tableRow = 8, $tableCol = 14, $caption = "") {
		$table = "";
		$table .= "<div><select name='pattern_type' class='pattern_type'><option value='1'>Type 1</option><option value='2'>Type 2</option></select>";
		$tab = time();

		$table .= "<div id='t1' class='pattern_type_item' tab='tab'>";
	    $table .= "<table  width='100%' class='common' style='border:none;'>";
	    $table .= $caption ? "<caption>$caption</caption>" : "";
	    $inital = 1;
	    for($row = 1; $row <= $tableRow; $row++) {
	      $table .= "<tr>";
	      $max = ($inital-1)+$tableCol;  
	      for($col = $inital; $col <= $max; $col++) {
			  $tab++;
		$table .= '<td><input size="8" type="text" class="pinput" tabindex="'.$tab.'" name="pattern['.$row.'][]"  value="**" /></td>';
	      }
	      $table .= "</tr>";
	      $inital = $col;
	    }
	    $table .= "</table>";
		$table .= "</div>";
		
		$tab = time();
		$table .= "<div id='t2' class='pattern_type_item' style='display:none;' tab='$tab'>";
	
		$t_array = array();
		
		for($r = 1; $r <= 99; $r++) {
			$tab++;
			$t_array[] = '<td><input size="8" class="pinput" tabindex="'.$tab.'" type="text" name="pattern2[%d][' . $r .']"  value="**" /></td>';
		}
		
		if(!empty($t_array)) {
			$array_1 = array_slice($t_array,0,9);
			$tr  ="";
			$array_5 = array_chunk($array_1, 3);
			$array_5 = array_reverse($array_5);
			foreach($array_5 as $a) {
				$tr .= "<tr>" . implode("",$a) . "</tr>";
			}
			$t1= "<div class='t2-table t2-first-table'><table>$tr</table></div>";
			$table .= str_replace("%d",1, $t1);
			
			$array_2 = array_slice($t_array, 9,90);
			$array_3 = array_chunk($array_2, 6);
			$tr = "";
			foreach($array_3 as $k => $array_4) {
				$array_5 = array_chunk($array_4, 2);
				$array_5 = array_reverse($array_5);
				foreach($array_5 as $a) {
					$tr .= "<tr>" . implode("",$a) . "</tr>";
				}
				$t1 = "<div class='t2-table'><table>$tr</table></div>";
				$table .= str_replace("%d",$k+2, $t1);
				$tr = "";
			}
			
		}
		
		$table .= "</div></div>";
	    return $table;
	}
	
	function updatePattern($id) {
	   $this->tobaccoDB->updatePattern($id, $_POST['pattern']);
	   echo "OK";  
    }
	
	function getPatternFormData($id) {
  	$pattern = $this->tobaccoDB->getPatternFormData($id);
  	$pattern_type = $this->tobaccoDB->getPatternType($id);
  	 
    $table = "<table class='common'>";
    foreach($pattern as $key => $rows) {
      $table .= "<tr>";
      foreach($rows as $row) {
        $table .= '<td><input type="text" name="pattern['.$key.'][]" size="8" value="'.$row.'" /></td>';
      }
      $table .= "</tr>";
    }
    $table .= "</table>";
    echo form_open('tobacco/updatePattern/' . $id, array('id' => "pattern-form", 'method' => 'POST', 'class' => 'all-form'));
    echo $table;
    echo "<div style='margin-top:10px'><div style='float:left;width:40%'><input type='submit' value='Update' onclick=\" return add('pattern-form', 'pattern-form-div'); return false;\" ></div><div style='float:right;width:40%;'></div></div>";
    echo form_close();
  
  	exit;
  }
  
  function updateGeneralDetails() {
   $this->tobaccoDB->updateGeneralDetails(); 
  }
  
  function updateInvoiceDetails() {
   $this->tobaccoDB->updateInvoiceDetails(); 
  }
  
  function updateContainerDetails() {
   $this->tobaccoDB->updateContainerDetails(); 
  }
  
  function generate($generate_id) {
    $report = $this->commonDB->getReport($generate_id);
    $common_id = $report->id;
    $report_no = $report->report_no;
    $client_id = $report->client_id;
    $report_date = $report->created_date_1 ? $report->created_date_1 : date("d.m.Y");
    $c_f_agent = $this->getClientName($client_id);
    $agent = $c_f_agent;
    $file_name = str_replace("/","_", $report_no);
     /**------------- general-----------------**/
    $value = $this->tobaccoDB->getAllGeneralDetails($generate_id);
    $place_of_survey = $value->place_of_stuffing;
    $start_date_of_stuffing = $this->getDateFormat($value->start_date_of_stuffing); 
    $end_date_of_stuffing = $this->getDateFormat($value->end_date_of_stuffing);
    $date_of_survey =   $end_date_of_stuffing != "00.00.0000"  ?   $start_date_of_stuffing ." - ". $end_date_of_stuffing :   $start_date_of_stuffing;
    $port_of_discharge = $value->port_of_discharge;
    $description = $value->description;
    $official_seal = $value->official_seal;
    $liner_seal  = $value->liner_seal;  
    
    /**--------------invoice-----------------**/
    $invoice = array();
    $invoice_header = array("INV. NO. & DATE", "MARKS & NOS", "SHIPPER", "CONSIGNEE", "GR. WT Kgs / NT. WT Kgs", "NO. OF PKGS", "REMARK");
    $invoice_body = $this->getAllInvoiceDetails($generate_id);
    if(!empty($invoice_body)) {
       $invoice[] = $invoice_header;
       foreach($invoice_body as $value) {
          $local_array = array();
          $local_array[] = $value->invoice_no ."  " . $this->getDateFormat($value->invoice_date);
          $local_array[] = $value->marks; 
          $local_array[] = $value->shipper;
          $local_array[] = $value->consignee;  
          $local_array[] = number_format((int)$value->gross_weight) ." / ". number_format((int)$value->net_weight); 
          $local_array[] = $value->no_of_package;
          $local_array[] = $value->remark;
          $invoice[] = $local_array;   
       }
    }
    
    /**--------------Container-----------------**/
    
    $containers = $this->getAllContainerDetails($generate_id);
    $container_details = array();
    $container_heading = "";
    $stuffing_details = array();
    $group_continer = array(); 
    $total_no_of_package  = 0;
    $final_gross_weight = 0;
    $final_net_weight = 0;
    $shipment = '';  
    
    if(!empty($containers)) {
      foreach($containers as $key =>  $value) {
        $title = "";
        $container_no = $value->container_no;
        $container_type = $value->container_type;
        $no_of_ctns = $value->no_of_ctns; 
        $line = $value->line;
        $net_weight = (int) $value->net_weight;
        $gross_weight = (int) $value->gross_weight;
        $stuffing_commenced = $value->stuffing_commenced;
        $stuffing_completed = $value->stuffing_completed;
        $stuffing_pattern  = unserialize($value->stuffing_pattern);
        $shipment_array = unserialize($value->shipment);
		$ptype = $value->ptype;

        
        // general heading
        $total_no_of_package = $total_no_of_package +   $no_of_ctns;
        $final_gross_weight = $final_gross_weight +  $gross_weight;
        $final_net_weight = $final_net_weight +  $net_weight;
        $container_heading .= ($key+1) .". ". $container_no;
        $container_heading .= " / ". getContainerTypeText($container_type);
        $container_heading .= " ($no_of_ctns CTNS) [LINE: $line] \n";
        $shipment_str = '';
        foreach($shipment_array as $a) {
          $start = $a[0];
          $end = $a[1];
          $c_count = $a[2];
          $shipment_str .= " $start - $end ($c_count CTNS)\n"; 
        }
        $shipment .=  ($key+1) . ". " . $shipment_str ."\n";
        // container heading
        $title .=  $container_no;
        $title .= " / ". getContainerTypeText($container_type); 
        $title .= " - ". $no_of_ctns ." CTNS. ";
        $title .= " G.W. ".number_format($gross_weight). " KGS ";
        $title .= "/ N.W. ".number_format($net_weight). " KGS ";
        
        $container_details[$key]['item'] = $value; 
        $container_details[$key]['title'] = $title; 
        $container_details[$key]['pattern'] = $stuffing_pattern;
        $container_details[$key]['ptype'] = $ptype;
        //print_r($stuffing_pattern);
		//die();
        list($time, $date) = $this->splitDate($stuffing_commenced);
        $stuffing_1 = sprintf("STUFFING COMMENCED AT: %s Hrs. On %s", $time, $date);   
        list($time, $date) = $this->splitDate($stuffing_completed);
        $stuffing_2 = sprintf("STUFFING COMPLETED AT: %s Hrs. On %s", $time, $date);
        
        $stuffing_details[$key]['title'] = $title;
        $stuffing_details[$key]['stuffing'] = array($stuffing_1, $stuffing_2);
        $group_continer[] = $container_type;     
      }
    }
    $group_continer = $this->arrayGroupByCount($group_continer);
    $number_of_container = array();
    if(!empty($group_continer)) {
      foreach($group_continer as $key => $count) {
        $number_of_container[] =  $count ." X " . $this->getContainerTypeText($key);
      }
    }
    $number_of_container = implode(" , " , $number_of_container);
   
    $this->word();
    $this->getHeader(CSSR_HEADING);
    $this->getReportNo($report_no, $report_date);
    $this->getParagraph(sprintf(PARA_S, $agent, $place_of_survey,$date_of_survey,$number_of_container), false, "", 6,6);
    
    $final_gross_weight = number_format((int) $final_gross_weight);
    $final_net_weight =   number_format((int)$final_net_weight);
    $general = array();  
    $general[] = array("Container Number", $container_heading);
    $general[] = array("Shipment Number", $shipment);
    $general[] = array("Description of Cargo", $description);
    $general[] = array("Date & Place of stuffing", $date_of_survey ." / ".$place_of_survey);
    $general[] = array("Port of Discharge", $port_of_discharge);
    $general[] = array("Total Packages", $total_no_of_package);
    $general[] = array("Gross Weight / Net Weight", "$final_gross_weight KGS / $final_net_weight KGS" );
    $general[] = array("C & F Agent", $c_f_agent);
    
        
        
 	  $this->generateTable($general);
    $this->getParagraph(PARA_2,false, "", 6,6);
    $container_count_string = "";
    if(is_array($invoice) && (count($invoice)-1) > 1) {
      $container_count_string = "s";
      $this->getParagraph(PARA_3_MULTI,false, "", 6,6);
    }
    else {
      $this->getParagraph(PARA_3,false, "", 6,6);
    }
    if(!empty($invoice)) {
      $this->generateHeaderTable($invoice);
    }
    
    if(!empty($container_details)) {
      foreach($container_details as $k => $detail ){
		$k = $k +1;  
		$vv = $detail['item'];
		$stuffing_details_type2 = array();
		if($detail['ptype'] == 2) {
			$this->getParagraph("$k. STUFFING DETAILS: ",true, "", 6,6);

        $container_no = $vv->container_no;
        $container_type = $vv->container_type;
        $no_of_ctns = $vv->no_of_ctns; 
        $stuffing_commenced = $vv->stuffing_commenced;
        $stuffing_completed = $vv->stuffing_completed;
        list($time, $date) = $this->splitDate($stuffing_commenced);


		if($stuffing_completed) {
			list($time, $date2) = $this->splitDate($stuffing_completed);
			$date .= " to " . $date2; 
		}	
		$sh = "";
		
			$stuffing_details_type2[] = array("PLACE",$place_of_survey, "CONTR. NO",$container_no . " / " . $container_type);
			$stuffing_details_type2[] = array("DATE",$date, "SH. NOS",$sh);	
			$stuffing_details_type2[] = array("GRADE","TL", "NO OF CTNS","$no_of_ctns CARTONS");	
			$this->generateTable($stuffing_details_type2, TRUE);
			$this->getParagraph("$k.1. CARGO STACKING POSITION: ",true, "", 6,6);
			$this->getPatternTableType2($detail['pattern']);
		}
		else {
			$this->getParagraph($detail['title'], true, 10, 6,0);
			
			$this->getPatternTable($detail['pattern']);
		}	
      }
    }
    $remark = "";
    $this->getParagraph("REMARKS", true, "", 6,0);

    $this->getParagraph(sprintf(REMARKS_STUFFING,$total_no_of_package, $number_of_container, $container_count_string),"", 0, 6);
    
    
    if(!empty($stuffing_details)) {
      foreach($stuffing_details as $detail ){
        $this->getParagraph($detail['title'], true,10,6,0);
        $this->getParagraph($detail['stuffing'][0]);
        $this->getParagraph($detail['stuffing'][1]);
      }
    }
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

function getPattern($pattern, $class = "p_e_details") {
	  if(!empty($pattern)) {
		$table = "<table width='100%'>";
		foreach($pattern as $key => $rows) {
		    $table .= "<tr>";
		    foreach($rows as $row) {
			$table .= '<td class="'.$class.'">'.$row.'</td>';
		    }
		    $table .= "</tr>";
		}
	    $table .= "</table>";	  
	  }
	  return $table;
	}
	
	