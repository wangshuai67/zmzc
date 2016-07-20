<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.zhimale.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  预感 <442648313@qq.com>
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Think\Controller;
class AuthController extends CommonController {
	//权限首页
	public function index(){
		$this->display();
	}
	public function my_edit(){
		$id               = session('admin_uid');
		$this->uid        = $id;
		$this->admin_user = M('admin_user u')
                            ->join('__ADMIN_AUTH_GROUP_ACCESS__ a ON a.uid=u.id')
                            ->where(array('u.id'=>$id))
                            ->find();
		$group_data       = M('admin_auth_group')->getField('id,title');
		$this-> assign('groups',$group_data);
	    $this-> display('user_edit');
	}
    //用户管理
    public function user(){
        $HttpGet = I('get.');
        $M = M('admin_user');
        if(!in_array(session('admin_uid'),C('AUTH_CONFIG.AUTH_ADMINUID'))){
            $map['id']  = array('not in',C('AUTH_CONFIG.AUTH_ADMINUID'));
        }
        if ($HttpGet['roleid']) {
            //查询角色分组下面的用户
            $group_data = M('admin_auth_group_access')->where(array('group_id'=>$HttpGet['roleid']))->getField('uid',true);

            $map['id']  = array('in',$group_data);
        }
        $count          = $M->where($map)->count();
        $page           = new \Think\Page($count,10);
        $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show           = $page->show();
        $this->assign('page',$show);
        $user_list = $M->where($map)->limit($page->firstRow.','.$page->listRows)->order('id desc')->select();
        $group_data         = M('admin_auth_group')->getField('id,title');
        $group_access_data  = M('admin_auth_group_access')->getField('uid,group_id');
        foreach ($user_list as $key => $value) {
            $user_list[$key]['group_title'] = $group_data[$group_access_data[$value['id']]];
        }		
        $this->assign('list',$user_list);
        $this->assign('groups',$group_data);
        $this->display();
    }

    //添加用户
    public function user_add(){
        if (IS_POST) {
            $HttpPost               = I('post.');
            //print_r($HttpPost);
            $data['username']       = $HttpPost['username'];
            $data['nickname']       = $HttpPost['nickname'];
            $data['password']       = encrypt($HttpPost['password']);
            $data['email']          = $HttpPost['email'];          
            $data['create_time']    = time();			
            $useradd                = M('admin_user')->add($data);
            $group_accessadd        = M('admin_auth_group_access')->add(array('uid'=>$useradd,'group_id'=>$HttpPost['group_id']));
            if($useradd and $group_accessadd){
                $this->success('添加用户成功');
            }else{
                $this->error('添加用户失败');
            }
        }else{
            $group_list = M('admin_auth_group')->getField('id,title');
            $this->assign('groups',$group_list);
            $this->display();
        }
    }
	public function user_edit(){
		if(IS_POST){
			$HttpPost       = I('post.');
            $data['id']     =  $HttpPost['id'];
			if(!in_array($data['id'],C('AUTH_CONFIG.AUTH_ADMINUID')) || $data['id']!=session('admin_uid')){
				$this->error('你没有权限');
			}
            $data['username'] = $HttpPost['username'];
            $data['nickname'] = $HttpPost['nickname'];
				if($HttpPost['password']){
					$data['password'] = encrypt($HttpPost['password']);
				}
            $data['email']          = $HttpPost['email']; 
            $data['status']         = $HttpPost['status'];          
            $data['update_time']    = time();	
            $useradd                = M('admin_user')->save($data);
            $group_accessadd        = M('admin_auth_group_access')
                                    ->where(array('uid'=>$id))
                                    ->setField('group_id',$HttpPost['group_id']);
			if($useradd){
                $this->success('修改成功');
            }else{
                $this->error('修改失败');
            }
		}else{
			$id                  = I('get.id');
			$this->uid           = I('get.id');
			$this->admin_user    = M('admin_user u')
                                    ->join('__ADMIN_AUTH_GROUP_ACCESS__ a ON a.uid=u.id')
                                    ->where(array('u.id'=>$id))
                                    ->find();
			$group_data = M('admin_auth_group')->getField('id,title');
            $this->assign('groups',$group_data);
			$this->display();
		}		
	}

    //角色管理
    public function role(){
        $group_list = M('admin_auth_group')->select();
        $this->assign('list',$group_list);
        $this->display();
    }
	
	//创建角色
	public function role_add(){
		if(IS_POST){
			$name        = I('post.title');
			$rules       = I('post.rules');
			$ok          = M('admin_auth_group')->add(array('title'=>$name,'rules'=>$rules));
			if($ok){
				$this->success('创建成功');
			}else{
				$this->error('创建失败');
			}
		}else{
            $rule_list = M('admin_auth_rule')->where('pid="0"')->select();
			foreach($rule_list as $k=>$v){
				$rule_list[$k]['sub']=M('admin_auth_rule')->where(array('pid'=>$v['id']))->select();
			}
            $this->assign('rule_list',$rule_list);
			$this->display();
		}
	}
	
    //权限选择
    public function role_edit(){
        $HttpGet        = I('get.');
        $HttpPost       = I('post.');
        if (IS_POST) {
            $data['rules'] = I('post.rules');
            $data['title'] = I('post.title');
            $num = M('admin_auth_group')->where(array('id'=>$HttpGet['id']))->save($data);
            if($num){
                $this->success('权限更新成功!',U('Admin/Auth/role'));
            }else{
                $this->error('权限更新失败!');
            }
        }else{
            $group_info              = M('admin_auth_group')->where(array('id'=>$HttpGet['id']))->find();
			$group_info['rules']     = explode(',',$group_info['rules']);
            $this->assign('group_info',$group_info);
            $rule_list = M('admin_auth_rule')->where('pid="0"')->select();
			foreach($rule_list as $k=>$v){
				$rule_list[$k]['sub']=M('admin_auth_rule')->where(array('pid'=>$v['id']))->select();
			}
            $this->assign('rule_list',$rule_list);
            $this->display();
        }
    }
    //节点管理
    public function node(){
        $M              = M('admin_auth_rule');
		$where          = array('pid'=>0);
        $count          = $M->where($where)->count();
        $page           = new \Think\Page($count,10);
        $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show = $page->show();
        $this->assign('page',$show);
        $rule_list = $M->where($where)->limit($page->firstRow.','.$page->listRows)->order('id asc')->select();
		foreach($rule_list as $k=>$v){
			$rule_list[$k]['sub']=M('admin_auth_rule')->where(array('pid'=>$v['id']))->select();
		}
        $this->assign('list',$rule_list);
        $this->display();
    }
	//节点编辑
	public function node_edit(){
		if(IS_POST){
			$HttpPost       = I('post.');			
            $data['name']   = $HttpPost['name'];
            $data['title']  = $HttpPost['title'];     
            $data['menu']   = $HttpPost['menu'] ? $HttpPost['menu'] : 0;
            $data['pid']    = $HttpPost['pid'];
            $data['id']     = $HttpPost['id'];
            $M = M('admin_auth_rule');
			if($M->save($data)){
                $this->success('修改成功');
            }else{
                $this->error('修改失败');
            }
		}else{
			$id          = I('get.id');
			$this->id    = $id;
			$M           = M('admin_auth_rule');
			$this->node  = $M->where(array('id'=>$id))->find();
			$this->node_menu = $M->where(array('pid'=>0,'menu'=>1))->select();
			$this->display();
		}	
		
	}
    //添加节点
    public function node_add(){
        if (IS_POST) {
            $HttpPost           = I('post.');			
            $data['name']       = $HttpPost['name'];
            $data['title']      = $HttpPost['title'];     
            $data['menu']       = $HttpPost['menu'] ? $HttpPost['menu'] : 0;
            $data['pid']        = $HttpPost['pid'];
            $M = M('admin_auth_rule');
			if($M->where(array('name'=> $data['name']))->find()){
				$this->error('节点存在');
			}
            if($M->add($data)){
                $this->success('添加规则成功');
            }else{
                $this->error('添加规则失败');
            }
        }else{
			$M = M('admin_auth_rule');
			$this->node_menu = $M->where(array('pid'=>0,'menu'=>1))->select();
			$this->display();
		}

    }
}