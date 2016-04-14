<?php echo $header;?>
<div id="proform">
<h2 style="text-align:center;">Proform</h2>
<div id="invoice_form_div" class="general-form"  title="General Details" >
  <?php echo form_open('proform/save', array('id' => "invoice_form", 'method' => 'POST' ,'class' => 'all-form'));?>
  
<table width="100%" class="common">
  <tr>
	<th>Invoice Date.</th>
	<th><input name="invoice_date" id="invoice_date" class="datepicker" autocomplete="off" type="text"></th>
	<th ><span style="float:left">Particulars</span> <span style="float:right">Quantity <input name="quantity" type="text" size="4"></span> </th>
  </tr>
  <tr>
      <th>Buyer</th>
      <th>
	<select class="input" name="client_id" style="width:235px"> 
	  <option value="0">Select</option> 
	  <?php echo $client_option;?> 
	</select>
      </th>
      <th rowspan="3"><textarea class="input-auto-complete" autocomplete="off" name="particulars" type="text" style="height: 165px; width: 500px;"></textarea></th>
  </tr>
  <tr >
    <th>Amount</th>
    <th >
	<input name="received_amount" id="received_amount" class="calculate_amount" type="text">
	<input id="received_amount_flag" type="checkbox"> Received

    </th >
</tr>
  <tr><th>  <div class="service_tax_div_class" style="clear:both;padding:5px;"><span>Service Tax </span></div>
  <div style="clear:both;padding:5px;"><span>Education Cess </span></div>
  <div style="clear:both;padding:5px;"><span>Secondary and Higher Education Cess</span></div>
</th>
<th>
<div>
  <div class="service_tax_div_class" style="clear:both;padding:5px;"><span style="float:left"><input class="tax_percentage" size="2" type="text" name="service_tax_percentage"> % = <input id="service_tax_amount" class="no_tax calculate_amount" size="8" type="text" name="service_tax_amount"></span></div>
  <div style="clear:both;padding:5px;"><span style="float:left"><input class="tax_percentage" size="2" type="text" name="education_cess_percentage" > % = <input class="calculate_amount" size="8" type="text" name="education_cess_amount" ></span></div>
  <div style="clear:both;padding:5px;"><span style="float:left"><input class="tax_percentage" size="2" type="text" name="sec_hig_cess_percentage"> % = <input class="calculate_amount" size="8" type="text" name="sec_hig_cess_amount"></span></div>
</div>
</th></tr>
  <tr>
    <th>Total Amount</th><th> <input id="amount" name="amount" type="text"></th> <th><input style="float:right" type="submit" value="Save" id="save_invoice"/></th>
</tr>
  

</table>
</form>
<?php echo $proform_lists;?>
</div>
<?php echo $footer;?>
