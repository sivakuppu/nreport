<?php
  $report_type = $this->session->userdata('report_type');
  $report_type = !empty($report_type) ? $report_type : 0; 
  echo form_open('common/addfile' , array('method' => 'POST'));
?>
<label for="report_type">Report Type</label>
<select name="report_type" id="report_type">  
  <option value="0">Select</option>
  <option value="1" <?php echo $report_type == 1 ? "selected" : "";?> >STUFFING REPORT</option>
  <option value="2" <?php echo $report_type == 2 ? "selected" : "";?> >EMPTY CONTAINER INSPECTION</option>
  <option value="3" <?php echo $report_type == 3 ? "selected" : "";?> >CONTAINER STUFFING SUVERY REPORT</option>
  <option value="4" <?php echo $report_type == 4 ? "selected" : "";?> >GRANITE STUFFING SUVERY REPORT</option>
</select>


<label>C & F Agent </label>
<select class="input" name="client_id" style="width:100px"> 
  <option value="0">Select</option> 
   <?php echo $client_option;?> 
</select>
<!--<label>Reference Agent</label>
<select class="input" name="client_refer_id" style="width:100px">
  <option value="0">Select</option> 
   <?php echo $refer_option;?> 
</select>-->
<input type="submit" id="go"  name="go" value="GO" >
</form>


