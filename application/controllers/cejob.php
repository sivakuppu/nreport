<?php
include("common.php");
$error_array = array(1 => 'Unable to Added', 2 => 'Unable to delete', 3 => 'Please enter file number', 4 => 'No such file exists', 5 => "Unable to create the report" ); 
$message_array = array(1=> 'Successfully Added', 2 => 'Successfully Updated', 3 => 'Successfully Deleted', 4 => 'New file opened', 5 => 'File found', 6=>"Succefully created the report");
 		
class Cejob extends Common {    
                 
	function Cejob()
	{
 		parent::Common();        
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('CE/certificate_model');
		$this->load->model('CE/item_detail_model');
		$this->load->model('CE/agent_model');
		$this->load->model('CE/seller_model');
		$this->load->model('CE/importer_model');
		//$this->output->enable_profiler(TRUE);
	}	
	function index($id = "", $message_id = 0, $error_id = 0, $last_id = "")
	{	
    global $error_array, $message_array;		
	  $update = true;  
	  $data['id'] = $id;
	  $data['last_id'] = $last_id == 1 ? $this->certificate_model->getLastId() : $this->certificate_model->getLastId();
	  $message = $message_id > 0 ? $message_array[$message_id] : "";
	  $error = $error_id > 0 ? $error_array[$error_id] : "";  
	  if(isset($_POST['submit']) && $_POST['submit'] == 'Generate') {
	    if($id > 0 ) {
		$status = $this->generate($id);
		if($status) {
		    $message = $message_array[6];
		}
		else {
		    $error = $error_array[5];
		}
		$update = false;
	    }
	  }
	  
		$this->form_validation->set_rules('certificate_of_inspection_no','Certificate of Inspection No.','required|trim|max_length[255]');			
		$this->form_validation->set_rules('agent','Agent','');			
		$this->form_validation->set_rules('importer','Importer','');			
		$this->form_validation->set_rules('seller','Seller','');	
    $this->form_validation->set_rules('agent_id','Agent ID','');			
		$this->form_validation->set_rules('importer_id','Importer ID','');			
		$this->form_validation->set_rules('seller_id','Seller ID','');					
		$this->form_validation->set_rules('port_of_shipment','Port of Shipment','trim|max_length[255]');			
		$this->form_validation->set_rules('declare_invoice_value','Declare Invoice Value','max_length[255]');			
		$this->form_validation->set_rules('currency','Currency','trim|max_length[255]');			
		$this->form_validation->set_rules('toi','TOI','trim|max_length[255]');			
		$this->form_validation->set_rules('certificate_date','Certificate Date','');			
		$this->form_validation->set_rules('freight_amount','Freight Amount','trim|max_length[255]');			
		$this->form_validation->set_rules('goods_invoice_no','Goods Invoice No.','trim');			
		$this->form_validation->set_rules('mabw_bl_no','MABW BL No.','trim');			
		$this->form_validation->set_rules('inspection_place','Inspection Place','trim|max_length[255]');			
		$this->form_validation->set_rules('be_number','BE Number','trim|max_length[255]');			
		$this->form_validation->set_rules('function','Function','trim');			
		$this->form_validation->set_rules('comments','Comments','trim');			
		$this->form_validation->set_rules('approximate_year','Approximate Year','trim|max_length[255]');			
		$this->form_validation->set_rules('freight_description','Freight  Description','trim');
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn'\t been passed
		{
		//	$this->load->view('CE/certificate', $data);
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
					       	'certificate_of_inspection_no' => set_value('certificate_of_inspection_no'),
					       	'agent_id' => set_value('agent_id'),
					       	'importer_id' => set_value('importer_id'),
					       	'seller_id' => set_value('seller_id'),
					       	'port_of_shipment' => set_value('port_of_shipment'),
					       	'declare_invoice_value' => set_value('declare_invoice_value'),
					       	'currency' => set_value('currency'),
					       	'toi' => set_value('toi'),
					       	'certificate_date' => set_value('certificate_date'),
					       	'freight_amount' => set_value('freight_amount'),
					       	'goods_invoice_no' => set_value('goods_invoice_no'),
					       	'invoice_date' => set_value('invoice_date'),
					       	'inspection_date' => set_value('inspection_date'),
					       	'inspection_duration' => set_value('inspection_duration'),
					       	'mabw_bl_no' => set_value('mabw_bl_no'),
					       	'inspection_place' => set_value('inspection_place'),
					       	'be_number' => set_value('be_number'),
					       	'function' => set_value('function'),
					       	'comments' => set_value('comments'),
					       	'approximate_year' => set_value('approximate_year'),
					       	'freight_description' => set_value('freight_description')
						);
					
			// run insert model to write data to db
    		  if($id > 0 && $update) {
      			  $this->certificate_model->UpdateForm($form_data, $id);
      			  $message = $message_array[2];
      		}
          else { 
	    if($update) {	
              $last_id = $this->certificate_model->SaveForm($form_data);  
              $data['id'] = $last_id > 0 ? $last_id : $id;
              if(intval($last_id) > 0) {
                $message = $message_array[1];
              }
              else {
                $error = $error_array[1];
              }
	    }     
          }    
            	
  		}
  		if($data['id'] > 0) {
  		  $data = (array) $this->certificate_model->getData($data['id']);
  		  $data['agent'] = $this->agent_model->getName($data['agent_id']);  
  		  $data['seller'] = $this->seller_model->getName($data['seller_id']);
  		  $data['importer'] = $this->importer_model->getName($data['importer_id']);
      }
      $data['message'] = $message;
      $data['error'] = $error;
  		$this->load->view('CE/certificate', $data);
	}
	
	function get() {
	 if(isset($_POST['new']) && $_POST['new'] == 'New') {
	   redirect('cejob/index/0/4/0/1');
   }
   if(isset($_POST['get']) && $_POST['get'] == 'Get') {
      $report_no = trim($_POST['report_no']);
      if(!$report_no) {
        redirect('cejob/index/0/0/3');   
      }
      $id = $this->certificate_model->search($report_no); 
      $id = intval($id);
      if($id > 0) {
        redirect("cejob/index/$id/5");
      }
      else {
        redirect("cejob/index/0/0/4");
      }  
   }
  }
  
  function delete($id) {  
    if($id > 0) {
      $delete = $this->certificate_model->delete($id);
      if($delete) {
        redirect("cejob/index/0/3");
      }
      else {
        redirect("cejob/index/$id/0/2");
      }
    }
    redirect("cejob/index/0/0/2");
  }
  
  function getStr($number, $value = false) {
    $number = str_replace(',','',$number);
    if(strstr($number, '.')) {
	$number = (float) $number;
    }
    else {
	$number = intval($number);
    }
    if($value) {
	      
	     return $number;
    }
    $new_value = number_format($number);
    return  empty($new_value) ? "-" : $new_value;
    
  }
  
  function generate($id) {
    include "CE\include.php";
	$date_format_ce = "d/m/Y";
    $row = (array) $this->certificate_model->getData($id);
    extract($row);
	$agent = $this->agent_model->getName($agent_id);  
	$seller = $this->seller_model->getName($seller_id);
    $importer = $this->importer_model->getName($importer_id);
	list($importer_name,$importer_address, $importer_code) = $this->importer_model->getImporter($importer_id);
    $report_date = $this->getDateFormat($certificate_date);
    $certificate_of_inspection_no = strtoupper($certificate_of_inspection_no);
    $file_name = str_replace("/","_", $certificate_of_inspection_no);
	//inspection_duration

	$invoice_date=strtotime($invoice_date);	
	$invoice_date=date($date_format_ce,$invoice_date);	$inspection_date=strtotime($inspection_date);	
	$inspection_date=date($date_format_ce,$inspection_date);
    $sequence = explode('/',$certificate_of_inspection_no);
    $sequence_no = is_array($sequence) ? $sequence[2] : rand(0,9);
    
    $agent_name = $this->agent_model->getName($agent_id, false);  
    
    $agent_name = str_replace(array('Chennai','chennai','CHENNAI','M/s', 'M/S', 'm/s', 'm/S', '&',"'",",","."),"", $agent_name);
    //$agent_name = str_replace(" ","_", $agent_name); 
    $file_name = $sequence_no ."_".$agent_name; 	

	$inspection = array();
	$inspection[] = array("(i)	Place of Inspection",$inspection_place);
	$inspection[] = array("(ii)	Date of Inspection",$inspection_date);
	$inspection[] = array("(iii)	Duration of inspection (in hours)","$inspection_duration HOURS");
	$importer_array = array();
	$importer_array[] = array("(i)	Name",$importer_name);
	$importer_array[] = array("(ii)	Address",$importer_address);
	$importer_array[] = array("(iii)	Importer Exporter Code No",$importer_code);



    $general = array();  
    $general[] = array("IMPORTER’S NAME & ADDRESS", htmlspecialchars_decode($importer));
    $general[] = array("SELLER’S NAME & ADDRESS", htmlspecialchars_decode($seller));
    $general[] = array("INVOICE NO. & DATE", htmlspecialchars_decode($goods_invoice_no));
    $general[] = array("MAWB/BL NO & DATE", htmlspecialchars_decode($mabw_bl_no));
    $general[] = array("INSPECTION PLACE & DATE", htmlspecialchars_decode($inspection_place));
    $general[] = array("PORT OF SHIPMENT", htmlspecialchars_decode($port_of_shipment));
    $general[] = array("CHA Agents", htmlspecialchars_decode($agent));
    $general[] = array("BE NO & DATE", htmlspecialchars_decode($be_number));
    
    $all_row = $this->item_detail_model->getAllRow($id);
    $local_array_1 = array();
    $local_array_2 = array();
          $footer_array = array();
    if(!empty($all_row)) {
      $total = 0; 
      $flag = 0;
      foreach($all_row as $key => $value) {
        extract((array)$value);
        
        $local_array_1[$key+1] = array($key+1, htmlspecialchars_decode($item_name),htmlspecialchars_decode($specification),htmlspecialchars_decode($make),$quantity,$year_of_mfg,htmlspecialchars_decode($ce_remarks));
        $cost_of_machine = $this->getStr($cost_of_machine);
        $total = $total + $this->getStr($appraised_value, true);
        if($this->getStr($cost_of_recondition, true) > 0) {
          $flag++;
        }
        $appraised_value = $this->getStr($appraised_value);
        $cost_of_recondition  = "USED AND NOT RECONDITIONED" == strtoupper($ce_remarks) ?  "NOT APPLICABLE"  : $cost_of_recondition;
        $year_of_mfg = empty($year_of_mfg) ? (empty($eval_year_of_mfg) ? "NOT APPLICABLE" : htmlspecialchars_decode($eval_year_of_mfg) ) :  htmlspecialchars_decode($year_of_mfg);   
        $local_array_2[$key+1] = array($key+1, htmlspecialchars_decode($item_name),htmlspecialchars_decode($specification),htmlspecialchars_decode($quantity),htmlspecialchars_decode($year_of_mfg),htmlspecialchars_decode($cost_of_machine),$cost_of_recondition,$appraised_value, "");
      }
      
      $report_head = " Evaluated Value $toi Including Available Accessories ";
      $report_head .= $flag > 0 ? " and Reconditioning Charges " : "";
      $local_array_1[0] = array("SL. No.", "Description of items as per the Declaration","Specification Details Noticed", "Make","Qty in Units","Year of MFG", "CE's Remarks");
      $local_array_2[0] = array("SL. No.", "Description of items as per the Declaration","Specification Details Noticed","Qty in Units","Year of MFG","Cost of Item at the time of Manufacture Including Accessories in $currency", "Evaluated Cost of Reconditioning Charge in  $currency " , " $report_head in $currency", "Declared Invoice Value $toi in $currency" );

		$viii = $ix = $x = $xii= $xiii = ""; 
		$goods[] = array("(i)","Name of Manufacturer of the machine:","Please refer Annexure I");
		$goods[] = array("(ii)","Year of manufacture of machinery:","Please refer Annexure I");
		$goods[] = array("(iii)","Serial no. / ID No. Or the manufacturer’s plate affixed on the machine:","Please refer Annexure I"); 
		$goods[] = array("(iv)","Description of Machine","Please refer Annexure I"); 
		$goods[] = array("(v)","Whether original invoice relating to the machine is available?","NOT AVAILABLE");
		$goods[] = array("(vi)","If yes, value --------currency ----- Date of invoice -------- (please enclose copy)	","NOT APPLICABLE");
		$goods[] = array("(vii)","If no, please estimate the original sale price of the machinery:","Please refer Annexure II");
		$goods[] = array("(viii)","Present condition of machinery and expected lifespan:","$viii");
		$goods[] = array("(ix)","Has any reconditioning or repairs been carried out immediately preceding this inspection: YES /NO","$ix");
		$goods[] = array("(x)","If yes, have these been carried out at the expense of the seller or by the purchaser or a third party?","$x");
		$goods[] = array("(xi)","Are there invoices to indicate the cost thereof: 
		YES / NO 
		(please enclose relevant invoices)","NOT APPLICABLE");
		$goods[] = array("(xii)","If No, then estimated cost thereof","$xii");
		$goods[] = array("(xiii)","Please briefly describe the nature of repairs and/or refurbishment:","$xiii");
		$goods[] = array("(xiv)","Were any charges incurred by the purchaser, for dismantling, packing and transporting the machinery to the port of export? If yes, please indicate the charges","NO");
		$goods[] = array("(xv)","Any catalogues / documentation of the machine are available? If yes, please provide the details and copies.","NO");

		$valuation_reference[] = array("(i)","Valuation Reference (attached)");
		$valuation_reference[] = array("(ii)","");
		$valuation_reference[] = array("(iii)","");

		$signature[] = array("Signature:\n\n\n\n\n\n\n");
		$inspector[] = array("Date","6.11.2015");
		$inspector[] = array("Name of Inspecting Person / Inspector","K.P. VIJAYAKUMAR\nCHARTERED ENGINEER\nREG NO: M / 121699 / 0");
		$inspector[] = array("Designation","CEO\nNIREEKSHAN ENGINEERS AND SURVEYORS");
		$inspector[] = array("Address (Office)","NEW: 259, OLD: 125, II FLOOR,\nLINGHI CHETTY STREET,\nCHENNAI – 600001.");
		$inspector[] = array("E Mail Address","vj@nireekshan.in");
		$inspector[] = array("Phone Number","044-25232980 / 25210473");

	  
      $footer_array[0] = array(htmlspecialchars_decode($report_head), $currency, $this->getStr($total));
      if($freight_amount || $freight_description ) {
       $footer_array[1] = array(htmlspecialchars_decode($freight_description), $currency, $this->getStr($freight_amount));
       
      }
      if($this->getStr($declare_invoice_value, true) > 0) {
       $footer_array[2] = array("Declared Invoice Value $toi as per Invoice no. ".htmlspecialchars_decode($goods_invoice_no), $currency, $this->getStr($declare_invoice_value));
      } 
    }
	$letter_space  = 40;
	
    $this->word("Calibri (Body)", 11, "0.5");
	$this->getWhiteLine(3);
    $this->middleParagraphUnderline("CERTIFICATE OF INSPECTION" , true, 13);
    $this->middleParagraphUnderline("FORM B" , true, 13,10,10);
    $this->getReportNo($certificate_of_inspection_no, $report_date, 8);
	
		
    $this->getParagraph(sprintf($p6, $p1, $goods_invoice_no, $invoice_date, $agent, $importer),false, "",15,15);
    $this->getParagraph($p7,false, "",15,15);
	if(!empty($inspection)) {
       $this->generateTable($inspection);
    }
    $this->getParagraphUnderline("Details of Importer:",true, "", 10,10);//Details of Importer
	
    if(!empty($importer_array)) {
       $this->generateTable($importer_array);
    }
	$this->getParagraphUnderline("Details of the goods:",true, "", 10,10);//Details of the goods:
    if(!empty($goods)) {
       $this->generateTableAutoLastBold($goods);
    }
    $this->getParagraph("The following means / aids/ technical reference material have been used for inspecting the goods:",false, "", 15,15);
    if(!empty($valuation_reference)) {
       $this->generateTable($valuation_reference);
    }
    $this->getParagraph("I hereby declare that the particulars and statements made in this certificate are true and correct.",false, "", 15,15);
    if(!empty($inspector)) {
       $this->generateTable($signature);
       $this->generateTable($inspector);
    }
	$this->getWhiteLine(1);
	$this->middleParagraphUnderline("ANNEXURE – I" , true, 11,0,20);
	$this->getReportNo($certificate_of_inspection_no, $report_date, 8);
    $this->getParagraph("REF: $be_number", true,11,5,10);
    if(!empty($local_array_1)) {
       $this->generateHeaderTable($local_array_1);
    }
    if($comments) {
      $this->getParagraph(htmlspecialchars_decode($comments),false, "", 15,15);
    }
	$letter_space  = 40;
	$this->getWhiteLine(1);
    $this->getParagraph($p46,true, "", 6,0,$letter_space);
    $this->getWhiteLine(1);
    $this->getParagraph($p47,true, "", 6,0,$letter_space);
    $this->getParagraph($p48,true, "", 6,0,$letter_space);
    $this->getParagraph(sprintf($p51, $report_date),true, "", 6,0,$letter_space);
    $this->getParagraph($p52,true, "", 6,0,$letter_space);

    $this->getWhiteLine(1);
    $this->middleParagraphUnderline("ANNEXURE – II" ,true, 11);
    $this->middleParagraph($p53 ,true, 10,10,10);
    $this->getReportNo($certificate_of_inspection_no, $report_date, 8);
    if(!empty($local_array_2)) {
      $this->generateHeaderTable($local_array_2);
    }
    $this->getParagraph("TOTAL\t\t" . $this->getStr($total),false, "", 6,0,0,2);
    if(!empty($footer_array)) {
       $this->generateTable($footer_array);
    }
	$this->getWhiteLine(1);
    $this->getParagraph($p46,true, "", 6,0,$letter_space);
    $this->getWhiteLine(1);
    $this->getParagraph($p47,true, "", 6,0,$letter_space);
    $this->getParagraph($p48,true, "", 6,0,$letter_space);
    $this->getParagraph(sprintf($p51, $report_date),true, "", 6,0,$letter_space);
    $this->getParagraph($p52,true, "", 6,0,$letter_space);
    
    $status = true; 
    try {
      $month = date('M');
      $month = strtoupper($month);
      $this->saveAs("CE/$month/$file_name.doc");
    }
    catch(Exception $e) {
      $status = false;
    } 
    //echo $this->getStatus($status, $certificate_of_inspection_no, $file_name);
    $this->close();
    return $status;
  }// end of the generator
  
	function success()
	{
			echo 'this form has been successfully submitted with all validation being passed. All messages or logic here. Please note
			sessions have not been used and would need to be added in to suit your app';
	}
}
?>