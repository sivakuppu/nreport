<?php $base_url = base_url();?>
<?php if(!empty($results)){ foreach($results as $value): ?>
<?php
  $id = $value->id;
  $invoice_no = $value->invoice_no;
  $invoice_date = $value->invoice_date;
  $marks = $value->marks; 
  $shipper = $value->shipper;
  $net_weight = $value->net_weight;
  $gross_weight = $value->gross_weight;
  $consignee = $value->consignee;
  $no_of_package = $value->no_of_package;
  $remark = $value->remark;

?>
<tr id="tr-<?php echo $id;?>">
  <td class="t_e_invoice" id="invoice_no-<?php echo $id;?>" ><?php echo $invoice_no;?></td>
  <td class="t_e_invoice" id="invoice_date-<?php echo $id;?>" ><?php echo $invoice_date;?></td>
  <td class="t_e_invoice" id="marks-<?php echo $id;?>" ><?php echo $marks;?></td>
  <td class="t_e_invoice" id="shipper-<?php echo $id;?>" ><?php echo $shipper;?></td>
  <td class="t_e_invoice" id="consignee-<?php echo $id;?>" ><?php echo $consignee;?></td>
  <td class="t_e_invoice" id="gross_weight-<?php echo $id;?>" ><?php echo $gross_weight;?></td>
  <td class="t_e_invoice" id="net_weight-<?php echo $id;?>" ><?php echo $net_weight;?></td>
  <td class="t_e_invoice" id="no_of_package-<?php echo $id;?>" ><?php echo $no_of_package;?></td>
  <td class="t_e_invoice" id="remark-<?php echo $id;?>" ><?php echo $remark;?></td>
  <td><a href="#" onclick="deleteInvoiceDetails(<?php echo $id;?>);"><img class="delete_image" src="<?php echo $base_url;?>images/delete.png"  /></a></td>
</tr>
<?php endforeach; }?>
