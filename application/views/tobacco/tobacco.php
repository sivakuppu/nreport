<?php $this->load->view('header');?>

<div class="ui-layout-north"><?php echo $common_header;?></div>
<!-----------END NORTH------------>

<!-----------START CENTER------------>
<div class="ui-layout-center">
  <div class="report-heading">
    <div class="add-form">
      <a class="show-content" href="#" rel="general-form">Add General Details</a> |
      <a class="show-content" href="#" rel="invoice-form">Add Invoice Details</a> | 
      <a class="show-content" href="#" rel="detail-form">Add Container Details</a> |
      <?php echo anchor('common/delete/'. $common_id, "Detele This File", array("onclick" => "return confirm('Are Sure to delete the file $report_no');"));?>
    </div>
    <div><h2><?php echo $report_no;?></h2></div>
  </div>
  <div class="clear"></div>
  <h3 class="sub-title">General Details</h3>
  <div id="general-table" class="general-table">
    <?php echo !empty( $general_table) ? $general_table : "";?>
  </div>  
  <h3 class="sub-title">Invoice Details</h3>
  <div id="invoice-table" class="invoice-table">
    <table class="common" width="100%">
        <thead>
          <tr>
            <th>INVOICE NO</th>
            <th>INVOICE DATE</th>
            <th>MARKS & NOS</th>
            <th>SHIPPER</th>
            <th>CONSIGNEE</th>
            <th>GR. WT (kgs)</th>
            <th>NET WT (kgs)</th>
            <th>TOTAL NO. PACKAGES</th>
            <th>REMARK</th>
            <th>ACTION</th>
          </tr>
        </thead>
        <tbody id="tobacco_invoice_tbody">
        <?php echo !empty( $invoice_table) ? $invoice_table : "";?>
        </tbody>
      </table>
  </div> 
  <h3 class="sub-title">Container Details</h3>
  <div id="detail-table" class="detail-table">
    <table class="common" width="100%">
      <thead>
        <tr>
          <th>CONTAINER NO</th>
          <th>CONTAINER TYPE</th>
          <th>NO. OF CTNS</th>
          <th>LINE</th>
          <th>GR. WT (kgs)</th>
          <th>NET WT (kgs)</th>
          <th>STUFFING COMMENCED</th>
          <th>STUFFING COMPLETED</th>
          <th>ACTION</th>
        </tr>
      </thead>
      <tbody id="tobacco_details_tbody">
        <?php echo !empty( $detail_table) ? $detail_table : "";?>
      </tbody>
    </table>
  </div> <!--- end of the detail-table--->
    
	<div id="general-form" class="general-form" style="display:none" title="General Details">
	   <?php echo form_open('tobacco/addGeneralDetails', array('id' => "tobacco_general_form", 'method' => 'POST' ,'class' => 'all-form'));?>
     <?php echo $general_form; ?> 	 
     <input type="hidden" name="common_id" value="<?php echo $common_id;?>" >    
     <?php echo form_close();?>     
	</div><!-- end general-form -->
	
	<div id="invoice-form" class="invoice-form" style="display:none" title="Invoice Details">
	   <?php echo form_open('tobacco/addInvoiceDetails', array('id' => "tobacco_invoice_form", 'method' => 'POST' , 'class' => 'all-form'));?>
     <?php echo $invoice_form; ?> 	 
     <input type="hidden" name="common_id" value="<?php echo $common_id;?>" >    
     <?php echo form_close();?>     
	</div><!-- end general-form -->
	
	<div id="detail-form" class="detail-form" style="display:none" title="Container Details" > 
	  <?php echo form_open('tobacco/addContainerDetails', array('id' => "tobacco_details_form", 'method' => 'POST', 'class' => 'all-form')); ?>
    <?php echo $detail_form; ?> 
    <input type="hidden" name="common_id" value="<?php echo $common_id;?>" > 
    <?php echo form_close();?>	    		    
	</div><!-- end detail-form-->
		<div id="pattern-div" class="detail-form" style="display:none" > 
	 	    		    
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