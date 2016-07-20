<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.zhimale.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  火鸡 <442648313@qq.com>
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Think\Controller;
class LeadController extends CommonController {
	//领投首页
	public function index(){
		$leadUser 		= D("User/ItemLeadUser"); //实例化领投申请表
		$itemid 		= I('get.itemid');
		$status 		= I('get.status');
		if($status) $where['a.status'] = $status; //如果没有指定状态 默认为待审核
		if ($itemid) {
			$where['a.itemid'] = $itemid;
		}else{
			$myItem = M('item')->getField('id',true); //查询出该用户所有的项目id
			if ($myItem) $where['a.itemid'] = array('in',$myItem); //如果有项目where条件才成立 防止in查询sql报错
		}
		$count =  $leadUser->countList($where);//统计多少条数据
		$Page  = new \Think\Page($count,10); // 实例化分页类 传入总记录数和每页显示的记录数(20)
        $limit = $Page->firstRow.','.$Page->listRows;
    	$Page->setConfig('prev','上一页');
    	$Page->setConfig('next','下一页');
    	$Page->setConfig('theme','%UP_PAGE%	%DOWN_PAGE%');
    	$this->page 	= $Page->show(); // 分页显示输出
		$leadUserList 	= $leadUser->loadList($where,$limit);//获取申请领投人列表
		foreach ($leadUserList as $key => $value) {
			$leadUserList[$key]['count'] 		=  $leadUser->countLead($value['itemid']); //统计现有多少领投人
			$leadUserList[$key]['countmoney'] 	=  D('User/ItemWithOrder')->countMoney($value['itemid'],$value['uin']); //统计申请人已经认投多少钱
		}
		$this->lead 	= $leadUserList;
		$this->itemlist = D('User/Item')->loadList(array('a.uin'=>$_SESSION['user']['uin']));
		$this->display();
	}
	//领投规则读取
	public function lead_list(){
		$lead 				= D("User/ItemLead");
		$itemid 			= I('get.itemid');
		$where['a.itemid'] 	= $itemid;
		//验证此项目是否有权限
		
			if ($lead->getInfo($where)) {
				$info = $lead->getInfo($where);
			}else{
				$info = array('manage_money'=>'','num'=>'','do_what'=>'');
			}
			$this->ajaxReturn(array('status'=>1,'info'=>$info));
		
	}
	//领投规则提交
	public function sub_lead(){
		if (!IS_POST) $this->ajaxReturn(array('status'=>0,'info'=>'操作失败！'));
		$ietmLead 	= I('post.');
		$lead 		= D("User/ItemLead");
		if (!$lead->create()) {
    		$this->ajaxReturn(array('status'=>0,'info'=>$lead->getError()));
    	}else{
    		$where['itemid']=$ietmLead['itemid'];
    		//如果找到数据 修改 否则新增
    		if ($lead->getInfo($where)) {
    			$lead->where($where)->save($ietmLead);
    		}else{
    			$lead->add();
    		}
    		$this->ajaxReturn(array('status'=>1,info=>'规则设置成功'));
    	}
	}
	//确定、审核领投人
	public function lead_user_define(){
		if (!IS_POST) $this->ajaxReturn(array('status'=>0,'info'=>'操作失败！'));
		$ietmLead 	= I('post.');
		$uin 		= M('item')->where(array('id'=>$ietmLead['itemid']))->getField('uin');		//查找项目uin
		$ok 		= M('item_lead_user')->where(array('id'=>$ietmLead['id']))->setField('status',1);//审核操作
		if ($ok) {
			$this->ajaxReturn(array('status'=>1,'info'=>'审核完成！'));
		}else{
			$this->ajaxReturn(array('status'=>0,'info'=>'审核失败！'));
		}
	}
}