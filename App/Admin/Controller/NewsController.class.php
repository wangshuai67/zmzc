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
//新闻管理
class NewsController extends CommonController {

    //新闻列表
    public function index(){
		$M        = D('Home/news');		
		$count    = $M->countList();
        $page     = new \Think\Page($count,20);
        $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show     = $page->show();
		$limit    = $page->firstRow.','.$page->listRows;
		$where['a.ispage']=0;
        $user_list = $M->loadList($where,$limit);
		$this->assign('page',$show);
        $this->assign('lists',$user_list);
        $this->display();
    }
	

    //添加新闻
    public function news_add(){
        if (IS_POST) {
            $add = D('Home/News');
            $add->time= time();
           
			if(!$add->create()){
				$this->error($add->getError());
			}else{
				if($add->add()) $this->success('添加成功!',U('Admin/News/index'));				
			}
        }else{
            $pid_list = M('news_category')->where(array('pid'=>0))->order('sort desc')->select();
            $this->assign('pid_list',$pid_list);
            $lists = $pid_list;
            foreach ($lists as $key => $value) {
                $lists[$key]['lower'] = M('news_category')->where(array('pid'=>$value['id']))->order('sort desc')->select();
            }
            $this->assign('lists',$lists);
            $this->display();
        }
        
    }
	//修改新闻
	public function news_edit(){
		
		if(IS_POST){
			$add = D('Home/News');
            $add->update_time= time();
			if(!$add->create()){
				$this->error($add->getError());
			}else{
				if($add->save()) $this->success('修改成功!',U('Admin/News/index'));				
			}
           
		}else{
			$id          = I('get.id');
			$this->news  = M('news')->find($id);
			$pid_list    = M('news_category')->where(array('pid'=>0))->order('sort desc')->select();
            $this->assign('pid_list',$pid_list);
            $lists = $pid_list;
            foreach ($lists as $key => $value) {
                $lists[$key]['lower'] = M('news_category')->where(array('pid'=>$value['id']))->order('sort desc')->select();
            }
            $this->assign('lists',$lists);
			$this->display();
		}
		
	}
    //删除新闻
    public function news_del(){
        if (IS_POST) {
            $http_post = I('post.');

            $delete = M('news')->where(array('id'=>$http_post['id']))->delete();

            if ($delete) {
                $this->ajaxReturn(array('info'=>'删除成功!','status'=>1));
            }else{
                $this->ajaxReturn(array('info'=>'删除失败!','status'=>0));
            }
        }
    }

    //分类列表
    public function category(){
    	$pid_list = M('news_category')->where(array('pid'=>0))->order('sort desc')->select();
        $this->assign('pid_list',$pid_list);

        $lists = $pid_list;

        foreach ($lists as $key => $value) {
            $lists[$key]['lower'] = M('news_category')->where(array('pid'=>$value['id']))->order('sort desc')->select();
        }

    	$this->assign('lists',$lists);
    	$this->display();
    }

    //添加分类
    public function category_add(){
    	if (IS_POST) {
    		$http_post            = I('post.');
    		$data['name']         = $http_post['name'];
    		$data['pid']          = $http_post['pid'];
    		$data['sort']         = $http_post['sort'];
    		$data['limit']        = $http_post['limit'];
			$data['title']        = $http_post['title'];
			$data['keywords']     = $http_post['keywords'];
			$data['description']  = $http_post['description'];
    		$data['create_time']  = time();
    		$add = M('news_category')->add($data);
    		if ($add) {
    			$this->success('添加成功!');
    		}else{
    			$this->error('添加失败!');
    		}
    	}else{
    		$lists = M('news_category')->where(array('pid'=>0))->select();
    		$this->assign('lists',$lists);
    		$this->display();
    	}
    }

    //修改分类
    public function category_update(){
    	$http_get  = I('get.');
    	$http_post = I('post.');

    	if (IS_POST) {
    		$data['name']        = $http_post['name'];
    		$data['pid']         = $http_post['pid'];
    		$data['sort']        = $http_post['sort'];
			$data['limit']       = $http_post['limit'];
			$data['title']       = $http_post['title'];
			$data['keywords']    = $http_post['keywords'];
			$data['description'] = $http_post['description'];
    		$data['update_time'] = time();
    		$delete = M('news_category')->where(array('id'=>$http_get['id']))->setField($data);
    		if ($delete) {
    			$this->ajaxReturn(array('info'=>'更新成功!','id'=>$http_post['id'],'status'=>1));
    		}else{
    			$this->ajaxReturn(array('info'=>'更新失败!','status'=>0));
    		}
    	}else{
    		$info  = M('news_category')->where(array('id'=>$http_get['id']))->find();
            $lists = M('news_category')->where(array('pid'=>0))->select();
    		$this->assign('info',$info);
    		$this->assign('lists',$lists);
    		$this->display('category_add');
    	}
    }

    //删除分类
    public function category_del(){
    	if (IS_POST) {
    		$http_post = I('post.');
			$sub       = M('news_category')->where(array('pid'=>$http_post['id']))->find();
			if($sub){
				$this->error('还有下级分类，先删除一级分类');
			}
			$delnews=M('news')->where(array('cid'=>$http_post['id']))->delete();   	
			
    		$delete = M('news_category')->where(array('id'=>$http_post['id']))->delete();
    		if ($delete) {
    			$this->success('删除成功');
    		}else{
				$this->error('删除失败');
    		}
    	}
    }
	//单页列表
	public function page_list(){
		$M        = D('Home/news');		
		$count    = $M->countList();
        $page     = new \Think\Page($count,20);
        $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show     = $page->show();
		$limit    = $page->firstRow.','.$page->listRows;
		$where['a.ispage']=1;
        $user_list = $M->loadList($where,$limit);
		$this->assign('page',$show);
        $this->assign('lists',$user_list);
        $this->display();
	}
	//添加单页
    public function page_add(){
        if (IS_POST) {
            $add = D('Home/News');
            $add->time= time();
			if(!$add->create()){
				$this->error($add->getError());
			}else{
				if($add->add()) $this->success('添加成功!',U('Admin/News/page_list'));				
			}
        }else{
            $this->display();
        }
        
    }
	//修改单页
	public function page_edit(){
		if(IS_POST){
			$add = D('Home/News');
            $add->update_time= time();
			if(!$add->create()){
				$this->error($add->getError());
			}else{
				if($add->save()) $this->success('修改成功!',U('Admin/News/page_list'));				
			}
           
		}else{
			$id          = I('get.id');
			$this->news  = M('news')->find($id);
			$pid_list    = M('news_category')->where(array('pid'=>0))->order('sort desc')->select();
            $this->assign('pid_list',$pid_list);
            $lists       = $pid_list;
            foreach ($lists as $key => $value) {
                $lists[$key]['lower'] = M('news_category')->where(array('pid'=>$value['id']))->order('sort desc')->select();
            }
            $this->assign('lists',$lists);
			$this->display();
		}
		
	}
}