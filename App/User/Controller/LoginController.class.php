<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.zhimale.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  预感 <442648313@qq.com>
// +----------------------------------------------------------------------
namespace User\Controller;
use Think\Controller;
class LoginController extends Controller {
	//登录页面
    public function index(){
    	$bakurl = I('get.bakurl');
    	if($bakurl)	session('bakurl',$bakurl);
    	if(IS_POST){
			if(!check_verify(I('post.verify'))){
				$this->error('验证码错误');
			}
			$post=I('post.');
			$reged=M('user')->where(array('phone'=>$post['phone']))->find();
			if(!$reged){
				$this->error('用户未注册');
			}
			$post['pwd']=MD5($post['pwd']);
			$uin=M('user')->where(array('phone'=>$post['phone'],'pwd'=>$post['pwd']))->getField('uin');
			if($uin){
				if ($uin['status']==0) {
					$this->error('账户被冻结,请联系管理员');
				}
				session('user.uin',$uin,86400);
				session('user.phone',$post['phone'],86400);
				$log['ip'] 		= get_client_ip();
				$log['time'] 	= time();
				$log['uin'] 	= $uin;
				$log['key'] 	= MD5($post['phone'].time());
				session('user.key',$log['key'],86400);
				M('user_login_log')->token(true)->add($log);			
				if (session('bakurl')) $this->success('登录成功',base64_decode(session('bakurl')));	//如果有返回url
				else $this->success('登录成功',U('User/Index/index'));		//默认到会员首页
			}else{				
				$this->error('登录失败,请联系管理员');
			}
		}else{
			if(session('user.uin')){
				header('location: '.U('/User'));
			}
			$this->display();
		}
    }
    // 注册
	public function reg(){
		if(IS_POST){
			$post=I('post.');
			$reged=M('user')->where(array('phone'=>$post['phone']))->find();
			if($reged){
				$this->error('用户已被注册');
			}
			if($post['verify']!=session('smscode')){
				$this->error('手机验证码不正确');
			}
			$post['pwd'] 			= MD5($post['pwd']);
			$post['create_time'] 	= time();
			$uin=M('user')->token(true)->add($post);
			if($uin){
				session('user.uin',$uin,86400);
				session('user.key',MD5($post['phone'].time()),86400);
				$this->success('注册成功',U('User/Index/index'));
			}else{
				$this->error('注册失败,请联系管理员');
			}
		}else{
			$this->display();
		}
	}
	// 发送验证码
	public function sendsms(){
		$phone=I('post.phone');
		$reged=M('user')->where(array('phone'=>$phone))->find();
			if($reged){
				$this->error('用户已被注册');
			}
		$code=rand(10000,99999);
		session('smscode',$code,600);
		if (is_sms()) {
			$sms_message = '用户注册验证码：'.$code;
			send_sms($phone,$sms_message);
			$this->success('短信已发送至手机！');
		}else{
			$this->success($code);
		}
		
	}
	//找回密码送信发送
	public function forgotpwd_sendsms(){
		$phone=I('post.phone');
		$reged=M('user')->where(array('phone'=>$phone))->find();
			if(!$reged){
				$this->error('用户未注册');
			}
		$code=rand(10000,99999);
		session('smscode',$code,600);
		if (is_sms()) {
			$sms_message = '验证码：'.$code;
			send_sms($phone,$sms_message);
			$this->success('短信已发送至手机！');
		}else{
			$this->success($code);
		}
	}
	//找回密码
	public function forgotpwd(){
		if(IS_POST){
			$post=I('post.');
			$reged=M('user')->where(array('phone'=>$post['phone']))->find();
			if(!$reged){
				$this->error('用户未注册');
			}
			if($post['verify']!=session('smscode')){
				$this->error('手机验证码不正确');
			}
			$post['pwd'] 			= MD5($post['pwd']);		
			$uin=M('user')->where(array('uin'=>$reged['uin']))->setField('pwd',$post['pwd']);
			if($uin){
				session('user.uin',$reged['uin'],86400);
				session('user.key',MD5($post['phone'].time()),86400);
				$this->success('密码重置成功',U('User/Index/index'));
			}else{
				$this->error('失败,请联系管理员');
			}
		}else{
			$this->display();
		}
	}
	
	
	//退出登录状态
	public function logout(){
		session('user',null);
		header('location: '.U('/Home/Index/index'));
	}
	//验证是否登录
	public function check_login(){
		$bakurl = I('get.bakurl');
		if($bakurl) session('bakurl',$bakurl);	//如果有bakurl 存session
		if (!$_SESSION['user']['uin']) $this->error('请登录！',U('User/Login/index'));
		else   	$this->success('用户已登录！') ;
	}
	//验证项目是否可以操作
	public function check_itemid($itemid){
		if(!$itemid) $itemid = I('get.itemid');
		$uin = M('item')->where(array('id'=>$itemid))->getField('uin');	
		if ($uin != $_SESSION['user']['uin']) {
			$this->error('您没有操作权限！') ;
		}
	}
}