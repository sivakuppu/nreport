<?php

class Category extends CI_Controller {
               
	function Category()
	{
 		parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('category_model');
	}	
	function index()
	{			
	  $data = ''; 
		$this->form_validation->set_rules('category_name','Category Name','required|trim|xss_clean|max_length[255]');			
		$this->form_validation->set_rules('description','Description','trim');
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn'\t been passed
		{
			$this->load->view('category', $data);
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
					       	'category_name' => set_value('category_name'),
					       	'description' => set_value('description')
						);
					
			// run insert model to write data to db
		
			if ($this->category_model->SaveForm($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				redirect('category/success');   // or whatever logic needs to occur
			}
			else
			{
			echo 'An error occurred saving your information. Please try again later';
			// Or whatever error handling is necessary
			}
		}
	}
	function success()
	{
			echo 'this form has been successfully submitted with all validation being passed. All messages or logic here. Please note
			sessions have not been used and would need to be added in to suit your app';
	}
}
?>