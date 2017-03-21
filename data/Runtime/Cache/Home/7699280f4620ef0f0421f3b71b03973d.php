<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $tag_company_show_class = new \Common\qscmstag\company_showTag(array('列表名'=>'info','企业id'=>$_GET['id'],'cache'=>'0','type'=>'run',));$info = $tag_company_show_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"{companyname} - {site_name}","keywords"=>"{companyname},公司简介","description"=>"{contents},公司简介","header_title"=>""),$info);?>
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
	<link href="../public/css/common_ajax_dialog.css" rel="stylesheet" type="text/css" />
	<link href="__COMPANY__/default/css/jobs.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=<?php echo C('qscms_map_ak');?>"></script>
<!--	<script src="../default/public/js/jquery.common.js" type="text/javascript" language="javascript"></script> -->
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
				<?php $tag_nav_class = new \Common\qscmstag\navTag(array('列表名'=>'nav','调用名称'=>'QS_top','显示数目'=>'10','cache'=>'0','type'=>'run',));$nav = $tag_nav_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"{companyname} - {site_name}","keywords"=>"{companyname},公司简介","description"=>"{contents},公司简介","header_title"=>""),$nav);?>
				<?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><li class="nli J_hoverbut <?php if(MODULE_NAME == C('DEFAULT_MODULE')): if($nav['tag'] == strtolower(CONTROLLER_NAME)): ?>select<?php endif; else: if($nav['tag'] == strtolower(MODULE_NAME)): ?>select<?php endif; endif; ?>"><a href="<?php echo ($nav['url']); ?>" target="<?php echo ($nav["target"]); ?>"><?php echo ($nav["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<div class="clear"></div>
		</div>
		<div class="tr"></div>
		<div class="clear"></div>
	</div>
</div>
<div class="comshow">
  <div class="comlogo">
    <img src="<?php echo ($info['logo']); ?>">
  </div>
  <div class="cominfo">
		<div class="cname">
			<?php echo ($info['companyname']); ?>
			<?php if($info['audit'] == 1): ?><img src="<?php echo attach('auth.png','resource');?>" title="认证企业"><?php endif; ?>
			<?php if($info['setmeal_id'] > 1): ?><img src="<?php echo attach($info['setmeal_id'].'.png','setmeal_img');?>" title="<?php echo ($info["setmeal_name"]); ?>"><?php endif; ?>
			<?php if($info['famous'] == 1): ?><img src="<?php if(C('qscms_famous_company_img') == ''): echo attach('famous.png','resource'); else: echo attach(C('qscms_famous_company_img'),'images'); endif; ?>" title="诚聘通企业"/><?php endif; ?>
		</div>
		<div class="txt"><?php echo ($info['district_cn']); ?><span>&nbsp;</span><?php echo ($info['nature_cn']); ?><span>&nbsp;</span><?php echo ($info['trade_cn']); ?><span>&nbsp;</span><?php echo ($info['registered']); echo ($info['currency']); ?><span>&nbsp;</span><?php echo ($info['scale_cn']); ?></div>
        <div class="stat">
		  <div class="li">
		    <div class="t"><?php echo ($info['jobs_count']); ?>个</div>
			在招职位
		  </div>
		 <div class="li">
		    <div class="t"><?php echo ($info['reply_ratio']); ?>%</div>
			简历及时处理率
		  </div>
		  <div class="li">
		    <div class="t"><?php echo ($info['reply_time']); ?></div>
			简历处理平均用时
		  </div>
		  <div class="li  clear_right_border">
		    <div class="t"><?php echo ($info['last_login_time']); ?></div>
			企业最近登录
		  </div>
		   <div class="clear"></div>
		</div>
		
		<div class="share bdsharebuttonbox" data-tag="share_1">
			<a class="li s1 bds_tsina" data-cmd="tsina"></a>
			<a class="li s2 bds_renren" data-cmd="renren"></a>
			<a class="li s3 bds_qzone" data-cmd="qzone"></a>
			<a class="li s5 bds_sqq" data-cmd="sqq"></a>
			<a class="li s6 bds_weixin" data-cmd="weixin"></a>
			<div class="clear"></div>
		</div>
		
        <div class="attention">
		  	<div class="abtn <?php if(($info['focus']) == "1"): ?>for_cancel<?php else: endif; ?>"><?php if(($info['focus']) == "1"): ?>取消关注<?php else: ?>关注<?php endif; ?></div>
		    <div class="fans">粉丝：<span><strong class="fans_num"><?php echo ($info['fans']); ?></strong></span></div>
			<div class="clear"></div>
        </div>
		
		
  </div>
  <div class="clear"></div>
</div>
<div class="comshowmain">
  <div class="l">
	<div class="comnav">
	 	 <a class="select" href="<?php echo url_rewrite('QS_companyshow',array('id'=>$info['id']));?>">公司主页</a>
		  <a href="<?php echo url_rewrite('QS_companyjobs',array('id'=>$info['id']));?>">在招职位<span>(<?php echo ($info['jobs_count']); ?>)</span></a>
		  <div class="clear"></div>
	</div>
	
    <div class="infobox">
	  <div class="t t1">企业简介</div>
	  <div class="txt"><?php echo nl2br($info['company_profile']);?></div>
	  <?php if($info['img']): ?><div class="t t4">企业风采</div>
       <div class="comimg" id="comimg">
	       	<div class="box">
				<ul class="list">
					<?php if(is_array($info['img'])): $i = 0; $__LIST__ = $info['img'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a class="J_for_bigimg" data-src="<?php echo ($vo['img']); ?>" target="_blank" title="<?php echo ($vo['title']); ?>"><img src="<?php echo ($vo['img']); ?>" border="0"></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
			<div class="plus"></div>
			<div class="minus"></div>
       </div><?php endif; ?>
    </div>
	<?php if($info['tag_arr']): ?><div class="infobox">
	  <div class="t t2">企业福利</div>
	  <div class="lab">
	  	<?php if(is_array($info['tag_arr'])): $i = 0; $__LIST__ = $info['tag_arr'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="labsli"><?php echo ($vo); ?></div><?php endforeach; endif; else: echo "" ;endif; ?>
		<div class="clear"></div>
	  </div>
    </div><?php endif; ?>
    <?php $tag_jobs_list_class = new \Common\qscmstag\jobs_listTag(array('列表名'=>'jobs','显示数目'=>'4','会员uid'=>$info['uid'],'cache'=>'0','type'=>'run',));$jobs = $tag_jobs_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"{companyname} - {site_name}","keywords"=>"{companyname},公司简介","description"=>"{contents},公司简介","header_title"=>""),$jobs);?>
    <?php if($jobs['list']): ?><div class="infobox">
	  <div class="t t3">在招职位</div>
	  <div class="more link_gray6"><a href="<?php echo url_rewrite('QS_companyjobs',array('id'=>$info['id']));?>">全部职位>></a></div>
	  <div class="jobs">
	  <?php if(is_array($jobs['list'])): $i = 0; $__LIST__ = $jobs['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="jobsli link_blue">
 		   	<div class="ljob"><a target="_blank" href="<?php echo ($vo['jobs_url']); ?>"><?php echo ($vo['jobs_name']); ?></a><span>[<?php echo ($vo['amount']); ?>人]</span></div>
			<div class="rjob c"><?php echo ($vo['wage_cn']); ?></div>
			<div class="ljob"><?php echo ($vo['district_cn']); ?><span>&nbsp;</span><?php echo ($vo['experience_cn']); ?><span>&nbsp;</span><?php echo ($vo['education_cn']); ?></div>
			<div class="rjob"><?php echo ($vo['refreshtime_cn']); ?></div>
			<div class="clear"></div>
		 </div><?php endforeach; endif; else: echo "" ;endif; ?>		 
			 <div class="clear"></div>
	  </div>
    </div><?php endif; ?>
	
  </div>
  <!-- -->
  <div class="r">
  
    <div class="contact link_gray6">
	  <div class="t">联系方式<?php if($info['hide']): ?><div class="t_check link_blue"><a class="J_check_truenum" href="javascript:;">登录后查看</a></div><?php endif; ?></div>
	  <?php if($info['website']): ?><div class="txt">
      	<div class="fl txt_t">网址</div>
      	<div class="fl content_c"><a target="_blank" href="<?php echo ($info['website']); ?>"><?php echo ($info['website_']); ?></a></div>
      	<div class="clear"></div>
      </div><?php endif; ?>
      <?php if($info['telephone']): ?><div class="txt">
	 	 	<div class="fl txt_t">手机</div>
	 	 	<div class="fl"><?php echo ($info['telephone']); ?></div>
	 	 	<div class="clear"></div>
	 	 </div><?php endif; ?>
	 	<?php if($info['landline_tel']): ?><div class="txt">
	    	<div class="fl txt_t">固话</div>
	    	<div class="fl"><?php echo ($info['landline_tel']); ?></div>
	    	<div class="clear"></div>
	    </div><?php endif; ?>
		 <div class="txt">
		 	<div class="fl txt_t">邮箱</div>
		 	<div class="line_substring" title="<?php echo ($info['email']); ?>"><?php echo ($info['email']); ?></div>
		 	<div class="clear"></div>
		 </div>
	 	<?php if($info['qq']): ?><div class="txt">
	    	<div class="fl txt_t">QQ</div>
	    	<div class="fl"><a class="img_cell" target="blank" href="tencent://message/?uin=<?php echo ($info['qq']); ?>&Site=menu&Menu=yes"><img border="0" SRC=http://wpa.qq.com/pa?p=1:<?php echo ($info['qq']); ?>:1 alt="点击这里给我发消息"></a></div>
	    	<div class="clear"></div>
	    </div><?php endif; ?>
		  <div class="txt">
		  	<div class="fl txt_t">地址</div>
		  	<div class="fl content_c" title="<?php echo ($info['address']); ?>"><?php echo ($info['address']); ?></div>
		  	<div class="clear"></div>
		  </div>
		  <?php if($info['map_x'] && $info['map_y'] && $info['map_zoom']): ?><div class="map" id="map"></div>
			<script type="text/javascript">
				var map = new BMap.Map("map");       // 创建地图实例  
				var point = new BMap.Point(<?php echo ($info['map_x']); ?>,<?php echo ($info['map_y']); ?>);  // 创建点坐标   
				map.centerAndZoom(point, <?php echo ($info['map_zoom']); ?>);
				var qs_marker = new BMap.Marker(point);        // 创建标注   
				map.addOverlay(qs_marker);  
				map.setCenter(point); 
			</script><?php endif; ?>
    </div>
	<?php if($info['famous'] == 1): ?><div class="famousWrap">
  			<img src="<?php echo attach('famous_img.png','resource');?>" title="诚聘通企业">
  		</div><?php endif; ?>
	<div class="weixin link_gray6">
	  <div class="t">微信招聘</div>
          <div class="code"><img src="<?php echo C('qscms_site_dir');?>index.php?m=Home&c=Qrcode&a=index&url=<?php echo urlencode(build_mobile_url(array('c'=>'Wzp','a'=>'com','params'=>'id='.$info['id'])));?>" /></div>
    </div>

    <div class="leave_msg J_realyWrap">
		<div class="t">给我留言</div>
		<div class="msg_textarea">
			<textarea name="" id="" placeholder="请输入您的疑问。比如工作地点、年薪、福利等等，我会及时给您回复！期待与您合作。"></textarea>
		</div>
		<div class="send_btn_group">
			<div class="txt_num"></div>
			<div class="send_btn J_realyBth" touid="<?php echo ($info["uid"]); ?>">发 送</div>
		</div>
  	</div>
	
	<?php $tag_company_list_class = new \Common\qscmstag\company_listTag(array('列表名'=>'similar','行业'=>$info['trade'],'显示数目'=>'5','去除id'=>$_GET['id'],'cache'=>'0','type'=>'run',));$similar = $tag_company_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"{companyname} - {site_name}","keywords"=>"{companyname},公司简介","description"=>"{contents},公司简介","header_title"=>""),$similar);?>
	<?php if($similar['list']): ?><div class="same link_gray6">
	  <div class="t">看过该公司的人还看过</div>
      <?php if(is_array($similar['list'])): $i = 0; $__LIST__ = $similar['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="list link_gray6">
	  		<div class="pic"><a target="_blank" href="<?php echo ($vo['url']); ?>"><img src="<?php echo ($vo['logo']); ?>" /></a></div>
			<div class="txt">
			  	<div class="comname"><a href="<?php echo ($vo['url']); ?>" target="_blank"><?php echo ($vo['companyname']); ?></a></div>
			    <div class="count"><a target="_blank" href="<?php echo ($vo['url']); ?>"><span><?php echo ($vo['jobs_count']); ?></span></a>个招聘职位</div>
			</div>
			<div class="clear"></div>
	  </div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div><?php endif; ?>
  </div>
  <div class="clear"></div>
</div>


<div class="footer_min" id="footer">
	<div class="links link_gray6">
	<a target="_blank" href="<?php echo url_rewrite('QS_index');?>">网站首页</a>   
	<?php $tag_explain_list_class = new \Common\qscmstag\explain_listTag(array('列表名'=>'list','cache'=>'0','type'=>'run',));$list = $tag_explain_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"{companyname} - {site_name}","keywords"=>"{companyname},公司简介","description"=>"{contents},公司简介","header_title"=>""),$list);?>
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
<script type="text/javascript" src="../public/js/jquery.modal.dialog.js"></script>
<script type="text/javascript" src="__COMPANY__/default/js/jquery.cxscroll.js"></script>
<script>
	// 企业风采切换
	$("#comimg").cxScroll();

	// 点击显示企业风采大图
	$('.J_for_bigimg').die().live('click', function(event) {
		var src = $(this).data('src');
		var qsDialog = $(this).dialog({
    		title: '企业风采',
    		innerPadding: false,
    		border: false,
			content: '<div style="max-width: 900px;max-height: 600px;"><img style="max-width: 900px;max-height: 600px;" src="'+src+'" /></div>',
			showFooter: false
		});
	});

	window._bd_share_config = {
		common : {
			bdText : "<?php echo ($info['companyname']); ?>-<?php echo C('qscms_site_name');?>",	
			bdDesc : "<?php echo ($info['companyname']); ?>-<?php echo C('qscms_site_name');?>",	
			bdUrl : "<?php if(!$apply['Subsite']): echo C('qscms_site_domain'); endif; echo url_rewrite('QS_companyshow',array('id'=>$info['id']));?>", 	
			bdPic : "<?php echo C('qscms_site_domain'); echo ($info['logo']); ?>"
		},
		share : [{
			"tag" : "share_1",
			"bdCustomStyle":"__COMPANY__/default/css/jobs.css"
		}]
	}
	with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
	$(document).ready(function(){
		$.getJSON("<?php echo U('ajaxCommon/company_statistics_add');?>",{comid:"<?php echo ($info['id']); ?>"});
		var isVisitor = "<?php echo ($visitor['uid']); ?>";
		// 关注
		$(".abtn").die().live('click',function(){
			var url = "<?php echo U('ajaxPersonal/company_focus');?>";
			var company_id = "<?php echo ($info['id']); ?>";
			var thisObj = $(this);
			if ((isVisitor > 0)) {
				$.getJSON(url,{company_id:company_id},function(result){
					if(result.status==1){
						disapperTooltip('success',result.msg);
						thisObj.html(result.data.html).toggleClass('for_cancel');
						if(result.data.op==1){
							$(".fans_num").html(parseInt($(".fans_num").html())+1);
						}else{
							$(".fans_num").html(parseInt($(".fans_num").html())-1);
						}
					} else {
						disapperTooltip('remind',result.msg);
					}
				});
			} else {
				var qsDialog = $(this).dialog({
		    		loading: true,
					footer: false,
					header: false,
					border: false,
					backdrop: false
				});
				var loginUrl = "<?php echo U('AjaxCommon/get_login_dig');?>";
				$.getJSON(loginUrl, function(result){
		            if(result.status==1){
		            	qsDialog.hide();
	            		var qsDialogSon = $(this).dialog({
	            			title: '会员登录',
	            			content: result.data.html,
							footer: false,
							border: false
						});
		    			qsDialogSon.setInnerPadding(false);
		            } else {
		            	qsDialog.hide();
			            disapperTooltip('remind',result.msg);
		            }
		        });
			}
		});

		// 查看联系方式
		$('.J_check_truenum').die().live('click', function() {
			if (!(isVisitor > 0)) {
				var qsDialog = $(this).dialog({
		    		loading: true,
					footer: false,
					header: false,
					border: false,
					backdrop: false
				});
				var loginUrl = "<?php echo U('AjaxCommon/get_login_dig');?>";
				$.getJSON(loginUrl, function(result){
		            if(result.status==1){
		            	qsDialog.hide();
	            		var qsDialogSon = $(this).dialog({
	            			title: '会员登录',
	            			content: result.data.html,
							footer: false,
							border: false
						});
		    			qsDialogSon.setInnerPadding(false);
		            } else {
		            	qsDialog.hide();
			            disapperTooltip('remind',result.msg);
		            }
		        });
			}
		});

		// 给我留言
		$('.J_realyBth').die().live('click', function() {
			var u = $(this),
				f = u.closest('.J_realyWrap').find('textarea'),
				t = $.trim(f.val()),
				touid = u.attr('touid');
			if ((isVisitor > 0)) {
				$.post("<?php echo U('Personal/msg_feedback_send');?>",{touid:touid,message:t},function(result){
						if(result.status == 1){
							f.val('');
							disapperTooltip('success',result.msg);
						}else{
							disapperTooltip('remind',result.msg);
						}
					},'json');
			} else {
				var qsDialog = $(this).dialog({
		    		loading: true,
					footer: false,
					header: false,
					border: false,
					backdrop: false
				});
				var loginUrl = "<?php echo U('AjaxCommon/get_login_dig');?>";
				$.getJSON(loginUrl, function(result){
		            if(result.status==1){
		            	qsDialog.hide();
	            		var qsDialogSon = $(this).dialog({
	            			title: '会员登录',
	            			content: result.data.html,
							footer: false,
							border: false
						});
		    			qsDialogSon.setInnerPadding(false);
		            } else {
		            	qsDialog.hide();
			            disapperTooltip('remind',result.msg);
		            }
		        });
			}
		});
	});
</script>
</body>
</html>