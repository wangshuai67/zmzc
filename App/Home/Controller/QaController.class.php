<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.zhimale.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  火鸡 <834758588@qq.com>
// +----------------------------------------------------------------------
namespace Home\Controller;
use Think\Controller;
class QaController extends Controller {
    public function index(){
    	$this->display();
		//session('user',null);
    }
    //问题提交
    public function questions_in(){
    	$data          = I('post.');
    	$ItemQuestions = D("ItemQuestions");
    	if (!$ItemQuestions->create()) {
    		$this->ajaxReturn(array('status'=>2,'info'=>$ItemQuestions->getError()));
    	}else{
    		$id = $ItemQuestions->add();
            D('User/UserDoLog')-> addData('您的问题已经提交！',session('user.uin'));
    		$info = $ItemQuestions->getInfo(array('id'=>$id));
    		$info['u_name'] = user($info['uin'],'name');
    		$info['header'] = user($info['uin'],'header');
    		$this->ajaxReturn(array('status'=>1,'info'=>$info));
    	}
    }
}