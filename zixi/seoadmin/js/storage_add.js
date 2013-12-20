/*var option_s = {
    	  max: 200, //列表里的条目数 
	  	  minChars: 1, //自动完成激活之前填入的最小字符 
	  	  width: 300, //提示的宽度，溢出隐藏 
	  	  scroll: true,
	  	  scrollHeight: 500, //提示的高度，溢出显示滚动条 
	  	  matchContains: true, //包含匹配，就是data参数里的数据，是否只要包含文本框里的数据就显示 
	  	  autoFill: false, //自动填充 
	  	  formatItem: function(row, i, max) { 
	  	  	  return i + '/' + max + ':  (' + row.code +')' + row.name ; 
	  	  }, 
	  	  formatMatch: function(row, i, max) { 
	  	  	  return row.name + row.code; 
	  	  }, 
	  	  formatResult: function(row) { 
	  	  	  return row.name; 
	  	  } 
    };*/
var rows_count = 5;/*
var option_p = {
    	  max: 200, //列表里的条目数 
	  	  minChars: 1, //自动完成激活之前填入的最小字符 
	  	  width: 280, //提示的宽度，溢出隐藏 
	  	  scroll: true,
	  	  scrollHeight: 500, //提示的高度，溢出显示滚动条 
	  	  matchContains: true, //包含匹配，就是data参数里的数据，是否只要包含文本框里的数据就显示 
	  	  autoFill: false, //自动填充 
	  	  formatItem: function(row, i, max) { 
	  	  	  return i + '/' + max + ':  (' + row.code +')' + row.name + ' [' + row.model+ ']'; 
	  	  }, 
	  	  formatMatch: function(row, i, max) { 
	  	  	  return row.name + row.code; 
	  	  }, 
	  	  formatResult: function(row) { 
	  	  	  return  row.name; 
	  	  } 
    };
var jsondata;*/
$(function() {
	  rows_count = parseInt($('#p_list_count').attr('value'));
    //$.getJSON('./?act=get_product', {}, function(json) {
    	  //jsondata = json;
    	  for (i=1;i <= rows_count;i++){
    	  	  row_auto(i);
    	  	  /*$('#p_code_name_' + i).autocomplete(json, option_p).result(function(event, row, formatted) { 
    	  	  	  var tmp_i = this.id.split("_");
        	      $('#p_id_' + tmp_i[3]).attr('value',row.id);
        	      $('#p_model_' + tmp_i[3]).attr('value',row.model);
        	      $('#p_unit_' + tmp_i[3]).attr('value',row.unit);
        	      //$('#clear_row_' + tmp_i[3]).attr('disabled',false);
        	      $('#p_code_name_' + tmp_i[3]).attr('readonly',true);
        	      check_add_row();
            });*/
    	  }
    //});
    $('input[type=submit]').bind('click', function() { return check_form(); });
    $('#bt_cancel').bind('click', function() { window.location.href = './?act=storage_to_manage'; });
    $('#storage_from_code').bind('change', function() { change_from_code(); });
    $('#storage_add_time').bind('click', function() { getDateString(this, oCalendarChs); });
    $('#storage_time').bind('click', function() { getDateString(this, oCalendarChs); });
    for (i=1;i <= rows_count;i++){
    	  $('#clear_row_' + i).bind('click', function() { clear_row(this); });
    }
    $('#add_row').bind('click', function() { add_rows(); });
});
function row_auto(i){
	  $('#p_code_name_' + i).autocomplete('./?act=get_product', {autoid:'#p_code_name_' + i,
    	  max: 200,minChars: 1,width: 280,scroll: true,scrollHeight: 500,matchContains: true,autoFill: false,
	  	  dataType: 'json',parse:function(data) {return parse(data);},
	  	  formatItem: function(row, i, max) {return i + '/' + max + ':  (' + row.code +')' + row.name + ' [' + row.model+ ']';}, 
	  	  formatMatch: function(row, i, max) {return row.name + row.code;},formatResult: function(row) {return  row.name;} 
        }).result(function(event, row, formatted) { 
    	  	  	  var tmp_i = this.id.split("_");
        	      $('#p_id_' + tmp_i[3]).attr('value',row.id);
        	      $('#p_model_' + tmp_i[3]).attr('value',row.model);
        	      $('#p_unit_' + tmp_i[3]).attr('value',row.unit);
        	      //$('#clear_row_' + tmp_i[3]).attr('disabled',false);
        	      $('#p_code_name_' + tmp_i[3]).attr('readonly',true);
        	      check_add_row();
   });
}
function parse(data) {
	  var parsed = [];
	  for (var i=0; i < data.length; i++) {
	  	  parsed[parsed.length] = {data: data[i],value: data[i].name,result: data[i].name };
	  }
    return parsed;  
};
function clear_row(obj){
	  var tmp_i = obj.id.split("_");
	  $('#p_code_name_' + tmp_i[2]).attr('value','');
	  $('#p_id_' + tmp_i[2]).attr('value','');
    $('#p_model_' + tmp_i[2]).attr('value','');
    $('#p_unit_' + tmp_i[2]).attr('value','');
    $('#p_brand_' + tmp_i[2]).attr('value','');
    $('#p_count_' + tmp_i[2]).attr('value','0');
    $('#p_price_' + tmp_i[2]).attr('value','');
    $('#p_in_count_' + tmp_i[2]).attr('value','0');
    $('#s_count_' + tmp_i[2]).attr('value','0');
    $('#s_in_count_' + tmp_i[2]).attr('value','');
    $('#s_reference_' + tmp_i[2]).attr('value','');
    //$('#clear_row_' + tmp_i[2]).attr('disabled',true);
    $('#p_code_name_' + tmp_i[2]).attr('readonly',false);
    check_add_row();
    check_del_row();
}
/*
function check_money(obj){
	   var tmp_i = obj.id.split("_");
	   if((trim($('#s_count_' + tmp_i[2]).attr('value')) != '') & (/^\d+$/.test(trim($('#s_count_' + tmp_i[2]).attr('value'))))
	    & (trim($('#p_price_' + tmp_i[2]).attr('value')) != '') & (!isNaN(trim($('#p_price_' + tmp_i[2]).attr('value'))))
	   ){
	  	 	 $('#p_money_' + tmp_i[2]).attr('value',$('#p_price_' + tmp_i[2]).attr('value')* $('#p_count_' + tmp_i[2]).attr('value'));
	   }
}*/
function check_del_row(){
	  var input_v_count = $("input[class='ordlist'][value != '']");
	  var input_count = $("input[class='ordlist']");
	  if(6 <= (input_count.length - input_v_count.length)){
	  	  for (i= 0;i <= 4;i++){
	  	  	  row_index = rows_count - i;
	  	  	  $('tr').remove('#ordtr_'+ row_index);
	  	  }
	  	  rows_count = rows_count - 5;
	  	  chang_rows_count();
	  }
}
function check_add_row(){
	  var input_v_count = $("input[class='ordlist'][value != '']");
	  var input_count = $("input[class='ordlist']");
	  if(input_count.length == input_v_count.length){
	  	  $('#add_row').attr('disabled',false);
	  }else{
	  	  $('#add_row').attr('disabled',true);
	  }
}
function add_rows(){
	  var tmp_str = '';
    var row_index = 0;
	  for (i= 1;i <= 5;i++){
	  	  row_index = rows_count + i;
	  	  tmp_str += '<tr id="ordtr_'+row_index+'">';
	  	  tmp_str += '<td ><input type="hidden" class="ordlist" name="p_id_'+row_index+'" id ="p_id_'+row_index+'" value=""></td>';
	  	  tmp_str += '<td align="center"><input type="text" name="p_code_name_'+row_index+'" id ="p_code_name_'+row_index+'" style="width:96%"></td>';
	  	  tmp_str += '<td align="center"><input type="text" name="p_brand_'+row_index+'" id ="p_brand_'+row_index+'" style="width:96%"></td>';
	  	  tmp_str += '<td align="center"><input type="text" name="p_model_'+row_index+'" id ="p_model_'+row_index+'" style="width:96%" readonly></td>';
	  	  tmp_str += '<td align="center"><input type="text" name="p_unit_'+row_index+'" id ="p_unit_'+row_index+'" style="width:96%" readonly></td>';
	  	  
	  	  tmp_str += '<td align="center"><input type="text" name="p_price_'+row_index+'" id ="p_price_'+row_index+'" style="width:93%"></td>';
	  	  tmp_str += '<td align="center"><input type="text" name="p_count_'+row_index+'" id ="p_count_'+row_index+'" value="0" style="width:96%" disabled></td>';
	  	  tmp_str += '<td align="center"><input type="text" name="p_in_count_'+row_index+'" id ="p_in_count_'+row_index+'" value="0"  style="width:96%" disabled></td>';
	  	  
	  	  tmp_str += '<td align="center"><input type="text" name="s_count_'+row_index+'" id ="s_count_'+row_index+'"  value="0" style="width:96%" readonly></td>';
	  	  tmp_str += '<td align="center"><input type="text" name="s_in_count_'+row_index+'" id ="s_in_count_'+row_index+'" style="width:96%"></td>';
	  	  
	  	  tmp_str += '<td align="center"><input type="text" name="s_reference_'+row_index+'" id ="s_reference_'+row_index+'" style="width:96%"></td>';
	  	  tmp_str += '<td align="center"><input type="button" id="clear_row_'+row_index+'" value="清除" ></td>';
	  	  tmp_str += '<td ></td></tr>';
	  }
	  $('#ordlist').append(tmp_str);
	  for (j= 1;j <= 5;j++){
	  	  row_index = rows_count + j;
	  	  row_auto(row_index);
	  	  /*$('#p_code_name_' + row_index).autocomplete(jsondata, option_p).result(function(event, row, formatted) {
    	  	  var tmp_i = this.id.split("_");
        	  $('#p_id_' + tmp_i[3]).attr('value',row.id);
        	  $('#p_model_' + tmp_i[3]).attr('value',row.model);
        	  $('#p_unit_' + tmp_i[3]).attr('value',row.unit);
        	  //$('#clear_row_' + tmp_i[3]).attr('disabled',false);
        	  $('#p_code_name_' + tmp_i[3]).attr('readonly',true);
        	  check_add_row();
        });*/
        $('#clear_row_' + row_index).bind('click', function() { clear_row(this); });
       
	  }
	  $('#add_row').attr('disabled',true);
	  rows_count += 5;
	  chang_rows_count();
}
function chang_rows_count(){
	 $('#p_list_count').attr('value',rows_count);
}
var errmsg = {
    0: '请输入入库物品信息！',
    1: '实收数量不能为空！',
    2: '实收数量格式不正确！',
    3: '实收数量必须大于零（0）！',
    4: '单价格式不正确！',
    5: '单价不能为零（0）！',
    6: '供应商不能为空！',
    7: '实际到货时间格式不正确！',
    8: '实际到货时间必须大于零（0）！',
    9: '选单据不能为空！',
    10: '单价不能为空！',
    11: '入库经办人不能为空！',
    12: '收货人不能为空！',
    13: '物品品牌不能为空！',
    14: '单价必须大于零（0）！'
};
function check_sup(){
	  if($('#supplier_name').attr('value') == ''){
	  	  alert(errmsg[6]);
	  	  return false;
	  }
	  if($('#storage_from_code').attr('value') == ''){
	  	  alert(errmsg[9]);
	  	  return false;
	  }
	  return true;
}
function check_form() {
	  if (!check_sup()) {
        return false;
    }
    if (!check_arrival_time()) {
        return false;
    }
    if (!checkspace() ) {
        return false;
    }
    return true;
}
function check_arrival_time(){
	 if(trim($('#storage_arrival_time').attr('value')) != ''){
	 	   if(!/^\d+$/.test(trim($('#storage_arrival_time').attr('value')))){
	  	 	   alert(errmsg[7]);
	  	     return false;
	  	 }
	  	 if($('#storage_arrival_time').attr('value') <= 0){
	  	 	   alert(errmsg[8]);
	  	     return false;
	  	 }
	 }
	 return true;
}
function check_p_in(){
	  var p_bool = false;
	  var p_in_count = 0;
	  for (i= 1;i <= rows_count;i++){
	  	  if($('#p_id_' + i).attr('value') != ''){
	  	 	   p_bool = true;
	  	 	   p_in_count += 1;
	  	  }
	  }
	  $('#pd_count').attr('value',p_in_count);
	  return p_bool;
}
function checkspace() {
	  if(!check_p_in()){
	  	  alert(errmsg[0]);
	  	  return false;
	  }
	  var all_in_count = 0;
	  for (i= 1;i <= rows_count;i++){
	  	  if($('#p_id_' + i).attr('value') != ''){
	  	  	  if(trim($('#p_brand_' + i).attr('value')) == ''){
	  	 	    	 alert(errmsg[13]);
	  	         return false;
	  	 	    }
	  	 	    //实收数量
	  	 	    if(trim($('#s_in_count_' + i).attr('value')) == ''){
	  	 	   	   //alert(errmsg[1]);
	  	         //return false;
	  	         $('#s_in_count_' + i).attr('value',0);
	  	 	    }
	  	 	    if($('#s_in_count_' + i).attr('value') < 0){
	  	 	   	   //alert(errmsg[3]);
	  	 	   	   $('#s_in_count_' + i).attr('value',0);
	  	         //return false;
	  	 	    }
	  	 	    if(!/^\d+$/.test(trim($('#s_in_count_' + i).attr('value')))){
	  	 	   	   alert(errmsg[2]);
	  	         return false;
	  	 	    }
	  	 	    
	  	 	    all_in_count += parseInt($('#s_in_count_' + i).attr('value'));
	  	 	    //单价
	  	 	    if($('#order_m_id_' + i).attr('value') != ''){
	  	 	    	  if(trim($('#p_price_' + i).attr('value')) == ''){
	  	 	    	  	  if($('#s_in_count_' + i).attr('value') != 0){
	  	 	    	        alert(errmsg[10]);
	  	                return false;
	  	              }
	  	 	        }
	  	 	        if(isNaN(trim($('#p_price_' + i).attr('value')))){
	  	 	    	 	    alert(errmsg[4]);
	  	              return false;
	  	 	        }
	  	 	        if($('#p_price_' + i).attr('value') < 0){
	  	 	   	        $('#p_price_' + i).attr('value',0);
	  	              return false;
	  	 	        }
	  	 	        if($('#p_price_' + i).attr('value') == 0){
	  	 	        	 if($('#s_in_count_' + i).attr('value') != 0){
	  	 	   	        alert(errmsg[5]);
	  	              return false;
	  	             }
	  	 	        }
	  	 	    }else{
	  	 	    	  if(trim($('#p_price_' + i).attr('value')) != ''){
	  	 	    	  	  if(isNaN(trim($('#p_price_' + i).attr('value')))){
	  	 	    	 	      alert(errmsg[4]);
	  	                return false;
	  	 	            }
	  	 	    	  	  if($('#p_price_' + i).attr('value') < 0){
	  	 	   	            alert(errmsg[14]);
	  	                  return false;
	  	 	            }
	  	 	        }
	  	 	    	  
	  	 	    }
	  	  }
	  }
	  
	  if(all_in_count == 0){
	  	  alert(errmsg[3]);
	  	  return false;
	  }
	  if(trim($('#storage_manager').attr('value')) == ''){
	  	 	alert(errmsg[11]);
	  	  return false;
	  }
	  if(trim($('#storage_consignee').attr('value')) == ''){
	  	 	alert(errmsg[12]);
	  	  return false;
	  }
    return true;
}
function change_from_code(){
	  $('#ordlist').empty();
	  if($('#storage_from_code').attr('value') != ''){
	  	  $.ajax({
        type: 'GET',
        url: './?act=storage_to_add',
        dateType: 'json',
        data: {storage_from_code:$('#storage_from_code').attr('value')},
        async: false,
        cache: false,
        success: function(msg) {
            var returnmsg = msg.split("*****");
            $('#supplier_name').attr('value',returnmsg[0]);
            $('#supplier_code').attr('value',returnmsg[1]);
            $('#storage_pay_status').empty();
            $('#storage_pay_status').append(returnmsg[2]);
            $('#storage_use').attr('value',returnmsg[3]);
            //alert(returnmsg[4]);
            $('#pd_count').attr('value',returnmsg[4]);
            //alert(returnmsg[5]);
            $('#p_list_count').attr('value',returnmsg[5]);
            //$('#pay_status_val').attr('value',returnmsg[6]);
            //alert(returnmsg[7]);
            $('#storage_reference').attr('value',returnmsg[7]);
            $('#ordlist').append(returnmsg[8]);
            rows_count = parseInt($('#p_list_count').attr('value'));
            for (j= 1;j <= rows_count;j++){
	  	          $('#p_code_name_' + j).autocomplete(jsondata, option_p).result(function(event, row, formatted) {
    	  	         var tmp_i = this.id.split("_");
        	         $('#p_id_' + tmp_i[3]).attr('value',row.id);
        	         $('#p_model_' + tmp_i[3]).attr('value',row.model);
        	         $('#p_unit_' + tmp_i[3]).attr('value',row.unit);
        	         //$('#clear_row_' + tmp_i[3]).attr('disabled',false);
        	         $('#p_code_name_' + tmp_i[3]).attr('readonly',true);
        	         check_add_row();
                });
                $('#clear_row_' + j).bind('click', function() { clear_row(this); });
	          }
            
        }
        });
	  }
    
}

//去左右空格
function trim(str) {
    return str.replace(/\s+$|^\s+/g, '');
}
function strlen(str) {
    var strlength = 0;
    strlength = str.replace(/[^\x00-\xff]/g, "**").length;
    return strlength;
}