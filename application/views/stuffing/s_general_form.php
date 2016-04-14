   <table width="100%" class="common">
      <tr>
        <td><label for="number_of_container"  >Type of Container</label> </td>
        <td>  <?php echo $container_type;?></td>   
      </tr>
      <tr>
        <td class="td_size"><label for="place_of_survey" >Place of Survey</label></td>
        <td><input type="text" id="place_of_survey" class="input" name="place_of_survey"></td>
        <td >
          <label for="date_of_survey" >Date of survey </label>
          </td>
          <td>
          <input type="text" id="date_of_survey"  autoComplete="off" name="date_of_survey" class="border datepicker" size="12" onchange="changeDate(this);"> 
        </td>
      </tr>
      <tr>
        <td class="td_size"><label for="vessel_name" >Vessel Name</label></td>
        <td><input type="text" id="vessel_name" class="input" name="vessel_name" ></td>
        <td class="td_size"><label for="voyage_number" >Voyage Number</label></td>
        <td><input type="text" id="voyage_number" class="input" name="voyage_number"></td>
      </tr>
      <tr>
        <td class="td_size"><label for="container_number" >Container Number</label></td>
        <td><input type="text" id="container_number" class="input" name="container_number" ></td>
        <td class="td_size"><label for="port_of_shipment" >Port of Shipment</label></td>
        <td><input type="text" id="port_of_shipment" class="input" name="port_of_shipment"></td>
      </tr>
      <tr>
        <td class="td_size"><label d="port_of_discharge" >Port of Discharge</label></td>
        <td><input type="text" id="port_of_discharge" class="input" name="port_of_discharge" ></td>
      
        <td class="td_size" ><label for="description" >Description</label></td>
        <td><input type="text" id="description" class="input" name="description"></td>
      </tr>
      <tr>
      
        <td class="td_size" ><label for="stuffing_commenced" >Stuffing Commenced</label></td>
        <td>
          <input type="text" id="stuffing_commenced" size="12" class="border datepicker" autoComplete="off" name="stuffing_commenced"  >
          <input type="text" class="border" size="5" name="stuffing_commenced_hour"> :
        <input type="text" class="border" size="5" name="stuffing_commenced_min"> 
        </td>
        <td class="td_size" ><label for="stuffing_completed">Stuffing Completed</label></td>
        <td>
        <input type="text" id="stuffing_completed" size="12" class="border datepicker"  autoComplete="off" name="stuffing_completed" >
        <input type="text" class="border" size="5" name="stuffing_completed_hour"> :
        <input type="text" class="border" size="5" name="stuffing_completed_min">  
        </td>
      </tr>
      <tr>
        <td colspan="4"><div><label for="remark" style="float:left;">Remarks</label><a href="#" class="show_remark">(Other)</a> <br>
          <div id="other_remark">
            <label for="official_seal" >Custom Seal No</label>
            <input type="text" id="official_seal" name="official_seal">
            <label for="liner_seal" >Liner Seal No</label>
            <input type="text" id="liner_seal" name="liner_seal" >
          </div>
          <textarea id="remark" class="input remarks" style="display:none;" name="remark" >
            <?php  echo REMARKS; ?>
          </textarea>
          </div>
        </td>
      </tr>
      <tr>
        <td>
          <input type="submit" name="add_general_details" value="Save" onclick="return add('stuffing_general_form', 'general-table'); return false;">
        </td>
      </tr>
  </table>
  <script>
  function changeDate(element) {
    var d = $(element).val();
    $('#stuffing_commenced').val(d);
    $('#stuffing_completed').val(d);
    
  }
  </script>

