<link href="<?php echo base_url();?>css/ce.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>css/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" >var ce_base_url = '<?php echo base_url();?>';</script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/ce.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.autocomplete.js"></script>
<?php if(!empty($ce_message)) :?> 
<div class="ce-message"><?php echo $ce_message;?></div>
<?php endif;?>
<?php if(!empty($ce_error)) :?>
<div class="ce-error"><?php echo $ce_error;?></div>
<?php endif;?>

<div ><a id="search-a" href="#" >Search</a></div>
<div id="search-form" style="display:none;">
<?php echo form_open('CE/item/get_search_data'); ?>
<input id="item_search_text" type="text" name="item_search_text"  value=""  size="60" />
<input id="item_id" type="hidden" name="item_id"  value=" "  size="60" />
<?php echo form_submit( 'submit', 'Get'); ?>
<?php echo form_close()?>        
</div>

<?php // Change the css classes to suit your needs    

$attributes = array('class' => 'common-form', 'id' => 'item-form');
echo form_open('CE/item', $attributes); ?>
<div  class="left-panel common-div">
<p>
       <label for="item_category">Item Category</label>
        <?php echo form_error('item_category'); ?>
        <br /><select id="item_category_id"  name="item_category_id"><?php echo $item_category_id; ?></select>
</p>

<p>
        <label for="item_name">Item Name <span class="required">*</span></label>
	<?php echo form_error('item_name'); ?>
	<br />
							
	<?=form_textarea( array( 'name' => 'item_name', 'rows' => '5', 'cols' => '80', 'value' => set_value('item_name') ) )?>
</p>
<p>
        <label for="item_specification">Item Specification</label>
	<?php echo form_error('item_specification'); ?>
	<br />
							
	<?=form_textarea( array( 'name' => 'item_specification', 'rows' => '5', 'cols' => '80', 'value' => set_value('item_specification') ) )?>
</p>
<p>
        <label for="manufacturer">Manufacturer</label>
        <?php echo form_error('manufacturer'); ?>
        <br /><input id="manufacturer" type="text" name="manufacturer" maxlength="255" value="<?php echo set_value('manufacturer'); ?>"  />
</p>

</div>
<div class="right-panel common-div">
<p>
        <label for="model">Model</label>
        <?php echo form_error('model'); ?>
        <br /><input id="model" type="text" name="model" maxlength="255" value="<?php echo set_value('model'); ?>"  />
</p>

<p>
        <label for="capacity">Capacity</label>
        <?php echo form_error('capacity'); ?>
        <br /><input id="capacity" type="text" name="capacity" maxlength="255" value="<?php echo set_value('capacity'); ?>"  />
</p>

<p>
        <label for="purpose">Purpose</label>
	<?php echo form_error('purpose'); ?>
	<br />
							
	<?=form_textarea( array( 'name' => 'purpose', 'rows' => '5', 'cols' => '80', 'value' => set_value('purpose') ) )?>
</p>
<p>
        <label for="manufacturing_year">Manufacturing Year</label>
        <?php echo form_error('manufacturing_year'); ?>
        <br /><input id="manufacturing_year" type="text" name="manufacturing_year" maxlength="255" value="<?php echo set_value('manufacturing_year'); ?>"  />
</p>
</div>
<!--<p>
        <label for="cost_brand_new">Cost Brand New</label>
        <?php echo form_error('cost_brand_new'); ?>
        <br /><input id="cost_brand_new" type="text" name="cost_brand_new" maxlength="255" value="<?php echo set_value('cost_brand_new'); ?>"  />
</p>

<p>
        <label for="cost_reconditioned">Cost Reconditioned</label>
        <?php echo form_error('cost_reconditioned'); ?>
        <br /><input id="cost_reconditioned" type="text" name="cost_reconditioned" maxlength="255" value="<?php echo set_value('cost_reconditioned'); ?>"  />
</p>

<p>
        <label for="appraised_value">Appraised Value</label>
        <?php echo form_error('appraised_value'); ?>
        <br /><input id="appraised_value" type="text" name="appraised_value" maxlength="255" value="<?php echo set_value('appraised_value'); ?>"  />
</p>-->


<p>
        <?php echo form_submit( 'submit', 'Submit'); ?>
        <input type="button" value="Reset" onclick="resetForm();">
</p>

<?php echo form_close(); ?>
