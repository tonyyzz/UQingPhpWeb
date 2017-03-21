<?php
namespace Mobile\Controller;
use Common\Controller\ConfigbaseController;
class AdminController extends ConfigbaseController{
	public function _initialize() {
        parent::_initialize();
    }
    public function edit(){
        if(IS_POST){
            if($_POST['wap_domain']){
                if(false === strpos(strtolower($_POST['wap_domain']),'http://')){
                    $_POST['wap_domain'] = 'http://'.$_POST['wap_domain'];
                }
                if($_POST['wap_domain'] == C('qscms_site_domain')){
                    $this->error('触屏版域名不能与主域名重复！');
                }
                $domain = str_replace('http://','',$_POST['wap_domain']);
                if(C('apply.Subsite')){
                    $subsites = D('Subsite')->get_subsite_cache();
                    if($subsites[$domain]){
                        $this->error('触屏版域名不能与('.$subsites[$domain]['s_sitename'].')域名重复！');
                    }
                    $subsite_config = D('SubsiteConfig')->get_subsite_config();
                    if($subsite_config[$domain]){
                        $this->error('触屏版域名不能与分站详情页域名重复！');
                    }
                }
            }
            foreach (I('post.') as $key => $val) {
                $val = is_array($val) ? serialize(htmlspecialchars_decode($val,ENT_QUOTES)) : htmlspecialchars_decode($val,ENT_QUOTES);
                D('Config')->where(array('name' => $key))->save(array('value' => $val));
            }
            if($_POST['wap_domain']){
                $domain = D('Config')->sub_domain();
                $this->update_config(array('APP_SUB_DOMAIN_RULES'=>$domain),CONF_PATH.'sub_domain.php');
            }
        }
        $this->_edit();
        $this->display();
    }
}
?>