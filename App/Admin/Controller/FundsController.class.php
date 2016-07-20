<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.zhimale.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  醉忆花颜 <aminsire@qq.com>
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Think\Controller;
class FundsController extends CommonController {

    //资金明细
    public function money_details(){
        $httpget = I('get.');

        if ($httpget['type']) {
            $where['a.type'] = $httpget['type'];
        }
		if ($httpget['uin']) {            
			$where['a.uin']  =  $httpget['uin'];
        }
       

        $UserMoneyDetails = D('User/UserMoneyDetails');

        $count      = $UserMoneyDetails->countList($where);
        $page       = new \Think\Page($count,20);
        $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show       = $page->show();
        $this->assign('page',$show);

        $limit = $Page->firstRow.','.$Page->listRows;

        $lists = $UserMoneyDetails->loadList($where,$limit,'id desc');
		//print_r( $lists);
        $this->assign('lists',$lists);
        $this->display();
    }

    //充值记录
    public function payment_details(){
    	$httpget = I('get.');

        if ($httpget['out_trade_no']) {
        	$where['a.out_trade_no'] = $httpget['out_trade_no'];
        }

        if (isset($httpget['status'])) {
            $where['a.status'] = $httpget['status'];
        }

        if ($httpget['uin']) {
            $where['a.uin'] = $httpget['uin'];
        }
    	$UserPay    = D('User/UserPay');
        $count      = $UserPay->countList($where);
        $page       = new \Think\Page($count,20);
        $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show       = $page->show();
        $this->assign('page',$show);
        $limit      = $Page->firstRow.','.$Page->listRows;
        $lists      = $UserPay->loadList($where,$limit,'id desc');
        $this->assign('list',$lists);

        $this->display();
    }

    //提现管理
    public function withdrawals() {
        if (IS_POST) {
            $HttpPost = I('post.');

            $withdrawals_info = M('user_withdrawals')->where(array('id'=>$HttpPost['id']))->find();

            if ($withdrawals_info['status']==1) {
                $this->error('该提现已处理过!');
            }

            $User = M('user_withdrawals');
            // 启动事务
            $User->startTrans();
            $Details = M('user_money_details');

            //修改提现表
            $set_withdrawals = $User->where(array('id'=>$HttpPost['id']))->setField(array('order_id'=>$HttpPost['order_id'],'status'=>1,'update_time'=>time()));

            //修改资金明细表
            $set_details = $Details->where(array('id'=>$withdrawals_info['money_details_id']))->setField(array('status'=>1,'update_time'=>time()));

            if ($set_withdrawals and $set_details) {
                // 提交事务
                $User->commit();

                $userinfo = M('user')->where(array('uin'=>$withdrawals_info['uin']))->find();
                //发送短信通知
                if (is_sms()) {
                    $sms_message = '您的申请的'.$withdrawals_info['money'].'元提现，已处理成功!';
                    send_sms($userinfo['phone'],$sms_message);
                }
                $this->success('提现处理成功!',U('Admin/Funds/withdrawals'));
            }else{
                // 事务回滚
                $User->rollback();
                $this->success('处理失败!');
            }
        }else{
            $httpget = I('get.');

            if (isset($httpget['status'])) {
                $where['status'] = $httpget['status'];
            }

            if ($httpget['uin']) {
                $where['uin'] = $httpget['uin'];
            }
            $count      = M('user_withdrawals')->where($where)->count();
            $page       = new \Think\Page($count,15);
            $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
            $show       = $page->show();
            $this->assign('page',$show);
            $list       = M('user_withdrawals')->where($where)->limit($page->firstRow.','.$page->listRows)->order('id desc')->select();
            foreach ($list as $key => $value) {
                $list[$key]['money_details_info'] = M('user_money_details')->where(array('id'=>$value['money_details_id']))->find();
                $list[$key]['user_info'] = M('user')->where(array('uin'=>$value['uin']))->find();
            }
            $where['status'] = 0;
            $sumMoney = M('user_withdrawals')->where($where)->limit($page->firstRow.','.$page->listRows)->sum('money');
            $this->assign('sumMoney',$sumMoney);
            $this->assign('list',$list);
            $this->display();
        }
    }
	
	//转账操作
    public function zmlpay(){
        if (IS_POST) {
            $HttpPost = I('post.');

            $money = $HttpPost['money'];

            $User = M('user');
            // 启动事务
            $User->startTrans();
            $User_Money_Details = M('user_money_details');
            //查询用户信息
            $userinfo = $User->where(array('uin' => $HttpPost['uin']))->find();
            //增加用户资金
            $set_money = $User->where(array('uin' => $HttpPost['uin']))->setInc('money', $money);
            //写入资金明细
            $money_details_data['uin']      = $userinfo['uin'];
            $money_details_data['title']    = '在线转账';
            $money_details_data['type']     = 1;//进账
            $money_details_data['money']    = $money;
            $money_details_data['balance']  = $userinfo['money']+$money;
            $money_details_data['user_ip']  = get_client_ip();
            $money_details_data['status']   = 1;
            $money_details_data['remark']   = '在线转账:'.$money.'元,'.$HttpPost['remark'];
            $money_details_data['create_time'] = time();
            $add_money_details = $User_Money_Details->data($money_details_data)->add();

            if ($HttpPost['is_sms']==1 and is_sms()) {
                $sms_message = '您收到平台转账资金:'.$money.'元,请查收!';
                send_sms($userinfo['phone'],$sms_message);
            }

            if ($set_money and $add_money_details){
                // 成功,提交事务
                $User->commit();
                $this->success('转账成功!');
            }else{
                // 失败,事务回滚
                $User->rollback();
                $this->success('转账失败,请重试~!');
            }
        }else{
            $this->display();
        }
    }
	
}