<?php

class Item_detail extends CI_Controller {
               
	function Item_detail()
	{
 		parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('CE/item_detail_model');
		$this->load->model('CE/category_model');
	}	
	function index($certificate_id = '')       
	{			
	  if($certificate_id > 0){ 
	   $all_row = $this->item_detail_model->getAllRow($certificate_id);
	   $data['result'] =  (array) $all_row;
    }
    else {
      $data['result'] = '';
    } 
	  $data['item_category_id'] = $this->category_model->getCategoryDropdown(); 
	  $data['certificate_id'] = $certificate_id;
		//$this->form_validation->set_rules('item_category','Item Category','max_length[11]');			
		$this->form_validation->set_rules('item_name','Item Name','');			
		$this->form_validation->set_rules('ce_remarks','CE Remarks','trim');			
		$this->form_validation->set_rules('specification','Specification','trim');			
		$this->form_validation->set_rules('year_of_mfg','Year of MFG','trim|max_length[255]');			
		$this->form_validation->set_rules('quantity','Quantity','trim|max_length[255]');			
		$this->form_validation->set_rules('eval_year_of_mfg','Eval. Year of MFG','trim|max_length[255]');			
		$this->form_validation->set_rules('cost_of_machine','Cost of Machine','trim|max_length[255]');			
		$this->form_validation->set_rules('cost_of_recondition','Cost of Recondition','trim|max_length[255]');			
		$this->form_validation->set_rules('appraised_value','Appraised Value','trim|max_length[255]');			
		$this->form_validation->set_rules('make','make','trim|max_length[255]');
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn'\t been passed
		{
			$this->load->view('CE/item_detail', $data);
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
			            'certificate_id' => $certificate_id, 
					       	//'item_category_id' => set_value('item_category_id'),
					       	'item_name' => set_value('item_name'),
					       	'ce_remarks' => set_value('ce_remarks'),
					       	'specification' => set_value('specification'),
					       	'year_of_mfg' => set_value('year_of_mfg'),
					       	'quantity' => set_value('quantity'),
					       	'eval_year_of_mfg' => set_value('eval_year_of_mfg'),
					       	'cost_of_machine' => set_value('cost_of_machine'),
					       	'cost_of_recondition' => set_value('cost_of_recondition'),
					       	'appraised_value' => set_value('appraised_value'),
					       	'make' => set_value('make')
						);
					
			// run insert model to write data to db
		
			if ($this->item_detail_model->SaveForm($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				redirect("CE/item_detail/index/$certificate_id");
			}
			else
			{
			echo 'An error occurred saving your information. Please try again later';
			// Or whatever error handling is necessary
			}
			
		}
		//$this->load->view('CE/item_detail', $data);
	}
	function success()
	{
			echo 'this form has been successfully submitted with all validation being passed. All messages or logic here. Please note
			sessions have not been used and would need to be added in to suit your app';
	}
	
	function update() {     
	  $this->item_detail_model->update();
  }
  
  function search() {
    $result = $this->item_detail_model->search($_POST);
    $tr = "";
    if(empty($result)) {
      $tr = "<tr><td colspan= '11'>No Row found</td></tr>";
    } 
    else {
      foreach($result as $key => $value) {
        extract((array)$value); 
        $tr .= "<tr>";
        $tr .= "<td>".($key+1)."</td>";
        $tr .= "<td >$item_name</td>";
        $tr .= "<td >$specification</td>";
        $tr .= "<td >$make</td>";
        $tr .= "<td >$quantity</td>";
        $tr .= "<td >$year_of_mfg</td>";
        $tr .= "<td >$ce_remarks</td>";
        $tr .= "<td >$cost_of_machine</td>";
        $tr .= "<td >$cost_of_recondition</td>";
        $tr .= "<td >$appraised_value</td>";
        $tr .= "<td >$eval_year_of_mfg</td>";  
        $tr .= "</tr>";
      }
     }
     echo $tr;
  }//end of the function
  
  function delete($id)  {
    if($id > 0) {
      $response =  $this->item_detail_model->delete($id);
      echo 1;
    }
  }
  
}
?>