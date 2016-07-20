<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.zhimale.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  火鸡 <834758588@qq.com>
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Think\Controller;

class PublicController extends Controller {

    /**
     * 后台登录
     */
    public function login() {
        $this->nav = 'login';
        if(session('admin_username')) redirect(U('Admin/Index/index'));
        if (IS_POST) {
			if(!check_verify(I('post.code'))){
				$this->error('验证码错误');
			}
            $httppost = I('post.');
            $userinfo = M('admin_user')->where(array('username'=>$httppost['username']))->find();
            if (!$userinfo) {
                $this->error('用户不存在!');
            }
            if ($httppost['username']==$userinfo['username'] and encrypt($httppost['password'])==$userinfo['password']) {
                if ($userinfo['status']==0){
                    $this->error('帐户被冻结!');
                }
                session('admin_uid',$userinfo['id']);
                session('admin_username',$userinfo['username']);
                session('admin_nickname',$userinfo['nickname']);
                session('admin_login_key',encrypt($userinfo['username'], true));//登录验证，防止两个人同时登录
                M('admin_user')->where(array('id'=>$userinfo['id']))->setField('login_key',session('admin_login_key'));
                //保存登录信息
                $data['last_login_time']  =   time();
                $data['last_login_ip']    =   get_client_ip();
                $data['login_count']      =   array('exp','(login_count+1)');
                M('admin_user')->where(array('id'=>$userinfo['id']))->save($data);
                $this->success('登录成功!',U('/Admin/Index/index'));
            }else{
                $this->error('帐号或密码错误!');
            }
        }else{
            $this->display();
        }
    }

    //退出登录
    public function logout(){
        session('admin_uid',null);
        session('admin_username',null);
        session('admin_login_key',null);
        session(null);
        redirect(U('/Admin/Public/login'));
        //$this->success('退出成功',U('/'));
    }

    //图片验证码
    public function verify_img(){
        $Verify           =     new \Think\Verify();
        $Verify->fontSize = 30;
        $Verify->length   = 4;
        $Verify->useNoise = false;
        $Verify->useImgBg = true; 
        $Verify->entry();
    }
}