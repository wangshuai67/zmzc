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
class NewsModel extends Model {
	protected $_validate = array(
	    array('title','require','标题必须填写！',0), //
	    array('content','require','内容必须填写！',0), //
	);
	protected $_auto = array ( 
         array('time','time',3,'function'), // 
   
     );
	//查询内容
	public function getInfo($where){
		$info=M('news a')
		->join('LEFT JOIN __NEWS_CATEGORY__ b ON a.cid=b.id')
		->field('a.*,b.name as cname')
		->where($where)
		->find();
		return $info;
	}
	//查询内容
	public function loadList($where = array(), $limit = 10 ,$order = 'a.time desc'){
		$data = M('news a')
		->join('LEFT JOIN __NEWS_CATEGORY__ b ON a.cid=b.id ')
		->field('a.*,b.name as cname')
		->where($where)
		->limit($limit)
		->order($order)
		->select();
		return $data;
	}
	//统计新闻数量
	public function countList($where = array()){
		$data = M('news a')
		->where($where)
		->count();
		return $data;
	}
}
