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
class ItemVideoModel extends Model {
	protected $_validate = array(
	    array('itemid','require','项目id不存在',1),
	);
	protected $_auto = array ( 
         array('time','time',1,'function'), 
     );
	//获取充值列表列表
	public function loadList($itemid,$join){
		if(!$join) $join = 'LEFT';
		$data 	= M('item_progress as a')
				->join('__ITEM_VIDEO__ b ON b.type=a.id and b.itemid='.$itemid,$join)
				->field('b.*,a.id as pid,a.name as pname')
				->where('a.id > 0')
				->select(); 

		return 	$data;
	}
}