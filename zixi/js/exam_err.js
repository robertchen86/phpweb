 $(document).ready(function() {
 	  $("#kng_s_id").bind('change', function(){kng_change($(this));});
 	  $("#video_s_id").bind('change', function(){video_change($(this));});
 	  $("#btn_pre").bind('click', function() { next_change('up'); });
 	  $("#btn_next").bind('click', function() { next_change('down'); });
 	  $("#btn_del").bind('click', function() { exam_del(); });
 	  //$("#btn_next").bind('click', function() { next_change('down'); });
 	  //var tmp_url = './?a=math_to_view&m_content='+encodeURIComponent($("#exam_step_space").val());
	   //$("#if_step_preview").attr('src',tmp_url);
});
function showBz(){
	  //$('#span_hdo_'+id).hide();
	  $('#tb_buzou').show();
	  $('#btn_view').attr('disabled',true);
}
function hideBz(){
	  $('#tb_buzou').hide();
	  $('#btn_view').attr('disabled',false);
}
function showZy(){
	  $('#tb_zhiyi').show();
	  $('#btn_zhiyi').attr('disabled',true);
}
function hideZy(){
	  $('#tb_zhiyi').hide();
	  $('#btn_zhiyi').attr('disabled',false);
}
function exam_del(){
	if(!confirm('确定要删除该错题？'))return false;
	$.ajax({
		type: 'POST',
		url: './?a=exam_del_check',
		dataType:'json',
	  	data:{er_id:$('#er_id').val()},
	  	cache: false,
	  	async: false,
	  	success: function(msg){
	  		  if(msg.state == 0){
	  			 next_change('down');
	  		  }else if(msg.state == 1){
	  		  	  alert('错题删除失败！');
	  		  }
		}
	});
}
function do_submint(){
    if(trim($('#zhiyi_content').val()) == ''){
    	  alert('质疑理由不能为空');
    	  return false;
    }
    $.ajax({
			  type: 'POST',
			  url: './?a=exam_zhiyi_check',
			  dataType:'json',
		  	data:{member_id:trim($('#member_id').val()),exam_id:trim($('#exam_id').val()),zhiyi_content:trim($('#zhiyi_content').val())},
		  	cache: false,
		  	async: false,
		  	success: function(msg){
		  		  //alert(msg.state);
		  		   if(msg.state == 0){
		  		  	  hideZy();
		  		  	  alert('质疑信息提交成功！');
		  		  }else if(msg.state == 1){
		  		  	  alert('质疑信息提交失败！');
		  		  }else if(msg.state == 2){
		  		  	  alert('质疑信息提交失败，不可重复提交质疑！');
		  		  }
				}
		});
    
}
function kng_change(it){
	  $.ajax({
		  type: 'POST',
		  url: './?a=exam_vid_get',
	  	data:{kngid:it.val()},
	  	datatype: 'json',
	  	cache: false,
	  	async: false,
	  	success: function(msg){
	  		  $("#video_s_id").empty();
	  		  $("#video_s_id").append(msg);
	  		  $("#err_time").attr("value","");
			}
		});
	
}
function video_change(it){
	$("#btn_pre").attr("disabled",true);
	$("#btn_next").attr("disabled",true);
	$("#err_time").attr("value","");
	$("#exam_answer").attr("value","");
	$("#exam_true").attr("value","");
	$("#exam_title").empty();
	$.ajax({
		  type: 'POST',
		  url: './?a=exam_content_get',
	  	data:{vid:$("#video_s_id").val(),c_time:''},
	  	dataType: 'json',
	  	cache: false,
	  	async: false,
	  	success: function(msg){
	  		  if(msg.state == 1){
	  		  	  alert("没有相关错题！");
	  		  }else{
	  		  	  $("#err_time").attr("value",msg.er_time);
	  		      $("#exam_answer").attr("value",msg.er_exam_answered);
	  		      $("#exam_true").attr("value",msg.exam_true);
	  		      $("#exam_title").empty();
	  		      $("#exam_title").append(msg.exam_title);
	  		      $("#exam_id").attr("value",msg.exam_id);
	  		      $("#er_exam_type").empty();
	  		      $("#er_exam_type").append(msg.op_exam_type);
	  		      $("#er_exam_comments").empty();
	  		      $("#er_exam_comments").append(msg.er_exam_comments);
	  		      //$("#p_exam_step").empty();
	  		      //$("#p_exam_step").append(msg.exam_step_space);
	  		      var tmp_url = './?a=math_to_view&m_content='+encodeURIComponent(msg.exam_step_space);
	            $("#if_step_preview").attr('src',tmp_url);
	  		      $("#btn_pre").attr("disabled",false);
	  		      $("#btn_next").attr("disabled",false);
	  		  }
			}
		});
	
}
function next_change(prenext){
	  $("#btn_pre").attr("disabled",false);
	  $("#btn_next").attr("disabled",false);
    $.ajax({
		  type: 'POST',
		  url: './?a=exam_content_get',
	  	data:{vid:$("#video_s_id").val(),c_time:$("#err_time").val(),prenext:prenext},
	  	dataType: 'json',
	  	cache: false,
	  	async: false,
	  	success: function(msg){
	  		  //alert(msg);
	  		  if(msg.state == 1){
	  		  	  if(prenext == 'up')$("#btn_pre").attr("disabled",true);
	  		  	  if(prenext == 'down')$("#btn_next").attr("disabled",true);
	  		  	  alert(msg.err_msg);
	  		  }else{
	  		  	  $("#err_time").attr("value",msg.er_time);
	  		      $("#exam_answer").attr("value",msg.er_exam_answered);
	  		      $("#exam_true").attr("value",msg.exam_true);
	  		      $("#exam_id").attr("value",msg.exam_id);
	  		      $("#exam_title").empty();
	  		      $("#exam_title").append(msg.exam_title);
	  		      // alert(msg.er_exam_type);op_exam_type
	  		      //$("#er_exam_type").attr("value",msg.er_exam_type)
	  		      
	  		      $("#er_exam_type").empty();
	  		      $("#er_exam_type").append(msg.op_exam_type);
	  		      $("#er_exam_comments").empty();
	  		      $("#er_exam_comments").append(msg.er_exam_comments);
	  		      //$("#p_exam_step").empty();
	  		      var tmp_url = './?a=math_to_view&m_content='+encodeURIComponent(msg.exam_step_space);
	            $("#if_step_preview").attr('src',tmp_url);
	  		      //$("#p_exam_step").append(msg.exam_step_space);
	  		  }
	  		  
			}
		});

}
//去左右空格
function trim(str) {
    return str.replace(/\s+$|^\s+/g, '');
}
