var key=9;
$(document).ready(function(){
	$(window).unload(function(){unloadfn()});
	$(".submit-add").bind("click",function(){checkAll()});
	$(".cancel-add").bind("click",function(){closseinput()});
	$(".player-container").bind("mousedown",function(){checkplay()});
	});
var errmsg={0:"留言失败！",1:"当天同一视频只可留言一次！",2:"留言更新失败！",3:"你确认要删除该留言?",4:"删除留言失败!"};
function checkAll(){if($(".text-add").val()==""){return false}$.ajax({type:"POST",url:$("#post_url").val(),data:{comment:$(".text-add").val(),video_id:$("#video_id").val(),member_id:$("#member_id").val()},cache:false,async:false,success:function(a){switch(a){case"0":alert(errmsg[0]);break;case"1":alert(errmsg[1]);break;default:$(".vlists").prepend(a);$(".text-add").val("");$(".text-add").removeAttr("onfocus");$(".text-add").attr("placeholder","亲，您今日对该视频已经留言了！");$(".text-add").attr("readonly",true)}}});closseinput()}function showvcoments(b){for(var a=0;a<10;a++){key+=1;if((key+1)>b){break}$("#vcitem_"+key).removeClass("result-hidden")}if((key+1)>b){$("#vc_list_more").addClass("result-hidden")}}function showinput(){$(".text-add").addClass("open");$(".controls-add").show()}function closseinput(){$(".text-add").removeClass("open");$(".controls-add").hide()}function showedit(a){$("#meta-controls_"+a).hide();$("#text-edit_"+a).show();$("#discussion-controls_"+a).show()}function closeedit(a){$("#meta-controls_"+a).show();$("#text-edit_"+a).hide();$("#discussion-controls_"+a).hide()}function postedit(a){if($("#text-edit_"+a).val()==""){return false}$.ajax({type:"POST",url:$("#post_editurl").val(),data:{comment:$("#text-edit_"+a).val(),vc_id:$("#vcid_"+a).val(),member_id:$("#member_id").val()},cache:false,async:false,success:function(b){switch(b){case"0":alert(errmsg[2]);break;default:$("#discussion-content_"+a).empty();$("#discussion-content_"+a).append($("#text-edit_"+a).val());$("#meta-faded_"+a).empty();$("#meta-faded_"+a).append(b);$("#text-edit_"+a).val("")}}});closeedit(a)}function dodel(a){if(!confirm(errmsg[3])){return false}$.ajax({type:"POST",url:$("#post_delturl").val(),data:{vc_id:$("#vcid_"+a).val(),member_id:$("#member_id").val()},cache:false,async:false,success:function(b){switch(b){case"0":alert(errmsg[4]);break;case"1":$("#vcitem_"+a).hide()}}})}function changeselect(a){$(".tabitem").removeClass("selected");$(".tabb"+a).addClass("selected");$(".comments-tab").hide();$(".tabdiv"+a).show()}function showcoments(){$.ajax({type:"POST",url:$("#post_tdurl").val(),data:{pageNo:$("#pageNo").val()},cache:false,async:false,success:function(b){switch(b){case"0":break;default:var a=b.split("****z*x*s****");$(".clists").append(a[0]);$("#pageNo").val($("#pageNo").val()+1);if($("#pageNo").val()>=a[1]){$("#c_list_more").hide()}}}})}
function checkplay(){
	if($("#member").val()==""){return}
	if($("#post_playurl").val()==""){return}
	$.ajax({type:"POST",url:$("#post_playurl").val(),data:{itemCode:$("#video_itemCode").val()},cache:false,async:true,success:function(){}})}function unloadfn(){$.ajax({type:"POST",url:$("#post_playurl").val(),data:{itemCode:$("#video_itemCode").val(),dotype:1},cache:false,async:false,success:function(){}})};