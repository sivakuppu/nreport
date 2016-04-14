     <?php $base_url = base_url();?>
     <?php if(!empty($results)){ foreach($results as $value): ?>
      <?php
        $id = $value->id;
        $container_no = $value->container_no;
        $size_type = $value->size_type; 
        $gross_weight = $value->gross_weight;
        $tare_weight = $value->tare_weight;
        $net = $gross_weight - $tare_weight;
        $mfd = $value->mfd;
        $cubic = $value->cubic;  
        $line = $value->line;
      ?>
      <tr id="tr-<?php echo $id;?>">
        <td class="d_edit" id="container_no-<?php echo $id;?>" ><?php echo $container_no;?></td>
        <td class="d_edit" id="size_type-<?php echo $id;?>" ><?php echo $size_type;?></td>
        <td onchange="fillNet(<?php echo $id;?>);" class="d_edit" id="gross_weight-<?php echo $id;?>" ><?php echo $gross_weight;?></td>
        <td onchange="fillNet(<?php echo $id;?>);" class="d_edit" id="tare_weight-<?php echo $id;?>" ><?php echo $tare_weight;?></td>
        <td id="net-<?php echo $id;?>" ><?php echo $net;?></td>
        <td class="d_edit" id="mfd-<?php echo $id;?>"><?php echo $mfd;?></td>
        <td class="d_edit" id="cubic-<?php echo $id;?>"><?php echo $cubic;?></td>
        <td class="d_edit" id="line-<?php echo $id;?>" rel="line"><?php echo $line;?></td>
        <td><a href="#" onclick="deleteInspectionDetails(<?php echo $id;?>);"><img class="delete_image" src="<?php echo $base_url;?>images/delete.png"</a></td>
      </tr>
      <?php endforeach; }?>