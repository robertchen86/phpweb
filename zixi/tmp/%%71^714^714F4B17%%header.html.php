<?php /* Smarty version 2.6.26, created on 2013-12-15 20:02:48
         compiled from header.html */ ?>
<noscript>
    <div class="noscript-warning">
    <p><i class="icon-warning-sign"></i> 请在你的浏览器中启用JavaScript。</p>
    </div>
</noscript>    
    <div id="top-header-container">
      <div id="top-header" class="new">
        <span id="page_auth">
        	<div id="search-box">
        <form class="page-search" action="<?php echo $this->_tpl_vars['web_site']; ?>
/search" method="post" name='searchForm'>
            <input id="search-input" type="text" placeholder="输入关键词回车搜索" name="search_query" value="" class="ui-corner-all placeholder simple-input search-input blur-on-esc ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
            <!--<input type="submit" value=" " class="search-submit">
            <i class="icon-search"></i>-->
        </form>
         </div>
        
        
    <span id="user-info">
    	<?php if ($this->_tpl_vars['member'] == ''): ?>
    	<a class="nav-link sign-in-link" href="<?php echo $this->_tpl_vars['web_site']; ?>
/login">登&nbsp;录</a>
    	<a class="sign-up-link" href="<?php echo $this->_tpl_vars['web_site']; ?>
/signup" >注&nbsp;册</a>
    	<?php else: ?>
    	<span class="dropdown" id='userspan'>
      <span class="username_and_notification dropdown-toggle" data-hasdropdownbehavior="true">
        <a href="javascript:userinfoDisplay('userspan');" class="nav-link2 show-demo-dialog">
        	<!--<img class="user-avatar" src="/images/avatars/leaf-green.png">-->
        	<span class="user-name"><?php echo $this->_tpl_vars['member']; ?>
</span>
        	<i class="icon-chevron-down"></i>
        </a>
      </span>
    <ul class="dropdown-menu no-submenus">
      <a class="hover-card-link show-demo-dialog" href="<?php echo $this->_tpl_vars['web_site']; ?>
/profile/<?php echo $this->_tpl_vars['member_identity_type']; ?>
/<?php echo $this->_tpl_vars['membercode']; ?>
/" >
        <div class="hover-card-container ">
          <div class="hover-card-content-container">
            <div class="hover-card-content clearfix">
              <div class="avatar-pic-container">
                <img src="<?php if ($this->_tpl_vars['member_logo'] == ''): ?><?php echo $this->_tpl_vars['web_site']; ?>
/images/dflogo.png<?php else: ?><?php echo $this->_tpl_vars['web_site']; ?>
/images/mlogo/<?php echo $this->_tpl_vars['member_logo']; ?>
<?php endif; ?>" style="width: 50px; height: 50px;">
              </div>
              <div class="user-info">
                <span class="nickname">
                  <a class="profile-link" href="<?php echo $this->_tpl_vars['web_site']; ?>
/profile/<?php echo $this->_tpl_vars['member_identity_type']; ?>
/<?php echo $this->_tpl_vars['membercode']; ?>
/"><?php echo $this->_tpl_vars['member']; ?>
</a>
                </span>
                <div class="badge-container"></div>
              </div>
              <div class="user-stats">
                <div class="points"><span class="points-label">已观看</span><span style="font-size: 150%"><?php if ($this->_tpl_vars['v_videos'] == ''): ?>0<?php else: ?><?php echo $this->_tpl_vars['v_videos']; ?>
<?php endif; ?></span> <span class="points-label">个视频</span></div>
                <div class="join-date">总观看次数<abbr class="timeago" ><?php if ($this->_tpl_vars['v_times'] == ''): ?>0<?php else: ?><?php echo $this->_tpl_vars['v_times']; ?>
<?php endif; ?></abbr></div>
              </div>
            </div>
          </div>
        </div>
      </a>
      <div class="user-dropdown-controls clearfix">
            <a class="simple-button right-control" href="<?php echo $this->_tpl_vars['web_site']; ?>
/profile/<?php echo $this->_tpl_vars['member_identity_type']; ?>
/<?php echo $this->_tpl_vars['membercode']; ?>
/">个人中心</a>
            <a id="page_logout" class="simple-button left-control" href="<?php echo $this->_tpl_vars['web_site']; ?>
/logout">注销</a>
      </div>
    </ul>
      </span>
      <?php endif; ?>
    </span><!--user-info-->
    </span>
    <nav class="sitewide-navigation">
      <span class="links nav-subheader">
        <span class="dropdown topic-browser-dropdown">
          <a class="watch-link dropdown-toggle show-demo-dialog" data-hasdropdownbehavior="true"  id='watch-link'><?php echo $this->_tpl_vars['nav_array']['Learn']; ?>
 <i class="icon-chevron-down"></i></a>
          <div style="clear: both"></div>
          <ul class="topic-browser-menu dropdown-menu new none-active" data-role="listview" data-inset="true" >
          <li>
            <a href="<?php echo $this->_tpl_vars['web_site']; ?>
" class="menulink"><?php echo $this->_tpl_vars['nav_array']['Home']; ?>
</a>
          </li>
          <!--<li>
            <a href="https://www.khanacademy.org/exercisedashboard" class="menulink"><?php echo $this->_tpl_vars['nav_array']['Knowledge_Map']; ?>
</a>
          </li>-->
          <li class="has-divider"></li>
    <?php $_from = $this->_tpl_vars['nav_kng_result']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['kngitem']):
?>
      <li class="level0 has-submenu ">
        <a data-tag="TopicBrowserPulldown" class="menulink"><?php echo $this->_tpl_vars['kngitem']['kng_title']; ?>

        <i class="icon-chevron-right"></i>
        </a>
        <div class="dropdown-menu no-submenus sub-menu-custom domain-color" >
          <div class="submenu-title"><?php echo $this->_tpl_vars['kngitem']['kng_title']; ?>
</div>
          <ul class="clearfix">
          <?php $_from = $this->_tpl_vars['kngitem']['kng_items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['kngim']):
?>
            <li class="level1">
            	
              <a href="<?php echo $this->_tpl_vars['web_site']; ?>
/kng/<?php echo $this->_tpl_vars['kngitem']['kng_id']; ?>
/<?php echo $this->_tpl_vars['kngim']['kng_id']; ?>
" class="menulink"><?php echo $this->_tpl_vars['kngim']['kng_title']; ?>
</a>
              
            </li>
          <?php endforeach; endif; unset($_from); ?>
          </ul>
        </div>
      </li>
    <?php endforeach; endif; unset($_from); ?>
  
          <li class="has-divider"></li>
    <!--<li >
        <a href="https://www.khanacademy.org/talks-and-interviews" data-tag="TopicBrowserPulldown" class="menulink"><?php echo $this->_tpl_vars['nav_array']['Talks_and_Interviews']; ?>
</a>
    </li>
      <li >
        <a href="https://www.khanacademy.org/coach-res" data-tag="TopicBrowserPulldown" class="menulink"><?php echo $this->_tpl_vars['nav_array']['Coach_Resources']; ?>
</a>
      </li>-->
   <li>
    <a href="<?php echo $this->_tpl_vars['web_site']; ?>
/library"  class="menulink"><?php echo $this->_tpl_vars['nav_array']['Browse_all_videos']; ?>
</a>
  </li>
</ul>
        </span>
    </span>
</nav>
<a id="header-logo" href="<?php echo $this->_tpl_vars['web_site']; ?>
" title="首页" data-tag="Header">
    <img src="<?php echo $this->_tpl_vars['web_site']; ?>
/images/<?php echo $this->_tpl_vars['web_logo']; ?>
">
</a>
</div>
</div>