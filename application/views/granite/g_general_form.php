   <table width="100%" class="common">
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
        <td class="td_size"><label for="container_type" >Container Type</label></td>
       <td><?php echo getContainerType(3);?></td>  
        <td class="td_size"><label for="description_of_cargo" >Description of Cargo</label></td>
        <td><input type="text" id="description_of_cargo" class="input" name="description_of_cargo"></td>
      </tr>
      <tr>
        <td class="td_size"><label for="vessel_name" >Vessel Name</label></td>
        <td><input type="text" id="vessel_name" class="input" name="vessel_name" ></td>
        <td class="td_size"><label for="voyage_no" >Voyage Number</label></td>
        <td><input type="text" id="voyage_no" class="input" name="voyage_no"></td>
      </tr>
      <tr>
        <td class="td_size"><label for="exporter" >Exporter</label></td>
        <td><textarea id="exporter" class="input" name="exporter" ></textarea></td>
        <td class="td_size"><label for="consignee" >Consignee</label></td>
        <td><textarea id="consignee" class="input" name="consignee"></textarea></td>
      </tr>
      <tr>
        <td class="td_size"><label for="invoice_no" >Invoice No.</label></td>
        <td><input type="text" id="invoice_no" class="input" name="invoice_no" ></td>
        <td class="td_size"><label for="marks_blocks" >Marks & No. of Blocks</label></td>
        <td><textarea id="marks_blocks" class="input" name="marks_blocks"></textarea></td>
      </tr>
      <tr>
        <td class="td_size"><label for="port_of_loading" >Port of Loading</label></td>
        <td><input type="text" id="port_of_loading" class="input" name="port_of_loading" ></td>
        <td class="td_size"><label for="shipping_bill_no" >Shipping Bill No.</label></td>
        <td><input type="text" id="shipping_bill_no" class="input" name="shipping_bill_no"></td>
      </tr>
      <tr>
        <td class="td_size"><label for="port_of_discharge" >Port of Discharge</label></td>
        <td><input type="text" id="port_of_discharge" class="input" name="port_of_discharge" ></td>
        <td>
          <input type="submit" name="add_general_details" value="Save" onclick="return add('granite_general_form', 'general-table'); return false;">
        </td>
      </tr>
  </table>
