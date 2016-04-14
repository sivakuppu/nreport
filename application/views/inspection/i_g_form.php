<?php
  $common_id = $this->session->userdata('common_id');
  echo form_open('inspection/add', array('id' => 'inspection_general_details', 'class' => 'all-form', 'method' => 'POST'));
?>
<table class="common">
      <tr>      
        <td><label for="job_order">Job Order No.</label></td> 
        <td><input type="text" id="job_order" class="input-border input-right" name="job_order" value="" autocomplete="off"></td>
      </tr>
      <tr>
        <td><label for="place_of_survey" >Place of Survey</label></td>
        <td><input type="text" id="place_of_survey" class="input auto_place" name="place_of_survey" value=""></td>
      </tr>
      <tr>             
        <td><label for="date_of_survey" style="margin-right:29px;">Date of survey </label></td>
        <td><input type="text" id="date_of_survey"  name="date_of_survey" size="12" class="border datepicker" value=""></td>
      </tr>
      <tr>        
       
        <td><label for="left_side">Left Side</label></td>
        <td><input class="input" type="text" id="left_side" name="left_side" value="NORMAL WEAR & TEAR"></td>
      </tr>
      <tr>
        <td><label for="right_side">Right Side</label></td>
        <td><input class="input" type="text" id="right_side" name="right_side" value="NORMAL WEAR & TEAR"></td>
      </tr>
      <tr>        
        <td><label for="front_side">Front Side</label></td>
        <td><input class="input" type="text" id="front_side" name="front_side" value="NORMAL WEAR & TEAR"></td>
      </tr>
      <tr>        
        <td><label for="roof_side">Roof Side</label></td>
        <td><input class="input" type="text" id="roof_side" name="roof_side" value="NORMAL WEAR & TEAR"></td>
      </tr>
      <tr>
        <td><label for="interior">Interior</label></td>
        <td><input class="input" type="text" id="interior" name="interior" value="NORMAL WEAR & TEAR"></td>
      </tr>
      <tr>                  
        <td><label for="rear_side">Rear Side</label></td>
        <td><input class="input" type="text" id="rear_side" name="rear_side" value="NORMAL WEAR & TEAR"></td>
      </tr>
      <tr>                  
        <td><label for="under_structure">Under Structure</label></td>
        <td><input class="input" type="text" id="under_structure" name="under_structure" value="Not Made Available for Inspection"></td>
      </tr>
      <tr>        
        <td><label for="note">Note</label></td>
        <td><textarea id="note" name="note" rows="3" cols="40" class="input-border" > <?php echo NOTE;?></textarea></td>
      </tr>
      <tr>        
        <td><input class="input" type="submit" id="add_inspection_general" name="add_inspection_general" value="Save" onclick="return add('inspection_general_details', 'inspection_g_div'); return false;"></td>
</tr>        
        <input type="hidden" name="common_id" value="<?php echo $common_id;?>">
        <input type="hidden" name="ajax" value="1">
</table>
</form>

