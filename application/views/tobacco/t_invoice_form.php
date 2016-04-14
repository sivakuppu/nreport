  <table width="100%" class="common">
    <tr>
      <td class="td_size"><label for="invoice_no" >Invoice No.</label></td>
      <td><input type="text" id="invoice_no" class="input" name="invoice_no" ></td>
      <td class="td_size"><label for="invoice_date" >Invoice Date</label></td>
      <td><input type="text" id="invoice_date" size="14" class="border datepicker"  autoComplete="off" name="invoice_date" ></td>
    </tr>
    <tr>
      <td class="td_size"><label for="marks" >Marks & Nos</label></td>
      <td><textarea id="marks" class="input" name="marks"></textarea></td>
      <td class="td_size"><label for="shipper" >Shipper</label></td>
      <td><input type="text" id="shipper" class="input" name="shipper" ></td>
    </tr>
    <tr>
      <td class="td_size"><label for="consignee" >Consignee</label></td>
      <td><input type="text" id="consignee" class="input" name="consignee" ></td>
    
      <td class="td_size"><label for="gross_weight" >Gross Weight</label></td>
      <td><input type="text" id="gross_weight" class="input" name="gross_weight" ></td>
    </tr>
    <tr>
      <td class="td_size"><label for="net_weight" >Net Weight</label></td>
      <td><input type="text" id="net_weight" class="input" name="net_weight" ></td>
    
      <td class="td_size"><label for="no_of_package" >No. of Package</label></td>
      <td><input type="text" id="no_of_package" class="input" name="no_of_package" ></td>
    </tr>
    <tr>
     <td class="td_size"><label for="remark-1" >Remark</label></td>
     <td colspan="2"><textarea id="remark-1" class="input" name="remark"></textarea></td>
     <td><input type="submit" id="add_invoice_details"  name="add_invoice_details" value="Add" onclick="return add('tobacco_invoice_form', 'tobacco_invoice_tbody'); return false;"></td>
    </tr>
   </table>

