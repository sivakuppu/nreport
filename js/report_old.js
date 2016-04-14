 $(document).ready(function (){
 
       	$('body').layout({ applyDefaultStyles: true });
      	$('.datepicker').datepicker({dateFormat: 'yy-mm-dd'});
     
        $(".show_remark").toggle(function(){
          $("#remark").val($("#remark-base").val());
         	$("#remark").show();
          $("#other_remark").hide();
          $("#official_seal").val("");
          $("#liner_seal").val("");
        }, function() {
          $("#remark").hide();
          $("#remark").val("");
          $("#other_remark").show(); 
       });

      
	       
	      $('.auto_place').autocomplete(base_url + "index.php/common/inspectionPlace", {
      		width: 290, 
      		selectFirst: false, 
      		minChars: 1,
      		matchContains: false,
      		mustMatch: false, 
        }); 
         
        $('.auto_client').autocomplete(base_url + "index.php/common/client", {
      		width: 290, 
      		selectFirst: false, 
      		minChars: 1,
      		matchContains: false,
      		mustMatch: false, 
        });
        
        
        $('.d_edit, .o_inspection,.mouseover, .s_g_edit,.t_e_general, .t_e_details , .t_e_invoice , .editable_select,.g_e_general,.g_e_details,.g_editable_select ').live('dblclick', function() {
         
          $(".d_edit").editable(base_url + 'index.php/inspection/dedit', { 
          indicator : "<img src='" + base_url + "images/indicator.gif'>",
           tooltip   : "Doubleclick to edit...",
           event     : "dblclick",
           style  : "inherit"
        });

        $(".o_inspection").editable(base_url + 'index.php/inspection/gedit', { 
          indicator : "<img src='" + base_url + "images/indicator.gif'>",
           tooltip   : "Doubleclick to edit...",
           event     : "dblclick",
           style  : "inherit"
        });

        
         $(".mouseover").editable(base_url + 'index.php/stuffing/updateDetails', { 
          indicator : "<img src='" + base_url + "images/indicator.gif'>",
           tooltip   : "Doubleclick to edit...",
           event     : "dblclick",
           style  : "inherit"
        });
        
        $(".s_g_edit").editable(base_url + 'index.php/stuffing/updateGeneral', { 
        indicator : "<img src='" + base_url + "images/indicator.gif'>",
         tooltip   : "Doubleclick to edit...",
         event     : "dblclick",
         style  : "inherit"
        });
        $(".t_e_general").editable(base_url + 'index.php/tobacco/updateGeneralDetails', { 
          indicator : "<img src='" + base_url + "images/indicator.gif'>",
          tooltip   : "Doubleclick to edit...",
          event     : "dblclick",
          style  : "inherit"
        });
        $(".t_e_invoice").editable(base_url + 'index.php/tobacco/updateInvoiceDetails', { 
        indicator : "<img src='" + base_url + "images/indicator.gif'>",
         tooltip   : "Doubleclick to edit...",
         event     : "dblclick",
         style  : "inherit"
        });
        $(".t_e_details").editable(base_url + 'index.php/tobacco/updateContainerDetails', { 
        indicator : "<img src='" + base_url + "images/indicator.gif'>",
         tooltip   : "Doubleclick to edit...",
         event     : "dblclick",
         style  : "inherit"
        });
        
        $(".g_e_details").editable(base_url + 'index.php/granite/updateDetails', { 
          indicator : "<img src='" + base_url + "images/indicator.gif'>",
           tooltip   : "Doubleclick to edit...",
           event     : "dblclick",
           style  : "inherit"
        });
        
        $(".g_e_general").editable(base_url + 'index.php/granite/updateGeneral', { 
        indicator : "<img src='" + base_url + "images/indicator.gif'>",
         tooltip   : "Doubleclick to edit...",
         event     : "dblclick",
         style  : "inherit"
        });
        
        $(".editable_select").editable(base_url + 'index.php/tobacco/updateContainerDetails', { 
          indicator : "<img src='" + base_url + "images/indicator.gif'>",
          data   : '{1:"40\'GP",2:"40\'HC",3:"20\'GP"}',
          type   : "select",
          submit : "OK",
          style  : "inherit",
        });
        
        $(".g_editable_select").editable(base_url + 'index.php/granite/updateContainerDetails', { 
          indicator : "<img src='" + base_url + "images/indicator.gif'>",
          data   : '{1:"40\'GP",2:"40\'HC",3:"20\'GP"}',
          type   : "select",
          submit : "OK",
          style  : "inherit",
        });
        
    });        
      
 });
 
function findValueCallback(event, data, formatted) {
  $('#client_id').val(data[1]);
}

function deleteStuffingDetails(id){
  $.get(base_url + 'index.php/stuffing/deleteDetails/' + id, '',function(response) {
    if(response == 1) {
      $("#tr-" + id).remove();
      alert("Successfully deleted");
    }
    else {
      alert("Unable to delete");
    }
  });
}

function deleteGraniteDetails(id){
  $.get(base_url + 'index.php/granite/deleteDetails/' + id, '',function(response) {
    if(response == 1) {
      $("#tr-" + id).remove();
      alert("Successfully deleted");
    }
    else {
      alert("Unable to delete");
    }
  });
}

function fillPattern() {
  var to = $('#p_to').val();
  var from = $('#p_from').val();
  var i = to;
  $('#pattern_table table input').each( function() {
  	if(i <= from) {
  	  $(this).val(i);
  	  i++;
  	}
  	else {
  	  $(this).val("**");
  	}
  });
}

function morePattern() {
  var no_of_row = $('#p_no_of_row').val();
  no_of_row = parseInt(no_of_row);

  if(typeof no_of_row == 'undefined' || no_of_row == 0 || no_of_row == 'NaN') {
      return false;
  }
  
  var last_value = $('#pattern_table table tr').length;
  var row = $('#pattern_table table tr:last').clone();
  var count = 1;
  while(1) {
    last_value++;
    $(row).contents().find('input').each(function(){
	$(this).attr('name', 'pattern['+ last_value +'][]');
	$(this).attr('value', '**');
    });
    $('#pattern_table table').append(row);

    if(count == no_of_row) {
      break;
    }
    count++;
  }
  
}

$('.all-form input').live("keypress", function(e) {
        /* ENTER PRESSED*/
        if (e.keyCode == 13) {
                /* FOCUS ELEMENT */
                var inputs = $(this).parents(".all-form").eq(0).find(":input");
                var idx = inputs.index(this);
 
                if (idx == inputs.length - 1) {
                        inputs[0].select()
                } else {
                        inputs[idx + 1].focus(); //  handles submit buttons
                        inputs[idx + 1].select();
                }
                return false;
        }
});

 
  function add(formID, appendID) {
    var options = { 
	      success:function(responseText, statusText) {
    	    $('#'+ appendID).append(responseText);
    	    alert("Successfully completed"); 
		},
  	url:  $('#' + formID ).attr('action'), 
  	clearForm:true,
  	type:'post'
    }; 
    $('#'+ formID).ajaxForm(options);   
    //return false;
    

  }
  
function containerType(type, id, value) {
  if(type == 0) {
    return;
  }
  $.post(base_url + 'index.php/stuffing/updateGeneral', { value: value, id: "number_of_container-"+id } );
}  

function deleteTobaccoDetails(id){
  $.get(base_url + 'index.php/tobacco/deleteContainerDetails/' + id, '',function(response) {
    if(response == 1) {
      $("#tr-1-" + id).remove();
      alert("Successfully deleted");
    }
    else {
      alert("Unable to delete");
    }
  });
} 
 
 function deleteInvoiceDetails(id){
  $.get(base_url + 'index.php/tobacco/deleteInvoiceDetails/' + id, '',function(response) {
    if(response == 1) {
      $("#tr-" + id).remove();
      alert("Successfully deleted");
    }
    else {
      alert("Unable to delete");
    }
  });
}

function getPattern(id) {
  $("#pattern-div").load(base_url + 'index.php/tobacco/getPatternFormData/' + id).dialog();
  var t = " Pattern  for  Container - " + $("#container_no-" + id).text();
  $( "#pattern-div" ).dialog( { title: t});
}  
 