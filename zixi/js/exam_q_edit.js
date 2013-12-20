function showHDo(){
	  $('#div_hdo').show();
	  $('#btn_view').attr('disabled',true);
}
function hideHDo(){
	  $('#div_hdo').hide();
	  $('#btn_view').attr('disabled',false);
}
function showZhiyi(){
	  $('#div_zhiyi').show();
	  $('#btn_zhiyi').attr('disabled',true);
}
function cancelZhiyi(){
	  $('#div_zhiyi').hide();
	  $('#btn_zhiyi').attr('disabled',false);
}
function do_submint(id){
    if(trim($('#zhiyi_content').val()) == ''){
    	  alert('质疑理由不能为空');
    	  return false;
    }
    $.ajax({
			  type: 'POST',
			  url: $('#web_site').val()+'/?a=exam_zhiyi_check',
			  dataType:'json',
		  	data:{member_id:trim($('#member_id').val()),exam_id:trim($('#exam_id').val()),zhiyi_content:trim($('#zhiyi_content').val()),qid:id},
		  	cache: false,
		  	async: false,
		  	success: function(msg){
		  		  //alert(msg.state);
		  		  if(msg.state == 0){
		  		  	  cancelZhiyi();
		  		  	  alert('质疑信息修改成功！');
		  		  }else if(msg.state == 1){
		  		  	  alert('质疑信息修改失败！');
		  		  }
				}
		});
    
}
//去左右空格
function trim(str) {
    return str.replace(/\s+$|^\s+/g, '');
}
