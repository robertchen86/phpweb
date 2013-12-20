<?php /* Smarty version 2.6.26, created on 2013-12-15 21:39:06
         compiled from video.html */ ?>
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
/css/com.css">
  <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['web_site']; ?>
/css/header.css">
  <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['web_site']; ?>
/css/video.css">
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/jquery-1.9.1.min.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/jquery.menu-aim.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/com.js"></script>
  <script src="<?php echo $this->_tpl_vars['web_site']; ?>
/js/video.js"></script>

<style>
    #page_sub_nav </style>

</head>
<!--[if lt IE 7]>  <body class="ie ie6 lte9 lte8 lte7"> <![endif]-->
<!--[if IE 7]>     <body class="ie ie7 lte9 lte8 lte7"> <![endif]-->
<!--[if IE 8]>     <body class="ie ie8 lte9 lte8"> <![endif]-->
<!--[if IE 9]>     <body class="ie ie9 lte9"> <![endif]-->
<!--[if gt IE 9]>  <body  > <![endif]-->
<!--[if !IE]>
<!--> <body data-twttr-rendered="true"  ><!--<![endif]-->
<div id="outer-wrapper" class="clearfix new-header">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--内容-->
<div id="page-container">
    <div id="page-container-inner">

<article id="tutorial-page">
    <div class="tutorial-nav docked-nav" data-khan-nav="true">
    	<div class="nav-container affix-top">
    		<div class="nav-container affix-top">
<div class="topic-nav-header math">
    <div class="crumbs">
        <div class="subject subject-color">
           <a href="<?php echo $this->_tpl_vars['web_site']; ?>
/kng/<?php echo $this->_tpl_vars['footKngId']; ?>
/<?php echo $this->_tpl_vars['twoKngId']; ?>
"><?php echo $this->_tpl_vars['twoKng']; ?>
</a>
        </div>
    </div>
    <!--<div class="crumbs">
        <div class="topic topic-color">
            <a href="<?php echo $this->_tpl_vars['web_site']; ?>
/kng/<?php echo $this->_tpl_vars['footKngId']; ?>
/<?php echo $this->_tpl_vars['twoKngId']; ?>
/<?php echo $this->_tpl_vars['threeKngId']; ?>
"><?php echo $this->_tpl_vars['twoKng']; ?>
</a>
        </div>
    </div>
    <div class="crumbs">
        <h2 class="title tutorial-color">
            <?php echo $this->_tpl_vars['video_kng_title']; ?>

        </h2>
    </div>
    <?php if ($this->_tpl_vars['threeKngId'] != $this->_tpl_vars['video_kng_id']): ?>
    <div class="crumbs">
        <h2 class="title tutorial-color">
            <?php echo $this->_tpl_vars['video_kng_title']; ?>

        </h2>
    </div>
    <?php endif; ?>-->
</div>

<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: auto;">
	<div class="topic-nav-content math" data-khan-scroll="true" style="overflow: hidden; width: auto; height: auto;">
    <ol class="core">
      <?php $_from = $this->_tpl_vars['video_l_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['videoitem']):
?>
        <li id="v/basic-addition" class="tutorial-nav-node video-node">
            <a href="<?php echo $this->_tpl_vars['web_site']; ?>
/kng/<?php echo $this->_tpl_vars['footKngId']; ?>
/<?php echo $this->_tpl_vars['twoKngId']; ?>
/video/<?php echo $this->_tpl_vars['videoitem']['video_id']; ?>
" class="tutorial-router-link tab-link  progress-container clearfix <?php if ($this->_tpl_vars['videoitem']['video_id'] == $this->_tpl_vars['videoId']): ?>active<?php endif; ?>">
                <div class="subway-icon v23798">
    <div class="pipe"></div>
    <div class="pipe completed"></div>
    <div class="status <?php if ($this->_tpl_vars['videoitem']['video_id'] == $this->_tpl_vars['videoId']): ?>v23798<?php endif; ?> video-node">
    </div>
</div>

                <span class="progress-title"><?php echo $this->_tpl_vars['videoitem']['video_title']; ?>
</span>
            </a>
        </li>
      <?php endforeach; endif; unset($_from); ?>
    
    </ol>

    
</div><div class="slimScrollBar ui-draggable" style="background-color: rgb(102, 102, 102); width: 8px; position: absolute; top: 0px; opacity: 0.4; display: none; border-top-left-radius: 8px; border-top-right-radius: 8px; border-bottom-right-radius: 8px; border-bottom-left-radius: 8px; z-index: 99; right: 5px; height: 453px;"></div><div class="slimScrollRail" style="width: 8px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 8px; border-top-right-radius: 8px; border-bottom-right-radius: 8px; border-bottom-left-radius: 8px; background-color: rgb(51, 51, 51); opacity: 0.3; z-index: 90; right: 5px; background-position: initial initial; background-repeat: initial initial;"></div><div class="shadow"><img src="./nei4_files/round-shadow.png" style="top: -10px;"></div><div class="shadow bottom"><img src="./nei4_files/round-shadow-bottom.png" style="bottom: -10px; top: auto;"></div><div class="shadow"><img src="/images/round-shadow.png" style="top: -10px;"></div><div class="shadow bottom"><img src="/images/round-shadow-bottom.png" style="bottom: 0px; top: auto;"></div></div>



    </div></div>
    </div>

    <div class="tutorial-content">
      <div class="layers">
            <!--<div class="progress layer">
                <div class="view-progress-bar ui-progressbar ui-widget ui-widget-content ui-corner-all">
                    <div class="ui-progressbar-value ui-widget-header ui-corner-left ui-corner-right"></div>
                </div>
            </div>-->
        <div class="content layer">
          <div class="tutorial-description">
            <div class="progress-stack-view stack"></div>
            <h2 class="title-header">
              <span itemprop="name" class="title desktop-only"><?php echo $this->_tpl_vars['video_title']; ?>

              	<!--<i class="toggle-node-editor content-editor icon-cog" style="display: none;"></i>-->
              </span>
              <span class="long-description" itemprop="description"><?php echo $this->_tpl_vars['video_description']; ?>
</span>
            </h2>
            <!--
            <div class="related-links">
              <a href="https://www.khanacademy.org/exercise/addition_1" class="tutorial-router-link practice simple-button green desktop-only" title="Test your understanding with an exercise">Practice this concept</a>
            </div>
            -->
          </div>
          <div class="tutorial-node-content">
            <div class="video" data-role="page" data-theme="b">
              <!-- 
              <div data-role="header" class="mobile-only">
                <a href="https://www.khanacademy.org/math/arithmetic/addition-subtraction/basic_addition/v/basic-addition#" data-rel="back" data-icon="arrow-l">Back</a>
                <h2 class="video-title">Basic Addition</h2>
                <a href="https://www.khanacademy.org/" data-icon="home" data-iconpos="notext" data-direction="reverse"></a>
              </div>
              -->
              <div >
                <div class="video-container">
                  <!--
                  <div class="video-overlay desktop-only large-font"></div>
                  <div id="youtube_blocked" class="desktop-only"></div>
                  -->
                  <div class="youtube-video">
                    <!-- <link itemprop="thumbnailUrl" href="http://img.youtube.com/vi/AuX7nPBqDts/hqdefault.jpg">-->
                    <div class="player-container">
                    <!--	
                      <embed  id="objpalyer"  src="<?php echo $this->_tpl_vars['video_playerurl']; ?>
" type="application/x-shockwave-flash"   allowscriptaccess="always" allowfullscreen="true" wmode="opaque" width="900" height="450" />
                    --
                    <!--http://cloud.video.taobao.com/play/u/1108946760/e/1/t/1/p/1/10658518.swf-->
                     	<!--http://js.tudouui.com/bin/player_online/as2player_0.swf-->
                     	
                     	<!--http://js.tudouui.com/bin/taobaoisv/TaoBaoPlayer.swf-->
                     <!--  <object  width="900" height="450" data="http://www.tudou.com/v/TK38JyWfcGQ/&autoPlay=true&startSeekPoint=0&videoClickNavigate=false&withAD=false&withSearchBar=false" type="application/x-shockwave-flash">
                     		<param name="allowfullscreen" value="true">
                     		<param name="allowscriptaccess" value="always">
                     		<param name="bgcolor" value="#000000">
                     		<param name="wMode" value="window">
                     		<param name="quality" value="high">
                     		<param name="movie" value="http://www.tudou.com/v/TK38JyWfcGQ/&autoPlay=true&startSeekPoint=0&videoClickNavigate=false&withAD=false&withSearchBar=false">
                     </object>
                     <iframe class="player-if" width="900" height="450" frameborder="0" src="http://www.tudou.com/programs/view/popplayer.action?iid_code=<?php echo $this->_tpl_vars['video_itemCode']; ?>
&playTimePos=0&autoPlay=false"></iframe>
                     -->
                     <embed width="900" height="450" src="http://js.tudouui.com/bin/player2/olc_8.swf?iid=<?php echo $this->_tpl_vars['video_itemId']; ?>
&amp;swfPath=http://js.tudouui.com/bin/lingtong/SocialPlayer_58.swf&amp;
                     tvcCode=-1&amp;tag=%E6%95%B0%E5%88%97&amp;title=<?php echo $this->_tpl_vars['video_title']; ?>
&amp;mediaType=vi&amp;totalTime=725800&amp;
                     hdType=0&amp;hasPassword=0&amp;nWidth=-1&amp;isOriginal=0&amp;channelId=25&amp;nHeight=-1&amp;banPublic=false&amp;videoOwner=118852054&amp;tict=3&amp;
                     channelId=25&amp;cs=&amp;k=%E6%95%B0%E5%88%97&amp;panelRecm=http://css.tudouui.com/bin/lingtong/PanelRecm_9.swz&amp;
                     panelDanmu=http://css.tudouui.com/bin/lingtong/PanelDanmu_1.swz&amp;
                     panelEnd=http://css.tudouui.com/bin/lingtong/PanelEnd_10.swz&amp;pepper=http://css.tudouui.com/bin/binder/pepper_15.png&amp;
                     panelShare=http://css.tudouui.com/bin/lingtong/PanelShare_7.swz&amp;panelCloud=http://css.tudouui.com/bin/lingtong/PanelCloud_8.swz&amp;
                     autoPlay=true&amp;listType=0&amp;rurl=http://www.tudou.com/programs/view/popplayer.action?iid_code=<?php echo $this->_tpl_vars['video_itemCode']; ?>
&amp;
                     playTimePos=0&amp;autoPlay=false&amp;withSearchBar=false+type%3D&amp;startSeekPoint=0&amp;videoClickNavigate=false&amp;withAD=false&amp;
                     autostart=false&amp;snap_pic=<?php echo $this->_tpl_vars['video_picurl']; ?>
&amp;code=<?php echo $this->_tpl_vars['video_itemCode']; ?>
&amp;aopRate=0.001&amp;p2pRate=0.5&amp;
                     adSourceId=81000&amp;yjuid=1372229674496z0q&amp;yseid=1383546138939IO95ld&amp;yseidtimeout=1383557027966&amp;yseidcount=12&amp;uid=118852054&amp;juid=017tvk68uvdv3&amp;vip=0" type="application/x-shockwave-flash">
                     
                    </div>
                   
                       
                  </div>
                </div>
                <!--footd-->
                <div>
                  <span class="video-footer">
        	          <span class="extra-link-bar desktop-only">
        		<!--
      <span class="options dropdown">
    <span class="dropdown-toggle">
        <i class="icon-cog icon-large"></i>
        Options
        <i class="icon-caret-down"></i>
    </span>
    <ul class="dropdown-menu no-submenus">
        
        <li>
            <a class="playback-speed-link" href="#">
                    <i class="icon-time icon-large"></i>
                    Set playback speed
            </a>
        </li>
        
        <li>
            <label class="disabled">
                <input type="checkbox" class="transcript-enable" disabled="">
                Interactive transcript
            </label>
        </li>
        <li>
            <label class="disabled">
                <input type="checkbox" class="subtitles-enable" disabled="">
                Translated subtitles
            </label>
        </li>
        <li>
            <label class="disabled">
                <input type="checkbox" class="socrates-enable" disabled="">
                Embedded questions
            </label>
        </li>
        <li>
            <a title="Download not available" class="download-icon download-link disabled">
                    <i class="icon-download-alt icon-large"></i>
                    Download this video
            </a>
        </li>
        
        <li>
            <a  href="javascript:void 0"
                title="Continuous Play is OFF"
                class="simple-button continuous-play">
                    Continuous Play is OFF
            </a>
        </li>
        
    </ul>
      </span>-->


<!--分享
<span class="share dropdown">
    <span class="dropdown-toggle">
        <i class="icon-share icon-large"></i>
        分享
        <i class="icon-caret-down"></i>
    </span>
    <ul class="dropdown-menu no-submenus">
        <li>
        <a href="javascript:void 0" class="facebookShare">
            <i class="icon-facebook icon-large"></i>
            分享
        </a>
        </li>
        <li>
        <a class="twitterShare" target="_blank" href="http://twitter.com/share?url=http%3A%2F%2Fwww.khanacademy.org%2Fvideo%3Fv%3DAuX7nPBqDts&amp;text=undefined&amp;via=khanacademy">
            <i class="icon-twitter icon-large"></i>
            Tweet
        </a>
        </li>
        <li>
        <a class="emailShare" href="mailto:?Subject=I+just+learned+about+undefined+at+Khan+Academy&amp;Body=You+can+learn+about+it+too.+Check+out+undefined" target="_blank">
            <i class="icon-envelope icon-large"></i>
            Email
        </a>
        </li>
        
        <li>
        <a class="embedShare" href="javascript:void 0">
            <i class="icon-table icon-large"></i>
            Embed
        </a>
        </li>
        
    </ul>
</span>-->


<!--播放次数-->
<span class="points-badge-hover">
	  <div class="video-energy-points" oldtitle="" title="" >
    <?php if ($this->_tpl_vars['member'] != ''): ?><span class="video-energy-points-current"><?php echo $this->_tpl_vars['view_count']; ?>
</span> / <?php endif; ?><?php echo $this->_tpl_vars['view_all_count']; ?>

</div>
</span>

                   </span>
<div class="discussion-container">
<div class="clear"></div>
 <!--留言-->   
<div class="video-discussion">
  <div class="video-discussion-header">
    <ul class="tabrow">
      <li data-type="Leaves" class="tabitem selected tabb0">
        <a href="javascript:void(0);changeselect(0)">留言(<?php echo $this->_tpl_vars['leaves_count']; ?>
)</a>
      </li>
      <li data-type="questions" class="tabitem tabb1">
        <a href="javascript:void(0);changeselect(1)">土豆评论(<?php echo $this->_tpl_vars['totalCount']; ?>
)</a>
      </li>
    </ul>
    <span class="discussion-list-sort">
    <!--<a data-value="1" href="javascript:void(0);">Top 10</a>
    <!--<a data-value="2" title="Most Recent" href="javascript:void(0);" class="selected">Recent</a>
    <input type="button" class="simple-button discussion-list-more" style="display: none;" value="More">-->
    </span>
  </div>
  <!--留言-->
  <div class="tab comments-tab tabdiv0" style="">
  	<div class="post-comments">
    <div class="comment">
    	 <input type="hidden" id="member" value="<?php echo $this->_tpl_vars['member']; ?>
" />
    	<?php if ($this->_tpl_vars['member'] != ''): ?>  
    	  <input type="hidden" id="video_itemCode" value="<?php echo $this->_tpl_vars['video_itemCode']; ?>
" />
    	  <input type="hidden" id="video_id" value="<?php echo $this->_tpl_vars['videoId']; ?>
" />
    	  <input type="hidden" id="post_url" value="<?php echo $this->_tpl_vars['web_site']; ?>
/postcomment" />
    	 	<input type="hidden" id="member_id" value="<?php echo $this->_tpl_vars['member_id']; ?>
" />
    	 	<input type="hidden" id="post_editurl" value="<?php echo $this->_tpl_vars['web_site']; ?>
/editcomment" />
    	 	<input type="hidden" id="post_delturl" value="<?php echo $this->_tpl_vars['web_site']; ?>
/delcomment" />
    	 	<input type="hidden" id="post_playurl" value="<?php echo $this->_tpl_vars['web_site']; ?>
/playlog" />
    	 <?php endif; ?>
        <textarea class="discussion-text text-add " placeholder="<?php if ($this->_tpl_vars['member'] != ''): ?><?php if ($this->_tpl_vars['cur_day_cnt'] == 0): ?>点击在此留言<?php else: ?>亲，您今日对该视频已经留言了！<?php endif; ?><?php else: ?>请先登录再来留言<?php endif; ?>" style="" <?php if ($this->_tpl_vars['member'] != ''): ?><?php if ($this->_tpl_vars['cur_day_cnt'] == 0): ?>onfocus="showinput();" <?php endif; ?><?php endif; ?> <?php if ($this->_tpl_vars['cur_day_cnt'] != 0): ?>readonly<?php endif; ?> ></textarea>
        <div class="discussion-controls controls-add " style="display: none;">
    
    <input class="simple-button primary discussion-cancel cancel-add " type="button" value="&nbsp;取&nbsp;&nbsp;消&nbsp;" tabindex="3" >
    or
    <input class="simple-button primary discussion-submit submit-add " type="button" value="&nbsp;提&nbsp;&nbsp;交&nbsp;" tabindex="2" >
         </div>
    </div>
    </div>
  	<div class="comments">
  	 	<div class="discussion-list">
  	 		<?php if ($this->_tpl_vars['leaves_count'] != 0): ?>
       <div class="discussion-list-content vlists">
       	<?php $_from = $this->_tpl_vars['vcomment_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['vcommentitem']):
?>
       <div class="question-guidelines post-guidelines alert sytlevm <?php if ($this->_tpl_vars['key'] > 9): ?> result-hidden<?php endif; ?>" id='vcitem_<?php echo $this->_tpl_vars['key']; ?>
'>
      	<div class="comment  discussion-item is-author" style="opacity: 1;">
        <div class="item-separator"></div>
        <div class="discussion-meta">
        	<div class="discussion-meta-info">
        		<a class="author-nickname discussion-author" data-hasqtip="true" aria-describedby="qtip-12" href="javascript:void(0);">
                   <!-- <img class="discussion-author-avatar" src="./gunkan3_files/leaf-green.png">-->
                <?php echo $this->_tpl_vars['vcommentitem']['member_name']; ?>

            </a>
            <span class="discussion-meta-faded">:</span>
          </div>
          <?php if ($this->_tpl_vars['member_id'] == $this->_tpl_vars['vcommentitem']['vcomment_member_id']): ?>
          <div class="discussion-meta-controls" id="meta-controls_<?php echo $this->_tpl_vars['key']; ?>
"><input type="hidden" id="vcid_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['vcommentitem']['vcomment_id']; ?>
" >
              <span class="discussion-meta-separator">•</span>
              <span class="mod-tools" >
              <a href="javascript:void(0);showedit(<?php echo $this->_tpl_vars['key']; ?>
)" class="edit">编辑</a>
              <span class="discussion-meta-separator">•</span>
              <a href="javascript:void(0);dodel(<?php echo $this->_tpl_vars['key']; ?>
)" class="delete">删除</a>
              </span>
          </div>
          <?php endif; ?>
        </div>
        <div class="discussion-content " id="discussion-content_<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['vcommentitem']['vcomment_content']; ?>
</div>
        <div class="discussion-meta">
        	 <div class="discussion-meta-time">
        	 	  <span class="discussion-meta-faded" id="meta-faded_<?php echo $this->_tpl_vars['key']; ?>
" ><?php if ($this->_tpl_vars['vcommentitem']['vcomment_uptime'] == ''): ?><?php echo $this->_tpl_vars['vcommentitem']['vcomment_addtime']; ?>
<?php else: ?><?php echo $this->_tpl_vars['vcommentitem']['vcomment_uptime']; ?>
<?php endif; ?></span>
        	 </div>
        </div>
        </div>
        <?php if ($this->_tpl_vars['member'] != ''): ?>
        <textarea class="discussion-text open" id="text-edit_<?php echo $this->_tpl_vars['key']; ?>
"  style="height: 30px;display: none;" tabindex="1" placeholder=""><?php echo $this->_tpl_vars['vcommentitem']['vcomment_content']; ?>
</textarea>
        <div class="discussion-controls "id="discussion-controls_<?php echo $this->_tpl_vars['key']; ?>
"  style="display: none;">
         <input class="simple-button primary discussion-cancel" type="button" value="&nbsp;取&nbsp;&nbsp;消&nbsp;" tabindex="3" onclick="closeedit(<?php echo $this->_tpl_vars['key']; ?>
)">
         &nbsp;&nbsp;&nbsp;&nbsp;
         <input class="simple-button primary discussion-submit" type="button" value="&nbsp;提&nbsp;&nbsp;交&nbsp;" tabindex="2" onclick="postedit(<?php echo $this->_tpl_vars['key']; ?>
)">
        </div>
        <?php endif; ?>



       </div>
       <?php endforeach; endif; unset($_from); ?>
       </div>
       <?php if ($this->_tpl_vars['leaves_count'] > 10): ?>
       <input type="button" class="simple-button discussion-list-more" id='vc_list_more'  value="显示更多..." onclick="showvcoments(<?php echo $this->_tpl_vars['leaves_count']; ?>
)">
       <?php endif; ?>
       <?php endif; ?>
      </div>
     </div>
  </div> 
  <!--土豆评论s-->
  <div class="tab comments-tab tabdiv1" style="display:none;">
  	<div class="comments">
  	 	<div class="discussion-list">
  	 		<?php if ($this->_tpl_vars['totalCount'] != 0): ?>
  	 		  <input type="hidden" id="pageNo" value="1" />
    	    <input type="hidden" id="post_tdurl" value="<?php echo $this->_tpl_vars['web_site']; ?>
/tdpostcomment" />
       <div class="discussion-list-content clists">
       	<?php $_from = $this->_tpl_vars['vm_tudou_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['commentitem']):
?>
       <div class="question-guidelines post-guidelines alert sytlevm " >
      	<div class="comment  discussion-item is-author" style="opacity: 1;">
        <div class="item-separator"></div>
        <div class="discussion-meta">
        	<div class="discussion-meta-info">
        		<a class="author-nickname discussion-author" data-hasqtip="true" aria-describedby="qtip-12" href="javascript:void(0);">
                   <!-- <img class="discussion-author-avatar" src="./gunkan3_files/leaf-green.png">-->
                <?php echo $this->_tpl_vars['commentitem']['nickname']; ?>

            </a>
            <span class="discussion-meta-faded">:</span>
          </div>
          <!--
          <div class="discussion-meta-controls" id="meta-controls_<?php echo $this->_tpl_vars['key']; ?>
"><input type="hidden" id="vcid_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['vcommentitem']['vcomment_id']; ?>
" >
              <span class="discussion-meta-separator">•</span>
              <span class="mod-tools" >
              <a href="javascript:void(0);showedit(<?php echo $this->_tpl_vars['key']; ?>
)" class="edit">编辑</a>
              <span class="discussion-meta-separator">•</span>
              <a href="javascript:void(0);dodel(<?php echo $this->_tpl_vars['key']; ?>
)" class="delete">删除</a>
              </span>
          </div>-->
        </div>
        <div class="discussion-content " ><?php echo $this->_tpl_vars['commentitem']['content']; ?>
</div>
        <div class="discussion-meta">
        	 <div class="discussion-meta-time">
        	 	  <span class="discussion-meta-faded" ><?php echo $this->_tpl_vars['commentitem']['publish_time']; ?>
</span>
        	 </div>
        </div>
        </div>

       </div>
       <?php endforeach; endif; unset($_from); ?>
       </div>
       <?php if ($this->_tpl_vars['totalCount'] > 10): ?>
       <input type="button" class="simple-button discussion-list-more" id='c_list_more'  value="显示更多..." onclick="showcoments()">
       <?php endif; ?>
       <?php endif; ?>
      </div>
     </div>
  </div>
  
  <!--土豆评论e-->
  
</div>
<!--<div><a href="<?php echo $this->_tpl_vars['web_site']; ?>
/exam/<?php echo $this->_tpl_vars['footKngId']; ?>
/<?php echo $this->_tpl_vars['twoKngId']; ?>
/video/<?php echo $this->_tpl_vars['videoId']; ?>
" class="simple-button big-button large-font">测试试题</a></div>-->
<div><a href="<?php echo $this->_tpl_vars['web_site']; ?>
/exam_online/<?php echo $this->_tpl_vars['footKngId']; ?>
/<?php echo $this->_tpl_vars['twoKngId']; ?>
/video/<?php echo $this->_tpl_vars['videoId']; ?>
" class="simple-button big-button large-font">测试试题</a></div>
<div class="discussion-guidelines"></div>

<div class="clear"></div>
</div>    
            </span>
            <div class="clearFloat"></div>
        </div>
    </div>
</div>

<!--
<div id="container" class="exercises-content-container visited-no-recolor " style="overflow:hidden; display: none">
</div>-->


                </div>
            </div>
        </div>
    </div>
</article>

            <div id="end-of-page-spacer">&nbsp;</div>

    </div>
    </div>
<!--neirong end-->

</div>
<div class="push"></div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!-- zixi.org.cn Baidu tongji analytics -->
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F373a5160f96b2e16d6ffc7ced7340f47' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>