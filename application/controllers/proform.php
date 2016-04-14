<?php
include "common.php";
class Proform extends Common {

	function Proform()
	{
		parent::Common();	
		$this->load->model('invoicedb');
		//$this->output->enable_profiler(TRUE);
	}

	function index() 
	{
		$data['search_invoice_date'] = "";
		$data['client_option'] = $this->clientDropDown();
		$data['proform_data'] = $this->invoicedb->get_all();
		$data['header'] = $this->load->view('header', '', true);
		$data['footer'] = $this->load->view('footer', '', true);
		$data['proform_lists'] = $this->load->view('invoice/proform_list', $data, true);
		$this->load->view('invoice/invoice', $data);

	}  

	function save() 
	{
	    $this->invoicedb->save();
	    redirect('proform');
	}

	function edit($id) 
	{
	    $data = $this->invoicedb->get($id);
	    $data['client_option'] = $this->clientDropDown(intval($data['client_id']));
	    $data['header'] = $this->load->view('header', '', true);
	    $data['footer'] = $this->load->view('footer', '', true);
	    $this->load->view('invoice/edit_invoice', $data);
	}

	function update() {
	    $this->invoicedb->update();
	    redirect('proform');
	}

	function download($id) {
	    if(!(intval($id) > 0 )) {
	      redirect('proform');
	    }
	        /**--------------Report Start-----------------**/
	  $this->word("Arial");
	  $this->getParagraph($text_1_2,true, "", 6,0);
	  $this->getParagraph($heading_2, true, "", 6,0);
	  $general = array();  
	  $general[] = array("Description of Cargo", $description_of_cargo);
	  $general[] = array("Vessel Name", $vessel_name);
	  $this->generateTable($general);
	  $status = true; 
	  try {
	    $month = date('M');
	    $month = strtoupper($month);
	    $this->saveAs("NES/nothing/proform.doc");
	  }
	  catch(Exception $e) {
	    $status = false;
	    echo $e->getmessage();
	  } 
	  echo $this->getStatus($status, $report_no, $file_name);
	  $this->close();
	}

}//end of the class
?>