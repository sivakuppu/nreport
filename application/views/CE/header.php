<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Report</title>
    <script type="text/javascript">
      var ce_base_url = '<?php echo base_url();?>';
    </script>
    

    <link href="<?php echo base_url();?>css/table.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>css/ce.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>css/layout-default.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>css/jquery-ui-1.8.custom.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>css/jquery.autocomplete.css" rel="stylesheet" type="text/css" />  
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.layout.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-1.8.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.autocomplete.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/ce.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
          $('.datepicker').datepicker({dateFormat: 'yy-mm-dd'});
        	$('body').layout({ applyDefaultStyles: true });
       		$(function() {
      		$('a.popup-a').click(function(e) {
      			e.preventDefault();
      			var $this = $(this);
       			var horizontalPadding = 30;
      			var verticalPadding = 30;
      	        $('<iframe id="externalSite" class="externalSite" src="' + this.href + '" />').dialog({
      	            title: ($this.attr('title')) ? $this.attr('title') : 'External Site',
      	            autoOpen: true,
      	            width: 950,
      	            height: 500,
      	            modal: true,
      	            resizable: true,
      				autoResize: true,
      	            overlay: {
      	                opacity: 0.5,
      	                background: "black"
      	            }
      	        }).width(950 - horizontalPadding).height(500 - verticalPadding);	        
      		});
      	});
     }); 
    </script>
  </head>
  <body>
