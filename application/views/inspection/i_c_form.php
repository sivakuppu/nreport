<?php
  $common_id = $this->session->userdata('common_id');
  echo form_open('inspection/addDetails', array('id' => 'inspection_container_details', 'class' => 'all-form', 'method' => 'POST'));
?>
<table class="common">
    <tr>
    <td><label for="container_no">Container Number</label></td> 
    <td><input type="text" id="container_no" class="input" name="container_no" value="" autocomplete="off"></td>
    </tr>
    <tr>
    <td><label for="size_type" >Size / Type</label></td>
    <td><select name="size_type" id="size_type" onchange="fillCubic(this);"><?php echo getTypeAndSize();?></select></td>
    </tr>
    <tr>
    <td><label for="gross_weight">Gross Weight</label></td>
    <td><input class="input" type="text" id="gross_weight" name="gross_weight" value=""></td>
     </tr>
    <tr>
    <td><label for="tare_weight">Tare Weight</label></td>
    <td><input class="input" type="text" id="tare_weight" name="tare_weight" value=""></td>
     </tr>
    <tr>
    <td><label for="mfd">MFD</label></td>
    <td><input class="input" type="text" id="mfd" name="mfd" value=""></td>
     </tr>
    <tr>
    <td><label for="cubic">Cubic</label></td>
    <td><input class="input" type="text" id="cubic" name="cubic" value=""></td>
     </tr>
    <tr>
    <td><label for="line">line</label></td>
    <td><input class="input" type="text" id="line" name="line" value=""></td>
    </tr>
    <tr>
    <td><input class="input" type="submit" id="add_inspection_details" name="add_inspection_details" value="Save" onclick="return add('inspection_container_details', 'inpection_tbody'); return false;"></td>
    <input type="hidden" name="common_id" value="<?php echo $common_id;?>">
    </tr>
</table>
</form>
<script>
  function fillCubic(element) {
    var s = $(element).val();
    var cubic = '';
    if(s == "20' GP / 22 G1") {
      cubic = "33.2";
    } 
    else if (s == "40' GP / 42 G1") {
      cubic = "67.7";
    }
    else if(s == "40' HC / 45 G1") {
      cubic = "76.4";
    }
    $("#cubic").val(cubic);
  }
</script>
<?php
function getTypeAndSize($id = '') {
      $rows = array("20' GP / 22 G1", "40' GP / 42 G1", "40' HC / 45 G1");
      $option = "<option value=''>Select</option>";
      foreach($rows as $row) {
        $option .= "<option ";
        $option .= $id == $row ? "selected" : "";
        $option .= "value = \"$row\" >";
        $option .= $row;
        $option .= "</option>";
      }
      return $option;
    }
?>