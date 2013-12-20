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
    if(trim($('#reply_content').val()) == ''){
    	  alert('质疑回复内容不能为空');
    	  return false;
    }
    $.ajax({
			  type: 'POST',
			  url: $('#web_site').val()+'/?a=exam_zhiyi_reply',
			  dataType:'json',
		  	data:{member_id:trim($('#member_id').val()),reply_content:trim($('#reply_content').val()),qid:id},
		  	cache: false,
		  	async: false,
		  	success: function(msg){
		  		  //alert(msg.state);
		  		  if(msg.state == 0){
		  		  	 // cancelZhiyi();
		  		  	  alert('质疑回复成功！');
		  		  }else if(msg.state == 1){
		  		  	  alert('质疑回复失败！');
		  		  }
				}
		});
    
}
//去左右空格
function trim(str) {
    return str.replace(/\s+$|^\s+/g, '');
}
