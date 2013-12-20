/*$(document).ready(function() {
    $('input[type=submit]').bind('click', function() { return checkform(); });
});*/
var lastCtrl = new Object();
function doLocation(ctrl){
	if(ctrl != lastCtrl){
		lastCtrl.className = "left_link";
	}
	ctrl.className = "left_link_over";
	lastCtrl = ctrl;
}
/*var curno = 0;
/*
function puckerShow(name, no, hiddenclassname, showclassname) {
    for (var i = 1; i <= $('#left ul').length; i++)
    {
        $('#'+name+i)[0].className = hiddenclassname;
    }
    $('#'+name+curno)[0].className = hiddenclassname;
    $('#'+name+no)[0].className=showclassname;
    curno = no;
}*/
var suBMenuId = 0;
function subMenuShow(id){
	  if(suBMenuId != id){
	 	    if(suBMenuId != 0){
	 	    	  $('#submenu_'+suBMenuId).removeClass(); 
            $('#submenu_'+suBMenuId).addClass('dis');
	 	    }
	 	    $('#submenu_'+id).removeClass(); 
        $('#submenu_'+id).addClass('block');
	 	    suBMenuId = id;
	  }else{
	  	  $('#submenu_'+id).removeClass(); 
        $('#submenu_'+id).addClass('dis');
        suBMenuId = 0;
	  }
}