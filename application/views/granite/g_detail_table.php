<?php $base_url = base_url();?>
<?php if(!empty($results)){ foreach($results as $value): ?>
<?php
  $id = $value->id;
  $container_no = $value->container_no;
  $gross_weight = $value->gross_weight;
  $payload_weight = $value->payload_weight; 
  $cha_weight = $value->cha_weight;
  $no_of_blocks = $value->no_of_blocks;
  $blocks_numbers = $value->blocks_numbers;
  $customer_seal = $value->customer_seal;
  $line_seal = $value->line_seal;
  $year_of_mfg = $value->year_of_mfg; 
  $flb_lenght = $value->flb_lenght;
  $flb_breath = $value->flb_breath;
  $flb_height = $value->flb_height;
  $flb_count = $value->flb_count; 
  $front_end_wooden = $value->front_end_wooden;
  $rear_end_wooden = $value->rear_end_wooden;
  $left_side_framework = $value->left_side_framework;
  $left_side_bolster = $value->left_side_bolster;
  $right_side_framework = $value->right_side_framework;
  $right_side_bolster = $value->right_side_bolster;


?>
<tr id="tr-<?php echo $id;?>">
  <td class="g_e_details" id="container_no-<?php echo $id;?>" ><?php echo $container_no;?></td>
  <td class="g_e_details" id="gross_weight-<?php echo $id;?>" ><?php echo $gross_weight;?></td>
  <td class="g_e_details" id="payload_weight-<?php echo $id;?>" ><?php echo $payload_weight;?></td>
  <td class="g_e_details" id="cha_weight-<?php echo $id;?>" ><?php echo $cha_weight;?></td>
  <td class="g_e_details" id="no_of_blocks-<?php echo $id;?>" ><?php echo $no_of_blocks;?></td>
  <td class="g_e_details" id="blocks_numbers-<?php echo $id;?>" ><?php echo $blocks_numbers;?></td>
  <td class="g_e_details" id="customer_seal-<?php echo $id;?>" ><?php echo $customer_seal;?></td>
  <td class="g_e_details" id="line_seal-<?php echo $id;?>" ><?php echo $line_seal;?></td>
  <td class="g_e_details" id="year_of_mfg-<?php echo $id;?>" ><?php echo $year_of_mfg;?></td>
  <td>
    <span class="g_e_details" id="flb_lenght-<?php echo $id;?>" ><?php echo $flb_lenght;?></span> X
    <span class="g_e_details" id="flb_breath-<?php echo $id;?>" ><?php echo $flb_breath;?></span> X
    <span class="g_e_details" id="flb_height-<?php echo $id;?>" ><?php echo $flb_height;?></span> <br>=<br>
    <span class="g_e_details" id="flb_count-<?php echo $id;?>" ><?php echo $flb_count;?></span>
  </td>
  <td>
      <span class="g_e_details" id="front_end_wooden-<?php echo $id;?>" ><?php echo $front_end_wooden;?></span>
      <span>W</span>  
  </td>
  <td>
    <span class="g_e_details" id="left_side_framework-<?php echo $id;?>" ><?php echo $left_side_framework;?></span>
    <span>F</span>
    <span class="g_e_details" id="left_side_bolster-<?php echo $id;?>" ><?php echo $left_side_bolster;?></span>
    <span>B</span>
  </td>  
  <td>
    <span class="g_e_details" id="right_side_framework-<?php echo $id;?>" ><?php echo $right_side_framework;?></span>
    <span>F</span>
    <span class="g_e_details" id="right_side_bolster-<?php echo $id;?>" ><?php echo $right_side_bolster;?></span>
    <span>B</span>
  </td>  
  <td>
    <span class="g_e_details" id="rear_end_wooden-<?php echo $id;?>" ><?php echo $rear_end_wooden;?></span>
    <span>W</span>
  </td>
  <td><a href="#" onclick="deleteGraniteDetails(<?php echo $id;?>);"><img class="delete_image" src="<?php echo $base_url;?>images/delete.png"></a></td>
</tr>
<?php endforeach; }?>
