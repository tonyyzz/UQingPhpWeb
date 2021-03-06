<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>安装向导 - 骑士PHP人才系统(www.74cms.com)</title>
	<link rel="shortcut icon" href="<?php echo C('qscms_site_dir');?>favicon.ico" />
	<link href="<?php echo ($assets_path); ?>/css/css.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo ($assets_path); ?>/js/jquery.js" type="text/javascript" language="javascript"></script>
	<script>
		$(function(){
			$(".step li:eq(3)").css("margin-right", 0);
			$(".setting div:last").css("border", 0);
		})
	</script>
</head>
<body>
	<div class="install_box">
		<div class="header">
	<div class="logo_img"><img src="<?php echo ($assets_path); ?>/images/install.gif" alt="" width="366" height="57" /></div>
	<div class="head_txt">74cms V<?php echo C('QSCMS_VERSION');?> 基础版 <?php echo C('QSCMS_RELEASE');?></div>
</div>
		<div class="step">
			<div class="step_show step_1"></div>
			<ul>
				<li class="complete">环境检查</li>
				<li>参数配置</li>
				<li>开始安装</li>
				<li>成功安装</li>
				<div class="clear"></div>
			</ul>
		</div>
		<div class="setting">
			<div class="setting_check">
				<h3>环境检查</h3>
				<table>
					<tbody>
						<tr class="title" height="30">
							<td width="229">项目</td>
							<td width="265">当前服务器</td>
							<td width="102">骑士cms所需配置</td>
						</tr>
						<tr height="30">
							<td width="229">操作系统</td>
							<td width="265"><?php echo ($system_info["os"]); ?></td>
							<td width="102">不限制</td>
						</tr>
						<tr height="30">
							<td width="229">附件上传</td>
							<td width="265"><?php echo ($system_info["max_filesize"]); ?></td>
							<td width="102">2M以上</td>
						</tr>
						<tr height="30">
							<td width="229">PHP版本</td>
							<td width="265"><?php echo ($system_info["php_ver"]); ?></td>
							<td width="102">5.3及以上</td>
						</tr>
						<tr height="30">
							<td width="229">服务器解译引擎</td>
							<td width="265"><?php echo ($system_info["web_server"]); ?></td>
							<td width="102">Apache/IIS/Nginx</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="setting_check">
				<h3>扩展检查</h3>
				<table>
					<tbody>
						<tr class="title" height="30">
							<td width="229">扩展名称</td>
							<td width="265">当前状态</td>
						</tr>
						<tr height="30">
							<td width="229">mbstring</td>
							<td width="265"><?php echo ($mbstring); ?></td>
						</tr>
						<tr height="30">
							<td width="229">pdo</td>
							<td width="265"><?php echo ($pdo); ?></td>
						</tr>
						<tr height="30">
							<td width="229">pdo_mysql</td>
							<td width="265"><?php echo ($pdo_mysql); ?></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="menu_check">
				<h3>目录权限检测</h3>
				<table>
					<tbody>
						<tr class="title" height="30">
							<td width="229">目录文件</td>
							<td width="265">读取权限</td>
							<td width="102">写入权限</td>
						</tr>
						<?php if(is_array($dir_check)): $i = 0; $__LIST__ = $dir_check;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr height="30">
							<td width="229"><?php echo ($vo["dir"]); ?></td>
							<td width="265"><?php echo ($vo["read"]); ?></td>
							<td width="102"><?php echo ($vo["write"]); ?></td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="next">
			<input type="button" value="上一步" class="up" onclick="window.location.href='<?php echo U('Home/Index/index');?>';"/>
			<?php if($enable_next == 1): ?><input type="button" value="下一步" class="down" onclick="window.location.href='<?php echo U('Home/Index/step2');?>';"/>
			<?php else: ?>
			<input type="button" value="下一步" class="down" onclick="javascript:alert('您有配置未满足条件，不能进行安装');"/><?php endif; ?>
		</div>
		<div class="copyright">
			Copyright @ 2016 74cms.com All Right Reserved
		</div>
	</div>
</body>
</html>