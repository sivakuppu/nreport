  <table width="100%" class="common">
    <tr>
      <td class="td_size"><label for="s_b_no" >S.B Number</label></td>
      <td><input type="text" id="s_b_no" class="input" name="s_b_no" ></td>
      <td class="td_size"><label for="date" >Date</label></td>
      <td><input type="text" id="date" class="input datepicker" name="date" ></td>
    </tr>
    <tr>
      <td class="td_size"><label for="marks" >Marks / Numbers</label></td>
      <td><input type="text" id="marks" class="input" name="marks" ></td>
    
      <td class="td_size"><label for="shipper" >Shipper</label></td>
      <td><input type="text" id="shipper" class="input" name="shipper" ></td>
    </tr>
    <tr>  
      <td class="td_size"><label for="consignee" >Consignee</label></td>
      <td><input type="text" id="consignee" class="input" name="consignee" ></td>
      <td class="td_size"><label for="gross_weight" >Gross Weight</label></td>
      <td><input type="text" id="gross_weight" class="input_border" name="gross_weight" size="27" > <sub>Kgs</sub></td>
    </tr>
    <tr>        
      <td class="td_size"><label for="no_of_packages" >Number of Packages</label></td>
      <td><input type="text" id="no_of_packages" class="input" name="no_of_packages" ></td>
      <td class="td_size"><label for="length" >Measurement</label></td>
      <td>
        <input type="text" id="length" class="input_border" name="length" size="5"> x 
        <input type="text" id="breath" class="input_border" name="breath" size="5"> x   
        <input type="text" id="height" class="input_border" name="height" size="5"> 
      </td>
    </tr>
    <tr>        
      <td class="td_size"><label for="inspection" >Inspection Cartons</label></td>
      <td><input type="text" id="inspection" class="input" name="inspection" ></td>
      
      <td colspan="2"><input type="submit" style="margin-left:80px;" name="add_container_details" value="Add" onclick="return add('suffing_details_form', 'stuffing_details_tbody'); return false; "></td>
    </tr>
   </table>

