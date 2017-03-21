<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php $tag_jobs_show_class = new \Common\qscmstag\jobs_showTag(array('列表名'=>'jobs_info','职位id'=>$_GET['id'],'cache'=>'0','type'=>'run',));$jobs_info = $tag_jobs_show_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"{jobs_name} - {companyname} - {site_name}","keywords"=>"{companyname},{jobs_name},{nature_cn},{category_cn},{district_cn}","description"=>"{companyname}招聘岗位,{jobs_name}","header_title"=>""),$jobs_info);?>
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
				<?php $tag_nav_class = new \Common\qscmstag\navTag(array('列表名'=>'nav','调用名称'=>'QS_top','显示数目'=>'10','cache'=>'0','type'=>'run',));$nav = $tag_nav_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"{jobs_name} - {companyname} - {site_name}","keywords"=>"{companyname},{jobs_name},{nature_cn},{category_cn},{district_cn}","description"=>"{companyname}招聘岗位,{jobs_name}","header_title"=>""),$nav);?>
				<?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><li class="nli J_hoverbut <?php if(MODULE_NAME == C('DEFAULT_MODULE')): if($nav['tag'] == strtolower(CONTROLLER_NAME)): ?>select<?php endif; else: if($nav['tag'] == strtolower(MODULE_NAME)): ?>select<?php endif; endif; ?>"><a href="<?php echo ($nav['url']); ?>" target="<?php echo ($nav["target"]); ?>"><?php echo ($nav["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<div class="clear"></div>
		</div>
		<div class="tr"></div>
		<div class="clear"></div>
	</div>
</div>
<div class="jobsshow">
	<div class="l">
		<div class="main">
			<div class="jobstit">
				<div class="rightbg"></div>
				<div class="time">
					<div class="timebg"><?php echo date('Y-m-d',$jobs_info['refreshtime']);?></div>
					<div id="J_jobs_click" class="timebg viewbg"><?php echo ((isset($jobs_info["click"]) && ($jobs_info["click"] !== ""))?($jobs_info["click"]):0); ?>次</div>
					<div class="clear"></div>
				</div>
				<div class="jobname"><?php echo ($jobs_info["jobs_name"]); ?></div>
				<div class="wage"><?php echo ($jobs_info["wage_cn"]); ?></div>
				<div class="lab">
					<?php if(is_array($jobs_info['tag_cn'])): $i = 0; $__LIST__ = $jobs_info['tag_cn'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?><div class="li"><?php echo ($tag); ?></div><?php endforeach; endif; else: echo "" ;endif; ?>
					<div class="clear"></div>
				</div>
			</div>
			<div class="item">
				<?php if($jobs_info['tmp'] == 1): ?><div class="invalid_icon"></div>
                <?php else: ?>
                    <div class="btns bdsharebuttonbox" data-tag="share_1">
                        <div class="app apply_jobs">申请职位</div>
                        <div class="sbtn s1 favor"></div>
                        <a class="sbtn s2 bds_more" data-cmd="more"></a>
                        <div class="sbtn s3 report"></div>
                        <div class="clear"></div>
                    </div><?php endif; ?>

			    <div class="itemli"><span>工作性质</span><?php echo ($jobs_info["nature_cn"]); ?></div>
				<div class="itemli"><span>职位类别</span><?php echo ($jobs_info["category_cn"]); ?></div>
				<div class="itemli"><span>招聘人数</span><?php echo ($jobs_info["amount"]); ?>人</div>
				<div class="clear"></div>
				<div class="itemli"><span>学历要求</span><?php echo ($jobs_info["education_cn"]); ?></div>
				<div class="itemli"><span>工作经验</span><?php echo ($jobs_info["experience_cn"]); ?></div>
				<div class="itemli"><span>性别要求</span><?php echo ($jobs_info["sex_cn"]); ?></div>
				<div class="clear"></div>
				<div class="itemli"><span>年龄要求</span><?php echo ($jobs_info["age_cn"]); ?></div>
				<div class="itemli"><span>招聘部门</span><?php if($jobs_info['department']): echo ($jobs_info["department"]); else: ?>不限<?php endif; ?></div>
				<div class="clear"></div>
				<div class="add"><span>工作地点</span><?php echo ($jobs_info['contact']['address']); ?>（<?php echo ($jobs_info["district_cn"]); ?>）</div>
				<?php if($jobs_info['map_x'] && $jobs_info['map_y'] && $jobs_info['map_zoom']): ?><div id="J_map" class="map"></div><?php endif; ?>
				<div class="clear"></div>
			</div>
			<div class="contact">
			    <div class="tit">联系方式</div>
			    <div class="txt">
			    	联系人：<?php if($jobs_info['contact']['contact_show'] == 0): ?>企业设置不公开<?php else: echo ($jobs_info["contact"]["contact"]); endif; ?>
			    	<?php if($jobs_info['contact']['qq']): ?><a target="blank" href="tencent://message/?uin=<?php echo ($jobs_info["contact"]["qq"]); ?>&site=qq&menu=yes">
			    		<img border="0" SRC=http://wpa.qq.com/pa?p=1:123456:1 alt="点击这里给我发消息">
			    	</a><?php endif; ?>
			    </div>
				<div class="clear"></div>
				<?php if($jobs_info['contact']['telephone_show'] == 0): ?><div class="txt">联系电话：企业设置不公开</div>
					<div class="clear"></div>
				<?php else: ?>
					<div class="txt">联系电话：<span class="tel"><?php echo ($jobs_info["contact"]["telephone"]); ?></span></div>
					<?php if($jobs_info['hide']): ?><div class="appbtn J_check_truenum">点击查看</div><?php endif; ?>
					<div class="clear"></div>
				    <div class="teltip"><div class="arrows"></div>打电话前先投递一份简历，面试成功率提高30%</div><?php endif; ?>
			    <div class="statistics">
					<div class="sttit">职位动态</div>
					<div class="stli">
					    <div class="slitit"><?php echo ($jobs_info["company"]["reply_ratio"]); ?>%</div>
					    <div class="slitxthelp"><div class="tip"><div class="arrows"></div>近两周该职位的简历处理率</div>简历处理率</div>
					</div>
					<div class="stli">
						<div class="slitit"><?php echo ($jobs_info["company"]["reply_time"]); ?></div>
						<div class="slitxt">简历平均处理时长</div>
					</div>
					<div class="stli last">
						<div class="slitit"><?php echo ($jobs_info["company"]["last_login_time"]); ?></div>
						<div class="slitxt">企业最近登录时间</div>
					</div>
					<div class="clear"></div>
			    </div>
			</div>
			<div class="describe">
				<div class="tit">职位描述</div>
				<div class="txt"><?php echo nl2br($jobs_info['contents']);?></div>
				<div class="qrcode">
			    	<div class="code"><img src="<?php echo attach(C('qscms_weixin_img'),'resource');?>" /></div>
			        <div class="codetxt">微信扫一扫，及时了解投递状态</div>
					<?php if(empty($visitor['uid'])): ?><div class="resempty">你目前还没有登录：<div class="resadd J_resadd">立即登录</div></div>
					<?php else: ?>
						<?php if($visitor['utype'] == 2): if($jobs_info['resume']): ?><div class="res link_blue">
									你已有可投递的在线简历：<strong><?php echo ($jobs_info["resume"]["title"]); ?></strong>
									<br />
									简历更新于<?php echo date('Y年m月d日',$jobs_info['resume']['refreshtime']);?><span>&nbsp;</span>
									<a target="_blank" href="<?php echo ($jobs_info['resume']['url']); ?>">预览</a><span>&nbsp;</span>|<span>&nbsp;</span><a href="<?php echo U('personal/resume_edit',array('pid'=>$jobs_info['resume']['id']));?>">修改</a>
								</div>
							<?php else: ?>
								<div class="resempty">你目前还没有简历：<div class="resadd" onclick="window.location='<?php echo U('personal/resume_add');?>';">创建简历</div></div><?php endif; endif; endif; ?>
					<div class="clear"></div>
				</div>
	  			<div class="appjob">
					<?php if($jobs_info['tmp'] == 1): ?><div class="appbtn btn_disabled">申请职位</div>
					该职位是无效职位，暂时不能申请。
					<?php else: ?>
					<div class="appbtn apply_jobs">申请职位</div>
					有时候，一次不犹豫的投递，恰恰成就了一次超完美的面试。<?php endif; ?>
				</div>
                <?php if($jobs_info['tmp'] != 1): ?><div class="favorite bdsharebuttonbox" data-tag="share_1">
                        <div class="fli f1 favor">收藏</div>
                        <a class="fli f2 bds_more" data-cmd="more">分享</a>
                        <div class="fli f3 report" >举报</div>
                        <div class="clear"></div>
                    </div><?php endif; ?>
			</div>
		</div>
		<?php $tag_jobs_list_class = new \Common\qscmstag\jobs_listTag(array('列表名'=>'jobslist','显示数目'=>'6','职位分类'=>$jobs_info['jobcategory'],'去除id'=>$jobs_info['id'],'cache'=>'0','type'=>'run',));$jobslist = $tag_jobs_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"{jobs_name} - {companyname} - {site_name}","keywords"=>"{companyname},{jobs_name},{nature_cn},{category_cn},{district_cn}","description"=>"{companyname}招聘岗位,{jobs_name}","header_title"=>""),$jobslist);?>
		<?php if(!empty($jobslist['list'])): ?><div class="comjobs">
			<div class="tit">
				<div class="t">看了此职位的人还会看</div>
				<div class="more link_gray6"><a target="_blank" href="<?php echo url_rewrite('QS_jobslist',array('jobcategory'=>$jobs_info['jobcategory']));?>">查看更多相似职位>></a></div>
				<div class="clear"></div>
			</div>
			<div class="listbox">
				<?php if(is_array($jobslist['list'])): $i = 0; $__LIST__ = $jobslist['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jobs): $mod = ($i % 2 );++$i;?><div class="list">
						<div class="jobname link_blue"><a target="_blank" href="<?php echo ($jobs["jobs_url"]); ?>" title="<?php echo ($jobs["jobs_name"]); ?>"><?php echo ($jobs["jobs_name"]); ?></a></div>
						<div class="wage"><?php echo ($jobs["wage_cn"]); ?></div>
						<div class="txt"><div class="line_substring" title="<?php echo ($jobs["district_cn"]); ?>"><?php echo ($jobs["district_cn"]); ?></div><span>|</span><?php echo ($jobs["experience_cn"]); ?><span>|</span><?php echo ($jobs["education_cn"]); ?></div>
						<div class="txt link_gray6 substring"><a target="_blank" href="<?php echo ($jobs["company_url"]); ?>" title="<?php echo ($jobs["companyname"]); ?>"><?php echo ($jobs["companyname"]); ?></a></div>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
				<div class="clear"></div>
			</div>
		</div><?php endif; ?>
	</div>
	<div class="r">
	  	<div class="cominfo link_gray6">
			<div class="comlogo">
				<a target="_blank" href="<?php echo url_rewrite('QS_companyshow',array('id'=>$jobs_info['company_id']));?>">
					<img src="<?php echo ($jobs_info["company"]["logo"]); ?>"/>
				</a>
			</div>
			<div class="comname">
				<a class="line_substring" target="_blank"
                   href="<?php echo url_rewrite('QS_companyshow',array('id'=>$jobs_info['company_id']));?>" title="<?php echo ($jobs_info["company"]["companyname"]); ?>"><?php echo ($jobs_info["company"]["companyname"]); ?></a>
				<?php if($jobs_info["famous"] == 1): ?><img src="<?php if(C('qscms_famous_company_img') == ''): echo attach('famous.png','resource'); else: echo attach(C('qscms_famous_company_img'),'images'); endif; ?>" title="诚聘通企业"/><?php endif; ?>
                <div class="clear"></div>
			</div>
			<div class="info"><span>性质</span><?php echo ($jobs_info["company"]["nature_cn"]); ?></div>
			<div class="info"><span>行业</span><?php echo ($jobs_info["company"]["trade_cn"]); ?></div>
			<div class="info"><span>规模</span><?php echo ($jobs_info["company"]["scale_cn"]); ?></div>
			<div class="info"><span>地区</span><?php echo ($jobs_info["company"]["district_cn"]); ?></div>
			<?php if($jobs_info['company']['website']): ?><div class="info"><span>网址</span><a href="<?php echo ($jobs_info["company"]["website"]); ?>" target="_blank"><?php echo ($jobs_info["company"]["website_"]); ?></a></div><?php endif; ?>
	  	</div>
	  	<?php if($jobs_info["famous"] == 1): ?><div class="famousWrap">
	  			<img src="<?php echo attach('famous_img.png','resource');?>" title="诚聘通企业">
	  		</div><?php endif; ?>
	    <div class="comqrcode">
			<div class="code"><img src="<?php echo C('qscms_site_dir');?>index.php?m=Home&c=Qrcode&a=index&url=<?php echo urlencode(build_mobile_url(array('c'=>'Wzp','a'=>'com','params'=>'id='.$jobs_info['company_id'])));?>" /></div>
			<div class="codetxt">扫描二维码即可在手机端精彩呈现“微招聘”，一键分享到朋友圈为招聘助力！</div>
			<div class="clear"></div>
		</div>
	  	<div class="leave_msg J_realyWrap">
	  		<div class="tit">
				<div class="t">给我留言</div>
				<div class="clear"></div>
			</div>
			<div class="msg_textarea">
				<textarea name="" id="" placeholder="请输入您的疑问。比如工作地、年薪、福利等等，我会及时给您回复！期待与您合作。"></textarea>
			</div>
			<div class="send_btn_group">
				<div class="txt_num"></div>
				<div class="send_btn J_realyBth" touid="<?php echo ($jobs_info["uid"]); ?>">发 送</div>
			</div>
	  	</div>
		<?php if($jobs_info.company.famous != 0): ?><div class="security"><img src="__COMPANY__/default/images/04.png" /></div><?php endif; ?>
		<?php $tag_jobs_list_class = new \Common\qscmstag\jobs_listTag(array('列表名'=>'otherjobs','显示数目'=>'10','会员uid'=>$jobs_info['uid'],'去除id'=>$jobs_info['id'],'cache'=>'0','type'=>'run',));$otherjobs = $tag_jobs_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"{jobs_name} - {companyname} - {site_name}","keywords"=>"{companyname},{jobs_name},{nature_cn},{category_cn},{district_cn}","description"=>"{companyname}招聘岗位,{jobs_name}","header_title"=>""),$otherjobs);?>
		<div class="comjobs">
			<div class="tit">
				<div class="t">该公司的其他职位</div>
				<div class="more link_gray6"><a href="<?php echo url_rewrite('QS_companyjobs',array('id'=>$jobs_info['company_id']));?>">更多</a></div>
				<div class="clear"></div>
			</div>
			<?php if(!empty($otherjobs['list'])): if(is_array($otherjobs['list'])): $i = 0; $__LIST__ = $otherjobs['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jobs): $mod = ($i % 2 );++$i;?><div class="list">
					<div class="jobname link_blue"><a href="<?php echo ($jobs["jobs_url"]); ?>"><?php echo ($jobs["jobs_name"]); ?></a></div>
					<div class="wage"><?php echo ($jobs["wage_cn"]); ?></div>
					<div class="clear"></div>
					<div class="txt">
						<div class="line_substring" title="<?php echo ($jobs["district_cn"]); ?>"><?php echo ($jobs["district_cn"]); ?></div><span>|</span><?php echo ($jobs["education_cn"]); ?><span>|</span><?php echo ($jobs["experience_cn"]); ?>
					</div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
			<?php else: ?>
			<div class="list">
				该公司暂无其他职位
			</div><?php endif; ?>
		</div>
	</div>
	<div class="clear"></div>
</div>
<div class="footer_min" id="footer">
	<div class="links link_gray6">
	<a target="_blank" href="<?php echo url_rewrite('QS_index');?>">网站首页</a>   
	<?php $tag_explain_list_class = new \Common\qscmstag\explain_listTag(array('列表名'=>'list','cache'=>'0','type'=>'run',));$list = $tag_explain_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"{jobs_name} - {companyname} - {site_name}","keywords"=>"{companyname},{jobs_name},{nature_cn},{category_cn},{district_cn}","description"=>"{companyname}招聘岗位,{jobs_name}","header_title"=>""),$list);?>
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
<script src="http://static.geetest.com/static/tools/gt.js"></script>
<script type="text/javascript">
	$.getJSON("<?php echo U('AjaxCommon/jobs_click');?>",{id:"<?php echo ($jobs_info["id"]); ?>"},function(result){
		if(result.status == 1){
			$('#J_jobs_click').html(result.data+'次');
		}
	});
	window._bd_share_config = {
		common : {
			bdText : "<?php echo ($jobs_info['jobs_name']); ?>-<?php echo ($jobs_info['companyname']); ?>-<?php echo C('qscms_site_name');?>",
			bdDesc : "<?php echo ($jobs_info['jobs_name']); ?>-<?php echo ($jobs_info['companyname']); ?>-<?php echo C('qscms_site_name');?>",
			bdUrl : "<?php if(!C('Apply.Subsite')): echo C('qscms_site_domain'); endif; echo ($jobs_info["jobs_url"]); ?>",
			bdPic : "<?php echo C('qscms_site_domain'); echo ($jobs_info['company']['logo']); ?>"
		},
		share : [{
			"tag" : "share_1",
			"bdCustomStyle":"__COMPANY__/default/css/jobs.css"
		}]
	}
	with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
    var isVisitor = "<?php echo ($visitor['uid']); ?>";
    $(document).ready(function(){
		$.getJSON("<?php echo U('ajaxCommon/company_statistics_add');?>",{comid:"<?php echo ($jobs_info['company_id']); ?>",jobid:"<?php echo ($jobs_info['id']); ?>"});
		// 点击显示地图
		$("#J_map").die().live('click',function(){
			var qsDialog = $(this).dialog({
				title: '工作地点',
				loading: true,
				showFooter: false,
				border: false
			});
			qsDialog.setContent('<div id="container" style="width:800px;height:500px;"></div>');
			var map = new BMap.Map("container");       // 创建地图实例
			var opts = {
			  width : 350,     // 信息窗口宽度
			  height: 80,     // 信息窗口高度
			  title : "<?php echo ($jobs_info['companyname']); ?>"  // 信息窗口标题
			}
			var infoWindow = new BMap.InfoWindow("", opts);  // 创建信息窗口对象
			var point = new BMap.Point("<?php echo ($jobs_info['map_x']); ?>","<?php echo ($jobs_info['map_y']); ?>");  // 创建点坐标
			map.centerAndZoom(point, "<?php echo ($jobs_info['map_zoom']); ?>");
			var qs_marker = new BMap.Marker(point);        // 创建标注
			map.addOverlay(qs_marker);
			map.openInfoWindow(infoWindow,point);
			map.setCenter(point);
			map.addControl(new BMap.NavigationControl());//添加鱼骨
			map.enableScrollWheelZoom();//启用滚轮放大缩小，默认禁用。
		});

		// 收藏职位点击事件绑定
		$(".favor").die().live('click',function(){
			var url = "<?php echo U('ajaxPersonal/jobs_favorites');?>";
			var jid = "<?php echo ($jobs_info['id']); ?>";
			if ((isVisitor > 0)) {
				$.getJSON(url,{jid:jid},function(result){
					if(result.status==1){
						disapperTooltip('success',result.msg);
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

		// 申请职位点击事件绑定
		$(".apply_jobs").die().live('click',function(){
			var qsDialog = $(this).dialog({
        		loading: true,
				footer: false,
				header: false,
				border: false,
				backdrop: false
			});
			if (eval(qscms.smsTatus)) {
                var url = "<?php echo U('ajaxPersonal/resume_apply');?>";
                var jid = "<?php echo ($jobs_info['id']); ?>";
                $.getJSON(url,{jid:jid},function(result){
                    if(result.status==1) {
                        if(result.data.html){
                            qsDialog.hide();
                            var qsDialogSon = $(this).dialog({
                                title: '申请职位',
                                content: result.data.html
                            });
                        }
                        else {
                            qsDialog.hide();
                            disapperTooltip("remind", result.msg);
                        }
                    }
                    else if(result.data==1){
                        qsDialog.hide();
                        disapperTooltip('remind',result.msg);
                        setTimeout(function() {
                            location.href="<?php echo U('Personal/resume_add');?>";
                        },1000);
                    }
                    else
                    {
                        if (eval(result.dialog)) {
                            var creatsUrl = "<?php echo U('AjaxPersonal/resume_add_dig');?>";
                            $.getJSON(creatsUrl,{jid:jid}, function(result){
                                if(result.status==1){
                                    qsDialog.hide();
                                    var qsDialogSon = $(this).dialog({
                                        content: result.data.html,
                                        footer: false,
                                        header: false,
                                        border: false
                                    });
                                    qsDialogSon.setInnerPadding(false);
                                } else {
                                    qsDialog.hide();
                                    disapperTooltip('remind',result.msg);
                                }
                            });
                        } else {
                            qsDialog.hide();
                            disapperTooltip('remind',result.msg);
                        }
                    }
                });
            } else {
                <?php if($visitor): ?>var url = "<?php echo U('ajaxPersonal/resume_apply');?>";
                    var jid = "<?php echo ($jobs_info['id']); ?>";
                    $.getJSON(url,{jid:jid},function(result){
                    if(result.status==1) {
                        if(result.data.html){
                            qsDialog.hide();
                            var qsDialogSon = $(this).dialog({
                                title: '申请职位',
                                content: result.data.html
                            });
                        }
                        else {
                            qsDialog.hide();
                            disapperTooltip("remind", result.msg);
                        }
                    }
                    else if(result.data==1){
                        qsDialog.hide();
                        disapperTooltip('remind',result.msg);
                        setTimeout(function() {
                            location.href="<?php echo U('Personal/resume_add');?>";
                        },1000);
                    }
                    else
                    {
                        if (eval(result.dialog)) {
                            var creatsUrl = "<?php echo U('AjaxPersonal/resume_add_dig');?>";
                            $.getJSON(creatsUrl,{jid:jid}, function(result){
                                if(result.status==1){
                                    qsDialog.hide();
                                    var qsDialogSon = $(this).dialog({
                                        content: result.data.html,
                                        footer: false,
                                        header: false,
                                        border: false
                                    });
                                    qsDialogSon.setInnerPadding(false);
                                } else {
                                    qsDialog.hide();
                                    disapperTooltip('remind',result.msg);
                                }
                            });
                        } else {
                            qsDialog.hide();
                            disapperTooltip('remind',result.msg);
                        }
                    }
                });
                <?php else: ?>
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
                    });<?php endif; ?>
            }
		});

		// 简历处理率提示
        $('.slitxthelp').hover(function () {
            $(this).find('.tip').show();
        },function () {
            $(this).find('.tip').hide();
        })
	});

	// 立即登录
	$('.J_resadd').die().live('click', function() {
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
	});

	// 给我留言
	$('.J_realyBth').die().live('click', function(){
		var u = $(this),
			f = u.closest('.J_realyWrap').find('textarea'),
			t = $.trim(f.val()),
			touid = u.attr('touid');
		$.post("<?php echo U('Personal/msg_feedback_send');?>",{touid:touid,message:t},function(result){
			if(result.status == 1){
				f.val('');
				disapperTooltip('success',result.msg);
			} else {
				if (eval(result.dialog)) {
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
				} else {
					disapperTooltip('remind',result.msg);
				}
			}
		},'json');
	});

    // 点击查看联系方式
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

	//举报职位
	$(".report").click(function(){
		var jobs_id = "<?php echo ($jobs_info['id']); ?>";
		var url = "<?php echo U('AjaxPersonal/report_jobs');?>";
		var qsDialog = $(this).dialog({
    		loading: true,
			footer: false,
			header: false,
			border: false,
			backdrop: false
		});
		$.getJSON(url,{jobs_id:jobs_id},function(result){
			if(result.status==1){
				qsDialog.hide();
				var qsDialogSon = $(this).dialog({
					title:'举报职位',
		    		content: result.data,
		    		footer: false
				});
			} else {
				if (eval(result.dialog)) {
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
				} else {
					qsDialog.hide();
					disapperTooltip('remind',result.msg);
				}
			}
		});
	});
</script>
</body>
</html>