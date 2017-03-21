<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7">
<link rel="shortcut icon" href="<?php echo C('qscms_site_dir');?>favicon.ico" />
<meta name="author" content="骑士CMS" />
<meta name="copyright" content="74cms.com" />
<title> Powered by 74CMS</title>
<link href="__ADMINPUBLIC__/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__ADMINPUBLIC__/js/jquery.min.js"></script>
<script>
	var URL = '/index.php/admin/apply',
		SELF = '/index.php?m=admin&amp;c=apply&amp;a=updater_auth&amp;time=1490060746',
		ROOT_PATH = '/index.php/admin',
		APP	 =	 '/index.php';
</script>
<script type="text/javascript" src="__ADMINPUBLIC__/js/jquery.QSdialog.js"></script>
<script type="text/javascript" src="__ADMINPUBLIC__/js/jquery.vtip-min.js"></script>
<script type="text/javascript" src="__ADMINPUBLIC__/js/jquery.grid.rowSizing.pack.js"></script>
<script type="text/javascript" src="__ADMINPUBLIC__/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="__ADMINPUBLIC__/js/common.js"></script>
</head>
<body style="background-color:#E0F0FE">
	<div class="admin_main_nr_dbox">
	    <div class="pagetit">
	        <div class="ptit"> <?php if($sub_menu['pageheader']): echo ($sub_menu["pageheader"]); else: ?>欢迎登录 <?php echo C('qscms_site_name');?> 管理中心！<?php endif; ?></div>
	        <?php if(!empty($sub_menu['menu'])): ?><div class="topnav">
			        <?php if(is_array($sub_menu['menu'])): $i = 0; $__LIST__ = $sub_menu['menu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><a href="<?php echo U($val['module_name'].'/'.$val['controller_name'].'/'.$val['action_name']); echo ($val["data"]); if($isget and $_GET): echo get_first(); endif; if($_GET['_k_v']): ?>&_k_v=<?php echo ($_GET['_k_v']); endif; ?>" class="<?php echo ($val["class"]); ?>"><u><?php echo ($val["name"]); ?></u></a><?php endforeach; endif; else: echo "" ;endif; ?>
				    <div class="clear"></div>
				</div><?php endif; ?>
	        <div class="clear"></div>
	    </div>
	<div class="toptip link_g">
		<h2>提示：</h2>
		<p><font color="red">升级会导致项目二次开发的程序被覆盖，请谨慎操作！</font></p>
	</div>
	<div id="auth_list">
		<table width="100%"  border="0" cellpadding="0" cellspacing="0"  class="link_lan" style="margin-bottom:15px;" >
			<tr>
				<td class="admin_list_tit admin_list_first">目录权限检测</td>
				<td width="150" align="center" class="admin_list_tit">读取权限</td>
				<td width="150" align="center" class="admin_list_tit">写入权限</td>
			</tr>
			<?php if(is_array($checked_dirs)): $i = 0; $__LIST__ = $checked_dirs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td class="admin_list admin_list_first"><?php echo ($vo["dir"]); ?></td>
				<td width="150" align="center" class="admin_list"><?php echo ($vo["read"]); ?></td>
				<td width="150" align="center" class="admin_list"><?php echo ($vo["write"]); ?></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
	</div>
	<form id="J_install_form" action="<?php echo U('apply/updater_auth');?>" method="post" style="display:none">
		<div class="toptit">升级进程</div>
		<div id="J_process" style="padding:20px; padding-top:10px; height:160px;overflow:auto;margin-bottom: 10px;"></div>
		<input name="time" value="<?php echo ($time); ?>" type="hidden">
		<iframe src="about:blank" style="width:500px; height:300px;display:none;" name="post_target"></iframe>
	</form>
	<?php if($auth == 1): ?><div class="toptit"><font color="red">升级文件或路径必须具备‘读写权限’，请手动将列表内文件或路径设置‘读写权限’</font></div><?php endif; ?>
	<table width="100%" border="0" cellspacing="10"  class="admin_list_btm">
		<tr id="J_run">
			<td>
				<input name="ButADD" type="button" class="admin_submit" id="UpdaterBtn" value="继续升级" onclick="updater();" <?php if($auth == 1): ?>style="display:none"<?php endif; ?>/>
				<input type="button" class="admin_submit" id="CheckedBtn" value="重新检测" onclick="install_updater_auth();" <?php if($auth == 0): ?>style="display:none"<?php endif; ?>/>
				<input name="ButADD" type="button" class="admin_submit" id="ButADD" value="返回"  onclick="window.location='<?php echo U('apply/index');?>'"/>
			</td>
		</tr>
		<tr id="J_end" style="display:none">
			<td>
				<input name="ButADD" type="button" class="admin_submit" id="ButADD" value="升级完成"  onclick="window.location='<?php echo U('apply/index');?>'"/>
			</td>
		</tr>
	</table>
</div>
<div class="footer link_lan">
Powered by <a href="http://www.74cms.com" target="_blank"><span style="color:#009900">74</span><span style="color: #FF3300">CMS</span></a> <?php echo C('QSCMS_VERSION');?>
</div>
<div class="admin_frameset" >
  <div class="open_frame" title="全屏" id="open_frame"></div>
  <div class="close_frame" title="还原窗口" id="close_frame"></div>
</div>
</body>
</html>
<script>
	function updater(){
		$('#J_process').empty();
		$('#J_install_form').show().attr('target','post_target');
	    $('#J_install_form').submit();
	    $('#auth_list,#J_run').hide();
	}
	function show_process(html){
	    $('#J_process').html($('#J_process').html() + html);
	    var _t = $('#J_process').get(0);
	    _t.scrollTop = _t.scrollHeight;
	}
	function install_failure(a){
		if(a == 1){
			$('#UpdaterBtn,#CheckedBtn').hide();
		}else if(a == 2){
			$('#UpdaterBtn').hide();
			$('#CheckedBtn').show();
		}
	    $('#J_run').show();
	}
	function install_successed(){
	    $('#J_end').show();
	}
	function install_updater_auth(){
		window.location.href="<?php echo U('apply/updater_auth',array('time'=>$time));?>";
	}
</script>
</body>
</html>