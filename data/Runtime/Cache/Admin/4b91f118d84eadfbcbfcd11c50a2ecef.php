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
	var URL = '/index.php/admin/article',
		SELF = '/index.php?m=admin&amp;c=article&amp;a=index',
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
        <div class="left">文章分类</div>    
        <div class="right">
            <a href="<?php echo P(array('type_id'=>'','parentid'=>''));?>" <?php if($_GET['parentid']== ''): ?>class="select"<?php endif; ?>>不限</a>
            <?php if(is_array($article_category[0])): $i = 0; $__LIST__ = $article_category[0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($i % 2 );++$i;?><a href="<?php echo P(array('type_id'=>'','parentid'=>$key));?>" <?php if($_GET['parentid']== $key): ?>class="select"<?php endif; ?>><?php echo ($category); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <?php if($_GET['parentid']!= ''): ?><div class="seltpye_x">
            <div class="left"><span style="color:#999999">└ </span>子分类</div>    
            <div class="right">
                <a href="<?php echo P(array('type_id'=>''));?>" <?php if($_GET['type_id']== ''): ?>class="select"<?php endif; ?>>不限</a>
                <?php if(is_array($article_category[$parentid])): $i = 0; $__LIST__ = $article_category[$parentid];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i;?><a href="<?php echo P(array('type_id'=>$key));?>" <?php if($_GET['type_id']== $key): ?>class="select"<?php endif; ?>><?php echo ($sub); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div><?php endif; ?>
    <div class="seltpye_x">
        <div class="left">文章属性</div>    
        <div class="right">
        <a href="<?php echo P(array('focos'=>''));?>" <?php if($_GET['focos']== ''): ?>class="select"<?php endif; ?>>不限</a>
        <?php if(is_array($article_property)): $i = 0; $__LIST__ = $article_property;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article_property): $mod = ($i % 2 );++$i;?><a href="<?php echo P(array('focos'=>$key));?>" <?php if($_GET['focos']== $key): ?>class="select"<?php endif; ?>><?php echo ($article_property); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
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
    <form id="form1" name="form1" method="post" action="<?php echo U('article/delete');?>">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" id="list" class="link_lan">
    <tr>
      <td height="26" class="admin_list_tit admin_list_first" >
      <label id="chkAll"><input type="checkbox" name=" " title="全选/反选" id="chk"/>文章标题</label></td>
      <td width="100"   align="center"  class="admin_list_tit">添加方式</td>
      <td width="100"   align="center" class="admin_list_tit"> 属性 </td>
      <td width="50"   align="center" class="admin_list_tit">排序</td>
      <td width="50"   align="center" class="admin_list_tit">点击</td>
      <td width="120"   align="center" class="admin_list_tit" >添加日期</td>
      <td width="100"   align="center" class="admin_list_tit" >操作</td>
    </tr>
      <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr>
      <td  class="admin_list admin_list_first">
        <input name="id[]" type="checkbox" id="id" value="<?php echo ($list["id"]); ?>"/>      
        <a href="<?php echo P(array('type_id'=>$list['type_id'],'parentid'=>$list['parentid']));?>" style="color: #006699">[<?php if($list['category']['categoryname']): echo ($list["category"]["categoryname"]); else: echo ($list["parent"]["categoryname"]); endif; ?>]</a>
        <a href="<?php echo url_rewrite('QS_newsshow',array('id'=>$list['id']));?>" target="_blank" style="<?php if($list['tit_color']): ?>color:<?php echo ($list["tit_color"]); ?>;<?php endif; if($list['tit_b'] > 0): ?>font-weight:bold<?php endif; ?>">
            <?php echo ($list["title"]); ?>
            <?php if($list['Small_img']): ?><span style="color:#009900">(图)</span><?php endif; ?>
        </a>
        <?php if($list['is_display'] != 1): ?><span style="color:#999999">[已屏蔽]</span><?php endif; ?>
        </td>
         <td align="center" class="admin_list" >
         <?php if($list['robot'] != 0): ?>人工<?php endif; ?>
         <?php if($list['robot'] != 1): ?>采集<?php endif; ?>
         </td>
        <td align="center"  class="admin_list"><?php echo ($list["property"]["categoryname"]); ?></td>
        <td align="center"  class="admin_list"><?php echo ($list["article_order"]); ?></td>
        <td align="center"  class="admin_list"><?php echo ($list["click"]); ?></td>
        <td align="center"  class="admin_list"><?php echo admin_date($list['addtime']);?></td>
        <td align="center"  class="admin_list">
        <a href="<?php echo U('article/edit',array('id'=>$list['id']));?>">修改</a> &nbsp;&nbsp;
        <a href="<?php echo U('article/delete',array('id'=>$list['id']));?>" onclick="return confirm('你确定要删除吗？')">删除</a></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
    </form>
    <?php if(empty($list)): ?><div class="admin_list_no_info">没有任何信息！</div><?php endif; ?>
    <table width="100%" border="0" cellspacing="10"  class="admin_list_btm">
    <tr>
        <td>
        <input type="button" class="admin_submit" id="ButADD" value="添加文章"  onclick="window.location='<?php echo U('article/add');?>'"/>
        <input type="button" class="admin_submit" id="ButDel"  value="删除所选"/>
        </td>
        <td width="305" align="right">
            <form id="formseh" name="formseh" method="get" action="">  
                <div class="seh">
                    <div class="keybox"><input name="key" type="text"   value="<?php echo ($_GET['key']); ?>" /></div>
                    <div class="selbox">
                        <input id="key_type_cn" type="text" value="<?php echo ((isset($_GET['key_type_cn']) && ($_GET['key_type_cn'] !== ""))?($_GET['key_type_cn']):"标题"); ?>" readonly="true"/>
                        <div>
                            <input name="key_type" id="key_type" type="hidden" value="<?php echo ((isset($_GET['key_type']) && ($_GET['key_type'] !== ""))?($_GET['key_type']):"1"); ?>" />
                            <div id="sehmenu" class="seh_menu">
                                <ul>
                                    <li id="1" title="标题">标题</li>
                                    <li id="2" title="资讯ID">资讯ID</li>
                                </ul>
                            </div>
                        </div>              
                    </div>
                    <div class="sbtbox">
                        <input type="hidden" name="m" value="<?php echo MODULE_NAME;?>">
                        <input type="hidden" name="c" value="<?php echo CONTROLLER_NAME;?>">
                        <input type="hidden" name="a" value="<?php echo ACTION_NAME;?>">
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
        $(document).ready(function(){
            showmenu("#key_type_cn","#sehmenu","#key_type");
        }); 
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