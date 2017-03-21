<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
<title><?php echo ($page_seo["title"]); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
<meta name = "format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<?php if($apply['Subsite']): ?><base href="<?php echo C('SUBSITE_DOMAIN');?>"/><?php endif; ?>
<script src="../public/js/rem.js"></script>
<script src="../public/js/zepto.min.js"></script>
<script>
	var qscms = {
		base : "<?php echo C('SUBSITE_DOMAIN');?>",
		domain : "http://<?php echo ($_SERVER['HTTP_HOST']); ?>",
		root : "/index.php",
		companyRepeat:"<?php echo C('qscms_company_repeat');?>",
		is_subsite : <?php if($apply['Subsite'] and C('SUBSITE_VAL.s_id') > 0): ?>1<?php else: ?>0<?php endif; ?>,
		subsite_level : "<?php echo C('SUBSITE_VAL.s_level');?>",
        smsTatus: "<?php echo C('qscms_sms_open');?>"
	};
	if (!!window.ActiveXObject || "ActiveXObject" in window) {
		window.location.href = '<?php echo U('Index/compatibility');?>';
	}
</script>
<link rel="stylesheet" href="../public/css/common.css">
		<link rel="stylesheet" href="../public/css/members.css">
	</head>
	<body>
        <div class="headernavfixed">
  <div class="headernav font18">
    <div class="title">
      <?php echo ((isset($page_seo["header_title"]) && ($page_seo["header_title"] !== ""))?($page_seo["header_title"]):"无标题"); ?>
      <div class="return js-back for-event"></div>
    <div class="rbtn for-event"></div>
    </div>
  </div>
	<div class="qspageso link_gray6">
  <div class="topbg">
		 <input value="<?php echo (urldecode(urldecode($_GET['key']))); ?>" type="text" class="soimput" id="J_soinput" placeholder="请输入关键字"/>
    	<div class="soselect qs-relative for-event">
		    <span class="for-type-txt"> <?php if($search_type == 'resume' or strtolower(CONTROLLER_NAME) == 'resume'): ?>搜简历<?php else: ?>搜职位<?php endif; ?></span>
		    <input type="hidden" class="for-type-code" id="search_type" name="search_type" value="<?php if(!empty($search_type)): echo ($search_type); else: if(strtolower(CONTROLLER_NAME) == 'resume'): ?>resume<?php else: ?>jobs<?php endif; endif; ?>">
	    </div>
	    <div class="so-close js-so-close"></div>
      <div class="rightbtn for-event cancel" id="J_submit">取消</div>
		  <!-- <div class="rightbtn-so for-event">搜索</div> -->
	  <div class="choose-s-type-group">
		  <div class="choose-s-type-cell qs-relative">
			  <div class="qs-center <?php if($search_type == 'jobs'): ?>qs-relative<?php endif; ?>"><div class="choose-s-type-list font14" data-code="jobs" data-title="职位">职位</div></div>
			  <div class="qs-center <?php if($search_type == 'resume'): ?>qs-relative<?php endif; ?>"><div class="choose-s-type-list sl2 font14" data-code="resume" data-title="简历">简历</div></div>
		  </div>
	  </div>
  </div>
  <div class="history"></div>
  
  <div class="clearkey  for-event" id="J_cleanhistory" style="display:none;">清空关键字</div>
  
  
  <div class="split-block"></div>
  
  <div class="sohot font12 link_gray6">
  <div class="hottitle font14 ">热门职位</div>
  <?php $tag_hotword_class = new \Common\qscmstag\hotwordTag(array('列表名'=>'hotword_list','显示数目'=>'12','cache'=>'0','type'=>'run',));$hotword_list = $tag_hotword_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"","keywords"=>"","description"=>"","header_title"=>""),$hotword_list);?>
		<?php if(is_array($hotword_list)): $i = 0; $__LIST__ = $hotword_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hotword): $mod = ($i % 2 );++$i; if(C('qscms_key_urlencode') == 1): ?><a href="<?php echo url_rewrite('QS_jobslist',array('key'=>urlencode($hotword['w_word_code'])));?>" class="hotword substring for-event"><?php echo ($hotword["w_word"]); ?></a>
    <?php else: ?>
    <a href="<?php echo url_rewrite('QS_jobslist',array('key'=>$hotword['w_word_code']));?>" class="hotword substring for-event"><?php echo ($hotword["w_word"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
  <div class="clear"></div>
  <script src="../public/js/zepto.cookie.min.js"></script>
	  <script>
		  $('.js-so-close').on('click', function () {
			  $(this).closest('.topbg').find('.soimput').val('');
			  $('#J_submit').addClass('rightbtn');
			  $('#J_submit').removeClass('rightbtn-so');
			  $('#J_submit').addClass('cancel');
			  $('#J_submit').html('取消');
		  })
    if($('#J_soinput').val()){
      $('#J_submit').addClass('rightbtn-so');
      $('#J_submit').removeClass('rightbtn');
      $('#J_submit').removeClass('cancel');
      $('#J_submit').html('搜索');
    }
    get_history($('.history'));
    function get_history(d){
      var b = "", hlength = 0;
      var searchHistoryArr = new Array();
      if ($.fn.cookie("searchHistory")) {
        searchHistoryArr = $.fn.cookie("searchHistory").split(",");
      };
      if (searchHistoryArr.length == 0) {
        d.hide();
        return false
      }
      $.each(searchHistoryArr.reverse(), function(index, val) {
        hlength += 1;
        b += '<div class="record"><div class="keyimg history_go" data-self="'+val+'">'+val+'</div><div class="delimg close for-event"></div><div class="clear"></div></div>';
      });
      if (hlength > 0) {
        d.empty().html(b);
        $("#J_cleanhistory").show();
        $(".history_go").on("click", function() {
          searchGo($(this).data("self"));
        });
        $(".record .close").on("click", function() {
          var searchHistoryArr = $.fn.cookie("searchHistory").split(","),
            val = $(this).prev().data("self"),
            index = $.inArray(val,searchHistoryArr);
          if (index >= 0) {
            searchHistoryArr.splice(index,1);
          };
          $.fn.cookie("searchHistory",searchHistoryArr,{ path: '/' });
          $(this).parent().remove();
        });
      } else {
        d.empty();
        $("#J_cleanhistory").hide()
      }
    }
    function add_history(key){
      if (key.length > 0) {
        var searchHistoryArr = new Array();
        if ($.fn.cookie("searchHistory")) {
          searchHistoryArr = $.fn.cookie("searchHistory").split(",");
          var isOnly = true;
          $.each(searchHistoryArr, function(index, val) {
            if (val == key) {
              isOnly = false;
            };
          });
          if (isOnly) {
            if (searchHistoryArr.length >= 5) {
              searchHistoryArr.splice(0,1);
            }
            searchHistoryArr.push(key);
          };
        } else {
          searchHistoryArr.push(key);
        };
        $.fn.cookie("searchHistory",searchHistoryArr,{ path: '/' });
      }
    }
    function searchGo(key) {
      add_history(key);
      var search_type = $('#search_type').val();
      if(search_type=='jobs'){
        var url = qscms.root+"?m=Mobile&c=Jobs&a=index&key="+encodeURI(encodeURI(key));
      }else{
        var url = qscms.root+"?m=Mobile&c=Resume&a=index&key="+encodeURI(encodeURI(key));
      }
      window.location.href=url;
    }
		  $('.topbg .soselect').on('click', function () {
			  $('.topbg').toggleClass('for-type');
		  })
		  $('.choose-s-type-cell .qs-center').on('click', function () {
			  var stypeCode = $(this).find('.choose-s-type-list').data('code');
		  	var stypeTitle = $(this).find('.choose-s-type-list').data('title');
			  $('.for-type-code').val(stypeCode);
		  	$('.for-type-txt').text('搜' + stypeTitle);
			  $('.topbg').toggleClass('for-type');
		  });
      $('#J_submit').on('click',function(){
        if($(this).hasClass('cancel')){
          searchGo('');
        }else{
          searchGo($('#J_soinput').val());
        }
      });
      $("#J_cleanhistory").on("click", function() {
        $(this).hide();
        $(".history").hide();
        $.fn.cookie('searchHistory', null,{ path: '/' });
      });
      $('#J_soinput').on('keyup',function(){
        if($(this).val()!=''){
          $('#J_submit').addClass('rightbtn-so');
          $('#J_submit').removeClass('rightbtn');
          $('#J_submit').removeClass('cancel');
          $('#J_submit').html('搜索');
        }else{
          $('#J_submit').addClass('rightbtn');
          $('#J_submit').removeClass('rightbtn-so');
          $('#J_submit').addClass('cancel');
          $('#J_submit').html('取消');
        }
      });
      $('.hotword').on('click',function(){
        add_history($(this).text());
        window.location.href=$(this).attr('href');
        return false;
      });
	  </script>
</div>
</div>
<!--未登录显示以下 -->
<?php if(!C('visitor')): ?><div class="t-mask"></div>
    <div class="topnavshow">
	    
	  <div class="navlis">
	  	<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_index');?>'">
		  <div class="imgbox"><img src="../public/images/198.png" /></div>
		  <div class="tit">返回首页</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo U('Members/login');?>'">
		  <div class="imgbox"><img src="../public/images/192.png" /></div>
		  <div class="tit">登录/注册</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_jobslist');?>'">
		  <div class="imgbox"><img src="../public/images/197.png" /></div>
		  <div class="tit">找工作</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_resumelist');?>'">
		  <div class="imgbox"><img src="../public/images/196.png" /></div>
		  <div class="tit">招人才</div>
		</div>
		<?php if(!empty($apply['Jobfair'])): ?><div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_jobfairlist');?>'">
			<div class="imgbox"><img src="../public/images/199.png" /></div>
			<div class="tit">招聘会</div>
		</div><?php endif; ?>
		<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_newslist');?>'">
		  <div class="imgbox"><img src="../public/images/202.png" /></div>
		  <div class="tit">职场资讯</div>
		</div>
		<div class="clear"></div>
	  </div>
	  
      <div class="h-navclose qs-center"><div class="navclose"></div></div>
    </div>
<?php elseif(C('visitor.utype') == 1): ?>	
<!--企业已登录显示 -->
	<div class="t-mask"></div>
    <div class="topnavshow">
	   
	  <div class="navlis">
	  	<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_index');?>'">
		  <div class="imgbox"><img src="../public/images/198.png" /></div>
		  <div class="tit">返回首页</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo U('Company/index');?>'">
		  <div class="imgbox"><img src="../public/images/192.png" /></div>
		  <div class="tit">企业中心</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_resumelist');?>'">
			<div class="imgbox"><img src="../public/images/196.png" /></div>
			<div class="tit">搜索简历</div>
		</div>
		<div class="topnav" id='J_jobs_add_top'>
		  <div class="imgbox"><img src="../public/images/191.png" /></div>
		  <div class="tit">发布职位</div>
		</div>
		<div class="topnav" id="refresh_jobs_all_top">
		  <div class="imgbox"><img src="../public/images/195.png" /></div>
		  <div class="tit">一键刷新</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo U('Company/jobs_apply');?>'">
		  <div class="imgbox"><img src="../public/images/194.png" /></div>
		  <div class="tit">收到的简历</div>
		</div>
		<div class="clear"></div>
	  </div>
	  
      <div class="logout">
	    <div class="outbtn for-event">退出登录</div>
	  </div>
	    <div class="h-navclose qs-center"><div class="navclose"></div></div>
    </div>	
	

<?php else: ?>
<!--个人已登录显示 -->
	<div class="t-mask"></div>
   <div class="topnavshow">
	  <div class="navlis">
	  	<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_index');?>'">
		  <div class="imgbox"><img src="../public/images/198.png" /></div>
		  <div class="tit">返回首页</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo U('Personal/index');?>'">
		  <div class="imgbox"><img src="../public/images/192.png" /></div>
		  <div class="tit">个人中心</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_jobslist');?>'">
		  <div class="imgbox"><img src="../public/images/197.png" /></div>
		  <div class="tit">搜索职位</div>
		</div>
		<div class="topnav" id="preview_resume_top" pid="<?php echo ($resume['id']); ?>">
		  <div class="imgbox"><img src="../public/images/200.png" /></div>
		  <div class="tit">预览简历</div>
		</div>
		<div class="topnav" id="refresh_resume_top" pid="<?php echo ($resume['id']); ?>">
		  <div class="imgbox"><img src="../public/images/195.png" /></div>
		  <div class="tit">一键刷新</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo U('Personal/jobs_interview');?>'">
		  <div class="imgbox"><img src="../public/images/193.png" /></div>
		  <div class="tit">面试通知</div>
		</div>
		<div class="clear"></div>
	  </div>
	  
      <div class="logout">
	    <div class="outbtn for-event">退出登录</div>
	  </div>
	   <div class="h-navclose qs-center"><div class="navclose"></div></div>
    </div><?php endif; ?>
	<!--搜搜层 -->
</div>
        <?php if(C('qscms_sms_open') == 1): ?><div class="qs-top-nav x2 list_height">
                <div class="n-cell" onclick="javascript:location.href='<?php echo U('Members/register',array('utype'=>2,'regtype'=>'mobile','openid'=>$openid));?>'">手机注册<div class="b-line"></div></div>
                <div class="n-cell active">邮箱注册<div class="b-line"></div></div>
                <div class="clear"></div>
            </div><?php endif; ?>
        <div class="split-block"></div>
        <form id="registerForm" method="post">
            <div class="loging-input-group">
                <div class="group-list">
                    <input id="username" name="username" type="text" class="l-input font14" placeholder="请输入用户名" autocomplete="off">
                </div>
                <div class="group-list email">
                    <input id="email" name="email" type="text" class="l-input font14" placeholder="请输入常用邮箱" autocomplete="off">
                </div>
                <div class="group-list pwd">
                    <input id="emailpassword" name="emailpassword" type="password" class="l-input font14" placeholder="请输入账户密码" autocomplete="off">
                </div>
                <div class="group-list pwd">
                    <input id="emailpasswordVerify" name="emailpasswordVerify" type="password" class="l-input font14" placeholder="请确认账户密码" autocomplete="off">
                </div>
            </div>
            <div class="split-block"></div>
            <div class="btn-spacing btn-spacing-nmb"><a id="btnRegPersonal" href="javascript:;" class="qs-btn qs-btn-blue font18">注册个人会员</a></div>
            <input type="hidden" name="reg_type" value="2" />
            <input type="hidden" name="utype" value="2">
            <div id="pop" style="display:none"></div>
        </form>
        <div class="r-link-box qs-center link_blue"><a href="<?php echo U('members/login');?>">已有账号，立即登录</a></div>
		
 
<div class="qsfooter link_gray6">
  <div class="fnav font12">
  		<div class="flist"><a href="<?php echo U('members/login');?>">会员中心</a></div>
		<div class="flist link_yellow"><a href="javascript:;">触屏端</a></div>
		<div class="flist"><a href="<?php echo C('qscms_site_domain');?>?org=m">电脑版</a></div>
		<div class="flist last"><a href="javascript:;">手机APP</a></div>
		<div class="clear"></div>
  </div>
  <div class="txt font10">©www.74cms.com&nbsp;&nbsp;&nbsp;&nbsp;电话：<?php echo C('qscms_bootom_tel');?> &nbsp;&nbsp;&nbsp;&nbsp;ICP：<?php echo C('qscms_icp');?></div>
</div>
        <!--<?php if(C('qscms_footer_nav_status') == 1): ?><div class="bottom-nav-bar-group">
  	<div class="bottom-nav-bar">
  		<div class="nav-bar-cell qs-left">
  			<a href="" class="bar-cell index active">
  				<div class="b-img"></div>
  				<div class="b-txt font12">首页</div>
  			</a>
  			<a href="" class="bar-cell job">
  				<div class="b-img"></div>
  				<div class="b-txt font12">工作</div>
  			</a>
  			<div class="clear"></div>
  		</div>
  		<div class="nav-bar-more qs-left for-event">
  			<div class="nav-bar-more-cell js-b-nav-bar"></div>
  		</div>
  		<div class="nav-bar-cell qs-left">
  			<a href="" class="bar-cell resume">
  				<div class="b-img"></div>
  				<div class="b-txt font12">人才</div>
  			</a>
  			<a href="" class="bar-cell mine">
  				<div class="b-img"></div>
  				<div class="b-txt font12">我的</div>
  			</a>
  			<div class="clear"></div>
  		</div>
  		<div class="clear"></div>
  	</div>
  	<div class="bottom-bar-more-group">
  		<div class="bn-mask js-b-nav-bar-active"></div>
  		<div class="bar-more-cell">
  			<div id="hwslider-bottom" class="hwslider">
  				<ul>
  					<li>
  						<a href="<?php echo U('Jobs/index');?>"><dl class="l1"><dt class="job for-event"></dt><dd class="font14">找工作</dd></dl></a>
  						<a href="<?php echo U('Resume/index');?>"><dl class="l1"><dt class="resume for-event"></dt><dd class="font14">找人才</dd></dl></a>
  						<a href="<?php echo U('members/login');?>"><dl class="l1"><dt class="fabu for-event"></dt><dd class="font14">发布</dd></dl></a>
  						<div class="clear"></div>
  					</li>
  					<li>
  						<a href=""><dl class="l1"><dt class="news for-event"></dt><dd class="font14">资讯</dd></dl></a>
  						<a href=""><dl class="l1"><dt class="shop for-event"></dt><dd class="font14">商城</dd></dl></a>
  						<a href=""><dl class="l1"><dt class="zhaoph for-event"></dt><dd class="font14">招聘会</dd></dl></a>
  						<div class="clear"></div>
  					</li>
  				</ul>
  			</div>
  		</div>
  		<div class="bar-more-closecell js-b-nav-bar-active for-event"></div>
  	</div>
  </div><?php endif; ?>-->
<!--<div class="bottom-fixed" id="backtop">
	<a href="javascript:;" class="gotop"></a>
</div>-->
<script src="../public/js/fastclick.js"></script>
<script>
    window.addEventListener( "load", function() {
        FastClick.attach(document.body);
    }, false );
</script>
<script src="../public/js/qsToast.js"></script>
<script src="../public/js/QSpopout.js"></script>
<script src="../public/js/QSfilter.js"></script>
<script src="../public/js/zepto.hwSlider.js"></script>
<script src="../public/js/scrollTo.js"></script>
<script>
  $('a[href]').click(function(){
      var f = $(this).attr('href');
      var reg = /\#(\w+)/;
      if(reg.test(f)) return !1
  });
  $('.js-back').on('click', function () {
      history.back();
  });
  $('.rbtn').on('click', function() {
	  forCloseNav();
  })
  $('.t-mask').on('click', function () {
	  forCloseNav();
  })
  $('.h-navclose').on('click', function () {
	  forCloseNav();
  })
  function forCloseNav() {
	  if ($('.topnavshow').hasClass('qs-actionsheet-toggle')) {
		  $('.t-mask').hide();
		  $('.topnavshow').removeClass('qs-actionsheet-toggle');
	  } else {
		  $('.t-mask').show();
		  $('.topnavshow').addClass('qs-actionsheet-toggle');
	  }
  }
  /**
   * 监听鼠标
   */
  if ('ontouchstart' in window) {
      $.EVENT_START = 'touchstart';
      $.EVENT_END = 'touchend';
  } else {
      $.EVENT_START = 'mousedown';
      $.EVENT_END = 'mouseup';
  }
  $('.plist-txt, .qs-btn, .for-event').on($.EVENT_START, function() {
      $(this).addClass('eventactive');
  })
  $('.plist-txt, .qs-btn, .for-event').on($.EVENT_END, function() {
      $(this).removeClass('eventactive');
  })
  //顶部刷新职位
  $('#refresh_jobs_all_top').on('click',function(){
      $.getJSON("<?php echo U('Company/jobs_refresh_all');?>",function(result){
        forCloseNav();
        if(result.status==1){
          qsToast({type:1,context: result.msg});
        }
        else if(result.status==2){
          var dialog = new QSpopout('批量刷新职位');
              dialog.setContent(result.msg);
              dialog.setBtn(2, ['取消', '单条刷新']);
              dialog.show();
              dialog.getPrimaryBtn().on('click', function () {
                  window.location.href = "<?php echo U('company/jobs_list');?>";
              });
        }else{
          qsToast({type:2,context: result.msg});
          return false;
        }
      });
  });
  //顶部刷新简历
  $('#refresh_resume_top').on('click',function(){
    var pid = $(this).attr('pid');
      $.post("<?php echo U('Personal/refresh_resume');?>",{pid:pid},function(result){
        forCloseNav();
      if(result.status == 1){
        if(result.data){
          qsToast({type:1,context: '刷新简历增加'+result.data+'<?php echo C('qscms_points_byname');?>'});
        }else{
          qsToast({type:2,context: result.msg});
          return false;
        }
      }else{
        qsToast({type:2,context: result.msg});
        return false;
      }
    },'json');
  });
  //顶部预览简历
  $('#preview_resume_top').on('click',function(){
    $.getJSON("<?php echo U('Personal/resume_preview');?>",function(result){
      if(result.status == 1){
        window.location.href=result.data;
      }else{
        forCloseNav();
        qsToast({type:2,context:result.msg});
      }
    });
  });
  $('.logout').on('click', function () {
        var dialog = new QSpopout();
        dialog.setContent('确定退出吗？');
        forCloseNav();
        dialog.show();
        dialog.getPrimaryBtn().on('click', function () {
            window.location.href = "<?php echo U('Members/logout');?>";
        });
    });
   //顶部发布职位
   $('#J_jobs_add_top').on('click',function(){
    $.getJSON("<?php echo U('Company/check_jobs_num');?>",function(result){
      if(result.status==1){
        var dialog = new QSpopout();
        var free = result.data;
        if(free==1){
            dialog.setContent('<div class="dialog_notice nospace">您当前是免费会员，发布中的职位数已超过最大限制，升级VIP会员后可继续发布职位，建议您立即升级VIP会员！</div>');
        }else{
            dialog.setContent('<div class="dialog_notice nospace">当前显示的职位已超过最大限制，建议您立即升级服务套餐或将暂时不招聘的职位设为关闭！</div>');
        }
        forCloseNav();
        dialog.show();
        dialog.setBtn(2, ['取消', '升级套餐']);
        dialog.getPrimaryBtn().on('click', function () {
            window.location.href = "<?php echo U('CompanyService/setmeal_add');?>";
        });
      }else{
        window.location.href="<?php echo U('Company/jobs_add');?>";
      }
    });
   });
	// 处理select
  $('select').on('change', function () {
	  $(this).prev().text($(this).find('option').not(function(){ return !this.selected }).text());
  })
  $('select').each(function () {
	  $(this).prev().text($(this).find('option').not(function(){ return !this.selected }).text());
  })
	// 底部导航栏
	$('.js-b-nav-bar').on('click', function () {
		$(this).closest('.bottom-nav-bar-group').find('.bottom-bar-more-group').fadeIn(200);
	})
  $('.js-b-nav-bar-active').on('click', function () {
	  $(this).closest('.bottom-nav-bar-group').find('.bottom-bar-more-group').fadeOut(200);
  })
  $("#hwslider-bottom").hwSlider({
	  autoPlay: false,
	  dotShow: true,
	  touch: true,
	  arrShow: false
  });

  /**
   * 返回顶部
   */
  var global = {
	  h:$(window).height(),
	  st: $(window).scrollTop(),
	  backTop:function(){
		  global.st > (global.h*0.5) ? $("#backtop").show() : $("#backtop").hide();
	  }
  }
  global.backTop();
  $(window).scroll(function(){
	  global.h = $(window).height();
	  global.st = $(window).scrollTop();
	  global.backTop();
  });
  $(window).resize(function(){
	  global.h = $(window).height();
	  global.st = $(window).scrollTop();
	  global.backTop();
  })
  $("#backtop").on('click', function () {
	  $("body").scrollTo({toT: 0});
  })
</script>
<?php echo htmlspecialchars_decode(C('qscms_mobile_statistics'));?>
        <script src="http://static.geetest.com/static/tools/gt.js"></script>
	</body>
    <script>
        /**
         * 配置极验
         */
        $.ajax({
            url: qscms.root+'?m=Mobile&c=Captcha&type=mobile&t=' + (new Date()).getTime(),
            type: 'get',
            dataType: 'json',
            success: function(config) {
                initGeetest({
                    gt: config.gt,
                    challenge: config.challenge,
                    offline: !config.success
                }, function(captchaObj) {
                    captchaObj.appendTo("#pop");
                    captchaObj.onSuccess(function() {
                        doAjax();
                    });
                    window.captchaObj = captchaObj
                });
            }
        });

        /**
         * ajax 提交注册信息
         */
        function doAjax() {
            var url = "<?php echo U('members/register');?>";
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: $('#registerForm').serialize(),
                success: function (data) {
                    if(data.status==1){
                        window.location.href = data.data.url;
                    }else{
                        qsToast({type:2,context: data.msg});
                    }
                }
            });
        }

        var regularEmail = /^[_\.0-9a-zA-Z-]+[_0-9a-zA-Z-]@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,3}$/;

        /**
         * 注册验证
         */
        $('#btnRegPersonal').on('click', function() {
            var configVarifyReg = <?php if(C('qscms_mobile_captcha_open') == 1 and C('qscms_wap_captcha_config.varify_reg') == 1): ?>1<?php else: ?>0<?php endif; ?>;// 后台是否开启注册验证
            var usernameValue = $.trim($('input[name=username]').val());
            var emailValue = $.trim($('input[name=email]').val());
            var emailpasswordValue = $.trim($('input[name=emailpassword]').val());
            var emailpasswordVerifyValue = $.trim($('input[name=emailpasswordVerify]').val());
            if (usernameValue == '') {
                qsToast({type:2,context: '请输入用户名'});
                return false;
            }
            if (!inputRegValiUsername(usernameValue)) {
                qsToast({type:2,context: '用户名中英文开头6-18位，无特殊符号'});
                return false;
            }
            if(!remoteValid('username',usernameValue)){
                qsToast({type:2,context: '该用户名已被注册'});
                return false;
            }
            if (emailValue == '') {
                qsToast({type:2,context: '请输入常用邮箱'});
                return false;
            }
            if(!inputRegValiEmail(emailValue)){
                qsToast({type:2,context: '邮箱格式错误'});
                return false;
            }
            if(!remoteValid('email',emailValue)){
                qsToast({type:2,context: '该邮箱已被注册'});
                return false;
            }
            if (emailpasswordValue == '') {
                qsToast({type:2,context: '请输入密码'});
                return false;
            }
            if(!inputRegValiPassword(emailpasswordValue)){
                qsToast({type:2,context: '密码长度要求为6-16个字符'});
                return false;
            }
            if (emailpasswordVerifyValue == '') {
                qsToast({type:2,context: '请确认账户密码'});
                return false;
            }
            if(!inputRegValiPassword(emailpasswordVerifyValue)){
                qsToast({type:2,context: '密码长度要求为6-16个字符'});
                return false;
            }
            if(!inputRegValiPasswordRepeat(emailpasswordValue,emailpasswordVerifyValue)){
                qsToast({type:2,context: '两次输入的密码不一致'});
                return false;
            }
            if (eval(configVarifyReg)) {
                window.captchaObj.refresh();
                $('#pop').show();
            } else {
                doAjax();
            }
        })

        /**
         * 验证用户名
         * @param value 用户名
         * @returns {boolean}
         */
        function inputRegValiUsername(value){
            var regularUsername = /^(?=[\u4e00-\u9fa5a-zA-Z])(?!\d+)[\u4e00-\u9fa5\w.]{6,18}$/;
            var achoice = true;
            if (!regularUsername.test(value)) {
                achoice = false;
            }
            return achoice;
        }

        /**
         * 验证邮箱
         * @param value 邮箱
         * @returns {boolean}
         */
        function inputRegValiEmail(value){
            var regularEmail = /^[_\.0-9a-zA-Z-]+[_0-9a-zA-Z-]@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,3}$/;
            var achoice = true;
            if (!regularEmail.test(value)) {
                achoice = false;
            }
            return achoice;
        }

        /**
         * 验证用户名等是否重复
         * @param validType 验证类型
         * @param validValue 值
         * @returns {boolean|*}
         */
        function remoteValid(validType, validValue){
            var result = false;
            $.ajax({
                url: "<?php echo U('members/ajax_check');?>",
                cache: false,
                async: false,
                type: 'post',
                dataType: 'json',
                data: { type: validType, param: validValue },
                success: function(json) {
                    if (json && json.status) {
                        result = true;
                    } else {
                        result = false;
                    }
                }
            });
            return result;
        }

        /**
         * 验证密码长度
         * @param value 密码
         * @returns {boolean}
         */
        function inputRegValiPassword(value){
            achoice = true;
            if(value.length>16 || value.length<6){
                achoice = false;
            }
            return achoice;
        }

        /**
         * 验证密码两次输入是否一致
         * @param password 第一次密码
         * @param passwordRepeat 第二次密码
         * @returns {boolean}
         */
        function inputRegValiPasswordRepeat(password,passwordRepeat){
            achoice = true;
            if(password!=passwordRepeat){
                achoice = false;
            }
            return achoice;
        }
    </script>
</html>