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
class IndexController extends CommonController {
    public function index(){
    	//投资比例 饼图数据
		$reviewed=array('status'=>0);
		$this->reviewed			=D('User/Item')			->countList($reviewed);			//未处理的项目
		$this->allin			=D('user_pay')			->where(array('status'=>1))->sum('money');			//成功充值
		$this->allout			=D('user_withdrawals')	->where(array('status'=>1))->sum('money');			//成功提现
		$this->withdrawals			=D('user_withdrawals')	->where(array('status'=>0))->count();			//未处理的提现
		
    	$sumup['collect_item'] 	= D('User/ItemCollect')		->countList();							//收藏的项目总数
		$sumup['with_item']		= D('User/ItemWithOrder')	->countList();							//投资的项目总数
		$sumup['interview'] 	= D('User/ItemInterview')	->countList();							//约谈的项目总数
		$sumup['lead'] 			= D('User/ItemLeadUser')	->countList(array('a.status'=>'1'));	//领投的项目总数
		$this->sumup 	= $sumup;
		//投资统计
		$j 				= date(j); 						//获取当前月份天数
		$start_time 	= strtotime(date('Y-m-01'));  	//获取本月第一天时间戳
		$count 			= array();
		for($i=0;$i<$j;$i++){
		    $count[$i]['start'] 			= $start_time+$i*86400; 				//开始时间
		    $count[$i]['end']				= $start_time+$i*86400+86399; 			//结束时间 
		    $wA[$i]['a.time']				= array(array('gt',$count[$i]['start']),array('lt',$count[$i]['end']));
		    $wB[$i]['a.create_time']		= array(array('gt',$count[$i]['start']),array('lt',$count[$i]['end']));
		    $count['data'] 				.= '"'.date('Y-m-d',$start_time+$i*86400).'",'; 	//正常时间
		    $count['collect_item']		.= D('User/ItemCollect')		->countList($wA[$i]).',';	//收藏项目
		    $count['with_item']			.= D('User/ItemWithOrder')		->countList($wB[$i]).',';	//投资
		    $count['interview']			.= D('User/ItemInterview')		->countList($wA[$i]).',';	//约谈
		    $count['inmoney']			.= D('User/UserMoneyDetails')	->sumList($wB[$i],1).',';	//进账
		    $count['outmoney']			.= D('User/UserMoneyDetails')	->sumList($wB[$i],2).',';	//出账
		    $count['user']				.= D('User/User')				->countList($wB[$i]).',';	//用户
		}
		$this->count = $count;
    	$this->display();
    }
}