<?php $base_url = base_url();?>
<div>
  <h4>Container Details</h4>
  <table class="common" width="100%">
    <thead>
      <tr>
        <th>Container Number</th>
        <th>Size / Type</th>
        <th>Gross Weight</th>
        <th>Tare Weight</th>
        <th>Net Weight</th>
        <th>MFD</th>
        <th>Cubic</th>
        <th>Line</th>
        <th></th>
      </tr>
    </thead>
    <tbody id="inpection_tbody">
      <?php echo $inpection_tbody;  ?>
    </tbody>
  </table>
</div>
<script>
function deleteInspectionDetails(id){
  $.get(base_url + 'index.php/inspection/deleteDetails/' + id, '',function(response) {
    if(response == 1) {
      $("#tr-" + id).remove();
      alert("Successfully deleted");
    }
    else {
      alert("Unable to delete");
    }
  });
}



function fillNet(id) {
  //$+('#net' + id).text($('#gross_weight' + id).val() - $('#tare_weight' + id).val()); 
}
</script>