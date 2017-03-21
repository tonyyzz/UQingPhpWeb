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
	var URL = '/index.php/admin/pms',
		SELF = '/index.php?m=admin&amp;c=pms&amp;a=index',
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
<?php if(!empty($apply['Subsite'])): ?><div class="seltpye_x">
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
</div><?php endif; ?>
<div class="seltpye_x">
    <div class="left">接收会员</div>  
    <div class="right">
    <a href="<?php echo P(array('spms_usertype'=>''));?>" <?php if($_GET['spms_usertype']== ''): ?>class="select"<?php endif; ?>>不限</a>
    <a href="<?php echo P(array('spms_usertype'=>0));?>" <?php if($_GET['spms_usertype']== '0'): ?>class="select"<?php endif; ?>>所有会员</a>
    <a href="<?php echo P(array('spms_usertype'=>1));?>" <?php if($_GET['spms_usertype']== '1'): ?>class="select"<?php endif; ?>>企业会员</a>
    <a href="<?php echo P(array('spms_usertype'=>2));?>" <?php if($_GET['spms_usertype']== '2'): ?>class="select"<?php endif; ?>>个人会员</a>
    <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
<div class="seltpye_x">
    <div class="left">消息类型</div>  
    <div class="right">
    <a href="<?php echo P(array('spms_type'=>''));?>" <?php if($_GET['spms_type']== ''): ?>class="select"<?php endif; ?>>不限</a>
    <a href="<?php echo P(array('spms_type'=>'1'));?>" <?php if($_GET['spms_type']== '1'): ?>class="select"<?php endif; ?>>普通消息</a>
    <a href="<?php echo P(array('spms_type'=>'2'));?>" <?php if($_GET['spms_type']== '2'): ?>class="select"<?php endif; ?>>注册提醒</a>
    <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>

  <form id="form1" name="form1" method="post" action="<?php echo U('delete');?>">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" id="list" class="link_lan">
    <tr>
      <td height="26" class="admin_list_tit admin_list_first" >
      <label id="chkAll"><input type="checkbox" name=" " title="全选/反选" id="chk"/>消息</label></td>
      <td width="100"   align="center" class="admin_list_tit">接收会员</td>
      <td width="100"   align="center" class="admin_list_tit">类型</td>
      <td width="120"   align="center" class="admin_list_tit" >添加日期</td>
     <td width="130"   align="center" class="admin_list_tit" >操作</td>
    </tr>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
      <td  class="admin_list admin_list_first">
        <input name="spmid[]" type="checkbox" id="id" value="<?php echo ($vo["spmid"]); ?>"/>
        <?php echo ($vo["message"]); ?>    
      </td>
      <td align="center"  class="admin_list">
        <?php if($vo['spms_usertype'] == '0'): ?>所有会员<?php endif; ?>
        <?php if($vo['spms_usertype'] == '1'): ?>企业会员<?php endif; ?>
        <?php if($vo['spms_usertype'] == '2'): ?>个人会员<?php endif; ?>   
      </td>
      <td align="center"  class="admin_list">
        <?php if($vo['spms_type'] == '1'): ?>普通消息<?php endif; ?>
        <?php if($vo['spms_type'] == '2'): ?>注册提醒<?php endif; ?>
      </td>
      <td align="center"  class="admin_list"><?php echo admin_date($vo['dateline']);?></td>
      <td align="center"  class="admin_list">
    <a href="<?php echo U('edit',array('spmid'=>$vo['spmid']));?>">修改</a> &nbsp;&nbsp;
    <a href="<?php echo U('delete',array('spmid'=>$vo['spmid']));?>" onclick="return confirm('你确定要删除吗？')">删除</a></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
  </form>
  <?php if(!$list): ?><div class="admin_list_no_info">没有任何信息！</div><?php endif; ?>
<table width="100%" border="0" cellspacing="10"  class="admin_list_btm">
<tr>
        <td>
        <input name="ButADD" type="button" class="admin_submit" id="ButADD" value="添加"  onclick="window.location='<?php echo U('add');?>'"/>
    <input name="ButDel" type="button" class="admin_submit" id="ButDel"  value="删除所选"/>
    </td>
        <td width="305" align="right">
    <form id="formseh" name="formseh" method="get" action="">  
      <input type="hidden" name="m" value="<?php echo MODULE_NAME;?>">
      <input type="hidden" name="c" value="<?php echo CONTROLLER_NAME;?>">
      <input type="hidden" name="a" value="<?php echo ACTION_NAME;?>">
      <div class="seh">
          <div class="keybox"><input name="key" type="text"   value="<?php echo ($_GET['key']); ?>" /></div>
          <div class="selbox">
          <input name="key_type_cn"  id="key_type_cn" type="text" value="<?php echo ((isset($_GET['key_type_cn']) && ($_GET['key_type_cn'] !== ""))?($_GET['key_type_cn']):"消息"); ?>" readonly="true"/>
            <div>
                <input name="key_type" id="key_type" type="hidden" value="<?php echo ((isset($_GET['key_type']) && ($_GET['key_type'] !== ""))?($_GET['key_type']):"1"); ?>" />
                        <div id="sehmenu" class="seh_menu">
                            <ul>
                            <li id="1" title="消息">消息</li>
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
      </td>
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
  //点击批量取消  
  $("#ButDel").click(function(){
    if (confirm('你确定要删除吗？'))
    {
      $("form[name=form1]").submit()
    }
  });
});
</script>
</body>
</html>