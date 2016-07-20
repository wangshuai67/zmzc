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
class ItemLeadModel extends Model {
	//验证
	protected $_validate = array(
	    array('do_what','require','领投人义务需要填写哦',0), //
	    array('manage_money','require','请填写服务费',0), //
	    array('num','require','数量不能为空',0), //
	    array('itemid','checkItemId','您没有权限',1,'callback'), //
	);
	//验证itemid是否合法
	public function checkItemId($itemId){
		$uin = M('item as a')->where(array('id'=>$itemId))->getField('uin');
		if ($uin != $_SESSION['user']['uin']) {
			return false; 
		}else{
			return true; 
		}
	}
	//查询内容
	public function getInfo($where){
		return M('item_lead as a')->where($where)->find();
	}
}