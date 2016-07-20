<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.zhimale.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  醉忆花颜 <aminsire@qq.com>
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function _initialize(){
		$zhimale_v= curl_get('http://www.zhimale.com/Api/check_v');
		if($zhimale_v!=ZHIMALE_V){
			$this->zhimale='有新的版本请到官网下载升级<a class="text-sub" href="http://www.zhimale.com/News/index/id/4.html">点击这里</a>';
		}
        $this->admin_uid        = session('admin_uid');
        $this->admin_username   = session('admin_username');
        if (!session('admin_uid') and !session('admin_username')) {
            redirect(U('Admin/Public/login'));
            exit;
        }
        $userinfo = M('admin_user')->where(array('id'=>$this->admin_uid))->find();
        if (!$userinfo) {
            redirect(U('Admin/Public/login'));
            exit;
        }
        if ($userinfo['status']==0){
            $this->error('该帐户处于冻结状态!',U('Admin/Public/login'));
        }
        if (session('admin_login_key')!=$userinfo['login_key']) {
            $this->error('您的帐号在别的地方登录!',U('Admin/Public/logout'));
        }
		$this->group_name = M('admin_auth_group_access a')->join('__ADMIN_AUTH_GROUP__ g ON a.group_id=g.id')->where(array('a.uid'=>session('admin_uid')))->getField('g.title');
        //权限验证
		$this->assign("menu", $this->show_menu());
	
        $this->assign("sub_menu", $this->show_sub_menu());
        if(in_array(session('admin_uid'),C('AUTH_CONFIG.AUTH_ADMINUID'))) return true;		
		$auth = new \Think\Auth();
		if(!$auth->check(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME,session('admin_uid'))){
			$this->error('没有权限');
		}
    }
    /**
     * 显示一级菜单
     */
    private function show_menu() {
		$group_id     = M('admin_auth_group_access')->where(array('uid'=>session('admin_uid')))->getField('group_id');
		$rules        = M('admin_auth_group')->where(array('id'=>$group_id))->getField('rules');
		$menu         = M('admin_auth_rule')->where(array('id'=>array('in',$rules),'menu'=>1,'pid'=>0))->select();
		foreach($menu as $k=>$v){
			$menu[$k]['sub_menu']=M('admin_auth_rule')->where(array('id'=>array('in',$rules),'menu'=>1,'pid'=>$v['id']))->select();
		}
        return $menu;
    }
    /**
     * 显示二级菜单
     */
    private function show_sub_menu() {
        $big    = CONTROLLER_NAME == "Index" ? "Common" : CONTROLLER_NAME;
        $cache  = C('admin_sub_menu');
        $sub_menu = array();
        if ($cache[$big]) {
            $cache = $cache[$big];
            foreach ($cache as $url => $title) {
                $url = $big == "Common" ? $url : "$big/$url";
                $sub_menu[] = array('url' => U("$url"), 'title' => $title);
            }
            return $sub_menu;
        } else {
            return $sub_menu[] = array('url' => '#', 'title' => "该菜单组不存在");
        }
    }
}