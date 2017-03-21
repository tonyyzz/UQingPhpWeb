<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo ($page_seo["title"]); ?></title>
<meta name="keywords" content="<?php echo ($page_seo["keywords"]); ?>"/>
<meta name="description" content="<?php echo ($page_seo["description"]); ?>"/>
<meta name="author" content="骑士CMS"/>
<meta name="copyright" content="74cms.com"/>
<?php if($apply['Subsite']): ?><base href="<?php echo C('SUBSITE_DOMAIN');?>"/><?php endif; ?>
<link rel="shortcut icon" href="<?php echo C('qscms_site_dir');?>favicon.ico"/>
<script src="__HOMEPUBLIC__/js/jquery.min.js"></script>
<script type="text/javascript">
	var app_spell = "<?php echo APP_SPELL;?>";
	var qscms = {
		base : "<?php echo C('SUBSITE_DOMAIN');?>",
		keyUrlencode:"<?php echo C('qscms_key_urlencode');?>",
		domain : "http://<?php echo ($_SERVER['HTTP_HOST']); ?>",
		root : "/index.php",
		companyRepeat:"<?php echo C('qscms_company_repeat');?>",
		is_subsite : <?php if($apply['Subsite'] and C('SUBSITE_VAL.s_id') > 0): ?>1<?php else: ?>0<?php endif; ?>,
		subsite_level : "<?php echo C('SUBSITE_VAL.s_level');?>",
		smsTatus: "<?php echo C('qscms_sms_open');?>"
	};
	$(function(){
		$.getJSON("<?php echo U('Home/AjaxCommon/get_header_min');?>",function(result){
			if(result.status == 1){
				$('#J_header').html(result.data.html);
			}
		});
	})
</script>
	<link href="../public/css/common.css" rel="stylesheet" type="text/css" />
	<link href="../public/css/m.css" rel="stylesheet" type="text/css" />
	<?php $tag_load_class = new \Common\qscmstag\loadTag(array('type'=>'category','cache'=>'0','列表名'=>'list',));$list = $tag_load_class->category();?>
</head>
<body>
<div class="header_min" id="header">
	<div class="header_min_top">
		<div id="J_header" class="itopl font_gray6 link_gray6">
			<span class="link_yellow">欢迎登录<?php echo C('qscms_site_name');?>！请 <a href="<?php echo U('home/members/login');?>">登录</a> 或 <a href="<?php echo U('home/members/register');?>">免费注册</a></span>
		</div>
		<div class="itopr font_gray9 link_gray6 substring"> <a href="/" class="home">网站首页</a>|<a href="<?php echo url_rewrite('QS_m');?>" class="m">手机访问</a>|<a href="<?php echo url_rewrite('QS_help');?>" class="help">帮助中心</a>|<?php if(!empty($apply['Mall'])): ?><a href="<?php echo url_rewrite('QS_mall_index');?>" class="shop"><?php echo C("qscms_points_byname");?>商城</a>|<?php endif; ?><a href="<?php echo U('Home/Index/shortcut');?>" class="last">保存到桌面</a> </div>
	    <div class="clear"></div>
	</div>
</div>
<div id="mobile-header">
    <div class="container clearfix">
        <div class="m-logo f-left"><a class="f-left" href="/"><img src="<?php if(C('qscms_logo_home')): echo attach(C('qscms_logo_home'),'resource'); else: ?>../public/images/logo.gif<?php endif; ?>" border="0"></a><a href="/" class="back-index f-left"></a></div>
        <ul class="mobile-nav f-right">
            <li <?php if($type == 'android' || $type == ''): ?>class="active"<?php endif; ?>><a href="<?php echo url_rewrite('QS_m');?>">安卓版</a></li>
            <li <?php if($type == 'ios'): ?>class="active"<?php endif; ?>><a href="<?php echo url_rewrite('QS_m',array('type'=>'ios'));?>">苹果版</a></li>
            <li <?php if($type == 'touch'): ?>class="active"<?php endif; ?>><a href="<?php echo url_rewrite('QS_m',array('type'=>'touch'));?>">触屏版</a></li>
            <li class="last <?php if($type == 'weixin'): ?>active<?php endif; ?>"><a href="<?php echo url_rewrite('QS_m',array('type'=>'weixin'));?>">微信版</a></li>
        </ul>
    </div>
</div>
<div id="banner-block">
    <div class="banner-wrap android">
        <div class="container">
            <div class="a-text-wrap">
                <h1>好工作，尽在您的手机里</h1>
                <h3>全新的交互体验  轻轻松松找工作</h3>
                <div class="down-code clearfix">
                    <a href="<?php echo ($android_download_url); ?>" class="f-left android-download"></a>
                    <div class="down-code-box f-left">
                        <img src="<?php echo C('qscms_site_dir');?>index.php?m=Home&c=Qrcode&a=index&url=<?php echo urlencode($android_download_url);?>" alt="二维码" width="100" height="100" />
                        <p>手机扫一扫，下载APP</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mobile-app-sp container clearfix">
    <div class="mobile-app-item f-left">
        <div class="ma-icon icon-one"></div>
        <h4>淘人才</h4>
        <p>快捷搜索人才简历库</p>
        <p>智能匹配合适的人才简历</p>
    </div>
    <div class="mobile-app-item f-left">
        <div class="ma-icon icon-two"></div>
        <h4>摇一摇</h4>
        <p>轻松摇出附近</p>
        <p>的职位信息，方便快捷</p>
    </div>
    <div class="mobile-app-item f-left">
        <div class="ma-icon icon-three"></div>
        <h4>地图搜索</h4>
        <p>实时定位，直观地在地</p>
        <p>图上看到该公司所在位置</p>
    </div>
    <div class="mobile-app-item f-left">
        <div class="ma-icon icon-four"></div>
        <h4>消息推送</h4>
        <p>实时接受最新招聘信</p>
        <p>息、求职动态，高效便捷</p>
    </div>
</div>
<div class="m-main">
    <div class="m-row odd">
        <div class="container clearfix">
            <div class="row-left-text f-left">
                <h2>搜职位</h2>
                <p>支持多种职位搜索条件，便捷的求职平<br />台，为求职者提供最大的职位选择空间。</p>
            </div>
            <div class="row-right-box f-right">
                <div class="phone-block android-phone">
                    <div class="app-img"><img src="../public/images/179.jpg" alt="" /></div>
                </div>
                <div class="enlarge-block"></div>
            </div>
        </div>
    </div>
    <div class="m-row">
        <div class="container clearfix">
            <div class="row-left-img f-left">
                <img src="../public/images/180.png" alt="" />
            </div>
            <div class="row-right-text f-right">
                <h2>创简历</h2>
                <p>个人会员发布简历，让企业找到您的简历，<br />畅快体验手机找工作的高效快捷。</p>
            </div>
        </div>
    </div>
    <div class="m-row odd">
        <div class="container clearfix">
            <div class="row-left-text f-left">
                <h2>发职位</h2>
                <p>实现掌上智能注册会员发布相关职位，即使<br />不在电脑旁，也能随时随地实现人才招聘。</p>
            </div>
            <div class="row-right-box f-right">
                <div class="phone-block android-phone">
                    <div class="app-img"><img src="../public/images/181.jpg" alt="" /></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer_min" id="footer">
	<div class="links link_gray6">
	<a target="_blank" href="<?php echo url_rewrite('QS_index');?>">网站首页</a>   
	<?php $tag_explain_list_class = new \Common\qscmstag\explain_listTag(array('列表名'=>'list','cache'=>'0','type'=>'run',));$list = $tag_explain_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"手机频道 - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$list);?>
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>|   <a target="_blank" href="<?php echo ($vo['url']); ?>"><?php echo ($vo['title']); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
	|   <a target="_blank" href="<?php echo url_rewrite('QS_suggest');?>">意见建议</a> 
	</div>
	<div class="txt">
		
		联系地址：<?php echo C('qscms_address');?>      联系电话：<?php echo C('qscms_bootom_tel');?><br />
		
		<?php echo C('qscms_bottom_other');?>     <?php echo C('qscms_icp');?>
		<?php echo htmlspecialchars_decode(C('qscms_statistics'));?>
		
	</div>
</div>

<div class="">
	<div class=""></div>
</div>
<!--[if lt IE 9]>
	<script type="text/javascript" src="__HOMEPUBLIC__/js/PIE.js"></script>
  <script type="text/javascript">
    (function($){
        $.pie = function(name, v){
            // 如果没有加载 PIE 则直接终止
            if (! PIE) return false;
            // 是否 jQuery 对象或者选择器名称
            var obj = typeof name == 'object' ? name : $(name);
            // 指定运行插件的 IE 浏览器版本
            var version = 9;
            // 未指定则默认使用 ie10 以下全兼容模式
            if (typeof v != 'number' && v < 9) {
                version = v;
            }
            // 可对指定的多个 jQuery 对象进行样式兼容
            if ($.browser.msie && obj.size() > 0) {
                if ($.browser.version*1 <= version*1) {
                    obj.each(function(){
                        PIE.attach(this);
                    });
                }
            }
        }
    })(jQuery);
    if ($.browser.msie) {
      $.pie('.pie_about');
    };
  </script>
<![endif]-->
<script type="text/javascript" src="__HOMEPUBLIC__/js/jquery.disappear.tooltip.js"></script>
<div class="floatmenu">
  <div class="item mobile">
    <a class="blk"></a>
    <div class="popover popover1">
      <div class="popover-bd">
        <label>手机APP</label>
        <span class="img-qrcode img-qrcode-mobile"><img src="<?php echo U('Home/Qrcode/index',array('url'=>C('qscms_android_download')));?>" alt=""></span>
      </div>
    </div>
    <div class="popover">
      <div class="popover-bd">
        <label class="wx">企业微信</label>
        <span class="img-qrcode img-qrcode-wechat"><img src="<?php echo attach(C('qscms_weixin_img'),'resource');?>" alt=""></span>
      </div>
      <div class="popover-arr"></div>
    </div>
  </div>
  <div class="item ask">
    <a class="blk" target="_blank" href="<?php echo url_rewrite('QS_suggest');?>"></a>
  </div>
  <div id="backtop" class="item backtop" style="display: none;"><a class="blk"></a></div>
</div>
<SCRIPT LANGUAGE="JavaScript">

var global = {
    h:$(window).height(),
    st: $(window).scrollTop(),
    backTop:function(){
      global.st > (global.h*0.5) ? $("#backtop").show() : $("#backtop").hide();
    }
  }
  $('#backtop').on('click',function(){
    $("html,body").animate({"scrollTop":0},500);
  });
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
</SCRIPT>
</body>
</html>