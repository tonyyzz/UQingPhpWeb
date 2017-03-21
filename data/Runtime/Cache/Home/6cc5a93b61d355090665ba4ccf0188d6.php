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
    <link href="../public/css/suggest.css" rel="stylesheet" type="text/css" />
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
<div class="alltop_nav" id="nav">
	<div class="tnav">
  		<div class="tlogo"><a href="/"><img src="<?php if(C('qscms_logo_other')): echo attach(C('qscms_logo_other'),'resource'); else: ?>__HOMEPUBLIC__/images/logo_other.png<?php endif; ?>" border="0"/></a></div>
		<div class="tl">
			<ul class="link_gray6 nowrap">
				<?php $tag_nav_class = new \Common\qscmstag\navTag(array('列表名'=>'nav','调用名称'=>'QS_top','显示数目'=>'10','cache'=>'0','type'=>'run',));$nav = $tag_nav_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"意见/建议","keywords"=>"","description"=>"","header_title"=>""),$nav);?>
				<?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><li class="nli J_hoverbut <?php if(MODULE_NAME == C('DEFAULT_MODULE')): if($nav['tag'] == strtolower(CONTROLLER_NAME)): ?>select<?php endif; else: if($nav['tag'] == strtolower(MODULE_NAME)): ?>select<?php endif; endif; ?>"><a href="<?php echo ($nav['url']); ?>" target="<?php echo ($nav["target"]); ?>"><?php echo ($nav["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<div class="clear"></div>
		</div>
		<div class="tr"></div>
		<div class="clear"></div>
	</div>
</div>
<div class="all_body">
    <div class="suggest_main">
        <div class="suggest_head">您的建议让我们每天变的更好</div>
        <div class="top_tips">用户您好，请将您的意见、想法、建议或投诉内容告诉我们，以帮助我们为全体用户提供更加优质的服务。我们将在第一时间及时回复您的反馈，如您的问题比较紧急，请致电服务热线：<?php echo C('qscms_bootom_tel');?>。</div>
        <div class="suggest_list_group">
            <div class="suggest_list_cell">
                <div class="list_cell_left">意见类型</div>
                <div class="list_cell_right">
                    <div class="suggest_type_cell"><div class="suggest_type selected" data-code="1">建议</div></div>
                    <div class="suggest_type_cell"><div class="suggest_type" data-code="2">意见</div></div>
                    <div class="suggest_type_cell"><div class="suggest_type" data-code="3">求助</div></div>
                    <div class="suggest_type_cell"><div class="suggest_type" data-code="4">投诉</div></div>
                    <div class="clear"></div>
                    <input type="hidden" name="infotype" value="1"  />
                </div>
                <div class="clear"></div>
            </div>
            <div class="suggest_list_cell">
                <div class="list_cell_left">联系方式</div>
                <div class="list_cell_right"><input type="text" class="suggest_input" name="tel" placeholder="请输入您的QQ、邮箱或者电话以便和您沟通，您的信息仅工作人员可见！"></div>
                <div class="clear"></div>
            </div>
            <div class="suggest_list_cell">
                <div class="list_cell_left">反馈内容</div>
                <div class="list_cell_right">
                    <textarea class="suggest_area" id="suggest_feedback" name="feedback" placeholder="请详细描述您遇到的问题，有助于我们快速定位并解决问题"></textarea>
                </div>
                <div class="clear"></div>
            </div>
            <div class="suggest_list_cell">
                <div class="list_cell_left"></div>
                <div class="list_cell_right">
                    <input type="button" class="btn_yellow suggest_btn" id="J_suggest_submit" value="提 交" />
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="J_suggest_verify" value="<?php echo ($varify_suggest); ?>" />
<input type="button" id="btnCheck" style="display:none;">
<div id="popup-captcha"></div>
<div class="footer_min" id="footer">
	<div class="links link_gray6">
	<a target="_blank" href="<?php echo url_rewrite('QS_index');?>">网站首页</a>   
	<?php $tag_explain_list_class = new \Common\qscmstag\explain_listTag(array('列表名'=>'list','cache'=>'0','type'=>'run',));$list = $tag_explain_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"意见/建议","keywords"=>"","description"=>"","header_title"=>""),$list);?>
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
<script src="http://static.geetest.com/static/tools/gt.js"></script>
<script type="text/javascript">
    // 意见类型切换
    $('.suggest_type').click(function(event) {
        $('.suggest_type').each(function(index, el) {
            $(this).removeClass('selected');
        });
        $(this).addClass('selected');
        $('input[name="infotype"]').val($(this).data('code'));
    });
    // 提交验证
    $('#J_suggest_submit').die().live('click', function(event) {
        var typeValue = $.trim($('input[name="infotype"]').val());
        var telValue = $.trim($('input[name="tel"]').val());
        var feedbackValue = $.trim($('#suggest_feedback').val());
        if (typeValue == "") {
            disapperTooltip("remind", "请选择意见类型");
            return false;
        }
        if (telValue == "") {
            disapperTooltip("remind", "请填写联系方式");
            return false;
        }
        if (telValue != "" && telValue.length > 30) {
            disapperTooltip("remind", "联系方式不能超出30个字");
            return false;
        }
        if (feedbackValue == "") {
            disapperTooltip("remind", "请填写反馈内容");
            return false;
        }
        if (eval($('#J_suggest_verify').val())) {console.log('极验');
            $("#btnCheck").click();
        } else {
            $('#J_suggest_submit').val('提 交 中...').addClass('btn_disabled').prop('disabled', !0);
            doSuggestFun();
        }
    });

    function doSuggestFun() {
        var typeValue = $.trim($('input[name="infotype"]').val());
        var telValue = $.trim($('input[name="tel"]').val());
        var feedbackValue = $.trim($('#suggest_feedback').val());
        // 提交表单
        $.ajax({
            url: "<?php echo U('Suggest/index');?>",
            type: 'POST',
            dataType: 'json',
            data: {infotype: typeValue, tel: telValue, feedback: feedbackValue}
        })
        .done(function(data) {
            if (parseInt(data.status)) {
                disapperTooltip("success", data.msg);
                setTimeout(function () {
                    window.location.reload();
                }, 2000);
            } else {
                $('#J_suggest_submit').val('提 交').removeClass('btn_disabled').prop('disabled', 0);
                disapperTooltip("remind", data.msg);
            }
        })
        .fail(function(result) {
            $('#J_suggest_submit').val('提 交').removeClass('btn_disabled').prop('disabled', 0);
            disapperTooltip("remind", result.msg);
        });
    }
    if (eval($('#J_suggest_verify').val())) {console.log(eval($('#J_suggest_verify').val()));
        $.ajax({
            // 获取id，challenge，success（是否启用failback）
            url: qscms.root+'?m=Home&c=Captcha&t=' + (new Date()).getTime(), // 加随机数防止缓存
            type: "get",
            dataType: "json",
            success: function (data) {
                // 使用initGeetest接口
                // 参数1：配置参数
                // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
                initGeetest({
                    gt: data.gt,
                    challenge: data.challenge,
                    product: "popup", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
                    offline: !data.success // 表示用户后台检测极验服务器是否宕机，一般不需要关注
                }, handler);
            }
        });
        var handler = function(captchaObj) {
            captchaObj.appendTo("#popup-captcha");
            captchaObj.bindOn("#btnCheck");
            captchaObj.onSuccess(function() {
                $('#J_suggest_submit').val('提 交 中...').addClass('btn_disabled').prop('disabled', !0);
                doSuggestFun();
            });
            captchaObj.onFail(function() {
                $('#J_suggest_submit').val('提 交').removeClass('btn_disabled').prop('disabled', 0);
            });
            captchaObj.onError(function() {
                $('#J_suggest_submit').val('提 交').removeClass('btn_disabled').prop('disabled', 0);
            });
            captchaObj.getValidate()
        };
    }
</script>
</body>
</html>