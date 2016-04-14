<?php extract($general); ?>
 <table width="100%" class="common">
      <tr>
        <td ><label>Type of Container</label> </td>
        <td><?php echo $container_type;?></td>
        <td colspan="2">
          <table width="100%" style="border:none">
            <tr>
              <td>Remarks</td>
              <td><label>Custom Seal No</label></td>
              <td class="s_g_edit" id="official_seal-<?php echo $id;?>" ><?php echo $official_seal;?></td>
              <td><label>Liner Seal No</label></td>
              <td class="s_g_edit" id="liner_seal-<?php echo $id;?>" ><?php echo $liner_seal;?></td>
            </tr>            
          </table>
        </td>   
      </tr>
      <tr>
        <td><label>Place of Survey</label></td>
        <td class="s_g_edit"  id="place_of_survey-<?php echo $id;?>"><?php echo $place_of_survey;?></td>
        <td ><label>Date of survey </label></td>
        <td class="s_g_edit"  id="date_of_survey-<?php echo $id;?>"><?php echo $date_of_survey;?></td>
      </tr>
      <tr>
        <td class="td_size"><label>Vessel Name</label></td>
        <td class="s_g_edit"  id="vessel_name-<?php echo $id;?>"><?php echo $vessel_name;?></td>
        <td class="td_size"><label>Voyage Number</label></td>
        <td class="s_g_edit"  id="voyage_number-<?php echo $id;?>"><?php echo $voyage_number;?></td>
      </tr>
      <tr>
        <td class="td_size"><label>Container Number</label></td>
        <td class="s_g_edit"  id="container_number-<?php echo $id;?>"><?php echo $container_number;?></td>
        <td class="td_size"><label>Port of Shipment</label></td>
        <td class="s_g_edit"  id="port_of_shipment-<?php echo $id;?>"><?php echo $port_of_shipment;?></td>
      </tr>
      <tr>
        <td class="td_size"><label>Port of Discharge</label></td>
        <td class="s_g_edit"  id="port_of_discharge-<?php echo $id;?>"><?php echo $port_of_discharge;?></td>
        <td class="td_size" ><label>Description</label></td>
        <td class="s_g_edit"  id="description-<?php echo $id;?>"><?php echo $description;?></td>
      </tr>
      <tr>
        <td class="td_size" ><label>Stuffing Commenced</label></td>
        <td class="s_g_edit"  id="stuffing_commenced-<?php echo $id;?>"><?php echo $stuffing_commenced;?></td>
        <td class="td_size" ><label>Stuffing Completed</label></td>
        <td class="s_g_edit"  id="stuffing_completed-<?php echo $id;?>"><?php echo $stuffing_completed;?></td>
      </tr>
</table>

