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
class BankController extends PublicController { 
	Public function bankInfo($card){ 
	if(!$card) $card = I('get.card');
	$curlUrl = "https://www.zhimale.com/Api/bank/card/".$card;
    $res = curl_get($curlUrl);
    if ($res) {
    	$this->ajaxReturn(array('status'=>1,'info'=>$res));
    }else{
    	$this->ajaxReturn(array('status'=>1,'info'=>''));
    }
	}
	//银行卡列表
	Public function index(){
		$this->bank = D('User/UserBank')->loadList(array('a.uin'=>session('user.uin')));
		$this->display();
	}
	
	//新增银行卡
	Public function bank_add(){
		$this->display();
	}
	//新增银行卡
	Public function bank_in(){
		$bankUser = D('User/UserBank');
		if (!$bankUser->create()) {
			$this->error($bankUser->getError());
		}else{
			if ($bankUser->add()){
				D('User/UserDoLog')-> addData('您的银行卡创建成功！',session('user.uin'));
				$this->success('新增成功！');
			} 
		}
	}
}