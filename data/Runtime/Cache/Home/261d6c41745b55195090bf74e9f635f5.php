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
	<link href="../public/css/common_ajax_dialog.css" rel="stylesheet" type="text/css" />
	<link href="../public/css/jobs.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=<?php if(C('SUBSITE_VAL.s_id') > 0 and $subsite_val['s_map_ak']): echo ($subsite_val["s_map_ak"]); else: echo C('qscms_map_ak'); endif; ?>"></script>
	<script type="text/javascript" src="http://api.map.baidu.com/library/DrawingManager/1.4/src/DrawingManager_min.js"></script>
	<link rel="stylesheet" href="http://api.map.baidu.com/library/DrawingManager/1.4/src/DrawingManager_min.css" />
	<!--加载检索信息窗口-->
	<script type="text/javascript" src="http://api.map.baidu.com/library/SearchInfoWindow/1.4/src/SearchInfoWindow_min.js"></script>
	<link rel="stylesheet" href="http://api.map.baidu.com/library/SearchInfoWindow/1.4/src/SearchInfoWindow_min.css" />

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
				<?php $tag_nav_class = new \Common\qscmstag\navTag(array('列表名'=>'nav','调用名称'=>'QS_top','显示数目'=>'10','cache'=>'0','type'=>'run',));$nav = $tag_nav_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"地图搜索","keywords"=>"","description"=>"","header_title"=>""),$nav);?>
				<?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><li class="nli J_hoverbut <?php if(MODULE_NAME == C('DEFAULT_MODULE')): if($nav['tag'] == strtolower(CONTROLLER_NAME)): ?>select<?php endif; else: if($nav['tag'] == strtolower(MODULE_NAME)): ?>select<?php endif; endif; ?>"><a href="<?php echo ($nav['url']); ?>" target="<?php echo ($nav["target"]); ?>"><?php echo ($nav["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<div class="clear"></div>
		</div>
		<div class="tr"></div>
		<div class="clear"></div>
	</div>
</div>
<!--搜索 -->
<div class="map_box">
	<div class="conbox" id="map_container"></div>
</div>
<?php $tag_jobs_list_class = new \Common\qscmstag\jobs_listTag(array('列表名'=>'jobslist','列表页'=>'QS_map','搜索内容'=>$_GET['search_cont'],'显示数目'=>'20','分页显示'=>'1','营业执照'=>$_GET['license'],'过滤已投递'=>$_GET['deliver'],'排序'=>$_GET['sort'],'合并'=>$_COOKIE['com_list'],'描述长度'=>'100','经度'=>$_GET['lng'],'纬度'=>$_GET['lat'],'半径'=>$_GET['wa'],'cache'=>'0','type'=>'run',));$jobslist = $tag_jobs_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"地图搜索","keywords"=>"","description"=>"","header_title"=>""),$jobslist);?>
<div class="plist">
	<div class="pl">	
		<div class="toptitle">
			<div class="ltype">
				<div class="typeli <?php if($_GET['search_cont']== ''): ?>select<?php endif; ?>" onclick="window.location='<?php echo P(array('search_cont'=>''));?>';">所有职位</div>
				<div class="typeli <?php if($_GET['search_cont']== 'company'): ?>select<?php endif; ?>" onclick="window.location='<?php echo P(array('search_cont'=>'company'));?>';">名企招聘</div>
				<div class="typeli <?php if($_GET['search_cont']== 'famous'): ?>select<?php endif; ?>" onclick="window.location='<?php echo P(array('search_cont'=>'famous'));?>';">诚聘通</div>
				<div class="clear"></div>
			</div>
			<div class="ts">
		  		<div class="l1"></div>
				<div class="l2 <?php if($_GET['deliver']== 1): ?>select<?php endif; ?>">
					<?php if($visitor['utype'] == 2): ?><div class="radio_group" <?php if($_GET['deliver']== 1): ?>onclick="window.location='<?php echo P(array('deliver'=>''));?>';"<?php else: ?>onclick="window.location='<?php echo P(array('deliver'=>1));?>';"<?php endif; ?>>
							<div class="radiobox"></div>
							<div class="radiotxt">过滤已投递</div>
							<div class="clear"></div>
						</div><?php endif; ?>
				</div>
				<div class="l2 <?php if($_GET['license']== 1): ?>select<?php endif; ?>" <?php if($_GET['license']== 1): ?>onclick="window.location='<?php echo P(array('license'=>''));?>';"<?php else: ?>onclick="window.location='<?php echo P(array('license'=>1));?>';"<?php endif; ?>>
					<div class="radiobox"></div>
					<div class="radiotxt">营业执照已认证</div>
					<div class="clear"></div>
				</div>

				<div class="J_detailList l3 <?php if($_COOKIE['jobs_show_type']== ''): ?>select<?php endif; ?>" title="切换到详细列表"></div>
				<div class="J_detailList l4 <?php if($_COOKIE['jobs_show_type']== 1): ?>select<?php endif; ?>" title="切换到简易列表" show_type="1"></div>
				<div class="l5">
					<?php if($jobslist['page_params']['nowPage'] > 1): ?><div class="prev" title="上一页" onclick="window.location='<?php echo P(array('p'=>$jobslist['page_params']['nowPage']-1));?>';"><</div><?php endif; ?>
				  	<?php if($jobslist['page_params']['nowPage'] < $jobslist['page_params']['totalPages']): ?><div class="next"  title="下一页" onclick="window.location='<?php echo P(array('p'=>$jobslist['page_params']['nowPage']+1));?>';">></div><?php endif; ?>
					<?php if($jobslist['page_params']['totalRows'] > 0): ?><span><?php echo ($jobslist["page_params"]["nowPage"]); ?></span>/<?php echo ($jobslist["page_params"]["totalPages"]); ?>页<?php endif; ?>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="sort">
				<div class="sl1">排序方式：</div>
				<a class="sl2 <?php if($_GET['sort']== ''): ?>select<?php endif; ?>" href="<?php echo P(array('sort'=>''));?>">综合排序</a>
				<a class="sl2 <?php if($_GET['sort']== 'rtime'): ?>select<?php endif; ?>" href="<?php echo P(array('sort'=>'rtime'));?>">更新时间</a>
				<?php if($search_type == 'full'): ?><a class="sl2 <?php if($_GET['sort']== 'score'): ?>select<?php endif; ?>" href="<?php echo P(array('sort'=>'score'));?>">相关度</a><?php endif; ?>
				<div class="clear"></div>
			</div>
		</div>
		<!--列表 -->
		<div class="listb J_allListBox">
			<?php if(!empty($jobslist['list'])): if(is_array($jobslist['list'])): $i = 0; $__LIST__ = $jobslist['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jobs): $mod = ($i % 2 );++$i;?><div class="J_jobsList yli" data-jid="<?php echo ($jobs["id"]); ?>">
					<div class="td1"><div class="J_allList radiobox"></div></div>
					<div class="td2 link_blue"><a class="line_substring" href="<?php echo ($jobs["jobs_url"]); ?>" target="_blank"><?php echo ($jobs["jobs_name"]); ?></a><?php if($jobs['emergency'] == 1): ?>&nbsp;<img src="../public/images/emergency.png"><?php endif; ?></div>
					<div class="td3 link_gray6">
						<a class="line_substring" href="<?php echo ($jobs["company_url"]); ?>" target="_blank"><?php echo ($jobs["companyname"]); ?></a>
						<?php if($jobs['company_audit'] == 1): ?><img src="<?php echo attach('auth.png','resource');?>" title="认证企业"><?php endif; ?>
						<?php if($jobs['setmeal_id'] > 1): ?><img src="<?php echo attach($jobs['setmeal_id'].'.png','setmeal_img');?>" title="<?php echo ($jobs["setmeal_name"]); ?>"><?php endif; ?>
						<?php if($jobs['famous'] == 1): ?><img src="<?php if(C('qscms_famous_company_img') == ''): echo attach('famous.png','resource'); else: echo attach(C('qscms_famous_company_img'),'images'); endif; ?>" title="诚聘通企业"/><?php endif; ?>
						<div class="clear"></div>
					</div>
					<div class="td4"><?php echo ($jobs["wage_cn"]); ?></div>
					<div class="td5"><?php echo fdate($jobs['refreshtime']);?></div>
					<div class="td6"><div class="J_jobsStatus hide <?php if($_COOKIE['jobs_show_type']== 1): ?>show<?php endif; ?>"></div> </div>
					<div class="clear"></div>
					<div class="detail" <?php if($_COOKIE['jobs_show_type']== 1): ?>style="display:none"<?php endif; ?>>
					  	<div class="ltx">
							<div class="txt font_gray6">学历：<?php echo ($jobs["education_cn"]); ?><span>|</span>经验：<?php echo ($jobs["experience_cn"]); ?><span>|</span>职位性质：<?php echo ($jobs["nature_cn"]); ?><span>|</span>人数：<?php echo ($jobs["amount"]); ?>人<span>|</span>地点：<?php echo ($jobs["district_cn"]); ?></div>
							<div class="dlabs">
								<?php if(empty($jobs['tag_cn'])): echo ($jobs["briefly"]); ?>
								<?php else: ?>
									<?php if(is_array($jobs['tag_cn'])): $i = 0; $__LIST__ = $jobs['tag_cn'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?><div class="dl"><?php echo ($tag); ?></div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
								<div class="clear"></div>
							</div>
					  	</div>
						<div class="rbtn">
						  		<div class="deliver J_applyForJob" data-batch="false" data-url="<?php echo U('AjaxPersonal/resume_apply');?>">投递简历</div>
								<div class="favorites J_collectForJob" data-batch="false" data-url="<?php echo U('AjaxPersonal/jobs_favorites');?>">收藏</div>
						</div>
						<div class="clear"></div>
					</div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
			<!--投递按钮 -->
			<div class="listbtn">
				<div class="td1"><div class="radiobox J_allSelected"></div></div>
				<div class="td2">
					<div class="lbts J_applyForJob" data-batch="true" data-url="<?php echo U('AjaxPersonal/resume_apply');?>">申请职位</div>
					<div class="lbts J_collectForJob" data-batch="true" data-url="<?php echo U('AjaxPersonal/jobs_favorites');?>">收藏职位</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="qspage"><?php echo ($jobslist["page"]); ?></div>
			<?php else: ?>
			<div class="list_empty_group">
				<div class="list_empty">
					<div class="list_empty_left"></div>
					<div class="list_empty_right">
						<div class="sorry_box">对不起，没有找到符合您条件的职位！</div>
						<div class="stips_box">建议您修改搜索条件后再进行搜索</div>
					</div>
					<div class="clear"></div>
				</div>
			</div><?php endif; ?>
		</div>
		<?php if($_GET['citycategory']!= ''): ?><div class="bot_info link_gray6">
				<div class="topnavbg">
					<div class="topnav">
						<?php if($_GET['key'] != '' or $_GET['category'] != ''): ?><div class="tl J_job_hotnear select">周边职位</div><?php endif; ?>
						<div class="tl J_job_hotnear">热门职位</div>
						<div class="clear"></div>
					</div>
				</div>
				<?php if($_GET['key'] != ''): ?><div class="showbotinfo J_job_hotnear_show show">
			        	<?php if(is_array($city['list'])): $i = 0; $__LIST__ = array_slice($city['list'],0,21,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$district): $mod = ($i % 2 );++$i;?><div class="ili"><a href="<?php echo P(array('citycategory'=>$district['citycategory'],'key'=>$_GET['key']));?>"><?php echo ($district["categoryname"]); echo (urldecode(urldecode($_GET['key']))); ?></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
						<div class="clear"></div>
					</div>
				<?php elseif($_GET['category'] != ''): ?>
					<div class="showbotinfo J_job_hotnear_show show">
			        	<?php if(is_array($city['list'])): $i = 0; $__LIST__ = array_slice($city['list'],0,21,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$district): $mod = ($i % 2 );++$i;?><div class="ili"><a href="<?php echo P(array('citycategory'=>$district['citycategory'],'category'=>$_GET['category']));?>"><?php echo ($district["categoryname"]); echo ($jobs_cate_info[$_GET['category']]['categoryname']); ?></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
						<div class="clear"></div>
					</div><?php endif; ?>
				<div class="showbotinfo J_job_hotnear_show">
					<?php $tag_hotword_class = new \Common\qscmstag\hotwordTag(array('列表名'=>'hotword_list','显示数目'=>'22','cache'=>'0','type'=>'run',));$hotword_list = $tag_hotword_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"地图搜索","keywords"=>"","description"=>"","header_title"=>""),$hotword_list);?>
					<?php if(is_array($hotword_list)): $i = 0; $__LIST__ = $hotword_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hotword): $mod = ($i % 2 );++$i; if(C('qscms_key_urlencode') == 1): ?><div class="ili"><a href="<?php echo P(array('citycategory'=>$city['citycategory'],'key'=>urlencode($hotword['w_word_code'])));?>"><?php echo ($city['categoryname']); echo ($hotword["w_word"]); ?></a></div>
						<?php else: ?>
						<div class="ili"><a href="<?php echo P(array('citycategory'=>$city['citycategory'],'key'=>$hotword['w_word_code']));?>"><?php echo ($city['categoryname']); echo ($hotword["w_word"]); ?></a></div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
					<div class="clear"></div>
				</div>
			</div><?php endif; ?>
	</div>
	<div class="pr">
		<div class="lisbox">
			<div class="t">推荐职位</div>
			<?php if($a == 'a'): $tag_jobs_list_class = new \Common\qscmstag\jobs_listTag(array('列表名'=>'recommend_jobs','排序'=>'rtime','显示数目'=>'5','cache'=>'0','type'=>'run',));$recommend_jobs = $tag_jobs_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"地图搜索","keywords"=>"","description"=>"","header_title"=>""),$recommend_jobs);?>
			<?php else: ?>
				<?php $tag_jobs_list_class = new \Common\qscmstag\jobs_listTag(array('列表名'=>'recommend_jobs','关键字'=>$_GET['key'],'职位分类'=>$_GET['category'],'推荐'=>'1','显示数目'=>'5','cache'=>'0','type'=>'run',));$recommend_jobs = $tag_jobs_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"地图搜索","keywords"=>"","description"=>"","header_title"=>""),$recommend_jobs);?>
				<?php if(empty($recommend_jobs['list'])): $tag_jobs_list_class = new \Common\qscmstag\jobs_listTag(array('列表名'=>'recommend_jobs','排序'=>'hot','显示数目'=>'5','cache'=>'0','type'=>'run',));$recommend_jobs = $tag_jobs_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"地图搜索","keywords"=>"","description"=>"","header_title"=>""),$recommend_jobs); endif; endif; ?>
			<?php if(empty($recommend_jobs['list'])): ?><div class="empty">暂无相关职位！</div>
			<?php else: ?>
				<?php if(is_array($recommend_jobs['list'])): $i = 0; $__LIST__ = $recommend_jobs['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jobs): $mod = ($i % 2 );++$i;?><div class="yl">
						<div class="pic"><a target="_blank" href="<?php echo ($jobs["company_url"]); ?>"><img src="<?php echo ($jobs['logo']); ?>" border="0"/></a></div>
						<div class="txts link_gray6">
						<div class="t1 substring"><a target="_blank" href="<?php echo ($jobs["jobs_url"]); ?>" title="<?php echo ($jobs["jobs_name"]); ?>"><?php echo ($jobs["jobs_name"]); ?></a></div>
						<div class="t2 substring"><a target="_blank" href="<?php echo ($jobs["company_url"]); ?>" title="<?php echo ($jobs["companyname"]); ?>"><?php echo ($jobs["companyname"]); ?></a></div>
						<?php echo ($jobs["wage_cn"]); ?>
						</div>
						<div class="clear"></div>
					</div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
		</div>
		<!--紧急招聘 -->
		<div class="lisbox link_gray6">
			<div class="t">紧急招聘</div>
				<?php $tag_jobs_list_class = new \Common\qscmstag\jobs_listTag(array('列表名'=>'emergency_jobs','紧急招聘'=>'1','显示数目'=>'5','cache'=>'0','type'=>'run',));$emergency_jobs = $tag_jobs_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"地图搜索","keywords"=>"","description"=>"","header_title"=>""),$emergency_jobs);?>
				<?php if(empty($emergency_jobs['list'])): ?><div class="empty">暂无相关职位！</div>
				<?php else: ?>
					<?php if(is_array($emergency_jobs['list'])): $i = 0; $__LIST__ = $emergency_jobs['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jobs): $mod = ($i % 2 );++$i;?><div class="eyl">
							<div class="jname substring"><a target="_blank" href="<?php echo ($jobs["jobs_url"]); ?>"><?php echo ($jobs["jobs_name"]); ?></a></div>
							<div class="city substring"><?php echo ($jobs['district_cn']); ?></div>	
							<div class="clear"></div>
							<div class="etxt substring"><a target="_blank" href="<?php echo ($jobs["company_url"]); ?>"><?php echo ($jobs["companyname"]); ?></a></div>
							<div class="etxt substring"><?php echo ($jobs["wage_cn"]); ?></div>
						</div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
<div class="foot_lab_bg">
	<div class="foot_lab">
		<div class="ylist y1">快速入职</div>
		<div class="ylist y2">隐私保护</div>
		<div class="ylist y3">薪资透明</div>
		<div class="ylist y4">信息可靠</div>
		<div class="ylist y5">手机找工作</div>
		<div class="clear"></div>
	</div>
</div>
<div class="foot link_gray9">
	<div class="service">
	<div class="tel"><?php echo C('qscms_bootom_tel');?></div>
	<div class="txt">客服热线(服务时间：09:00-19:00)</div>
</div>
  
  
  <div class="about">
  <div class="atit">关于我们</div>
  <?php $tag_explain_list_class = new \Common\qscmstag\explain_listTag(array('列表名'=>'list','显示数目'=>'4','cache'=>'0','type'=>'run',));$list = $tag_explain_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"地图搜索","keywords"=>"","description"=>"","header_title"=>""),$list);?>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a target="_blank" href="<?php echo ($vo['url']); ?>"><?php echo ($vo['title']); ?></a><br /><?php endforeach; endif; else: echo "" ;endif; ?>
  </div>
 <div class="about last">
  <div class="atit">帮助中心</div>
    <a target="_blank" href="<?php echo url_rewrite('QS_helplist',array('id'=>3));?>">求职指南</a><br />
    <a target="_blank" href="<?php echo url_rewrite('QS_helplist',array('id'=>12));?>">招聘帮助</a><br />
    <a target="_blank" href="<?php echo U('Home/Members/user_getpass');?>">找回密码</a><br />
    <a target="_blank" href="<?php echo url_rewrite('QS_suggest');?>">意见建议</a>
  </div> 
  <div class="about">
	<div class="atit">个人求职</div>
	<a target="_blank" href="<?php echo url_rewrite('QS_jobs');?>">找工作</a><br />
    <a target="_blank" href="<?php echo U('Home/Personal/resume_add');?>">创建简历</a><br />
    <a target="_blank" href="<?php echo url_rewrite('QS_jobslist',array('search_cont'=>'setmeal'));?>">名企招聘</a><br />
    <a target="_blank" href="<?php echo url_rewrite('QS_news');?>">职场资讯</a> 
  </div>
  <div class="about">
	<div class="atit">企业招聘</div>
	<a target="_blank" href="<?php echo url_rewrite('QS_resume');?>">招人才</a><br />
    <a target="_blank" href="<?php echo U('Home/Company/jobs_add');?>">发布职位</a><br />
    <a target="_blank" href="<?php echo url_rewrite('QS_helplist',array('id'=>19));?>">招聘服务</a><br />
    <a target="_blank" href="<?php echo url_rewrite('QS_hrtools');?>">HR工具箱</a> 
  </div>
	 
	
  <div class="code"><img src="<?php echo attach(C('qscms_weixin_img'),'resource');?>"></div>
  <div class="clear"></div>
</div>



<!--
<div class="slide_tip pie_about">
  <div class="imgbg"></div>
  <div class="clear"></div>
  <div class="btnboxs">
  <a class="pie_about" href="<?php echo U('members/reg');?>">免费注册</a>
  <a class="pie_about" href="<?php echo U('members/login');?>" class="login">会员登录</a>
  <div class="closs"></div>
  </div>
</div>
-->


<div class="foottxt link_gray9 font_gray9">
联系地址：<?php echo C('qscms_address');?> 联系电话：<?php echo C('qscms_bootom_tel');?> 网站备案：<?php echo C('qscms_icp');?><br />

<?php echo C('qscms_bottom_other');?><br />

Powered by <a href="http://www.74cms.com">74cms</a> v<?php echo C('QSCMS_VERSION');?> <br />
<?php echo htmlspecialchars_decode(C('qscms_statistics'));?>

</div>
<div class="floatmenu">
  <div class="item mobile">
    <a class="blk"></a>
    <div class="popover popover1">
      <div class="popover-bd">
        <label>手机APP</label>
        <span class="img-qrcode img-qrcode-mobile"><img src="<?php echo C('qscms_site_dir');?>index.php?m=Home&c=Qrcode&a=index&url=<?php echo urlencode(C('qscms_android_download'));?>" alt=""></span>
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
<script type="text/javascript">
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
</script>
<script type="text/javascript" src="../public/js/jquery.jobslist.js"></script>
<script type="text/javascript" src="../public/js/jquery.modal.dialog.js"></script>
<script src="http://static.geetest.com/static/tools/gt.js"></script>
<script type="text/javascript">
	// 百度地图API功能
	<?php if($apply['Subsite'] and $subsite_val['s_id'] > 0): ?>var m_zoom = "<?php echo ((isset($subsite_val["s_map_zoom"]) && ($subsite_val["s_map_zoom"] !== ""))?($subsite_val["s_map_zoom"]):C('qscms_map_zoom')); ?>";
		var map_center_x = "<?php if($_GET['lng']== ''): echo ((isset($subsite_val["s_map_center_x"]) && ($subsite_val["s_map_center_x"] !== ""))?($subsite_val["s_map_center_x"]):C('qscms_map_center_x')); else: echo ($_GET['lng']); endif; ?>";
		var map_center_y = "<?php if($_GET['lat']== ''): echo ((isset($subsite_val["s_map_center_y"]) && ($subsite_val["s_map_center_y"] !== ""))?($subsite_val["s_map_center_y"]):C('qscms_map_center_y')); else: echo ($_GET['lat']); endif; ?>";
	<?php else: ?>
		var m_zoom = "<?php echo C('qscms_map_zoom');?>";
		var map_center_x = "<?php if($_GET['lng']== ''): echo C('qscms_map_center_x'); else: echo ($_GET['lng']); endif; ?>";
		var map_center_y = "<?php if($_GET['lat']== ''): echo C('qscms_map_center_y'); else: echo ($_GET['lat']); endif; ?>";<?php endif; ?>
	var map = new BMap.Map("map_container");
	var point = new BMap.Point(map_center_x,map_center_y);
	map.centerAndZoom(point,m_zoom);
	var qs_marker = new BMap.Marker(point);        // 创建标注  
	map.setCenter(point); 
	map.addControl(new BMap.NavigationControl());//添加鱼骨
	map.enableScrollWheelZoom();//启用滚轮放大缩小，默认禁用。
	var overlays = [];
	var url = "<?php echo P(array('lng'=>'lngval','lat'=>'latval','wa'=>'waval'));?>";
	var overlaycomplete = function(e){
        url = url.replace('lngval',e.overlay.point['lng']);
        url = url.replace('latval',e.overlay.point['lat']);
        url = url.replace('waval',e.overlay.wa);
        window.location=url;
    };
    var styleOptions = {
        strokeColor:"red",    //边线颜色。
        fillColor:"red",      //填充颜色。当参数为空时，圆形将没有填充效果。
        strokeWeight: 3,       //边线的宽度，以像素为单位。
        strokeOpacity: 0.8,	   //边线透明度，取值范围0 - 1。
        fillOpacity: 0.6,      //填充的透明度，取值范围0 - 1。
        strokeStyle: 'solid' //边线的样式，solid或dashed。
    }
    //实例化鼠标绘制工具
    var drawingManager = new BMapLib.DrawingManager(map, {
        isOpen: false, //是否开启绘制模式
        enableDrawingTool: true, //是否显示工具栏
        drawingToolOptions: {
            anchor: BMAP_ANCHOR_TOP_RIGHT, //位置
            offset: new BMap.Size(5, 5), //偏离值
            drawingModes : [
	            BMAP_DRAWING_CIRCLE
	        ]
        },
        circleOptions: styleOptions, //圆的样式
    });  
	 //添加鼠标绘制工具监听事件，用于获取绘制结果
    drawingManager.addEventListener('overlaycomplete', overlaycomplete);
    function addMarker(lng,lat,name,uid){
		var point = new BMap.Point(lng,lat);
		var qs_marker = new BMap.Marker(point);// 创建标注  
		qs_marker.setTitle(name);
		map.addOverlay(qs_marker);
		var opts = {
		  //width : 200,     // 信息窗口宽度
		  //height: 100,     // 信息窗口高度
		  //title : name , // 信息窗口标题
		  enableMessage:true//设置允许信息窗发送短息
		}
		qs_marker.addEventListener("click", function(){
			var infoWindow = new BMap.InfoWindow('载入中…', opts);  // 创建信息窗口对象      
			map.openInfoWindow(infoWindow,point); //开启信息窗口
			$.getJSON("<?php echo U('AjaxCommon/get_com_jobs');?>",{uid:uid},function(result){
				if(result.status == 1){
					var h = '<p class="map_company"><a href="'+result.data.list[0].company_url+'" target="_blank">'+name+'</a></p>';
					for (var i = 0; i <= result.data.list.length-1; i++) {
						h += '<p><a class="map_jobs" href="'+result.data.list[i].jobs_url+'" target="_blank">'+result.data.list[i].jobs_name+'</a></p>';
					};
					h += '<p><a class="map_jobs more" href="'+result.data.com_jobs_url+'" target="_blank">查看全部职位>></a></p>';
					infoWindow = new BMap.InfoWindow(h, opts);  // 创建信息窗口对象      
					map.openInfoWindow(infoWindow,point); //开启信息窗口
				}
			});
		});
	}
    <?php if(is_array($jobslist['list'])): $i = 0; $__LIST__ = $jobslist['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jobs): $mod = ($i % 2 );++$i;?>addMarker("<?php echo ($jobs["map_x"]); ?>","<?php echo ($jobs["map_y"]); ?>","<?php echo ($jobs["companyname"]); ?>","<?php echo ($jobs["uid"]); ?>");<?php endforeach; endif; else: echo "" ;endif; ?>
</script>
</body>
</html>