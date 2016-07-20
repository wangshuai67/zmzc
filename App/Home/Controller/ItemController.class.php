<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.zhimale.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  火鸡 <834758588@qq.com>
// +----------------------------------------------------------------------
namespace Home\Controller;
use Think\Controller;
class ItemController extends Controller {
    public function index(){
        //分类列表
        $categoryList = M('item_category')->select();
        foreach ($categoryList as $key => $value) {
            $categoryList[$key]['url'] = U('Item/index',array('cid'=>$value['id']));
        }
        $this->categorylist = $categoryList;
        //搜索
        $search = I('get.search');
        if ($search) $where['a.name'] = array('like','%'.$search.'%');
    	$cid = I('get.cid');
    	if ($cid) {
    		$where['a.cid']   = $cid;
    		$limit            = item_category($cid,'limit');
    	}
        $where['a.status'] = 1;
    	$limit = default_data($limit,10);                          //如果没有限制条数 默认10条
    	$count = D('User/item')->countList($where);                // 统计有多少条数据
    	$Page  = new \Think\Page($count,$limit);                   // 实例化分页类 传入总记录数和每页显示的记录数(20)
        $limit = $Page->firstRow.','.$Page->listRows;
    	$Page->setConfig('prev','上一页');
    	$Page->setConfig('next','下一页');
    	$Page->setConfig('theme','%UP_PAGE%	%DOWN_PAGE%');
    	$show       = $Page->show(); // 分页显示输出
    	// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $order = 'a.time desc';
    	$itemList = D('User/item')->loadList($where,$limit,$order);
    	foreach ($itemList as $key => $value) {
            $itemList[$key]['url']              = U('Item/info',array('id'=>$value['id']));
            $itemList[$key]['last_time']        = gettime($value['end_time']-time());
            $itemList[$key]['category_name']    = item_category($value['cid'],'name');
    		$itemList[$key]['success_rate']     = D('User/ItemWithOrder')->successRate($value['id']);     //完成率
    	}
    	//面包屑导航组装
    	$bread = 	'<ul class="x12 bread padding-big-top">
						<li><a href="'.__ROOT__.'/" class="icon-home"> 首页</a></li>
						<li><a href="'.item_category($cid,'url').'">'.item_category($cid,'name').'</a></li>
					</ul>';
		$this -> bread     =$bread;
    	$this->itemlist    = $itemList;
    	$this->page        = $show;
    	$this->display();
    }
    public function info(){
        $itemid = I('get.id');
        //项目详情
        $info = D('User/item')->getInfo(array('a.id'=>$itemid,'a.status'=>1));
        if(!$info)  $this->error('缺少参数！');
        $info['last_time']      = gettime($info['end_time']-time());
        $info['content']        = htmlspecialchars_decode($info['content']);
        $info['success_rate']   = D('User/ItemWithOrder')->successRate($itemid);           // 完成率
        $info['count_money']    = D('User/ItemWithOrder')->countMoney($itemid);             // 现已融资
        $info['invest_money']   = $info['raising_money'] - $info['has_investment'];        //投资方共融资
        $this->iteminfo         = $info;
        //面包屑导航组装
        $bread =    '<ul class="x12 bread padding-big-top">
                        <li><a href="'.__ROOT__.'/" class="icon-home"> 首页</a></li>
                        <li><a href="'.item_category($info['cid'],'url').'">'.item_category($info['cid'],'name').'</a></li>
                    </ul>';
        $this -> bread =$bread;
        //问答内容
        $questionsList = D('Home/ItemQuestions')->loadList(array('itemid'=>$itemid));
        foreach ($questionsList as $key => $value) {
            $questionsList[$key]['u_name'] = user($value['uin'],'name');
            $questionsList[$key]['header'] = user($value['uin'],'header');
        }
        $this->questionsList = $questionsList;
        //投资列表
        $this->invest   = D('User/ItemWithOrder')->loadList(array('a.itemid'=>$itemid));
        //项目动态
        $itemLog        = M('item_log') -> where(array('itemid'=>$itemid))->select();
        $this->log      = $itemLog;
        //领投人列表
        $leadUser       = D('User/ItemLeadUser')->loadList(array('a.itemid'=>$itemid));
        foreach ($leadUser as $key => $value) {
            $leadUser[$key]['countmoney'] = D('User/ItemWithOrder')->countMoney($itemid,$value['uin']);
        }
        //视频列表
        $this->video    = D('User/ItemVideo')->loadList($itemid,'RIGHT');
        $this->leaduser = $leadUser;
        $this->display();
    }
    //验证是否可以领投
    public function lead_check($itemid = 0){
        $itemid ? $itemid : $itemid=I('get.itemid');                                //如果项目id false 取get值
        $leadUser = D('User/ItemLeadUser');                                         //实例化领投人列表
        if (!$itemid) $this->error('项目不存在！');                                 //安全考虑 防止直接打开方法
        $lead = D('User/ItemLead')->getInfo(array('itemid'=>$itemid));              //读取项目领投规则
        $leadUserCount = $leadUser->countList($itemid,'1');                         //统计现有多少领投人
        if ($leadUserCount >= $lead['num']) $this->error('领投已经满了');           //如果现有领投人大于等于 领投规则设定的人数 false
        $repeat = $leadUser ->getInfo(array('itemid'=>$itemid,'uin'=>session('user.uin')));
        if($repeat) $this->error('您申请过领投了！');                               //如果已经申请过领投该项目 false
        if(I('get.itemid'))    $this->success('您可以进行领投操作！');

    }
    //领投人申请
    public function lead_user(){
        $this           ->lead_check(I('post.itemid'));                                        //验证是否可以领投
        $leadUser       = D('User/ItemLeadUser');
        if (!$leadUser  ->create()) {
            $this       ->ajaxReturn(array('status'=>0,'info'=>$leadUser->getError()));
        }else{
            $leadUser   ->add();
            $this       ->ajaxReturn(array('status'=>1,info=>'申请领投成功！'));
        }
    }
    //验证约谈条件
    public function interview_check($itemid){
        $leadInterview      = D('User/ItemInterview');
        $uin                = session('user.uin'); 
        $where['uin']       = $uin;
        $where['itemid']    = $itemid;
        $where['status']    = '0';
        $Interview          = $leadInterview->getInfo($where);
        if ($Interview) {
            if ($Interview['time']+ 86400 < time()) {
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }
    //约谈申请
    public function interview_user(){
        if (!IS_POST)  $this->ajaxReturn(array('status'=>0,'info'=>'操作失败！'));
        //判断是否可以预约
        if(!$this->interview_check(I('post.itemid')))   $this->ajaxReturn(array('status'=>0,info=>'您上次的预约未满24小时，请24小时之后再提交！'));
        $leadInterview = D('User/ItemInterview');
        if (!$leadInterview->create()) {
            $this->ajaxReturn(array('status'=>0,'info'=>$leadInterview->getError()));
        }else{
            if ($leadInterview->add()) {
                $this->ajaxReturn(array('status'=>1,info=>'申请约谈成功！'));
            }else{
                $this->ajaxReturn(array('status'=>0,info=>'约谈失败！'));
            }
        }
    }
    //收藏操作
    public function collect(){
        if (!IS_POST)  $this->ajaxReturn(array('status'=>0,'info'=>'操作失败！'));
        $uin                = session('user.uin');
        $itemCollect        = D('User/ItemCollect');
        $where['itemid']    = I('post.itemid');
        $where['uin']       = $uin;
        if($itemCollect->getInfo($where))   $this->ajaxReturn(array('status'=>0,'info'=>'您已经收藏过了！'));
        if (!$itemCollect->create()) {
            $this->ajaxReturn(array('status'=>0,'info'=>$itemCollect->getError()));
        }else{
            if ($itemCollect->add()) {
                D('User/UserDoLog')-> addData('您的项目收藏成功！',session('user.uin'));
                $this->ajaxReturn(array('status'=>1,info=>'收藏成功！'));
            }else{
                $this->ajaxReturn(array('status'=>0,info=>'收藏失败！'));
            }
        }
    }

    //投资下单
    public function with_item(){
        $http_get               = I('get.');

        $info                   = M('item')->where(array('id'=>$http_get['id']))->find();

        $item_amount_info       = M('item_with_order')->where(array('itemid'=>$info['id']))->sum('amount');

        $info['surplus_amount'] = $info['amount']-$item_amount_info;

        $this->assign('info',$info);

        $this->display();
    }
}