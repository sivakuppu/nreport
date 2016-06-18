<?php $this->load->view('CE/header');?> 
<div class="ui-layout-center">
<div id="add-item" class="<?php echo ($id > 0 || $message || $error ) ? 'add-item' : ''?>">
  <p class="message" ><?php echo isset($message) ? $message : ""; ?></p>
  <p class="error"><?php echo isset($error) ? $error : "" ;?></p>
  <?php $str = $id > 0 ? "CE/item_detail/index/$id" : "CE/item_detail"; ?>   
  <?php echo $id > 0 ? anchor($str, 'Manage Item', array('title' => 'Manage Item', 'id' => 'add-item-a', 'class'=>'popup-a')) : "";?>
  <?php $str = $id > 0 ? "cejob/delete/$id" : "cejob"; ?>  
  <?php echo $id > 0 ? anchor($str, 'Delete this file', array('title' => 'Delete this file')) : "";?> 
</div>  
<div style="clear:both;"></div> 
<?php // Change the css classes to suit your needs    

$attributes = array('class' => 'all-form', 'id' => '');
$action = $id > 0 ? "cejob/index/$id" : "cejob" ;
echo form_open($action , $attributes); ?>
<div class="left-panel common-div width-div" >
<p>
        <label for="certificate_of_inspection_no">Certificate of Inspection No. <span class="required">*</span></label>
        <?php echo form_error('certificate_of_inspection_no'); ?>
        <br /><input id="certificate_of_inspection_no" type="text" name="certificate_of_inspection_no" maxlength="255" value="<?php echo isset($certificate_of_inspection_no) ? $certificate_of_inspection_no : set_value('certificate_of_inspection_no'); ?>"  />
</p>
<p>
        <label for="certificate_date">Certificate Date</label>
        <?php echo form_error('certificate_date'); ?>
        <br /><input id="certificate_date" class="datepicker" type="text" name="certificate_date"  autocomplete="off" value="<?php echo isset($certificate_date) ? $certificate_date : set_value('certificate_date'); ?>"  />
</p>


<p>
        <label for="agent">Agent</label>
        <?php echo form_error('agent'); ?>
        <br /><input id="agent" type="text" name="agent" maxlength="11" value="<?php  echo isset($agent) ? $agent : set_value('agent'); ?>"  />
        <?php if(isset($agent_id)): ?>
        <input id="agent_id" type="hidden" name="agent_id" value="<?php echo $agent_id;?>"  />
        <?php else: ?>
        <input id="agent_id" type="hidden" name="agent_id" value="<?php echo $_POST ? $_POST['agent_id'] : '';?>"  />
        <?php endif;?>
</p>

<p>
        <label for="importer">Importer</label>
        <?php echo form_error('importer'); ?>
        <br /><input id="importer" type="text" name="importer"  value="<?php echo isset($importer) ? $importer : set_value('importer'); ?>"  />
        <?php if(isset($importer_id)): ?>
        <input id="importer_id" type="hidden" name="importer_id" value="<?php echo $importer_id;?>"  />
        <?php else: ?>
        <input id="importer_id" type="hidden" name="importer_id" value="<?php echo $_POST ? $_POST['importer_id'] : '';?>"  />
        <?php endif;?>
</p>

<p>
        <label for="seller">Seller</label>
        <?php echo form_error('seller'); ?>
        <br /><input id="seller" type="text" name="seller"  value="<?php echo isset($seller) ? $seller : set_value('seller'); ?>"  />
        <?php if(isset($seller_id)): ?>
        <input id="seller_id" type="hidden" name="seller_id" value="<?php echo $seller_id;?>"  />
        <?php else: ?>
        <input id="seller_id" type="hidden" name="seller_id" value="<?php echo $_POST ? $_POST['seller_id'] : '';?>"  />  
        <?php endif;?>
</p>


<p>
        <label for="currency">Currency</label>
        <?php echo form_error('currency'); ?>
        <br /><input id="currency" type="text" name="currency" maxlength="255" value="<?php echo isset($currency) ? $currency : set_value('currency'); ?>"  />
</p>
<p>
        <label for="toi">TOI</label>
        <?php echo form_error('toi'); ?>
        <br /><input id="toi" type="text" name="toi" maxlength="255" value="<?php echo isset($toi) ? $toi  : set_value('toi'); ?>"  />
</p>

</div>
<div class="left-panel common-div width-div" >
<p>
        <label for="goods_invoice_no">Goods Invoice No.</label>
	<?php echo form_error('goods_invoice_no'); ?>
	<br />
	<input id="goods_invoice_no" type="text" name="goods_invoice_no" maxlength="255" value="<?php echo isset($goods_invoice_no) ? $goods_invoice_no  : set_value('goods_invoice_no'); ?>"  />
</p>
<p>
        <label for="invoice_date">Goods Invoice Date</label>
        <?php echo form_error('invoice_date'); ?>
        <br /><input id="invoice_date" class="datepicker" type="text" name="invoice_date"  autocomplete="off" value="<?php echo isset($invoice_date) ? $invoice_date : set_value('invoice_date'); ?>"  />
</p>
<p>
        <label for="declare_invoice_value">Declare Invoice Value</label>
        <?php echo form_error('declare_invoice_value'); ?>
        <br /><input id="declare_invoice_value" type="text" name="declare_invoice_value" maxlength="255" value="<?php echo isset($declare_invoice_value) ? $declare_invoice_value : set_value('declare_invoice_value'); ?>"  />
</p>
<p>
        <label for="be_number">BE Number</label>
        <?php echo form_error('be_number'); ?>
        <br /><input id="be_number" type="text" name="be_number" maxlength="255" value="<?php echo isset($be_number) ? $be_number : set_value('be_number'); ?>"  />
</p>
<p>
        <label for="inspection_place">Inspection Place</label>   
        <?php echo form_error('inspection_place'); ?>
        <br /><input id="inspection_place" type="text" name="inspection_place" maxlength="255" value="<?php echo isset($inspection_place) ? $inspection_place  : set_value('inspection_place'); ?>"  />
</p>
<p>
        <label for="inspection_date">Inspection Date</label>
        <?php echo form_error('inspection_date'); ?>
        <br /><input id="inspection_date" class="datepicker" type="text" name="inspection_date"  autocomplete="off" value="<?php echo isset($inspection_date) ? $inspection_date : set_value('inspection_date'); ?>"  />
</p>
<p>
    <label for="inspection_duration">Duration of inspection (In Hours)</label>
	<?php echo form_error('inspection_duration'); ?>
	<br />
	<input id="inspection_duration" type="text" name="inspection_duration" maxlength="255" value="<?php echo isset($inspection_duration) ? $inspection_duration  : set_value('inspection_duration'); ?>"  />					
</p>
</div>
<div class="right-panel common-div width-div" >
<p>
        <label for="ice_no">Importer Exporter Code No</label>
        <?php echo form_error('ice_no'); ?>
        <br /><input id="ice_no" type="text" name="ice_no" maxlength="255" value="<?php echo isset($ice_no) ? $ice_no  : set_value('ice_no'); ?>"  />
</p>
<p>
        <label for="freight_description">Freight  Description</label>   
	<?php echo form_error('freight_description'); ?>
	<br />
							
	<?=form_textarea( array( 'name' => 'freight_description', 'rows' => '3', 'cols' => '80','value' => isset($freight_description) ? $freight_description : "The freight amount paid for this consignment by the supplier as per the letter submitted by the importer." ) )?>
</p>
<p>
        <label for="freight_amount">Freight Amount</label>
        <?php echo form_error('freight_amount'); ?>
        <br /><input id="freight_amount" type="text" name="freight_amount" maxlength="255" value="<?php echo isset($freight_amount) ? $freight_amount  : set_value('freight_amount'); ?>"  />
</p>
</div>
 <div>



<!-----------  ------------>
<!----------- ------------>
 
<p >
        <?php echo form_submit( 'submit', 'Submit'); ?>
        <?php echo form_submit( 'submit', 'Generate'); ?>	
</p>
 </div>

<?php echo form_close(); ?>




</div>
<div class="ui-layout-north">
<?php $attributes = array('class' => '', 'id' => '');
$action = "cejob/get" ;
echo form_open($action , $attributes); ?>  
  <table>
    <tr>
      <td><?php echo anchor('CE/agent', 'Agent', array('title' => 'Agent', 'class'=>'popup-a'));?></td>
      <td><?php echo anchor('CE/importer', 'Importer', array('title' => 'Importer', 'class'=>'popup-a'));?></td>
      <td><?php echo anchor('CE/seller', 'Seller', array('title' => 'Seller', 'class'=>'popup-a'));?></td>
      <!--<td><?php echo anchor('CE/category', 'Category', array('title' => 'Category', 'class'=>'popup-a'));?></td>-->
      <td><?php echo anchor('CE/item_detail/search_html', 'Search Items', array('title' => 'Search Items', 'class'=>'popup-a'));?></td>
      <td><input type="text" name="report_no" size="30"></td>  
      <td><input type="submit" name="get" value="Get"></td>
      <td><input type="submit" name="new" value="New"></td>
       <?php if(!empty($last_id)) { ?><td><?php echo "Last Report No : $last_id";?></td><?php } ?>
    </tr>
  </table>
  <?php echo form_close(); ?>  
</div>



<?php $this->load->view('CE/footer');?>