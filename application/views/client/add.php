<?php $this->load->view('header');?>

<div class="ui-layout-north"><?php $this->load->view('file');?></div>
<!-----------END NORTH------------>

<!-----------START CENTER------------>
<div class="ui-layout-center">
<?php echo validation_errors(); ?>

<?php echo form_open('client/add',array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="code" class="col-md-4 control-label">Code</label>
		<div class="col-md-8">
			<input type="text" name="code" value="<?php echo $this->input->post('code'); ?>" class="form-control" id="code" />
		</div>
	</div>
	<div class="form-group">
		<label for="display_code" class="col-md-4 control-label">Display Code</label>
		<div class="col-md-8">
			<input type="text" name="display_code" value="<?php echo $this->input->post('display_code'); ?>" class="form-control" id="display_code" />
		</div>
	</div>
	<div class="form-group">
		<label for="name" class="col-md-4 control-label">Name</label>
		<div class="col-md-8">
			<input type="text" name="name" value="<?php echo $this->input->post('name'); ?>" class="form-control" id="name" />
		</div>
	</div>
	<div class="form-group">
		<label for="place" class="col-md-4 control-label">Place</label>
		<div class="col-md-8">
			<input type="text" name="place" value="<?php echo $this->input->post('place'); ?>" class="form-control" id="place" />
		</div>
	</div>
	<div class="form-group">
		<label for="parent_id" class="col-md-4 control-label">Parent Id</label>
		<div class="col-md-8">
			<select name="parent_id" class="form-control">
				<option value="">select client</option>
				<?php 
				foreach($clients as $client)
				{
					echo '<option value="'.$client['id'].'">'.$client['name']."</option>";
				} 
				?>
			</select>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Save</button>
        </div>
	</div>

<?php echo form_close(); ?>
</div><!-- end center-->
<!-----------END CENTER------------>

<!-----------START SOUTH------------>	
<div class="ui-layout-south" >
</div>


<!-----------END SOUTH------------>
<?php $this->load->view('footer');?>