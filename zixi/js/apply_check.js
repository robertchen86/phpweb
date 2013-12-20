$(document).ready(function() {
 	  $("#btn_f").bind('click', function(){btn_save(1);});
 	  $("#btn_p").bind('click', function(){btn_save(2);});
});
var errmsg={0:"请选择老师！",1:"身份验证信息不能为空，老师无法识别你的身份！"};
function btn_save(id){
	  $("#state_v").val(id);
	  document.applyForm.submit();
}