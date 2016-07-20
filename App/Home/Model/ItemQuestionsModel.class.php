<?php 
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.zhimale.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  预感 <442648313@qq.com>
// +----------------------------------------------------------------------
namespace Home\Model;
use Think\Model;
class ItemQuestionsModel extends Model {
	protected $_validate = array(
	    array('title','require','标题必须填写！',0), //
	    array('content','require','内容必须填写！',0), //
	    array('uin','require','操作人不存在！',0), //
	    array('itemid','checkItemId','该项目您不可以提问',1,'callback'), //
	);
	protected $_auto = array ( 
         array('time','time',3,'function'), // 
         array('uin','getUin',3,'callback'), // 
     );
	//自动完成uin
	protected function getUin(){ 
		return $_SESSION['user']['uin']; 
	}
	//自动验证itemid是否合法
	protected function checkItemId($itemId){
		$uin = M('item')->where(array('id'=>$itemId))->getField('uin');
		if ($uin != $_SESSION['user']['uin']) {
			return false; 
		}else{
			return true; 
		}
	}
	//查询内容
	public function getInfo($where){
		return M('item_questions  as a')->where($where)->find();
	}
	//查询内容
	public function loadList($where = array(), $limit = 10 ,$order = 'time desc'){
		$data = M('item_questions as a')->where($where)->limit($limit)->order($order)->select();
		return $data;
	}
	public function countList($where = array()){
		return M('item_questions as a')->where($where)->count();
	}
}
