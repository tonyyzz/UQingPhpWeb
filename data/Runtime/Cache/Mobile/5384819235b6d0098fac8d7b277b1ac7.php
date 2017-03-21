<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<?php $tag_resume_show_class = new \Common\qscmstag\resume_showTag(array('列表名'=>'info','简历id'=>$_GET['id'],'cache'=>'0','type'=>'run',));$info = $tag_resume_show_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"简历详情 - 骑士人才系统","keywords"=>"","description"=>"","header_title"=>"简历详情"),$info);?>
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
    <link rel="stylesheet" href="../public/css/resume.css">
</head>
<body>


<div class="retop">
  <div class="topbg">  
    <div class="return js-back for-event"></div>
    <?php if($info['preview'] == 0): ?><div id="j_favor" class="attention font14 favor <?php if(($info['favor']) == "1"): ?>has<?php else: endif; ?>"><?php if(($info['favor']) == "1"): ?>已收藏<?php else: ?>收藏<?php endif; ?></div><?php endif; ?>
    <div class="logobox"><img src="<?php echo ($info['photosrc']); ?>"></div>
  </div>
  
  <div class="com">
  	<div class="cname font16">
		<?php echo ($info['fullname']); ?>
		<?php if($info['strong_tag']): ?><span class="gold font10"><?php echo ($info['strong_tag']); ?></span><?php endif; ?>
	</div>
    <div class="txt font14"><?php echo ($info['sex_cn']); ?> | <?php echo ($info['age']); ?>岁 | <?php echo ($info['education_cn']); ?> | <?php echo ($info['experience_cn']); ?>工作经验</div>
  </div>
  
  <div class="bg"></div>
</div>

<div class="split-block"></div>


<div class="reintent">
 <div class="eattitle list_height">求职意向</div>



 <div class="tit">求职状态</div>
 <div class="txt"><?php echo ($info['current_cn']); ?></div>
 <div class="clear"></div>
 
 <div class="tit">工作性质</div>
 <div class="txt"><?php echo ($info['nature_cn']); ?></div>
 <div class="clear"></div>
 
  <div class="tit">期望行业</div>
 <div class="txt"><?php if($info['trade_cn']): echo ($info['trade_cn']); else: ?>不限<?php endif; ?></div>
 <div class="clear"></div>
 
 <div class="tit">期望职位</div>
 <div class="txt"><?php echo ($info['intention_jobs']); ?></div>
 <div class="clear"></div>
 
  <div class="tit">期望地区</div>
 <div class="txt"><?php echo ($info['district_cn']); ?></div>
 <div class="clear"></div>

  <div class="tit">期望薪资</div>
 <div class="txt"><?php echo ($info['wage_cn']); ?></div>
 <div class="clear"></div>
</div>



<div class="split-block"></div>

<div class="rebasic">
<div class="eattitle list_height">联系方式</div>
 <?php if($info['telephone']): ?><div class="txt substring"><span>手机</span><?php echo ($info['telephone']); if(!$info['show_contact']): ?><u class="downbtn font12">[下载后查看]</u><?php endif; ?></div><?php endif; ?>
<?php if($info['email']): ?><div class="txt substring"><span>邮箱</span><?php echo ($info['email']); if(!$info['show_contact']): ?><u class="downbtn font12">[下载后查看]</u><?php endif; ?></div><?php endif; ?>
</div>

<?php if($info['tag_cn']): ?><div class="split-block"></div>
<div class="retag font13">
<div class="eattitle list_height">特长标签</div>
  <div class="tagul">
  <?php if(is_array($info['tag_cn'])): $i = 0; $__LIST__ = $info['tag_cn'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="tagli substring"><?php echo ($vo); ?></div><?php endforeach; endif; else: echo "" ;endif; ?>
	<div class="clear"></div>
  </div>
</div><?php endif; ?>
<?php if($info['specialty']): ?><div class="split-block"></div>
<div class="redes">
  <div class="eattitle list_height">自我描述</div> 
  <div class="txt"><?php echo ($info['specialty']); ?></div>
</div><?php endif; ?>

<?php if($info['education_list']): ?><div class="split-block"></div>
	<div class="reedu">
		<div class="eattitle list_height">教育经历
			<div class="ritle font12"><?php echo count($info['education_list']);?>段教育经历</div>
		</div>
		<div class="edu-list desc">
			<?php if(is_array($info['education_list'])): $i = 0; $__LIST__ = $info['education_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="works <?php if($key == count($info['education_list'])-1): ?>last<?php endif; ?>">
				<div class="cname substring"><?php echo ($vo['school']); ?><span class="font13">[<?php echo ($vo['duration']); ?>]</span></div>
				<div class="jname substring font13"><?php echo ($vo['startyear']); ?>.<?php echo ($vo['startmonth']); ?>
				<?php if(($vo['todate']) == "1"): ?>至今
					<?php else: ?>
					- <?php echo ($vo['endyear']); ?>.<?php echo ($vo['endmonth']); endif; ?> | <?php echo ($vo['education_cn']); ?> | <?php echo ($vo['speciality']); ?>
				</div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<?php if(count($info['education_list']) > 1): ?><div class="more">
			<div class="showbtn font12 ">展开信息</div>
			<!--<div class="showbtn font12 topbtn">收起信息</div> -->
		</div><?php endif; ?>

	</div><?php endif; ?>

<?php if($info['work_list']): ?><div class="split-block"></div>
	<div class="rework">
		<div class="eattitle list_height">工作经验
		  <div class="ritle font12"><?php echo ($info['work_duration']); ?>做了<?php echo ($info['work_count']); ?>份工作</div>
		</div>
		<div class="work-list <?php if(count($info['work_list']) > 1): ?>desc<?php endif; ?>">
			<?php if(is_array($info['work_list'])): $i = 0; $__LIST__ = $info['work_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="works <?php if($key == count($info['work_list'])-1): ?>last<?php endif; ?>">
			  	<div class="cname substring"><?php echo ($vo['companyname']); ?><span class="font13">[<?php echo ($vo['duration']); ?>]</span></div>
			  	<div class="jname substring">
				  	<span class="font13">
				  	<?php echo ($vo['startyear']); ?>.<?php echo ($vo['startmonth']); ?>
				  	<?php if(($vo['todate']) == "1"): ?>至今
				  	<?php else: ?>
				  		- <?php echo ($vo['endyear']); ?>.<?php echo ($vo['endmonth']); endif; ?>
				  	 | <?php echo ($vo['jobs']); ?>
					</span>
			  	</div>
			  	<div class="wtxt font13"><?php echo ($vo['achievements']); ?></div>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<?php if(count($info['work_list']) > 1): ?><div class="more">
			<div class="showbtn font12 ">展开信息</div>
			<!--<div class="showbtn font12 topbtn">收起信息</div> -->
		</div><?php endif; ?>
	</div><?php endif; ?>

<?php if($info['training_list']): ?><div class="split-block"></div>
	<div class="retra">
		<div class="eattitle list_height">培训经历
		  	<div class="ritle font12"><?php echo count($info['training_list']);?>段培训经历</div>
		</div>
		<div class="training-list <?php if(count($info['training_list']) > 1): ?>desc<?php endif; ?>">
		<?php if(is_array($info['training_list'])): $i = 0; $__LIST__ = $info['training_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="works <?php if($key == count($info['training_list'])-1): ?>last<?php endif; ?>">
		  		<div class="cname substring"><?php echo ($vo['agency']); ?><span class="font13">[<?php echo ($vo['duration']); ?>]</span></div>
		  		<div class="jname substring font13">
					<span>
						<?php echo ($vo['startyear']); ?>.<?php echo ($vo['startmonth']); ?>
						<?php if(($vo['todate']) == "1"): ?>至今
						<?php else: ?>
						 - <?php echo ($vo['endyear']); ?>.<?php echo ($vo['endmonth']); endif; ?> | <?php echo ($vo['course']); ?>
			  		</span>
				</div>
		  		<div class="wtxt font13"><?php echo ($vo['description']); ?></div>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<?php if(count($info['training_list']) > 1): ?><div class="more">
			<div class="showbtn font12 ">展开信息</div>
			<!--<div class="showbtn font12 topbtn">收起信息</div> -->
	  	</div><?php endif; ?>
	</div><?php endif; ?>

<?php if($info['credent_list']): ?><div class="split-block"></div>
<div class="recer">
	<div class="eattitle list_height">获得证书
	</div>
	<?php if(is_array($info['credent_list'])): $i = 0; $__LIST__ = $info['credent_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="lists">
	  <div class="cname"><?php echo ($vo['name']); ?><span><?php echo ($vo['year']); ?>年<?php echo ($vo['month']); ?>月获得</span></div>
	</div><?php endforeach; endif; else: echo "" ;endif; ?>	
</div><?php endif; ?>

<?php if($info['language_list']): ?><div class="split-block"></div>
<div class="relang">
	<div class="eattitle list_height">语言能力</div>
	<div class="tagul">
	<?php if(is_array($info['language_list'])): $i = 0; $__LIST__ = $info['language_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="tagli"><?php echo ($vo['language_cn']); ?><span><?php echo ($vo['level_cn']); ?></span></div><?php endforeach; endif; else: echo "" ;endif; ?>
	<div class="clear"></div>
  </div>
</div><?php endif; ?>

<?php if($info['img_list']): ?><div class="split-block"></div>
<div class="reimg">
  <div class="eattitle list_height">照片作品</div> 
  <div class="scrollbox">
  	<?php if(is_array($info['img_list'])): $i = 0; $__LIST__ = $info['img_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="imgbox"><img src="<?php echo ($vo['img']); ?>"></div><?php endforeach; endif; else: echo "" ;endif; ?>
  </div>
</div><?php endif; ?>

<?php if(($info['preview']) == "0"): ?><div class="split-block-footnav"></div>
<div class="refootnav">
		<div class="btns link_gray6">
		<?php if($info['show_contact'] && C('visitor.utype') == 1): ?><div class="qs-btn qs-btn-medium qs-btn-blue qs-btn-inline invitebtn" onClick="javascript:location.href='<?php echo U('AjaxCompany/jobs_interview_add',array('id'=>$info['id']));?>'">邀请面试</div>
		<?php else: ?>
		  <div class="qs-btn qs-btn-medium qs-btn-blue qs-btn-inline downbtn">下载简历</div><?php endif; ?>
		  <a id="J_tel" class="tel font9" href="tel:<?php echo ($info['telephone_']); ?>" utype="<?php echo ($visitor["utype"]); ?>" <?php if(!$info['show_contact']): ?>type="1"<?php endif; ?>>
		  	<img src="../public/images/130.png"><br>拨打电话
		  </a>
		<div style="display:none">
			<input type="hidden" class="label_img_1_0" value="../public/images/212.png">
			<input type="hidden" class="label_img_1_1" value="../public/images/213.png">
			<input type="hidden" class="label_img_1_2" value="../public/images/216.png">
			<input type="hidden" class="label_img_1_3" value="../public/images/215.png">
			<input type="hidden" class="label_img_2_0" value="../public/images/212.png">
			<input type="hidden" class="label_img_2_1" value="../public/images/213.png">
			<input type="hidden" class="label_img_2_2" value="../public/images/215.png">
			<input type="hidden" class="label_img_2_3" value="../public/images/214.png">
			<input type="hidden" class="label_img_2_4" value="../public/images/216.png">
		</div>
		<?php if($info['label_resume']): ?><div class="fov font9 label_resume">
		<?php if(!$info['label_id']): ?><img class="label_img" src="../public/images/212.png"><?php endif; ?>
		<?php if(($info['label_type']) == "1"): if($info['label_id'] == 1): ?><img class="label_img" src="../public/images/213.png"><?php endif; ?>
			<?php if($info['label_id'] == 2): ?><img class="label_img" src="../public/images/216.png"><?php endif; ?>
			<?php if($info['label_id'] == 3): ?><img class="label_img" src="../public/images/215.png"><?php endif; endif; ?>
		<?php if(($info['label_type']) == "2"): if($info['label_id'] == 1): ?><img class="label_img" src="../public/images/213.png"><?php endif; ?>
			<?php if($info['label_id'] == 2): ?><img class="label_img" src="../public/images/215.png"><?php endif; ?>
			<?php if($info['label_id'] == 3): ?><img class="label_img" src="../public/images/214.png"><?php endif; ?>
			<?php if($info['label_id'] == 4): ?><img class="label_img" src="../public/images/216.png"><?php endif; endif; ?>
			<br>
			<div class="for-select">请标记</div>
			<select label_type="<?php echo ($info['label_type']); ?>" id="J_label_resume">
				<option disabled value="0" <?php if(0 == $info['label_id']): ?>data-status="1" selected<?php else: ?>data-status="0"<?php endif; ?>>请标记</option>
				<?php if(is_array($info['label_arr'])): $i = 0; $__LIST__ = $info['label_arr'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if($key == $info['label_id']): ?>data-status="1" selected<?php else: ?>data-status="0"<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
		</div>
		<?php else: ?>
		<div class="fov font9 favor" id="j_favor_bottom">
		<?php if($info['favor']): ?><img src="../public/images/175.png"><br>已收藏
	      <?php else: ?>
	      <img src="../public/images/131.png"><br>收藏简历<?php endif; ?>
		</div><?php endif; ?>
  </div>
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
<script src="../public/js/imageScrool.js"></script>
<script type="text/javascript">
var isVisitor = "<?php echo C('visitor.uid');?>";
var utype = "<?php echo C('visitor.utype');?>";
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
		// 加入人才库
		$(".favor").on('click',function(){
			var url = "<?php echo U('AjaxCompany/resume_favor');?>";
			var rid = "<?php echo ($info['id']); ?>";
			if ((isVisitor > 0)) {
				if(utype != 1){
		          qsToast({type:2,context: '请登录企业会员'});
		          return false;
		        }
				$.getJSON(url,{rid:rid},function(result){
					if(result.status==1){
						qsToast({type:1,context: result.msg});
						if(result.data=='has'){
			              $('#j_favor_bottom').html('<img src="../public/images/131.png"><br>收藏简历');
			              $('#j_favor').html('收藏');
			            }else{
			              $('#j_favor_bottom').html('<img src="../public/images/175.png"><br>已收藏');
			              $('#j_favor').html('已收藏');
			            }
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
		// 下载简历
		$(".downbtn").on('click',function(){
			var url = "<?php echo U('AjaxCompany/resume_down');?>";
			var rid = "<?php echo ($info['id']); ?>";
			if ((isVisitor > 0)) {
				if(utype != 1){
		          qsToast({type:2,context: '请登录企业会员'});
		          return false;
		        }
				$.getJSON("<?php echo U('AjaxCompany/resume_down_confirm');?>",{rid:rid},function(data){
					if(data.status==1){
						var dialog = new QSpopout();
			            dialog.setContent(data.msg);
			            if(data.data=='no'){
			            	dialog.setBtn(1,'确定');
			            }
			            else if(data.data=='mix'){
			            	dialog.setBtn(1,'取消');
			            }else{
			            	dialog.getPrimaryBtn().on('click', function () {
				                $.getJSON(url,{rid:rid},function(result){
									if(result.status==1){
										qsToast({type:1,context: result.msg});
										setTimeout(function(){
											window.location.reload();
										},2000);
									} else {
										qsToast({type:2,context: result.msg});
										return false;
									}
								});
				            });
			            }
			            dialog.show();
					}else{
						qsToast({type:2,context: data.msg});
					}
				});
			} else {
				window.location.href="<?php echo U('members/login');?>";
        		return false;
			}
		});
		$("#J_label_resume").on('change',function(){
			var thisObj = $(this);
			var label = thisObj.val();
			var label_type = thisObj.attr('label_type');
			var url = "<?php echo U('AjaxCompany/resume_label');?>";
			var resume_id = "<?php echo ($info['id']); ?>";
			var jobs_id = "<?php echo ($_GET['jobs_id']); ?>";
			$.getJSON(url,{resume_id:resume_id,label:label,label_type:label_type,jobs_id:jobs_id},function(result){
				if(result.status == 1){
					$('.label_img').attr('src',$('.label_img_'+label_type+'_'+label).val());
					qsToast({type:1,context: result.msg});
				}else{
					qsToast({type:2,context: result.msg});
					return false;
				}
			});
		});
		$('select').find('option').each(function () {
			if (eval($(this).data('status'))) {
				$('select').prev().text($('select').find('option').not(function(){ return !this.selected }).text());
				return false;
			} else {
				$('select').prev().text('请标记');
			}
		});
		$('#J_tel').on('click',function(){
			if (!isVisitor) {
				window.location.href="<?php echo U('members/login');?>";
				return false;
			}
			if($(this).attr('utype') != 1){
				qsToast({type:2,context: '请登录企业帐号！'});
				return false;
			}
			if($(this).attr('type') == 1){
				qsToast({type:2,context: '请先下载简历！'});
				return false;
			}
		});
</script>
</body>
</html>