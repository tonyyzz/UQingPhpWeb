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
	var URL = '/index.php/admin/applyinfo',
		SELF = '/index.php?m=admin&amp;c=applyinfo&amp;a=index&amp;menuid=729&amp;child=1',
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

  </div>
  <div class="seltpye_y">
    <div class="tit link_lan">
      <strong>前台申请列表</strong><span>(共找到<?php echo ($total); ?>条)</span>
      <a href="<?php echo U('index');?>">[恢复默认]</a>
    </div>
    <div class="clear"></div>
    </div>
  <form id="form1" name="form1" method="post" action="<?php echo U('set_audit');?>">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" id="list" class="link_lan">
      	<tr>
	      <td class="admin_list_tit admin_list_first">职位名称</td>
	      <td align="center"  width="10%" class="admin_list_tit">姓名</td>
	      <td align="center"  width="10%" class="admin_list_tit">手机号</td>
	      <td align="center"  width="10%" class="admin_list_tit">性别</td>
	      <td align="center"  width="10%" class="admin_list_tit">出生日期</td>
	      <td align="center"  width="10%" class="admin_list_tit">期待工作地</td>
	      <td align="center"  width="10%" class="admin_list_tit">学历</td>
	      <td align="center"  width="10%" class="admin_list_tit">工作年限</td>
	      <td align="center"  width="10%" class="admin_list_tit">后台是否推送</td>
	      <td align="center"  width="10%" class="admin_list_tit">申请时间</td>
	      
	      <td width="100" align="center"  class="admin_list_tit">操作</td>
	    </tr>
      
        <?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr>
			    <td class="admin_list admin_list_first">	
				 <a href="<?php echo U('home/jobs/jobs_show', array('id' => $list['jobid']));?>" target="_blank" style="color:#018fcf" ><?php echo ($list["jobs_name"]); ?></a>		 	
			    </td>
		        <td class="admin_list" align="center"><?php echo ($list["name"]); ?></td>
				<td class="admin_list" align="center"><?php echo ($list["phone"]); ?></td>
				<td class="admin_list" align="center"><?php echo ($list["sex"]); ?></td>
				<td class="admin_list" align="center"><?php echo ($list["age"]); ?></td>
		        <td class="admin_list" align="center"><?php echo ($list["address"]); ?></td>
				<td class="admin_list" align="center"><?php echo ($list["education"]); ?></td>
				<td class="admin_list" align="center"><?php echo ($list["year"]); ?></td>
				<td class="admin_list" align="center"><?php echo ($list["view"]); ?></td>
				<td class="admin_list" align="center"><?php echo (date("m-d H:i",$list["addtime"])); ?></td>
				
		        <td class="admin_list" align="center" >
		        	<a href="<?php echo U('Applyinfo/apply', array('id' => $list['id'], 'jobid' => $list['jobid']));?>" onclick="return confirm('你确定要推送吗?');">推送</a> &nbsp;&nbsp;
					<a href="<?php echo U('Applyinfo/del_jobs', array('id' => $list['id']));?>" onclick="return confirm('你确定要删除吗？');">删除</a> 
				</td>
	        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </table>
      <span id="OpAudit"></span>
</form>
    <?php if(!$res): ?><div class="admin_list_no_info">没有任何信息！</div><?php endif; ?>
    <div class="qspage"><?php echo ($page); ?></div>
    <div class="footer link_lan">
Powered by <a href="http://www.74cms.com" target="_blank"><span style="color:#009900">74</span><span style="color: #FF3300">CMS</span></a> <?php echo C('QSCMS_VERSION');?>
</div>
<div class="admin_frameset" >
  <div class="open_frame" title="全屏" id="open_frame"></div>
  <div class="close_frame" title="还原窗口" id="close_frame"></div>
</div>
</body>
</html>
</body>
</html>