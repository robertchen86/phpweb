$(document).ready(function() {
 	  $("#g_option").bind('change', function(){g_option_change();});
});
function g_option_change(){
	  $.ajax({
		  type: 'POST',
		  url: $('#web_site').val()+'/?a=student_get',
	  	data:{g_option:$('#g_option').val()},
	  	cache: false,
	  	async: false,
	  	success: function(msg){
	  		 $('#tb_st_list').empty();
	  		 $('#tb_st_list').append(msg);
	  	}
		});
	  
	  //document.applyForm.submit();
}