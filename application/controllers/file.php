<?php echo form_open('commom' , array('method' => 'POST'));?>
<label for="report_type">Report Type</label>
<select name="report_type" id="report_type">  
  <option value="stuffing">STUFFING REPORT</option>
  <option value="inspection">EMPTY CONTAINER INSPECTION</option>
</select>

<label for="c_f_agent">C & F Agent</label> 
<input type="text" id="c_f_agent" class="input client_input auto_client" name="c_f_agent" autocomplete="off" value="" rel="inspection/client">
<input type="hidden" id="client_id"  name="client_id" value="0" >
</form>

