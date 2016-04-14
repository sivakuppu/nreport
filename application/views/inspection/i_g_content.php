<?php
  extract($general_details);
?>
<div id="inspection_content" class="r_content">
  <h4>General Details</h4>
  <table class="common" width="100%">
    <tr>
      <th>Job Order No.</th>  
      <td class="o_inspection" id="job_order-<?php echo $id;?>" ><?php echo $job_order;?></td>
      <th>Place of Survey</th>
      <td class="o_inspection" id="place_of_survey-<?php echo $id;?>" ><?php echo $place_of_survey;?></td>
    </tr>
    <tr>
      <th>Date of survey </th>
      <td class="o_inspection" id="date_of_survey-<?php echo $id;?>" ><?php echo $date_of_survey;?></td>
      <th>Left Side</th>
      <td class="o_inspection" id="left_side-<?php echo $id;?>" ><?php echo $left_side;?></td>
    </tr> 
    <tr>
      <th>Right Side</th>
      <td class="o_inspection" id="right_side-<?php echo $id;?>" ><?php echo $right_side;?></td>
      <th>Front Side</th>
      <td class="o_inspection" id="front_side-<?php echo $id;?>" ><?php echo $front_side;?></td>
    </tr>
    <tr>
      <th>Roof Side</th>
      <td class="o_inspection" id="roof_side-<?php echo $id;?>" ><?php echo $roof_side;?></td>
      <th>Interior</th>
      <td class="o_inspection" id="interior-<?php echo $id;?>" ><?php echo $interior;?></td>
    </tr>  
    <tr>
      <th>Rear Side</th>
      <td class="o_inspection" id="rear_side-<?php echo $id;?>" ><?php echo $rear_side;?></td>
      <th>Under Structure</th>
      <td class="o_inspection" id="under_structure-<?php echo $id;?>" ><?php echo $under_structure;?></td>
    </tr>
    <tr>          
      <th>Note</th>
      <td colspan="3" class="o_inspection" id="note-<?php echo $id;?>" ><?php echo $note;?></td>
    </tr>
    
  </table>
</div>


