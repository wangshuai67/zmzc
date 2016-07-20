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
class WithdrawController extends PublicController {
    public function index(){
		$this->money=M('user')->where(array('uin'=>session('user.uin')))->getField('money');
		$this->bank = D('User/UserBank')->loadList(array('a.uin'=>session('user.uin')));
    	$this->display();
    }
	//资金提现
    public function withdrawals(){
        if (IS_POST) {
            $HttpPost = I('post.');
            if (!$HttpPost['bank_id'] or !$HttpPost['money'] or !$HttpPost['code']) {
                $this->error('请将信息填写完整!');
            }
            if ($HttpPost['code']!=session('smscode')) {
            	$this->error('验证码错误!');
            }
            $userinfo = M('user')->where(array('uin'=>session('user.uin')))->find();
            if (!$userinfo) {
            	$this->error('用户不存在!');
            }
            if ($HttpPost['money']<100) {
                $this->error('提现金额为100.00元起步!');
            }
            if ($HttpPost['money']>$userinfo['money']) {
                $this->error('您的帐户没有这么多资金!');
            }
            $user_bank_info = M('user_bank')->where(array('id'=>$HttpPost['bank_id'],'uin'=>session('user.uin')))->find();
            if (!$user_bank_info) {
            	$this->error('银行卡信息不存在!');
            }
            //进账资金
            $type1money = M('user_money_details')->where(array('uin'=>$userinfo['uin'],'type'=>1))->sum('money');
            //出账资金
            $type2money = M('user_money_details')->where(array('uin'=>$userinfo['uin'],'type'=>2))->sum('money');
            if ($type1money != ($userinfo['money']+$type2money)) {
                \Think\Log::record('用户ID:'.$userinfo['uin'].'资金不正常'.(($userinfo['money']+$type2money)-$type1money).'，IP:'.get_client_ip().',请赶快处理!','WARN');
                $this->success('申请提现成功，请注意查收资金^_^！',U('User/Info/index'));
            }
            $User           = M('user');
            // 启动事务
            $User->startTrans();
            $Details        = M('user_money_details');
            $Withdrawals    = M('user_withdrawals');
            //操作1,扣钱
            $setmoney = $User->where(array('uin'=>$userinfo['uin']))->setDec('money',$HttpPost['money']); // 用户的资金扣除
            //操作2,进资金明细
            $money_details_data['uin']          = $userinfo['uin'];
            $money_details_data['title']        = '资金提现';
            $money_details_data['type']         = 2;//出账
            $money_details_data['money']        = $HttpPost['money'];
            $money_details_data['balance']      = $userinfo['money']-$HttpPost['money'];
            $money_details_data['user_ip']      = get_client_ip();
            $money_details_data['status']       = 0;
            $money_details_data['remark']       = $money_details_data['title'].'_'.$money_details_data['money'].'元';
            $money_details_data['create_time']  = time();
            $add_details                        = $Details->data($money_details_data)->add();
            //操作3,进提现列表
            $withdrawals_data['uin']                = $userinfo['uin'];
            $withdrawals_data['money_details_id']   = $add_details;
            $withdrawals_data['bank_id']            = $user_bank_info['id'];
            $withdrawals_data['bank_name']          = $user_bank_info['type'];
            $withdrawals_data['bank_area']          = $user_bank_info['bank'];
            $withdrawals_data['name']               = $user_bank_info['name'];
            $withdrawals_data['card']               = $user_bank_info['card'];
            $withdrawals_data['money']              = $HttpPost['money'];
            $withdrawals_data['feemoney']           = $HttpPost['money'];
            $withdrawals_data['fee']                = 0;
            $withdrawals_data['status']             = 0;
            $withdrawals_data['create_time']        = time();
            $add_withdrawals = $Withdrawals->data($withdrawals_data)->add();
            if ($setmoney and $add_details and $add_withdrawals){
                // 提交事务
                $User->commit();
                if (is_sms()) {
                    send_sms($userinfo['phone'],'您申请的'.$HttpPost['money'].'元提现已提交成功!');
                }
                $this->success('申请提现成功，请注意查收资金！',U('User/Funds/money_details'));
            }else{
                // 事务回滚
                $User->rollback();
                $this->error('申请提现失败，请联系客服！');
            }
        }
    }
	public function sendsms(){
		$end  = session('smstime')+90 - time();
		if($end > 1){
			$this->error('距离上一次发送还有' .$end.'秒');
		}else{
			$phone       = session('user.phone');
			$code        = rand(10000,99999);
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
}