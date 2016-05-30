<?php
include("common.php");
$error_array = array(1 => 'Unable to Added', 2 => 'Unable to delete', 3 => 'Please enter file number', 4 => 'No such file exists', 5 => "Unable to create the report" ); 
$message_array = array(1=> 'Successfully Added', 2 => 'Successfully Updated', 3 => 'Successfully Deleted', 4 => 'New file opened', 5 => 'File found', 6=>"Succefully created the report");
 		
class CE extends Common {    
                 
	function CE()
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
	function index($id = "", $message_id = 0, $error_id = 0)
	{	
    global $error_array, $message_array;		
	  $update = true;  
	  $data['id'] = $id;
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
	   redirect('ce/index/0/4');
   }
   if(isset($_POST['get']) && $_POST['get'] == 'Get') {
      $report_no = trim($_POST['report_no']);
      if(!$report_no) {
        redirect('ce/index/0/0/3');   
      }
      $id = $this->certificate_model->search($report_no); 
      $id = intval($id);
      if($id > 0) {
        redirect("ce/index/$id/5");
      }
      else {
        redirect("ce/index/0/0/4");
      }  
   }
  }
  
  function delete($id) {  
    if($id > 0) {
      $delete = $this->certificate_model->delete($id);
      if($delete) {
        redirect("ce/index/0/3");
      }
      else {
        redirect("ce/index/$id/0/2");
      }
    }
    redirect("ce/index/0/0/2");
  }
  
  function generate($id) {
     include "CE\include.php";
    $row = (array) $this->certificate_model->getData($id);
    extract($row);
	  $agent = $this->agent_model->getName($agent_id);  
	  $seller = $this->seller_model->getName($seller_id);
    $importer = $this->importer_model->getName($importer_id);
    $report_date = $this->getDateFormat($certificate_date);
    $file_name = str_replace("/","_", $certificate_of_inspection_no);
 
    $general = array();  
    $general[] = array("IMPORTER’S NAME & ADDRESS", $importer);
    $general[] = array("SELLER’S NAME & ADDRESS", $seller);
    $general[] = array("INVOICE NO. & DATE", $goods_invoice_no);
    $general[] = array("MAWB/BL NO & DATE", $mabw_bl_no);
    $general[] = array("INSPECTION PLACE & DATE", $inspection_place);
    $general[] = array("PORT OF SHIPMENT", $port_of_shipment);
    $general[] = array("CHA Agents", $agent);
    $general[] = array("BE NO & DATE", $be_number);
    
    $all_row = $this->item_detail_model->getAllRow($id);
    $local_array_1 = array();
    $local_array_2 = array();
    if(!empty($all_row)) {
      $local_array_1[] = array("SL. No.", "Description of Machines as per the Declaration","Specification Details Noticed", "Make","Qty in Units","Year of MFG", "CE's Remarks");
       $local_array_2[] = array("SL. No.", "Description of Machines as per the Declaration","Specification Details Noticed","Qty in Units","Year of MFG","CostofMachine Including Accessories At the of Manufacture In $currency", "Cost of Reconditioning Charges in $currency ", "Total Appraised Value $toi Including Avaliable Accessories & Reconditioning Charges In $currency");
      $total = 0; 
      $flag = false;
      foreach($all_row as $key => $value) {
        extract((array)$value);
        $total = $total + (!empty($appraised_value) ? (int) $appraised_value : 0);
        $local_array_1[] = array($item_name,$specification,$make,$quantity,$year_of_mfg,$ce_remarks);
        $cost_of_recondition  = "USED AND NOT RECONDITIONED" == strtoupper($ce_remarks) ?  "Not Applicable"  : $cost_of_recondition;   
        $local_array_2[] = array($item_name,$specification,$quantity,$year_of_mfg,$cost_of_machine,$cost_of_recondition,$appraised_value);
      }
    }
    $this->word("Times New Roman");
    $this->middleParagraph($p1 , true);
    $this->middleParagraph($p2 , true);
    $this->middleParagraph($p3 , true);
    $this->middleParagraph($p4 , true);
    $this->getReportNo($certificate_of_inspection_no, $report_date, 8);
    $this->getParagraph($p5,true, "", 6,0);      
    $this->getParagraph(sprintf($p6, $agent, $importer),false, "", 6, 0,15);
    $this->getParagraph($p7,false, "", 6,0, 15);
    $this->getParagraph($p8,true, "", 6,0);//used machine
    $this->getParagraph($p9,false, "", 6,0, 15);
    $this->getParagraph($p10,false, "", 6,0, 30);
    $this->getParagraph($p11,false, "", 6,0, 30);
    $this->getParagraph($p12,false, "", 6,0, 30);
    $this->getParagraph($p13,false, "", 6,0, 30);
    $this->getParagraph($p14,false, "", 6,0, 30);
    $this->getParagraph($p15,true, "", 6,0);//primary details
    if(!empty($general)) {
       $this->generateTable($general);
    }
    $this->getParagraph($p16,true, "", 6,0);//INSPECTION FINDINGS
    $this->getParagraph($p17,false, "", 6,0, 15);
    $this->getParagraph($p18,false, "", 6,0, 15);
    if(!empty($local_array_1)) {
       $this->generateHeaderTable($local_array_1);
    }
    if($comments) {
      $this->getParagraph($comments,false, "", 6,0);
    }
    
    $this->getParagraph($p19,false, "", 6,0, 15);
    $this->getParagraph($p20,true, "", 6,0);//CHARTERED ENGINEER’S COMMENTS
    $this->getParagraph($p21,false, "", 6,0, 15);
    $this->getParagraph($p22,false, "", 6,0, 15);
    $this->getParagraph($p23,true, "", 6,0);//YEAR OF MFR / AGE / EXPECTED RESIDUAL LIFE
    $this->getParagraph($p24,false, "", 6,0, 15);
    $this->getParagraph($p25,false, "", 6,0, 15);
    $this->getParagraph($p26,false, "", 6,0, 15);
    $this->getParagraph($p27,true, "", 6,0);//FUNCTIONS OF THE MACHINES
    if($function) {
      $this->getParagraph($function,false, "", 6,0, 15);
    }
    $this->getParagraph($p29,true, "", 6,0);//TECHNOLOGY GENERATION
    $this->getParagraph($p30,false, "", 6,0, 15);
    $this->getParagraph($p31,true, "", 6,0);//FAIR AND REASONABLE
    $this->getParagraph($p32,false, "", 6,0, 15);
    $this->getParagraph($p33,false, "", 6,0, 15);
    $this->getParagraph($p34,false, "", 6,0, 15);
    $this->getParagraph($p35,false, "", 6,0, 15);
    $this->getParagraph($p36,false, "", 6,0, 15);
    $this->getParagraph($p37,false, "", 6,0, 15);
    $this->getParagraph($p38,false, "", 6,0, 15);  
    $this->getParagraph($p39,true, "", 6,0);//RELATED DOCUMENTS
    $invoice = "INVOICE NO. & DATE\t\t\t $goods_invoice_no";
    $mawb = "MAWB/BL NO & DATE\t\t\t $mabw_bl_no"; 
    $this->getParagraph($invoice,false, "", 6,0, 15);
    $this->getParagraph($mawb,false, "", 6,0, 15); 
    $this->getParagraph($p40,true, "", 6,0);//TERMS AND CONDITIONS FOR THE ISSUE OF THIS CERTIFICATE
    $this->getParagraph($p41,false, "", 6,0, 15);
    $this->getParagraph($p42,false, "", 6,0, 15);
    $this->getParagraph($p43,false, "", 6,0, 15);
    $this->getParagraph($p44,false, "", 6,0, 30);
    $this->getParagraph($p45,false, "", 6,0, 30);
    $this->getParagraph($p46,true, "", 6,0);
    $this->getWhiteLine(1);
    $this->getParagraph($p47,true, "", 6,0);
    $this->getParagraph($p48,true, "", 6,0);
    $this->getParagraph($p49,true, "", 6,0);
    $this->getParagraph($p50,true, "", 6,0);
    $this->getParagraph(sprintf($p51, $report_date),true, "", 6,0);
    $this->getParagraph($p52,true, "", 6,0);
    $this->middleParagraph($p53 ,true);
    $this->getReportNo($certificate_of_inspection_no, $report_date, 8);
    if(!empty($local_array_2)) {
      $this->generateHeaderTable($local_array_2);
    }
    
    $status = true; 
    try {
      $this->saveAs("CE/JUL/$file_name.doc");
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