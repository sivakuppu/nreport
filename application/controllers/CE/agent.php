<?php

class Agent extends CI_Controller {
               
	function Agent()
	{
 		parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('CE/agent_model');
	}	
	function index()
	{			
	  $data = ''; 
		$this->form_validation->set_rules('name','Agent Name','required|trim');			
		$this->form_validation->set_rules('address1','Address1','trim');			
		$this->form_validation->set_rules('address2','Address2','trim');			
		$this->form_validation->set_rules('address3','Address3','trim');			
		$this->form_validation->set_rules('country','Country','trim|max_length[255]');			
		$this->form_validation->set_rules('state','State','trim|max_length[255]');			
		$this->form_validation->set_rules('city','City','trim');			
		$this->form_validation->set_rules('pin_code','Pin Code','trim|max_length[255]');			
		$this->form_validation->set_rules('phone_no','Phone No','trim|max_length[255]');			
		$this->form_validation->set_rules('mobile_no','Mobile No','trim|max_length[255]');			
		$this->form_validation->set_rules('fax','Fax','trim|max_length[255]');			
		$this->form_validation->set_rules('email_id','Email Id','trim|max_length[255]');			
		$this->form_validation->set_rules('remarks','Remarks','trim');			
			
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
		
			if ($this->agent_model->SaveForm($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				$data['ce_message'] = 'Successfully Added';
			}
			else
			{
			   $data['ce_error'] = 'Unable to the add';
			// Or whatever error handling is necessary
			}
		 }
		
		$this->load->view('CE/agent', $data);
	}
	
	function search() {
	   $q = $this->input->get_post('q', TRUE);	
	   if($q){
			echo $this->agent_model->search($q);
	   }
	   exit;
  }
  
  function get_search_data() {
    $agent_search_text = $this->input->post('agent_search_text');
    $agent = $this->agent_model->get_search_data($agent_search_text);
        
    $data = '';
    if(!empty($agent)) {
      $data = (array)$agent;
      $this->load->view('CE/agent_edit', $data);
      return;
    }
    $this->load->view('CE/agent', $data);
  } 
  
  function update() {
    $id = $_POST['id'];
    if($id > 0) {
      $agent_data = $_POST;
      unset($agent_data['id']);
      unset($agent_data['submit']);
      $this->agent_model->update($agent_data, $id);  
    }
    redirect('CE/agent');
  }
	
}// end of the class
?>