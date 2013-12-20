<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
?>
<noscript>
    <div class="noscript-warning">
    <p><i class="icon-warning-sign"></i> 请在你的浏览器中启用JavaScript。</p>
    </div>
</noscript>    
    <div id="top-header-container">
      <div id="top-header" class="new">
        <span id="page_auth">
        	<div id="search-box">
        <form class="page-search" action="<?=$web_site?>/search" method="post" name='searchForm'>
            <input id="search-input" type="text" placeholder="输入关键词回车搜索" name="search_query" value="" class="ui-corner-all placeholder simple-input search-input blur-on-esc ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
         </form>
         </div>
    <span id="user-info">
    	<?if($member == ''){?>
    	<a class="nav-link sign-in-link" href="<?=$web_site?>/login">登&nbsp;录</a>
    	<a class="sign-up-link" href="<?=$web_site?>/signup" >注&nbsp;册</a>
    	<?}else{?>
    	<span class="dropdown" id='userspan'>
      <span class="username_and_notification dropdown-toggle" data-hasdropdownbehavior="true">
        <a href="javascript:userinfoDisplay('userspan');" class="nav-link2 show-demo-dialog">
        
        	<span class="user-name"><?=$member?></span>
        	<i class="icon-chevron-down"></i>
        </a>
      </span>
    <ul class="dropdown-menu no-submenus">
      <a class="hover-card-link show-demo-dialog" href="<?=$web_site?>/profile/<?=$result_member[0]['member_identity_type']?>/<?=$result_member[0]['member_md5code']?>/" >
        <div class="hover-card-container ">
          <div class="hover-card-content-container">
            <div class="hover-card-content clearfix">
              <div class="avatar-pic-container">
                <img src="<?if($member_logo==''){?><?=$web_site?>/images/dflogo.png<?}else{?><?=$web_site?>/images/mlogo/<?=$result_member[0]['member_logo']?><?}?>" style="width: 50px; height: 50px;">
              </div>
              <div class="user-info">
                <span class="nickname">
                  <a class="profile-link" href="<?=$web_site?>/profile/<?=$result_member[0]['member_identity_type']?>/<?=$result_member[0]['member_md5code']?>/"><?=$member?></a>
                </span>
                <div class="badge-container"></div>
              </div>
              <div class="user-stats">
                <div class="points"><span class="points-label">已观看</span><span style="font-size: 150%"><?if( $v_videos == ''){echo 0;}else{echo $v_videos;}?></span> <span class="points-label">个视频</span></div>
                <div class="join-date">总观看次数<abbr class="timeago" ><?if( $v_times == ''){echo 0;}else{echo $v_times;}?></abbr></div>
              </div>
            </div>
          </div>
        </div>
      </a>
      <div class="user-dropdown-controls clearfix">
            <a class="simple-button right-control" href="<?=$web_site?>/profile/<?=$result_member[0]['member_identity_type']?>/<?=$result_member[0]['member_md5code']?>/">个人中心</a>
            <a id="page_logout" class="simple-button left-control" href="<?=$web_site?>/logout">注销</a>
      </div>
    </ul>
      </span>
     <?}?>
    </span>
    </span>
    <nav class="sitewide-navigation">
      <span class="links nav-subheader">
        <span class="dropdown topic-browser-dropdown">
          <a class="watch-link dropdown-toggle show-demo-dialog" data-hasdropdownbehavior="true"  id='watch-link'><?=$nav_array['Learn']?><i class="icon-chevron-down"></i></a>
          <div style="clear: both"></div>
          <ul class="topic-browser-menu dropdown-menu new none-active" data-role="listview" data-inset="true" >
          <li>
            <a href="<?=$web_site?>" class="menulink"><?=$nav_array['Home']?></a>
          </li>
         
          <li class="has-divider"></li>
          <?foreach($nav_kng_result as $key => $value){?>
      <li class="level0 has-submenu ">
        <a data-tag="TopicBrowserPulldown" class="menulink"><?=$value['kng_title']?>
        <i class="icon-chevron-right"></i>
        </a>
        <div class="dropdown-menu no-submenus sub-menu-custom domain-color" >
          <div class="submenu-title"><?=$value['kng_title']?></div>
          <ul class="clearfix">
          	<?foreach($value['kng_items'] as $key_it => $value_it){?>
            <li class="level1">
              <a href="<?=$web_site?>/kng/<?=$value['kng_id']?>/<?=$value_it['kng_id']?>" class="menulink"><?=$value_it['kng_title']?></a>
            </li>
          <?}?>
          </ul>
        </div>
      </li>
      <?}?>
  
          <li class="has-divider"></li>
   
   <li>
    <a href="<?=$web_site?>/library"  class="menulink"><?=$nav_array['Browse_all_videos']?></a>
  </li>
</ul>
        </span>
    </span>
</nav>
<a id="header-logo" href="<?=$web_site?>" title="首页" data-tag="Header">
    <img src="<?=$web_site?>/images/<?=$web_logo?>">
</a>
</div>
</div>