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
		<link rel="stylesheet" href="../public/css/personal.css">
		<?php $tag_load_class = new \Common\qscmstag\loadTag(array('type'=>'category','cache'=>'0','列表名'=>'list',));$list = $tag_load_class->category();?>
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
  <?php $tag_hotword_class = new \Common\qscmstag\hotwordTag(array('列表名'=>'hotword_list','显示数目'=>'12','cache'=>'0','type'=>'run',));$hotword_list = $tag_hotword_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"","keywords"=>"","description"=>"","header_title"=>""),$hotword_list);?>
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
		<div class="split-block-title">只需<strong>30</strong>秒填写简历,轻松搞定工作!</div>
    
	<div class="list_height plist-txt notarrow">
        <div class="pic"></div>
        <div class="tit font14">姓名</div>
        <div class="describe font13">
            <input type="text" id="fullname" id="fullname" placeholder="请输入姓名" value="<?php echo ($userprofile["realname"]); ?>">
        </div>
        <div class="arrow"></div>
        <div class="clear"></div>
    </div>
	
	<div class="list_height plist-txt notarrow">
        <div class="pic"></div>
        <div class="tit font14">性别</div>
        <div id="sex" class="describe font13">
	        <div class="radio-group x2">
		        <div class="radio-cell">
			        <label for="radio4">男</label>
			        <input id="radio4" name="sex" type="radio" value="1" title="男"  <?php if($userprofile['sex'] == 1 or $userprofile['sex'] == 0): ?>checked="checked"<?php endif; ?>>
		        </div>
		        <div class="radio-cell">
			        <label for="radio5">女</label>
			        <input id="radio5" name="sex" type="radio" value="2" title="女" <?php if($userprofile['sex'] == 2): ?>checked="checked"<?php endif; ?>>
		        </div>
		        <div class="clear"></div>
	        </div>
        </div>
        <div class="arrow"></div>
        <div class="clear"></div>
    </div>
	<div class="list_height plist-txt">
        <div class="pic"></div>
        <div class="tit font14">出生年份</div>
        <div class="describe font13">
	        <span class="for-select">请选择</span>
					<select id="birthdate" name="birthdate">
					    <option value="">请选择</option>
					    <?php if(is_array($birthdate_arr)): $i = 0; $__LIST__ = $birthdate_arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$birthdate): $mod = ($i % 2 );++$i;?><option value="<?php echo ($birthdate); ?>" <?php if($userprofile['birthday'] == $birthdate): ?>selected<?php endif; ?>><?php echo ($birthdate); ?>年</option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
        </div>
        <div class="arrow"></div>
        <div class="clear"></div>
    </div>
	<div class="list_height plist-txt">
        <div class="pic"></div>
        <div class="tit font14">最高学历</div>
        <div class="describe font13">
          <span class="for-select">请选择</span>
					<select id="education" name="education">
          <option value="">请选择</option>
					    <?php if(is_array($education)): $i = 0; $__LIST__ = $education;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$education): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if($userprofile['education'] == $key): ?>selected<?php endif; ?>><?php echo ($education); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
        </div>
        <div class="arrow"></div>
        <div class="clear"></div>
    </div>
    <div class="list_height plist-txt">
        <div class="pic"></div>
        <div class="tit font14">工作经验</div>
        <div class="describe font13">
          <span class="for-select">请选择</span>
					<select id="experience" name="experience">
          <option value="">请选择</option>
					    <?php if(is_array($experience)): $i = 0; $__LIST__ = $experience;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$experience): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if($userprofile['experience'] == $key): ?>selected<?php endif; ?>><?php echo ($experience); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
        </div>
        <div class="arrow"></div>
        <div class="clear"></div>
    </div>
    <div class="list_height plist-txt notarrow">
        <div class="pic"></div>
        <div class="tit font14">现居住地</div>
        <div class="describe font13">
            <input type="text" id="residence" id="residence" placeholder="请输入现居住地" value="">
        </div>
        <div class="arrow"></div>
        <div class="clear"></div>
    </div>
    <div class="list_height plist-txt notarrow">
        <div class="pic"></div>
        <div class="tit font14">邮箱</div>
        <div class="describe font13">
            <?php if($visitor['email_audit'] == 1): ?><a class="mui-navigate-right">
                    <i class="mui-pull-right update font14"><?php echo ($visitor["email"]); ?></i>
                </a>
            <?php else: ?>
                <input id="email" name="email" type="text" placeholder="请输入邮箱" value="<?php echo ($visitor["email"]); ?>"><?php endif; ?>
        </div>
        <div class="arrow"></div>
        <div class="clear"></div>
    </div>
    <div class="list_height plist-txt notarrow">
        <div class="pic"></div>
        <div class="tit font14">手机号码</div>
        <div class="describe font13">
            <?php if($visitor['mobile_audit'] == 1): ?><a class="mui-navigate-right">
                    <i class="mui-pull-right update font14"><?php echo ($visitor["mobile"]); ?></i>
                </a>
            <?php else: ?>
                <input type="text" id="telephone" placeholder="请输入手机号码" value="<?php echo ($visitor["mobile"]); ?>"><?php endif; ?>
        </div>
        <div class="arrow"></div>
        <div class="clear"></div>
    </div>
    <?php if($visitor['mobile_audit'] == 0 and C('qscms_login_per_audit_mobile') == 1): ?><div class="list_height plist-txt notarrow">
          <div class="pic"></div>
          <div class="tit font14">手机验证码</div>
          <div class="font13 vcode_val">
              <input id="mobile_vcode" name="mobile_vcode" type="text" placeholder="请输入验证码" value="">
          </div>
          <div id="getVerfyCode" class="qs-btn qs-btn-inline qs-btn-medium qs-btn-border-gray font14 vcode_btn">获取验证码</div>
          <div class="arrow"></div>
          <div class="clear"></div>
      </div>
      <div id="pop" class="qs-hidden"></div>
      <input type="hidden" id="verify_userlogin" value="<?php if(C('qscms_mobile_captcha_open') == 1 && C('qscms_wap_captcha_config.varify_mobile') == 1): ?>1<?php endif; ?>"><?php endif; ?>
	<div class="split-block"></div>
    <div class="list_height plist-txt">
        <div class="pic"></div>
        <div class="tit font14">目前状态</div>
        <div class="describe font13">
          <span class="for-select">请选择</span>
					<select id="current" name="current">
              <option value="" selected>请选择</option>
					    <?php if(is_array($current)): $i = 0; $__LIST__ = $current;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$current): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($current); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
        </div>
				<div class="arrow"></div>
				<div class="clear"></div>
    </div>
    <div class="list_height plist-txt">
        <div class="pic"></div>
        <div class="tit font14">工作性质</div>
        <div class="describe font13">
          <span class="for-select">请选择</span>
          <select id="nature" name="nature">
            <option value="" selected>请选择</option>
	          <?php if(is_array($jobs_nature)): $i = 0; $__LIST__ = $jobs_nature;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nature): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($nature); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
        </div>
				<div class="arrow"></div>
				<div class="clear"></div>
    </div>
    <div class="list_height plist-txt js-actionParent">
        <div class="pic"></div>
        <div class="tit font14">期望行业</div>
        <div class="describe font13 qs-temp-level1 js-showActionSheet" data-type="trade" data-base="QS_trade" data-multiple="true" data-num="3" data-link="false">
           <span class="qs-temp-txt-trade" data-otxt="请选择">请选择</span>
           <input class="qs-temp-code-trade" name="trade" id="trade" type="hidden" value="" />
        </div>
         <div class="arrow"></div>
         <div class="clear"></div>
		    <!--BEGIN actionSheet-->
		    <div>
			    <div class="qs-mask" style="display: none"></div>
			    <div class="qs-actionsheet js-actionsheet">
				    <div class="qs-actionsheet-menu">
					    <div class="con-filter">
						    <div class="f-selected-group f-selected-group-trade">
							    <div class="s-bar">
								    <div class="qs-btn qs-btn-inline qs-btn-small qs-btn-border-gray qs-left js-cancelActionSheet">取消</div>
								    <div class="qs-btn qs-btn-inline qs-btn-small qs-btn-border-orange qs-right js-cancelActionSheet" id="qs-temp-confirm-trade">确定</div>
								    <div class="clear"></div>
							    </div>
							    <div class="s-list qs-hidden"></div>
						    </div>
						    <div class="f-box f-box-trade"></div>
					    </div>
				    </div>
			    </div>
		    </div>
    </div>
	<div class="list_height plist-txt js-actionParent">
        <div class="pic"></div>
        <div class="tit font14">期望职位</div>
        <div class="describe font13 qs-temp js-showActionSheet" data-type="jobs" data-base="QS_jobs_parent" data-source="QS_jobs" data-multiple="true" data-num="5" data-link="false" data-level="<?php echo C('qscms_category_jobs_level');?>">
		   <span class="qs-temp-txt-jobs" data-otxt="请选择">请选择</span>
       <input class="qs-temp-code-jobs" name="intention_jobs_id" id="intention_jobs_id" type="hidden" value="" />
        </div>
         <div class="arrow"></div>
         <div class="clear"></div>
					<!--BEGIN actionSheet-->
					<div>
						<div class="qs-mask" style="display: none"></div>
						<div class="qs-actionsheet js-actionsheet">
							<div class="qs-actionsheet-menu">
								<div class="con-filter">
									<div class="f-selected-group f-selected-group-jobs">
										<div class="s-bar">
											<div class="qs-btn qs-btn-inline qs-btn-small qs-btn-border-gray qs-left js-cancelActionSheet">取消</div>
											<div class="qs-btn qs-btn-inline qs-btn-small qs-btn-border-orange qs-right js-cancelActionSheet" id="qs-temp-confirm-jobs">确定</div>
											<div class="clear"></div>
										</div>
										<div class="s-list qs-hidden"></div>
									</div>
									<div class="f-box f-box-jobs"></div>
								</div>
							</div>
						</div>
					</div>
    </div>
    <div class="list_height plist-txt">
      <div class="pic"></div>
      <div class="tit font14">期望薪资</div>
			<div class="describe font13">
          <span class="for-select">请选择</span>
        <select id="wage" name="wage">
          <option value="">请选择</option>
	        <?php if(is_array($wage)): $i = 0; $__LIST__ = $wage;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$wage): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($wage); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
			</div>
      <div class="arrow"></div>
      <div class="clear"></div>
    </div>
    <div class="list_height plist-txt js-actionParent last">
      <div class="pic"></div>
      <div class="tit font14">工作地区</div>
      <div class="describe font13 qs-temp js-showActionSheet" data-type="city" data-base="QS_city_parent" data-source="QS_city" data-multiple="true" data-num="3" data-link="false" data-level="<?php echo C('qscms_category_district_level');?>">
	      <span class="qs-temp-txt-city" data-otxt="请选择">请选择</span>
          <input class="qs-temp-code-city" name="district" id="district" type="hidden" value="" />
      </div>
      <div class="arrow"></div>
      <div class="clear"></div>
	    <!--BEGIN actionSheet-->
	    <div>
		    <div class="qs-mask" style="display: none"></div>
		    <div class="qs-actionsheet js-actionsheet">
			    <div class="qs-actionsheet-menu">
				    <div class="con-filter">
					    <div class="f-selected-group f-selected-group-city">
						    <div class="s-bar">
							    <div class="qs-btn qs-btn-inline qs-btn-small qs-btn-border-gray qs-left js-cancelActionSheet">取消</div>
							    <div class="qs-btn qs-btn-inline qs-btn-small qs-btn-border-orange qs-right js-cancelActionSheet" id="qs-temp-confirm-city">确定</div>
							    <div class="clear"></div>
						    </div>
						    <div class="s-list qs-hidden"></div>
					    </div>
					    <div class="f-box f-box-city"></div>
				    </div>
			    </div>
		    </div>
	    </div>
    </div>
	<div class="btn-spacing">
		  <input type="button" id="btnSave" class="qs-btn qs-btn-blue font18 b-big" value="保存">
	</div>
  <div class="split-block"></div>
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
	<script src="../public/js/popWin.js"></script>
	<script src="../public/js/qsCategory.js"></script>
  <script src="http://static.geetest.com/static/tools/gt.js"></script>
  <script type="text/javascript">
    $(function(){
	    $(".js-showActionSheet").on("click", function(){
		    var $iosActionsheet = $(this).closest('.js-actionParent').find('.js-actionsheet');
		    var $iosMask = $(this).closest('.js-actionParent').find('.qs-mask');
		    $iosActionsheet.removeClass('qs-actionsheet-toggle');
		    $iosActionsheet.addClass('qs-actionsheet-toggle');
		    $iosMask.fadeIn(200);
		    $iosMask.on('click', hideActionSheet);
		    $(this).closest('.js-actionParent').find('.js-cancelActionSheet').on('click', hideActionSheet);
		    $(this).closest('.js-actionParent').find('.qs-actionsheet-cell').on('click', hideActionSheet);
		    function hideActionSheet() {
			    $(this).closest('.js-actionParent').find('.js-actionsheet').removeClass('qs-actionsheet-toggle');
			    $(this).closest('.js-actionParent').find('.qs-mask').fadeOut(200);
		    }
	    });
    });
    // 验证表单并提交
    var regularMobile = /^13[0-9]{9}$|14[0-9]{9}$|15[0-9]{9}$|18[0-9]{9}$|17[0-9]{9}$/;
    var regularEmail = /^[_\.0-9a-zA-Z-]+[_0-9a-zA-Z-]@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,3}$/;
        $('#btnSave').on('click', function() {
          var fullnameValue = $.trim($('#fullname').val());
          var sexValue = $.trim($('#sex input[name="sex"]:checked').val());
          var birthdateValue = $.trim($('#birthdate').val());
          var experienceValue = $.trim($('#experience').val());
          var telephoneValue = $.trim($('#telephone').val());
          var mobile_vcode = $.trim($('#mobile_vcode').val());
          var educationValue = $.trim($('#education').val());
          var emailValue = $.trim($('#email').val());
          var currentValue = $.trim($('#current').val());
          var natureValue = $.trim($('#nature').val());
          var tradeValue = $.trim($('#trade').val());
          var intentionJobsValue = $.trim($('#intention_jobs_id').val());
          var districtValue = $.trim($('#district').val());
          var wageValue = $.trim($('#wage').val());
          var residence = $.trim($('#residence').val());
          if (fullnameValue == "") {
              qsToast({type:2,context: '请填写姓名'});
              return false;
          }
          if (sexValue == "") {
              qsToast({type:2,context: '请选择性别'});
              return false;
          }
          if (birthdateValue == "") {
              qsToast({type:2,context: '请选择出生年份'});
              return false;
          }
          if (educationValue == "") {
              qsToast({type:2,context: '请选择学历'});
              return false;
          }
          if (experienceValue == "") {
              qsToast({type:2,context: '请选择工作经验'});
              return false;
          }
          if (residence == "") {
              qsToast({type:2,context: '请填写现居住地'});
              return false;
          }
          <?php if(!$visitor['mobile_audit']): ?>if (telephoneValue == "") {
                  qsToast({type:2,context: '请填写手机'});
                  return false;
              }
              if (telephoneValue != "" && !regularMobile.test(telephoneValue)) {
                  qsToast({type:2,context: '手机号码格式不正确'});
                  return false;
              }
              <?php if(C('qscms_login_per_audit_mobile') == 1): ?>if (mobile_vcode == "") {
                      qsToast({type:2,context: '请填写手机验证码'});
                      return false;
                  }<?php endif; endif; ?>
          <?php if(!$visitor['email_audit']): ?>if (emailValue == "") {
                  qsToast({type:2,context: '请填写邮箱'});
                  return false;
              }
              if (emailValue != "" && !regularEmail.test(emailValue)) {
                  qsToast({type:2,context: '邮箱格式不正确'});
                  return false;
              }<?php endif; ?>
          if (currentValue == "") {
              qsToast({type:2,context: '请选择目前状态'});
              return false;
          }
          if (natureValue == "") {
              qsToast({type:2,context: '请选择工作性质'});
              return false;
          }
          if (intentionJobsValue == "") {
              qsToast({type:2,context: '请选择期望职位'});
              return false;
          }
          if (districtValue == "") {
              qsToast({type:2,context: '请选择工作地区'});
              return false;
          }
          if (wageValue == "") {
              qsToast({type:2,context: '请选择期望薪资'});
              return false;
          }
          $('#btnSave').val('保存中...').addClass('qs-btn-bg-disabled').prop('disabled', !0);
          // 提交表单
          $.ajax({
              url: "<?php echo U('Personal/resume_add');?>",
              type: 'POST',
              dataType: 'json',
              data: {fullname: fullnameValue,sex: sexValue, birthdate: birthdateValue,education: educationValue, experience: experienceValue, telephone: telephoneValue,mobile_vcode:mobile_vcode, email: emailValue,current: currentValue, nature: natureValue, trade: tradeValue, intention_jobs_id: intentionJobsValue,residence:residence, district: districtValue, wage: wageValue},
              success:function(data){
                  if (parseInt(data.status)) {
                      window.location.href = data.data.url;
                  } else {
                      qsToast({type:2,context: data.msg});
                      $('#btnSave').val('保存').removeClass('qs-btn-bg-disabled');
                  }
              },
              error:function(result){
                  $('#btnSave').val('保存').removeClass('qs-btn-bg-disabled');
                  qsToast({type:2,context: result.msg});
              }
          });
        });
      <?php if($visitor['mobile_audit'] == 0 and C('qscms_login_per_audit_mobile') == 1): ?>var timer,ountdownVal = 180,
      ountdown = function(){
        ountdownVal--;
        if(ountdownVal<=0){
          clearInterval(timer);
          ountdownVal = 180;
          $('#getVerfyCode').val('获取验证码').removeClass('qs-btn-border-disabled').prop('disabled', 0);
        }else{
          $('#getVerfyCode').html('重新发送'+ ountdownVal +'秒').addClass('qs-btn-border-disabled').prop('disabled', !0);
        }
      };
      /**
       * ajax 登录
       */
      function doAjax() {
        $('#pop').hide();
        var mobile = $.trim($('#telephone').val());
        $.post("<?php echo U('Members/send_mobile_code');?>",{mobile:mobile},function(result){
          if(result.status == 1){
            qsToast({type:1,context: result.msg});
            timer=setInterval(ountdown,1000);
          }else{
            qsToast({type:2,context: result.msg});
            timer=setInterval(ountdown,1000);
          }
        },'json');
      }
      /**
       * 配置极验
       */
      $.ajax({
        url: qscms.root+'?m=Mobile&c=captcha&type=mobile&t=' + (new Date()).getTime(),
        type: 'get',
        dataType: 'json',
        success: function(config) {
          initGeetest({
            gt: config.gt,
            challenge: config.challenge,
            offline: !config.success
          }, function(captchaObj) {
            captchaObj.appendTo("#pop");
            captchaObj.onSuccess(function() {
              doAjax();
            });
            window.captchaObj = captchaObj
          });
        }
      });
      $('#getVerfyCode').on('click',function(){
        if(ountdownVal<180) return false;
        var mobile = $.trim($('#telephone').val());
        if (mobile == '') {
          qsToast({type:2,context: '请输入手机号'});
          return false;
        }
        if (eval($('#verify_userlogin').val())) {
          window.captchaObj.refresh();
          $('#pop').show();
        } else {
          doAjax();
        }
      });<?php endif; ?>
    </script>
</body>
</html>