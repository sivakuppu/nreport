   <table width="100%" class="common">
      <tr>
        <td class="td_size"><label for="place_of_stuffing" >Place of Stuffing</label></td>
        <td><input type="text" id="place_of_stuffing" class="input" name="place_of_stuffing"></td>
        <td >
         <label for="start_date_of_stuffing" >Date of Stuffing </label>
        </td >
        <td > 
          <input type="text" id="start_date_of_stuffing"  autoComplete="off" name="start_date_of_stuffing" class="border datepicker" size="12" > - 
          <input type="text" id="end_date_of_stuffing"  autoComplete="off" name="end_date_of_stuffing" class="border datepicker" size="12" > 
        </td>
      </tr>
      <tr>
        <td class="td_size"><label d="port_of_discharge" >Port of Discharge</label></td>
        <td><input type="text" id="port_of_discharge" class="input" name="port_of_discharge" ></td>
      
        <td class="td_size" ><label for="description" >Description of Cargo</label></td>
        <td><input type="text" id="description" class="input" name="description"></td>
      </tr>
      
      <tr>
        <td colspan="4"><div><label for="remark" style="float:left;">Remarks</label><a href="#" class="show_remark">(Other)</a> <br>
          <div id="other_remark">
            <label for="official_seal" >Custom Seal No</label>
            <input type="text" id="official_seal" name="official_seal">
            <label for="liner_seal" >Liner Seal No</label>
            <input type="text" id="liner_seal" name="liner_seal" >
          </div>
          <textarea id="remark" class="input remarks" style="display:none;" name="remark" > </textarea>
          <textarea id="remark-base"  style="display:none;" ><?php  echo REMARKS; ?></textarea>
          </div>
        </td>
      </tr>
      <tr>
        <td>
          <input type="submit" name="add_general_details" value="Save" onclick="return add('tobacco_general_form', 'general-table'); return false;">
        </td>
      </tr>
  </table>
