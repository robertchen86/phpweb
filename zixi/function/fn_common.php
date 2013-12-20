<?php
// p 的 内容是 选择题
function isOption($p_string){
	  if(!mb_strpos($p_string, '>选择题<'))return false;
	  return true;
}
// p 的 内容是 我是分割线
function isDividingLine($p_string){
	  if(!mb_strpos($p_string, '>我是分割线<'))return false;
	  return true;
}
// p 的 内容是 答案
function isAnswer($p_string){
	  if(!mb_strpos($p_string, '>答案<'))return false;
	  return true;
}
// p 的 内容是 <o:p>&nbsp;</o:p>
function isSpace($p_string){
	  $p_string =strip_tags($p_string,'');
	  if($p_string != '&nbsp;')return false;
	  //if(!mb_strpos($p_string, '><span lang=EN-US>&nbsp;</span><'))return false;
	  return true;
}

function isRightAnswer($p_string){
	   $p_string = trim($p_string);
	   if(mb_strpos($p_string, '>'))return false;
	   if(mb_strpos($p_string, '<'))return false;
	   if(mb_strpos($p_string, 'lang'))return false;
	   if(mb_strpos($p_string, 'style'))return false;
	   if(mb_strpos($p_string, ':'))return false;
	   if(mb_strpos($p_string, '"'))return false;
	   return true;
}

//Answer
//截取
function cut( $from, $start, $end, $lt = false, $gt = false ){
	  $str = explode($start,$from );
	  if (isset($str[1]) && $str[1] != '' ){
		    $str = explode( $end, $str[1]);
		    $strs = $str[0];
	  }else{
		    $strs = '';
	  }
	  if ($lt){
		    $strs = $start.$strs;
	  }
	  if ( $gt ){
		    $strs .= $end;
	  }
	  return $strs;
}
function get_lib($kng_id){
	  $sql = ' select  i.kng_id,i.kng_title,i.kng_description, count(j.kng_id) as kng_count  from zx_knowledge i ';
    $sql.= ' left join zx_knowledge j on i.kng_id = j.kng_foot_id ';
    $sql.= ' where i.kng_foot_id = '.$kng_id;
    $sql.= ' group by i.kng_id ';	
    $sql.= ' order by i.kng_sort <> 0 desc,i.kng_sort asc ';
    $kng_result = get_info_by_sql($sql);
    foreach ($kng_result as $kng_key => $kng_value){
    	  $kng_result[$kng_key]['knglist']=get_kngidstr($kng_value['kng_id']);
    	  if($kng_value['kng_count'] == 0){
    	  	  $sql = ' select video_id,video_title  from zx_video ';
            $sql.= ' where video_kng_id = '.$kng_value['kng_id'];
            $sql.= ' and video_isdel = 0 ';
            $sql.= ' and video_td_state = 1 ';	
            $sql.= ' order by video_sort<> 0 desc,video_sort asc ';
            $v_result = get_info_by_sql($sql);
            $kng_result[$kng_key]['vlist'] = $v_result;
            $sql = ' select count(video_id) as cnt  from zx_video ';
            $sql.= ' where video_kng_id = '.$kng_value['kng_id'];
            $sql.= ' and video_isdel = 0 ';
            $sql.= ' and video_td_state = 1 ';	
            $sql.= ' order by video_sort<> 0 desc,video_sort asc ';
            $v1_result = get_info_by_sql($sql);
            $kng_result[$kng_key]['vcount'] = (int)(($v1_result[0]['cnt']+2)/3);
    	  	  continue;
    	  }
    	  $kng_result[$kng_key]['kng_items'] = get_lib($kng_value['kng_id']);
    }
    return $kng_result;
}




function catch_playtimes($app_key,$itemCodes,$ceiling = 10){
	  $curlPost = 'appKey='.$app_key.'&format=json&itemCodes='.$itemCodes.'&ceiling='.$ceiling;
	  $catch_url = 'http://api.tudou.com/v3/gw?method=item.playtimes.get';
	  $result = get_jsonData_by_url($catch_url,$curlPost);
	  $obj = array();
    $obj = object2array(json_decode($result));
	  if(!$obj['multiResult']){
    	  $err = $obj['desc'];
    	  if($obj['code'] == '4036') $err .= ',请确认应用Key是否可用！';
    	  if($obj['code'] == '4032') $err .= ',请确认土豆帐户是否正确！';
    	  if($err == '')$err ='请确认应用Key、土豆帐户等是否正确！';
    	  echo "<script>alert('".$err."');</script>";
        die();
    }
    $obj = object2array($obj['multiResult']);
    $obj = object2array($obj['results']);
    $obj = object2array($obj[0]);
    //$obj = object2array($obj['results']);
    //{"multiResult":{"results":[{"playtimes":234362,"itemCode":"yg8CVootoAc"}]}}
    $obj = $obj['playtimes'];
	  return $obj;
}
function catch_playtimes2($app_key,$itemCodes){
	  $curlPost = 'appKey='.$app_key.'&format=json&itemCodes='.$itemCodes.'&ceiling=100';
	  $catch_url = 'http://api.tudou.com/v3/gw?method=item.playtimes.get';
	  $result = get_jsonData_by_url($catch_url,$curlPost);
	  $obj = array();
    $obj = object2array(json_decode($result));
	  if(!$obj['multiResult']){
    	  $err = $obj['desc'];
    	  if($obj['code'] == '4036') $err .= ',请确认应用Key是否可用！';
    	  if($obj['code'] == '4032') $err .= ',请确认土豆帐户是否正确！';
    	  if($err == '')$err ='请确认应用Key、土豆帐户等是否正确！';
    	  echo "<script>alert('".$err."');</script>";
        die();
    }
    $obj = object2array($obj['multiResult']);
    $obj = object2array($obj['results']);
    //$obj = object2array($obj[0]);
    //$obj = object2array($obj['results']);
    //{"multiResult":{"results":[{"playtimes":234362,"itemCode":"yg8CVootoAc"}]}}
    //$obj = $obj['playtimes'];
	  return $obj;
}
function catch_comments($app_key,$itemCode,$page_no){
	  $curlPost = 'appKey='.$app_key.'&format=json&itemCode='.$itemCode.'&pageNo='.$page_no.'&pageSize=10';
	  //$catch_url = 'http://api.tudou.com/v3/gw?method=item.comment.get&appKey=myKey&format=json&itemCode=yg8CVootoAc&pageNo='.$page_no.'&pageSize=10';
	  $catch_url = 'http://api.tudou.com/v3/gw?method=item.comment.get';
	  $result = get_jsonData_by_url($catch_url,$curlPost);
	  $obj = array();
    $obj = object2array(json_decode($result));
	  if(!$obj['multiPageResult']){
    	  $err = $obj['desc'];
    	  if($obj['code'] == '4036') $err .= ',请确认应用Key是否可用！';
    	  if($obj['code'] == '4032') $err .= ',请确认土豆帐户是否正确！';
    	  if($err == '')$err ='请确认应用Key、土豆帐户等是否正确！';
    	  echo "<script>alert('".$err."');</script>";
        die();
    }
    $obj = object2array($obj['multiPageResult']);
	  
	  return $obj;
}
function catch_videos($app_key,$account_name,$page_no){
	  $curlPost = 'appKey='.$app_key.'&format=json&user='.$account_name.'&pageNo='.$page_no.'&pageSize=100';
    $catch_url = 'http://api.tudou.com/v3/gw?method=user.item.get';
	  $resultthree = get_jsonData_by_url($catch_url,$curlPost);
	  $obj = array();
    $obj = object2array(json_decode($resultthree));
	  if(!$obj['multiPageResult']){
    	  $err = $obj['desc'];
    	  if($obj['code'] == '4036') $err .= ',请确认应用Key是否可用！';
    	  if($obj['code'] == '4032') $err .= ',请确认土豆帐户是否正确！';
    	  if($err == '')$err ='请确认应用Key、土豆帐户等是否正确！';
    	  echo "<script>alert('".$err."');</script>";
        echo "<meta http-equiv=refresh content='0; url=./?a=tdvideo_to_get'>";
        die();
    }
    $obj = object2array($obj['multiPageResult']);
    $objpage = object2array($obj['page']);
    $obj = object2array($obj['results']);
	  $tmp_sql = '';
	  //tag
	  $kng_array = get_kng_array();
	  //print_R($kng_array);
	  //die();
    foreach ($obj as $key => $value){
    	  $tmpvalue = object2array($value);
    	  /*$tmp_sql.=",('".$tmpvalue['itemCode']."','".$tmpvalue['title']."','".$tmpvalue['tags']."','".$tmpvalue['description']."',".$tmpvalue['channelId'].",
    	  '".$tmpvalue['outerPlayerUrl']."','".$tmpvalue['picUrl']."','".$tmpvalue['pubDate']."','".date('Y-m-d H:i:s')."',1,'".changeStringTo($tmpvalue['picUrl'])."','".$tmpvalue['itemId']."')";
        */
        $tag_id = '';
        $tag_id = get_kng_id_from_array($kng_array,$tmpvalue['tags']);
        $tmp_sql.=",('".$tmpvalue['itemCode']."','".$tmpvalue['title']."','".$tmpvalue['tags']."','".$tmpvalue['description']."',".$tmpvalue['channelId'].",
    	  '".$tmpvalue['picUrl']."','".$tmpvalue['pubDate']."','".date('Y-m-d H:i:s')."',1,'".changeStringTo($tmpvalue['picUrl'])."','".$tmpvalue['itemId']."' ";
       
        if($tag_id != ''){
        	  $tmp_sql.=",".$tag_id; 
        }else{
        	  $tmp_sql.=",0"; 
        }
        $tmp_sql.=" )";
    }
    if($objpage['pageCount'] > $page_no)
       $tmp_sql .= catch_videos($app_key,$account_name,($page_no+1));
    return $tmp_sql;
}
function get_kng_id_from_array($array,$tags){
	  $return_string = '';
	  $tags_arry = explode(',', $tags);
	  foreach ($tags_arry as $key => $value){
	  	  if($value == '')
	  	     continue;
	  	  $return_string =  $array[$value];
	  	  if($return_string != '')
	  	     break;
	  }
	  return $return_string;
}
function get_kng_array(){
	  $retrun_array = array();
	  $sql = ' select kng_id,kng_title,kng_grade  from zx_knowledge ';
    $sql.= ' where kng_grade =  2 ';
    $sql.= ' order by kng_id desc';
	  $result = get_info_by_sql($sql);
	  foreach ($result as $key => $value){
	  	  $retrun_array[$value['kng_title']]=$value['kng_id'];
	  }
	  return $retrun_array;
}

function alert($msg) {
	echo $msg;
	exit;
}
function get_info_by_sql($sql) {
	  $admin = spClass('zx_admin');
	  $result = $admin->findSql($sql);
	  return $result;	
}
function changeString1To($str){
	  //$str = substr($str,7);
	  $str = str_replace('@','%40',$str);
	  $str = str_replace('&','%26',$str);
	  return $str;
}
function changeToString1($str){
	  $str = str_replace('%40','@',$str);
	  $str = str_replace('%26','&',$str);
	  return $str;
}
function isEmail($emial){
	  $preg = preg_match("/\w+([-+.']\w+)*@\w+\.\w+([-.]\w+)*/",$emial);
		if($preg)return true;
		return false;	
}


function up_info_by_sql($sql){
	  $admin = spClass('zx_admin');
	  $result = $admin->runSql($sql);
	  return $result;	

}
function del_log_by_sql($sql){
	  $admin = spClass('zx_video_log');
	  $result = $admin->runSql($sql);
	  return $result;	

}

function get_jsonData_by_url($url,$curlPost){
	  $return = '';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);//设置HTTP头
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);//POST数据
    $return = curl_exec($ch);
    curl_close($ch);
    return $return;	
}
/** 验证用户是否存在函数 */
function check_admin_exist($username){
    $admin = spClass('zx_admin');
    $condition = array('admin_name' => $username);
    $result = 0;
    $result = $admin->findCount($condition);
    if(0 == $result){
        return false;
    }else{
        return true;
    }
}
function get_admin_name_exist_count($username){
    $admin = spClass('zx_admin');
    $condition = array('admin_name' => $username);
    $result = 0;
    $result = $admin->findCount($condition);
    return $result;
}
/** 验证用户密码是否正确函数 */
function check_admin_pass($username,$password){
    $admin = spClass('zx_admin');
    $condition = array('admin_name'=> $username,'admin_password'=> $password);
    $result = 0;
    $result = $admin->findCount($condition);
    if(0 == $result){
        return false;
    }else{
        return true;
    }
}
function add_admin($inrow) {
		$admin = spClass('zx_admin');
		$result = $admin->create($inrow);
		return $result;
}	
function get_all_admin() {
		$sql = 'select admin_id,admin_name,admin_type,admin_addtime,admin_uptime from zx_admin';
		$sql .= ' where admin_id <> 1 ';
		$result = get_info_by_sql($sql);
		return $result;
}

/**
 * 删除用户函数
 */
function del_admin_by_id($id){
    $admin = spClass('zx_admin');
    $condition = array('admin_id'=> $id);
    $result = $admin->delete($condition);
    return $result; 
}
function get_admin_by_name($name){
    $admin = spClass('zx_admin');
    $condition = array('admin_name'=> $name);
    $result = $admin->findAll($condition);
    return $result; 
}
function get_admin_by_id($id){
    $admin = spClass('zx_admin');
    $condition = array('admin_id'=> $id);
    $result = $admin->findAll($condition);
    return $result; 
}
function update_admin($id,$uprow) {
    $admin = spClass('zx_admin');
    $condition = array('admin_id'=> $id);
    $result = $admin->update($condition,$uprow);
    return $result;		
}

function add_account($inrow) {
		$admin = spClass('zx_account');
		$result = $admin->create($inrow);
		return $result;
}	
function update_account($id,$uprow) {
    $admin = spClass('zx_account');
    $condition = array('account_id'=> $id);
    $result = $admin->update($condition,$uprow);
    return $result;		
}
function get_account_by_type($type){
    $admin = spClass('zx_account');
    $condition = array('account_type'=> $type);
    $result = $admin->findAll($condition);
    return $result; 
}

function object2array($object) {
    if (is_object($object)) {
         foreach ($object as $key => $value) {
             $array[$key] = $value;
         }
    }
    else {
         $array = $object;
    }
    return $array;
}
function get_web(){
    $admin = spClass('zx_web');
    $result = $admin->findAll();
    return $result; 
}
function get_kng_list3($kng_root_id,$root_id='',$fu = ''){
	  $return_string = '';
	  $cur_root_id = $kng_root_id;
	  $sql = ' select kng_id,kng_grade,kng_title from zx_knowledge ';
    $sql.= ' where kng_foot_id = '.$cur_root_id;
    $sql.= ' and kng_grade < 4';
	  $result = get_info_by_sql($sql);
	  foreach ($result as $key => $value){
	  	  $return_string.= '<option value="'.$value['kng_id'].'" ';
	  	  if($root_id == $value['kng_id'])
	  	      $return_string.= ' selected ';
	  	  $return_string.= '>'.$fu.''.$value['kng_title'].'</option>';
	  	  $return_string.= get_kng_list3($value['kng_id'],$root_id,$fu.'┗');
	  }
	  return $return_string;
}
function get_kng_list($kng_root_id,$root_id='',$kng_g=2,$fu = '',$kng_id=''){
	  $return_string = '';
	  $cur_root_id = $kng_root_id;
	  $sql = ' select kng_id,kng_grade,kng_title from zx_knowledge ';
    $sql.= ' where kng_foot_id = '.$cur_root_id;
    if($kng_g == 1){
       $sql.= ' and kng_grade <= '.$kng_g;
    }else{
    	 $sql.= ' and kng_grade < '.$kng_g;
  	}
	  $result = get_info_by_sql($sql);
	  foreach ($result as $key => $value){
	  	  if($value['kng_id'] == $kng_id)
	  	      continue;
	  	  $return_string.= '<option value="'.$value['kng_id'].'_'.$value['kng_grade'].'" ';
	  	  if($root_id == $value['kng_id'])
	  	      $return_string.= ' selected ';
	  	  $return_string.= '>'.$fu.''.$value['kng_title'].'</option>';
	  	  $return_string.= get_kng_list($value['kng_id'],$root_id,$kng_g,$fu.'┗');
	  }
	  return $return_string;
}
function get_kng_list2($kng_root_id,$kng_id='',$fu = ''){
	  $return_string = '';
	  $cur_root_id = $kng_root_id;
	  $sql = ' select  kng_id,kng_title,kng_grade  from zx_knowledge ';
    $sql.= ' where kng_foot_id = '.$cur_root_id;
    $sql.= ' and kng_grade < 3 ';
    $sql.= ' order by kng_sort <> 0 desc,kng_sort asc ';
	  $result = get_info_by_sql($sql);
	  foreach ($result as $key => $value){
	  	  if($value['kng_grade'] == 1){
	  	  	  $return_string.= '<optgroup label="'.$fu.$value['kng_title'].'">';
	  	  }else{
	  	  	  $return_string.= '<option value="'.$value['kng_id'].'" ';
	  	  	  if($kng_id == $value['kng_id'])
	  	             $return_string.= ' selected ';
	  	      $return_string.= '>'.$fu.''.$value['kng_title'].'</option>';
	  	  }
	  	  if($value['kng_grade'] == 1){
	  	      $return_string.= get_kng_list2($value['kng_id'],$kng_id,$fu.'┗');
	  	      $return_string.= '</optgroup>';
	  	  }
	  }
	  
	  return $return_string;
}


function add_kng($inrow) {
		$admin = spClass('zx_knowledge');
		$result = $admin->create($inrow);
		return $result;
}

function add_school($inrow) {
	$admin = spClass('zx_school');
	$result = $admin->create($inrow);
	return $result;
}
function add_student($inrow) {
	$admin = spClass('zx_student');
	$result = $admin->create($inrow);
	return $result;
}

function update_kng($id,$uprow) {
    $admin = spClass('zx_knowledge');
    $condition = array('kng_id'=> $id);
    $result = $admin->update($condition,$uprow);
    return $result;		
}

function update_school($id,$uprow) {
	$admin = spClass('zx_school');
	$condition = array('school_id'=> $id);
	$result = $admin->update($condition,$uprow);
	return $result;
}

function update_student($id,$uprow) {
	$admin = spClass('zx_student');
	$condition = array('student_id'=> $id);
	$result = $admin->update($condition,$uprow);
	return $result;
}

function del_kng_by_id($id){
    $admin = spClass('zx_knowledge');
    $condition = array('kng_id'=> $id);
    $result = $admin->delete($condition);
    return $result; 
}
function del_school_by_id($id){
	$admin = spClass('zx_school');
	$condition = array('school_id'=> $id);
	$result = $admin->delete($condition);
	return $result;
}
function del_student_by_id($id){
	$admin = spClass('zx_student');
	$condition = array('student_id'=> $id);
	$result = $admin->delete($condition);
	return $result;
}

function get_kng_by_id($id){
    $admin = spClass('zx_knowledge');
    $condition = array('kng_id'=> $id);
    $result = $admin->findAll($condition);
    return $result; 
}
function get_school_by_id($id){
	$admin = spClass('zx_school');
	$condition = array('school_id'=> $id);
	$result = $admin->findAll($condition);
	return $result;
}
function get_student_by_id($id){
	$admin = spClass('zx_student');
	$condition = array('student_id'=> $id);
	$result = $admin->findAll($condition);
	return $result;
}

function add_video($inrow) {
		$admin = spClass('zx_video');
		$result = $admin->create($inrow);
		return $result;
}	
function update_video_by_code($code,$uprow) {
    $admin = spClass('zx_video');
    $condition = array('video_itemCode'=> $code);
    $result = $admin->update($condition,$uprow);
    return $result;		
}
function update_video($id,$uprow) {
    $admin = spClass('zx_video');
    $condition = array('video_id'=> $id);
    $result = $admin->update($condition,$uprow);
    return $result;		
}

function get_video_by_id($id){
    $admin = spClass('zx_video');
    $condition = array('video_id'=> $id);
    $result = $admin->findAll($condition);
    return $result; 
}

function del_video_by_id($id){
    $admin = spClass('zx_video');
    $condition = array('video_id'=> $id);
    $result = $admin->delete($condition);
    return $result; 
}
function get_video_list2($kng_id=0,$video_id=''){
	  $return_string = '';
	  $sql = ' select video_id,video_title from zx_video ';
    $sql.= ' where video_isdel = 0 ';
    $sql.= ' and video_kng_id='.$kng_id;
	  $result = get_info_by_sql($sql);
	  foreach ($result as $key => $value){
	  	  $return_string.= '<option value="'.$value['video_id'].'" ';
	  	  if($video_id == $value['video_id'])
	  	      $return_string.= ' selected ';
	  	  $return_string.= '>'.$value['video_title'].'</option>';
	  	 
	  }
	  return $return_string;
}
function get_kng_id_by_video_id($video_id){
	  $video_kng_id = '';
	  $sql = ' select video_kng_id from zx_video ';
    $sql.= ' where video_id ='.$video_id;
	  $result = get_info_by_sql($sql);
	  $video_kng_id = $result[0]['video_kng_id'];
	  
	  return $video_kng_id;
}
function get_video_list($video_id=''){
	  $return_string = '';
	  $sql = ' select video_id,video_title from zx_video ';
    $sql.= ' where video_isdel = 0 ';
	  $result = get_info_by_sql($sql);
	  foreach ($result as $key => $value){
	  	  $return_string.= '<option value="'.$value['video_id'].'" ';
	  	  if($video_id == $value['video_id'])
	  	      $return_string.= ' selected ';
	  	  $return_string.= '>'.$value['video_title'].'</option>';
	  	 
	  }
	  return $return_string;
}
function get_member_list($member_id=''){
	  $return_string = '';
	  $sql = ' select member_id,member_name from zx_member ';
    $sql.= ' where member_status = 1 ';
	  $result = get_info_by_sql($sql);
	  foreach ($result as $key => $value){
	  	  $return_string.= '<option value="'.$value['member_id'].'" ';
	  	  if($member_id == $value['member_id'])
	  	      $return_string.= ' selected ';
	  	  $return_string.= '>'.$value['member_name'].'</option>';
	  	 
	  }
	  return $return_string;
}

function del_vcomment_by_id($id){
    $admin = spClass('zx_video_comment');
    $condition = array('vcomment_id'=> $id);
    $result = $admin->delete($condition);
    return $result; 
}
function update_vcomment_by_id($id,$uprow) {
    $admin = spClass('zx_video_comment');
    $condition = array('vcomment_id'=> $id);
    $result = $admin->update($condition,$uprow);
    return $result;		
}
function add_vcomment($inrow) {
		$admin = spClass('zx_video_comment');
		$result = $admin->create($inrow);
		return $result;
}

function del_member_by_id($id){
    $admin = spClass('zx_member');
    $condition = array('member_id'=> $id);
    $result = $admin->delete($condition);
    return $result; 
}

function get_member_by_id($id){
    $admin = spClass('zx_member');
    $condition = array('member_id'=> $id);
    $result = $admin->findAll($condition);
    return $result; 
}

function del_vlog_by_id($id){
    $admin = spClass('zx_video_log');
    $condition = array('vlog_id'=> $id);
    $result = $admin->delete($condition);
    return $result; 
}
function add_vlog($inrow) {
		$admin = spClass('zx_video_log');
		$result = $admin->create($inrow);
		return $result;
}
function update_member_by_id($id,$update){
    $admin = spClass('zx_member');
    $condition = array('member_id'=> $id);
    $result = $admin->update($condition,$update);
    return $result; 
}
function update_member_by_email($email,$update){
    $admin = spClass('zx_member');
    $condition = array('member_email'=> $email);
    $result = $admin->update($condition,$update);
    return $result; 
}
function update_vlog_by_id($id,$uprow) {
    $admin = spClass('zx_video_log');
    $condition = array('vlog_id'=> $id);
    $result = $admin->update($condition,$uprow);
    return $result;		
}
function get_remd_video() {
		$sql = 'select video_id,video_title,video_description,video_picurl,video_kng_id,video_lc_picurl from zx_video ';
		$sql .= ' where video_isdel = 0 and video_isrecommend = 1  ';
		//$sql.= ' order by a.member_addtime desc ';
    $sql.= ' limit 0,5';
		$result = get_info_by_sql($sql);
		foreach ($result as $key => $value){
			  $result[$key]['knglist']=get_kngidstr($value['video_kng_id']);
		}
		return $result;
}
function get_kngidstr($kng_id){
	  
	  $re_string = '';
	  if($kng_id){
	  $sql = ' select kng_id,kng_grade,kng_foot_id from zx_knowledge ';
		$sql .= ' where kng_id = '.$kng_id;
		$result = get_info_by_sql($sql);
		$kng_grade = $result[0]['kng_grade'];
		$kng_foot_id = $result[0]['kng_foot_id'];
		if($kng_grade < 4)
		    $re_string = '/'.$kng_id;
		if($kng_grade != 1) 
		    $re_string = get_kngidstr($kng_foot_id).$re_string;
		}
		return $re_string;
}
function get_kngidstr2($kng_id,$web_site){
	  $re_string = '';
	  if($kng_id){
	  $sql = ' select kng_id,kng_title,kng_grade,kng_foot_id from zx_knowledge ';
		$sql .= ' where kng_id = '.$kng_id;
		$result = get_info_by_sql($sql);
		$kng_grade = $result[0]['kng_grade'];
		$kng_foot_id = $result[0]['kng_foot_id'];
		if($kng_grade == 1){
			  $re_string = '<span class="breadcrumb">'.$result[0]['kng_title'].'</span>';
		}else{
			  $re_string = '<a class="breadcrumb" href="'.$web_site.'/kng'.get_kngidstr($kng_id).'">'.$result[0]['kng_title'].'</a>';
		}
		if($kng_grade != 1) 
		    $re_string = get_kngidstr2($kng_foot_id,$web_site).'&raquo;'.$re_string;
		}
		return $re_string;
}

function changeStringTo($str){
	  $str = substr($str,7);
	  $str = str_replace('.t','-t',$str);
	  $str = str_replace('.c','-c',$str);
	  $str = str_replace('/','_',$str);
	  return $str;
}
function getImage($url,$filename='',$type=0){
	if($url==''){return false;}
	if($filename==''){
        $ext=strrchr($url,'.');
        if($ext!='.gif' && $ext!='.jpg'){return false;}
        $filename=time().$ext;
    }
    //文件保存路径
    if($type){
        $ch=curl_init();
        $timeout=5;
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
        $img=curl_exec($ch);
        curl_close($ch);
    }else{
        ob_start();
        readfile($url);
        $img=ob_get_contents();
        ob_end_clean();
    }
    $size=strlen($img);
    //文件大小
    $fp2=@fopen($filename,'a');
    fwrite($fp2,$img);
    fclose($fp2);
    //return $filename;
}
function get_kng_title_by_id($kngid){
	  $sql = 'select kng_id,kng_title from zx_knowledge ';
    $sql.= ' where kng_id = '.$kngid;
    $result = get_info_by_sql($sql);
    $kng_title = $result[0]['kng_title'];
    return $kng_title;
}

function get_kngson_count_by_id($id){
    $admin = spClass('zx_knowledge');
		$condition = array('kng_foot_id'=> $id);
		$result = 0;
		$result = $admin->findCount($condition);
		return $result;	
}

function get_sendemail(){
    $admin = spClass('zx_sendemail');
    $result = $admin->findAll();
    return $result; 
}

function add_member($inrow) {
		$admin = spClass('zx_member');
		$result = $admin->create($inrow);
		return $result;
}
function get_member_by_code($code){
    $admin = spClass('zx_member');
		$condition = array('member_md5code'=> $code);
		$result = $admin->findAll($condition);
		return $result;	
}	
function update_member_by_code($code,$uprow){
    $admin = spClass('zx_member');
		$condition = array('member_md5code'=> $code);
		$result = $admin->update($condition,$uprow);
		return $result;	
}	
function update_web($id,$uprow) {
    $admin = spClass('zx_web');
    $condition = array('web_id'=> $id);
    $result = $admin->update($condition,$uprow);
    return $result;		
}
function add_web($inrow) {
		$admin = spClass('zx_web');
		$result = $admin->create($inrow);
		return $result;
}
function update_sendemail($id,$uprow) {
    $admin = spClass('zx_sendemail');
    $condition = array('sendemail_id'=> $id);
    $result = $admin->update($condition,$uprow);
    return $result;		
}
function add_sendemail($inrow) {
		$admin = spClass('zx_sendemail');
		$result = $admin->create($inrow);
		return $result;
}
function get_itemes_ptimes($result,$app_key,$start = 0){
	  //echo $start;
	  $iplaytimes = array();
	  $itemCodes = '';
	  foreach ($result as $key => $value){
	  	  if($key < $start)
	  	      continue;
	  	  if($key >= ($start + 99)) 
	  	      break; 
	  	  $itemCodes.=','.$value['video_itemCode'];
	  }
	  //echo $itemCodes;
	  $pltimes = catch_playtimes2($app_key,$itemCodes);
	  $iplaytimes = array();
	  foreach ($pltimes as $ikey => $ivalue){
	  	  $tmpvalue = object2array($ivalue);
	  	  $iplaytimes[$tmpvalue['itemCode']] = $tmpvalue['playtimes'];
	  }
	   
	  if(count($result) > $start + 100)
	      $iplaytimes = spConfigReady2($iplaytimes,get_itemes_ptimes($result,$app_key,($start + 99)));
	  return $iplaytimes;
}
function spConfigReady2( $preconfig, $useconfig = null){
	$nowconfig = $preconfig;
	if (is_array($useconfig)){
		foreach ($useconfig as $key => $val){
			if (is_array($useconfig[$key])){
				@$nowconfig[$key] = is_array($nowconfig[$key]) ? spConfigReady($nowconfig[$key], $useconfig[$key]) : $useconfig[$key];
			}else{
				@$nowconfig[$key] = $val;
			}
		}
	}
	return $nowconfig;
}
/*function coye_array_ptimes($array1,$array2){
	  $newarray = array();
	  $newarray = $array1;
	  foreach ($array2 as $key => $value){
	  	 $newarray[$key] = $value[$key];
	  }
	  return $newarray;
}*/
function get_csv_content($result,$type){
	  $return_string = '';
	  if($type=='zx_knowledge'){
	  	  $return_string .="kng_id,kng_title,kng_description,kng_foot_id,kng_sort,kng_addtime,kng_uptime,kng_isrecommend \n ";
	      //$return_string .="kng_id,kng_title,kng_description,kng_foot_id,kng_sort,kng_addtime,kng_uptime,kng_isrecommend \n "; 
	      foreach ($result as $key => $value){
	  	      $return_string .= iconv('UTF-8','GB2312',$value['kng_id'].",".$value['kng_title'].",".$value['kng_foot_id'].",".$value['kng_sort'].",".$value['kng_addtime'].",".$value['kng_uptime'].",".$value['kng_isrecommend']."\n");
	      }
	  }
	  if($type=='zx_video'){
	  	  $itemCodes = '';
	  	  $result1 = get_account_by_type(1);
        $app_key = $result1[0]['account_app_key'];
        $iplaytimes = array();
        $iplaytimes = get_itemes_ptimes($result,$app_key);
       
	      $return_string .="video_id,video_title,video_itemCode,video_playtimes,video_tags,video_description,video_sort,video_pubDate,video_isrecommend,video_td_state,video_isdel \n"; 
	      foreach ($result as $key => $value){
	  	      $return_string .= iconv('UTF-8','GB2312',$value['video_id'].",".str_replace(',','-',$value['video_title']).",".$value['video_itemCode'].",".$iplaytimes[$value['video_itemCode']].",".str_replace(',',' ',$value['video_tags']).",".str_replace(',',' ',$value['video_description']).",".$value['video_sort'].",".$value['video_pubDate'].",".$value['video_isrecommend'].",".$value['$video_td_state'].",".$value['video_isdel'] ."\n");
	      }
	      
	  }
	  if($type=='zx_member'){
	      $return_string .="member_id,member_email,member_name,member_city_id,member_sex,member_birthday,member_school,member_addtime,member_uptime,member_logintime,member_times \n"; 
	      foreach ($result as $key => $value){
	  	      $return_string .= iconv('UTF-8','GB2312',$value['member_id'].",".$value['member_email'].",".$value['member_name'].","
	  	      .$value['member_city_id'].",".$value['member_sex'].",".$value['member_birthday'].",".$value['member_school'].",".$value['member_addtime']
	  	      .",".$value['$member_uptime'].",".$value['member_logintime'].",".$value['member_times'] ."\n");
	      }
	  }
	  if($type=='zx_video_log'){
	      $return_string .="vlog_id,vlog_member_id,vlog_video_id,vlog_st_time,vlog_end_time,vlog_addtime \n"; 
	      foreach ($result as $key => $value){
	  	      $return_string .= iconv('UTF-8','GB2312',$value['vlog_id'].",".$value['vlog_member_id'].",".$value['vlog_video_id'].","
	  	      .$value['vlog_st_time'].",".$value['vlog_end_time'].",".$value['vlog_addtime'] ."\n");
	      }
	  }
	  if($type=='zx_video_comment'){
	      $return_string .="vcomment_id,vcomment_member_id,vcomment_video_id,vcomment_content,vcomment_addtime \n"; 
	      foreach ($result as $key => $value){
	  	      $return_string .= iconv('UTF-8','GB2312',$value['vcomment_id'].",".$value['vcomment_member_id'].",".$value['vcomment_video_id'].","
	  	      .$value['vcomment_content'].",".$value['vcomment_addtime'] ."\n");
	      }
	  }
	  return $return_string;
}

function add_tmp_r($inrow) {
		$admin = spClass('zx_tmp_r');
		$result = $admin->create($inrow);
		return $result;
}

function get_kngidstr3($kng_id){
	  $result = array();
	  if($kng_id){
	  $sql = ' select kng_id,kng_grade,kng_foot_id from zx_knowledge ';
		$sql .= ' where kng_id = '.$kng_id;
		$result = get_info_by_sql($sql);
		$kng_grade = $result[0]['kng_grade'];
		$kng_foot_id = $result[0]['kng_foot_id'];
		$sql = ' select kng_id,kng_title,kng_grade from zx_knowledge ';
		$sql .= ' where kng_foot_id = '.$kng_foot_id;
		$sql .= ' and kng_id <> '.$kng_id;
		$sql .= ' limit 0,3';
		$result = get_info_by_sql($sql);
		foreach ($result as $key => $value){
	      $result[$key]['knglist'] = get_kngidstr($value['kng_id']);
    }
    }
		return $result;
}	

function get_kng_list_by_ajax($select){
	$knowledgedb = spClass("zx_knowledge");
	$rootkng = $knowledgedb->findAll(array("kng_foot_id" => 0));
	$return_string = "";
	foreach($rootkng as $key => $kng){
		$childkng = $knowledgedb->findAll(array("kng_foot_id" => $kng["kng_id"]));
		$return_string .= "<optgroup label='{$kng["kng_title"]}'></optgroup>";
		foreach($childkng as $k => $child){
			$return_string .= "<option value={$child["kng_id"]}" . ($select == $child["kng_id"] ? " selected" : "") . ">&nbsp;&nbsp;┗{$child['kng_title']}</option>";	
		}
	}
	return $return_string;
}

function get_video_list_by_ajax($kng_id, $select){
	if(is_string($select))$select = explode(",", $select);
	$sql = ' select video_id,video_title from zx_video ';
		$sql .= ' where video_kng_id = '.$kng_id;
		$sql .= ' and video_isdel = 0 ';
		$sql .= ' order by video_sort <> 0 desc,video_sort asc ';
		$video_list = get_info_by_sql($sql);
	//$videodb = spClass("zx_video");
	//$video_list = $videodb->findAll(array("video_kng_id" => $kng_id, "video_isdel" => 0));
	$return_string = "<tr><td>";
	foreach($video_list as $key => $video){
		//$return_string .= "<option value={$video["video_id"]}" . ($select == $video["video_id"] ? " selected" : "") . ">{$video['video_title']}</option>";
		$return_string .= "<input name='video_{$video["video_id"]}' " . (in_array($video["video_id"], $select) ? "checked" : "") . " type='checkbox' value='{$video['video_id']}'/>&nbsp;{$video['video_title']} &nbsp;&nbsp;";
	}
	$return_string .= "</td></tr>";
	return $return_string;
}
function get_kng_list_by_ajax2($f_kng_id, $select){
	if(is_string($select))$select = explode(",", $select);
	$sql = ' select kng_id,kng_title from zx_knowledge ';
		$sql .= ' where kng_foot_id = '.$f_kng_id;
		//$sql .= ' and video_isdel = 0 ';
		$sql .= ' order by kng_sort <> 0 desc,kng_sort asc ';
		$kng_list = get_info_by_sql($sql);
	//$videodb = spClass("zx_video");
	//$video_list = $videodb->findAll(array("video_kng_id" => $kng_id, "video_isdel" => 0));
	$return_string = "<tr><td>";
	foreach($kng_list as $key => $value){
		//$return_string .= "<option value={$video["video_id"]}" . ($select == $video["video_id"] ? " selected" : "") . ">{$video['video_title']}</option>";
		$return_string .= '<input name="kng_'.$value["kng_id"].'"' . (in_array($value["kng_id"], $select) ? "checked" : "") . ' type="checkbox" value="'.$value['kng_id'].'"/>&nbsp;'.$value['kng_title'].' &nbsp;&nbsp;';
	}
	$return_string .= "</td></tr>";
	return $return_string;
}

function get_examinfo_kngid($kngid, $exam_id = null){
	$examdb = spClass("zx_exam");
	$video_array = spClass("zx_video")->findAll(array("video_kng_id" => $kngid , "video_isdel" => 0));
	$videoids = "";
	$sqlw = "0";
	foreach($video_array as $key => $video){
		$sqlw .= " OR exam_video_id LIKE '%,{$video["video_id"]},%'";
	}
	
	if($exam_id){
		$sql = "exam_id < {$exam_id} AND ({$sqlw})";
	}else{
		$sql = $sqlw;
	}
	$examinfo = $examdb->find($sql, "exam_id desc");
	$examinfo["videoids"] = explode(",", $examinfo["exam_video_id"]);
	$examinfo["video_select"] = get_video_list_by_ajax($kngid, $examinfo["videoids"]);
	
	$examinfo["exam_title"] = preg_replace('/(src=")([^"]+)(\/.)/is', ' $1' . "../files/" . '$2', $examinfo["exam_title"]);
	$examinfo["exam_title"] = str_replace("mage", "/image", $examinfo["exam_title"]);
	return $examinfo;
}
function get_examinfo_by_kng_id($kng_id,$kng_v_tye='',$exam_id = '',$updowm = ''){
	  $sql = ' select exam_id,exam_title,exam_video_id,exam_true,exam_isdel,exam_step_one,exam_step_two,exam_step_three,exam_kng_id from zx_exam ';
		$sql.= ' where exam_kng_id = '.$kng_id;
		if($kng_v_tye){
			 if($kng_v_tye == '1')$sql.= ' and exam_video_id = ""';
			 if($kng_v_tye == '2')$sql.= ' and exam_video_id <> ""';
		}
		if($exam_id){
			 if($updowm == '1'){
			 	   $sql.= ' and exam_id < '.$exam_id;//shang 
			 	   $sql.= ' order by exam_id desc ';
			 }
			 if($updowm == '2'){
			 	   $sql.= ' and exam_id > '.$exam_id;//next
			 	   $sql.= ' order by exam_id asc ';
			 }
		}else{
			 $sql.= ' order by exam_id asc ';
		}
		$result = get_info_by_sql($sql);
		$result[0]['exam_title'] = str_replace('src="', 'src="../files/', $result[0]['exam_title']);
		return $result[0];
}
function get_examinfo_by_kng_id2($kng_id,$kng_v_tye='',$exam_id = '',$updowm = ''){
	  $sql = ' select exam_id,exam_title,exam_video_id,exam_true,exam_isdel,exam_step_one,exam_step_two,exam_step_three,exam_kng_id from zx_exam ';
		$sql.= ' where exam_kng_id = '.$kng_id;
		if($kng_v_tye){
			 if($kng_v_tye == '1')$sql.= ' and exam_video_id = ""';
			 if($kng_v_tye == '2')$sql.= ' and exam_video_id <> ""';
		}
		if($exam_id){
			 if($updowm == '1'){
			 	   $sql.= ' and exam_id < '.$exam_id;//shang 
			 	   $sql.= ' order by exam_id desc ';
			 }
			 if($updowm == '2'){
			 	   $sql.= ' and exam_id > '.$exam_id;//next
			 	   $sql.= ' order by exam_id asc ';
			 }
		}else{
			 $sql.= ' order by exam_id asc ';
		}
		$result = get_info_by_sql($sql);
		$result[0]['exam_title'] = str_replace('src="', 'src="./files/', $result[0]['exam_title']);
		return $result[0];
}
function get_examinfo_by_id($exam_id){
	  $sql = ' select exam_id,exam_title,exam_video_id,exam_true,exam_isdel,exam_step_one,exam_step_two,exam_step_three,exam_kng_id from zx_exam ';
		$sql.= ' where exam_id = '.$exam_id;
		
		$result = get_info_by_sql($sql);
		$result[0]['exam_title'] = str_replace('src="', 'src="../files/', $result[0]['exam_title']);
		return $result[0];
}
function get_examinfo_by_id2($exam_id){
	  $sql = ' select exam_id,exam_title,exam_video_id,exam_true,exam_isdel,exam_step_one,exam_step_two,exam_step_three,exam_kng_id from zx_exam ';
		$sql.= ' where exam_id = '.$exam_id;
		
		$result = get_info_by_sql($sql);
		$result[0]['exam_title'] = str_replace('src="', 'src="./files/', $result[0]['exam_title']);
		return $result[0];
}
function update_exam($id,$uprow) {
    $admin = spClass('zx_exam');
    $condition = array('exam_id'=> $id);
    $result = $admin->update($condition,$uprow);
    return $result;		
}
function update_exam_record($id,$uprow) {
	$admin = spClass('zx_exam_record');
	$condition = array('er_id'=> $id);
	$result = $admin->update($condition,$uprow);
	return $result;
}

function doc2htm($docpath,$htmlpath){
	  $word=new COM("Word.Application",null,CP_UTF8) or die("无法打开 MS Word");
    $word->visible = 1 ;
    $word->Documents->Open($docpath)or die("无法打开这个文件");
    //$htmlpath=substr($docpath,0,-4);
    //$htmlpath=substr($docpath,0,-4);
      //echo $htmlpath;
    $word->ActiveDocument->SaveAs($htmlpath,8);
    //$word->quit(0);
    $word->quit();
    $word = null;
}

function htm2db($urlpath,$kng_id){
	  //echo '1';
	  /*$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $urlpath);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);//设置HTTP头
    curl_setopt($ch, CURLOPT_POST, 1);
    //curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);//POST数据
    echo curl_exec($ch);
    $return_from = mb_convert_encoding (curl_exec($ch),'UTF-8','gbk');
    curl_close($ch);*/
    $myFile = fopen($urlpath,"rb");
    $myFileContent = fread($myFile,filesize($urlpath));
    fclose($myFile); 
    //echo '2';
   
    $return_from = mb_convert_encoding ($myFileContent,'UTF-8','gbk');
    // echo  $return_from;
    $return_str = cut($return_from ,"<div class=WordSection1 style='layout-grid:15.6pt'>","</div>",false,false);
    //echo '3';
    //echo $return_str;
    if(trim($return_str) == '')$return_str = cut($return_from ,"<div class=Section1 style='layout-grid:15.6pt'>","</div>",false,false);
	  $return_str =strip_tags($return_str,'<img><span><p>');
	  //$old_map_adress =cut($return_str ,'src="','.files/',false,ture);
	  $return_str = str_replace('.files/','/',$return_str);
	  $tmp_str = '';
	  $shiti_array = array();
	  $daan_array = array();
	  $is_as = false;
	  while (trim($return_str) != ''){
	  	  $get_tmp_p = cut($return_str ,"<p ","</p>",true,true);
	  	  $return_str =substr($return_str, strlen($get_tmp_p));
        //statement
        //判断是否标题  = 选择题
        if(isOption($get_tmp_p))continue;
        //判断是否到了 取答案的
        if(isAnswer($get_tmp_p))break;
        //判断是否 &nbsp;isSpace
        if(isSpace($get_tmp_p)){
        	  if($tmp_str !=''){
        	  	  $shiti_array[] = $tmp_str;
        	  	  $tmp_str = '';
        	  }
        	  continue;
        }
        //判断 是分割线 = 我是分割线
        if(isDividingLine($get_tmp_p)){
        	  if($tmp_str !=''){
        	  	  $shiti_array[] = $tmp_str;
        	  	  $tmp_str = '';
        	  }
        	  continue;
        }
        $tmp_str .= $get_tmp_p;
    }
    $return_str = strip_tags($return_str,'');
    $temp_arr2 = explode('我是分割线', $return_str);
    foreach($temp_arr2 as $key => $value){
    	  if(isRightAnswer($value))$daan_array[] = trim($value);
    }
    $sql = ' INSERT INTO `zx_exam` (`exam_true` ,`exam_title`, `exam_kng_id`) VALUES ';
    $temp_sql = '';
    foreach($shiti_array as $key => $value){
    	  if($temp_sql != '')$temp_sql .= ',';
    	  $ins_value = str_replace('"','\"',$value );
    	  $ins_value = str_replace("'","\'",$ins_value );
    	  $temp_sql .= '("'.$daan_array[$key].'","'.$ins_value.'",'.$kng_id.')';
    }
    if($temp_sql != ''){
    	  $sql.= $temp_sql.';';
    	  //echo $sql;
    	  $result = up_info_by_sql($sql);
    	  //echo $sql;
    	  //if($result === false)echo '试题导入失败！';;
    	  //	  echo "<script>alert('试题导入失败！');</script>";
    	  //}else{
    	 //	  echo "<script>alert('试题导入成功！');</script>";
    		//}
    }
    unlink($file_path);
	
}


function get_m_showdata($m_id,$v_id,$from_date = '',$to_date = ''){
    //$sql = 'select a.er_gtime select,a.er_exam_selected,a.er_exam_usetime from zx_exam_record a';
    $sql = 'select a.er_gtime,avg(a.er_exam_selected) as avg_s,avg(a.er_exam_usetime)  as avg_u from zx_exam_record a';
    $sql.= ' Left join zx_exam b on b.exam_id =a.er_exam_id';
    //$sql.= ' Left join zx_video c on b.exam_video_id =c.video_id';
    $sql.= ' where  a.er_member_id ='.$m_id;
    $sql.= " and  b.exam_video_id like '%,".$v_id.",%'";
    $sql.= ' and a.er_exam_selected <> -1';
    $sql.= ' and a.er_exam_isdisplay = 0 ';
    if($from_date != '')
	      $sql .= ' and date(a.er_gtime) >= "'.date("Y-m-d",strtotime($from_date)).'"';
    if($to_date != '')
	      $sql .= ' and date(a.er_gtime) <=  "'.date("Y-m-d",strtotime($to_date)).'"';
	 
	  $sql.= ' group by a.er_gtime ';
	  $sql.= ' order by a.er_gtime asc';
	  $result = get_info_by_sql($sql);
	  return $result;
    //print_R($result);
    //echo $sql;
}
function get_vtitle_by_vid($vid){
	  $sql = 'select video_id,video_title from  zx_video where video_id='.$vid;
	  $result = get_info_by_sql($sql);
	  return $result[0]['video_title'];
}

function get_month_op($skey = ''){
	  $month_option = '';
	  $month_array = array('','1','2','3','4','5','6','7','8','9','10','11','12');
     //$month_array = array('','一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月');
    foreach( $month_array as $key => $value){
	      if($key== 0){
	          $month_option .= '<option  value="">'.$value.'</option>';
	      }else{
	  	      $month_option .= '<option  value="'.$key.'" ';
	  	      if($key == $skey)
	  	          $month_option .= ' selected ';
	  	      $month_option .= '>'.$value.'</option>';
	      }
    }
    return $month_option;
}
function get_year_op($skey = ''){
	  $year_option = '<option  value=""></option>';
    $max = (int)date('Y');
    $min = 2012;
    for ($i=$max; $i >= $min; $i--){
        $year_option .= '<option  value="'.$i.'" ';
	      if($i == $skey)
	  	      $year_option .= ' selected ';
	      $year_option .= '>'.$i.'</option>';
    }
    return $year_option;
}
function get_day_op($skey = ''){
	  $day_option = '<option  value=""></option>';
    for ($i=1; $i< 32; $i++){
        $day_option .= '<option  value="'.$i.'" ';
	      if($i == $skey)
	  	      $day_option .= ' selected ';
	      $day_option .= '>'.$i.'</option>';
    }
    return $day_option;
}

function get_teacher_list_by_kng($kng_id, $t_id = ''){
	  //$cur_kng_id = 0;
    $sql = ' select member_id,member_name from zx_member ';
    $sql.= ' where member_identity_type = 1 ';
    $sql.= ' and member_kng_id = '.$kng_id;
//$sql.= ' order by kng_sort <> 0 desc,kng_sort asc ';
    $result = get_info_by_sql($sql);
    $m_option = '';
    foreach( $result as $key => $value){
	      $m_option .= '<option  value="'.$value['member_id'].'" '. ($t_id == $video["member_id"] ? " selected" : "") .' >'.$value['member_name'].'</option>';
    }
    //$this->m_option = $m_option;
	
	  return $m_option;
}

function add_member_t_apply($inrow) {
		$admin = spClass('zx_member_t_apply');
		$result = $admin->create($inrow);
		return $result;
}
function update_member_t_apply($id,$uprow) {
    $admin = spClass('zx_member_t_apply');
    $condition = array('m_t_apply_id'=> $id);
    $result = $admin->update($condition,$uprow);
    return $result;		
}
function add_member_belong($inrow) {
		$admin = spClass('zx_member_belong');
		$result = $admin->create($inrow);
		return $result;
}

function isExist($uid){
	  $cnt = 0;
	  $sql = ' select count(member_id) as cnt from zx_member ';
    $sql.= ' where  member_uid = "'.$uid.'"';
	  $result = get_info_by_sql($sql);
	  $cnt = $result[0]['cnt'];
	  if($cnt == 1)true;
		return false;
}
function tr_rn($value){
	 /* $value =  preg_replace('/\r/g', '<br>', $value);
	  $value =  preg_replace('/\n/g', '<br>', $value);
	  $value =  preg_replace('/\r\n/g', '<br>', $value);*/
	  $value =  str_replace('\r', '<br>', $value);
	  $value =  str_replace('\n', '<br>', $value);
	  $value =  str_replace('\r\n', '<br>', $value);
	  
	  return $value;
}
function add_exam_question($inrow) {
		$admin = spClass('zx_member_exam_question');
		$result = $admin->create($inrow);
		return $result;
}
function update_exam_question($id,$uprow) {
    $admin = spClass('zx_member_exam_question');
    $condition = array('m_exam_q_id'=> $id);
    $result = $admin->update($condition,$uprow);
    return $result;		
}

function del_exam_question_by_id($id){
    $admin = spClass('zx_member_exam_question');
    $condition = array('m_exam_q_id'=> $id);
    $result = $admin->delete($condition);
    return $result; 
}

function add_member_group($inrow) {
		$admin = spClass('zx_member_group');
		$result = $admin->create($inrow);
		return $result;
}
function update_member_group($id,$uprow) {
    $admin = spClass('zx_member_group');
    $condition = array('m_group_id'=> $id);
    $result = $admin->update($condition,$uprow);
    return $result;		
}
function del_member_group_by_id($id){
    $admin = spClass('zx_member_group');
    $condition = array('m_group_id'=> $id);
    $result = $admin->delete($condition);
    return $result; 
}
function del_member_belong_by_id($s_id,$t_id){
    $admin = spClass('zx_member_belong');
    $condition = array('m_belong_s_id'=> $s_id,'m_belong_t_id'=> $t_id);
    $result = $admin->delete($condition);
    return $result; 
}
function init_array_formap($list){
	  $tmp_array =array();
	  $tmp_array['name'] = '';
	  foreach($list as $key => $value){
	  	 $tmp_array[$value['kng_title']] = 0;
	  }
	  return  $tmp_array; 
}

function get_school_list($school_code =''){
	$return_string = '';
	$sql = ' select school_code,school_name from zx_school ';
	$sql.= ' order by school_sort <> 0 desc,school_sort asc ';
	$result = get_info_by_sql($sql);
	foreach ($result as $key => $value){
		$return_string.= '<option value="'.$value['school_code'].'" ';
		if($school_code == $value['school_code'])
			$return_string.= ' selected ';
		$return_string.= '>'.$fu.''.$value['school_name'].'</option>';
	}
	return $return_string;
}
