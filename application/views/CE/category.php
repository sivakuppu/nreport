<?php // Change the css classes to suit your needs    

$attributes = array('class' => '', 'id' => '');
echo form_open('category', $attributes); ?>

<p>
        <label for="category_name">Category Name <span class="required">*</span></label>
        <?php echo form_error('category_name'); ?>
        <br /><input id="category_name" type="text" name="category_name" maxlength="255" value="<?php echo set_value('category_name'); ?>"  />
</p>

<p>
        <label for="description">Description</label>
	<?php echo form_error('description'); ?>
	<br />
							
	<?=form_textarea( array( 'name' => 'description', 'rows' => '5', 'cols' => '80', 'value' => set_value('description') ) )?>
</p>

<p>
        <?php echo form_submit( 'submit', 'Submit'); ?>
</p>

<?php echo form_close(); ?>
