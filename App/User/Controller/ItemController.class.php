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
class ItemController extends PublicController {
	/**
     * 项目列表页面 
     */
	public function index(){
		//项目列表
		$item 		= D('User/Item');
		$progress 	= I('get.progress');
		if ($progress) {
			$where['a.progress'] = $progress;
		}
		$where['a.uin'] = session('user.uin');
		$count 			= $item->countList($where);
		$Page  			= new \Think\Page($count,10);					// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$limit 			= $Page->firstRow.','.$Page->listRows;
		$Page->setConfig('prev','上一页');
    	$Page->setConfig('next','下一页');
    	$Page->setConfig('theme','%UP_PAGE%	%DOWN_PAGE%');
		$show       = $Page->show();
		$list = $item->loadList($where,$limit);
		foreach ($list as $k => $v) {
			$list[$k]['interview']		= D('User/ItemInterview') -> countList(array('itemid'=>$v['id']));
			$list[$k]['countlead']		= D('User/ItemLeadUser')  -> countLead($v['id']);
			$list[$k]['success_rate']	= D('User/ItemWithOrder') -> successRate($v['id']); 				//完成率
			$list[$k]['count_money']	= D('User/ItemWithOrder') -> countMoney($v['id']);					//现已融资
		}
		//进度列表
		$this->progresslist = M('item_progress')->select();
		$this->page = $show;
		$this->list = $list;
		$this->display();
	}
	//项目视频
	public function item_video(){
		if(IS_POST){
			$ItemVideo 	= D('User/ItemVideo');
			$post 		= I('post.');
			$videoid 	= M('item_video')->where(array('itemid'=>$post['itemid'],'type'=>$post['type']))->getField('id');
			if($videoid){
				$ok 	= M('item_video')->where(array('id'=>$videoid))->setField('url',$post['url']);
			}else{
				if (!$ItemVideo->create()) {
					$this->error($ItemVideo->getError());
				}else{
					$ok = $ItemVideo->add();
				};
			}
			if($ok){
				$this->success('成功');
			}else{
				$this->error('失败');
			}
		}else{
			$itemid 		= I('get.itemid');
			$itemvideo 		= D('User/ItemVideo')->loadList($itemid);
			$this->itemid 	= $itemid;
			$this->video 	= $itemvideo;
			$this->display();
		}
	}
	/**
     * 项目新增方法
     */
    public function item_add(){
    	A('Attest')->card_in_check(); //验证是否补全信息
		$setup  = I('get.set');
		$itemid = I('get.itemid');
		if($itemid){
			$item=M('item')->where(array('id'=>$itemid))->find();
			if($item['uin']!=session('user.uin')){
				$this->error('你没有权限');
			}
			$this->item=$item;
			$this->tagsid=M('itemTag')->where(array('itemid'=>$itemid))->getField('tagid',true);
			$nowcate=getupcate($item['cid']);
			sort($nowcate);
			$this->nowcate=$nowcate;
		}
		$this->itemid=$itemid;
		switch($setup){
			case 2:
				$this->display('item_add_set2');
				break;
			case 3:
				$item['prove'] = M('item_prove')->where(array('itemid'=>$itemid))->select();
				$item['video'] = M('item_video')->where(array('itemid'=>$itemid))->getField('url');
				$this->item = $item;
				$this->display('item_add_set3');
				break;
			case 4:
				$this->display('item_add_set4');
				break;			
			default:
			$top=M('item_category')->where(array('pid'=>0,'status'=>1))->select();
			$this->tags=M('tags')->where(array('status'=>1))->select();  
			$this->cate=$top;
			$this->display();
		}
    }
	public function get_category(){
		$pid=I('get.pid');
		if(get_category($pid)){
			$this->success(get_category($pid));
		}
	}
	public function item_in(){
		if(IS_POST){
			$item 	= D('item');
			$post 	= I('post.');
			$tags 	= explode(',',$post['tag']);
			$post['update_time'] = time();
			$post['time'] 		 = time();
			$post['end_time']	 = strtotime($post['end_time']);
			$post['uin']		 = session('user.uin');
			$p=$post['type'] =='add' ? 1:2;
			if (!$item->create($post,$p)){ 
				$this->error($item->getError());
			}else{
				if($post['type']!='add'){
					//罗家明修改验证POST ID权限BUG;
					$uin=D('item')->where(array('id'=>$post['type']))->getField('uin');
					if($uin!=session('user.uin')){
						$this->error('你没有权限');
					}
					D('ItemTag')->where(array('itemid'=>$post['type']))->delete();
					foreach($tags as $k=>$v){
						$tagarr[]=array('tagid'=>$v,'itemid'=> $post['type']);					
					}
					$itemid=$item->where(array('id'=>$post['type']))->save();
					D('ItemTag')->addAll($tagarr);	
					$this->success('',U('Item/item_add',array('itemid'=>$post['type'],'set'=>2)));
				}else{
					$itemid=$item->add();
					foreach($tags as $k=>$v){
						$tagarr[]=array('tagid'=>$v,'itemid'=> $itemid);					
					}
					D('ItemTag')->addAll($tagarr);
					$this->success('',U('Item/item_add',array('itemid'=>$itemid,'set'=>2)));
				}
			}
		}
	}
	//第二步项目资料提交
	public function item_in_two(){
		if(!IS_POST){
			$this->error();
		}else{
			$item 	= D('item');
			$post 	= I('post.');
			$itemid = I('post.id');
			$uin=M('item')->where(array('id'=>$itemid))->getField('uin');
			if($uin!=session('user.uin')){
				$this->error('你没有权限');
			}
			if (!$item->create($post,2)){
				$this->error($item->getError());
			}else{
				$item->save();
				$this->success('',U('Item/item_add',array('itemid'=>$itemid,'set'=>3)));
			}
		}
	}
	// 第三步项目资料提交
	public function item_in_third(){
		if(!IS_POST){
			$this->error();
		}
		$item 	= D('item');
		$post 	= I('post.');
		$itemid = I('post.id');
		$uin=M('item')->where(array('id'=>$itemid))->getField('uin');
		if($uin!=session('user.uin')){
			$this->error('你没有权限');
		}
		if (!$item->create($post,2)){
			$this->error($item->getError());
		}else{
			$item->save();
			//插入视频
			if ($post['video']) {
				$video 			= M('item_progress')->find();//查找第一个进度
				$data['itemid'] = $itemid;
				$data['url'] 	= $post['video'];
				$data['type'] 	= $video['id'];
				$data['time'] 	= time();
				$r = M('item_video')->where(array('itemid'=>$itemid,'type'=>$data['type']))->find();
				if ($r) {
					M('item_video')->where(array('itemid'=>$itemid))->save($data);
				}else{
					M('item_video')->add($data);
				}
			}
			$proveattr=explode(',',$post['prove']); // 组成数组
			foreach($proveattr as $k=>$v){
				$prove[]=array('url'=>$v,'itemid'=> $itemid,'time'=>time());					
			}
			M('item_prove')->where(array('itemid'=>$itemid))->delete();
			M('item_prove')->addAll($prove);
			$this->success('',U('User/Item/index'));
		}
	}
	//项目方约谈列表
	public function interview(){
		$itemid = I('get.itemid');
		$status = I('get.status');
		if($itemid) $where['a.itemid'] = $itemid; //如果指定项目
		if($status) $where['a.status'] = $status; //如果指定状态
		$investor = D('User/ItemInterview');
		$count =  $investor->countList($where); // 统计有多少条数据
		$Page  = new \Think\Page($count,10); // 实例化分页类 传入总记录数和每页显示的记录数(20)
        $limit = $Page->firstRow.','.$Page->listRows;
    	$Page->setConfig('prev','上一页');
    	$Page->setConfig('next','下一页');
    	$Page->setConfig('theme','%UP_PAGE%	%DOWN_PAGE%');
    	$this->page = $Page->show(); // 分页显示输出
		$list = $investor->loadList($where,$limit);
		foreach ($list as $k => $v) {
			$list[$k]['interview_name'] = A('Investor')->interview_status($v['status']);
		}
		$this->list = $list;
		$this->display();
	}
	//约谈状态更改操作
	public function intervies_status(){
		if (!IS_POST) $this->ajaxReturn(array('status'=>0,'info'=>'操作失败！'));
		$postData 		= I('post.');
		$where['id'] 	= $postData['id'];
		$itemid 		= M('item_interview')->where($where)->getField('itemid');	//获取约谈的项目
		A('Login')->check_itemid($itemid);
		$ok = M('item_interview')->where($where)->setField('status',$postData['status']);
		if ($ok) {
			$this->ajaxReturn(array('status'=>1,'info'=>'操作成功！'));
		}else{
			$this->ajaxReturn(array('status'=>0,'info'=>'操作失败！'));
		}
	}
	public function sendsms(){
		$end=session('smstime')+90 - time();
		if($end > 1){
			$this->error('距离上一次发送还有' .$end.'秒');
		}else{
			$phone=session('user.phone');
			$code=rand(10000,99999);
			session('smscode',$code,90);
			session('smstime',time());
			$this->success($code);
		}
	}
	//投资项目
	public function with_item(){
		if (!IS_POST) $this->ajaxReturn(array('info'=>'操作失败!','status'=>0));
		$httppost = I('post.');
		$userinfo = M('user')->where(array('uin'=>session('user.uin')))->find();
		if (!$userinfo) $this->ajaxReturn(array('info'=>'用户验证失败!','status'=>0));
        $itemid 		= $httppost['itemid'];  //提交过来的项目ID
        $amount 		= $httppost['amount'];  //提交过来的份数
        $item_info 		= 	M('item')
					        ->where(array('id'=>$itemid))
					        ->find();
        $item_amount_info = M('item_with_order')
					        ->where(array('itemid'=>$item_info['id']))
					        ->sum('amount');
        $surplus_amount = $item_info['amount']-$item_amount_info;
        if ($surplus_amount<$amount) {
        	$this->ajaxReturn(array('info'=>'投资已经满了!','status'=>0));
        }
        $money = $item_info['lowest_money']*$amount;
    	if ($money<=0) {
        	$this->ajaxReturn(array('info'=>'不能投资0元!','status'=>0));
        }
        if ($money>$userinfo['money']) {
        	$this->ajaxReturn(array('info'=>'投资失败,金钱不足,是否充值?','url'=>U('User/Prepaid/index'),'status'=>0));
        }
        $User = M('user');
        // 启动事务
        $User->startTrans();
        $Order = M('user_money_details');
        $Item  = M('item_with_order');
        $item_with_order_info = $Item->where(array('uin'=>$userinfo['uin'],'itemid'=>$itemid))->find();

        //操作表1
        if (!$item_with_order_info) {
        	//增加投资记录
        	$add_item_with_order_data['uin'] 		= $userinfo['uin'];
        	$add_item_with_order_data['itemid'] 	= $itemid;
        	$add_item_with_order_data['amount'] 	= $amount;
        	$add_item_with_order_data['money'] 		= $money;
        	$add_item_with_order_data['status'] 	= 1;
        	$add_item_with_order_data['create_time']= time();
        	$add_item_with_order = $Item->data($add_item_with_order_data)->add();
        	$remark = '项目:'.$item_info['name'].'投资:'.$money.'元,订单ID:'.$add_item_with_order;
        }else{
        	//修改投资记录
        	$update_item_with_order_data['amount'] 			= $item_with_order_info['amount']+$amount;
        	$update_item_with_order_data['money'] 			= $item_with_order_info['money']+$money;
        	$update_item_with_order_data['update_time'] 	= time();
        	$add_item_with_order = $Item->where(array('id'=>$item_with_order_info['id']))->setField($update_item_with_order_data);
        	$remark = '项目:'.$item_info['name'].'追加投资:'.$money.'元,订单ID:'.$item_with_order_info['id'];
        } 
        //操作表2
        //用户资金减少
        $setmoney = $User->where(array('uin' => $userinfo['uin']))->setDec('money', $money);
        //操作表3
        //写入资金明细
        $money_details_data['uin'] 		= $userinfo['uin'];
        $money_details_data['title'] 	= '项目投资';
        $money_details_data['type'] 	= 2;//出账
        $money_details_data['money'] 	= $money;
        $money_details_data['balance'] 	= $userinfo['money']-$money;
        $money_details_data['user_ip'] 	= get_client_ip();
        $money_details_data['status'] 	= 1;
        $money_details_data['remark'] 	= $remark;
        $money_details_data['create_time'] = time();
        $del_money_details = $Order->data($money_details_data)->add();
        if ($add_item_with_order and $setmoney and $del_money_details){
            // 提交事务
        	$User->commit();
        	$this->ajaxReturn(array('info'=>'投资成功','status'=>1,'url'=>U('User/Investor/with_item')));
        }else{
            // 事务回滚
        	$User->rollback();
        	$this->ajaxReturn(array('info'=>'投资失败!','status'=>0));
        }
    	
    }
}