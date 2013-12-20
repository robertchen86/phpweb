 $(document).ready(function() {
 	  $("#kng_id").bind('change', function(){kng_change($(this));});
 	  //$("#video_s_id").bind('change', function(){video_change($(this));});
 	  //$("input[type=button]").bind('click', function() { next_change(); });
});
function kng_change(it){
	  if(trim(it.val()) != ''){
	  $.ajax({
		  type: 'POST',
		  url: './?a=exam_vid_get',
	  	data:{kngid:it.val()},
	  	datatype: 'json',
	  	cache: false,
	  	async: false,
	  	success: function(msg){
	  		  $("#v_id").empty();
	  		  $("#v_id").append(msg);
	  		  $("#v_id").attr("disabled",false);
			}
		});
	  }else{
		   
		   $("#v_id").attr("disabled",true);
		}
	
}
function checkboxall(obj) {
    var checkboxs = document.getElementsByName("checkboxlist");
    if (obj.checked == true) {
        for (var i = 0; i < checkboxs.length; i++) {
            checkboxs[i].checked = true;
        }
    }
    else {
        for (var i = 0; i < checkboxs.length; i++) {
            checkboxs[i].checked = false;
        }
    }
    checkbox();
}
function checkbox() {
	  var tmpstr = "";
	  var j = 0;
	  var checkboxs = $("input[type=checkbox][value !='on'][checked]");
    for(var i = 0; i < checkboxs.length ; i++) {
    	  //if(checkboxs[i].value != 1){
    	 	    tmpstr += "," + checkboxs[i].value;
    	 	    j += 1;
    	  //}
    }
    $('#check_select').attr('value',tmpstr);
    if(j <= 0){
    	  $('#act').attr('disabled',true);
    	  $('#dosubmit').attr('disabled',true);
    }else{
    	  $('#act').attr('disabled',false);
    	  $('#dosubmit').attr('disabled',false);
    }
}

//去左右空格
function trim(str) {
    return str.replace(/\s+$|^\s+/g, '');
}