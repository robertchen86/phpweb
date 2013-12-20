$(document).ready(function(){
	var base_site= location.href;
	var examid = 1;//第几道
	var setT = setTimeout(autoTime,0); 
	
	var time = 0;
	var setstatus = 1;
	$('body').bind('contextmenu', function() {//屏蔽右键
      return false;
  });
	function autoTime(){
		clearTimeout(setT);
		if(setstatus == 2){//结束
			return;
		}else if(time > timemax){// 超过时间
			//time = 0;	
			
			checkToNext();
			setstatus = 1;
			setT = setTimeout(autoTime, 1000);
		}else	if(setstatus == 0){
			//time = 0;
			setstatus = 1;
			setT = setTimeout(autoTime, 1000);
		}else{
			//time = 0;
			$(".content").hide();
			$(".content").eq(0).show();
			setT = setTimeout(autoTime,1000);
		}
		$(".answer_time").replaceWith('<div class="answer_time"><h1>答题倒计时：' + (timemax-time++) + '</h1></div>');
	}
	
	$(".content").hide();
	$(".content").eq(0).show();

	$(".answer_action_right input").eq(0).click(function(){
		checkToNext();
	});
	
	$(".answer_action_right input").eq(1).click(function(){
		var selectindex = $('input:radio[name="answerss"]:checked').val();
		if(selectindex == null){
			alert("请选择");
			$(".answer_action_left_input").focus();
			return;
		}
		checkToNext();
	});
	
	$(".answer_action_left_input").keyup(function(e){
		if(e.keyCode == 65 || e.keyCode == 66 || e.keyCode == 67 || e.keyCode == 68){
			$(this).val($(this).val().toLocaleUpperCase());
		}else{
			$(this).val("");
		}
	});

	function checkToNext(){
		var g_time = $('#g_time').val();
		g_time = g_time.replace(/\s/g, '_');
		var selectindex = $('input:radio[name="answerss"]:checked').val();//选择的答案
		if(selectindex == null){//没有选
			selectindex = "N";
		}
		$.getJSON(base_site + "/id/" + examid + "/" + $("#examid").val() + "/" + selectindex + "/" + time+ "/" + g_time, function(json){
			if(json.examid == 0){
				//$("#exam_title_end").replaceWith('<span id="exam_title_end" itemprop="name" class="title desktop-only">您已完成' + json.count.c + '道题，答对' + json.count.truecount + '道，答错' + json.count.falsecount + '道！</span>');
				examid = 1;
				if(json.istrue == 1){
					$(".content").hide();
		  		$(".content").eq(2).show();
		  		setstatus = 0;
				}else{
					$(".content").hide();
		  		$(".content").eq(3).show();
		  		setstatus = 0;
				}
				//$(".content").hide();
		  	//$(".content").eq(1).show();
		  	setstatus = 2;
			  time = 0;
			  if(json.count.truecount == json.count.c){
						alert('您已完成' + json.count.c + '道题，答对' + json.count.truecount + '道，答错' + json.count.falsecount + '道！\n恭喜你，这个知识点过关了。请继续学习下一个知识点');
				}else{
					alert('您已完成' + json.count.c + '道题，答对' + json.count.truecount + '道，答错' + json.count.falsecount + '道！\n请再接再厉！');
					//location.reload();
				}
				history.go(-1);
			}else{
				examid ++;
				if(json.istrue == 1){
					$(".content").hide();
		  		$(".content").eq(2).show();
		  		setstatus = 0;
				}else{
					$(".content").hide();
		  		$(".content").eq(3).show();
		  		setstatus = 0;
				}
				if(json.exam == null){
					//alert("题库已被你测完了");
					
					//$("#exam_title_end").replaceWith('<span id="exam_title_end" itemprop="name" class="title desktop-only">您已完成' + json.count.c + '道题，答对' + json.count.truecount + '道，答错' + json.count.falsecount + '道！</span>');
					
					examid = 1;
					//$(".content").hide();
			  	//$(".content").eq(1).show();
			  	setstatus = 2;
			  	time = 0;
			  	if(json.count.truecount == json.count.c){
						alert('您已完成' + json.count.c + '道题，答对' + json.count.truecount + '道，答错' + json.count.falsecount + '道！\n恭喜你，这个知识点过关了。请继续学习下一个知识点');
						//history.go(-1);
					}else{
						alert('您已完成' + json.count.c + '道题，答对' + json.count.truecount + '道，答错' + json.count.falsecount + '道！\n请再接再厉！');
						//location.reload();
					}
					history.go(-1);
					return;
				}
				
				$("#exam_num").replaceWith('<span id="exam_num" itemprop="name" class="title desktop-only">第' + examid + '题：</span>');
		  	$("#exam_title").replaceWith('<span id="exam_title" itemprop="name" class="title desktop-only">' + json.exam.exam_title + '</span>');
		  	$("#examid").val(json.exam.exam_id);
		  	//$(".answer_list").replaceWith('<div class="answer_list">json.exam.exam_answer</div>');
		  	$(".current_exam").replaceWith('<span class="current_exam">' + examid + '</span>');
		  	$('input:radio[name="answerss"]').attr("checked", false);
		  	$(".answer_action_left_input").focus();
		  	
			}
		});
		//time = 0;
	}
	
});
