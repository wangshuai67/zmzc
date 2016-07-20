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
class UserModel extends Model {
	//获取用户列表列表
	public function loadList($where = array(), $limit = 10 ,$order = 'id desc'){

		$data = M('user as a')
		->field('a.*')
		->where($where)
		->limit($limit)
		->order($order)
		->select();

		return 	$data;
	}

	//获取用户列表数量
    public function countList($where = array()){

        return 	M('user as a')->where($where)->count();
    }
    
}