<table id="invoice-table" class="common" width="100%" style="margin-top:10px;">
<!--  <tr>
    <th colspan="5" style="background:#ccc">
     <?php echo form_open('proform', array('id' => "proform_search_form", 'method' => 'POST' ,'class' => 'all-form'));?>
      <span>Invoice Date <input type="text" class="datepicker" autocomplete="off" name="search_invoice_date" value="<?php echo $search_invoice_date;?>" ></span>
      <span>Client
	<select class="input" name="search_client_id" style="width:235px"> 
	  <option value="0">Select</option> 
	  <?php echo $search_client_option;?> 
	</select>
      </span>
      <input type="submit" name="proform_search" value="Search" >
      <input type="submit" name="proform_clear" value="Clear" >
      </form>
    </th>
  </tr>-->

  <tr>
    <th style="background:#ccc;color:#fff">INVOICE NO.</th>
    <th style="background:#ccc;color:#fff">BUYER </th>
    <th style="background:#ccc;color:#fff">INVOICE DATE</th>
    <th style="background:#ccc;color:#fff">AMOUNT</th>
    <th style="background:#ccc;color:#fff" width="15%">ACTION</th>
  </tr>
  <?php if(empty($proform_data)) { ?>
  <?php } else { ?>
  <?php foreach($proform_data as $proform_list ) { ?>
    <?php $tax_value = explode(",", $proform_list->tax_value); ?>
<tr id="tr-master-<?php echo $proform_list->id;?>">
    <th><?php echo $proform_list->id;?></th>
    <th><?php echo $proform_list->name;?></th>
    <th><?php echo $proform_list->invoice_date;?></th>
    <th><?php echo $proform_list->amount;?></th>
    <th>
	<span><?php echo anchor('proform/edit/' . $proform_list->id, "Edit");?></span>
	<span><?php echo anchor('proform/delete/' . $proform_list->id, "Delete");?></span>
	<span><?php echo anchor('proform/download/' . $proform_list->id, "Download");?></span>
	<span><a href="#" onclick="showMoreProformDetail('<?php echo $proform_list->id;?>', this);">More</a></span>
    </th>
</tr>
<tr id="tr-slave-<?php echo $proform_list->id;?>" style="display:none;" rel="0">
    <td colspan="5">
	<table width="100%" class="common">
	  <tr>
		<th width="20%">Received Amount</th>
		<th ><?php echo $proform_list->received_amount;?></th >
		<th >Particulars [ Quantity <?php echo $proform_list->quantity;?> ]</th>
	  </tr>
	</tr>
	  <tr><th width="20%">  <div class="service_tax_div_class" style="clear:both;padding:5px;"><span>Service Tax </span></div>
	  <div style="clear:both;padding:5px;"><span>Education Cess </span></div>
	  <div style="clear:both;padding:5px;"><span>Secondary and Higher Education Cess</span></div>
	</th>
	<th>
	<div>
	  <div class="service_tax_div_class" style="clear:both;padding:5px;"><span style="float:left"><?php echo $tax_value[0];?> % = <?php echo $tax_value[3];?></span></div>
	  <div style="clear:both;padding:5px;"><span style="float:left"><?php echo $tax_value[1];?> % = <?php echo $tax_value[4];?></span></div>
	  <div style="clear:both;padding:5px;"><span style="float:left"><?php echo $tax_value[2];?> % = <?php echo $tax_value[5];?></span></div>
	</div>
	</th>
	      <th rowspan="2"><?php echo $proform_list->particulars;?></th>

</tr>
	  <tr>
	    <th width="20%">Total Amount</th><th><?php echo $proform_list->amount;?></th>
	</tr>

	</table>
    </td>
</tr>
  <?php } ?>

  <?php } ?>

</table>
