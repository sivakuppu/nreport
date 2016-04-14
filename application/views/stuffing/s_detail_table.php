<?php $base_url = base_url();?>
<?php if(!empty($results)){ foreach($results as $value): ?>
<?php
  $id = $value->id;
  $s_b_no = $value->s_b_no;
  $date = $value->date;//date("d.m.y",$value->date);
  $marks = $value->marks; 
  //$nunbers = $value->numbers;
  $shipper = $value->shipper;
  $consignee = $value->consignee;
  $gross_weight = round($value->gross_weight, 3);
  $no_of_packages = $value->no_of_packages;
  $measurement = $value->length."x".$value->breath."x".$value->height;
  $cmb = ($value->length * $value->breath * $value->height) / 1000000;
  $cmb = round($cmb, 3);
  $inspection = $value->inspection;

?>
<tr id="tr-<?php echo $id;?>">
  <td class="mouseover" id="s_b_no-<?php echo $id;?>" rel="s_b_no"><?php echo $s_b_no;?></td>
  <td class="mouseover" id="date-<?php echo $id;?>" rel="date"><?php echo $date;?></td>
  <td class="mouseover" id="marks-<?php echo $id;?>" rel="marks"><?php echo $marks;?></td>
  <td class="mouseover" id="shipper-<?php echo $id;?>" rel="shipper"><?php echo $shipper;?></td>
  <td class="mouseover" id="consignee-<?php echo $id;?>" rel="consignee"><?php echo $consignee;?></td>
  <td class="mouseover" id="gross_weight-<?php echo $id;?>" rel="gross_weight"><?php echo $gross_weight;?></td>
  <td class="mouseover" id="no_of_packages-<?php echo $id;?>" rel="no_of_packages"><?php echo $no_of_packages;?></td>
  <td class="mouseover" id="measurement-<?php echo $id;?>" rel="measurement"><?php echo $measurement;?></td>
  <td class="mouseover" id="inspection-<?php echo $id;?>" rel="inspection"><?php echo $inspection;?></td>
  <td><a href="#" onclick="deleteStuffingDetails(<?php echo $id;?>);"><img class="delete_image" src="<?php echo $base_url;?>images/delete.png"</a></td>
</tr>
<?php endforeach; }?>
