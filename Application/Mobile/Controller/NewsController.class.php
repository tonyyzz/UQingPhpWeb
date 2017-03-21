<?php
namespace Mobile\Controller;
use Mobile\Controller\MobileController;

class NewsController extends MobileController
{
    // 初始化函数
    public function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        $this->display();
    }

    /**
     * 资讯详情
     */
    public function show()
    {
        $access_token = \Common\qscmslib\weixin::get_access_token();
        $jssdk = new \Common\qscmslib\Jssdk(C('qscms_weixin_appid'), C('qscms_weixin_appsecret'),$access_token);
        $signPackage = $jssdk->GetSignPackage();
        $this->assign("signPackage",$signPackage);
        $this->display();
    }
}

?>