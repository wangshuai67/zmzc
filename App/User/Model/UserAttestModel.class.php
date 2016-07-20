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
class UserAttestModel extends Model {
	protected $_validate = array(
	    array('uin','require','投资人uin不存在！',0), 
	    array('card_positive','require','身份证正面不存在',1),
	    array('card_negative','require','身份证反面不存在',1),	
	);
	protected $_auto = array ( 
         array('uin','getUin',1,'callback'), 
         array('time','time',1,'function'), 
     );
	//自动完成uin
	protected function getUin(){ 
		return $_SESSION['user']['uin'];
	}
	/**
     * 读取信息
     * @return array 信息
     */
	public function getInfo($where){
		return M('user_attest as a')
		->join('LEFT JOIN __USER__ b ON a.uin = b.uin')
		->field('a.*,a.status as attest_status,b.name as user_name,age,points,create_time,phone,sex,area,address')
		->where($where)
		->find();
	}
	/**
     * 读取列表数据
     * @return array 列表
     */
	public function loadList($where = array(), $limit = 10 ,$order = 'time desc'){
		return 	M('user_attest as a')
				->join('LEFT JOIN __USER__ b ON a.uin = b.uin')
				->field('a.*,a.status as attest_status,b.name as user_name,age,points,create_time,phone,sex,area,address')
				->where($where)
				->limit($limit)
				->order($order)
				->select();
	}
	/**
     * 获取数量
     * @return int 数量
     */
    public function countList($where = array()){
        return 	M('user_attest as a')
        		->where($where)
                ->count();
    }
}