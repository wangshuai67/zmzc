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
class IndexController extends PublicController {
    public function index(){
		//投资统计
		$uin 			= session('user.uin');
		$j 				= date(j); 						//获取当前月份天数
		$start_time 	= strtotime(date('Y-m-01'));  	//获取本月第一天时间戳
		$count 			= array();
		for( $i=0; $i < $j ; $i++ ){
		    $count[$i]['start'] 			= $start_time+$i*86400; 				//开始时间
		    $count[$i]['end']				= $start_time+$i*86400+86399; 			//结束时间 
		    $wA[$i]['a.time']				= array(array('gt',$count[$i]['start']),array('lt',$count[$i]['end']));
		    $wA[$i]['a.uin']				= $uin;
		    $wB[$i]['a.create_time']		= array(array('gt',$count[$i]['start']),array('lt',$count[$i]['end']));
		    $wB[$i]['a.uin']				= $uin;
		    $count['data'] 				.= '"'.date('Y-m-d',$start_time+$i*86400).'",'; 			//正常时间
		    $count['collect_item']		.= D('User/ItemCollect')		->countList($wA[$i]).',';	//收藏项目
		    $count['with_item']			.= D('User/ItemWithOrder')		->countList($wB[$i]).',';	//投资
		    $count['interview']			.= D('User/ItemInterview')		->countList($wA[$i]).',';	//约谈
		    $count['inmoney']			.= D('User/UserMoneyDetails')	->sumList($wB[$i],1).',';	//进账
		    $count['outmoney']			.= D('User/UserMoneyDetails')	->sumList($wB[$i],2).',';	//出账
		}
		$this->count = $count;
		//获取余额
		$money 		 = M('user')->where(array('uin'=>session('user.uin')))->getField('money');
		$this->money = !$money ? 0 : $money;	
    	$this->display();
    }
}