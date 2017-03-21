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
	var URL = '/index.php/admin/jobs',
		SELF = '/index.php?m=admin&amp;c=jobs&amp;a=edit&amp;id=1',
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
<div class="toptit">修改职位- <span style="color:#0066CC"><?php echo ($info["jobs_name"]); ?></span> </div>
<form id="Form1" name="Form1" method="post" action="<?php echo U('edit');?>" >
  <table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF"  >
<tr>
          <td width="110" height="30" align="right" bgcolor="#FFFFFF" >所属会员：</td>
          <td bgcolor="#FFFFFF" >
<?php echo ($info["user"]["username"]); ?>
     </td>
    </tr>
    <tr>
          <td height="30" align="right" bgcolor="#FFFFFF" >所属企业：</td>
          <td bgcolor="#FFFFFF"  class="link_lan">
            <a href="<?php echo url_rewrite('QS_companyshow',array('id'=>$info['company_id']));?>" target="_blank"><?php echo ($info["companyname"]); ?></a>
       </td>
        </tr>
    <tr>
          <td height="30" align="right" bgcolor="#FFFFFF" >刷新时间：</td>
          <td bgcolor="#FFFFFF"  class="link_lan">
          <?php echo date('Y-m-d',$info['refreshtime']);?>
       </td>
        </tr>
        <tr>
          <td height="30" align="right" bgcolor="#FFFFFF">有效日期：</td>
          <td bgcolor="#FFFFFF" >发布日期：<?php echo date('Y-m-d H:i',$info['addtime']);?>，截止日期：<?php if(($info['deadline']) == "0"): ?>无限期<?php else: echo date('Y-m-d H:i',$info['deadline']); endif; ?><input name="olddeadline" type="hidden" value="<?php echo ($info['deadline']); ?>" /></td>
        </tr>
     <tr>
          <td height="30" align="right" bgcolor="#FFFFFF"  ><span style="color:#FF3300; font-weight:bold">*</span> 职位名称：</td>
          <td  ><input name="jobs_name" type="text" class="input_text_200" id="jobs_name" value="<?php echo ($info['jobs_name']); ?>" maxlength="50" />
       </td>
    </tr>
        <tr>
          <td height="30" align="right" bgcolor="#FFFFFF" ><span style="color:#FF3300; font-weight:bold">*</span>  招聘状态：</td>
          <td bgcolor="#FFFFFF" >
      <label><input name="display"  type="radio" value="1" <?php if($info['display'] == 1): ?>checked="checked"<?php endif; ?> />在招</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <label><input name="display"  type="radio" value="2" <?php if($info['display'] == 2): ?>checked="checked"<?php endif; ?> />关闭</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     </td>
        </tr>
    <tr>
          <td height="30" align="right" bgcolor="#FFFFFF" ><span style="color:#FF3300; font-weight:bold">*</span> 审核状态：</td>
          <td bgcolor="#FFFFFF" >
       <label><input name="audit"  type="radio" value="1" <?php if($info['audit'] == 1): ?>checked="checked"<?php endif; ?> />审核通过</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label><input name="audit"  type="radio" value="2" <?php if($info['audit'] == 2): ?>checked="checked"<?php endif; ?> />审核中</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     
       <label><input name="audit"  type="radio" value="3" <?php if($info['audit'] == 3): ?>checked="checked"<?php endif; ?> />审核未通过</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     </td>
        </tr>
       
     
    <tr>
          <td width="110" height="30" align="right" bgcolor="#FFFFFF"  ><span style="color:#FF3300; font-weight:bold">*</span> 性别要求：</td>
          <td  >
      
       <label><input name="sex"  type="radio" value="1"  title="男" <?php if($info['sex'] == 1): ?>checked="checked"<?php endif; ?> />男</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <label><input name="sex"  type="radio" value="2"  title="女"  <?php if($info['sex'] == 2): ?>checked="checked"<?php endif; ?> />女</label>
      
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <label><input name="sex"  type="radio" value="0"  title="不限" <?php if($info['sex'] == 0): ?>checked="checked"<?php endif; ?> />不限</label>
       <input name="sex_cn" type="hidden" value="<?php echo ($info["sex_cn"]); ?>" id="sex_cn" />
      </td>
        </tr>
     <tr>
          <td width="110" height="30" align="right" bgcolor="#FFFFFF"  >年龄要求：</td>
          <td class="modVal"  >
            <input name="minage" type="text" class="input_text_50" id="minage" value="<?php echo ($info['minage']); ?>" maxlength="3" /> 岁 - <input name="maxage" type="text" class="input_text_50" id="maxage" value="<?php echo ($info['maxage']); ?>" maxlength="3" /> 岁
               </td>
        </tr>
        <tr>
          <td height="30" align="right" bgcolor="#FFFFFF" ><span style="color:#FF3300; font-weight:bold">*</span> 职位性质：</td>
          <td bgcolor="#FFFFFF" >
<?php if(is_array($category['QS_jobs_nature'])): $i = 0; $__LIST__ = $category['QS_jobs_nature'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nature): $mod = ($i % 2 );++$i;?><label><input type="radio" name="nature" value="<?php echo ($key); ?>" title="<?php echo ($nature); ?>" <?php if($info['nature'] == $key): ?>checked="checked"<?php endif; ?> ><?php echo ($nature); ?></label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
<input name="nature_cn" type="hidden" value="<?php echo ($info["nature_cn"]); ?>"  id="nature_cn"/>
      </td>
        </tr>
        <tr>
          <td height="30" align="right" bgcolor="#FFFFFF" ><span style="color:#FF3300; font-weight:bold;">*</span> 招聘人数：</td>
          <td bgcolor="#FFFFFF" ><input name="amount" type="text" class="input_text_200" id="amount" value="<?php echo ($info["amount"]); ?>" maxlength="4" onKeyUp="if(event.keyCode !=37 && event.keyCode != 39) value=value.replace(/\D/g,'');"onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/\D/g,''))"/>
            人</td>
        </tr>
        <tr>
          <td height="30" align="right"   bgcolor="#FFFFFF" ><span style="color:#FF3300; font-weight:bold">*</span> 职位类别：</td>
          <td bgcolor="#FFFFFF" >
       
      <div>
        <input type="text" value="<?php echo ((isset($info['category_cn']) && ($info['category_cn'] !== ""))?($info['category_cn']):"请选择"); ?>" readonly="readonly" name="category_cn" id="category_cn" data-title="请选择职位类别" data-multiple="false" data-maxnum="0" <?php if(C('qscms_category_jobs_level') > 2): ?>data-width="667"<?php else: ?>data-width="520"<?php endif; ?> data-category="<?php echo C('qscms_category_jobs_level');?>" class="input_text_200 input_text_selsect J_resuletitle_jobs"/>
        <input class="J_resultcode_jobs" name="jobcategory" id="jobcategory" type="hidden" value="<?php echo ($info['topclass']); ?>.<?php echo ($info['category']); ?>.<?php echo ($info['subclass']); ?>" />
      </div>
      </td>
        </tr>
        <tr>
          <td height="30" align="right" bgcolor="#FFFFFF" ><span style="color:#FF3300; font-weight:bold">*</span> 工作地区：</td>
          <td bgcolor="#FFFFFF" >
      <div>
        <input type="text" value="<?php echo ((isset($info['district_cn']) && ($info['district_cn'] !== ""))?($info['district_cn']):"请选择"); ?>"  readonly="readonly" name="district_cn" id="district_cn" data-title="请选择工作地区" data-multiple="false" data-maxnum="0" <?php if(C('qscms_category_district_level') > 2): ?>data-width="667"<?php else: ?>data-width="520"<?php endif; ?> data-category="<?php echo C('qscms_category_district_level');?>" class="input_text_200 input_text_selsect J_resuletitle_city"/>
        <input class="J_resultcode_city" name="districtcategory" id="districtcategory" type="hidden" value="<?php echo ($info['district']); ?>.<?php echo ($info['sdistrict']); ?>.<?php echo ($info['tdistrict']); ?>" />
      </div>

      </td>
        </tr>
     <tr>
          <td width="110" height="30" align="right" bgcolor="#FFFFFF"  ><span style="color:#FF3300; font-weight:bold">*</span> 薪资待遇：</td>
          <td class="modVal"  >
            <span class="input_wrap"><input name="minwage" type="text" class="input_text_100 input_val" id="minwage" value="<?php echo ($info['minwage']); ?>" maxlength="50" /> 元/月 - <input name="maxwage" type="text" class="input_text_100 input_val" id="maxwage" value="<?php echo ($info['maxwage']); ?>" maxlength="50" /> 元/月 </span><label><input name="negotiable" type="checkbox" id="J_negotiable" value="1" <?php if($info['negotiable'] == 1): ?>checked<?php endif; ?>/>面议</label>
               </td>
        </tr>
        <tr>
          <td height="30" align="right" bgcolor="#FFFFFF" >所属部门：</td>
          <td bgcolor="#FFFFFF" ><input name="department" type="text" class="input_text_200" id="department" value="<?php echo ($info["department"]); ?>" maxlength="4" /></td>
        </tr>
       <tr>
          <td height="30" align="right" bgcolor="#FFFFFF" > 学历要求：</td>
          <td bgcolor="#FFFFFF" >
      <div>
    <input type="text" value="<?php echo ((isset($info['education_cn']) && ($info['education_cn'] !== ""))?($info['education_cn']):"请选择"); ?>"  readonly="readonly" name="education_cn" id="education_cn" class="input_text_200 input_text_selsect"/>
    <input name="education" id="education" type="hidden" value="<?php echo ($info["education"]); ?>" />
    <div id="menu3" class="menu">
      <ul>
      <?php if(is_array($category['QS_education'])): $i = 0; $__LIST__ = $category['QS_education'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li id="<?php echo ($key); ?>" title="<?php echo ($list); ?>"><?php echo ($list); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
    </div>
      </div>
       </td>
          </tr>
        <tr>
          <td height="30" align="right" bgcolor="#FFFFFF" >工作经验：</td>
          <td bgcolor="#FFFFFF" >
     
     <div>
    <input type="text" value="<?php echo ((isset($info['experience_cn']) && ($info['experience_cn'] !== ""))?($info['experience_cn']):"请选择"); ?>"  readonly="readonly" name="experience_cn" id="experience_cn" class="input_text_200 input_text_selsect"/>
    <input name="experience" id="experience" type="hidden" value="<?php echo ($info["experience"]); ?>" />
    <div id="menu4" class="menu">
      <ul>
      <?php if(is_array($category['QS_experience'])): $i = 0; $__LIST__ = $category['QS_experience'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$experience): $mod = ($i % 2 );++$i;?><li id="<?php echo ($key); ?>" title="<?php echo ($experience); ?>"><?php echo ($experience); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
    </div>
      </div>
     
      </td>
            </tr>
            <tr>
          <td height="30" align="right" bgcolor="#FFFFFF" >职位亮点：</td>
          <td bgcolor="#FFFFFF" >
     
     <div>
      <input type="text" value="<?php echo ((isset($info['tag_cn']) && ($info['tag_cn'] !== ""))?($info['tag_cn']):"请选择"); ?>"  readonly="readonly" name="tag" id="tag" data-title="请选择职位亮点" data-multiple="true" data-maxnum="6" data-width="582" class="input_text_300 input_text_selsect J_resuletitle_jobtag"/>
      <input class="J_resultcode_jobtag" name="tag" id="tag" type="hidden" value="<?php echo ($info["tag"]); ?>" />
      </div>
      </td>
            </tr>

        <tr>
          <td align="right" valign="top" bgcolor="#FFFFFF" >
      <span style="color:#FF3300; font-weight:bold">*</span> 职位描述：</td>
  <td bgcolor="#FFFFFF" >
       <textarea name="contents" class="company_mb_textarea" id="contents" style="width:580px; height:180px;" ><?php echo ($info["contents"]); ?></textarea>
        <br />
            <div style="line-height:30px; height:30px;">&nbsp;说明：请详细描述该职位，内容可包括：职位要求，岗位职责等。</div></td>
        </tr>
    
    </table>
    
<div class="toptit">联系方式</div>
      <table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF"  >
    <tr>
          <td width="110" height="30" align="right" bgcolor="#FFFFFF" ><span style="color:#FF3300; font-weight:bold">*</span> 联 系 人：</td>
          <td bgcolor="#FFFFFF" >
      <input name="contact" type="text" class="input_text_200" id="contact" value="<?php echo ($info["contact"]["contact"]); ?>" maxlength="15" />
           <label><input name="contact_show"  type="checkbox" value="1" <?php if($info['contact']['contact_show'] == 1): ?>checked="checked"<?php endif; ?> />联系人在职位详细页中显示</label>
      </td>
        </tr>
    <tr>
          <td height="30" align="right" bgcolor="#FFFFFF" ><span style="color:#FF3300; font-weight:bold">*</span> 联系手机：</td>
          <td bgcolor="#FFFFFF" >
      <input name="telephone" type="text" class="input_text_200" id="telephone" maxlength="35" value="<?php echo ($info["contact"]["telephone"]); ?>" />
           <label><input name="telephone_show"  type="checkbox" value="1" <?php if($info['contact']['telephone_show'] == 1): ?>checked="checked"<?php endif; ?> />联系电话在职位详细页中显示</label>
      </td>
        </tr>
        <tr>
        <td height="30" align="right"  >固定电话：</td>
        <td  >
          <input type="text" id="landline_tel_first" name="landline_tel_first" class="input_text_50" style="width:40px;" maxlength="4"   value="<?php echo ($telarray[0]); ?>"/>&nbsp;-
          <input id="landline_tel_next" name="landline_tel_next" type="text" class="input_text_100" style="width:90px;" maxlength="11"   value="<?php echo ($telarray[1]); ?>"/>&nbsp;-
          <input id="landline_tel_last" name="landline_tel_last" type="text" class="input_text_50" style="width:40px;" maxlength="6"   value="<?php echo ($telarray[2]); ?>"/> <label><input name="landline_tel_show"  type="checkbox" value="1" <?php if($info['contact']['landline_tel_show'] == 1): ?>checked="checked"<?php endif; ?> />固定电话在职位详细页中显示</label>
        </td>
        <td>&nbsp;</td>
        </tr>
  <tr>
          <td height="30" align="right" bgcolor="#FFFFFF" ><span style="color:#FF3300; font-weight:bold">*</span> 联系邮箱：</td>
          <td bgcolor="#FFFFFF" ><label>
          <input name="email" type="text" class="input_text_200" id="email" maxlength="80"  value="<?php echo ($info["contact"]["email"]); ?>"/>
          </label>
           <label><input name="notify"  type="checkbox" value="1" <?php if($info['contact']['notify'] == 1): ?>checked="checked"<?php endif; ?> />接收投递的简历</label>
      </td>
        </tr>
        <tr>
          <td height="30" align="right" bgcolor="#FFFFFF" ><span style="color:#FF3300; font-weight:bold">*</span> 联系地址：</td>
          <td bgcolor="#FFFFFF" >
      <input name="address" type="text" class="input_text_200" id="address" maxlength="50"  value="<?php echo ($info["contact"]["address"]); ?>"/>
      </td>
        </tr>
          <tr>
            <td height="30" align="right" bgcolor="#FFFFFF" >&nbsp;</td>
            <td height="120" bgcolor="#FFFFFF"><span style="font-size:14px;">
              <input type="hidden" name="id"  value="<?php echo ($info["id"]); ?>" />
              <input type="hidden" name="uid"  value="<?php echo ($info["uid"]); ?>" />
              <input type="hidden" name="company_id"  value="<?php echo ($info["company_id"]); ?>" />       
              <input name="submit3" type="submit" class="admin_submit"    value="保存修改"/> 
              <input name="submit22" type="button" class="admin_submit"    value="返 回" onclick="history.go(-1);"/>
            </span></td>
          </tr>
  </table>
  </form>
 <!--    
<form id="Form2" name="Form2" method="post" action="?act=del_auditreason">
<div class="toptit">职位审核日志</div>
    <table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF"  >
    {#foreach from=$jobsaudit item=list#}
    <tr>
          <td height="30" width="180" align="right" bgcolor="#FFFFFF" >
      <label>
        <input type="checkbox" name="a_id[]" value="{#$list.id#}">
        <span style="font-weight:bold">{#$list.addtime|date_format:"%Y-%m-%d %H:%M:%S"#}</span> 
      <label>
      </td>
          <td bgcolor="#FFFFFF" >
        {#$list.reason#}
      </td>
        </tr>
    {#/foreach#}
    <tr>
            <td height="30" align="right" bgcolor="#FFFFFF" >&nbsp;</td>
            <td height="120" bgcolor="#FFFFFF" ><span style="font-size:14px;">
              <input name="submit3" type="submit" class="admin_submit"    value="删除所选"/> 
              <input name="submit22" type="button" class="admin_submit"    value="返 回" onclick="window.location.href='{#$url#}'"/>
            </span></td>
          </tr>
  </table>
 </form> -->
    
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
<?php $tag_load_class = new \Common\qscmstag\loadTag(array('type'=>'category','cache'=>'0','列表名'=>'list',));$list = $tag_load_class->category();?>
<script type="text/javascript" src="../public/js/jquery.modal.userselectlayer.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
  if ($('#J_negotiable').is(':checked')) {
    $('#J_negotiable').closest('.modVal').find('.input_val').val('').prop('disabled', !0);
    $('#J_negotiable').closest('.modVal').find('.input_wrap').hide();
  } 
  // 面议选中后，最低和最高薪资不能编辑
  $('#J_negotiable').die().live('click', function(event) {
    if ($(this).is(':checked')) {
      $(this).closest('.modVal').find('.input_val').val('').prop('disabled', !0);
      $(this).closest('.modVal').find('.input_wrap').hide();
    } else {
      $(this).closest('.modVal').find('.input_val').each(function(index, el) {
        $(this).val($(this).data('title')).prop('disabled', 0);
      });
      $(this).closest('.modVal').find('.input_wrap').show();
    }
  });
  showmenu("#education_cn","#menu3","#education");
  showmenu("#experience_cn","#menu4","#experience");
  showmenu("#wage_cn","#menu5","#wage");
  //设置性别中文字段
  $("input[name='sex']").click(function(){$("#sex_cn").val($(this).attr("title")) });
  
  //设置职位性质中文字段
  $("input[name='nature']").click(function(){$("#nature_cn").val($(this).attr("title")) });
  jQuery.validator.addMethod("isPhoneNumber", function(value, element) {   
      var tel = /^((0\d{2,3}-[2-9][0-9]{6,7})|(0\d{2,3}[2-9][0-9]{6,7})|([2-9][0-9]{6,7})|(1[35847]\d{9}))$/;
      return this.optional(element) || (tel.test(value));
  }, "请正确填写联系电话");
  jQuery.validator.addMethod("isLineNumber", function(value, element) {   
      var tel = /^[0-9]{6,11}$/;
      return this.optional(element) || (tel.test(value));
  }, "请输入6-11位的数字");
  // 自定义验证方法，验证区号
  $.validator.addMethod("inputRegValiZone", function(value, element, param) {
    if (this.optional(element))
        return "dependency-mismatch";
    var reg = param;
    if (typeof param == 'string') {
        reg = new RegExp(param);
    }
    return reg.test(value);
  }, '区号格式不正确');
  // 自定义验证方法，固话手机二选一
  $.validator.addMethod("lineMobileAchoice", function(value, element, param) {
    var regularTelphone = /^13[0-9]{9}$|14[0-9]{9}$|15[0-9]{9}$|18[0-9]{9}$|17[0-9]{9}$/;
    var achoice = true;
    var telphoneValue = $.trim($('#telephone').val());
    var landlinefirstValue = $.trim($("#landline_tel_first").val());
    var landlinenextValue = $.trim($("#landline_tel_next").val());
    if (telphoneValue == '' && landlinenextValue == '') {
        achoice = false;
    }
    if (telphoneValue != "" && !regularTelphone.test(telphoneValue) && landlinenextValue == '') {
        achoice = false;
    }
    return achoice;
  }, '固定电话和手机号码请至少填写一项');
  $("#Form1").validate({
     rules:{
     jobs_name:{
      required: true,
    minlength:2,
      maxlength:30
     },
     amount: {
      required: true,
    range:[0,9999]
     },
     category: "required",
     district: "required",
     wage: "required",
     education: "required",
     experience: "required",
     contents:{
     required: true,
    minlength:5,
      maxlength:1000
     },
     contact:{
     required: true
     },
      telephone: {
        isPhoneNumber: true,
        lineMobileAchoice: true
    },
    landline_tel_first: {
      inputRegValiZone: '^[0-9]{3}[0-9]?$'
    },
    landline_tel_next: {
      isLineNumber: true,
      lineMobileAchoice: true
    },
    landline_tel_last: {
      number: true,
      minlength: 1,
      maxlength: 4
    },
      address: "required",
       email: {
       required:true,
       email:true
       }
    },
      messages: {
      jobs_name: {
      required: "请输入职位名称",
      minlength: jQuery.format("职位名称不能小于{0}个字符"),
    maxlength: jQuery.format("职位名称不能大于{0}个字符")
     },
     amount: {
      required: "请输入招聘人数",
      range: jQuery.format("请输入一个介于 {0} 和 {1} 之间的值")
     },
      category: {
      required: jQuery.format("请选择职位类别，精确选择职位类别可以有效提高招聘效果")
     },
      district: {
      required: jQuery.format("请选择工作地区")
     },
     wage: {
      required: jQuery.format("请选择月薪范围")
     },
     education: {
      required: jQuery.format("请选择学历要求")
     },
      experience: {
      required: jQuery.format("请选择工作经验")
     },
     contents: {
      required: jQuery.format("请填写职位描述"),
    minlength: jQuery.format("职位描述内容不能小于{0}个字符"),
    maxlength: jQuery.format("职位描述内容不能大于{0}个字符")
     },
     contact: {
      required: jQuery.format("请填写联系人")
     },
      telephone: {
        isPhoneNumber: jQuery.format("请正确填写联系电话"),
        lineMobileAchoice: jQuery.format("固定电话和手机号码请至少填写一项")
     },
     landline_tel_first: {
        inputRegValiZone: jQuery.format("请填写正确的区号")
      },
      landline_tel_next: {
        isLineNumber: jQuery.format("请输入6-11位的数字"),
        lineMobileAchoice: jQuery.format("固定电话和手机号码至少填写一项")
      },
      landline_tel_last: {
        number: jQuery.format("分机号码为数字"),
        minlength: jQuery.format("分机号码不能小于{0}个字符"),
        maxlength: jQuery.format("分机号码不能大于{0}个字符")
      },
     address: {
      required: jQuery.format("请填写联系地址")
     },
     email: {
      required: jQuery.format("请填写电子邮箱"),
    email: jQuery.format("请正确填写电子邮箱")
     } 
    },
    errorPlacement: function(error, element) {
      if ( element.is(":radio") )
          error.appendTo( element.parent().next().next() );
      else if ( element.is(":checkbox") )
          error.appendTo ( element.next());
      else
          error.appendTo(element.parent());
    }
      });
  });
</script>
</body>
</html>