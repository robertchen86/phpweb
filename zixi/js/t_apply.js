$(document).ready(function() {
 	  $("#kng_id").bind('change', function(){kng_id_change();});
 	  $("#submit-button").bind('click', function(){btn_save();});
});
var errmsg={0:"请选择老师！",1:"身份验证信息不能为空，老师无法识别你的身份！"};
function btn_save(){
	  if($('#m_t_apply_t_id').val() == null){
	  	  $("#error-text").append(errmsg[0]);
	  	  return false;
	  }
	  if(!checkt_apply())return false;
	  if(!checkapply_content())return false;
	  /*var checkboxs = $("input[type=checkbox]");
	  var c_count = 0;
	  for(var i = 0; i < checkboxs.length ; i++) {
    	if(checkboxs[i].checked == true)c_count += 1;
    }
	  if(c_count > 4)return false;*/
	  document.applyForm.submit();
}
function checkt_apply(){if(!checkSpace("m_t_apply_t_id",0)){return false}$("#error-text").empty();return true}
function checkapply_content(){if(!checkSpace("m_t_apply_content",1)){return false}$("#error-text").empty();return true}

function kng_id_change(){
	//$("#video_id").find("option").remove();url: './?a=exam_kng_video_get',
	//$("#video_id").append("<option value='0'>请选择视频</option>");
	$("#m_t_apply_t_id").html('');
	if($('#kng_id').val() != ''){
		$.ajax({
		  type: 'POST',
		  url: './?a=teacher_get',
	  	data:{kng_id:$('#kng_id').val()},
	  	datatype: 'json',
	  	cache: false,
	  	async: false,
	  	success: function(msg){
	  		$('#m_t_apply_t_id').html(msg);
			}
		});
	}
}
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