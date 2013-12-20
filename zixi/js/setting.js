$(document).ready(function(){
	$("input[type=button]").bind("click",function(){checkAll();});
$("#member_school_code").bind('change', function(){school_change();});
	
});var errmsg={0:"昵称不能为空！",1:"登录密码不能为空！",2:"确认密码不能为空！",3:"登录密码与确认密码不一致！",4:"请正确输入出生日期！",5:"学号不能为空！",6:"发生不知名的错误，数据丢失！",7:"所在学校没有该学号！"};
function checkAll(){
	if(!checkName()){return false}
	if($("#password").val()!=$("#repassword").val()){
		$("#error-text").empty();$("#error-text").append(errmsg[3]);
		return false}
	if(!checkBirthday()){return false}
	
	if($("#member_type").val() !=1){
		if(!checkStudentCode())return false;
		if($("#member_school_code").val() == '0000000000000000'){
			document.settingForm.submit(); 
		}else{
			//alert('dd');
			$.ajax({
				type: 'POST',
				url: $("#web_site").val()+'/?a=student_code_check',
				dataType:'json',
				data:{member_student_code:$('#member_student_code').val(),member_school_code:$('#member_school_code').val()},
				cache: false,
				async: false,
				success: function(msg){
					switch (msg.state) {
					case 0:
						$("#error-text").empty();
						$("#error-text").append(errmsg[6]);
						break;
				    case 1:
				    	$("#error-text").empty();
						$("#error-text").append(errmsg[7]);
		                break;
		            case 2:
		            	document.settingForm.submit();
		                break;
				    }
				}
			});
		}
	}else{
		document.settingForm.submit();
	}
	
	
	
	//document.settingForm.submit()
}
function school_change(){
	  if($("#member_school_code").val() == '0000000000000000'){
		  $("#member_student_code").attr('disabled',true);
	  }else{
		  $("#member_student_code").attr('disabled',false);
		  //if($("#member_identity_type").val() == 1){
		//	  $("#member_student_code").attr('disabled',true);
		  //}else{
		//	  $("#member_student_code").attr('disabled',false);
		 // }
	  }
}
function checkStudentCode(){
	if($("#member_school_code").val() == '0000000000000000')return true;
	//if($("#member_identity_type").val() == 1)return true;
	if(!checkSpace("member_student_code",5))return false;
	//return true;
	$("#error-text").empty();return true
	
}

function checkName(){if(!checkSpace("member_name",0)){return false}$("#error-text").empty();return true}function checkBirthday(){var a=$("#birthyear").val()+"-"+$("#birthmonth").val()+"-"+$("#birthday").val();if(a!="--"){if(!isValidDate(a)){$("#error-text").empty();$("#error-text").append(errmsg[4]);return false}}$("#error-text").empty();return true}function isValidDate(a){var b=a.split("-");var c=new Date(b[0],(b[1]-1),b[2]);return !!(c&&(c.getMonth()+1)==b[1]&&c.getDate()==Number(b[2]))}function checkSpace(e,b){var d=$("#"+e).val();d=trim(d);var a="#error-text";if(d==""){$(a).empty();var c="&nbsp;"+errmsg[b];$(a).append(c);return false}$(a).empty();return true}function trim(a){return a.replace(/\s+$|^\s+/g,"")};