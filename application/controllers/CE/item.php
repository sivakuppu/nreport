<?php

class Item extends CI_Controller {
               
	function Item()
	{
 		parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('CE/item_model');
		$this->load->model('CE/category_model');
		//$this->output->enable_profiler(TRUE);  
	}	
	function index()
	{			
	  $data['item_category_id'] = $this->category_model->getCategoryDropdown(); 
		$this->form_validation->set_rules('item_category_id','Item Category','required|trim|max_length[11]');			
		$this->form_validation->set_rules('item_name','Item Name','required|trim|max_length[255]');			
		$this->form_validation->set_rules('item_specification','Item Specification','trim');			
		$this->form_validation->set_rules('manufacturer','Manufacturer','trim|max_length[255]');			
		$this->form_validation->set_rules('model','Model','max_length[255]');			
		$this->form_validation->set_rules('capacity','Capacity','trim|max_length[255]');			
		$this->form_validation->set_rules('purpose','Purpose','trim');			
		$this->form_validation->set_rules('manufacturing_year','Manufacturing Year','trim|max_length[255]');			
	//	 $this->form_validation->set_rules('cost_brand_new','Cost Brand New','trim|max_length[255]');			
	//	$this->form_validation->set_rules('cost_reconditioned','Cost Reconditioned','trim|max_length[255]');			
		//$this->form_validation->set_rules('appraised_value','Appraised Value','trim|max_length[255]');
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn'\t been passed
		{
			// $this->load->view('CE/item', $data);
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
					       	'item_category_id' => set_value('item_category_id'),
					       	'item_name' => set_value('item_name'),
					       	'item_specification' => set_value('item_specification'),
					       	'manufacturer' => set_value('manufacturer'),
					       	'model' => set_value('model'),
					       	'capacity' => set_value('capacity'),
					       	'purpose' => set_value('purpose') ,
					       	'manufacturing_year' => set_value('manufacturing_year')
					      // 	'cost_brand_new' => set_value('cost_brand_new'),
					      // 	'cost_reconditioned' => set_value('cost_reconditioned'),
					       //	'appraised_value' => set_value('appraised_value')
						);
					
			// run insert model to write data to db
		
			if ($this->item_model->SaveForm($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
					$data['ce_message'] = 'Successfully Added';
			}
			else
			{
			   $data['ce_error'] = 'Unable to the add';
			//  Or whatever error handling is necessary
			}
		 }
		
		$this->load->view('CE/item', $data);
	}
	function search() {
	   $q = $_REQUEST['q'];
	   echo $this->item_model->search($q);
	   exit;
  }
  
	function get_search_data() {
    $item_id = $this->input->post('item_id');
    $item = $this->item_model->get_search_data($item_id);
        
    $data = '';
    if(!empty($item)) {
      $data = (array)$item;
      $data['item_category_id'] = $this->category_model->getCategoryDropdown($data['item_category_id']); 
      $this->load->view('CE/item_edit', $data);
      return;
    }
    $this->load->view('CE/item', $data);
  } 
  
  function update() {
    $id = $_POST['id'];
    if($id > 0) {
      $item_data = $_POST;
      unset($item_data['id']);
      unset($item_data['submit']);
      $this->item_model->update($item_data, $id);  
    }
    redirect('CE/item');
  }
}
?>