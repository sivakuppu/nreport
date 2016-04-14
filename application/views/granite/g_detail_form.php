  <table width="100%" class="common">
    <tr>
      <td class="td_size"><label for="container_no" >Container No.</label></td>
      <td><input type="text" id="container_no" class="input" name="container_no" ></td>
      <td class="td_size"><label for="gross_weight" >Gross Weight</label></td>
      <td><input type="text" id="gross_weight" class="input_border" name="gross_weight" size="15" > Kgs</td>
    </tr>
    <tr>
      <td class="td_size"><label for="payload_weight" >Payload Weight</label></td>
      <td><input type="text" id="payload_weight" class="input_border" name="payload_weight" size="15"> Kgs</td>
    
      <td class="td_size"><label for="cha_weight" >Weight of Granite as per CHA</label></td>
      <td><input type="text" id="cha_weight" class="input_border" name="cha_weight" size="15" >  Kgs</td>
    </tr>
    <tr>  
      <td class="td_size"><label for="no_of_blocks" >No. Of Blocks</label></td>
      <td><input type="text" id="no_of_blocks" class="input" name="no_of_blocks" ></td>
      <td class="td_size"><label for="blocks_numbers" >Block Numbers</label></td>
      <td><textarea id="blocks_numbers" class="input" name="blocks_numbers" ></textarea></td>
    </tr>
    <tr>        
      <td class="td_size"><label for="customer_seal" >Customs Seal No.</label></td>
      <td><input type="text" id="customer_seal" class="input" name="customer_seal" ></td>
      <td class="td_size"><label for="line_seal" >Line Seal No.</label></td>
      <td><input type="text" id="line_seal" class="input" name="line_seal"></td>
    </tr>
    <tr>        
      <td class="td_size"><label for="year_of_mfg" >Date of Mfg</label></td>
        <td><input type="text" id="year_of_mfg" class="input" name="year_of_mfg"></td>
      <td class="td_size"><label for="flb_lenght" >FLB</label></td>
      <td>
        <input type="text" id="flb_lenght" class="input_border" name="flb_lenght" size="5"> x 
        <input type="text" id="flb_breath" class="input_border" name="flb_breath" size="5"> x   
        <input type="text" id="flb_height" class="input_border" name="flb_height" size="5"> =
        <input type="text" id="flb_count" class="input_border" name="flb_count" size="5">  
      </td>
    </tr>
    <tr>
        <td class="td_size"><label for="front_end_wooden" >FE</label></td>
        <td><input type="text" id="front_end_wooden" class="input_border" name="front_end_wooden" size="6"> Wedges</td>
        <td class="td_size"><label for="left_side_framework" >LS</label></td>
        <td>
            <input type="text" id="left_side_framework" class="input_border" name="left_side_framework" size="6" > Framework
            <input type="text" id="left_side_bolster" class="input_border" name="left_side_bolster" size="6" > Bolsters
        </td>
    </tr>
    <tr>
        
        <td class="td_size"><label for="right_side_framework" >RS</label></td>
        <td>
            <input type="text" id="right_side_framework" class="input_border" name="right_side_framework" size="6"> Framework
            <input type="text" id="right_side_bolster" class="input_border" name="right_side_bolster" size="6"> Bolsters
        </td>
        <td class="td_size"><label for="rear_end_wooden" >RE</label></td>
        <td><input type="text" id="rear_end_wooden" class="input_border" name="rear_end_wooden" size="6" > Wedges</td>
    </tr>
    <tr>        
      <td colspan="4"><input type="submit" style="margin-left:50%;" name="add_container_details" value="Add" onclick="return add('granite_details_form', 'granite_details_tbody'); return false; "></td>
    </tr>
   </table>

