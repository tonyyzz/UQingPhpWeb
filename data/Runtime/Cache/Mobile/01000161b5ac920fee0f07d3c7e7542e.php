<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
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
    <?php $tag_load_class = new \Common\qscmstag\loadTag(array('type'=>'category','search'=>'1','cache'=>'0','列表名'=>'list',));$list = $tag_load_class->category();?>
</head>
<body>
<div class="headernavfixed">
  <div class="headernav font18">
    <div class="title">
      <?php echo ((isset($page_seo["header_title"]) && ($page_seo["header_title"] !== ""))?($page_seo["header_title"]):"无标题"); ?>
      <div class="return js-back for-event"></div>
    <div class="rbtn for-event"></div>
    </div>
  </div>
	<div class="qspageso link_gray6">
  <div class="topbg">
		 <input value="<?php echo (urldecode(urldecode($_GET['key']))); ?>" type="text" class="soimput" id="J_soinput" placeholder="请输入关键字"/>
    	<div class="soselect qs-relative for-event">
		    <span class="for-type-txt"> <?php if($search_type == 'resume' or strtolower(CONTROLLER_NAME) == 'resume'): ?>搜简历<?php else: ?>搜职位<?php endif; ?></span>
		    <input type="hidden" class="for-type-code" id="search_type" name="search_type" value="<?php if(!empty($search_type)): echo ($search_type); else: if(strtolower(CONTROLLER_NAME) == 'resume'): ?>resume<?php else: ?>jobs<?php endif; endif; ?>">
	    </div>
	    <div class="so-close js-so-close"></div>
      <div class="rightbtn for-event cancel" id="J_submit">取消</div>
		  <!-- <div class="rightbtn-so for-event">搜索</div> -->
	  <div class="choose-s-type-group">
		  <div class="choose-s-type-cell qs-relative">
			  <div class="qs-center <?php if($search_type == 'jobs'): ?>qs-relative<?php endif; ?>"><div class="choose-s-type-list font14" data-code="jobs" data-title="职位">职位</div></div>
			  <div class="qs-center <?php if($search_type == 'resume'): ?>qs-relative<?php endif; ?>"><div class="choose-s-type-list sl2 font14" data-code="resume" data-title="简历">简历</div></div>
		  </div>
	  </div>
  </div>
  <div class="history"></div>
  
  <div class="clearkey  for-event" id="J_cleanhistory" style="display:none;">清空关键字</div>
  
  
  <div class="split-block"></div>
  
  <div class="sohot font12 link_gray6">
  <div class="hottitle font14 ">热门职位</div>
  <?php $tag_hotword_class = new \Common\qscmstag\hotwordTag(array('列表名'=>'hotword_list','显示数目'=>'12','cache'=>'0','type'=>'run',));$hotword_list = $tag_hotword_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"职位列表 - 骑士人才系统","keywords"=>"","description"=>"","header_title"=>"职位列表"),$hotword_list);?>
		<?php if(is_array($hotword_list)): $i = 0; $__LIST__ = $hotword_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hotword): $mod = ($i % 2 );++$i; if(C('qscms_key_urlencode') == 1): ?><a href="<?php echo url_rewrite('QS_jobslist',array('key'=>urlencode($hotword['w_word_code'])));?>" class="hotword substring for-event"><?php echo ($hotword["w_word"]); ?></a>
    <?php else: ?>
    <a href="<?php echo url_rewrite('QS_jobslist',array('key'=>$hotword['w_word_code']));?>" class="hotword substring for-event"><?php echo ($hotword["w_word"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
  <div class="clear"></div>
  <script src="../public/js/zepto.cookie.min.js"></script>
	  <script>
		  $('.js-so-close').on('click', function () {
			  $(this).closest('.topbg').find('.soimput').val('');
			  $('#J_submit').addClass('rightbtn');
			  $('#J_submit').removeClass('rightbtn-so');
			  $('#J_submit').addClass('cancel');
			  $('#J_submit').html('取消');
		  })
    if($('#J_soinput').val()){
      $('#J_submit').addClass('rightbtn-so');
      $('#J_submit').removeClass('rightbtn');
      $('#J_submit').removeClass('cancel');
      $('#J_submit').html('搜索');
    }
    get_history($('.history'));
    function get_history(d){
      var b = "", hlength = 0;
      var searchHistoryArr = new Array();
      if ($.fn.cookie("searchHistory")) {
        searchHistoryArr = $.fn.cookie("searchHistory").split(",");
      };
      if (searchHistoryArr.length == 0) {
        d.hide();
        return false
      }
      $.each(searchHistoryArr.reverse(), function(index, val) {
        hlength += 1;
        b += '<div class="record"><div class="keyimg history_go" data-self="'+val+'">'+val+'</div><div class="delimg close for-event"></div><div class="clear"></div></div>';
      });
      if (hlength > 0) {
        d.empty().html(b);
        $("#J_cleanhistory").show();
        $(".history_go").on("click", function() {
          searchGo($(this).data("self"));
        });
        $(".record .close").on("click", function() {
          var searchHistoryArr = $.fn.cookie("searchHistory").split(","),
            val = $(this).prev().data("self"),
            index = $.inArray(val,searchHistoryArr);
          if (index >= 0) {
            searchHistoryArr.splice(index,1);
          };
          $.fn.cookie("searchHistory",searchHistoryArr,{ path: '/' });
          $(this).parent().remove();
        });
      } else {
        d.empty();
        $("#J_cleanhistory").hide()
      }
    }
    function add_history(key){
      if (key.length > 0) {
        var searchHistoryArr = new Array();
        if ($.fn.cookie("searchHistory")) {
          searchHistoryArr = $.fn.cookie("searchHistory").split(",");
          var isOnly = true;
          $.each(searchHistoryArr, function(index, val) {
            if (val == key) {
              isOnly = false;
            };
          });
          if (isOnly) {
            if (searchHistoryArr.length >= 5) {
              searchHistoryArr.splice(0,1);
            }
            searchHistoryArr.push(key);
          };
        } else {
          searchHistoryArr.push(key);
        };
        $.fn.cookie("searchHistory",searchHistoryArr,{ path: '/' });
      }
    }
    function searchGo(key) {
      add_history(key);
      var search_type = $('#search_type').val();
      if(search_type=='jobs'){
        var url = qscms.root+"?m=Mobile&c=Jobs&a=index&key="+encodeURI(encodeURI(key));
      }else{
        var url = qscms.root+"?m=Mobile&c=Resume&a=index&key="+encodeURI(encodeURI(key));
      }
      window.location.href=url;
    }
		  $('.topbg .soselect').on('click', function () {
			  $('.topbg').toggleClass('for-type');
		  })
		  $('.choose-s-type-cell .qs-center').on('click', function () {
			  var stypeCode = $(this).find('.choose-s-type-list').data('code');
		  	var stypeTitle = $(this).find('.choose-s-type-list').data('title');
			  $('.for-type-code').val(stypeCode);
		  	$('.for-type-txt').text('搜' + stypeTitle);
			  $('.topbg').toggleClass('for-type');
		  });
      $('#J_submit').on('click',function(){
        if($(this).hasClass('cancel')){
          searchGo('');
        }else{
          searchGo($('#J_soinput').val());
        }
      });
      $("#J_cleanhistory").on("click", function() {
        $(this).hide();
        $(".history").hide();
        $.fn.cookie('searchHistory', null,{ path: '/' });
      });
      $('#J_soinput').on('keyup',function(){
        if($(this).val()!=''){
          $('#J_submit').addClass('rightbtn-so');
          $('#J_submit').removeClass('rightbtn');
          $('#J_submit').removeClass('cancel');
          $('#J_submit').html('搜索');
        }else{
          $('#J_submit').addClass('rightbtn');
          $('#J_submit').removeClass('rightbtn-so');
          $('#J_submit').addClass('cancel');
          $('#J_submit').html('取消');
        }
      });
      $('.hotword').on('click',function(){
        add_history($(this).text());
        window.location.href=$(this).attr('href');
        return false;
      });
	  </script>
</div>
</div>
<!--未登录显示以下 -->
<?php if(!C('visitor')): ?><div class="t-mask"></div>
    <div class="topnavshow">
	    
	  <div class="navlis">
	  	<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_index');?>'">
		  <div class="imgbox"><img src="../public/images/198.png" /></div>
		  <div class="tit">返回首页</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo U('Members/login');?>'">
		  <div class="imgbox"><img src="../public/images/192.png" /></div>
		  <div class="tit">登录/注册</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_jobslist');?>'">
		  <div class="imgbox"><img src="../public/images/197.png" /></div>
		  <div class="tit">找工作</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_resumelist');?>'">
		  <div class="imgbox"><img src="../public/images/196.png" /></div>
		  <div class="tit">招人才</div>
		</div>
		<?php if(!empty($apply['Jobfair'])): ?><div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_jobfairlist');?>'">
			<div class="imgbox"><img src="../public/images/199.png" /></div>
			<div class="tit">招聘会</div>
		</div><?php endif; ?>
		<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_newslist');?>'">
		  <div class="imgbox"><img src="../public/images/202.png" /></div>
		  <div class="tit">职场资讯</div>
		</div>
		<div class="clear"></div>
	  </div>
	  
      <div class="h-navclose qs-center"><div class="navclose"></div></div>
    </div>
<?php elseif(C('visitor.utype') == 1): ?>	
<!--企业已登录显示 -->
	<div class="t-mask"></div>
    <div class="topnavshow">
	   
	  <div class="navlis">
	  	<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_index');?>'">
		  <div class="imgbox"><img src="../public/images/198.png" /></div>
		  <div class="tit">返回首页</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo U('Company/index');?>'">
		  <div class="imgbox"><img src="../public/images/192.png" /></div>
		  <div class="tit">企业中心</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_resumelist');?>'">
			<div class="imgbox"><img src="../public/images/196.png" /></div>
			<div class="tit">搜索简历</div>
		</div>
		<div class="topnav" id='J_jobs_add_top'>
		  <div class="imgbox"><img src="../public/images/191.png" /></div>
		  <div class="tit">发布职位</div>
		</div>
		<div class="topnav" id="refresh_jobs_all_top">
		  <div class="imgbox"><img src="../public/images/195.png" /></div>
		  <div class="tit">一键刷新</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo U('Company/jobs_apply');?>'">
		  <div class="imgbox"><img src="../public/images/194.png" /></div>
		  <div class="tit">收到的简历</div>
		</div>
		<div class="clear"></div>
	  </div>
	  
      <div class="logout">
	    <div class="outbtn for-event">退出登录</div>
	  </div>
	    <div class="h-navclose qs-center"><div class="navclose"></div></div>
    </div>	
	

<?php else: ?>
<!--个人已登录显示 -->
	<div class="t-mask"></div>
   <div class="topnavshow">
	  <div class="navlis">
	  	<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_index');?>'">
		  <div class="imgbox"><img src="../public/images/198.png" /></div>
		  <div class="tit">返回首页</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo U('Personal/index');?>'">
		  <div class="imgbox"><img src="../public/images/192.png" /></div>
		  <div class="tit">个人中心</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo url_rewrite('QS_jobslist');?>'">
		  <div class="imgbox"><img src="../public/images/197.png" /></div>
		  <div class="tit">搜索职位</div>
		</div>
		<div class="topnav" id="preview_resume_top" pid="<?php echo ($resume['id']); ?>">
		  <div class="imgbox"><img src="../public/images/200.png" /></div>
		  <div class="tit">预览简历</div>
		</div>
		<div class="topnav" id="refresh_resume_top" pid="<?php echo ($resume['id']); ?>">
		  <div class="imgbox"><img src="../public/images/195.png" /></div>
		  <div class="tit">一键刷新</div>
		</div>
		<div class="topnav" onclick="javascript:location.href='<?php echo U('Personal/jobs_interview');?>'">
		  <div class="imgbox"><img src="../public/images/193.png" /></div>
		  <div class="tit">面试通知</div>
		</div>
		<div class="clear"></div>
	  </div>
	  
      <div class="logout">
	    <div class="outbtn for-event">退出登录</div>
	  </div>
	   <div class="h-navclose qs-center"><div class="navclose"></div></div>
    </div><?php endif; ?>
	<!--搜搜层 -->
</div>
<div class="split-block-title">
    <div class="sbox js-show-qspageso">
	    <?php echo (urldecode(urldecode((isset($_GET['key']) && ($_GET['key'] !== ""))?($_GET['key']):"请输入职位名/公司名关键字"))); ?>
	    <script>
		    // 显示搜索层
		    $('.js-show-qspageso').on('click', function(){
			    $('.qspageso').toggle();
		    });
	    </script>
    </div>
</div>
<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'jobs_cate_info','类型'=>'QS_jobs_info','cache'=>'0','type'=>'run',));$jobs_cate_info = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"职位列表 - 骑士人才系统","keywords"=>"","description"=>"","header_title"=>"职位列表"),$jobs_cate_info);?>
<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'wage_list','类型'=>'QS_wage','显示数目'=>'100','cache'=>'0','type'=>'run',));$wage_list = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"职位列表 - 骑士人才系统","keywords"=>"","description"=>"","header_title"=>"职位列表"),$wage_list);?>
<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'experience_list','类型'=>'QS_experience','显示数目'=>'100','cache'=>'0','type'=>'run',));$experience_list = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"职位列表 - 骑士人才系统","keywords"=>"","description"=>"","header_title"=>"职位列表"),$experience_list);?>
<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'nature_list','类型'=>'QS_jobs_nature','显示数目'=>'100','cache'=>'0','type'=>'run',));$nature_list = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"职位列表 - 骑士人才系统","keywords"=>"","description"=>"","header_title"=>"职位列表"),$nature_list);?>
<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'education_list','类型'=>'QS_education','显示数目'=>'100','cache'=>'0','type'=>'run',));$education_list = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"职位列表 - 骑士人才系统","keywords"=>"","description"=>"","header_title"=>"职位列表"),$education_list);?>
<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'tag_list','类型'=>'QS_jobtag','显示数目'=>'100','cache'=>'0','type'=>'run',));$tag_list = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"职位列表 - 骑士人才系统","keywords"=>"","description"=>"","header_title"=>"职位列表"),$tag_list);?>
<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'trade_list','类型'=>'QS_trade','显示数目'=>'100','cache'=>'0','type'=>'run',));$trade_list = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"职位列表 - 骑士人才系统","keywords"=>"","description"=>"","header_title"=>"职位列表"),$trade_list);?>
<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'city','类型'=>'QS_citycategory','地区分类'=>$_GET['citycategory'],'显示数目'=>'100','cache'=>'0','type'=>'run',));$city = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"职位列表 - 骑士人才系统","keywords"=>"","description"=>"","header_title"=>"职位列表"),$city);?>
<div class="filter-group x4 filter-outer">
    <div id="f-mask"></div>
    <div class="filter-outer">
      <div class="filter-list js-filter qs-temp" data-tag="0" data-type="city" data-base="QS_city_parent" data-source="QS_city" data-multiple="false" data-num="3" data-link="true" data-range="true" data-level="<?php echo C('qscms_category_district_level');?>"><div class="filter-cell"><div class="filter-cell-txt qs-temp-txt-city"><?php echo ((isset($city['select']['categoryname']) && ($city['select']['categoryname'] !== ""))?($city['select']['categoryname']):"地区"); ?></div></div></div>
      <div class="filter-list js-filter" data-tag="1"><div class="filter-cell"><div class="filter-cell-txt f-normal-txt-wage"><?php echo ((isset($wage_list[$_GET['wage']]) && ($wage_list[$_GET['wage']] !== ""))?($wage_list[$_GET['wage']]):"薪资"); ?></div></div></div>
      <div class="filter-list js-filter" data-tag="2"><div class="filter-cell"><div class="filter-cell-txt f-normal-txt-exp"><?php echo ((isset($experience_list[$_GET['experience']]) && ($experience_list[$_GET['experience']] !== ""))?($experience_list[$_GET['experience']]):"经验"); ?></div></div></div>
      <div class="filter-list js-filter" data-tag="3"><div class="filter-cell"><div class="filter-cell-txt">更多</div></div></div>
      <div class="clear"></div>
      <div class="qs-actionmore"></div>
	    <form id="searchForm">
		    <input type="hidden" class="" name="key" value="<?php echo (urldecode(urldecode($_GET['key']))); ?>">
		    <input type="hidden" class="qs-recover-code-job" name="jobcategory" value="<?php echo ($_GET['jobcategory']); ?>">
		    <input type="hidden" class="qs-temp-code-city" name="citycategory" value="<?php echo ($_GET['citycategory']); ?>">
		    <input type="hidden" class="f-normal-code-wage" name="wage" value="<?php echo ($_GET['wage']); ?>">
		    <input type="hidden" class="f-normal-code-exp" name="experience" value="<?php echo ($_GET['experience']); ?>">
		    <input type="hidden" class="f-more-l-code-nature" name="nature" value="<?php echo ($_GET['nature']); ?>">
		    <input type="hidden" class="f-more-l-code-edu" name="education" value="<?php echo ($_GET['education']); ?>">
		    <input type="hidden" class="f-more-l-code-tag" name="jobtag" value="<?php echo ($_GET['jobtag']); ?>">
		    <input type="hidden" class="f-more-l-code-trade" name="trade" value="<?php echo ($_GET['trade']); ?>">
		    <input type="hidden" class="f-more-l-code-settr" name="settr" value="<?php echo ($_GET['settr']); ?>">
		    <input type="hidden" class="f-deliver" name="deliver" value="<?php echo ($_GET['deliver']); ?>">
		    <input type="hidden" class="qs-temp-code-range" name="range" value="<?php echo ($_GET['range']); ?>">
	    </form>
	    <input type="hidden" class="f-seach-page" value="?m=Mobile&c=Jobs&a=index&">
    </div>
    <div class="con-filter">
        <div class="f-box f-box-city"></div>
		    <div class="f-box f-box-wage">
			    <div class="f-box-inner">
				    <li><a class="f-item f-item-normal <?php if($_GET['wage']== 0): ?>select<?php endif; ?>" href="javascript:;" data-type="wage" data-code="0" data-title="不限">不限</a></li>
            <?php if(is_array($wage_list)): $i = 0; $__LIST__ = $wage_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$wage): $mod = ($i % 2 );++$i;?><li><a class="f-item f-item-normal <?php if($_GET['wage']== $key): ?>select<?php endif; ?>" href="javascript:;" data-type="wage" data-code="<?php echo ($key); ?>" data-title="<?php echo ($wage); ?>"><?php echo ($wage); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			    </div>
		    </div>
		    <div class="f-box f-box-exp">
			    <div class="f-box-inner">
				    <li><a class="f-item f-item-normal <?php if($_GET['experience']== 0): ?>select<?php endif; ?>" href="javascript:;" data-type="exp" data-code="0" data-title="不限">不限</a></li>
            <?php if(is_array($experience_list)): $i = 0; $__LIST__ = $experience_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$experience): $mod = ($i % 2 );++$i;?><li><a class="f-item f-item-normal <?php if($_GET['experience']== $key): ?>select<?php endif; ?>" href="javascript:;" data-type="exp" data-code="<?php echo ($key); ?>" data-title="<?php echo ($experience); ?>"><?php echo ($experience); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			    </div>
		    </div>
		    <div class="f-box f-box-more">
			    <div class="f-box-inner">
				    <ul class="arrow">
					    <li class="clicked">过滤已投递<span><span class="clickedbox js-clickedbox"></span></span></li>
					    <li><a href="javascript:;" data-id="filter-nature" class="js-more-l">工作性质<span class="choice f-more-l-txt-nature"><?php echo ((isset($nature_list[$_GET['nature']]) && ($nature_list[$_GET['nature']] !== ""))?($nature_list[$_GET['nature']]):"不限"); ?></span></a></li>
					    <li><a href="javascript:;" data-id="filter-edu" class="js-more-l">学历要求<span class="choice f-more-l-txt-edu"><?php echo ((isset($education_list[$_GET['education']]) && ($education_list[$_GET['education']] !== ""))?($education_list[$_GET['education']]):"不限"); ?></span></a></li>
					    <li><a href="javascript:;" data-id="filter-tag" class="js-more-l">福利待遇<span class="choice f-more-l-txt-tag"><?php echo ((isset($tag_list[$_GET['jobtag']]) && ($tag_list[$_GET['jobtag']] !== ""))?($tag_list[$_GET['jobtag']]):"不限"); ?></span></a></li>
					    <li><a href="javascript:;" data-id="filter-trade" class="js-more-l">行业<span class="choice f-more-l-txt-trade"><?php echo ((isset($trade_list[$_GET['trade']]) && ($trade_list[$_GET['trade']] !== ""))?($trade_list[$_GET['trade']]):"不限"); ?></span></a></li>
					    <li><a href="javascript:;" data-id="filter-settr" class="js-more-l">更新时间<span class="choice f-more-l-txt-settr">
					    	<?php switch($_GET['settr']): case "": ?>不限<?php break;?>
					    		<?php case "0": ?>不限<?php break;?>
								<?php case "3": ?>3天内<?php break;?>
								<?php case "7": ?>7天内<?php break;?>
								<?php case "15": ?>15天内<?php break;?>
								<?php case "30": ?>30天内<?php break; endswitch;?>
					    </span></a></li>
				    </ul>
			    </div>
			    <div class="f-btn-submit qs-center"><div href="javascript:;" class="qs-btn qs-btn-inline qs-btn-small qs-btn-orange" id="f-do-filter"> 筛 选 </div></div>
			    <div class="f-btn-back qs-center"><div href="javascript:;" class="qs-btn qs-btn-inline qs-btn-small qs-btn-orange f-more-back-btn"> 返 回 </div></div>
		    </div>
	      <div class="f-box f-more-content" id="filter-nature">
		      <div class="f-box-inner">
			      <ul>
				      <li class="selected"><a href="javascript:;" class="f-more-back-a <?php if($_GET['nature']== 0): ?>select<?php endif; ?>" data-type="nature" data-title="不限" data-code="0">不限</a></li>
              <?php if(is_array($nature_list)): $i = 0; $__LIST__ = $nature_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nature): $mod = ($i % 2 );++$i;?><li class="selected"><a href="javascript:;" class="f-more-back-a <?php if($_GET['nature']== $key): ?>select<?php endif; ?>" data-type="nature" data-title="<?php echo ($nature); ?>" data-code="<?php echo ($key); ?>"><?php echo ($nature); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			      </ul>
		      </div>
	      </div>
		    <div class="f-box f-more-content" id="filter-edu">
			    <div class="f-box-inner">
				    <ul>
              <li class="selected"><a href="javascript:;" class="f-more-back-a <?php if($_GET['education']== 0): ?>select<?php endif; ?>" data-type="edu" data-title="不限" data-code="0">不限</a></li>
              <?php if(is_array($education_list)): $i = 0; $__LIST__ = $education_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$education): $mod = ($i % 2 );++$i;?><li class="selected"><a href="javascript:;" class="f-more-back-a <?php if($_GET['education']== $key): ?>select<?php endif; ?>" data-type="edu" data-title="<?php echo ($education); ?>" data-code="<?php echo ($key); ?>"><?php echo ($education); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				    </ul>
			    </div>
		    </div>
		    <div class="f-box f-more-content" id="filter-tag">
			    <div class="f-box-inner">
				    <ul>
              <li class="selected"><a href="javascript:;" class="f-more-back-a <?php if($_GET['jobtag']== 0): ?>select<?php endif; ?>" data-type="tag" data-title="不限" data-code="0">不限</a></li>
              <?php if(is_array($tag_list)): $i = 0; $__LIST__ = $tag_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?><li class="selected"><a href="javascript:;" class="f-more-back-a <?php if($_GET['jobtag']== $key): ?>select<?php endif; ?>" data-type="tag" data-title="<?php echo ($tag); ?>" data-code="<?php echo ($key); ?>"><?php echo ($tag); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				    </ul>
			    </div>
		    </div>
		    <div class="f-box f-more-content" id="filter-trade">
			    <div class="f-box-inner">
				    <ul>
              <li class="selected"><a href="javascript:;" class="f-more-back-a <?php if($_GET['trade']== 0): ?>select<?php endif; ?>" data-type="trade" data-title="不限" data-code="0">不限</a></li>
              <?php if(is_array($trade_list)): $i = 0; $__LIST__ = $trade_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$trade): $mod = ($i % 2 );++$i;?><li class="selected"><a href="javascript:;" class="f-more-back-a <?php if($_GET['trade']== $key): ?>select<?php endif; ?>" data-type="trade" data-title="<?php echo ($trade); ?>" data-code="<?php echo ($key); ?>"><?php echo ($trade); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				    </ul>
			    </div>
		    </div>
		    <div class="f-box f-more-content" id="filter-settr">
			    <div class="f-box-inner">
				    <ul>
              <li class="selected"><a href="javascript:;" class="f-more-back-a <?php if($_GET['settr']== 0): ?>select<?php endif; ?>" data-type="settr" data-title="不限" data-code="0">不限</a></li>
              <li class="selected"><a href="javascript:;" class="f-more-back-a <?php if($_GET['settr']== 3): ?>select<?php endif; ?>" data-type="settr" data-title="3天内" data-code="3">3天内</a></li>
              <li class="selected"><a href="javascript:;" class="f-more-back-a <?php if($_GET['settr']== 7): ?>select<?php endif; ?>" data-type="settr" data-title="7天内" data-code="7">7天内</a></li>
              <li class="selected"><a href="javascript:;" class="f-more-back-a <?php if($_GET['settr']== 15): ?>select<?php endif; ?>" data-type="settr" data-title="15天内" data-code="15">15天内</a></li>
              <li class="selected"><a href="javascript:;" class="f-more-back-a <?php if($_GET['settr']== 30): ?>select<?php endif; ?>" data-type="settr" data-title="30天内" data-code="30">30天内</a></li>
				    </ul>
			    </div>
		    </div>
    </div>
</div>
<div class="list-split-block lower"></div>
<?php if($_GET['jobcategory']!= ''): ?><div class="list-jobcategory-block font13">
		<div class="l-recover-job-txt">当前在  <span class="l-cetgory"><?php echo ($jobs_cate_info['spell'][$_GET['jobcategory']]['categoryname']); ?></span> 分类下</div>
		<div class="l-recover-close js-clearjob-jobcategory">清空分类</div>
	</div><?php endif; ?>
<?php $tag_jobs_list_class = new \Common\qscmstag\jobs_listTag(array('列表名'=>'jobslist','搜索类型'=>$_GET['search_type'],'搜索内容'=>$_GET['search_cont'],'显示数目'=>'20','分页显示'=>'1','关键字'=>$_GET['key'],'职位分类'=>$_GET['jobcategory'],'地区分类'=>$_GET['citycategory'],'行业'=>$_GET['trade'],'日期范围'=>$_GET['settr'],'学历'=>$_GET['education'],'工作经验'=>$_GET['experience'],'工资'=>$_GET['wage'],'职位性质'=>$_GET['nature'],'标签'=>$_GET['jobtag'],'公司规模'=>$_GET['scale'],'营业执照'=>$_GET['license'],'过滤已投递'=>$_GET['deliver'],'排序'=>$_GET['sort'],'合并'=>$_COOKIE['com_list'],'描述长度'=>'100','搜索范围'=>$_GET['range'],'cache'=>'0','type'=>'run',));$jobslist = $tag_jobs_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"职位列表 - 骑士人才系统","keywords"=>"","description"=>"","header_title"=>"职位列表"),$jobslist);?>
<?php if(!empty($jobslist['list'])): if(is_array($jobslist['list'])): $i = 0; $__LIST__ = $jobslist['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jobs): $mod = ($i % 2 );++$i;?><div class="job-list-item for-event" onclick="javascript:location.href='<?php echo ($jobs["jobs_url"]); ?>'">
    <div class="info">
        <div class="line-one">
            <div class="job-name substring font16"><?php echo ($jobs["jobs_name"]); ?>
            <?php if($jobs['emergency'] == 1): ?><img src="../public/images/231.png"/><?php endif; ?>
            </div>
            <?php if($jobs['stick'] == 1 && (($_GET['search_type'] == 'jobs' or $_GET['search_type'] == 'company' or $_GET['key'] == '') && !$_GET['sort'])): ?><div class="refresh-time font12 font_red_light">置顶</div>
            <?php else: ?>
            <div class="refresh-time font12"><?php echo ($jobs['refreshtime_cn']); ?></div><?php endif; ?>
            <div class="clear"></div>
        </div>
        <div class="line-two font14">
            <div class="salary"><?php echo ($jobs["wage_cn"]); ?></div>
            <div class="category substring"><?php echo ($jobs["category_cn"]); ?></div>
            <div class="clear"></div>
        </div>
        <?php if(empty($jobs['tag_cn'])): ?><div class="line-four font13">
            <?php echo ($jobs["education_cn"]); ?> / <?php echo ($jobs["experience_cn"]); ?> / 年龄<?php echo ($jobs['age_cn']); ?>
        </div>
        <?php else: ?>
        <div class="line-three font12">
            <?php if(is_array($jobs['tag_cn'])): $i = 0; $__LIST__ = array_slice($jobs['tag_cn'],0,4,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?><div class="job-tag"><?php echo ($tag); ?></div><?php endforeach; endif; else: echo "" ;endif; ?>
            <div class="clear"></div>
        </div><?php endif; ?>
        <div class="apply-btn apply_jobs" data-jid="<?php echo ($jobs['id']); ?>" onClick="event.cancelBubble = true">申请</div>
    </div>
    <div class="company font13">
        <div class="company-name substring"><?php echo ($jobs["companyname"]); ?></div>
        <div class="district <?php if($_GET['range']!= ''): ?>range<?php endif; ?> substring"><?php if($_GET['range']!= ''): echo ($jobs["map_range"]); else: echo ($jobs["district_cn"]); endif; ?></div>
        <div class="clear"></div>
    </div>
</div>
<div class="list-split-block"></div><?php endforeach; endif; else: echo "" ;endif; ?>
<div class="qspage"><?php echo ($jobslist['page']); ?></div>
<?php else: ?>
    <div class="list-split-block"></div>
    <div class="list-empty link_blue">
        抱歉，没有找到符合您条件的职位！<br />
        放宽搜索条件也许有更多合适您的职位哦~
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
<!--<script src="../public/js/inobounce.js"></script>-->
<script src="../public/js/QSfilter.js"></script>
<script src="../public/js/qsCategory.js"></script>
</body>
<script>
	// 过滤已投递恢复
	var recoverDeliver = '<?php echo ($_GET['deliver']); ?>';
	if (eval(recoverDeliver)) {
		$('.js-clickedbox').addClass('clickedchoice');
	}
	// 更多列表左右切换
	 $('.js-more-l').on('click', function () {
		 var targetId = $(this).data('id');
		 $('.f-box-more').toggleClass('qs-actionsheet-toggle-left');
		 $('#' + targetId).toggleClass('qs-actionsheet-toggle');
	 })
	 $('.f-more-back-btn').on('click', function () { // 更多列表切换返回
		 $('.f-box-more').toggleClass('qs-actionsheet-toggle-left');
		 $('.f-more-content').removeClass('qs-actionsheet-toggle');
	 })
	 $('.f-more-back-a').on('click', function () { // 更多列表项点击
	 	 var thisType = $(this).data('type');
		 var thisTitle = $(this).data('title');
		 var thisCode = $(this).data('code');
		 $('.f-more-l-code-' + thisType).val(thisCode);
		 $('.f-more-l-txt-' + thisType).text(thisTitle);
		 $('.f-box-more').toggleClass('qs-actionsheet-toggle-left');
		 $('.f-more-content').removeClass('qs-actionsheet-toggle');
	 })
		// 除更多和读取缓存之外的下拉列表
	 $('.f-item-normal').on('click', function () {
		 var thisType = $(this).data('type');
		 var thisTitle = $(this).data('title');
		 var thisCode = $(this).data('code');
		 $('.f-normal-code-' + thisType).val(thisCode);
		 $('.f-normal-txt-' + thisType).text(thisTitle);
		 $('body').removeClass('filter-fixed');
		 $('.f-box-' + thisType).addClass('qs-hidden');
		 $('.js-filter').removeClass('active');
		 $('#f-mask').hide();
		 goPage();
	 })
	 // 过滤已投递
	 $('.js-clickedbox').on('click', function () {
		 if ($(this).hasClass('clickedchoice')) {
		 	 $(this).removeClass('clickedchoice');
			 $('.f-deliver').val('0');
		 } else {
			 $(this).addClass('clickedchoice');
			 $('.f-deliver').val('1');
		 }
	 })
	// 清空已选分类
	$('.js-clearjob-jobcategory').on('click', function () {
		$('.qs-recover-code-job').val('');
		goPage();
	})
	 // 跳转方法
	 function goPage() {
		 var toSearchPage = $('.f-seach-page').val();
		 window.location.href = qscms.root + toSearchPage + $('#searchForm').serialize();
	 }
		// 点击筛选
		$('#f-do-filter').on('click', function () {
			goPage();
		});
    var isVisitor = "<?php echo C('visitor.uid');?>";
    $('.js-filter').on('click', function () {
      var filter = new QSfilter($(this));
	    document.getElementById('f-mask').ontouchstart = function(e){ e.preventDefault(); }
    });
    // 申请职位点击事件绑定
    $(".apply_jobs").on('click',function(){
      var url = "<?php echo U('ajaxPersonal/resume_apply');?>";
      var jid = $(this).data('jid');
      if ((isVisitor > 0)) {
        $.getJSON(url,{jid:jid},function(result){
          if(result.status==1){
            qsToast({type:1,context: result.msg});
          } else {
            qsToast({type:2,context: result.msg});
		return false;
            
          }
        });
      } else {
          if (eval(qscms.smsTatus)) {
              window.location.href=qscms.root+'?m=Mobile&c=AjaxPersonal&a=resume_add_dig&jid='+jid;
          } else {
              window.location.href="<?php echo url_rewrite('QS_login');?>";
          }
      }
    });
</script>
</html>