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
class ItemModel extends Model {
	//验证
	protected $_validate = array(
		array('name','require','项目名不能为空'), 
		array('desc','require','项目简介不能为空'), 
		array('name','','项目名已经存在',0,'unique',1),
		array('cid','require','行业类别不能为空'),
		array('raising_money','currency','筹资金额不正确'), 
		array('end_time','require','筹资结束时间不能为空'),
		array('uin','checkUin','你没有权限',2,'notequal'), 
		array('has_investment','currency','项目方出资不正确'), 
		array('amount','checkNum','认购份数不正确',0,'function'), 
		array('lowest_money','currency','最低认购金额不正确'), 
		array('project_rate','currency','项目方收益比例不正确'), //项目方收益比例
		array('investment_rate','currency','投资方收益比例不正确'), //投资方收益比例
		array('cover_img','require','请上传封面图'), //投资方收益比例
		array('plan_file','require','请上传项目计划书'), //投资方收益比例
		array('content','require','项目详情请仔细填写'), //投资方收益比例
	);
	protected function checkUin(){
		return sessoin('user.uin');
	}
	protected function checkNum($num){
		if($num > 0){
			return true;
		}else{
			return false ;
		}
	}
	/**
     * 获取列表 
     * a 主表 b 视频表 c 进度表 
     * @return array 列表
     */
	public function loadList($where = array(), $limit = 10 ,$order = 'a.time desc'){
		if (!$where['a.isdel']) $where['a.isdel'] = '0';			//默认不显示删除数据
		$data   = M('item as a')
		        ->join('LEFT JOIN __ITEM_PROGRESS__ as c ON a.progress = c.id')
		        ->join('LEFT JOIN __USER__ as d ON a.uin = d.uin')
		        ->join('LEFT JOIN __ITEM_CATEGORY__ as e ON a.cid = e.id')
		        ->field('a.*,a.id as id,c.id as cid,c.name as progress_name,d.uin,d.name as user_name,d.header as user_header,e.id as eid,e.name as category_name')
		        ->where($where)
		        ->limit($limit)
		        ->order($order)
		        ->select();
        return $data;
	}
	/**
     * 获取数量
     * @return int 数量
     */
    public function countList($where = array()){
		if (!$where['a.isdel']) $where['a.isdel'] = '0';			//默认不显示删除数据
        return 	M('item as a')
    			->join('LEFT JOIN __ITEM_VIDEO__ as b ON a.id = b.itemid')
                ->where($where)
                ->count();
    }
    /**
     * 获取信息
     * @param int $userId ID
     * @return array 信息
     */
    public function getInfo($where){	
		if (empty($where['a.isdel'])) $where['a.isdel'] = '0';			//默认不显示删除数据
        return M('item as a')
				->join('LEFT JOIN __ITEM_PROGRESS__ as c ON a.progress = c.id')
		        ->join('LEFT JOIN __USER__ as d ON a.uin = d.uin')
				->join('LEFT JOIN __ITEM_CATEGORY__ as e ON a.cid = e.id')
		        ->field('a.*,a.id as id,c.id as cid,c.name as progress_name,d.uin,d.name as user_name,d.header as user_header,e.id as eid,e.name as category_name')
		        ->where($where)
		        ->find();
    }
}