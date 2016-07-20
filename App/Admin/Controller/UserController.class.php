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

class UserController extends CommonController {
    public function index(){
		$key = I('get.key');	
		if($key){
			$where['phone']  	= array('like', '%'.$key.'%');
			$where['name']  	= array('like','%'.$key.'%');
			$where['address']  	= array('like','%'.$key.'%');
			$where['_logic'] 	= 'or';
			$map['_complex'] 	= $where;
		}
		$time 		= I('get.create_time');
		$money 		= I('get.money');
		$points 	= I('get.points');
		$order 		= 'uin desc';
		if($time){
			$order='create_time asc';
		}
		if($money){
			$order='money desc';
		}
		if($points){
			$order='points desc';
		}
		$M 		= M('user');		
		$count 	= $M->where($map)->count();
        $page 	= new \Think\Page($count,20);
        $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show 		= $page->show();
        $user_list 	= $M->where($map)->limit($page->firstRow.','.$page->listRows)->order($order)->select();
		
		foreach($user_list as $k=>$v){
			$uin=$v['uin'];		
			$user_list[$k]['item'] 		= D('User/Item')->countList(array('a.uin'=>$uin));//发布过的项目
			$user_list[$k]['itemLead'] 	= D('User/ItemLeadUser')->countList(array('a.uin'=>$uin,'a.status'=>1));//领投的项目
			$user_list[$k]['questions'] = D('Home/ItemQuestions')->countList(array('a.uin'=>$uin));//提过的问题			
			$user_list[$k]['interview'] = D('User/ItemInterview')->countList(array('a.uin'=>$uin));//约谈的项目			
			$user_list[$k]['investor'] 	= D('User/ItemCollect')->countList(array('a.uin'=>$uin));//收藏的项目			
		}
		$this->alluser = $count;
		$this->assign('page',$show);
        $this->assign('lists',$user_list);
		if(I('get.getuser')=='ok'){
			$this->display('ajax_user');
		}else{
			 $this->display();
		}
    }
	
	//审核列表
	public function user_attest(){
		$status= I('get.status');
		if(isset($status) and $status){
			$where['status']=$status;
		}
		$user=D('User/UserAttest');	
		$count =  $user->countList($where);	
		$Page  = new \Think\Page($count,10);				// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$limit = $Page->firstRow.','.$Page->listRows;
		$Page->setConfig('prev','上一页');
    	$Page->setConfig('next','下一页');
    	$Page->setConfig('theme','%UP_PAGE%	%DOWN_PAGE%');
		$show  = $Page->show();
		$list  = $user->loadList($where,$limit);
		
		$this->assign('page',$show);
        $this->assign('lists',$list);
        $this->display();
	}
	//修改审核状态
	public function attest_pass(){
		$id=I('post.id');
		$status=I('post.status');
		$ok=M('user_attest')->where(array('id'=>$id))->setField('status',$status);
		if($ok){
			$this->success('操作成功');
		}else{
			$this->error('操作失败');
		}
	}
	public function user_info(){
		$uin=I('get.uin');
		$M=M('user');	
		print_r($user);
	}

    
}