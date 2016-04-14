<?php $this->load->view('header');?>
<div class="ui-layout-center">
   <div class="report-heading">
    <div class="add-form">
      <a class="show-content" href="#" rel="general-form">Add General Details</a> | 
      <a class="show-content" href="#" rel="detail-form">Add Container Details</a> |
      <?php echo anchor('common/delete/'. $common_id, "Detele This File", array("onclick" => "return confirm('Are Sure to delete the file $report_no');"));?>
    </div>
    <div><h2><?php echo $report_no;?></h2></div>
  </div>
  <div class="clear"></div>
  <h3 class="sub-title">General Details</h3>
  
  <div id="inspection_g_div">
    <?php echo isset($i_general) ? $i_general : ""; ?>
  </div>
  <h3 class="sub-title">Container Details</h3>
  <div id="inspection_d_div">
    <?php echo isset($i_list) ? $i_list : ""; ?>
  </div>
  
  <div id="general-form" style="display:none">
		    <?php $this->load->view('inspection/i_g_form');?>
	</div>
	<div id="detail-form" style="display:none">
		    <?php $this->load->view('inspection/i_c_form');?>
	</div>
	
	
</div>
<div class="ui-layout-north"><?php $this->load->view('file');?></div>
<div class="ui-layout-south">
  <?php echo form_open($form_action, array('method' => 'POST', 'id' => 'generate_form')); ?>
  <input type="submit" id="generate"  name="generate" value="Generate Report" onclick="add('generate_form', 'result_div');">
</form>
<div id="result_div"></div>
</div>

<?php $this->load->view('footer');?>