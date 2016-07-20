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
class UserBankModel extends Model {
	protected $_validate = array(
	    array('uin','require','投资人uin不存在！',0),
	    array('name','require','真实姓名不正确',1),
	    array('card','require','此卡号已经存在',0,'unique',1),
	    array('bank','require','开户行不正确',1),
	    array('type','require','卡类型不正确',1),
	);
	protected $_auto = array ( 
         array('uin','getUin',1,'callback'), 
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
		return M('user_bank as a')
		->where($where)
		->find();
	}
	/**
     * 读取列表数据
     * @return array 列表
     */
	public function loadList($where = array(), $limit = 10 ,$order = 'id desc'){
		return 	M('user_bank as a')
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
        return 	M('user_bank as a')
        		->where($where)
                ->count();
    }
}