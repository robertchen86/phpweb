$(document).ready(function() {
	  $('#act').bind('change', function() { act_change(); });
});
function act_change(){
 	   if($('#act').attr('value') == 'tochange'){
 	   	   $('#to_school').attr('disabled',false);
 	   }else{
 	   	   $('#to_school').attr('disabled',true);
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
    	  //$('#goawayto').attr('disabled',true);
    	  $('#act').attr('disabled',true);
    	  $('#dosubmit').attr('disabled',true);
    	  $('#to_school').attr('disabled',true);
    }else{
    	  $('#act').attr('disabled',false);
    	  $('#dosubmit').attr('disabled',false);
    	  act_change();
    }
}

//去左右空格
function trim(str) {
    return str.replace(/\s+$|^\s+/g, '');
}