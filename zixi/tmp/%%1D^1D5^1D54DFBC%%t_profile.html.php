<?php /* Smarty version 2.6.26, created on 2013-12-19 16:36:03
         compiled from t_profile.html */ ?>
<!DOCTYPE>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
	<title><?php echo $this->_tpl_vars['title']; ?>
</title>
	<meta name="description" content="<?php echo $this->_tpl_vars['description']; ?>
">
  <meta name="keywords" content="<?php echo $this->_tpl_vars['keywords']; ?>
">
  <link rel="shortcut icon" href="<?php echo $this->_tpl_vars['web_site']; ?>
/images/favicon.ico">
  <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['web_site']; ?>
/css/header.css">
  <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['web_site']; ?>
/css/com.css">
  <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['web_site']; ?>
/css/userprofile.css">
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/jquery-1.9.1.min.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/jquery.menu-aim.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/com.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/userprofile.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/t_profile.js"></script>
<style>
    #page_sub_nav </style>

</head>
<!--[if lt IE 7]>  <body class="ie ie6 lte9 lte8 lte7"> <![endif]-->
<!--[if IE 7]>     <body class="ie ie7 lte9 lte8 lte7"> <![endif]-->
<!--[if IE 8]>     <body class="ie ie8 lte9 lte8"> <![endif]-->
<!--[if IE 9]>     <body class="ie ie9 lte9"> <![endif]-->
<!--[if gt IE 9]>  <body> <![endif]-->
<!--[if !IE]>
<!--> <body data-twttr-rendered="true"><!--<![endif]-->
<div id="outer-wrapper" class="clearfix new-header">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--内容-->
<div id="page-container">
    <div id="page-container-inner">
    <article id="individual_report">
        <div id="profile-content">
<menu class="profile-navigation docked-nav">
    <ul>
        <li class="profile-tab">
            <a href="<?php echo $this->_tpl_vars['web_site']; ?>
/profile/<?php echo $this->_tpl_vars['membercode']; ?>
/" class="tab-link ellipsis no-recolor active" rel="profile">
            <img src="<?php if ($this->_tpl_vars['member_logo'] == ''): ?><?php echo $this->_tpl_vars['web_site']; ?>
/images/dflogo.png<?php else: ?><?php echo $this->_tpl_vars['web_site']; ?>
/images/mlogo/<?php echo $this->_tpl_vars['member_logo']; ?>
<?php endif; ?>" class="profile-tab-avatar">
            <span id="profile-tab-link" class="profile-tab-text"><?php echo $this->_tpl_vars['member']; ?>

            </span>
        </a></li>
    </ul>
    <!--成就-s-->
    <!--
    <ul class="accomplishments-statistics-section guider-tab-callout zero-top-margin">
        <li>
            <span class="inactive link-section-header">Accomplishments</span>
            <ul class="second-tier">
                <li>
                    <a href="/profile/robertchen/achievements" class="tab-link has-icon no-recolor ellipsis" rel="achievements">
                        Achievements
                    </a>
               </li>
                <li>
                    <a href="/profile/robertchen/goals" class="tab-link has-icon no-recolor ellipsis" rel="goals">
                        Goals (beta)
                    </a>
                </li>
                <li>
                    <a href="/profile/robertchen/programs" class="tab-link has-icon no-recolor" rel="community programs">
                       Programs
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <span class="inactive link-section-header">Vital statistics</span>
            <ul class="second-tier">
                <li>
                    <a href="/profile/robertchen/vital-statistics/activity" class="tab-link has-icon no-recolor ellipsis" rel="vital-statistics activity">
                        Activity
                    </a>
               </li>
                <li>
                    <a href="/profile/robertchen/vital-statistics/focus" class="tab-link has-icon no-recolor ellipsis" rel="vital-statistics focus">
                       Focus
                    </a>
               </li>
                <li>
                    <a href="/profile/robertchen/vital-statistics/skill-progress" class="tab-link has-icon no-recolor ellipsis" rel="vital-statistics skill-progress">
                        Skill Progress
                    </a>
                </li>
                <li>
                    <a href="/profile/robertchen/vital-statistics/skill-progress-over-time" class="tab-link has-icon no-recolor ellipsis" rel="vital-statistics skill-progress-over-time">
                        Progress Over Time
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    
    <ul class="zero-top-margin">
        <li>
            <span class="inactive link-section-header">Community</span>
        </li>
    </ul>
    <ul class="zero-top-margin community-discussion guider-tab-callout">
    <ul class="second-tier">
        <li>
            <a href="/profile/robertchen/discussion" class="tab-link has-icon no-recolor ellipsis" rel="community discussion">
                Discussion
            </a>
        </li>
    </ul>
    </ul>
    <ul class="zero-top-margin">
    <ul class="second-tier">
        
            <li>
                <a href="/profile/robertchen/coaches" class="tab-link has-icon no-recolor ellipsis" rel="community coaches">
                    Coaches
                </a>
            </li>
        
    </ul>
    </ul>-->
</menu>
<section class="tab-content">
    <h2 class="profile-sheet-title" style="display: none;">
        <span class="nickname"></span>
        <span class="page-title"></span>
        <span class="profile-badge-count-container" style="display: none;"><span title="0 badges total. ">
    
        <span class="badge-category" data-category="category-5">
            <img class="badge-image" src="/images/badges/master-challenge-blue.png" width="20" height="20">
            <span class="badge-count">0</span>
        </span>
    
        <span class="badge-category" data-category="category-4">
            <img class="badge-image" src="/images/badges/eclipse-medium.png" width="20" height="20">
            <span class="badge-count">0</span>
        </span>
    
        <span class="badge-category" data-category="category-3">
            <img class="badge-image" src="/images/badges/sun-medium.png" width="20" height="20">
            <span class="badge-count">0</span>
        </span>
    
        <span class="badge-category" data-category="category-2">
            <img class="badge-image" src="/images/badges/earth-medium.png" width="20" height="20">
            <span class="badge-count">0</span>
        </span>
    
        <span class="badge-category" data-category="category-1">
            <img class="badge-image" src="/images/badges/moon-medium.png" width="20" height="20">
            <span class="badge-count">0</span>
        </span>
    
        <span class="badge-category" data-category="category-0">
            <img class="badge-image" src="/images/badges/meteorite-medium.png" width="20" height="20">
            <span class="badge-count">0</span>
        </span>
    
</span>
</span>
    </h2>
    <div class="profile-notification" style="display: none;">
        
            <div class="empty-graph">
                <h2><a href="/library">Watch a video</a> or <a href="/exercisedashboard">try a skill</a>!</h2>
                <p>Once you do, real data will show up here.</p>
            </div>
            <div class="error-graph">
                <h2>It's our fault.</h2>
                <p>Try again later, and please <a href="/reportissue?type=Defect">let us know</a> if it continues.</p>
            </div>
            <div class="no-coaches-for-phantoms">
                <h2><a href="/login?continue=%2Fprofile">Log in</a> to add a coach!</h2>
            </div>
        
    </div>
    <div class="clearfix">
        <div id="tab-content-user-profile" rel="profile" style="">
            <div class="user-info-container"><div class="user-card"><div class="user-info vertical-shadow clearfix">
    <div class="basic-user-info" style="float: left;">
      <div class="avatar-pic-container editable" style="float:left;">
        <img src="<?php if ($this->_tpl_vars['member_logo'] == ''): ?><?php echo $this->_tpl_vars['web_site']; ?>
/images/dflogo.png<?php else: ?><?php echo $this->_tpl_vars['web_site']; ?>
/images/mlogo/<?php echo $this->_tpl_vars['member_logo']; ?>
<?php endif; ?>" width="100px" height="100px" id="avatar-pic" class="avatar-pic">
      </div>
      <div class="user-deets ">
          <div class="nickname-container fully-editable">
              <span class="nickname"><?php echo $this->_tpl_vars['member']; ?>
</span>
          </div>
          <div>
              <span>注册时间： <abbr class="timeago" title=""><?php echo $this->_tpl_vars['member_addtime']; ?>
</abbr></span>
          </div>
          <div class="basic-stats clearfix ">
            
              <!--<div class="simple-stat">
                  <img class="summary-icon star" src="/images/profile-icons/inset-star.png">
                  <div class="stat-text">0<span class="stat-divider">/</span>414</div>
              </div>-->
              <div class="simple-stat">
                  <img class="summary-icon" src="<?php echo $this->_tpl_vars['web_site']; ?>
/images/video.png">
                  <div class="stat-text"><?php echo $this->_tpl_vars['v_videos']; ?>
<span class="stat-divider">/</span><?php echo $this->_tpl_vars['videos_count']; ?>
</div>
              </div>
             <!-- <div class="simple-stat">
              	 <span class="energy-points-badge" style="float:none; display:block; margin-bottom: 1px; margin-top: 2px; padding:0; line-height: 20px;" title="0 energy points">0</span> Energy Points</div>-->
          </div>
          <div class="user-profile-controls clearfix">
          
            <span class="dropdown dropdown-new">
              <span class="dropdown-toggle dropdown-toggle-new">
                编辑个人信息
                <span class="caret"></span>
              </span>
              <ul class="dropdown-menu no-submenus dropdown-menu-new">
                  <li><a class="edit-basic-info" href="<?php echo $this->_tpl_vars['web_site']; ?>
/setting/<?php echo $this->_tpl_vars['m_type']; ?>
/">编辑基本信息</a></li>
                  <li><a class="edit-avatar" href="<?php echo $this->_tpl_vars['web_site']; ?>
/avatar">编辑头像</a></li>
                  <!--<li><a class="edit-visibility" href="javascript:void(0)" data-hasqtip="true">切换隐私设置</a></li>-->
              </ul>
              <!--&nbsp; &nbsp; &nbsp;
               <a class="foreground-link " style='text-decoration: none;' href="<?php echo $this->_tpl_vars['web_site']; ?>
/examerr">
                    <span class="simple-button">错题查看</span>
               </a>
               &nbsp;-->
               
            </span>
           
           
          </div>
          <br/>
               <a  class="foreground-link " style='text-decoration: none;' href="<?php echo $this->_tpl_vars['web_site']; ?>
/exam_s_log">
                    <span  class="simple-button">学生做题记录</span>
               </a>
               <a  class="foreground-link " style='text-decoration: none;' href="<?php echo $this->_tpl_vars['web_site']; ?>
/exam_err_log">
                    <span  class="simple-button">学生错题统计</span>
               </a>
              
           <?php if ($this->_tpl_vars['member_exam_vlink'] == 1): ?>
               <br/>
               <a  class="foreground-link " style='text-decoration: none;' href="<?php echo $this->_tpl_vars['web_site']; ?>
/exam_set">
                    <span  class="simple-button">试题关联设置</span>
               </a>
           <?php endif; ?>
            
          
      </div>
    </div>
    <!--勋章系统--><!--
    <div class="sticker-book">
    <div class="badge-display-case">
    	<a class="display-case-cover editable" href="javascript:void(0)">

<div class="achievement-badge compact badge-overlay" title=""></div>
<div class="achievement-badge compact badge-overlay" title=""></div>
<div class="achievement-badge compact badge-overlay" title=""></div>
<div class="achievement-badge compact badge-overlay" title=""></div>
<div class="achievement-badge compact badge-overlay" title=""></div>
</a>



<div class="main-case fancy-scrollbar">

<div class="achievement-badge compact empty">
  <div id="outline-box">
  <div class="selected-indicator"> </div>
  </div>
</div>




<div class="achievement-badge compact empty">
  <div id="outline-box">
  <div class="selected-indicator"> </div>
  </div>
</div>




<div class="achievement-badge compact empty">
  <div id="outline-box">
  <div class="selected-indicator"> </div>
  </div>
</div>




<div class="achievement-badge compact empty">
  <div id="outline-box">
  <div class="selected-indicator"> </div>
  </div>
</div>




<div class="achievement-badge compact empty">
  <div id="outline-box">
  <div class="selected-indicator"> </div>
  </div>
</div>


</div>
<div class="badge-picker fancy-scrollbar"></div>

</div>
</div>-->

</div>
<!--
<a href="javascript:void(0)" class="edit-visibility visibility-toggler private" data-hasqtip="true">Profile is private</a>-->
<div id="username-picker-container" class="modal fade hide" style="display: none;">
</div>

</div>
</div>
            <div style="clear: both; margin-bottom: 20px;"></div>
                <div class="activity-column">
                    <div id="activity-contents" style="">
                        <div id="suggested-activity">
                            <h2>学生申请</h2>
<div class="activity-list">
    <ul>
    	 
    	 <?php $_from = $this->_tpl_vars['apply_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['applyim']):
?>
    	 <?php if ($this->_tpl_vars['applyim']['member_name'] != ''): ?>
        <li class="activity-exercise clearfix">
            <div class="ach-text">
                <a class="ellipsis foreground-link" title="<?php echo $this->_tpl_vars['applyim']['member_name']; ?>
" href="<?php echo $this->_tpl_vars['web_site']; ?>
/apply_check/<?php echo $this->_tpl_vars['applyim']['m_t_apply_id']; ?>
">
                    <?php if ($this->_tpl_vars['applyim']['student_name'] != ""): ?><?php echo $this->_tpl_vars['applyim']['student_name']; ?>
<?php else: ?><?php echo $this->_tpl_vars['applyim']['member_name']; ?>
<?php endif; ?>
                </a>
                <div class="suggested-activity-controls">
                	  <?php echo $this->_tpl_vars['applyim']['m_t_apply_addtime']; ?>

                	  &nbsp;&nbsp;
                    <a class="foreground-link" href="<?php echo $this->_tpl_vars['web_site']; ?>
/apply_check/<?php echo $this->_tpl_vars['applyim']['m_t_apply_id']; ?>
">
                        <span class="simple-button">查看审核</span>
                    </a>
                </div>
            </div>
        </li>
         <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
       
      
    </ul>
</div>
</div>
<div id="recent-activity">
<h2>学生试题质疑</h2>
<div class="activity-list">
    <ul>
    	 <?php $_from = $this->_tpl_vars['exam_q_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['qitem']):
?>
    	  <?php if ($this->_tpl_vars['qitem']['member_name'] != ''): ?>
        <li class="activity-exercise clearfix">
        	  <div class="ach-text">
                <a class="ellipsis foreground-link" title="<?php echo $this->_tpl_vars['qitem']['member_name']; ?>
" href="<?php echo $this->_tpl_vars['web_site']; ?>
/exam_q_reply/<?php echo $this->_tpl_vars['qitem']['m_exam_q_id']; ?>
">
                    <?php echo $this->_tpl_vars['qitem']['m_exam_q_examid']; ?>
题
                </a>
                <div class="suggested-activity-controls">
                	 <?php if ($this->_tpl_vars['qitem']['student_name'] != ""): ?><?php echo $this->_tpl_vars['qitem']['student_name']; ?>
<?php else: ?><?php echo $this->_tpl_vars['qitem']['member_name']; ?>
<?php endif; ?>
                	  &nbsp;&nbsp;
                	  <?php echo $this->_tpl_vars['qitem']['m_exam_q_addtime']; ?>

                	  &nbsp;&nbsp;
                	  <?php if ($this->_tpl_vars['qitem']['m_exam_q_reply'] == ''): ?>待回复<?php else: ?>已回复<?php endif; ?>
                	  &nbsp;&nbsp;
                    <a class="foreground-link" href="<?php echo $this->_tpl_vars['web_site']; ?>
/exam_q_reply/<?php echo $this->_tpl_vars['qitem']['m_exam_q_id']; ?>
">
                        <span class="simple-button">编辑</span>
                    </a>
                    &nbsp;
                    <a class="foreground-link" href="<?php echo $this->_tpl_vars['web_site']; ?>
/exam_q_tdel/<?php echo $this->_tpl_vars['qitem']['m_exam_q_id']; ?>
" onclick="return confirm('确定要删除该习题（<?php echo $this->_tpl_vars['qitem']['m_exam_q_examid']; ?>
）的质疑？');">
                        <span class="simple-button">删除</span>
                    </a>
                </div>
            </div>
            
        </li>
        <?php endif; ?>
       <?php endforeach; endif; unset($_from); ?>
    </ul>
</div>

</div>


                    </div>
                </div>
                
             
               <div class="exploration-column vertical-shadow " style="display: block;">
               	<div>
               	<h2>分组管理</h2>
                 <a  class="foreground-link " style='text-decoration: none;' href="<?php echo $this->_tpl_vars['web_site']; ?>
/student_group/add">
                    <span  class="simple-button">添加分组</span>
                 </a>
               </div>
               <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
               	 <tr class="tdbg"><td width="5px"></td><td >序号</td><td>组名</td><td>成员数</td><td align="center">操作</td><td width="5px"></td> <input type="hidden" id="web_site" name="web_site" value="<?php echo $this->_tpl_vars['web_site']; ?>
"></tr>
               	 
               	 <?php $_from = $this->_tpl_vars['group_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['gitem']):
?>
               	  <?php if ($this->_tpl_vars['gitem']['m_group_name'] != ''): ?>
               	 <tr class="tdbg">
               	 	  <td width="5px"></td><td ><?php echo $this->_tpl_vars['key']+1; ?>
</td><td><?php echo $this->_tpl_vars['gitem']['m_group_name']; ?>
</td><td><?php if ($this->_tpl_vars['gitem']['s_count'] != ''): ?><?php echo $this->_tpl_vars['gitem']['s_count']; ?>
<?php else: ?>0<?php endif; ?></td>
               	 	   <td align="center">
               	 	   	 <a class="foreground-link" href="<?php echo $this->_tpl_vars['web_site']; ?>
/student_group/edit/<?php echo $this->_tpl_vars['gitem']['m_group_id']; ?>
">
                        <span class="simple-button">编辑</span>
                       </a>
                       &nbsp;&nbsp;
                       <a class="foreground-link" href="<?php echo $this->_tpl_vars['web_site']; ?>
/student_group/del/<?php echo $this->_tpl_vars['gitem']['m_group_id']; ?>
" onclick="return confirm('确定要删除该分组（<?php echo $this->_tpl_vars['gitem']['m_group_name']; ?>
）？');">
                        <span class="simple-button">删除</span>
                       </a>
               	 	   	</td>
               	 	 <td width="5px"></td>
               	 	 </tr>
               	 	<?php endif; ?>
               	 <?php endforeach; endif; unset($_from); ?> 
               </table>
               
              </div>

            <div class="exploration-column vertical-shadow " style="display: block;">
                <h2>学生管理(学生总数：<?php echo $this->_tpl_vars['s_count']; ?>
)</h2>
                <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
               	 <tr class="tdbg"><td width="5px"></td><td >序号</td><td>学生</td><td>组别-
               	 	<select id="g_option" name="g_option"  ><?php echo $this->_tpl_vars['g_option']; ?>

                  </select>
               	 	</td><td align="center">操作</td><td width="5px"></td></tr>
               	 <tbody id="tb_st_list">
               	 <?php $_from = $this->_tpl_vars['st_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['sitem']):
?>
               	<?php if ($this->_tpl_vars['sitem']['member_name'] != ''): ?>
               	 <tr class="tdbg">
               	 	  <td width="5px"></td><td ><?php echo $this->_tpl_vars['key']+1; ?>
</td><td><?php if ($this->_tpl_vars['sitem']['student_name'] != ""): ?><?php echo $this->_tpl_vars['sitem']['student_name']; ?>
<?php else: ?><?php echo $this->_tpl_vars['sitem']['member_name']; ?>
<?php endif; ?></td><td><?php if ($this->_tpl_vars['sitem']['m_group_name'] != ''): ?><?php echo $this->_tpl_vars['sitem']['m_group_name']; ?>
<?php else: ?>未分组<?php endif; ?></td>
               	 	   <td align="center">
               	 	   	 <a class="foreground-link" href="<?php echo $this->_tpl_vars['web_site']; ?>
/student_test_view/<?php echo $this->_tpl_vars['sitem']['m_belong_s_id']; ?>
">
                        <span class="simple-button">查看</span>
                       </a>
                       &nbsp;
                       <a class="foreground-link" href="<?php echo $this->_tpl_vars['web_site']; ?>
/student_group_set/<?php echo $this->_tpl_vars['sitem']['m_belong_s_id']; ?>
">
                        <span class="simple-button">分组</span>
                       </a>
                       &nbsp;
                       <a class="foreground-link" href="<?php echo $this->_tpl_vars['web_site']; ?>
/student_del/<?php echo $this->_tpl_vars['sitem']['m_belong_s_id']; ?>
"  onclick="return confirm('确定要删除该学生（<?php echo $this->_tpl_vars['sitem']['member_name']; ?>
-<?php echo $this->_tpl_vars['sitem']['student_name']; ?>
）？');">
                        <span class="simple-button">删除</span>
                       </a>
               	 	   	</td>
               	 	 <td width="5px"></td>
               	 	 </tr>
               	 <?php endif; ?>
               	 <?php endforeach; endif; unset($_from); ?> 
               </tbody>
               </table>
            </div>
            
            
            
        </div>
    </div>
</section>
</div>
    </article>
    <div id="end-of-page-spacer">&nbsp;</div>
    </div>
    </div>


<!--内容-结束-->    
</div>
<div class="push"></div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!-- zixi.org.cn Baidu tongji analytics
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F373a5160f96b2e16d6ffc7ced7340f47' type='text/javascript'%3E%3C/script%3E"));
</script> -->
</body>
</html>