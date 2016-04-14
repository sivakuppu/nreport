<?php extract($results); ?>
 <table width="100%" class="common">
      <tr>
        <th><label>Place of Survey</label></th>
        <td class="t_e_general"  id="place_of_stuffing-<?php echo $id;?>"><?php echo $place_of_stuffing;?></td>
        <td ><label>Date of survey </label></td>
        <td>
             <label class="t_e_general"  id="start_date_of_stuffing-<?php echo $id;?>"><?php echo $start_date_of_stuffing;?></label>
            <?php if(isset($end_date_of_stuffing )&& $end_date_of_stuffing != $start_date_of_stuffing){?>  
             - <label class="t_e_general"  id="end_date_of_stuffing-<?php echo $id;?>"><?php echo $end_date_of_stuffing;?></label>
             <?php } ?> 
        </td>
      </tr>
      <tr>
        <td class="td_size"><label>Port of Discharge</label></td>
        <td class="t_e_general"  id="port_of_discharge-<?php echo $id;?>"><?php echo $port_of_discharge;?></td>
        <td class="td_size" ><label>Description</label></td>
        <td class="t_e_general"  id="description-<?php echo $id;?>"><?php echo $description;?></td>
      </tr>
      <tr>
        <td colspan="4">
          <table width="100%">
            <tr>
              <td>Remarks</td>
              <td><label>Custom Seal No</label></td>
              <td class="t_e_general" id="official_seal-<?php echo $id;?>" ><?php echo $official_seal;?></td>
              <td><label>Liner Seal No</label></td>
              <td class="t_e_general" id="liner_seal-<?php echo $id;?>" ><?php echo $liner_seal;?></td>
            </tr>
          </table> 
        </td>
      </tr>
</table>

