<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<?php $tag_company_show_class = new \Common\qscmstag\company_showTag(array('列表名'=>'info','企业id'=>$_GET['id'],'cache'=>'0','type'=>'run',));$info = $tag_company_show_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"企业详情 - 骑士人才系统","keywords"=>"","description"=>"","header_title"=>"企业详情"),$info);?>
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
    <link rel="stylesheet" href="../public/css/jobs.css">
</head>
<body>
 
<div class="comshowtop">
  <div class="topbg">  
    <div class="return js-back for-event"></div>
    <?php if($info['preview'] == 0): ?><div class="attention font14 <?php if(($info['focus']) == "1"): ?>for_cancel<?php else: endif; ?>"><?php if(($info['focus']) == "1"): ?>取消关注<?php else: ?>关注<?php endif; ?></div><?php endif; ?>
    <div class="logobox"><img src="<?php echo ($info['logo']); ?>"></div>
  </div>
  
  
  
  <div class="com">
  	<div class="cname font16"><?php echo ($info['companyname']); ?>
    <?php if($info['audit'] == 1): ?><img src="../public/images/120.png" title="认证企业"><?php endif; ?>
    <?php if($info['setmeal_id'] > 1): ?><img src="../public/images/121.png" title="<?php echo ($info["setmeal_name"]); ?>"><?php endif; ?>
    <?php if($info['famous'] == 1): ?><img src="../public/images/122.png" title="诚聘通企业"></div><?php endif; ?>
	
    <div class="txt font14"><?php echo ($info['nature_cn']); ?> | <?php echo ($info['scale_cn']); ?> | <?php echo ($info['district_cn']); ?></div>
  </div>
</div>


<div class="split-block"></div>
<div class="comshowpor">
<div class="eattitle list_height">
  公司名片
  <div id="J_reply" class="qs-btn qs-btn-blue qs-btn-inline apply_jobs reply">咨询</div>
</div>

<div class="txt substring"><span>规模</span><?php echo ($info['scale_cn']); ?></div>
<div class="txt substring"><span>行业</span><?php echo ($info['trade_cn']); ?></div>
<?php if($info['website']): ?><div class="txt substring"><span>网址</span><?php echo ($info['website_']); ?></div><?php endif; ?>
<div class="txt substring"><span>地址</span><?php echo ($info['address']); ?></div>

</div>

<?php if($info['tag_arr']): ?><div class="split-block"></div>
<div class="comshowtag font13">
<div class="eattitle list_height">公司福利</div>
  <div class="tagul">
  <?php if(is_array($info['tag_arr'])): $i = 0; $__LIST__ = $info['tag_arr'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="tagli substring"><?php echo ($vo); ?></div><?php endforeach; endif; else: echo "" ;endif; ?>
	<div class="clear"></div>
  </div>
</div><?php endif; ?>
<div class="split-block"></div>

<div class="comshowdes">
  <div class="eattitle list_height">公司简介</div> 
  <div class="txt desc"><?php echo ($info['company_profile']); ?></div>
  <div class="more">
  	<div class="showbtn font12 ">展开信息</div>
  	<!--<div class="showbtn font12 topbtn">收起信息</div> -->
  </div>
</div>
<?php if($info['img']): ?><div class="split-block"></div>
<div class="comshowimg">
  <div class="eattitle list_height">企业风采</div> 
  <div class="scrollbox">
    <?php if(is_array($info['img'])): $i = 0; $__LIST__ = $info['img'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="imgbox"><img src="<?php echo ($vo['img']); ?>"></div><?php endforeach; endif; else: echo "" ;endif; ?>
  </div>
    <div class="clear"></div>
</div><?php endif; ?>

<div class="split-block"></div>
<div class="comshowcon">
  <div class="eattitle list_height">
  联系方式
  <?php if(!C('visitor.utype')): ?><div class="ritle font12">请登录后查看联系方式</div><?php endif; ?>
  </div>
  <?php if($info['landline_tel']): ?><div class="tel"><?php echo ($info['landline_tel']); ?></div><?php endif; ?>
  <?php if($info['telephone']): ?><div class="mob"><?php echo ($info['telephone']); ?> (<?php echo ($info['contact']); ?>)</div><?php endif; ?>
  <div class="email"><?php echo ($info['email']); ?></div>
  <div class="map link_blue"><?php echo ($info['address']); ?> <?php if($info['map_x'] > 0 && $info['map_y'] > 0): ?><a class="show-map" href="#map">[地图]</a><?php endif; ?></div>
  <?php if($info['famous'] == 1): ?><div class="tip font12">该企业已加入诚聘通会员，可放心求职</div>
  <?php else: ?>
   <div class="tip font12">面试过程中，遇到用人单位收取费用请提高警惕！</div><?php endif; ?>
  </if>
</div>

<?php $tag_jobs_list_class = new \Common\qscmstag\jobs_listTag(array('列表名'=>'jobs','会员uid'=>$info['uid'],'cache'=>'0','type'=>'run',));$jobs = $tag_jobs_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"企业详情 - 骑士人才系统","keywords"=>"","description"=>"","header_title"=>"企业详情"),$jobs);?>
 <?php if($jobs['list']): ?><div class="split-block"></div>
<div class="comshowrec">
  <div class="eattitle list_height">
  该企业正在招聘
  </div>
 <?php if(is_array($jobs['list'])): $i = 0; $__LIST__ = $jobs['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="jobslist" onclick="javascript:location.href='<?php echo ($vo["jobs_url"]); ?>'">
    <div class="jname font15 link_gray6 substring"><a href="<?php echo ($vo["jobs_url"]); ?>"><?php echo ($vo['jobs_name']); ?></a></div>
	<div class="cname font12"><?php echo ($vo['district_cn']); ?> | <?php echo ($vo['education_cn']); ?> | <?php echo ($vo['experience_cn']); ?></div>
	<div class="wage font13"><?php echo ($vo['wage_cn']); ?></div>
	<div class="time font12"><?php echo ($vo['refreshtime_cn']); ?></div>
  </div><?php endforeach; endif; else: echo "" ;endif; ?>
</div><?php endif; ?>
<div class="split-block"></div>
<script id="tpl-map" type="text/html">
    <!--地图-->
    <div class="headernavfixed">
        <div class="headernav font18"><div class="title">企业位置<div class="return js-back"></div></div></div>
    </div>
    <div class="com-map">
        <div class="map" id="container"></div>
    </div>
    <div class="split-block"></div>
    <div class="btn-spacing">
        <div id="mapBtn" class="qs-btn qs-btn-blue font18" title="返回">返回</div>
    </div>
</script>
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
<script src="../public/js/popWin.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=<?php echo C('qscms_map_ak');?>"></script>
<script src="../public/js/imageScrool.js"></script>
<script type="text/javascript">
      var mapTemp = $('#tpl-map').html();
      $(".show-map").on('click', function() {
          var $this = $(this);
          popWin.init({
              from:"right",
              html:mapTemp,
              handle:function(a){
                var map = new BMap.Map("container");
                var point = new BMap.Point("<?php echo ($info['map_x']); ?>","<?php echo ($info['map_y']); ?>");  // 创建点坐标
                map.centerAndZoom(point, "<?php echo ($info['map_zoom']); ?>");
                var qs_marker = new BMap.Marker(point);        // 创建标注
                map.addOverlay(qs_marker);
                map.setCenter(point);
                map.addControl(new BMap.NavigationControl());//添加鱼骨
                map.enableScrollWheelZoom();//启用滚轮放大缩小，默认禁用。
                $('#mapBtn').on('click',function(){
                    a.close();
                });
              }
          })
      });
  (function(){
  /*
      注意：$.mggScrollImg返回的scrollImg对象上有
              next，prev，go三个方法，可以实现外部对滚动索引的控制。
      如：scrollImg.next();//会切换到下一张图片
          scrollImg.go(0);//会切换到第一张图片
  */
  var scrollImg = $.mggScrollImg('.scrollbox',{
          loop : true,//循环切换
          auto : true//自动切换
      });
  })()
  $.getJSON("<?php echo U('ajaxCommon/company_statistics_add');?>",{comid:"<?php echo ($info['id']); ?>"});
  var isVisitor = "<?php echo C('visitor.uid');?>";
  var utype = "<?php echo C('visitor.utype');?>";
  $('.more').on('click',function(){
    var prev = $(this).prev();
    var child = $(this).children('.showbtn');
    if(prev.hasClass('desc')){
      prev.removeClass('desc');
      child.addClass('topbtn');
      child.html('收起信息');
    }else{
      prev.addClass('desc');
      child.removeClass('topbtn');
      child.html('展开信息');
    }
  });
  // 关注
    $(".attention").on('click',function(){
      var url = "<?php echo U('ajaxPersonal/company_focus');?>";
      var company_id = "<?php echo ($info['id']); ?>";
      var thisObj = $(this);
      if ((isVisitor > 0)) {
        if(utype != 2){
          qsToast({type:2,context: '请登录个人会员'});
          return false;
        }
        $.getJSON(url,{company_id:company_id},function(result){
          if(result.status==1){
            qsToast({type:1,context: result.msg});
            thisObj.html(result.data.html).toggleClass('for_cancel');
          } else {
            qsToast({type:2,context: result.msg});
            return false;
          }
        });
      } else {
        window.location.href="<?php echo U('members/login');?>";
        return false;
      }
    });
    $('#J_reply').on('click',function(){
      if(!isVisitor){
        window.location.href="<?php echo U('members/login');?>";
        return false;
      }
      if(utype != 2){
        qsToast({type:2,context: '请登录个人会员'});
        return false;
      }
      window.location.href="<?php echo U('personal/pms_consult_show',array('uid'=>$info['uid']));?>";
    });
</script>
</body>
</html>