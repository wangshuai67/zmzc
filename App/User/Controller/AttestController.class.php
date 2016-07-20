<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.zhimale.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  火鸡 <834758588@qq.com>
// +----------------------------------------------------------------------
namespace User\Controller;
use Think\Controller;
class AttestController extends PublicController {
	public function index(){
		$where['a.uin'] = session('user.uin');
		$attest = D('User/UserAttest')->getInfo($where);
		if($attest){
			switch ($attest['attest_status']) {
				case '1':
					$status = '您的身份已审核通过！';
					break;
				case '2':
					$status = '您的身份已拒绝！,请重新申请';
					break;
				default:
					$status = '您的身份待审核中！';
					break;
			}
		}else{
			$status = '您还未申请身份认证';
		}
		$this->status = $status; 	//审核状态赋值到模板
		$this->attest = $attest;	//用户审核信息赋值到模板
		$this->card_in_check(); 	//检查是否完善个人信息
		$this->display();
	}
	//验证是否未补全信息
	public function card_in_check(){
		$where['uin'] = session('user.uin');
		$userInfo = M('user')->where($where)->find();
		if (!$userInfo['name'] || !$userInfo['sex'] || !$userInfo['phone']) {
			$this->error('请先补全信息','/User/Info');
		}
	}
	//提交身份证审核信息
	public function card_in(){
		$this->card_in_check();		//检查是否完善个人信息
		$attest = D('User/UserAttest');		//实例化认证模型
		$uin =session('user.uin');		//获取uin
		$data =  I('post.');		//接收的post值
		$where['a.uin'] = $uin;		//此条件用户查找数据
		if ($attest->getInfo($where)) {		//如果已存在数据 进行修改操作
			$data['time'] = time();
			$data['status']= '0';			//修改后状态改为重新上传
			if($attest->where(array('uin'=>$uin))->save($data)) $this->success('修改成功！');
		}else{ 		//如果数据不存在进行新增操作
			if (!$attest->create()){ 
				$this->error($attest->getError());
			}else{
				if($attest->add()){
					D('User/UserDoLog')-> addData('您的身份信息已经提交！',session('user.uin'));
					$this->success('提交成功！');
				}else{
					$this->error('提交失败！');
				}
			}
		}
	}
}