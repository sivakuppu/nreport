<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Report</title>
    <script type="text/javascript">
      var base_url = '<?php echo base_url();?>';
      var body_overflow = "<?php echo $this->uri->segment(1) == 'proform' ? "1" : "0"; ?>";
    </script>
    
    <link href="<?php echo base_url();?>css/facebox.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>css/table.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>css/layout-default.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>css/jquery-ui-1.8.custom.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>css/report.css?v=1" rel="stylesheet" type="text/css" />
      
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.layout.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-1.8.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/facebox.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/report.js?v=7"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.form.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.jeditable.js?v=1"></script>
    <?php 
      $report_type = $this->session->userdata('report_type');
      if($report_type == 1) {
        $option = "{ height:510,width:700, modal:true, closeOnEscape: false, postition: 'top'}"; 
      }elseif($report_type == 2) {
        $option = "{ height:485,width:565, modal:true, closeOnEscape: false, postition: 'top'}";

      }elseif($report_type == 3) {
        $option = "{ height:480,width:950, modal:true, closeOnEscape: false, postition: 'top'}";
      }  
      else {
        $option = "{ height:450,width:550, modal:true, closeOnEscape: false, postition: 'top'}";
      }
    ?>
    
     <script type="text/javascript">
        $(document).ready(function () {
        	$('body').layout({ applyDefaultStyles: true });
        	$('.datepicker').datepicker({dateFormat: 'yy-mm-dd'});
       		$( ".show-content" ).click(
      				function( event ){
      				  var container = $( "#" + $(this).attr('rel'));
      				  
      				  if (container.is( ":visible" )){
        				   container.dialog("destory");		
       					} else {
       						 container.dialog(<?php echo $option;?>);
      					}
      			  }
		);
		if(parseInt(body_overflow) == 1) {
		  $('#wholebody').css('overflow', 'auto');
		}
         }); 
    </script>
  </head>
  <body id="wholebody">
