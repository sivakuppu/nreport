<?php $this->load->view('CE/header');?>
<div class="ui-layout-center">
   
</div>

<div class="ui-layout-north">
  <ul>
    <li><?php echo anchor('CE/agent', 'Agent');?></li>
    <li></li>
    <li></li>
  </ul>
</div>

<div class="ui-layout-south">
  <?php //echo form_open($form_action, array('method' => 'POST', 'id' => 'generate_form')); ?>
  <input type="submit" id="generate"  name="generate" value="Generate Report" onclick="add('generate_form', 'result_div');">
</form>
<div id="result_div"></div>
</div>

<?php $this->load->view('CE/footer');?>