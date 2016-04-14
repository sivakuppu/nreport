<?php $base_url = base_url();?>
<?php if(!empty($results)){ foreach($results as $value): ?>
<?php
  $id = $value->id;
  $container_no = $value->container_no;
  $container_type = $value->container_type;
  $no_of_ctns = $value->no_of_ctns; 
  $line = $value->line;
  $net_weight = $value->net_weight;
  $gross_weight = $value->gross_weight;
  $stuffing_commenced = $value->stuffing_commenced;
  $stuffing_completed = $value->stuffing_completed;
  $stuffing_pattern  = unserialize($value->stuffing_pattern);

?>
<tr id="tr-1-<?php echo $id;?>">
  <td class="t_e_details" id="container_no-<?php echo $id;?>" ><?php echo $container_no;?></td>
  <td class="editable_select" id="container_type-<?php echo $id;?>" ><?php echo getContainerTypeText($container_type);?></td>
  <td class="t_e_details" id="no_of_ctns-<?php echo $id;?>" ><?php echo $no_of_ctns;?></td>
  <td class="t_e_details" id="line-<?php echo $id;?>" ><?php echo $line;?></td>
  <td class="t_e_details" id="gross_weight-<?php echo $id;?>" ><?php echo $gross_weight;?></td>
  <td class="t_e_details" id="net_weight-<?php echo $id;?>" ><?php echo $net_weight;?></td>
  <td class="t_e_details" id="stuffing_commenced-<?php echo $id;?>" ><?php echo $stuffing_commenced;?></td>
  <td class="t_e_details" id="stuffing_completed-<?php echo $id;?>" ><?php echo $stuffing_completed;?></td>
  <td><a href="#" onclick="deleteTobaccoDetails(<?php echo $id;?>);"><img class="delete_image" src="<?php echo $base_url;?>images/delete.png" /></a> | <a href="#" onclick="getPattern(<?php echo $id;?>);"><img class="delete_image" src="<?php echo $base_url;?>images/cal.gif"  title="Edit Pattern" alt="Edit Pattern" /></a></td>
</tr>
<?php endforeach; }?>
