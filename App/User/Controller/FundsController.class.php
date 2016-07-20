<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.zhimale.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  醉忆花颜 <aminsire@qq.com>
// +----------------------------------------------------------------------
namespace User\Controller;
use Think\Controller;
class FundsController extends PublicController {

    //资金明细
    public function money_details(){
        $httpget = I('get.');

        if ($httpget['type']) {
            $where['type'] = $httpget['type'];
        }

        $where['a.uin'] = session('user.uin');

        $UserMoneyDetails = D('User/UserMoneyDetails');

        $count = $UserMoneyDetails->countList($where);
        $page = new \Think\Page($count,10);
        $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show = $page->show();
        $this->assign('page',$show);

        $limit = $Page->firstRow.','.$Page->listRows;

        $lists = $UserMoneyDetails->loadList($where,$limit,'id desc');

        $this->assign('lists',$lists);
        $this->display();
    }

    //充值记录
    public function payment_details(){
    	$httpget = I('get.');

        if ($httpget['out_trade_no']) {
        	$where['out_trade_no'] = $httpget['out_trade_no'];
        }

        if ($httpget['status']) {
            $where['status'] = $httpget['status'];
        }

        $where['a.uin'] = session('user.uin');

        $UserPay = D('User/UserPay');

        $count = $UserPay->countList($where);
        $page = new \Think\Page($count,10);
        $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show = $page->show();
        $this->assign('page',$show);

        $limit = $Page->firstRow.','.$Page->listRows;

        $lists = $UserPay->loadList($where,$limit,'id desc');


        $this->assign('list',$lists);
        $this->display();
    }

}