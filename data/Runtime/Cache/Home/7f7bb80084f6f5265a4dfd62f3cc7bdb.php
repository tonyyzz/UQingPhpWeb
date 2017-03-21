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
	<link href="../public/css/members/common.css" rel="stylesheet" type="text/css" />
	<link href="../public/css/personal/personal_ajax_dialog.css" rel="stylesheet" type="text/css" />
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
<div class="user_head_bg">
	<div class="user_head">
		<div class="logobox">
			<a href="/"><img src="<?php if(C('qscms_logo_home')): echo attach(C('qscms_logo_home'),'resource'); else: ?>../public/images/logo.gif<?php endif; ?>" border="0"/></a>
		</div>
		<div class="logotxt">
			|&nbsp;&nbsp;
			<?php if(ACTION_NAME == 'login'): ?>会员登录
			<?php else: ?>
				<?php if($utype == 0): ?>会员注册<?php endif; ?>
				<?php if($utype == 1): ?>企业会员注册<?php endif; ?>
				<?php if($utype == 2): ?>个人会员注册<?php endif; endif; ?>
		</div>
		<div class="reg">
			<?php if(ACTION_NAME == 'login'): ?>还没有账号？ <a href="<?php echo U('members/register');?>" class="btn_blue J_hoverbut btn_inline">立即注册</a>
			<?php else: ?>
				已经有账号？ <a href="<?php echo U('members/login');?>" class="btn_blue J_hoverbut btn_inline">立即登录</a><?php endif; ?>
		</div>
		<div class="clear"></div>
	</div>
</div>
	<div class="reg_com">
		<form class="J_passwordalert_group" id="registerForm" action="<?php echo U('members/register');?>" method="post" onkeydown="if(event.keyCode==13){return false;}">
			<input type="hidden" name="incode" value="<?php echo ($_GET['incode']); ?>">
			<div class="rl J_focus">
				<div class="switch_title link_blue"><a href="<?php echo U('members/register',array('utype'=>2));?>">切换为个人注册>></a></div>
				<div class="regtit">企业信息</div>
				<div class="J_validate_group">
					<div class="td1">
						<input class="input_295_34" name="companyname" id="companyname" type="text" placeholder="请输入企业名称" autocomplete="off" />
					</div>
					<div class="td2 J_showtip_box"></div>
				</div>
				<div class="J_validate_group">
					<div class="td1">
						<input class="input_295_34" name="contact" id="contact" type="text" placeholder="请输入企业联系人" autocomplete="off" />
					</div>
					<div class="td2 J_showtip_box"></div>
				</div>
				<div class="J_validate_group">
					<div class="td1">
						<div class="tel_td1">
							<input class="input_295_34" name="landline_tel_first" id="landline_tel_first" type="text" placeholder="区号"/>
						</div>
						<div class="tel_td2">
							<input class="input_295_34" name="landline_tel_next" id="landline_tel_next" type="text" placeholder="固定电话"/>
						</div>
						<div class="tel_td3">
							<input class="input_295_34" name="landline_tel_last" id="landline_tel_last" type="text" placeholder="分机号"/>
						</div>
						<div class="clear"></div>
					</div>
					<div class="td2 J_showtip_box"></div>
				</div>
				<div class="J_validate_group">
					<div class="td1">
						<input class="input_295_34" name="telephone" id="telephone" type="text" placeholder="请输入手机号" autocomplete="off" />
					</div>
					<div class="td2 J_showtip_box"></div>
				</div>
				<div class="clear"></div>
				<div class="tips_td">固定电话和手机号码至少填写一项</div>
				<div class="regtit">账户信息<span>(用于登录<?php echo C('qscms_site_name');?>)</span></div>
				<div class="J_validate_group">
					<div class="td1">
						<input class="input_295_34" name="username" id="username" type="text" placeholder="请输入用户名" autocomplete="off" />
					</div>
					<div class="td2 J_showtip_box"></div>
				</div>
				<div class="J_validate_group">
					<div class="td1">
						<div class="reg-form-content">
							<input class="input_295_34 inputElem" name="email" id="email" type="text" placeholder="请输入常用邮箱" autocomplete="off" />
						</div>
					</div>
					<div class="td2 J_showtip_box"></div>
				</div>
				<div class="J_validate_group">
					<div class="td1">
						<input class="input_295_34 J_passwordalert" name="cpassword" id="cpassword" type="password" placeholder="请输入账户密码" autocomplete="off" />
					</div>
					<div class="td2 J_showtip_box"></div>
				</div>
				<div class="clear"></div>
				<div class="safety">
					<div class="slist t1">危险</div>
					<div class="slist t2">一般</div>
					<div class="slist t3">安全</div>
					<div class="clear"></div>
				</div>
				<div class="J_validate_group">
					<div class="td1">
						<input class="input_295_34" name="cpasswordVerify" id="cpasswordVerify" type="password" placeholder="请确认账户密码" autocomplete="off" />
					</div>
					<div class="td2 J_showtip_box"></div>
				</div>
				<div class="clear"></div>
				<div class="agreement link_blue"><label><input name="agreement" type="checkbox" value="1" checked="checked" />
				我已阅读并同意<a href="javascript:;" id="reg_agreement">《<?php echo C('qscms_site_name');?>用户服务协议》</a></label></div>
				<div class="btnbox">
					<input name="utype" type="hidden" value="<?php echo ($utype); ?>">
					<input type="hidden" name="reg_type" value="2">
					<input type="hidden" name="landline_tel" id="landline_tel" value="">
					<input name="" id="btnRegister" type="submit" value="注册" class="btn_reg J_hoverbut" />
				</div>
			</div>
			<!-- -->
			
			<div class="rr">
				<div class="tittxt">已经有<?php echo C('qscms_site_name');?>账号:</div>
				
				<div class="logintxt"><a href="<?php echo U('members/login');?>" class=" J_hoverbut btn_blue btn_inline">直接登录</a></div>
				<div class="tittxt">使用以下帐号直接登录:</div>
				
				<div class="loginappimg">
					<?php if(is_array($oauth_list)): $i = 0; $__LIST__ = $oauth_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$oauth): $mod = ($i % 2 );++$i; if($key != 'weixin'): ?><a href="<?php echo U('callback/index',array('mod'=>$key,'type'=>'login'));?>" class="imgli <?php echo ($key); ?> J_hoverbut" title="<?php echo ($oauth["name"]); ?>账号登录">&nbsp;</a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
				  <div class="clear"></div>
				  </div>
				<?php if(C('qscms_weixin_apiopen') and C('qscms_weixin_scan_login')): ?><div class="tittxt">微信扫描下方二维码登录:</div>
					<div id="J_weixinQrCode" class="code"></div><?php endif; ?>
			</div>
			<!-- -->
			<div class="clear"></div>
			<div id="popupCaptcha"></div>
			<input type="hidden" id="verifyRegCompany">
		</form>
	</div>
	<input type="hidden" id="J_config_varify_reg" value="<?php echo C('qscms_captcha_config.varify_reg');?>" />
	<!--下方阴影 -->
	<div class="reg_com_bg">
		<div class="bl"></div>
		<div class="br"></div>
		<div class="clear"></div>
	</div>
	<?php $tag_text_class = new \Common\qscmstag\textTag(array('列表名'=>'agreement','类型'=>'agreement','cache'=>'0','type'=>'run',));$agreement = $tag_text_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"","keywords"=>"","description"=>"","header_title"=>""),$agreement);?>
	<div class="footer_min" id="footer">
	<div class="links link_gray6">
	<a target="_blank" href="<?php echo url_rewrite('QS_index');?>">网站首页</a>   
	<?php $tag_explain_list_class = new \Common\qscmstag\explain_listTag(array('列表名'=>'list','cache'=>'0','type'=>'run',));$list = $tag_explain_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"","keywords"=>"","description"=>"","header_title"=>""),$list);?>
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
	<script type="text/javascript" src="../public/js/jquery.validate.js"></script>
	<script type="text/javascript" src="../public/js/members/jquery.pwdalert.js"></script>
	<script type="text/javascript" src="../public/js/members/jquery.validate.regcompany.js"></script>
	<script type="text/javascript" src="../public/js/jquery.modal.dialog.js"></script>
	<script type="text/javascript" src="../public/js/emailAutoComplete.js"></script>
	<script type="text/javascript" src="../public/js/jquery.placeholder.min.js"></script>
	<script src="http://static.geetest.com/static/tools/gt.js"></script>
	<script src="../public/js/members/jquery.common.js" type="text/javascript" language="javascript"></script>
	<script type="text/javascript">
		$('input').placeholder();
	  	//注册协议弹框
	  	$("#reg_agreement").click(function(){
			var qsDialog = $(this).dialog({
        		title: "<?php echo C('qscms_site_name');?>注册协议",
				backdrop: false
			});
			$.getJSON("<?php echo U('Home/Members/agreement');?>",function(result){
				if(result.status==1){
					qsDialog.setContent(result.data);
				}
			});
		});
		// 默认第一项获得焦点
		$('#companyname').focus().addClass('input_focus');
		<?php if(C('qscms_weixin_apiopen') and C('qscms_weixin_scan_login')): ?>get_weixin_qrcode();<?php endif; ?>

		// 是否同意注册协议
		$('input[name="agreement"]').die().live('click', function() {
			if ($(this).is(':checked')) {
				$('#btnRegister').prop('disabled', 0).removeClass('btn_disabled');
			} else {
				$('#btnRegister').prop('disabled', !0).addClass('btn_disabled');
			}
		})

	</script>
</body>
</html>