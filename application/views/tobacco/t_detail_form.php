  <table width="100%" class="common">
    <tr>
      <td class="td_size"><label for="container_no" >Container No.</label></td>
      <td><input type="text" id="container_no" class="input" name="container_no" ></td>
      <td class="td_size"><label for="container_type" >Container Type</label></td>
      <td><?php echo getContainerType(1);?></td>
    </tr>
    <tr>
      <td class="td_size"><label for="no_of_ctns" >No. of CTNS</label></td>
      <td><input type="text" id="no_of_ctns" class="input" name="no_of_ctns" ></td>
    
      <td class="td_size"><label for="line" >Line</label></td>
      <td><input type="text" id="line" class="input" name="line" ></td>
    </tr>
    <tr>
      <td class="td_size"><label for="gross_weight-1" >Gross Weight</label></td>
      <td><input type="text" id="gross_weight-1" class="input" name="gross_weight" ></td>
    
      <td class="td_size"><label for="net_weight-1" >Net Weight</label></td>
      <td><input type="text" id="net_weight-1" class="input" name="net_weight" ></td>
    </tr>
    <tr>
        <td class="td_size" ><label for="stuffing_commenced" >Stuffing Commenced</label></td>
        <td>
          <input type="text" id="stuffing_commenced" size="14" class="border datepicker" autoComplete="off" name="stuffing_commenced"  >
          <input type="text" class="border" size="5" name="stuffing_commenced_hour"> :
        <input type="text" class="border" size="5" name="stuffing_commenced_min"> 
        </td>
        <td class="td_size" ><label for="stuffing_completed">Stuffing Completed</label></td>
        <td>
        <input type="text" id="stuffing_completed" size="14" class="border datepicker"  autoComplete="off" name="stuffing_completed" >
        <input type="text" class="border" size="5" name="stuffing_completed_hour"> :
        <input type="text" class="border" size="5" name="stuffing_completed_min">  
        </td>
      </tr>
    <tr> 
      <td colspan="4">
        <div id='pattern_table'><?php echo $pattern; ?></div>
      </td>       
    </tr>
    <tr>      
      <td colspan="2">
        <input type="text"id="p_to"  value="" size="3" >
        <input type="text"  id="p_from" value="" size="3">
        <input type="button"  value="Fill Pattern" onclick="fillPattern();">
      </td>
      <td>
        <input type="text"  id="p_no_of_row" value="" size="3">
        <input type="button"  value="Add More Pattern" onclick="morePattern();">
	  
      </td>
      <td>
        <input type="submit" style="margin-left:80px;" name="add_container_details" value="Add" onclick="return add('tobacco_details_form', 'tobacco_details_tbody'); return false; ">
      </td>
    </tr>
   </table>

