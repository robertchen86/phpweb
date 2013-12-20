$(function() {
	  row_auto();
});
function row_auto(){
	  $('#city_search').autocomplete('./?a=get_city', {autoid:'#city_search',
    	  max: 200,minChars: 1,width: 280,scroll: true,scrollHeight: 500,matchContains: true,autoFill: false,
	  	  dataType: 'json',parse:function(data) {return parse(data);},
	  	  formatItem: function(row, i, max) {return i + '/' + max + ':  (' + row.letter +')' + row.name + ' [' + row.ping+ ']';}, 
	  	  formatMatch: function(row, i, max) {return row.letter + row.ping;},formatResult: function(row) {return  row.name;} 
        }).result(function(event, row, formatted) { 
    	  	  	  $('#city_id').attr('value',row.id);
       });
}
function parse(data) {
	  var parsed = [];
	  for (var i=0; i < data.length; i++) {
	  	  parsed[parsed.length] = {data: data[i],value: data[i].name,result: data[i].name };
	  }
    return parsed;  
};
function checkboxall(obj) {
    var checkboxs = document.getElementsByName("checkboxlist");
    if (obj.checked == true) {
        for (var i = 0; i < checkboxs.length; i++) {
            checkboxs[i].checked = true;
        }
    }
    else {
        for (var i = 0; i < checkboxs.length; i++) {
            checkboxs[i].checked = false;
        }
    }
    checkbox();
}
function checkbox() {
	  var tmpstr = "";
	  var j = 0;
	  var checkboxs = $("input[type=checkbox][value !='on'][checked]");
    for(var i = 0; i < checkboxs.length ; i++) {
    	  //if(checkboxs[i].value != 1){
    	 	    tmpstr += "," + checkboxs[i].value;
    	 	    j += 1;
    	  //}
    }
    $('#check_select').attr('value',tmpstr);
    if(j <= 0){
    	  $('#act').attr('disabled',true);
    	  $('#dosubmit').attr('disabled',true);
    }else{
    	  $('#act').attr('disabled',false);
    	  $('#dosubmit').attr('disabled',false);
    }
}

//去左右空格
function trim(str) {
    return str.replace(/\s+$|^\s+/g, '');
}