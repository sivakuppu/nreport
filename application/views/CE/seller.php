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
<?php echo form_open('CE/seller/get_search_data'); ?>
<input id="seller_search_text" type="text" name="seller_search_text"  value="<?php echo set_value('search_text'); ?>"  size="60" />
<?php echo form_submit( 'submit', 'Get'); ?>
<?php echo form_close()?>        
</div>

<?php $attributes = array('class' => 'common-form', 'id' => 'seller-form'); echo form_open('CE/seller', $attributes); ?>
<div class="left-panel common-div" >
<p>
        <label for="name">Agent Name <span class="required">*</span></label>
        <?php echo form_error('name'); ?>
        <br /><input id="name" type="text" name="name"  value="<?php echo set_value('name'); ?>"  />
</p>

<p>
        <label for="address1">Address1</label>
        <?php echo form_error('address1'); ?>
        <br /><input id="address1" type="text" name="address1"  value="<?php echo set_value('address1'); ?>"  />
</p>

<p>
        <label for="address2">Address2</label>
        <?php echo form_error('address2'); ?>
        <br /><input id="address2" type="text" name="address2"  value="<?php echo set_value('address2'); ?>"  />
</p>

<p>
        <label for="address3">Address3</label>
        <?php echo form_error('address3'); ?>
        <br /><input id="address3" type="text" name="address3"  value="<?php echo set_value('address3'); ?>"  />
</p>

<p>
        <label for="country">Country</label>
        <?php echo form_error('country'); ?>
        <br /><input id="country" type="text" name="country" maxlength="255" value="<?php echo set_value('country'); ?>"  />
</p>

<p>
        <label for="state">State</label>
        <?php echo form_error('state'); ?>
        <br /><input id="state" type="text" name="state" maxlength="255" value="<?php echo set_value('state'); ?>"  />
</p>
</div>
<div class="right-panel common-div" >

<p>
        <label for="city">City</label>
        <?php echo form_error('city'); ?>
        <br /><input id="city" type="text" name="city"  value="<?php echo set_value('city'); ?>"  />
</p>

<p>
        <label for="pin_code">Pin Code</label>
        <?php echo form_error('pin_code'); ?>
        <br /><input id="pin_code" type="text" name="pin_code" maxlength="255" value="<?php echo set_value('pin_code'); ?>"  />
</p>

<p>
        <label for="phone_no">Phone No</label>
        <?php echo form_error('phone_no'); ?>
        <br /><input id="phone_no" type="text" name="phone_no" maxlength="255" value="<?php echo set_value('phone_no'); ?>"  />
</p>

<p>
        <label for="mobile_no">Mobile No</label>
        <?php echo form_error('mobile_no'); ?>
        <br /><input id="mobile_no" type="text" name="mobile_no" maxlength="255" value="<?php echo set_value('mobile_no'); ?>"  />
</p>

<p>
        <label for="fax">Fax</label>
        <?php echo form_error('fax'); ?>
        <br /><input id="fax" type="text" name="fax" maxlength="255" value="<?php echo set_value('fax'); ?>"  />
</p>

<p>
        <label for="email_id">Email Id</label>
        <?php echo form_error('email_id'); ?>
        <br /><input id="email_id" type="text" name="email_id" maxlength="255" value="<?php echo set_value('email_id'); ?>"  />
</p>

<p>
        <label for="remarks">Remarks</label>
        <?php echo form_error('remarks'); ?>
        <br /><input id="remarks" type="text" name="remarks"  value="<?php echo set_value('remarks'); ?>"  />
</p>

</div>
<p>
        <?php echo form_submit( 'submit', 'Submit'); ?>
        <input type="button" value="Reset" onclick="resetForm();">
</p>


<?php echo form_close(); ?>
