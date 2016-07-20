<?php 
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.zhimale.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  火鸡 <834758588@qq.com>
// +----------------------------------------------------------------------
namespace User\Model;
use Think\Model;
class UserPayModel extends Model {

	/*
		$where参数
		uin 	用户ID
		status 	1=成功，2=未完成
	*/
	

	//获取充值列表列表
	public function loadList($where = array(), $limit = 10 ,$order = 'id desc'){

		$data = M('user_pay as a')
		->join('__USER__ b ON a.uin=b.uin ')
		->field('a.*,b.name as user_name')
		->where($where)
		->limit($limit)
		->order($order)
		->select();

		return 	$data;
	}

	//获取充值列表数量
    public function countList($where = array()){

        return 	M('user_pay as a')->where($where)->count();
    }

    //统计资金总和
    public function sumList($where = array()){
        $sun = M('user_pay as a')->where($where)->sum('money');
        	return $sun;
    }
    
}