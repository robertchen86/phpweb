$(document).ready(function(){$("input[type=button]").bind("click",function(){checkAll()})});function checkAll(){if(trim($("#avatar").val())==""){return false}document.avatarForm.submit()}function trim(a){return a.replace(/\s+$|^\s+/g,"")};