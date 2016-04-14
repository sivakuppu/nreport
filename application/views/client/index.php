<?php $this->load->view('header');?>

<div class="ui-layout-north"><?php $this->load->view('file');?></div>
<!-----------END NORTH------------>

<!-----------START CENTER------------>
<div class="ui-layout-center">

<div class="pull-right">
	<a href="<?php echo site_url('client/add'); ?>" class="btn btn-success">Add</a> 
</div>

<table class="table table-striped">
    <tr>
		<td>ID</td>
		<td>Code</td>
		<td>Display Code</td>
		<td>Name</td>
		<td>Place</td>
		<td>Parent Id</td>`
		<td>Actions</td>
    </tr>
	<?php foreach($client as $c): ?>
    <tr>
		<td><?php echo $c['id']; ?></td>
		<td><?php echo $c['code']; ?></td>
		<td><?php echo $c['display_code']; ?></td>
		<td><?php echo $c['name']; ?></td>
		<td><?php echo $c['place']; ?></td>
		<td><?php echo $c['parent_id']; ?></td>
		<td>
            <a href="<?php echo site_url('client/edit/'.$c['id']); ?>" class="btn btn-info">Edit</a> 
            <a href="<?php echo site_url('client/remove/'.$c['id']); ?>" class="btn btn-danger">Delete</a>
        </td>
    </tr>
	<?php endforeach; ?>
</table>
</div><!-- end center-->
<!-----------END CENTER------------>

<!-----------START SOUTH------------>	
<div class="ui-layout-south" >
</div>


<!-----------END SOUTH------------>
<?php $this->load->view('footer');?>