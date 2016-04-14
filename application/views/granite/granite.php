<?php $this->load->view('header');?>

<div class="ui-layout-north"><?php $this->load->view('file');?></div>
<!-----------END NORTH------------>

<!-----------START CENTER------------>
<div class="ui-layout-center">
  <div class="report-heading">
    <div class="add-form">
      <a class="show-content" href="#" rel="general-form">Add General Details</a> | 
      <a class="show-content" href="#" rel="detail-form">Add Cargo Details</a> |
      <?php echo anchor('common/delete/'. $common_id, "Detele This File", array("onclick" => "return confirm('Are Sure to delete the file $report_no');"));?>
    </div>
    <div><h2><?php echo $report_no;?></h2></div>
  </div>
  <div class="clear"></div>
  <h3 class="sub-title">General Details</h3>
  <div id="general-table" class="general-table">
    <?php echo !empty( $general_table) ? $general_table : "";?>
  </div>  
  <h3 class="sub-title">Cargo Details</h3>
  <div id="detail-table" class="detail-table">
    <div id="granite_details_lists">
      <table class="common">
        <thead>
          <tr>
            <th>Container No.</th>	
            <th>Max.Gr Wt.<br>(Kgs)</th>
            <th>Max. Pay-load<br>(Kgs)</th>	
            <th>Weight <br>as per <br>CHA</th>
            <th style="width:10px" >No. Of Blocks</th>	
            <th>Block Nos.</th>	
            <th>Customs <br>Seal No.</th>
            <th>Line <br>Seal No.</th>	
            <th>Date <br>of <br> Mfg</th>
            <th style="width:55px">FLB</th>
            <th>FE</th>
            <th>LS</th>
            <th>RS</th>
            <th>RE</th>
          </tr>
        </thead>
        <tbody id="granite_details_tbody">
          <?php echo !empty( $detail_table) ? $detail_table : "";?>
        </tbody>
      </table>
    </div>
  </div> <!--- end of the detail-table--->
    
	<div id="general-form" class="general-form" style="display:none" title="General Details">
	   <?php echo form_open('granite/addGranite', array('id' => "granite_general_form", 'method' => 'POST', 'class' => 'all-form'));?>
     <?php echo $general_form; ?> 	 
     <input type="hidden" name="common_id" value="<?php echo $common_id;?>" >    
     <?php echo form_close();?>     
	</div><!-- end general-form -->
	
	<div id="detail-form" class="detail-form" style="display:none" title="Cargo Details">
	  <?php echo form_open('granite/addGraniteDetails', array('id' => "granite_details_form", 'method' => 'POST', 'class' => 'all-form')); ?>
    <?php echo $detail_form; ?> 
    <input type="hidden" name="common_id" value="<?php echo $common_id;?>" > 
    <?php echo form_close();?>	    		    
	</div><!-- end detail-form-->
</div><!-- end center-->
<!-----------END CENTER------------>

<!-----------START SOUTH------------>	
<div class="ui-layout-south" >
  <?php echo form_open($form_action, array('method' => 'POST', 'id' => 'generate_form')); ?>
    <input type="submit" id="generate"  name="generate" value="Generate Report" onclick="add('generate_form', 'result_div');">
  </form>
  <div id="result_div"></div>
</div>


<!-----------END SOUTH------------>
<?php $this->load->view('footer');?>