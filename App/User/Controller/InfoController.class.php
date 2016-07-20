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
class InfoController extends PublicController {
    public function index(){
		$this->prove = M('region')->where(array('pid'=>0))->cache('region_prove',8640000)->select();
    	$this->display();
    }
	public function sendsms(){
		$end = session('smstime')+90 - time();
		if($end > 1){
			$this->error('距离上一次发送还有' .$end.'秒');
		}else{
			$phone 	= session('user.phone');
			$code 	= rand(10000,99999);
			session('smscode',$code,90);
			session('smstime',time());
			if (is_sms()) {
				$sms_message = '验证码：'.$code;
				send_sms($phone,$sms_message);
				$this->success('短信已发送至手机！');
			}else{
				$this->success($code);
			}
		
		}
	}
	public function edit(){
		if(IS_POST){
			$post 	= I('post.');
			if($post['money']){
				$this->error();
			}
			if($post['points']){
				$this->error();
			}
			$post['uin'] = session('user.uin');
			
			if(M('user')->token(true)->save($post)){
				$this->success('修改成功');
			}else{
				$this->error('修改失败');
			}
		}	
	}
	public function edit_phone(){
		if(IS_POST){
			$code 	= I('post.code');
			$phone 	= I('post.phone');
			if($code!=session('smscode')){
				$this->error('验证不正确');
			}
			if(M('user')->where(array('phone'=>$phone))->find()){
				$this->error('手机号重复不能使用');
			}
			$ok=M('user')->where(array('uin'=>session('user.uin')))->setField('phone',$phone);
			if($ok){
				user_log(session('user.uin'),'修改手号为'.$phone,3);
				$this->success('修改成功',U('User/Login/logout'));
			}
		}else{
			$this->display();
		}
		
	}
}