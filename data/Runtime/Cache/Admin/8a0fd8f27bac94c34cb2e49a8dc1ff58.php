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
	var URL = '/index.php/admin/order',
		SELF = '/index.php?m=admin&amp;c=order&amp;a=index_per',
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
	<?php if(empty($_GET['_k_v'])): if(!empty($apply['Subsite'])): ?><div class="seltpye_x">
		    <div class="left">所属分站</div>
		    <?php $tag_subsite_class = new \Common\qscmstag\subsiteTag(array('列表名'=>'subsite_list','cache'=>'0','type'=>'run',));$subsite_list = $tag_subsite_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("title"=>"","keywords"=>"","description"=>"","header_title"=>""),$subsite_list);?>
		    <div class="right">
		      <a href="<?php echo P(array('subsite_id'=>''));?>" <?php if($_GET['subsite_id']== ''): ?>class="select"<?php endif; ?>>不限</a>
		      <?php if($visitor['role_id'] == 1): if(is_array($subsite_list)): $i = 0; $__LIST__ = $subsite_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subsite): $mod = ($i % 2 );++$i;?><a href="<?php echo P(array('subsite_id'=>$subsite['s_id']));?>" <?php if($_GET['subsite_id']== $subsite['s_id']): ?>class="select"<?php endif; ?>><?php echo ($subsite["s_sitename"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
		      <?php else: ?>
		        <?php if(is_array($subsite_list)): $i = 0; $__LIST__ = $subsite_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subsite): $mod = ($i % 2 );++$i; if(in_array($subsite['s_id'],$visitor['subsite'])): ?><a href="<?php echo P(array('subsite_id'=>$subsite['s_id']));?>" <?php if($_GET['subsite_id']== $subsite['s_id']): ?>class="select"<?php endif; ?>><?php echo ($subsite["s_sitename"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
		      <div class="clear"></div>
		    </div>
		    <div class="clear"></div>
		</div><?php endif; endif; ?>
	<div class="seltpye_x">
		<div class="left">完成状态</div>	
		<div class="right">
			<a href="<?php echo P(array('is_paid'=>''));?>" <?php if($_GET['is_paid']== ''): ?>class="select"<?php endif; ?>>不限</a>
			<a href="<?php echo P(array('is_paid'=>2));?>" <?php if($_GET['is_paid']== '2'): ?>class="select"<?php endif; ?>>已完成</a>
			<a href="<?php echo P(array('is_paid'=>1));?>" <?php if($_GET['is_paid']== '1'): ?>class="select"<?php endif; ?>>待付款</a>
			<a href="<?php echo P(array('is_paid'=>3));?>" <?php if($_GET['is_paid']== '3'): ?>class="select"<?php endif; ?>>已取消</a>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
  </div>
    <div class="seltpye_x">
		<div class="left">付款方式</div>	
		<div class="right">
			<a href="<?php echo P(array('payment'=>''));?>" <?php if($_GET['payment']== ''): ?>class="select"<?php endif; ?>>不限</a>
			<a href="<?php echo P(array('payment'=>'points'));?>" <?php if($_GET['payment']== 'points'): ?>class="select"<?php endif; ?>><?php echo C('qscms_points_byname');?>支付</a>
			<?php if(is_array($payment_list)): $i = 0; $__LIST__ = $payment_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo P(array('payment'=>$vo['typename']));?>" <?php if($_GET['payment']== $vo['typename']): ?>class="select"<?php endif; ?>><?php echo ($vo['byname']); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
  </div>
  <div class="seltpye_x">
		<div class="left">添加时间</div>	
		<div class="right">
		<a href="<?php echo P(array('settr'=>''));?>" <?php if($_GET['settr']== ''): ?>class="select"<?php endif; ?>>不限</a>
		<a href="<?php echo P(array('settr'=>3));?>" <?php if($_GET['settr']== 3): ?>class="select"<?php endif; ?>>三天内</a>
		<a href="<?php echo P(array('settr'=>7));?>" <?php if($_GET['settr']== 7): ?>class="select"<?php endif; ?>>一周内</a>
		<a href="<?php echo P(array('settr'=>30));?>" <?php if($_GET['settr']== 30): ?>class="select"<?php endif; ?>>一月内</a>
		<a href="<?php echo P(array('settr'=>180));?>" <?php if($_GET['settr']== 180): ?>class="select"<?php endif; ?>>半年内</a>
		<a href="<?php echo P(array('settr'=>360));?>" <?php if($_GET['settr']== 360): ?>class="select"<?php endif; ?>>一年内</a>
		<div class="clear"></div>
		</div>
		<div class="clear"></div>
  </div>
  <form id="form1" name="form1" method="post" action="<?php echo U('order_cancel_per');?>">
  <input type="hidden" name="_k_v" value="<?php echo ($_GET['_k_v']); ?>">
  <table width="100%" border="0" cellpadding="0" cellspacing="0"  id="list" class="link_lan">
    <tr>
      <td  width="10%" class="admin_list_tit admin_list_first">
	   <label id="chkAll"><input type="checkbox" name=" " title="全选/反选" id="chk"/>全选</label></td>
      <td class="admin_list_tit" width="10%">金额</td>   
	  <td class="admin_list_tit">说明</td> 
	  <td align="center" class="admin_list_tit" width="190">单号</td>
	  <td width="10%" align="center" class="admin_list_tit">申请会员</td>
	  <td width="8%" align="center" class="admin_list_tit">申请时间</td>
      <td width="8%" align="center" class="admin_list_tit">支付方式</td>      
      <td width="15%" align="center"  class="admin_list_tit">操作</td>
    </tr>
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
      <td class="admin_list admin_list_first">	 
	  <?php if($vo['is_paid'] == 1): ?><input name="id[]" type="checkbox" id="y_id" value="<?php echo ($vo['id']); ?>"  />
	  <span style="color: #FF6600">待付款...</span>
	  <?php elseif($vo['is_paid'] == 2): ?>
	  <input name="id[]" type="checkbox" id="y_id" value="<?php echo ($vo['id']); ?>" disabled="disabled"/>
		<span style="color: #009900;">已完成</span>
	  <?php else: ?>
	  	<input name="id[]" type="checkbox" id="y_id" value="<?php echo ($vo['id']); ?>" disabled="disabled"/>
		<span style="color: #999;">已取消</span><?php endif; ?>
	   </td>
        <td class="admin_list">￥<strong><?php echo ($vo['amount']); ?></strong>元</td>        
		<td class="admin_list"><?php echo ($vo['description']); ?></td>     
		<td align="center" class="admin_list"><?php echo ($vo['oid']); ?></td>
		<td align="center" class="admin_list"><?php echo ($vo['username']); ?></td>
		<td align="center" class="admin_list"><?php echo admin_date($vo['addtime']);?></td>    
        <td align="center" class="admin_list"><?php echo ($vo['payment_cn']); ?></td>        
        <td align="center" class="admin_list">
        <?php if($vo['is_paid'] == 2 || $vo['is_paid'] == 3): ?><a href="<?php echo U('order_show_per',array('id'=>$vo['id'],'_k_v'=>$_GET['_k_v']));?>">查看</a>&nbsp;设置<?php endif; ?>
		<?php if($vo['is_paid'] == 1): ?><a href="<?php echo U('order_set_per',array('id'=>$vo['id'],'_k_v'=>$_GET['_k_v']));?>">设置</a>
			<a href="<?php echo U('order_cancel_per',array('id'=>$vo['id'],'_k_v'=>$_GET['_k_v']));?>" onclick="return confirm('你确定要取消吗？')">取消</a><?php endif; ?>
		<?php if($_GET['_k_v']== ''): ?>&nbsp;
        	<a class="userinfo" parameter="uid=<?php echo ($vo['uid']); ?>" href="javascript:void(0);" hideFocus="true">管理</a><?php endif; ?>
		</td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>
	<?php if(!$list): ?><div class="admin_list_no_info">没有任何信息！</div><?php endif; ?>
  </form>
	<table width="100%" border="0" cellspacing="10" cellpadding="0" class="admin_list_btm">
      <tr>
        <td>
          <input name="ButAudit" type="button" class="admin_submit" id="ButDelOrder"  value="取消订单"  />
		</td>
		<?php if($_GET['_k_v']== ''): ?><td width="305" align="right">
			<form id="formseh" name="formseh" method="get" action="?">	
	              <input type="hidden" name="m" value="<?php echo MODULE_NAME;?>">
	              <input type="hidden" name="c" value="<?php echo CONTROLLER_NAME;?>">
	              <input type="hidden" name="a" value="<?php echo ACTION_NAME;?>">
				<div class="seh">
				    <div class="keybox"><input name="key" type="text"   value="<?php echo ($_GET['key']); ?>" /></div>
				    <div class="selbox">
						<input name="key_type_cn"  id="key_type_cn" type="text" value="<?php echo ((isset($_GET['key_type_cn']) && ($_GET['key_type_cn'] !== ""))?($_GET['key_type_cn']):"用户名"); ?>" readonly="true"/>
							<div>
									<input name="key_type" id="key_type" type="hidden" value="<?php echo ((isset($_GET['key_type']) && ($_GET['key_type'] !== ""))?($_GET['key_type']):"1"); ?>" />
													<div id="sehmenu" class="seh_menu">
															<ul>
															<li id="1" title="用户名">用户名</li>
															<li id="2" title="单号">单号</li>
															</ul>
													</div>
							</div>				
					</div>
					<div class="sbtbox">
					<input type="submit" name="" class="sbt" id="sbt" value="搜索"/>
					</div>
					<div class="clear"></div>
			  </div>
			  </form>
	    	</td><?php endif; ?>
      </tr>
  </table>
<div class="qspage"><?php echo ($page); ?></div>
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

<script type="text/javascript">
$(document).ready(function()
{
	showmenu("#key_type_cn","#sehmenu","#key_type");
	 $(".userinfo").QSdialog({
  DialogTitle:"管理",
  DialogContentType:"url",
  DialogContent:"<?php echo U('ajax/userinfo');?>&"
  });
	//点击批量取消	
	$("#ButDelOrder").click(function(){
		if (confirm('你确定要取消吗？'))
		{
			$("form[name=form1]").submit()
		}
	});
		
});
</script>
</body>
</html>