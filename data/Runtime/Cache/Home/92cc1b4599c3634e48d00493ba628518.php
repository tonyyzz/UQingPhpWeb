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
	<script src="../public/js/members/jquery.common.js" type="text/javascript" language="javascript"></script>
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
	<div class="find_pwd">
		<div class="step s1"></div>
		<div class="steptxt">
			<div class="tli font_blue">1.验证账号信息</div>
			<div class="tli">2.设置新密码</div>
			<div class="tli">3.找回成功</div>
			<div class="clear"></div>
		</div>
		<div class="rl J_focus">
			<div class="td1">
				<div class="input_295_34 select_input J_dropdown J_listitme_parent">
					<span class="J_listitme_text"><?php if(C('qscms_sms_open') == 1): ?>通过绑定的手机找回密码<?php else: ?>通过注册邮箱找回密码<?php endif; ?></span>
					<div class="dropdowbox1 J_dropdown_menu">
						<div class="dropdow_inner1">
							<ul class="nav_box">
								<?php if(C('qscms_sms_open') == 1): ?><li><a class="J_listitme" href="javascript:;" data-code="">通过手机找回密码</a></li><?php endif; ?>
								<li><a class="J_listitme" href="javascript:;" data-code="">通过注册邮箱找回密码</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="clear"></div>
			<?php if(C('qscms_sms_open') == 1): ?><div class="mobileshow J_listitme_group">
					<form id="getPassByMobileForm" action="<?php echo U('members/user_getpass');?>" method="post" onkeydown="if(event.keyCode==13){return false;}">
						<div class="selecttip">系统将发送验证码短信到您的手机上，请注意查收</div>
						<div class="J_validate_group">
							<div class="td1">
								<input class="input_295_34" name="mobile" id="mobile" type="text" placeholder="请输入手机号"/>
							</div>
							<div class="td2 J_showtip_box"></div>
							<div class="clear"></div>
						</div>
						<div class="J_validate_group">
							<div class="td1">
								<div class="code">
									<input name="mobile_vcode" id="mobile_vcode" type="text"  class="input_295_34" placeholder="请输入短信验证码"/>
								</div>
								<div class="codebtn">
									<input type="button" class="btn_yellow J_hoverbut" id="J_getverificode" value="获取验证码" />
									<input type="hidden" id="btnCheck" />
								</div>
								<div class="clear"></div>
							</div>
							<div class="td2 J_showtip_box"></div>
							<div class="clear"></div>
						</div>
						<div class="btnbox">
							<input type="hidden" name="token" value="<?php echo ($token); ?>" />
							<input type="hidden" name="type" value="1" />
							<input type="submit" value="下一步" class="btn_reg J_hoverbut" />
						</div>
					</form>
				</div><?php endif; ?>
			
			<div class="emailshow J_listitme_group" <?php if(C('qscms_sms_open') == 0): ?>style="display:block"<?php endif; ?>>
				<form id="getPassByEmailForm" action="<?php echo U('members/user_getpass');?>" method="post" onkeydown="if(event.keyCode==13){return false;}">
					<div class="selecttip">系统将发出一封验证邮件到您的注册（或绑定的）邮箱，<br>通过验证邮件就可以重新设置密码了</div>
					<div class="J_validate_group">
						<div class="td1">
							<input class="input_295_34" name="email" id="email" type="text" placeholder="请输入邮箱"/>
						</div>
						<div class="td2 J_showtip_box"></div>
						<div class="clear"></div>
					</div>
					<div class="btnbox">
						<input type="hidden" name="token" value="<?php echo ($token); ?>" />
						<input type="hidden" name="type" value="2" />
						<input type="submit" value="下一步" class="btn_reg J_hoverbut" />
					</div>
				</form>
			</div>
			<div class="bottom_appeal_tip link_blue"><strong>上面的方式都不可用？</strong><br />
				你还可以进行 <a href="<?php echo U('Home/Members/appeal_user');?>">账号申诉</a> 或 电话联系我们 <span class="font_blue">(<?php echo C('qscms_bootom_tel');?>)</span></div>
			</div>
		</div>
		<div id="popup-captcha"></div>
		<input type="hidden" id="J_sms_open" value="<?php echo C('qscms_sms_open');?>">
		<!--下方阴影 -->
		<div class="find_pwd_bg">
			<div class="bl"></div>
			<div class="br"></div>
			<div class="clear"></div>
		</div>
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
		<script type="text/javascript" src="../public/js/jquery.listitem.js"></script>
		<script type="text/javascript" src="../public/js/jquery.dropdown.js"></script>
		<script type="text/javascript" src="../public/js/members/jquery.validate.getpass.js"></script>
		<script src="http://static.geetest.com/static/tools/gt.js"></script>
		<script type="text/javascript">
			// 找回方式切换
			$('.J_listitme').click(function(event) {
				var indexValue = $('.J_listitme').index(this);
				$('.J_listitme_group').eq(indexValue).show().siblings('.J_listitme_group').hide();
			});

			// 点击获取验证码先判断是否输入了手机号
			var regularMobile = /^13[0-9]{9}$|14[0-9]{9}$|15[0-9]{9}$|18[0-9]{9}$|17[0-9]{9}$/;
			$('#J_getverificode').click(function() {
				var mobileValue = $.trim($('#mobile').val());
				if (mobileValue == '') {
					disapperTooltip("remind", "请输入手机号码");
					$('#mobile').focus();
					return false;
				};
				if (mobileValue != "" && !regularMobile.test(mobileValue)) {
					disapperTooltip("remind", "请输入正确的手机号码");
					$('#mobile').focus();
					return false;
				}
				$.ajax({
		            url: "<?php echo U('Members/ajax_check');?>",
		            cache: false,
		            async: false,
		            type: 'post',
		            dataType: 'json',
		            data: { type: 'mobile', param: mobileValue },
		            success: function(json) {
		                if (json && json.status) {
		                    disapperTooltip("remind", "该手机号没有注册账号");
							$('#mobile').focus();
							return false;
		                } else {
		                    $("#btnCheck").click();
		                }
		            }
		        });
			});
			if (eval($('#J_sms_open').val())) {
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
						$.ajax({
							url: "<?php echo U('Members/reg_send_sms');?>",
							type: 'POST',
							dataType: 'json',
							data: {mobile: $.trim($('#mobile').val()), sms_type: 'getpass'}
						})
						.done(function(data) {
							if (parseInt(data.status)) {
								disapperTooltip("success", "验证码已发送，请注意查收");
								// 开始倒计时
								var countdown = 180;
								function settime() {
									if (countdown == 0) {
										$('#J_getverificode').prop("disabled", 0);
										$('#J_getverificode').removeClass('btn_disabled');
										$('#J_getverificode').val('获取验证码');
										countdown = 180;
										return;
									} else {
										$('#J_getverificode').prop("disabled", !0);
										$('#J_getverificode').addClass('btn_disabled');
										$('#J_getverificode').val('重新发送' + countdown + '秒');
										countdown--;
									}
									setTimeout(function() { 
								    	settime()
									},1000)
								}
								settime();
							} else {
								disapperTooltip("remind", data.msg);
							}
						});
						
					});
					captchaObj.onFail(function() {
						
					});
					captchaObj.onError(function() {
						
					});
					captchaObj.getValidate()
				};
			}
			
		</script>
	</body>
</html>