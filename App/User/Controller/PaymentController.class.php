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
class PaymentController extends Controller {

    /**
     * 支付结果返回
     */
    public function notify() {
        $apitype = I('get.apitype');

        $pay = new \Think\Pay($apitype, C('payment.' . $apitype));
        if (IS_POST && !empty($_POST)) {
            $notify = $_POST;
        } elseif (IS_GET && !empty($_GET)) {
            $notify = $_GET;
            unset($notify['method']);
            unset($notify['apitype']);
        } else {
            exit('Access Denied');
        }
        //验证
        if ($pay->verifyNotify($notify)) {
            //获取订单信息
            $info = $pay->getInfo();

            if ($info['status']) {
                $payinfo = M("Pay")->field(true)->where(array('out_trade_no' => $info['out_trade_no']))->find();
                if ($payinfo['status'] == 0 && $payinfo['callback']) {
                    session("pay_verify", true);
                    $check = R($payinfo['callback'], array('money' => $payinfo['money'], 'param' => unserialize($payinfo['param'])));
                    if ($check !== false) {
                        M("Pay")->where(array('out_trade_no' => $info['out_trade_no']))->setField(array('update_time' => time(), 'status' => 1));
                    }
                }
                if (I('get.method') == "return") {
                    redirect($payinfo['url']);
                } else {
                    $pay->notifySuccess();
                }
            } else {
                $this->error("支付失败！");
            }
        } else {
            E("Access Denied");
        }
    }

    /**
     * 订单支付成功
     * @param type $money
     * @param type $param
     */
    public function pay($money, $param) {
        if (session("pay_verify") == true) {
            session("pay_verify", null);
            //处理业务订单、改订单状态
            $User = M('user');
            // 启动事务
            $User->startTrans();
            $User_Pay = M('user_pay');
            $User_Money_Details = M('user_money_details');
            //查询用户信息
            $userinfo = $User->where(array('uin' => $param['uin']))->find();
            //修改订单状态
            $set_pay_stytus = $User_Pay->where(array('id' => $param['order_id']))->setField(array('status'=>1,'update_time'=>time()));
            //增加用户资金
            $set_money = $User->where(array('uin' => $param['uin']))->setInc('money', $money);
            //写入资金明细
            $money_details_data['uin']      = $userinfo['uin'];
            $money_details_data['title']    = '资金充值';
            $money_details_data['type']     = 1;//进账
            $money_details_data['money']    = $money;
            $money_details_data['balance']  = $userinfo['money']+$money;
            $money_details_data['user_ip']  = get_client_ip();
            $money_details_data['status']   = 1;
            $money_details_data['remark']   = '在线充值:'.$money.'元,订单ID:'.$param['order_id'];
            $money_details_data['create_time'] = time();
            $add_money_details = $User_Money_Details->data($money_details_data)->add();
            if ($set_pay_stytus and $set_money and $add_money_details){
                // 成功,提交事务
                $User->commit();
                echo 'success';
            }else{
                // 失败,事务回滚
                $User->rollback();
            }
        } else {
            E("Access Denied");
        }
    }
}