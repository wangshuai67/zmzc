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
class ItemLeadUserModel extends Model {
	protected $_validate = array(
	    array('user_desc','require','简介必须填写！',0),
	    array('uin','require','领投人uin不存在！',0), 
	    array('itemid','require','项目id不存在',1),
	);
	protected $_auto = array ( 
         array('time','time',1,'function'), 
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
		return M('item_lead_user as a')->where($where)->find();
	}
	/**
     * 读取列表数据
     * @return array 列表
     */
	public function loadList($where = array(), $limit = 10 ,$order = 'time desc'){
		return 	M('item_lead_user as a')
				->join('LEFT JOIN __ITEM__ b ON a.itemid = b.id')
				->join('LEFT JOIN __USER__ c ON a.uin = c.uin')
				->join('LEFT JOIN __ITEM_LEAD__ d ON a.itemid = d.itemid')
				->field('a.*,b.name as item_name,b.cover_img,c.name as user_name,c.header,d.do_what')
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
        return 	M('item_lead_user as a')
        		->where($where)
                ->count();
    }
    /**
     * 获取项目审核通过领头人数量
     * @return int 数量
     */
    public function countLead($itemid, $status = '1'){
    	$where['status'] = $status;
    	$where['itemid'] = $itemid;
        return 	$this->countList($where);
    }
}