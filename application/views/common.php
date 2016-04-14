<?php $this->load->view('header');?>
<div class="ui-layout-center">
  <h2>Search File by date</h2>
  <?php echo form_open('common/search', array('id'=>'search-form', 'method'=>'POST'));?>
    Select Date <input type="text" value="<?php echo $search_date;?>" name="search_date"  class="datepicker" >
    <input type="submit" value="Search" name="search">
   </form> 
    <?php if(!empty($search_data)):?>
        <table>
          <?php foreach($search_data as $file):?>
            <tr>
              <td><?php echo anchor('common/getFile/' . $file->id, $file->report_no); ?></td>
            </tr> 
          <?php endforeach;?> 
        </table>
        
    <?php endif;?>
   	
</div>
<div class="ui-layout-north"><?php echo $common_header;?></div>
<div class="ui-layout-south">South</div>

</div>
<?php $this->load->view('footer');?>