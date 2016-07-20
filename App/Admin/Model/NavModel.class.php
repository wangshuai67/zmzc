<?php 
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.zhimale.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  预感 <442648313@qq.com>
// +----------------------------------------------------------------------
namespace Admin\Model;
use Think\Model;
class NavModel extends Model {
	protected $_auto = array ( 
         array('time','time',1,'function'), 
     );
	/**
     * 读取信息
     * @return array 信息
     */
	public function getInfo($where){
		return M('nav')
		->where($where)
		->find();
	}
	/**
     * 读取列表数据
     * @return array 列表
     */
	public function loadList($where = array(), $limit = 10 ,$order = 'time desc'){
		return 	M('nav')
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
        return 	M('nav')
        		->where($where)
                ->count();
    }
}