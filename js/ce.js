// JavaScript Document

$(document).ready(function () {
  $("#search-a").click(function () {
    $("#search-form").toggle("fast");
  });
  $("#add-form-a").click(function () {
    $("#add-form").toggle("slow");
  });
   $("#get-report-a").click(function () {
    $("#report-div").toggle("slow");
  });
  $('.popup-edit').live('dblclick', function() {  
         
          $(".popup-edit").editable(ce_base_url + 'CE/item_detail/update', { 
          indicator : "<img src='" + ce_base_url + "images/indicator.gif'>",
           tooltip   : "",
           event     : "dblclick",
           style  : "inherit"
        });
  });
  
  $('#get-report').click (function() {
    //var cat_id = $('#report-category').val();
    var item_name = $('#report-item-name').val();
    var specification = $('#report-specification').val();
    var make = $('#report-make').val();
    
    $.post(ce_base_url + 'CE/item_detail/search', {item_name: item_name, specification : specification, make : make }, 
    function(data) {
        $('#report-tbody tr').remove();
        $('#report-tbody').append(data);
    });
  });
  
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
  $('.delete-item-detail').click(function(e) {
      e.preventDefault();
      var a = confirm("Are you sure to delete this record?");
      if(!a) {
        return false;
      }
      $.get(ce_base_url + "CE/item_detail/delete/" +  $(this).attr('rel'), '', function(data) { 
        return false;
      });
  });
    
  $("#agent_search_text").autocomplete(ce_base_url + "CE/agent/search").result(function (evt, data, formatted) {  });
	$("#importer_search_text").autocomplete(ce_base_url + "CE/importer/search").result(function (evt, data, formatted) {  });
	$("#seller_search_text").autocomplete(ce_base_url + "CE/seller/search").result(function (evt, data, formatted) {  });
  $("#agent").autocomplete(ce_base_url + "CE/agent/search").result(function (evt, data, formatted) { $("#agent_id").val(data[1])});
	$("#importer").autocomplete(ce_base_url + "CE/importer/search").result(function (evt, data, formatted) { $("#importer_id").val(data[1]) });
	$("#seller").autocomplete(ce_base_url + "CE/seller/search").result(function (evt, data, formatted) { $("#seller_id").val(data[1]) });
	//$("#item_name").autocomplete(ce_base_url + "CE/item/search", {extraParams: {cat_id: function() { return $("#item_category_id").val() } } } ).result(function (evt, data, formatted) { $("#seller_id").val(data[1]) });
	$("#item_search_text").autocomplete(ce_base_url + "CE/item/search").result(function (evt, data, formatted) { $("#item_id").val(data[1]) });
	


   
});

function resetForm() {
  $('.common-form [type=text]').val('');
  $('.common-form textarea').text('');
}
