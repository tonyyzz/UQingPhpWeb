<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<?php $tag_news_category_class = new \Common\qscmstag\news_categoryTag(array('列表名'=>'info','资讯小类'=>$_GET['id'],'cache'=>'0','type'=>'run',));$info = $tag_news_category_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"资讯列表 - 骑士人才系统","keywords"=>"","description"=>"","header_title"=>"资讯列表"),$info);?>
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
    <link rel="stylesheet" href="../public/css/news.css">
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
  <?php $tag_hotword_class = new \Common\qscmstag\hotwordTag(array('列表名'=>'hotword_list','显示数目'=>'12','cache'=>'0','type'=>'run',));$hotword_list = $tag_hotword_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"资讯列表 - 骑士人才系统","keywords"=>"","description"=>"","header_title"=>"资讯列表"),$hotword_list);?>
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
<div class="news-top-menu-bar">
	<div class="top-menu">
		<div class="top-menu-list">
			<a data-url="" href="<?php echo url_rewrite('QS_newslist');?>" class="t-btn <?php if($_GET['id']== ''): ?>active font16<?php endif; ?>">热点推荐</a>
			<?php $tag_news_category_class = new \Common\qscmstag\news_categoryTag(array('列表名'=>'category','显示数目'=>'7','资讯大类'=>'1','cache'=>'0','type'=>'run',));$category = $tag_news_category_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"资讯列表 - 骑士人才系统","keywords"=>"","description"=>"","header_title"=>"资讯列表"),$category);?>
			<?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a data-url="" href="<?php echo url_rewrite('QS_newslist',array('id'=>$vo['id']));?>" class="t-btn <?php if($_GET['id']== $vo['id']): ?>active font16<?php endif; ?>"><?php echo ($vo['title_']); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>
</div>
<div class="split-block"></div>
<?php $tag_news_list_class = new \Common\qscmstag\news_listTag(array('列表名'=>'list','关键字'=>$_GET['key'],'分页显示'=>'1','资讯小类'=>$_GET['id'],'排序'=>'addtime:desc','填补字符'=>'…','摘要长度'=>'200','cache'=>'0','type'=>'run',));$list = $tag_news_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"资讯列表 - 骑士人才系统","keywords"=>"","description"=>"","header_title"=>"资讯列表"),$list);?>
<?php if(!empty($list['list'])): if(is_array($list['list'])): $i = 0; $__LIST__ = $list['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="news-list-item for-event" onclick="window.location='<?php echo ($vo["url"]); ?>'">
    <div class="news-info">
        <div class="thumbnail">
            <img src="<?php echo ($vo['img']); ?>?<?php echo time();?>" border="0" />
        </div>
        <div class="info">
            <div class="line-one substring"><?php echo ($vo['title']); ?></div>
            <div class="line-two font12 substring">
                <div class="pic time"><?php echo date('Y-m-d',$vo['addtime']);?></div>
                <div class="pic page-views"><?php echo ($vo['click']); ?></div>
            </div>
            <div class="line-three font12"><?php echo ($vo['briefly']); ?></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="list-split-block"></div><?php endforeach; endif; else: echo "" ;endif; ?>
<div class="qspage"><?php echo ($list['page']); ?></div>
<?php else: ?>
    <div class="list-empty link_blue">
        抱歉，暂时没有找到相关资讯！
    </div><?php endif; ?>
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
</body>
</html>