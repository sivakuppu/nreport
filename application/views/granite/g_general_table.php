<?php extract($general); ?>
 <table width="100%" class="common">
      <tr>
        <td><label>Place of Survey</label></td>
        <td class="g_e_general"  id="place_of_survey-<?php echo $id;?>"><?php echo $place_of_survey;?></td>
        <td ><label>Date of survey </label></td>
        <td class="g_e_general"  id="date_of_survey-<?php echo $id;?>"><?php echo $date_of_survey;?></td>
      </tr>
      <tr>
        <td ><label>Type of Container</label> </td>
        <td class="g_editable_select" id="container_type-<?php echo $id;?>" ><?php echo getContainerTypeText($container_type);?></td>
        <td class="td_size"><label for="description_of_cargo" >Description of Cargo</label></td>
        <td id="description_of_cargo-<?php echo $id?>" class="g_e_general"  ><?php echo $description_of_cargo;?></td>
      </tr>
      <tr>
        <td class="td_size"><label for="vessel_name" >Vessel Name</label></td>
        <td id="vessel_name-<?php echo $id?>" class="g_e_general"  ><?php echo $vessel_name;?></td>
        <td class="td_size"><label for="voyage_no" >Voyage Number</label></td>
        <td id="voyage_no-<?php echo $id?>" class="g_e_general"  ><?php echo $voyage_no;?></td>
      </tr>
      <tr>
        <td class="td_size"><label for="exporter" >Exporter</label></td>
        <td id="exporter-<?php echo $id?>" class="g_e_general"  ><?php echo $exporter;?></td>
        <td class="td_size"><label for="consignee" >Consignee</label></td>
        <td id="consignee-<?php echo $id?>" class="g_e_general" ><?php echo $consignee;?></td>
      </tr>
      <tr>
        <td class="td_size"><label for="invoice_no" >Invoice No.</label></td>
        <td id="invoice_no-<?php echo $id?>" class="g_e_general"  ><?php echo $invoice_no;?></td>
        <td class="td_size" ><label for="marks_blocks" >Marks & No. of Blocks</label></td>
        <td id="marks_blocks-<?php echo $id?>" class="g_e_general"  ><?php echo $marks_blocks;?></td>
      </tr>
      <tr>
        <td class="td_size"><label for="port_of_loading" >Port of Loading</label></td>
        <td id="port_of_loading-<?php echo $id?>" class="g_e_general"  ><?php echo $port_of_loading;?></td>
        <td class="td_size"><label for="shipping_bill_no" >Shipping Bill No.</label></td>
        <td id="shipping_bill_no-<?php echo $id?>" class="g_e_general"  ><?php echo $shipping_bill_no;?></td>
      </tr>
      <tr>
        <td class="td_size"><label for="port_of_discharge" >Port of Discharge</label></td>
        <td id="port_of_discharge-<?php echo $id?>" class="g_e_general" ><?php echo $port_of_discharge;?></td>
      </tr>  
</table>

