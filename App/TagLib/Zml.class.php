<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.zhimale.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  火鸡 <834758588@qq.com>
// +----------------------------------------------------------------------
namespace TagLib;
use Think\Template\TagLib;
Class Zml extends TagLib{
	protected $tags   =  array(
		// 通用循环标签
		'zmllist'    =>  array('attr'=>'name,id,offset,length,key,mod','level'=>3,'alias'=>'iterate'),
	  	// 定义非闭合标签
        'title'    =>    array('attr'=>'','close' =>0), // 网站标题
	 	'sitename'    =>    array('attr'=>'','close' =>0), // 网站名称
	 	'keywords'    =>    array('attr'=>'','close' =>0), // 网站关键词
	 	'description'    =>    array('attr'=>'','close' =>0), // 网站描述
	 	'logo'    =>    array('attr'=>'','close' =>0), // 网站logo
	 	// 定义闭合标签
        'adlist'    =>    array('attr'=>'type','close' =>1), // 广告列表
        'newslist'    =>    array('attr'=>'cid,num,order','close' =>1), // 新闻列表
        'navlist'    =>    array('attr'=>'pid,num,order','close' =>1), // 分类列表
        'itemlist'    =>    array('attr'=>'cid,status,num,end,progress,order','close' =>1), // 项目列表
        'nav'    =>    array('attr'=>'pid,status,num,type','close' =>1,'level'=>1), // 导航顶级列表
	);
    public function _nava($attr){
        $html_str=<<<Eof
 <?php        
        
        \$pdinfo=M("nav");
        \$where=array("pid"=>\$zml['id']);
        \$infores=\$pdinfo->select();
 ?>
Eof;
    return $html_str; //输出数据即可
    }    
	//网站名称
	public function _sitename($attr,$content){
		$con = C('sitename');
		return $con;
	}
    //网站seo标题
    public function _title($attr,$content){
        $con = C('title');
        return $con;
    }
	// 网站关键词
	public function _keywords($attr,$content){
		$con = C('keywords');
		return $con;
	}
	// 网站描述
	public function _description($attr,$content){
		$con = C('desc');
		return $con;
	}
	// 网站logo
	public function _logo($attr,$content){
		$con = C('logo');
		return $con;
	}
    /**
     * adlist 广告列表
     */
    public function _adlist($attr,$content){
        $type = $attr['type'];
        //状态条件
        if($type){
            $w = ($w) ? $w.' AND type ='.$type : 'type ='.$type;
        }
        $str = '<?php ';
        $str .= '$info = M("ad")->where("'.$w.'")->select();';
        $str .= 'foreach ($info as $i => $zml):';
        $str .= ' ?>';
        $str .= $this->tpl->parse($content);
        $str .='<?php endforeach ?>';
        return $str;
    }
	/**
     * newslist 新闻列表
     */
	public function _newslist($attr,$content){
		$str='<?php ';
		// $where = "array('a.status'=>1)";
		// if ($attr['cid']) {
		// 	$where = "array('a.cid'=>array('in','".$attr['cid']."'))";
		// }
        $cid = $attr['cid'];
        //状态
        $w = ($w) ? $w.' AND a.status =1' : 'a.status =1';
        //分类条件
        if($cid){
            $w = ($w) ? $w.' AND a.cid In('.$cid.')' : 'a.cid In('.$cid.')';
        }
		$limit = !empty($attr['num'])? $attr['num'] : '10';
		$order = !empty($attr['order'])? $attr['order'] : 'a.time desc';
		$str .= '$info = D("Home/News")->loadList("'.$w.'","'.$limit.'","'.$order.'");';
		$str .= 'foreach ($info as $i=>$zml):';
		$str .= '$zml["url"]='.'U("news/info",array("id"=>$zml["id"]));';
		$str .= '?>';	 
		$str .= $this->tpl->parse($content);
		$str .='<?php endforeach ?>'; 
		return $str;
	}
    /**
     * newsnav 分类列表
     */
    public function _navlist($attr,$content){
        $str='<?php ';
        $where = "array('status'=>1)";;
        if ($attr['pid'] or $attr['pid'] == '0') {
            $where = 'array("pid"=>array("in","'.$attr["pid"].'"))';
        }
        if ($attr['num']) {
            $limit = $attr['num'];
        }
        $order = !empty($attr['order'])? $attr['order'] : 'id desc';
        $str .= '$info = M("news_category")->where('.$where.')->limit("'.$limit.'")->order("'.$order.'")->select();';
        $str .= 'foreach ($info as $i=>$zml):';
        $str .= '$zml["url"]='.'U("news/index",array("id"=>$zml["id"]));';
        $str .= '?>';    
        $str .= $this->tpl->parse($content);
        $str .='<?php endforeach ?>'; 
        return $str;
    }
    /**
     * nav 导航
     */
    public function _nav($attr,$content){
        $str='<?php ';
        $num = $attr['num'];
        $status = $attr['status'];
        $pid = $attr['pid'];
        $type = $attr['type'];

        //状态条件
        if($status){
            $w = ($w) ? $w.' AND status ='.$status : 'status ='.$status;
        }
        //状态条件
        if($type){
            $w = ($w) ? $w.' AND type ='.$type : 'type ='.$type;
        }
        //分类条件
        if(isset($pid)){
            $w = ($w) ? $w.' AND pid ='.$pid : 'pid ='.$pid;
        }
        if ($num) {
            $limit = $num;
        }
        $str .= '$info = D("Admin/Nav")->loadList("'.$w.'","'.$limit.'");';
        $str .= 'foreach ($info as $i=>$zml):';
        $str .= '$nav2=D("Admin/Nav")->loadList(array("pid"=>$zml["id"]));';
        $str .= '?>';    
        $str .= $this->tpl->parse($content);
        $str .='<?php endforeach ?>'; 
        return $str;
    }
    /**
     * itemlist 项目列表
     */
    public function _itemlist($attr,$content){
        $limit = $attr['num'] ? $attr['num'] : 10;
        $order = $attr['order'] ? $attr['order'] : 'sort desc'; //默认sort字段排序
        $cid = $attr['cid'];
        $end = $attr['end'];
        $progress = $attr['progress'];
        $attribute = $attr['attr'];
        $status = $attr['status'];
        //数量
        if ($attr['num']) {
            $limit = $attr['num'];
        }
        //状态条件
        if($status){
            $w = ($w) ? $w.' AND a.status ='.$status : 'a.status ='.$status;
        }
        //分类条件
        if($cid){
            $w = ($w) ? $w.' AND a.cid ='.$cid : 'a.cid ='.$cid;
        }
        //进度条件
        if ($progress) {
            $w = ($w) ? $w.' AND a.progress ='.$progress : 'a.progress ='.$progress;
        }
        //属性条件
        if($attr == 1){
            $w = ($w) ? $w.' AND a.attr ='.$attribute : 'a.attr ='.$attribute;
        }
        //项目是否加入结束条件 end值为1 表示加入where判断
        if($end == 1){
            $w = ($w) ? $w.' AND a.end_time >'.time() : 'a.end_time >'.time();
        }
        //不显示删除数据
        $w = ($w) ? $w.' AND a.isdel = 0' : 'a.isdel = 0';    
        $str='<?php ';

        $str .= '$itemList = D("User/item")->loadList("'.$w.'","'.$limit.'","'.$order.'");';
        $str .= 'foreach ($itemList as $i=>$zml):';
        $str .= '$zml["url"]=U("Item/info",array("id"=>$zml["id"]));';
        $str .= '$zml["last_time"]=gettime($zml["end_time"]-time());';
        $str .= '$zml["success_rate"]=D("User/ItemWithOrder")->successRate($zml["id"]);';
        $str .= '$zml["count_money"]=D("User/ItemWithOrder")->countMoney($zml["id"]);';
        $str .= '?>';    
        $str .= $this->tpl->parse($content);
        $str .='<?php endforeach ?>'; 
        return $str;
    }
	/**
	 * 通用循环标签
     * zmllist 标签解析 循环输出数据集
     */
    public function _zmllist($tag,$content) {
        $name  =    $tag['name'];
        $id    =    $tag['id'];
        $empty =    isset($tag['empty'])?$tag['empty']:'';
        $key   =    !empty($tag['key'])?$tag['key']:'i';
        $mod   =    isset($tag['mod'])?$tag['mod']:'2';
        // 允许使用函数设定数据集 <volist name=":fun('arg')" id="vo">{$vo.name}</volist>
        $parseStr   =  '<?php ';
        if(0===strpos($name,':')) {
            $parseStr   .= '$_result='.substr($name,1).';';
            $name   = '$_result';
        }else{
            $name   = $this->autoBuildVar($name);
        }
        $parseStr  .=  'if(is_array('.$name.')): $'.$key.' = 0;';
        if(isset($tag['length']) && '' !=$tag['length'] ) {
            $parseStr  .= ' $__LIST__ = array_slice('.$name.','.$tag['offset'].','.$tag['length'].',true);';
        }elseif(isset($tag['offset'])  && '' !=$tag['offset']){
            $parseStr  .= ' $__LIST__ = array_slice('.$name.','.$tag['offset'].',null,true);';
        }else{
            $parseStr .= ' $__LIST__ = '.$name.';';
        }
        $parseStr .= 'if( count($__LIST__)==0 ) : echo "'.$empty.'" ;';
        $parseStr .= 'else: ';
        $parseStr .= 'foreach($__LIST__ as $key=>$'.$id.'): ';
        $parseStr .= '$mod = ($'.$key.' % '.$mod.' );';
        $parseStr .= '++$'.$key.';?>';
        $parseStr .= $this->tpl->parse($content);
        $parseStr .= '<?php endforeach; endif; else: echo "'.$empty.'" ;endif; ?>';
        if(!empty($parseStr)) {
            return $parseStr;
        }
        return ;
    }
}
?>