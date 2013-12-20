 $(document).ready(function() {
    $('input[type=button]').bind('click', function() { getToken(); });
});
function getToken(){
	  if($('#type').val() == '1'){
	  	if(trim($('#id').val()) == ''){
	  		  alert('先保存信息！');
	  	}else{
	  		document.setform.action = './?a=getTdToken';
	  		document.setform.submit();
	  	}
	  }
	  if($('#type').val() == '2'){
	  	if(trim($('#id').val()) == ''){
	  		  alert('先保存信息！');
	  	}else{
	  		document.setform.action = './?a=getYkToken';
	  		document.setform.submit();
	  	}
	  }
}

//去左右空格
function trim(str) {
    return str.replace(/\s+$|^\s+/g, '');
}