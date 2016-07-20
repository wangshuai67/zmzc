<?php 
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.zhimale.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  醉忆花颜 <aminsire@qq.com>
// +----------------------------------------------------------------------
namespace User\Model;
use Think\Model;
class ItemWithOrderModel extends Model {
	/**
     * 读取信息
     * @return array 信息
     */
	public function getInfo($where){
		return M('item_with_order as a')
				->join('LEFT JOIN __ITEM__ b ON a.itemid = b.id')
				->join('LEFT JOIN __USER__ c ON a.uin = c.uin')
				->field('a.*,b.name as item_name,c.name as user_name')
				->where($where)
				->find();
	}
	/**
     * 读取列表数据
     * @return array 列表
     */
	public function loadList($where = array(), $limit = 10 ,$order = 'create_time desc'){
		return 	M('item_with_order as a')
				->join('LEFT JOIN __ITEM__ b ON a.itemid = b.id')
				->join('LEFT JOIN __USER__ c ON a.uin = c.uin')
				->field('a.*,b.name as item_name,c.name as user_name')
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
        return 	M('item_with_order as a')
        		->where($where)
                ->count();
    }
    /**
     * 统计用户在项目共投入多少资金
     * @return int 数量
     */
    public function countMoney($itemid,$uin){
    	$where = array();
    	if($uin) $where['a.uin'] = $uin;
    	if($itemid) $where['a.itemid'] = $itemid;
    	$count = M('item_with_order as a')
        		->where($where)
                ->sum('a.money');
        if(!$count) $count='0';
        return 	$count;
    }
    /**
     * 统计项目认投完成率
     * @return int 数量
     */
    public function successRate($itemid){
        $countMoney = $this->countMoney($itemid); //已经认投的金额总数
        $raisingMoney = M('item')->where(array('id'=>$itemid))->getField('raising_money');
        return  round($countMoney / $raisingMoney * 100,2);
    }
}