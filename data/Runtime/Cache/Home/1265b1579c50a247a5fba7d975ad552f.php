<?php if (!defined('THINK_PATH')) exit(); if($visitor['utype'] == 1): ?><!--企业会员已登录 -->
	<div class="log_in_com">
		<div class="yuname">
			<div class="username substring"><span><?php echo ($am_pm); ?>，</span>HR</div>
			<a class="ylogout" href="<?php echo U('members/logout');?>">退出</a>
			<div class="clear"></div>
		</div>
	  	<div class="cominfo">
		  	<div class="comlogo"><img src="<?php if($info['logo']): echo attach($info['logo'],'company_logo'); else: echo attach('no_logo.png','resource'); endif; ?>" border="0"/></div>
		    <div class="comright">
			  	<div class="cname substring"><?php echo ($info["companyname"]); ?></div>
			    <?php if($issign): ?><div id="J_sign_in" data-byname="<?php echo C('qscms_points_byname');?>" class="sign">已签</div>
			  	<?php else: ?>
				<div id="J_sign_in" data-byname="<?php echo C('qscms_points_byname');?>" class="sign">签到</div><?php endif; ?>
		    </div>
			<div class="clear"></div>
	    </div>
	    <div class="combtns">
	    	<?php if($upper_limit != 1): ?><a class="lbtn add" href="<?php echo U('company/jobs_add');?>">发布职位</a>
			<?php else: ?>
				<a href="javascript:;" class="J_addJobsDig lbtn add">发布职位</a><?php endif; ?>
			<a class="lbtn manage" href="<?php echo U('company/jobs_list');?>">管理职位</a>
			<a id="J_refresh_jobs" class="lbtn last refurbish" href="javascript:;">刷新职位</a>
			<a class="lbtn ntxt" href="<?php echo U('company/jobs_apply');?>"><span><?php echo ((isset($info["apply"]) && ($info["apply"] !== ""))?($info["apply"]):0); ?></span>待处理简历</a>
			<a class="lbtn ntxt" href="<?php echo U('company/jobs_viewlog');?>"><span><?php echo ((isset($info["views"]) && ($info["views"] !== ""))?($info["views"]):0); ?></span>谁看过我</a>
			<a class="lbtn last ntxt" href="<?php echo U('company/pms_sys');?>"><span><?php echo ((isset($msgtip["unread"]) && ($msgtip["unread"] !== ""))?($msgtip["unread"]):0); ?></span>我的消息</a>
			<div class="clear"></div>
		</div>
		<a href="<?php echo U('company/index');?>" class="com_login_in">进入会员中心</a>
	</div>
	<script type="text/javascript">
		$('#J_refresh_jobs').click(function(){
			$.getJSON("<?php echo U('CompanyService/jobs_refresh_all');?>",function(result){
        		if(result.status==1){
        			disapperTooltip('success',result.msg);
        		}
        		else if(result.status==2)
        		{
        			var qsDialog = $(this).dialog({
		                title: '批量刷新职位',
		                loading: true,
		                border: false,
		                yes: function () {
		                	window.location.href=result.data;
		                }
		            });
		            qsDialog.setBtns(['单条刷新', '取消']);
		            qsDialog.setContent('<div class="refresh_jobs_all_confirm">' + result.msg + '</div>');
        		}
        		else
        		{
        			disapperTooltip('remind',result.msg);
        		}
        	});
		});
	</script>
<?php else: ?>
	<!--个人会员已登录 -->
	<div class="log_in_per">
		<div class="yuname">
			<div class="username substring"><span><?php echo ($am_pm); ?>，</span><?php echo ((isset($info["realname"]) && ($info["realname"] !== ""))?($info["realname"]):$visitor['username']); ?></div>
			<a class="ylogout" href="<?php echo U('members/logout');?>">退出</a>
			<div class="clear"></div>
		</div>
	  	<div class="info">
		  		<div class="photo"><img src="<?php echo ($visitor['avatars']); ?>" border="0"/></div>
			  	<div class="pname substring"><?php echo ((isset($info["realname"]) && ($info["realname"] !== ""))?($info["realname"]):$visitor['username']); ?></div>
			  	<?php if($issign): ?><div id="J_sign_in" data-byname="<?php echo C('qscms_points_byname');?>" class="sign">已签</div>
			  	<?php else: ?>
				<div id="J_sign_in" data-byname="<?php echo C('qscms_points_byname');?>" class="sign">签到</div><?php endif; ?>
			<div class="clear"></div>
	    </div>
	    <div class="perbtns">
		  	<a class="lbtn add" href="<?php echo U('personal/resume_add');?>">创建简历</a>
			<a class="lbtn manage" href="<?php echo U('personal/resume_list');?>">管理简历</a>
			<a id="J_refresh_resume" class="lbtn last refurbish" href="<?php if($info['pid']): ?>javascript:;<?php else: echo U('personal/resume_add'); endif; ?>" pid="<?php echo ($info["pid"]); ?>">刷新简历</a>
			<a class="lbtn ntxt" href="<?php echo U('personal/jobs_interview');?>"><span><?php echo ((isset($info["countinterview"]) && ($info["countinterview"] !== ""))?($info["countinterview"]):0); ?></span>面试邀请</a>
			<a class="lbtn ntxt" href="<?php echo U('personal/attention_me');?>"><span><?php echo ((isset($info["views"]) && ($info["views"] !== ""))?($info["views"]):0); ?></span>谁看过我</a>
			<a class="lbtn last ntxt" href="<?php echo U('personal/msg_pms');?>"><span><?php echo ((isset($msgtip["unread"]) && ($msgtip["unread"] !== ""))?($msgtip["unread"]):0); ?></span>我的消息</a>
			<div class="clear"></div>
		</div>
		<a href="<?php echo U('personal/index');?>" class="com_login_in">进入会员中心</a>
	</div>
	<script type="text/javascript">
		// 首页左侧登录口，刷新简历
		$('#J_refresh_resume').click(function(){
			var pid = $(this).attr('pid');
			$.post("<?php echo U('Personal/refresh_resume');?>",{pid:pid},function(result){
				if(result.status == 1){
					if(result.data){
						disapperTooltip("goldremind", '刷新简历增加'+result.data+'<?php echo C('qscms_points_byname');?><span class="point">+'+result.data+'</span>');
					}else{
						disapperTooltip('success',result.msg);
					}
					$.getJSON("<?php echo U('AjaxCommon/get_header_min');?>",function(result){
						if(result.status == 1){
							$('#J_header').html(result.data.html);
						}
					});
				}else{
					disapperTooltip('remind',result.msg);
				}
			},'json');
        });
	</script><?php endif; ?>