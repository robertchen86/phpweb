function showHDo(id){
	  //$('#span_hdo_'+id).hide();
	  $('#div_hdo_'+id).show();
	  $('#btn_view_'+id).attr('disabled',true);
}
function hideHDo(id){
	  $('#div_hdo_'+id).hide();
	  $('#btn_view_'+id).attr('disabled',false);
}
function showZhiyi(id){
	  $('#div_zhiyi_'+id).show();
	  $('#btn_zhiyi_'+id).attr('disabled',true);
}
function cancelZhiyi(id){
	  $('#div_zhiyi_'+id).hide();
	  $('#btn_zhiyi_'+id).attr('disabled',false);
}
function do_submint(id){
    if(trim($('#zhiyi_content_'+id).val()) == ''){
    	  alert('质疑理由不能为空');
    	  return false;
    }
    $.ajax({
			  type: 'POST',
			  url: $('#web_site').val()+'/?a=exam_zhiyi_check',
			  dataType:'json',
		  	data:{member_id:trim($('#member_id').val()),exam_id:trim($('#exam_id_'+id).val()),zhiyi_content:trim($('#zhiyi_content_'+id).val())},
		  	cache: false,
		  	async: false,
		  	success: function(msg){
		  		  //alert(msg.state);
		  		  if(msg.state == 0){
		  		  	  cancelZhiyi(id);
		  		  	  alert('质疑信息提交成功！');
		  		  }else if(msg.state == 1){
		  		  	  alert('质疑信息提交失败！');
		  		  }else if(msg.state == 2){
		  		  	  alert('质疑信息提交失败，不可重复提交质疑！');
		  		  }
				}
		});
    
}
function do_submint_save(id){
    /*if(trim($('#zhiyi_content_'+id).val()) == ''){
    	alert('评论不能为空');
    	return false;
    }*/
    $.ajax({
		type: 'POST',
	     url: $('#web_site').val()+'/?a=exam_save_check',
			dataType:'json',
		  	data:{er_id:trim($('#er_id_'+id).val()),save_content:trim($('#save_content_'+id).val()),save_type:trim($('#save_type_'+id).val())},
		  	cache: false,
		  	async: false,
		  	success: function(msg){
		  		  //alert(msg.state);
		  		  if(msg.state == 0){
		  			  cancelSave(id);
		  			  $('#btn_save_'+id).attr('disabled',true);
		  		  	  alert('错题信息保存成功！');
		  		  }else if(msg.state == 1){
		  		  	  alert('质疑信息保存失败！');
		  		  }
				}
		});
    
}
function showSave(id){
	$('#div_save_'+id).show();
	$('#btn_save_'+id).attr('disabled',true);
}
function cancelSave(id){
	$('#div_save_'+id).hide();
	$('#btn_save_'+id).attr('disabled',false);
}
//去左右空格
function trim(str) {
    return str.replace(/\s+$|^\s+/g, '');
}
