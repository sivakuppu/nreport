<?php

define('INSERT_FILE_STATUS',0);
define('UPDATE_FILE_STATUS',1);

class Search extends CI_Controller {
	var $name = array();
	var $file_pattern = array();

	function Search()
	{
		parent::__construct();	
		$this->name[1] = "tobacco";
		$this->file_pattern[1] = 'NES/LEP/S/%s/%s';
		$this->load->model('file');
		$this->output->enable_profiler(TRUE);
	}
	
	function index()
	{     $data['page_title'] = 'Search';
	      $data['type'][1] = array('name' => 'type', 'value' => 1);
	      $data['name'] = $this->name;
	      $data['action'] = 'search/choose';
	      $data['search_field'] = array('name' => 'search_text');
	      $this->load->view('search',$data);            
	}

	function choose() {
	    $add_file = $this->input->post('add_file');
	    //$search_file = $this->input->post('search_file');
	    $search_text = $this->input->post('search_text');
	    $type = $this->input->post('type');  

	    if($search_text && $type && $add_file) {
	      $file = $this->file->exists($type, $search_text);
//var_dump($file);
	      if(!$file) {
		  $insert = array();
  		  $insert['type'] = $type;
		  $insert['file_id'] = $search_text;
		  $report_id = $this->file->insert($insert);
		  $this->session->set_userdata('type', $type);
		  redirect("tobacco/$report_id");
	      }
	      else {
		  $error = "The File '$search_text' already exists.";
		  $data['page_title'] = 'Search';
		  $data['type'][1] = array('name' => 'type', 'value' => 1, 'checked' => 'checked');
		  $data['name'] = $this->name;
		  $data['action'] = 'search/choose';
		  $data['search_field'] = array('name' => 'search_text', 'value' => $search_text);
	          $this->load->view('search',$data);
	      }
	    }
	}
      
	//function generateFile($type, $) {
// 	  $this->file_pattern[]
// 	  "NES/LEP/S/000$id/".date('y-m');
	//}
}