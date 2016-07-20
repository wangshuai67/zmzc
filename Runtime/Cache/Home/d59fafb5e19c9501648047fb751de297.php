<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <title>芝麻乐开源众筹系统</title>
    <meta name="keywords" content="芝麻乐众筹管理后台"/>
    <meta name="description" content="芝麻乐众筹管理后台"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/css/pintuer.css">
    <link rel="stylesheet" href="/Template/Home/default/css/zml.css">
    <script src="/Public/js/jquery-1.8.3.min.js"></script>
    <script src="/Public/js/pintuer.js"></script>
    <script src="/Public/js/respond.js"></script>
    <script src="/Public/js/TouchSlide.1.1.source.js"></script>
    <script src="/Public/lib/layer_m/layer.m.js"></script>
</head>
<body class="bg">
    <div class="x12">
        <!-- 引入头部文件 -->
        <!-- 头部 -->
<div class="x12 bg-white padding-small">
    <!-- logo部分 -->
    <div class="x4 padding-left">
        <a href="/"><span class="text-red" style="font-size: 22px;">芝麻乐</span></a>
    </div>
    <!-- 搜索 -->
    <div class="x8">
        <form id="form">
            <div class="input-group padding-little-top">
                <input type="text" class="input input-small border-red text-small" name="keywords" size="30" placeholder="项目名称"  datatype="*">
                <span class="addbtn"><button type="submit" class="button bg-red button-small height-little" onClick="select()">搜!</button></span>
            </div>
        </form>
  </div>
</div>
<script type="text/javascript" src="/Public/lib/validform/Validform.min.js"></script>
<script>
function showmsg(msg) {
    layer.open({
        content: msg,
        time: 0.5
    });
}
function select (){
    // 关闭验证表单成功提示
    $.Tipmsg.r = null;
    // Validform 是验证方法
    $("#form").Validform({
        tiptype: function(msg) {
          showmsg(msg)
        }
  })
}
</script>
        <!-- 幻灯开始 -->
        <div class="x12 margin-big-bottom bg-white margin-top">
            <div id="focus" class="focus">
                <div class="hd">
                    <ul></ul>
                </div>
                <div class="bd">
                    <ul class="list-unstyle">
                        <?php $info = M("ad")->where("type =1")->select();foreach ($info as $i => $zml): ?><li><a href="<?php echo ($zml["url"]); ?>"><img _src="<?php echo cut_image($zml['img'],320,120);?>" src="<?php echo cut_image($zml['img'],320,120);?>" class="img-responsive"/></a></li><?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            TouchSlide({ 
                slideCell:"#focus",
                titCell:".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
                mainCell:".bd ul", 
                effect:"left", 
                autoPlay:true,//自动播放
                autoPage:true, //自动分页
                switchLoad:"_src" //切换加载，真实图片路径为"_src" 
            });
        </script>
        <!-- 幻灯结束 -->
        <!-- 项目列表 -->
        <div class="x12 padding-small">
            <span class="x3 bg-sub text-white padding-small text-center">预热...</span>
            <hr class="bg-sub" style="margin:0"/>
            <!-- 循环开始 -->
            <?php $itemList = D("User/item")->loadList("a.status =1 AND a.progress =1 AND a.end_time >1468921954 AND a.isdel = 0","10","sort desc");foreach ($itemList as $i=>$zml):$zml["url"]=U("Item/info",array("id"=>$zml["id"]));$zml["last_time"]=gettime($zml["end_time"]-time());$zml["success_rate"]=D("User/ItemWithOrder")->successRate($zml["id"]);$zml["count_money"]=D("User/ItemWithOrder")->countMoney($zml["id"]);?><div class="x12 bg-white padding margin-top">
                    <span class="x12 margin-small-bottom">
                        <h4><?php echo ($zml["name"]); ?></h4>
                    </span>
                    <a href="<?php echo ($zml["url"]); ?>">
                        <img src="<?php echo cut_image($zml['cover_img'],580,270);?>" class="img-responsive"/>
                    </a>
                    <span class="x12 margin-top">
                        <div class="progress progress-small progress-striped active">
                            <div class="progress-bar bg-sub" style="width:50%;"></div>
                        </div>
                    </span>
                    <span class="x12 margin-top text-small padding-bottom height">
                        <span class="x3">
                            <span class="x6">完成:</span>
                            <span class="x6 text-red">90%</span>
                        </span>
                        <span class="x6">
                            <span class="x4">目标:</span>
                            <span class="x8 text-red"><?php echo ($zml["raising_money"]); ?></span>
                        </span>
                        <span class="x3" style="margin-top:-6px">
                            <a href="<?php echo ($zml["url"]); ?>" class="button button-small bg-dot fadein-right">支持</a>
                        </span>
                    </span>
                </div><?php endforeach ?>
            <!-- 循环结束 -->
        </div>
    </div>
    <div class="x12" style="height:50px;"></div>
    <div class="x12 text-center text-white fixed-bottom">
    	<a href="/" class="text-white"><span class="x3 bg-red padding"><span class="icon-home padding-small-right"></span>首页</span></a>
    	<a href="<?php echo U('Home/Item/index');?>" class="text-white"><span class="x3 bg-red padding border-left"><span class="icon-stack-exchange padding-small-right"></span>项目</span></a>
        <a href="<?php echo U('Home/News/index');?>" class="text-white"><span class="x3 bg-red padding border-left"><span class="icon-comments-o padding-small-right"></span>动态</span></a>
        <a href="<?php echo U('User/Index/index');?>" class="text-white"><span class="x3 bg-red padding border-left"><span class="icon-user padding-small-right"></span>我</span></a>
    </div>
</body>
</html>