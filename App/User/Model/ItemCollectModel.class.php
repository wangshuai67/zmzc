<?php 
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.zhimale.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  预感 <442648313@qq.com>
// +----------------------------------------------------------------------
namespace User\Model;
use Think\Model;
class ItemCollectModel extends Model {
	protected $_validate = array(
	    array('uin','require','投资人uin不存在！',0), 
	    array('itemid','require','项目id不存在',1),
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
	public function getInfo($where,$order = 'time desc'){
		return M('item_collect as a')->where($where)->order($order)->find();
	}
	/**
     * 读取列表数据
     * @return array 列表
     */
	public function loadList($where = array(), $limit = 10 ,$order = 'time desc'){
		return 	M('item_collect as a')
				->join('LEFT JOIN __ITEM__ b ON a.itemid = b.id')
				->join('LEFT JOIN __ITEM_PROGRESS__ c ON b.progress = c.id')
				->join('LEFT JOIN __USER__ d ON a.uin = d.uin')
				->field('a.*,b.name as item_name,b.cover_img,b.raising_money,b.investment_rate,b.lowest_money,c.name as progress_name,d.name as user_name')
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
        return 	M('item_collect as a')
        		->join('LEFT JOIN __ITEM__ b ON a.itemid = b.id')
        		->where($where)
                ->count();
    }
}