 $(document).ready(function() {
 	  
 	  $("input[type=checkbox]").bind('change', function() { check($(this)); });
 	  $("#kng_id").bind('change', function(){kng_change($(this));});
 	  $("#kng_v_type").bind('change', function(){kng_type_change($(this));});
 	  $("#kng_set_id").bind('change', function(){kng_set_change($(this));});
 	  
 	  $("#btn_tiaoz").bind('click', function(){btn_tiaoz();});
 	  $("#btn_save").bind('click', function(){btn_save();});
 	  $("#btn_pre").bind('click', function(){btn_pre();});
 	  $("#btn_next").bind('click', function(){btn_next();});
 	  $("#btn_del").bind('click', function(){btn_del();});
 	  $("#input_content").bind('keyup', function(){inputKeydown();});
 	  
 	  $('#step_one').bind('mousedown', function(){mousedown(step_id ='step_one');});
 	  $('#step_two').bind('mousedown', function(){mousedown(step_id ='step_two');});
 	  $('#step_three').bind('mousedown', function(){mousedown(step_id ='step_three');});
 	  
 	  $("#btn_insertto").bind('click', function(){insertToCheck();});
});
var step_id = '';
function inputKeydown(){
	  var tmp_url = './?a=math_to_view&m_content='+encodeURIComponent($("#input_content").attr('value'));
	  $("#if_input_preview").attr('src',tmp_url);
}
function insertToCheck(){
	  if(step_id == '')return false;
	  var obj = document.getElementById(step_id);
	  //document.getElementById('text')
	  var str = $("#input_content").attr('value');
    if (document.selection) {
        var sel = document.selection.createRange();
        sel.text = str;
    } else if (typeof obj.selectionStart === 'number' && typeof obj.selectionEnd === 'number') {
        var startPos = obj.selectionStart,
            endPos = obj.selectionEnd,
            cursorPos = startPos,
            tmpStr = obj.value;
        obj.value = tmpStr.substring(0, startPos) + str + tmpStr.substring(endPos, tmpStr.length);
        cursorPos += str.length;
        obj.selectionStart = obj.selectionEnd = cursorPos;
    } else {
        obj.value += str;
    }	 

}
function previewCheck(){
	 // loadMathjax();
	 
	  var tmp_url = './?a=math_to_view&m_content='+encodeURIComponent($('#step_one').attr('value')+$('#step_two').attr('value')+$('#step_three').attr('value'));
	  $("#if_step_preview").attr('src',tmp_url);
	  
	  //$('#p_preview').html($('#step_one').attr('value')+$('#step_two').attr('value')+$('#step_three').attr('value'));
	  $('#exam_step_preview')[0].style.display='block';
	  $('#exam_step')[0].style.display='none';
	  $('#btn_preview_cancle')[0].style.display='block';
	  $('#btn_preview')[0].style.display='none';
	  
	  
}
function previewCancleCheck(){
	  $('#exam_step_preview')[0].style.display='none';
	  $('#exam_step')[0].style.display='block';
	  $('#btn_preview_cancle')[0].style.display='none';
	  $('#btn_preview')[0].style.display='block';
}

function selectTag(showContent,selfObj){
	  // 操作标签
	  var tag = $("#innouni_sub_title")[0].getElementsByTagName("li");
	  var taglength = tag.length;
	  for(i=0; i<taglength; i++){
		   tag[i].className = "unsub";
	  }
	  selfObj.parentNode.className = "sub";
	  
	  // 操作内容
	  for(i=0; j=$("#tagContent"+i)[0]; i++){
		   j.style.display = "none";
	  }
	  $('#'+showContent)[0].style.display = "block";
	  //if(showContent.id == 'tagContent1')$('#tagContent2')[0].style.display = "block";
}
function check(it){
	  if($("#video_ids").val() == "" && it.attr("checked")){
		    $("#video_ids").val("," + it.val() + ",");
	  }else if($("#video_ids").val() != ""){
			  var isin = false;
			  if($("#video_ids").val().indexOf("," + it.val() + ",") >= 0){
			  	  isin = true;
			  }
			  if(it.attr("checked") == true && isin == false){
			      $("#video_ids").val($("#video_ids").val() + it.val() + ",");
			  }else if(it.attr("checked") == false && isin == true){
			      $("#video_ids").val($("#video_ids").val().replace(it.val() + ",", ""));
			  }
	  }
}
function kng_set_change(it){
	$("#video_id").find("option").remove();
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
	  		//$("#video_id").append(msg);
	  		$("#video_list_show").html(msg);
	  		$("#video_ids").val("");
	  		$("input[type=checkbox]").bind('change', function() { check($(this)); });
			}
		});
	}
}

function btn_tiaoz(){
    $('#act').attr('value','tz');
	   document.addform.submit();
}
function btn_save(){
	  $('#act').attr('value','save');
	   document.addform.submit();
}
function btn_pre(){
    $('#act').attr('value','pre');
	  $('#updown').attr('value','1');
	   document.addform.submit();
}
function btn_next(){
	  $('#act').attr('value','next');
	  $('#updown').attr('value','2');
	   document.addform.submit();
}
function btn_del( ){
	  $('#act').attr('value','del');
	   document.addform.submit();
}
function kng_change(it){
	  $('#act').attr('value','');
	   document.addform.submit();
}
function kng_type_change(it){
	  $('#act').attr('value','');
	   document.addform.submit();
}



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