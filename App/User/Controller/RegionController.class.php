<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.zhimale.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  预感 <442648313@qq.com>
// +----------------------------------------------------------------------
namespace User\Controller;
use Think\Controller;
class RegionController extends PublicController {
    public function index(){
		$pid 	= I('get.pid');
		$region = get_region($pid);
		if($region){
			$this->success($region);	
		}
    }
}