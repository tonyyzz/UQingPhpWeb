<?php
namespace Mobile\Controller;
use Mobile\Controller\MobileController;
class jobsController extends MobileController
{
    // 初始化函数
    public function _initialize()
    {
        parent::_initialize();
        if(I('get.code','','trim')){
            $reg = $this->get_weixin_openid(I('get.code','','trim'));
            $reg && $this->redirect('members/apilogin_binding');
        }
    }
    public function index()
    {
        $this->assign('search_type','jobs');
        $this->display();
    }

    /**
     * 公司详情
     */
    public function comshow()
    {
        $this->display();
    }

    /**
     * 职位详情
     */
    public function show()
    {
        $this->display();
    }
    
    /**
     * ajax
     */
    public function ajaxshow()
    {
        //获取前台值
        $name = I('post.name', '', 'string');//姓名
        $sex = I('post.sex', '', 'string');//性别
        $age = I('post.age', '', 'string');//出生日期
        $address = I('post.address', '', 'string');//期待工作地
        $education = I('post.education', '', 'string');//学历
        $year = I('post.year', '', 'string');//工作年限
        $phone = I('post.phone', '', 'string');//手机
        $code = I('post.code', '', 'string');//验证码--//验证验证码是否正确
        $jobid = I('post.jobid', '', 'string');//简历id
        $pclogin = I('post.pclogin', '', 'string');//判断客户端
        
        $member_type = '2';
        
        if (empty($name)||empty($sex)||empty($age)||empty($address)||empty($education)||empty($year)||empty($phone)||empty($code)||empty($jobid))
        {
            exit('1');
        }
        elseif (strlen($name) < 2 || strlen($name) > 26)
        {
            exit('3');
        }
        
        if ($sex == '男') {
            $sex = 1;
        } else {
            $sex = 2;
        }
        
        if (empty($code) || empty($_SESSION['mobile_rand']) || $code<>$_SESSION['mobile_rand'])
        {
            exit('4');
        }
        if(session('verify_mobile') && (time()-session('verify_mobile')) > 180) {
            exit('5');//验证码过期！
        }
        
        $data = array(
            'jobid' => $jobid,
            'name' => $name,
            'sex' => $sex,
            'age' => $age,
            'address' => $address,
            'education' => $education,
            'year' => $year,
            'phone' => $phone,
            'view' => 0,
            'addtime' => time(),
            'state' => 1
        );

        //判断用户手机号是否注册
        $user = M('members')->where(array('mobile' => $phone))->find();
        if ($user) {
            $data['userid'] = $user['uid'];
        } else {
            //手机号注册
            $rel['mobile'] = $phone;
            $rel['password'] = C('qscms_reg_weixin_password');
            $rel['username'] = $phone;
            $rel['mobile_audit'] = 1;
            $rel['reg_type'] = 2;
            $rel['utype'] = 2;

            $passport = $this->_user_server();
            $passport->register($rel);
            $usera = M('members')->where(array('mobile' => $phone))->find();
            $data['userid'] = $usera['uid'];
        }
        
        $insert_id = M('applyinfo')->add($data);
        
        if ($insert_id)
        {
            $this->visitor->login($data['userid']);
            $expire = I('post.expire',0,'intval');
            $uid = $data['userid'];
            if($uid){
                $this->visitor->login($uid, $expire);
                if(!$login_url = cookie('return_url')){
                    $urls = array('1'=>'company/index','2'=>'personal/index');
                    $login_url = U($urls[$this->visitor->info['utype']]);
                }else{
                    cookie('return_url',null);
                }
                if ($pclogin == 1) {
                    exit("6");
                } else {
                    exit("6");
                }
            } 
        }
        else
        {
            exit('2');
        }
    }
    
    /**
     * 发送短信验证码
     */
    public function ajax_send_code()
    {
        header("Content-Type: text/html;charset=utf-8");
        
        $phone = I('post.phone', '15107194535', 'string');//手机
        
        //手机正则验证
        $telRe = '/^1[34578]\d{9}$/';
        if (empty($phone) || !preg_match($telRe, $phone)) {
            exit('1');//手机号为空或格式错误
        }
        
        require_once('SmsHelper/SmsApi.php');
        $clapi  = new \SmsApi();
        
        $chars = str_repeat('0123456789', 6);
        $chars = str_shuffle($chars);
        $str   = substr($chars, 0, 6);
        
        if(session('verify_mobile') && (time()-session('verify_mobile')) < 60) {
            exit('2');//请60秒后再进行验证！
        }
        
        session('mobile_rand', $str);
        session('verify_mobile', time());
        
        $content = '找工作就是精准！您的验证码是'.$str.',有效时间3分钟，如非本人操作请忽略';
        
        $result = $clapi->sendSMS($phone, $content);
        $result = $clapi->execResult($result);
        exit('0');
    }
    
    /**
     * 中转页
     */
    public function applylogin()
    {
        header("Content-Type: text/html;charset=utf-8");
        
        $this->display('apply');
    }
    
    /**
     * 创建数据表
     */
    /* public function test()
    {
        $res = M('applyinfo')->select();
        print_r($res);exit;
    } */
    /* public function test() {
        header("Content-Type: text/html;charset=utf-8");
        $link = mysql_connect("127.0.0.1","wuqinger","wuqinger0370");
        mysql_select_db("wuqinger");
        $sql = "
            CREATE TABLE `uqinger_applyinfo` (
              `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键id',
              `jobid` int(10) NOT NULL COMMENT '简历id',
              `userid` int(10) NOT NULL COMMENT '用户id',
              `name` varchar(10) NOT NULL COMMENT '姓名',
              `sex` tinyint(1) NOT NULL COMMENT '性别：0保密，1男，2女',
              `age` varchar(10) NOT NULL COMMENT '出生日期',
              `address` varchar(255) NOT NULL COMMENT '期待工作地',
              `education` varchar(20) NOT NULL COMMENT '学历',
              `year` varchar(20) NOT NULL COMMENT '工作年限',
              `phone` char(11) NOT NULL COMMENT '手机号',
              `view` tinyint(1) NOT NULL DEFAULT '0' COMMENT '后台是否查看:0否，1是',
              `addtime` int(10) NOT NULL COMMENT '申请时间',
              `state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '伪删除，1正常2删除',
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='申请面试表';
            ";
        if(mysql_query($sql))
        {
            echo "创建成功了!";
        } else {
            echo "创建数据库出错，错误号：".mysql_errno()." 错误原因：".mysql_error();
        }
    } */
}

?>