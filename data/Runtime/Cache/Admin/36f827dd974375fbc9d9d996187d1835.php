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
	var URL = '/index.php/admin/personal',
		SELF = '/index.php?m=admin&amp;c=personal&amp;a=jobs_subscribe',
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
    <div class="left">添加时间</div>  
    <div class="right">
    <a href="<?php echo P(array('addtime'=>''));?>" <?php if($_GET['addtime']== '' || !$Think.get.addtime): ?>class="select"<?php endif; ?>>不限</a>
    <a href="<?php echo P(array('addtime'=>3));?>" <?php if($_GET['addtime']== 3): ?>class="select"<?php endif; ?>>三天内</a>
    <a href="<?php echo P(array('addtime'=>7));?>" <?php if($_GET['addtime']== 7): ?>class="select"<?php endif; ?>>一周内</a>
    <a href="<?php echo P(array('addtime'=>30));?>" <?php if($_GET['addtime']== 30): ?>class="select"<?php endif; ?>>一月内</a>
    <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
  <form id="form1" name="form1" method="post" action="<?php echo U('subscribe_del');?>">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="link_lan" id="list">
    <tr>
      <td height="26" class="admin_list_tit admin_list_first" >
      <label id="chkAll"><input type="checkbox" name=" " title="全选/反选" id="chk"/>接收邮箱</label>
    </td>
      <td width="15%" class="admin_list_tit">订阅关键字</td>
     <td width="15%" class="admin_list_tit">意向职位</td>
     <td width="15%" class="admin_list_tit">意向行业</td>
     <td width="10%" class="admin_list_tit">意向薪资</td>
      <td width="10%" align="center" class="admin_list_tit"> 意向地区 </td>
      <td width="10%" align="center" class="admin_list_tit" >添加时间</td>
      <td width="10%" align="center" class="admin_list_tit" >操作</td>
    </tr>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
      <td  class="admin_list admin_list_first">
        <input name="id[]" type="checkbox" id="id" value="{#$list.id#}"/>    
        <?php echo ($vo["email"]); ?>
      </td>
      <td  class="admin_list" ><?php echo ($vo["key"]); ?></td>
      <td  class="admin_list" ><?php echo ($vo["intention_jobs"]); ?></td>
      <td  class="admin_list" ><?php echo ($vo["trade_cn"]); ?></td>
      <td  class="admin_list" ><?php echo ($vo["wage_cn"]); ?></td>
      <td align="center"  class="admin_list"><?php echo ($vo["district_cn"]); ?> </td>
      <td align="center"  class="admin_list"><?php echo admin_date($vo['addtime']);?></td>
      <td align="center"  class="admin_list">
      <a href="<?php echo U('subscribe_del',array('id'=>$vo['id']));?>" onclick="return confirm('你确定要删除吗？')">删除</a></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
  </form>
  <?php if(!$list): ?><div class="admin_list_no_info">没有任何信息！</div><?php endif; ?>
<table width="100%" border="0" cellspacing="10"  class="admin_list_btm">
<tr>
        <td>
    <input name="ButDel" type="button" class="admin_submit" id="ButDel"  value="删除"/>
    </td>
        <td width="305" align="right">
    <form id="formseh" name="formseh" method="get" action="?">  
          <input type="hidden" name="m" value="<?php echo MODULE_NAME;?>">
          <input type="hidden" name="c" value="<?php echo CONTROLLER_NAME;?>">
          <input type="hidden" name="a" value="<?php echo ACTION_NAME;?>">
      <div class="seh">
          <div class="keybox"><input name="key" type="text"   value="<?php echo ($_GET['key']); ?>" /></div>
          <div class="selbox">
          <input name="key_type_cn"  id="key_type_cn" type="text" value="<?php echo ((isset($_GET['key_type_cn']) && ($_GET['key_type_cn'] !== ""))?($_GET['key_type_cn']):"意向职位"); ?>" readonly="true"/>
            <div>
                <input name="key_type" id="key_type" type="hidden" value="<?php echo ((isset($_GET['key_type']) && ($_GET['key_type'] !== ""))?($_GET['key_type']):"1"); ?>" />
                        <div id="sehmenu" class="seh_menu">
                            <ul>
                            <li id="1" title="意向职位">意向职位</li>
                            <li id="2" title="意向行业">意向行业</li>
                            <li id="3" title="意向地区">意向地区</li>
                            <li id="4" title="接收邮箱">接收邮箱</li>
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
  //删除
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