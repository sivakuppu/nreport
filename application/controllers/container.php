<?php
class Container extends CI_Controller {
	function Container()
	{
	  parent::__construct();	
	  $this->load->model('Container_model');
	  $this->output->enable_profiler(TRUE);
	}
	
	function add() {
	   $data = array(); 
	   $data['id'] = 1;
	   $data['number'] = '';
	   $data['size'] = '';
	   $data['liner'] = '';
	   $data['no_of_carton'] = '';
	   $data['gross_weight'] = '';
	   $data['net_weight'] = '';
	   $data['stuffing_commenced'] = '';
	   $data['stuffing_completed'] = '';
	   $data['p_from'] = '';
	   $data['p_to'] = '';
	   $data['stuffing_pattern'] = $this->getStuffingPatternEditTable(); 
	   $this->load->view('add_container', $data); 
	}

	function insert() {
	    echo $this->Container_model->insert();
	}
	
	function pattern($id) {
	  $row = $this->getContainer($id);
	  if(!empty($row)) {
		$pattern = unserialize($row->pattern);
		$table = "<table class='common'>";
		foreach($pattern as $key => $rows) {
		    $table .= "<tr>";
		    foreach($rows as $row) {
			$table .= '<td>'.$row.'</td>';
		    }
		    $table .= "</tr>";
		}
	    $table .= "</table>";	  
	  }
	  echo $table;
	  exit;
	}

	function getStuffingPatternEditTable($tableRow = 8, $tableCol = 14, $caption = "") {
	    $table = "<table width='100%'>";
	    $table .= $caption ? "<caption>$caption</caption>" : "";
	    $inital = 1;
	    for($row = 1; $row <= $tableRow; $row++) {
	      $table .= "<tr>";
	      $max = ($inital-1)+$tableCol;  
	      for($col = $inital; $col <= $max; $col++) {
		$table .= '<td><input size="5" type="text" name="pattern['.$row.'][]"  value="**" /></td>';
	      }
	      $table .= "</tr>";
	      $inital = $col;
	    }
	    $table .= "</table>";
	    return $table;
	}
}
?>