$(document).ready(function(){$("input[type=button]").bind("click",function(){checkAll()})});var errmsg={0:"昵称不能为空！",1:"邮箱不能为空！",2:"邮箱格式不正确！",3:"发生不知名的错误，数据丢失！",4:"该邮箱已存在！"};function checkAll(){if(!checkName()){return false}if(!checkEmail()){return false}$.ajax({type:"POST",url:"./?a=email_check",data:{member_email:$("#member_email").val()},cache:false,async:false,success:function(a){switch(a){case"0":$("#error-text-member_email").empty();$("#error-text-member_email").append("&nbsp;"+errmsg[3]);break;case"1":$("#error-text-member_email").empty();$("#error-text-member_email").append("&nbsp;"+errmsg[4]);break;case"2":document.signupForm.submit();break}}})}function checkName(){if(!checkSpace("member_name",0)){return false}$("#error-text-member_name").empty();return true}function checkEmail(){if(!checkSpace("member_email",1)){return false}if(!isEmail($("#member_email").val())){$("#error-text-member_email").empty();$("#error-text-member_email").append(errmsg[2]);return false}$("#error-text-member_email").empty();return true}function isEmail(a){if(a.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)!=-1){return true}return false}function checkSpace(e,b){var d=$("#"+e).val();d=trim(d);var a="#error-text-"+e;if(d==""){$(a).empty();var c="&nbsp;"+errmsg[b];$(a).append(c);return false}$(a).empty();return true}function trim(a){return a.replace(/\s+$|^\s+/g,"")};