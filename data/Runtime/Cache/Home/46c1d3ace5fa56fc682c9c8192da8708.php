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
	<link href="../public/css/jobs.css" rel="stylesheet" type="text/css" />
	<script src="../public/js/jquery.common.js" type="text/javascript" language="javascript"></script>
	<?php $tag_load_class = new \Common\qscmstag\loadTag(array('type'=>'category','search'=>'1','cache'=>'0','列表名'=>'list',));$list = $tag_load_class->category();?>
	<?php if(C('SUBSITE_VAL.s_id') > 0 and !$_GET['citycategory']): $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'city','类型'=>'QS_citycategory','地区分类'=>$subsite_val['s_district'],'显示数目'=>'100','cache'=>'0','type'=>'run',));$city = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"招聘信息 - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$city);?>
	<?php else: ?>
		<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'city','类型'=>'QS_citycategory','地区分类'=>$_GET['citycategory'],'显示数目'=>'100','cache'=>'0','type'=>'run',));$city = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"招聘信息 - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$city); endif; ?>
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
				<?php $tag_nav_class = new \Common\qscmstag\navTag(array('列表名'=>'nav','调用名称'=>'QS_top','显示数目'=>'10','cache'=>'0','type'=>'run',));$nav = $tag_nav_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"招聘信息 - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$nav);?>
				<?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><li class="nli J_hoverbut <?php if(MODULE_NAME == C('DEFAULT_MODULE')): if($nav['tag'] == strtolower(CONTROLLER_NAME)): ?>select<?php endif; else: if($nav['tag'] == strtolower(MODULE_NAME)): ?>select<?php endif; endif; ?>"><a href="<?php echo ($nav['url']); ?>" target="<?php echo ($nav["target"]); ?>"><?php echo ($nav["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<div class="clear"></div>
		</div>
		<div class="tr"></div>
		<div class="clear"></div>
	</div>
</div>
<!--搜索 -->
<div class="page_so indexpage">
	<div class="sobox">
		<div class="selecttype">
		<?php if(C('qscms_jobsearch_key_first_choice') == 1): ?><div class="J_sli sli select" data-type="jobs">搜职位</div>
			<div class="J_sli sli" data-type="company">搜企业</div>
			<?php if(C('qscms_jobsearch_type') != 0): ?><div class="J_sli sli" data-type="full">全文</div><?php endif; ?>
		<?php else: ?>
			<?php if(C('qscms_jobsearch_type') != 0): ?><div class="J_sli sli select" data-type="full">全文</div>
				<div class="J_sli sli" data-type="jobs">搜职位</div>
			<?php else: ?>
				<div class="J_sli sli select" data-type="jobs">搜职位</div><?php endif; ?>
			<div class="J_sli sli" data-type="company">搜企业</div><?php endif; ?>
			<div class="clear"></div>
		</div>
		<div class="inputbg">
			<div id="showSearchModal" title="" class="selecttype J_hoverbut" data-title="请选择地区" data-multiple="false" data-maxnum="0" data-width="520">选择地区</div>
			<form id="ajax_search_location" action="<?php echo U('ajaxCommon/ajax_search_location',array('type'=>'QS_jobslist'));?>" method="get">
				<div class="inoputbox">
					<input type="text" name="key"  value="<?php echo (urldecode(urldecode($_GET['key']))); ?>" placeholder="请输入关键字" />
					<input type="hidden" name="search_type" value="<?php if(C('qscms_jobsearch_key_first_choice') == 1): ?>jobs<?php else: ?>full<?php endif; ?>" />
					<input id="searchCityModalCode" type="hidden" name="citycategory" value="<?php echo ($city['select']['citycategory']); ?>" />
					<input id="recoverSearchCityModalCode" type="hidden" name="" value="" />
				</div>
				<input type="submit" class="sobut J_hoverbut" value="搜索" />
			</form>
		</div>
  		<div class="righttxt link_gray6"><a href="<?php echo url_rewrite('QS_map');?>" class="map">地图找工作</a></div>
		<div class="clear"></div>
	</div>
	<div class="hotword link_gray9 font_gray9 nowrap">
		热门关键字：
		<?php $tag_hotword_class = new \Common\qscmstag\hotwordTag(array('列表名'=>'hotword_list','显示数目'=>'5','cache'=>'0','type'=>'run',));$hotword_list = $tag_hotword_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"招聘信息 - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$hotword_list);?>
		<?php if(is_array($hotword_list)): $i = 0; $__LIST__ = $hotword_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hotword): $mod = ($i % 2 );++$i; if(C('qscms_key_urlencode') == 1): ?><a href="<?php echo url_rewrite('QS_jobslist',array('key'=>urlencode($hotword['w_word_code'])));?>"><?php echo ($hotword["w_word"]); ?></a>
			<?php else: ?>
			<a href="<?php echo url_rewrite('QS_jobslist',array('key'=>$hotword['w_word_code']));?>"><?php echo ($hotword["w_word"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
	</div>
</div>
<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'jobsCate','类型'=>'QS_jobs','cache'=>'0','type'=>'run',));$jobsCate = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"招聘信息 - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$jobsCate);?>
<div class="allclass_1 link_gray6">
	<?php if(C('qscms_category_jobs_level') == 3): if(is_array($jobsCate[0])): $i = 0; $__LIST__ = $jobsCate[0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pcate): $mod = ($i % 2 );++$i; if(is_array($jobsCate[$key])): $i = 0; $__LIST__ = $jobsCate[$key];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$scate): $mod = ($i % 2 );++$i;?><div class="list">
					<div class="ll">
						<div class="t">
							<a href="<?php echo url_rewrite('QS_jobslist',array('jobcategory'=>$scate['spell']));?>"><strong><?php echo ($scate["categoryname"]); ?></strong></a>
						</div>
					</div>
					<div class="lr">
						<?php if(is_array($jobsCate[$key])): $i = 0; $__LIST__ = $jobsCate[$key];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?><a href="<?php echo url_rewrite('QS_jobslist',array('jobcategory'=>$cate['spell']));?>" leibie="cantfwy"><?php echo ($cate["categoryname"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
	<?php else: ?>
		<?php if(is_array($jobsCate[0])): $i = 0; $__LIST__ = $jobsCate[0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pcate): $mod = ($i % 2 );++$i;?><div class="list">
				<div class="ll">
					<div class="t">
						<a href="<?php echo url_rewrite('QS_jobslist',array('jobcategory'=>$pcate['spell']));?>"><strong><?php echo ($pcate["categoryname"]); ?></strong></a>
					</div>
				</div>
				<div class="lr">
					<?php if(is_array($jobsCate[$key])): $i = 0; $__LIST__ = $jobsCate[$key];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?><a href="<?php echo url_rewrite('QS_jobslist',array('jobcategory'=>$cate['spell']));?>" leibie="cantfwy"><?php echo ($cate["categoryname"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
</div>
<div class="footer_min" id="footer">
	<div class="links link_gray6">
	<a target="_blank" href="<?php echo url_rewrite('QS_index');?>">网站首页</a>   
	<?php $tag_explain_list_class = new \Common\qscmstag\explain_listTag(array('列表名'=>'list','cache'=>'0','type'=>'run',));$list = $tag_explain_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"招聘信息 - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$list);?>
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
<script type="text/javascript" src="../public/js/jquery.jobslist.js"></script>
<script type="text/javascript" src="../public/js/jquery.modal.search.js"></script>
<script type="text/javascript">
	var city_select = <?php echo json_encode($city['select']);?>;
	var city_parent = <?php echo json_encode($city['parent']);?>;
	if (city_parent) {
		if (app_spell) {
			$('#showSearchModal').text(city_parent['categoryname']);
			$('#recoverSearchCityModalCode').val(city_parent['spell']);
		} else {
			$('#showSearchModal').text(city_parent['categoryname']);
			$('#recoverSearchCityModalCode').val(city_parent['citycategory']);
		}
	} else if(city_select) {
		if (app_spell) {
			$('#showSearchModal').text(city_select['categoryname']);
			$('#recoverSearchCityModalCode').val(city_select['spell']);
		} else {
			$('#showSearchModal').text(city_select['categoryname']);
			$('#recoverSearchCityModalCode').val(city_select['citycategory']);
		}
	}
	$('.J_jobIndexCategory').hover(function() {
		$(this).addClass('select').siblings().removeClass('select');
		var thisIndex = $('.J_jobIndexCategory').index(this);
		$('.J_jobIndexCategoryBox').eq(thisIndex).show().siblings('.J_jobIndexCategoryBox').hide();
	});
</script>
</body>
</html>