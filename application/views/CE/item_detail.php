<link href="<?php echo base_url();?>css/ce.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>css/table-new.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>css/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" >var ce_base_url = '<?php echo base_url();?>';</script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/ce.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.autocomplete.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.jeditable.js?v=1"></script>

<a href="#" id="add-form-a">Add Item</a> | <a href="#" id="get-report-a">Get Report</a>
<div id="add-form" style="display:none;">
<?php // Change the css classes to suit your needs    
 
$attributes = array('class' => 'popup-form', 'id' => '');  
echo form_open("CE/item_detail/index/$certificate_id", $attributes); ?>
<div class="left-panel common-div" >
<!--<p>
        <label for="item_category">Item Category</label>   
        <?php echo form_error('item_category'); ?>
        <br /><select id="item_category_id"  name="item_category_id"><?php echo $item_category_id; ?></select>
</p>-->

<p>
        <label for="item_name">Item Name</label>
        <?php echo form_error('item_name'); ?>
        <br /><input id="item_name" type="text" name="item_name"  value="<?php echo set_value('item_name'); ?>"  />
</p>

<p>
        <label for="ce_remarks">CE Remarks</label>
	       <?php echo form_error('ce_remarks'); ?>
	<br />
	 <select name="ce_remarks" id="ce_remarks"	>
	    <option value=""> </option> 
      <option value="NEW" <?php echo strtoupper(set_value('ce_remarks')) == 'NEW' ? 'selected' : ''?>>NEW</option>					
      <option value="USED AND RECONDITIONED" <?php echo strtoupper(set_value('ce_remarks')) == 'USED AND RECONDITIONED' ? 'selected' : ''?>>USED AND RECONDITIONED</option>
      <option value="USED AND NOT RECONDITIONED" <?php echo strtoupper(set_value('ce_remarks')) == 'USED AND NOT RECONDITIONED' ? 'selected' : ''?>>USED AND NOT RECONDITIONED</option>
   </select>       
</p>
<p>
        <label for="specification">Specification</label>
	<?php echo form_error('specification'); ?>
	<br />
							
	<?=form_textarea( array( 'name' => 'specification', 'rows' => '5', 'cols' => '80', 'value' => set_value('specification') ) )?>
</p>
<p>
        <label for="year_of_mfg">Year of MFG</label>
        <?php echo form_error('year_of_mfg'); ?>
        <br /><input id="year_of_mfg" type="text" name="year_of_mfg" maxlength="255" value="<?php echo set_value('year_of_mfg'); ?>"  />
</p>

<p>
        <label for="make">Make</label>
        <?php echo form_error('make'); ?>
        <br /><input id="make" type="text" name="make" maxlength="255" value="<?php echo set_value('make'); ?>"  />
</p>

</div>
<div class="right-panel common-div" >
<p>
        <label for="quantity">Quantity</label>
        <?php echo form_error('quantity'); ?>
        <br /><input id="quantity" type="text" name="quantity" maxlength="255" value="<?php echo set_value('quantity'); ?>"  />
</p>

<p>
        <label for="eval_year_of_mfg">Eval. Year of MFG</label>
        <?php echo form_error('eval_year_of_mfg'); ?>
        <br /><input id="eval_year_of_mfg" type="text" name="eval_year_of_mfg" maxlength="255" value="<?php echo set_value('eval_year_of_mfg'); ?>"  />
</p>

<p>
        <label for="cost_of_machine">Cost of Machine</label>
        <?php echo form_error('cost_of_machine'); ?>
        <br /><input id="cost_of_machine" type="text" name="cost_of_machine" maxlength="255" value="<?php echo set_value('cost_of_machine'); ?>"  />
</p>

<p>
        <label for="cost_of_recondition">Cost of Recondition</label>
        <?php echo form_error('cost_of_recondition'); ?>
        <br /><input id="cost_of_recondition" type="text" name="cost_of_recondition" maxlength="255" value="<?php echo set_value('cost_of_recondition'); ?>"  />
</p>

<p>
        <label for="appraised_value">Appraised Value</label>
        <?php echo form_error('appraised_value'); ?>
        <br /><input id="appraised_value" type="text" name="appraised_value" maxlength="255" value="<?php echo  set_value('appraised_value', 'Not Applicable');?>"  />
</p>

<p>
        <label for="invoice_value">Declared Invoice Value</label>
        <?php echo form_error('invoice_value'); ?>
        <br /><input id="invoice_value" type="text" name="invoice_value" maxlength="255" value="<?php echo set_value('invoice_value'); ?>"  />
</p>
 </div>

<p>
        <?php echo form_submit( 'submit', 'Submit'); ?>
</p>
<?php echo form_close(); ?>
</div>
<!-- Table list-->
<div id="report-div" style="display:none;">
<?php $this->load->view('CE/search_item_detail'); ?>
</div>
<div STYLE=" height: 300px; width: 100%; font-size: 11px; overflow: auto;">
<table>
  <thead >
    <tr >
      <th>S no.</th>
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
      <th>Declared Invoice Value</th>
      <th>Action</th>
    </tr>
 </thead>    
 <tbody>
    <?php if(empty($result)) {?>
    <tr>
      <td colspan= '11'>No Row found</td>
    </tr>
    <?php } 
          else {
            foreach($result as $key => $value) {
            extract((array)$value); 
    ?>
      <tr id="item-detail-tr-<?php echo $id;?>">
        <td><?php echo $key+1;?></td>
        <td class="popup-edit" id="item_name-<?php echo $id;?>" ><?php echo $item_name;?></td>
        <td class="popup-edit" id="specification-<?php echo $id;?>" ><?php echo $specification;?></td>
        <td class="popup-edit" id="make-<?php echo $id;?>" ><?php echo $make;?></td>
        <td class="popup-edit" id="quantity-<?php echo $id;?>" ><?php echo $quantity;?></td>
        <td class="popup-edit" id="year_of_mfg-<?php echo $id;?>" ><?php echo $year_of_mfg;?></td>
        <td class="popup-edit" id="eval_year_of_mfg-<?php echo $id;?>"><?php echo $eval_year_of_mfg;?></td>  
        <td class="popup-edit" id="ce_remarks-<?php echo $id;?>" ><?php echo $ce_remarks;?></td>
        <td class="popup-edit" id="cost_of_machine-<?php echo $id;?>" ><?php echo $cost_of_machine;?></td>
        <td class="popup-edit" id="cost_of_recondition-<?php echo $id;?>" ><?php echo $cost_of_recondition;?></td>
        <td class="popup-edit" id="appraised_value-<?php echo $id;?>" ><?php echo $appraised_value;?></td>
        <td class="popup-edit" id="invoice_value-<?php echo $id;?>"><?php echo $invoice_value;?></td>  
        <td><?php echo anchor("#", 'Delete', array('rel' => "$id", 'class' => 'delete-item-detail'));?></td>
      </tr>
    <?php }}?>
 </tbody>
</table>
</div>

