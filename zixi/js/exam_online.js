$(document).ready(function() {
 	  /*$('#btn_giveup').bind('change', function() { check(this); });
 	  //$("#kng_id").bind('change', function(){kng_change($(this));});
 	  $("#btn_save").bind('click', function(){btn_save();});
 	  */
 	  base_site= location.href;
 	  $('#btn_giveup').bind('click', function() {  type = 1;checkToNext();});
 	  $('#btn_next').bind('click', function() { type = 0;checkBtnNext(); });
 	  exam_num = 1;//第几道
	  setTR = setTimeout(autoTime,0); 
	  time = 0;
	  timeout = 0;//0 没有超时
	  type = 0;
	  
});
var setTR,time,exam_num,type,timeout,base_site;

function autoTime(){
	  clearTimeout(setTR);
	  var timemax = $('#timemax').val();
		if(timemax == 0){
			  //clearTimeout(setTR);
			  timeout = 1;
			  checkToNext();
		}else{
			  time+=1;
			  var ntime = (timemax-1);
		    $('#timemax').attr('value',ntime);
		    $('.answer_time').replaceWith('<div class="answer_time"><h1>答题倒计时：' + ntime + '</h1></div>');
			  setTR = setTimeout(autoTime,1000); 
		}
}
function checkBtnNext(){
	  
    var selectindex = $('input:radio[name="answerss"]:checked').val();
		if(selectindex == null){
			   alert("请选择");
			   $(".answer_action_left_input").focus();
			   return;
		}
		checkToNext();
}
function checkToNext(){
	  clearTimeout(setTR);
	  var g_time = $('#g_time').val();
		g_time = g_time.replace(/\s/g, '_');
		exam_num = $('#exam_number').val();
		var selectval = $('input:radio[name="answerss"]:checked').val();//选择的答案
		if(selectval == null){//没有选
			  selectval = "N";
		}
	  $.ajax({
			  type: 'POST',
			  url: $('#web_site').val()+'/?a=exam_next_check',
			  dataType:'json',
		  	data:{g_time:g_time,exam_num:exam_num,exam_ids:trim($('#exam_ids').val()),exam_id:trim($('#exam_id').val()),usetime:time,timeout:timeout,selectval:selectval,type:type},
		  	cache: false,
		  	async: false,
		  	success: function(msg){
		  		  //alert(msg.state);
		  		  if(msg.state == 0){//继续
		  		  	  $('#exam_num').replaceWith('<span id="exam_num" itemprop="name" class="title desktop-only">第' + msg.exam_num + '题：</span>');
		  	        $('#exam_title').replaceWith('<span id="exam_title" itemprop="name" class="title desktop-only">' + msg.exam_title + '</span>');
		  	        $('#exam_number').val(msg.exam_num);
		  	        $('.current_exam').replaceWith('<span class="current_exam">' + msg.exam_num + '</span>');
		  	        $('#exam_id').val(msg.exam_id);
		  	        $('input:radio[name="answerss"]').attr("checked", false);
		  		  	  time = 0;
		            setTR = setTimeout(autoTime,1000); 
		  		  }else{//结束
		  		  	  //alert(base_site+'/result/'+g_time+'/'+exam_ids);
		  		  	  window.location.href = base_site+'/result/'+g_time;
		  		  }
				}
		});
		
}
/*
function btn_save(){
	  var checkboxs = $("input[type=checkbox]");
	  var c_count = 0;
	  for(var i = 0; i < checkboxs.length ; i++) {
    	if(checkboxs[i].checked == true)c_count += 1;
    }
	  if(c_count > 4)return false;
	  document.exam_log.submit();
}
function check(it){
	var checkboxs = $("input[type=checkbox]");
	var string_t = '';
	for(var i = 0; i < checkboxs.length ; i++) {
    	if(checkboxs[i].checked == true)string_t +=',' + checkboxs[i].value;
  }
  $('#video_ids').attr('value',string_t);
}
function kng_set_change(it){
	//$("#video_id").find("option").remove();
	//$("#video_id").append("<option value='0'>请选择视频</option>");
	$("#video_list_show").html("");
	if(it.val() == 0){
	}else{
		$.ajax({
		  type: 'GET',
		  url: './?a=exam_kng_video_get',
	  	data:{videoid:it.val()},
	  	datatype: 'json',
	  	cache: false,
	  	async: false,
	  	success: function(msg){
	  		$("#video_list_show").html(msg);
	  		$("#video_ids").val("");
	  		$("input[type=checkbox]").bind('change', function() { check($(this)); });
			}
		});
	}
}*/
function checkspace(id, num) {
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
}
//去左右空格
function trim(str) {
    return str.replace(/\s+$|^\s+/g, '');
}