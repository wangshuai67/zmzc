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
class UserMoneyDetailsModel extends Model {
	protected $_validate = array(
	    array('uin','require','uin不存在！',0), 
	    array('money','require','金额不能为空',1),
	    array('balance','require','余额不能为空',1),	
	    array('user_ip','require','IP不能为空',0),	
	    array('status','require','状态不能为空',0),	
	    array('remark','require','备注不能为空',0),	
	    array('type','require','资金类型不能为空',0),	
	);
	protected $_auto = array (        
         array('update_time','time',1,'function'), 
         array('create_time','time',1,'function'), 
     );
	
	/**
     * 读取信息
     * @return array 信息
     */
	public function getInfo($where){
		return M('user_money_details as a')
		->join('LEFT JOIN __USER__ b ON a.uin = b.uin')
		->field('a.*,a.status as details_status,b.name as user_name,age,points,create_time,phone,sex,area,address')
		->where($where)
		->find();
	}
	/**
     * 读取列表数据
     * @return array 列表
     */
	public function loadList($where = array(), $limit = 10 ,$order = 'a.create_time desc'){
		return 	M('user_money_details as a')
				->join('LEFT JOIN __USER__ b ON a.uin = b.uin')
				->field('a.*,a.status as details_status,b.name as user_name,b.age,b.points,b.create_time,b.phone,b.sex,b.area,b.address')
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
        return 	M('user_money_details as a')
        		->where($where)
                ->count();
    }
    /**
     * 获取总金额
     * @return int 数量
     */
    public function sumList($where = array(),$type){
    	if($type) $where['type'] = $type;
    	$sum =  M('user_money_details as a')
        		->where($where)
                ->sum('money');
        if (!$sum) return 	'0';
        return 	$sum;
    }
}