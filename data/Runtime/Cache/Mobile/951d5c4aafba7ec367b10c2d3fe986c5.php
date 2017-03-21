<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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
    <?php $tag_jobs_show_class = new \Common\qscmstag\jobs_showTag(array('列表名'=>'jobs_info','职位id'=>$_GET['id'],'cache'=>'0','type'=>'run',));$jobs_info = $tag_jobs_show_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"职位详情 - 骑士人才系统","keywords"=>"","description"=>"","header_title"=>"职位详情"),$jobs_info);?>
    <link rel="stylesheet" href="../public/css/jobs.css">
    
    
<script src="../public/layer/jquery-1.11.3.js" type="text/javascript"></script>
<script src="../public/layer/layer.js" type="text/javascript"></script> 
<link rel="stylesheet" href="../public/zpH5/style/reset.css" />
<link rel="stylesheet" href="../public/zpH5/style/center.css" />
<link rel="stylesheet" href="../public/zpH5/style/mui.poppicker.css" />
<link rel="stylesheet" href="../public/zpH5/style/mui.picker.css" />
<link rel="stylesheet" href="../public/zpH5/style/mui.dtpicker.css" />
<script src="../public/zpH5/js/mui.min.js"></script>
<script src="../public/zpH5/js/mui.picker.js"></script>
<script src="../public/zpH5/js/mui.picker.all.js"></script>
<script src="../public/zpH5/js/city.data-3.js" type="text/javascript" charset="utf-8"></script>
<script src="../public/zpH5/js/date.data-3.js" type="text/javascript" charset="utf-8"></script>
<style>
		.btn-boxs{
			width: 100%;
			overflow: hidden;
			margin-top: 30px;
		}
		.btn-boxs li{
			width: 42%;
			float: left;
			text-align: center;
			border: 1px solid #ccc;
			border-radius: 3px;
			margin: 0 4% 4% 4%;
			box-sizing:border-box;
			-moz-box-sizing:border-box;	
			-webkit-box-sizing:border-box;
			padding: 8px 0;

		}
		.modal-overlay
		{
			position: fixed;/*absolute;*/
		    left: 0;
		    top: 0;
		    width: 100%;
		    height: 100%;
		    background: rgba(0, 0, 0, 0.4);
		    z-index: 10000;
		    visibility: hidden;
		    opacity: 0;
		    -webkit-transition-duration: 400ms; 
		    -moz-transition-duration: 400ms;
		    -ms-transition-duration: 400ms;
		    -o-transition-duration: 400ms;
		    transition-duration: 400ms; 
		}
		.modal.modal-in {
			display: block;
		    opacity: 1;
		    -webkit-transition-duration: 400ms;
		    -moz-transition-duration: 400ms;
		    -ms-transition-duration: 400ms;
		    -o-transition-duration: 400ms;
		    transition-duration: 400ms;
		    -webkit-transform: translate3d(0%, 0%, 0) scale(1);
		    -moz-transform: translate3d(0%, 0%, 0) scale(1);
		    -ms-transform: translate3d(0%, 0%, 0) scale(1);
		    -o-transform: translate3d(0%, 0%, 0) scale(1);
		    transform: translate3d(0%, 0%, 0) scale(1);
		}
		.modal {
			display: none;
		    width: 270px;
		    position: fixed;
		    z-index: 11000;
		    left: 50%;
		    margin-left: -135px;
		    margin-top: 0;
		    top: 50%;
		    text-align: center;
		    border-radius: 7px;
		    opacity: 0;
		    -webkit-transform: translate3d(0%, 0%, 0) scale(1.185);
		    -moz-transform: translate3d(0%, 0%, 0) scale(1.185);
		    -ms-transform: translate3d(0%, 0%, 0) scale(1.185);
		    -o-transform: translate3d(0%, 0%, 0) scale(1.185);
		    transform: translate3d(0%, 0%, 0) scale(1.185);
		    -webkit-transition-property: -webkit-transform, opacity;
		    -moz-transition-property: -moz-transform, opacity;
		    -ms-transition-property: -ms-transform, opacity;
		    -o-transition-property: -o-transform, opacity;
		    transition-property: transform, opacity;
		}
		.modal-inner {
		    padding: 15px;
		    border-bottom: 1px solid #b5b5b5;
		    border-radius: 7px 7px 0 0;
		    background: #e8e8e8;
		}
		.modal-title {
		    font-weight: 500;
		    line-height: 36px;
		    font-size: 18px;
		    text-align: center;
		}
		.modal-buttons {
		    height: 44px;
		    overflow: hidden;
		    display: -webkit-box;
		    display: -moz-box;
		    display: -ms-flexbox;
		    display: -webkit-flex;
		    display: flex;
		    -webkit-justify-content: center;
		    -moz-justify-content: center;
		    -ms-justify-content: center;
		    justify-content: center;
		    border-radius: 0 0 7px 7px;
		}
	.modal-button {
	    width: 100%;
	    padding: 0 5px;
	    height: 44px;
	    font-size: 17px;
	    line-height: 44px;
	    text-align: center;
	    color: #007aff;
	    background: #e8e8e8;
	    display: block;
	    position: relative;
	    white-space: nowrap;
	    text-overflow: ellipsis;
	    overflow: hidden;
	    cursor: pointer;
	    -webkit-box-sizing: border-box;
	    -moz-box-sizing: border-box;
	    box-sizing: border-box;
	    border-right: 1px solid #b5b5b5;
	}
	.modal-button:last-child {
	    border-right: none;
	    border-radius: 0px 0px 7px 0px;
	}
	</style>
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
  <?php $tag_hotword_class = new \Common\qscmstag\hotwordTag(array('列表名'=>'hotword_list','显示数目'=>'12','cache'=>'0','type'=>'run',));$hotword_list = $tag_hotword_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"职位详情 - 骑士人才系统","keywords"=>"","description"=>"","header_title"=>"职位详情"),$hotword_list);?>
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
	<!-- 按钮div -->
<div class="modal-overlay"></div>
<div class="modal" style="margin-top: -99px;">
	<div class="modal-inner">
		<div class="modal-title">您确定要申请该职位吗?</div>
	</div>
	<div class="modal-buttons">
		<span class="modal-button modal-button1">取消</span>
		<span class="modal-button modal-button-bold modal-button-bold1">确定</span>
	</div>
</div>
<div class="jobsshowtop">
  <div class="jobsname font18"><?php echo ($jobs_info["jobs_name"]); ?>
      <?php if($jobs_info['emergency'] == 1): ?><img src="../public/images/231.png"/><?php endif; ?>
  </div>
  <div class="wage font18"><?php echo ($jobs_info["wage_cn"]); ?></div>
  <div class="city font14"><?php echo ($jobs_info["district_cn"]); ?></div>
  <div class="time font12"><?php echo ($jobs_info['refreshtime_cn']); ?></div>
</div>


<div class="jobsshowatt">
  <div class="attul">
  	<div class="attli t1">性别<?php echo ($jobs_info["sex_cn"]); ?></div>
	<div class="attli t2"><?php if($jobs_info["education"] == 0): ?>学历不限<?php else: echo ($jobs_info["education_cn"]); endif; ?></div>
	<div class="attli t3"><?php if($jobs_info["experience"] == 0): ?>经验不限<?php else: echo ($jobs_info["experience_cn"]); endif; ?></div>
	<div class="attli t4"><?php echo ($jobs_info["nature_cn"]); ?></div>
	<div class="attli t5"><?php if($jobs_info["age_cn"] == '不限'): ?>年龄不限<?php else: echo ($jobs_info["age_cn"]); endif; ?></div>
	<div class="attli t6"><?php if($jobs_info['department']): echo ($jobs_info["department"]); else: ?>部门不限<?php endif; ?></div>
	<div class="clear"></div>
  </div>
</div>

<?php if($jobs_info['tag_cn']): ?><div class="split-block"></div>
<div class="jobsshowtag font13">
  <div class="tagul">
  <?php if(is_array($jobs_info['tag_cn'])): $i = 0; $__LIST__ = $jobs_info['tag_cn'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?><div class="tagli substring"><?php echo ($tag); ?></div><?php endforeach; endif; else: echo "" ;endif; ?>
	<div class="clear"></div>
  </div>
</div><?php endif; ?>
<div class="split-block"></div>

<div class="jobsshowcom" onclick="javascript:location.href='<?php echo ($jobs_info["company_url"]); ?>'">
  	<div class="leftpic">
		<div class="imgbox"><img src="<?php echo ($jobs_info["company"]["logo"]); ?>"></div>
	</div>
    <div class="comtxt">
	  	<div class="cname font15 substring"><?php echo ($jobs_info["company"]["companyname"]); ?>
            <?php if($jobs_info['company']['audit'] == 1): ?><img src="../public/images/120.png" title="认证企业"><?php endif; ?>
            <?php if($jobs_info['company']['setmeal_id'] > 1): ?><img src="../public/images/121.png" title="<?php echo ($info["setmeal_name"]); ?>"><?php endif; ?>
            <?php if($jobs_info['company']['famous'] == 1): ?><img src="../public/images/122.png" title="诚聘通企业"><?php endif; ?>
        </div>
        <div class="city font12"><?php echo ($jobs_info["company"]["scale_cn"]); ?>  | <?php echo ($jobs_info["company"]["nature_cn"]); ?></div>
		<div class="trade font12"><?php echo ($jobs_info["company"]["trade_cn"]); ?></div>
    </div>
	<div class="clear"></div>
  
</div>



<div class="jobsshowadder link_gray6">
    <div class="adder">
    <?php if($jobs_info['map_x'] > 0 && $jobs_info['map_y'] > 0): ?><a class="show-map" href="#map">地址：<?php echo ($jobs_info["company"]["address"]); ?><img src="../public/images/123.png"></a>
    <?php else: ?>
        地址：<?php echo ($jobs_info["company"]["address"]); endif; ?>
    </div>
</div>

<div class="split-block"></div>

<div class="jobsshowst">
  <div class="eattitle list_height">
  职位统计
    <div class="ritle font12">企业最近登录: <?php echo ($jobs_info["company"]["last_login_time"]); ?></div>
  </div>

  <div class="stli"><span><?php echo ($jobs_info["company"]["reply_ratio"]); ?>%</span><br>简历处理率</div>
  <div class="stli"><span><?php echo ($jobs_info["company"]["reply_time"]); ?></span><br>简历平均处理时长</div>
  <div class="clear"></div>
</div>

<div class="split-block"></div>

<div class="jobsshowsdes">
  <div class="eattitle list_height">职位描述</div> 
  <div class="txt"><?php echo ($jobs_info["contents"]); ?></div>
</div>

<div class="split-block"></div>


<div class="jobsshowcon">
  <div class="eattitle list_height">
  联系方式
    <?php if(!C('visitor.utype')): ?><div class="ritle font12" onclick="javascript:location.href='<?php echo U('members/login');?>'">请登录后查看联系方式</div><?php endif; ?>
  </div>
  <?php if($jobs_info['contact']['telephone_show'] == 0): ?><div class="mob">企业设置不公开</div>
  <?php else: ?>
  <div class="mob"><?php echo ($jobs_info["contact"]["telephone"]); ?> 
  <?php if($jobs_info['contact']['contact_show'] == 1): ?>(<?php echo ($jobs_info["contact"]["contact"]); ?>)<?php endif; ?>
  </div><?php endif; ?>
  <div class="map link_blue"><?php echo ($jobs_info["contact"]["address"]); ?> <?php if($jobs_info['map_x'] > 0 && $jobs_info['map_y'] > 0): ?><a class="show-map" href="#map">[地图]</a><?php endif; ?></div>
  <?php if($jobs_info['company']['famous'] == 1): ?><div class="tip font12">该企业已加入诚聘通会员，可放心求职</div>
  <?php else: ?>
   <div class="tip font12">面试过程中，遇到用人单位收取费用请提高警惕！</div><?php endif; ?>
  
  <div class="big-box" style="padding-bottom:0px;">
	<div class="center-box">
		<h2>企业HR要求您完善以下简历基本信息</h2>
		<form action="#">
			<ul>
				<li>
					<label for="">姓名</label>
					<div class="input-box">
						<input type="text" name="name" placeholder="必填">
					</div>
				</li>
				<li class="jt-cl">
					<label for="">性别</label>
					<div class="input-box">
						<input type="text" name="sex" placeholder="" readonly="ture" id="showUserPicker">
						<div class="puts_emalis" id="userResult" ></div>
					</div>
				</li>
				<li class="jt-cl">
					<label for="">出生日期</label>
					<div class="input-box">
						<input type="text" name="age" placeholder="" readonly="ture" id="showDatePicker3">
						<div class="puts_emalis" id="dateResult3" ></div>
					</div>
				</li>
				<li class="jt-cl">
					<label for="">期待工作地</label>
					<div class="input-box">
						<input type="text" name="address" placeholder="" readonly="ture" id="showCityPicker3">
						<div class="puts_emalis" id="cityResult3" ></div>
					</div>
				</li class="jt-cl">
				<li class="jt-cl">
					<label for="">学历</label>
					<div class="input-box">
						<input type="text" name="education" placeholder="" readonly="ture" id="showXuliPicker">
						<div class="puts_emalis" id="xuliResult" ></div>
					</div>
				</li>
				<li class="jt-cl">
					<label for="">工作年限</label>
					<div class="input-box">
						<input type="text" name="year" placeholder="" readonly="ture" id="showyearPicker">
						<div class="puts_emalis" id="yearResult" ></div>
					</div>
				</li>
				<li>
					<label for="">手机</label>
					<div class="input-box">
						<input type="tel" name="phone" placeholder="必填">
					</div>
				</li>
				<li>
					<label for="">验证码</label>
					<div class="input-boxs">
						<input type="text" name="code" placeholder="输入验证码">
						<button type="button" id="codeBtn">获取验证码</button>
					</div>
				</li>
			</ul>
		</form>
		<p>提示：您所填写的信息，会更新到您的简历中哦！</p>
	</div>
	<div class="hui-line"></div>
</div>
  
</div>

<?php $tag_jobs_list_class = new \Common\qscmstag\jobs_listTag(array('列表名'=>'jobslist','显示数目'=>'6','职位分类'=>$jobs_info['jobcategory'],'去除id'=>$jobs_info['id'],'cache'=>'0','type'=>'run',));$jobslist = $tag_jobs_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"职位详情 - 骑士人才系统","keywords"=>"","description"=>"","header_title"=>"职位详情"),$jobslist);?>
<?php if(!empty($jobslist['list'])): ?><div class="split-block"></div>
<div class="jobsshowrec">
  <div class="eattitle list_height">
  推荐职位
    <div class="ritle font12 link_gray9"><a href="<?php echo U('Jobs/index');?>">查看更多></a></div>
  </div>
 <?php if(is_array($jobslist['list'])): $i = 0; $__LIST__ = $jobslist['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jobs): $mod = ($i % 2 );++$i;?><div class="jobslist">
    <div class="jname font15 link_gray6 substring"><a href="<?php echo ($jobs["jobs_url"]); ?>"><?php echo ($jobs["jobs_name"]); ?></a></div>
	<div class="cname font12 substring"><?php echo ($jobs["companyname"]); ?> | <?php echo ($jobs["district_cn"]); ?></div>
	<div class="wage font13"><?php echo ($jobs["wage_cn"]); ?></div>
	<div class="time font12"><?php echo ($jobs["refreshtime_cn"]); ?></div>
  </div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<div class="jobssshowbottomso link_blue">没有找到满意的职位? <a href="<?php echo U('Jobs/index');?>">立即搜索</a></div><?php endif; ?>


<div class="split-block-footnav"></div>
<!-- <?php if(($jobs_info['tmp']) != "1"): ?><div class="jobsfootnav">
		<div class="btns link_gray6">
		  <div class="qs-btn qs-btn-medium qs-btn-blue qs-btn-inline apply_jobs">投递简历</div>
      <?php if($jobs_info['contact']['telephone_show'] == 0): ?><a href="javascript:;" class="J_tel tel font9 hide_tel"><img src="../public/images/130.png"><br>
拨打电话</a>
      <?php else: ?>
		  <a href="tel:<?php if($jobs_info["contact"]["telephone_"]): echo ($jobs_info["contact"]["telephone_"]); else: echo ($jobs_info["contact"]["landline_tel"]); endif; ?>" class="J_tel tel font9"><img src="../public/images/130.png"><br>
拨打电话</a><?php endif; ?>
      <div class="fov font9 favor">
      <?php if($jobs_info['favor']): ?><img src="../public/images/175.png"><br>已收藏
      <?php else: ?>
        <img src="../public/images/131.png"><br>收藏职位<?php endif; ?>
      </div>
  </div>
</div><?php endif; ?> -->

<div class="footer-fixed" style="z-index:10000">
	<!-- <div class="share"><a class="text-c" href="javascript:void(0);"><i class="scd-share"></i>分享</a>
	</div> -->
	<div class="fov font9 favor share">
      <?php if($jobs_info['favor']): ?><img src="../public/images/175.png" style="width:32px;height:32px;margin-top:7px;"><br>已收藏
      <?php else: ?>
        <img src="../public/images/131.png" style="width:32px;height:32px;margin-top:7px;"><br>收藏职位<?php endif; ?>
    </div>
	<div class="scd-reserve">
		<div class="foot-apply-interv">
			<input name="jobid" value="<?php echo ($jobs_info["id"]); ?>" type="hidden">
			<button type="button" class="interv-but responsive mobile_reg" style="line-height:30px;"><i></i>申请面试</button>
		</div>
	</div>
</div>

<script id="tpl-map" type="text/html">
    <!--地图-->
    <div class="headernavfixed">
        <div class="headernav font18"><div class="title">企业位置<div class="return js-back"></div></div></div>
    </div>
    <div class="com-map">
        <div class="map" id="container"></div>
    </div>
    <div class="split-block"></div>
    <div class="btn-spacing">
        <div id="mapBtn" class="qs-btn qs-btn-blue font18" title="返回">返回</div>
    </div>
</script>
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
<script src="../public/js/popWin.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=<?php echo C('qscms_map_ak');?>"></script>
<script type="text/javascript">
      $.getJSON("<?php echo U('AjaxCommon/jobs_click');?>",{id:"<?php echo ($jobs_info["id"]); ?>"});
      var mapTemp = $('#tpl-map').html();
      $(".show-map").on('click', function() {
          var $this = $(this);
          popWin.init({
              from:"right",
              html:mapTemp,
              handle:function(a){
                var map = new BMap.Map("container");
                var point = new BMap.Point("<?php echo ($jobs_info['map_x']); ?>","<?php echo ($jobs_info['map_y']); ?>");  // 创建点坐标
                map.centerAndZoom(point, "<?php echo ($jobs_info['map_zoom']); ?>");
                var qs_marker = new BMap.Marker(point);        // 创建标注
                map.addOverlay(qs_marker);
                map.setCenter(point);
                map.addControl(new BMap.NavigationControl());//添加鱼骨
                map.enableScrollWheelZoom();//启用滚轮放大缩小，默认禁用。
                $('#mapBtn').on('click',function(){
                    a.close();
                });
              }
          })
      });
  var isVisitor = "<?php echo C('visitor.uid');?>";
  var utype = "<?php echo C('visitor.utype');?>";
  // 收藏职位点击事件绑定
    $(".favor").on('click',function(){
      var obj = $(this);
      var url = "<?php echo U('ajaxPersonal/jobs_favorites');?>";
      var jid = "<?php echo ($jobs_info['id']); ?>";
      if ((isVisitor > 0)) {
        if(utype != 2){
          qsToast({type:2,context: '请登录个人会员'});
          return false;
        }
        $.getJSON(url,{jid:jid},function(result){
          if(result.status==1){
            qsToast({type:1,context: result.msg});
            if(result.data=='cancel'){
              obj.html('<img src="../public/images/131.png"><br>收藏职位');
            }else{
              obj.html('<img src="../public/images/175.png"><br>已收藏');
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
    // 申请职位点击事件绑定
    $(".apply_jobs").on('click',function(){
      var url = "<?php echo U('ajaxPersonal/resume_apply');?>";
      var jid = "<?php echo ($jobs_info['id']); ?>";
      if ((isVisitor > 0)) {
        if(utype != 2){
          qsToast({type:2,context: '请登录个人会员'});
          return false;
        }
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
    $('.J_tel').on('click',function(){
      if (isVisitor > 0) {
          if(utype != 2){
            qsToast({type:2,context: '请登录个人会员'});
            return false;
          }
          if($(this.hasClass('hide_tel'))){
              qsToast({type:2,context: '该企业设置联系方式不公开！'});
              return false;
          }
      }else{
          window.location.href="<?php echo U('members/login');?>";
          return false;
      }
    });
</script>
<script>
    // 性别
    (function($, doc) {
		$.init();
		$.ready(function() {
			//性别
			var userPicker = new $.PopPicker();
			userPicker.setData([
			 {
				text: "男"
			}, {
				
				text: "女"
			}]);
			var showUserPickerButton = doc.getElementById("showUserPicker");
			var userResult = doc.getElementById("userResult");
			showUserPickerButton.addEventListener("tap", function(event) {
				userPicker.show(function(items) {
					userResult.innerText = items[0].text;
					//返回 false 可以阻止选择框的关闭
					//return false;
				});
			}, false);
			//学历
			var userPicker1 = new $.PopPicker();
			userPicker1.setData([
	
			 {
				text: "高中"
			},
			 {
				text: "中专"
			},
			 {
				text: "大专"
			},
			 {
				text: "本科"
			},
			{
				text: "硕士"
			},
			 {
				text: "博士"
			}]);
			var showXuliPickerButton = doc.getElementById("showXuliPicker");
			var xuliResult = doc.getElementById("xuliResult");
			showXuliPickerButton.addEventListener("tap", function(event) {
				userPicker1.show(function(items) {
					xuliResult.innerText = items[0].text;
					//返回 false 可以阻止选择框的关闭
					//return false;
				});
			}, false);

			//工作经验
			var userPicker2 = new $.PopPicker();
			userPicker2.setData([
	
			 {
				text: "无经验"
			},
			 {
				text: "一年以下"
			},
			 {
				text: "1-2年"
			},
			 {
				text: "2-3年"
			},
			{
				text: "3-5年"
			},
			 {
				text: "5年以上"
			}]);
			var showyearPickerButton = doc.getElementById("showyearPicker");
			var yearResult = doc.getElementById("yearResult");
			showyearPickerButton.addEventListener("tap", function(event) {
				userPicker2.show(function(items) {
					yearResult.innerText = items[0].text;
					//返回 false 可以阻止选择框的关闭
					//return false;
				});
			}, false);
			//三轴联动
				var cityPicker3 = new $.PopPicker({
					layer: 3
				});
				cityPicker3.setData(cityData3);
				var showCityPickerButton = doc.getElementById("showCityPicker3");
				var cityResult3 = doc.getElementById("cityResult3");
				showCityPickerButton.addEventListener("tap", function(event) {
					cityPicker3.show(function(items) {
						cityResult3.innerText =  (items[0] || {}).text + " " + (items[1] || {}).text + " " + (items[2] || {}).text;
						//返回 false 可以阻止选择框的关闭
						//return false;
					});
				}, false);
			//日期
				
				var dtpicker = new mui.DtPicker({  
				    type: "date",//设置日历初始视图模式  
				    beginDate: new Date(1949, 10, 01),//设置开始日期  
				    endDate: new Date(2088, 12, 25),//设置结束日期  
				    labels: ["年", "月", "日", "时", "分"],//设置默认标签区域提示语  
				    customData: {  
				        h: [{  
				            value: "AM",  
				            text: "AM"  
				        }, {  
				            value: "PM",  
				            text: "PM"  
				        }]  
				    }//时间/日期别名  
				})  
 
				var showDatePickerButton = doc.getElementById("showDatePicker3");
				var dateResult3 = doc.getElementById("dateResult3");
				showDatePickerButton.addEventListener("tap", function(event) {
					dtpicker.show(function(items) {
						dateResult3.innerText =  items.y.text + "-" + items.m.text + "-" + items.d.text;
						//返回 false 可以阻止选择框的关闭
						//return false;
					});
				}, false);
			});
		})
	(mui, document);
   
</script>
<script>                   
			   $(function() {
			     //申请提交
			     $('.responsive').on("click",function(){
        			$(".modal-overlay").css({"visibility":"visible","opacity":"1"});
			        $(".modal").addClass("modal-in");
        		});
			        
			        $(".modal-button1").on("click",function(){
            			$(".modal-overlay").css({"visibility":"hidden","opacity":"0"});
            			$(".modal").removeClass("modal-in");
            		});
			        
			        
			     $('.modal-button-bold1').on('click', function() {
			        $(".modal-overlay").css({"visibility":"hidden","opacity":"0"});
            		$(".modal").removeClass("modal-in");
			        
				    var name = $("input[name=name]").val();
				    var sex  = $("#userResult").html();
                    var age  = $("#dateResult3").html();
                    var address = $("#cityResult3").html();
                    var education = $("#xuliResult").html();
                    var year  = $("#yearResult").html();
                    var phone = $("input[name=phone]").val();
                    var code  = $("input[name=code]").val();
                    var jobid = $("input[name=jobid]").val();
			        
				    $.post("<?php echo U('jobs/ajaxshow');?>",{name:name,sex:sex,age:age,address:address,education:education,year:year,phone:phone,code:code,jobid:jobid},function(data){
				    	if($.trim(data)=="1")
    					{
    			            layer.msg('信息不完整', {icon: 2});
    					}
    					else if($.trim(data)=="2")
    					{
    			            layer.msg('系统繁忙', {icon: 2});
    					}
			            else if($.trim(data)=="3")
    					{
    			            layer.msg('姓名长度为2-5个字符', {icon: 2});
    					}
			            else if($.trim(data)=="4")
    					{
    			            layer.msg('验证码错误', {icon: 2});
    					}
			            else if($.trim(data)=="5")
    					{
    			            layer.msg('验证码过期', {icon: 2});
    					}
    					else if ($.trim(data)=="6")
    					{
    			            layer.msg('申请成功，等待审核', {icon: 1});
    						setTimeout(function () {
    			                 window.location.href="<?php echo U('jobs/applylogin');?>";
    		                     //window.location.reload();
    		                }, 2000);
    					} else {
    						layer.msg('系统繁忙', {icon: 2});
    						setTimeout(function () {
    		                     window.location.reload();
    		                }, 2000);
    					}
				  })
			    });
			                         
			                         
    			//发送验证码
    			$('#codeBtn').on('click', function() {
    				$.post("<?php echo U('jobs/ajax_send_code');?>", {phone:$("input[name=phone]").val()}, function(data) {
			            if ($.trim(data) == 1) {
			                 layer.msg('手机号为空或格式错误！', {icon: 2});
			            } else if ($.trim(data) == 2) {
			            	layer.msg('请60秒后再进行验证！', {icon: 2});
			            } else {
			                 showTime(60);
			                 $('.mobile_reg').removeAttr("disabled");
			            }
    				});
    			});
        
			 });
			                         
			                         
			                         
			function showTime(time){
    			$('#codeBtn').prop('disabled', true);
    
    			for (var i = 0; i <= time; i++) {
    				window.setTimeout("updateP("+ i +","+time+")", i*1000);
    			};
    		};
    		function updateP(num, time) {
    			if(num == time) {
    				$('#codeBtn').html('重新发送').prop('disabled', false);
    			}else{
    				var printnr = time - num;
    				$('#codeBtn').html(printnr +"秒重新发送");
    			}
    		}
			                         
			                         
			 </script>   
</body>
</html>