<?php
namespace Admin\Controller;
use Think\Controller;
class AdsController extends CommonController {
    public function index(){
		$lists=M('ad')->order('sort desc')->select();
		
		$this->lists=$lists;
		$this->display();
    }
	public function ads_edit(){
		
		$id=I('get.id');
		if(IS_POST){
			$post=I('post.');
			if($id){
				$post['id']=$id;
				$ok=M('ad')->save($post);				
			}else{
				$ok=M('ad')->add($post);				
			}
			if($ok){
				$this->success('成功');
			}else{
				$this->error('失败');
			}
		}else{
			$this->info=M('ad')->where(array('id'=>$id))->find();
			$this->lists=M('ad')->where(array('pid'=>0))->order('sort desc')->select();
			$this->display();
		}
	
		
	}
	public function ads_del(){
		if(IS_POST){
			$id=I('post.id');
			if(M('ad')->delete($id)){
			$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}
		}
	}
}