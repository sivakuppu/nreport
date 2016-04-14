<?php

class Importer extends CI_Controller {
               
	function Importer()
	{
 		parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('CE/importer_model');
	}	
	function index()
	{			
	  $data = ''; 
		$this->form_validation->set_rules('name','importer Name','required|trim|xss_clean');			
		$this->form_validation->set_rules('address1','Address1','trim|xss_clean');			
		$this->form_validation->set_rules('address2','Address2','trim|xss_clean');			
		$this->form_validation->set_rules('address3','Address3','trim|xss_clean');			
		$this->form_validation->set_rules('country','Country','trim|xss_clean|max_length[255]');			
		$this->form_validation->set_rules('state','State','trim|xss_clean|max_length[255]');			
		$this->form_validation->set_rules('city','City','trim|xss_clean');			
		$this->form_validation->set_rules('pin_code','Pin Code','trim|xss_clean|max_length[255]');			
		$this->form_validation->set_rules('phone_no','Phone No','trim|xss_clean|max_length[255]');			
		$this->form_validation->set_rules('mobile_no','Mobile No','trim|xss_clean|max_length[255]');			
		$this->form_validation->set_rules('fax','Fax','trim|xss_clean|max_length[255]');			
		$this->form_validation->set_rules('email_id','Email Id','trim|xss_clean|max_length[255]');			
		$this->form_validation->set_rules('remarks','Remarks','trim|xss_clean');			
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == TRUE) // validation hasn'\t been passed
		{
			$form_data = array(
					       	'name' => set_value('name'),
					       	'address1' => set_value('address1'),
					       	'address2' => set_value('address2'),
					       	'address3' => set_value('address3'),
					       	'country' => set_value('country'),
					       	'state' => set_value('state'),
					       	'city' => set_value('city'),
					       	'pin_code' => set_value('pin_code'),
					       	'phone_no' => set_value('phone_no'),
					       	'mobile_no' => set_value('mobile_no'),
					       	'fax' => set_value('fax'),
					       	'email_id' => set_value('email_id'),
					       	'remarks' => set_value('remarks'),
					       	'created_by' => 1,
					       	'created_on' => date('Y-m-d H:i:s'),
						);
					
			// run insert model to write data to db
		
			if ($this->importer_model->SaveForm($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				$data['ce_message'] = 'Successfully Added';
			}
			else
			{
			   $data['ce_error'] = 'Unable to the add';
			// Or whatever error handling is necessary
			}
		 }
		
		$this->load->view('CE/importer', $data);
	}
	
	function search() {
	   $q = $_REQUEST['q'];
	   echo $this->importer_model->search($q);
	   exit;
  }
  
  function get_search_data() {
    $importer_search_text = $this->input->post('importer_search_text');
    $importer = $this->importer_model->get_search_data($importer_search_text);
        
    $data = '';
    if(!empty($importer)) {
      $data = (array)$importer;
      $this->load->view('CE/importer_edit', $data);
      return;
    }
    $this->load->view('CE/importer', $data);
  } 
  
  function update() {
    $id = $_POST['id'];
    if($id > 0) {
      $importer_data = $_POST;
      unset($importer_data['id']);
      unset($importer_data['submit']);
      $this->importer_model->update($importer_data, $id);  
    }
    redirect('CE/importer');
  }
	
}// end of the class
?>