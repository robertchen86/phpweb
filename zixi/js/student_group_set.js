$(document).ready(function() {
 	  $("#btn_save").bind('click', function(){btn_save();});
 	  $("input[type=checkbox]").bind('change', function() { check($(this)); });
});
function btn_save(){
	  var checkboxs = $("input[type=checkbox]");
	  var c_count = 0;
	  for(var i = 0; i < checkboxs.length ; i++) {
    	if(checkboxs[i].checked == true)c_count += 1;
    }
	  if(c_count == 0){alert('请先选择分组！');return false;}
	  document.applyForm.submit();
}
function check(it){
	  var checkboxs = $("input[type=checkbox]");
	  var string_t = '';
	  for(var i = 0; i < checkboxs.length ; i++) {
    	if(checkboxs[i].checked == true)string_t +=',' + checkboxs[i].value;
    }
     $('#group_ids').attr('value',string_t);
 
}

/*
var errmsg={0:"组名不能为空！",1:"该组名已经被使用！"};
function btn_save(){
	  if(!checkm_group_name())return false;
	  $.ajax({
		  type: 'POST',
		  url: $('#web_site').val()+'/?a=group_name_check',
	  	data:{m_group_name:$('#m_group_name').val(),member_id:$('#member_id').val()},
	  	cache: false,
	  	async: false,
	  	success: function(msg){
	  		 if(msg == 0){
	  		 	  document.applyForm.submit();
	  		 }else{
	  		 	  $('#error-text').append(errmsg[1]);
	  		 	  return false;
	  		 }
	  	}
		});
	  
	  //document.applyForm.submit();
}
function checkm_group_name(){if(!checkSpace("m_group_name",0)){return false}$("#error-text").empty();return true}
function checkSpace(e,b){var d=$("#"+e).val();d=trim(d);var a="#error-text";if(d==""){$(a).empty();var c="&nbsp;"+errmsg[b];$(a).append(c);return false}$(a).empty();return true}
/*function checkspace(id, num) {
    var checkobj = $(id).attr('value');
    checkobj = trim(checkobj);
    var checkobjspan = id + '_span';
    if (checkobj == '') {
        $(checkobjspan).empty();
        var restr = '&nbsp;' + errmsg[num];
        $(checkobjspan).append(restr);
        return false;
    }
    $(checkobjspan).empty();
    return true;
}*/
//去左右空格
function trim(str) {
    return str.replace(/\s+$|^\s+/g, '');
}