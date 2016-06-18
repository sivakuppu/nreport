<div id="report-form">
  <table>
    <tr>
      <!--<td>  
        <label for="report-category">Item Category</label><br>   
        <select id="report-category"><?php echo $item_category_id; ?></select>
      </td> -->
      <td>
        <label for="report-item-name">Item Name</label>
        <br /><input id="report-item-name" type="text"   />
      </td>
      <td>
        <label for="report-specification">Specification</label>
        <br /><input id="report-specification" type="text"  />
      </td>
      <td>
        <label for="report-make">Make</label>
        <br /><input id="report-make" type="text"  />
      </td>
      <td>
        <input id="get-report" type="button" name="get-report" value="Get Report"  />  
      </td>
    </tr>
  </table>
</div>     

<div STYLE=" height: 300px; width: 100%; font-size: 11px; overflow: auto;">
<table>
  <thead >
    <tr >
      <th>S no.</th>
      <th>Certificate of Inspection No</th>
      <th>Item Name</th>
      <th>Specification</th>    
      <th>Make</th>
      <th>Quantity</th>
      <th>Year of MFG</th>
      <th>Eval. Year of MFG</th>
      <th>CE Remarks</th>
      <th>Cost of Machine</th>
      <th>Cost of Recondition</th>
      <th>Appraised Value</th>
      <th>Declared Invoice value</th>
    </tr>
 </thead>    
 <tbody id="report-tbody">          
 </tbody>
</table>
</div>
