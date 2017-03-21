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
		SELF = '/index.php?m=admin&amp;c=apply&amp;a=updater&amp;mod=Mobile',
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
		<p>系统检测 “<strong><?php echo ($module["version"]["module_name"]); ?></strong>” 已经安装，当前版本号为 <strong>[<?php echo ($module["version"]["version"]); ?>]</strong> ，<span class="J_tip">已是最新版本</span></p>
		<p><font color="red">升级会导致项目二次开发的程序被覆盖，请谨慎操作！</font></p>
	</div>
	<div class="toptit">应用详情</div>
	<table width="800"  border="0" cellpadding="2" cellspacing="2"  class="apply_show" style="margin-bottom:15px;" >
		<tr>
			<td width="80" align="center">
				<img src="<?php echo ($module["ico"]); ?>" border="0" width="58" height="58">
			</td>
			<td style="line-height:230%;color:#999999" class="J_mod" m="<?php echo ($module["module"]); ?>" v="<?php echo ($module["version"]["version"]); ?>">
			<strong style="color: #0066CC; font-size:14px; padding-right:10px;"><?php echo ($module["version"]["module_name"]); ?></strong>（<?php echo ($module["module"]); ?>）&nbsp;&nbsp;&nbsp;
			<span class="J_v">当前版本：<?php echo ($module["version"]["version"]); ?></span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<span class="J_t">更新时间：<?php echo ($module['version']['update_time']); ?></span><br />
			<?php echo ($module["version"]["explain"]); ?>
		  </td>
		</tr>
</table>
	<form id="J_install_form" action="<?php echo U('apply/updater');?>" method="post" style="display:none">
		<div class="toptit">升级进程</div>
		<div id="J_process" style="padding:20px; padding-top:10px; height:160px;overflow:auto;margin-bottom: 10px;"></div>
		<input name="mod" value="<?php echo ($module["module"]); ?>" type="hidden">
		<iframe src="about:blank" style="width:500px; height:300px;display:none;" name="post_target"></iframe>
	</form>
	<table width="100%" border="0" cellspacing="10"  class="admin_list_btm">
		<tr id="J_run">
			<td>
				<input type="button" class="admin_submit" id="UpdaterBtn" value="开始升级" onclick="getlog();" style="display:none"/>
				<input type="button" class="admin_submit" value="返回"  onclick="window.location='<?php echo U('apply/index');?>'"/>
			</td>
		</tr>
		<tr id="J_end" style="display:none">
			<td>
				<input type="button" class="admin_submit" value="升级完成"  onclick="window.location='<?php echo U('apply/index');?>'"/>
			</td>
		</tr>
	</table>
</div>
<div id="QSdialog" style="display:none">
	<div class="J_logWrap" style="width:500px;height:300px;overflow-y:auto"></div>
	<table width="100%" border="0" cellspacing="10"  class="admin_list_btm">
        <tr>
            <td align="right">
            	<input name="ButSave" type="submit" class="admin_submit" id="ButSave" value="确定" onclick="updater();"/>
                <input name="ButADD" type="button" class="DialogClose admin_submit" id="ButADD" value="取消"/>
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
	function getlog(){
		var s = document.createElement('script');
			s.type = 'text/javascript';
			s.src = "http://www.74cms.com/plus/check_module.php?act=module_log&module=<?php echo ($module["module"]); ?>|<?php echo ($module["version"]["version"]); ?>";
		var tmp = document.getElementsByTagName('script')[0];
		tmp.parentNode.insertBefore(s, tmp);
	}
	function updater(){
		$(".FloatBg").remove();
        $(".FloatBox").remove();
		$('#J_process').empty();
		$('#J_install_form').show().attr('target','post_target');
	    $('#J_install_form').submit();
	    $('#J_run').hide();
	}
	function show_process(html){
	    $('#J_process').html($('#J_process').html() + html);
	    var _t = $('#J_process').get(0);
	    _t.scrollTop = _t.scrollHeight;
	}
	function install_failure(){
	    $('#J_run').show();
	}
	function install_successed(){
	    $('#J_end').show();
	}
	function install_updater_auth(a){
		window.location.href=a;
	}
	function callback(a){
	    $.each(a.data,function(k,v){
			var version = $('.J_mod[m="'+k+'"]').attr('v');
			if(v.version && version != v.version){
				v.update_time = v.update_time ? v.update_time : '未发布';
				$('.J_mod[m="'+k+'"] .J_v').after('<a href="http://www.74cms.com/app/list-1.html" class="newsv">有新版</a>');
				$('.J_mod[m="'+k+'"] .J_t').html('更新时间：'+v.update_time);
				$('.J_tip').html('最新版本号为 <strong>['+v.version+']</strong>');
				$('#UpdaterBtn').show();
			}
	    });
	}
	function calllog(a){
		if(a.status == 1){
			$('#QSdialog .J_logWrap').html(decodeURIComponent(a.data.replace(/\+/g, '%20'))).click();
		}else{
			alert(decodeURIComponent(a.msg));
		}
	}
	$("#QSdialog").QSdialog({
		DialogTitle:"升级内容",
		DialogContent:'#QSdialog',
		DialogContentType:'id'
	});
</script>
<script src="http://www.74cms.com/plus/check_module.php?module_name=<?php echo ($module["module"]); ?>" language="javascript"></script>
</body>
</html>