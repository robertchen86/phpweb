 $(document).ready(function() {
 	  $("input[type=checkbox]").bind('change', function() { check(this); });
 	  $("#kng_id").bind('change', function(){kng_change($(this));});
 	  $("#kng_v_type").bind('change', function(){kng_type_change($(this));});
 	  $("#kng_set_id").bind('change', function(){kng_set_change($(this));});
 	  
 	  $("#btn_save").bind('click', function(){btn_save();});
 	  $("#btn_pre").bind('click', function(){btn_pre();});
 	  $("#btn_next").bind('click', function(){btn_next();});
 	  $("#btn_del").bind('click', function(){btn_del();});
});

function check(it){
	  if($('#video_ids').attr('value') == ''){
	  	  if(it.checked == true)$('#video_ids').attr('value',',' + it.value + ',');
	  }else{
	  	  $('#video_ids').attr('value',$('#video_ids').attr('value').replace(it.value + ',', ''));
	  	  if(it.checked == true)$('#video_ids').attr('value',$('#video_ids').attr('value') + it.value + ',');
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
function btn_save(){
	  $('#act').attr('value','save');
	   document.exam_set.submit();
}
function btn_pre( ){
    $('#act').attr('value','pre');
	  $('#updown').attr('value','1');
	   document.exam_set.submit();
}
function btn_next( ){
	  $('#act').attr('value','next');
	  $('#updown').attr('value','2');
	   document.exam_set.submit();
}
function btn_del( ){
	  $('#act').attr('value','del');
	   document.exam_set.submit();
}
function kng_change(it){
	  $('#act').attr('value','');
	   document.exam_set.submit();
}
function kng_type_change(it){
	  $('#act').attr('value','');
	   document.exam_set.submit();
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