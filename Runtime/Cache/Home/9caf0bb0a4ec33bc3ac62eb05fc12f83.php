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
    <script src="/Public/lib/layer/layer.js"></script>
</head>
<body style="background:#f0f0f0">
    <!-- 导航 -->
    <style>

.mynav li{width: 80px;height: 36px;line-height: 36px;float: left;text-align: center;margin-right: 5px;border-radius: 3px;position: relative;display: block;}

.mynav .active{background-color: #ea544a;}

.mynav .active a{color: #fff;}

</style>

<script type="text/javascript"> 

var Sys = {};

        var ua = navigator.userAgent.toLowerCase();

        if (window.ActiveXObject){

            Sys.ie = ua.match(/msie ([\d.]+)/)[1]

            if (Sys.ie<=7){

            alert('你目前的IE版本为'+Sys.ie+'版本太低，请升级！');location.href="http://windows.microsoft.com/zh-CN/internet-explorer/downloads/ie";

            }

        }

</script> 

<div class="x12 margin-big-bottom text-little padding-small bg-black text-pale" id="top">

    <div class="container">

        <span class="x2">欢迎来到芝麻乐开源众筹系统！</span>

        <span class="x10 text-right text-pale"><?php if(session('user.uin')): ?><a href="<?php echo U('User/Index/index');?>" class="text-pale"><?php echo session('user.phone');?> 进入用户中心</a> | <a href="<?php echo U('/User/Login/logout');?>" class="text-pale">退出</a><?php else: ?></a><a href="<?php echo U('User/Login/index');?>" class="text-pale">登录</a> | <a href="<?php echo U('User/Login/reg');?>" class="text-pale">注册</a><?php endif; ?></span>

    </div>

</div>

<div class="container-layout  bg-white">

    <div class="container padding-big-top padding-big-bottom">

        <div class="x12">

            <div class="x2">

                <a href="/"><img src="/uploads/1/20151017/zmlcms_1445061661767.png" alt="芝麻乐开源众筹系统"  class="img-responsive"></a>

            </div>

            <div class="x10 padding-top">

                <div class="x8">

                    <ul class="mynav text-big float-right padding-big-right">

                        <li <?php if(CONTROLLER_NAME== 'Index'): ?>class="active"<?php endif; ?>><a href="/">首页</a></li>

                        <li <?php if(CONTROLLER_NAME== 'Item'): ?>class="active"<?php endif; ?>><a href="<?php echo U('Home/Item/index');?>">项目</a></li>

                        <!--             <li><a href="#">动态</a></li> -->

                        <li <?php if(CONTROLLER_NAME== 'News'): ?>class="active"<?php endif; ?>><a href="<?php echo U('Home/News/index');?>">新闻</a></li>

                    </ul>

                </div>

                <div class="x4">

                    <form id="form" action="<?php echo U('Home/Item/index');?>" method="get">

                        <div class="input-group padding-little-top">
                            <div class="field">

                                <input type="text" class="input border-red" name="search" size="30" placeholder="项目名称"/>
                            </div>

                            <span class="addbtn"><button type="submit" class="button bg-red">搜!</button></span>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

function select (){

    var content = $('input[name="search"]');

    if(content.val()==''){

        layer.tips("请填写搜索内容！","#content",{

            tips: 1

        })

        content.focus();

        return false

    } 
    window.location.href="/index.php/Home/Item/index/search/"+content.val()
}

</script>
    <!-- banner -->
    <div class="banner">
        <div class="carousel">
            <?php $info = M("ad")->where("type =1")->select();foreach ($info as $i => $zml): ?><div class="item">
                    <a href="<?php echo ($zml["url"]); ?>"><img src="<?php echo ($zml["img"]); ?>" alt="<?php echo ($zml["name"]); ?>"></a>
                </div><?php endforeach ?>
        </div>
    </div>
    <!-- box1  -->
    <div class="container margin-big-top">
        <!-- 项目status -->
        <?php $itemList = D("User/item")->loadList("a.status =1 AND a.isdel = 0","2","time desc");foreach ($itemList as $i=>$zml):$zml["url"]=U("Item/info",array("id"=>$zml["id"]));$zml["last_time"]=gettime($zml["end_time"]-time());$zml["success_rate"]=D("User/ItemWithOrder")->successRate($zml["id"]);$zml["count_money"]=D("User/ItemWithOrder")->countMoney($zml["id"]);?><div class=" border border-back x12 margin-big-top bg-white">
                <div class="x8">
                    <img src="<?php echo ($zml["cover_img"]); ?>" alt="<?php echo ($zml["name"]); ?>" class="x12" height="340">
                </div>
                <div class="x4 padding-large">
                    <h1><?php echo ($zml["name"]); ?></h1>
                    <span class="x12 margin-top text-small text-gray height-small" style="height: 65px;"><?php echo ($zml["desc"]); ?></span>
                    <div class="float-right text-right" style="margin-top:-130px;margin-right:-40px;position: relative;">
                        <span class="button bg-dot radius-none"><?php echo ($zml["progress_name"]); ?></span>
                        <i class="status-icons" style="right: 0px;"></i>
                    </div>
                    <span class="x12 margin-big-top">
                        <div class="progress progress-striped active">
                            <div class="progress-bar bg-yellow" style="width:<?php echo ($zml["success_rate"]); ?>%;"></div>
                        </div>
                        <span class="x8 margin-big-top height-big">
                            <span class="x12"><span class="x4 text-right">目标金额：</span><span class="icon-cny text-red"></span><span class="text-red"> <?php echo ($zml["raising_money"]); ?></span></span>
                            <span class="x12"><span class="x4 text-right">已筹集：</span><span class="icon-cny text-red"></span><span class="text-red"> <?php echo ($zml["count_money"]); ?></span></span>
                            <span class="x12"><span class="x4 text-right">最低出资：</span><span class="icon-cny text-red"></span><span class="text-red"> <?php echo ($zml["lowest_money"]); ?></span></span>
                            <span class="x12"><span class="x4 text-right">剩余时间：</span><span class="text-yellow"> <?php echo ($zml["last_time"]); ?></span></span>
                        </span>
                        <span class="x4 margin-big-top padding">
                            <div class="x12">
                                <span class="">完成<span class="text-red text-big"> <?php echo ($zml["success_rate"]); ?>%</span></span>
                            </div>
                            <div class="x12 margin-big-top"><a href="<?php echo ($zml["url"]); ?>" class="button bg-yellow">了解更多</a></div>
                        </span>
                    </span>
                </div>
            </div><?php endforeach ?>
        <!-- 项目end -->
    </div>
    <!-- box2 -->
    <div class="container margin-big-top">
        <!-- 项目  -->
        <div class="x8 padding-big-right">
            <span class="text-large padding-left"><strong>路演中</strong><span class="text-small float-right padding-big-right">更多..</span></span>
            <div class="margin-small-top">
                <?php $itemList = D("User/item")->loadList("a.status =1 AND a.progress =1 AND a.end_time >1468921930 AND a.isdel = 0","10","sort desc");foreach ($itemList as $i=>$zml):$zml["url"]=U("Item/info",array("id"=>$zml["id"]));$zml["last_time"]=gettime($zml["end_time"]-time());$zml["success_rate"]=D("User/ItemWithOrder")->successRate($zml["id"]);$zml["count_money"]=D("User/ItemWithOrder")->countMoney($zml["id"]);?><div class="x4 padding-right padding-top">
                        <div class="x12 bg-white border border-back padding-big">
                            <h1><?php echo ($zml["name"]); ?></h1>
                            <span class="x12 text-small margin-top text-gray" style="height:60px"><?php echo (substr($zml["name"],0,34)); ?></span>
                            <img src="<?php echo ($zml["cover_img"]); ?>" alt="<?php echo ($zml["name"]); ?>" class="x12 margin-top" style="height:91px">
                            <div class="x12 margin-top">
                                <div class="progress progress-small progress-striped active margin-bottom">
                                    <div class="progress-bar bg-yellow" style="width:50%;"></div>
                                </div>
                                <div class="x6 text-red text-big height-big">进度：<?php echo ($zml["success_rate"]); ?>%</div>
                                <div class="x6"><a href="<?php echo ($zml["url"]); ?>" class="button bg-yellow">开始认投</a></div>
                            </div>
                        </div>
                    </div><?php endforeach ?>
            </div>
        </div>
        <!-- 新闻公告 -->
        <div class="x4">
            <span class="x12 text-large padding-left margin-small-bottom"><strong>新闻公告</strong></span>
            <div class="x12 padding-big bg-white margin-top text-small">
                <?php $info = D("Home/News")->loadList("a.status =1 AND a.cid In(4)","10","a.time desc");foreach ($info as $i=>$zml):$zml["url"]=U("news/info",array("id"=>$zml["id"]));?><a href="<?php echo ($zml["url"]); ?>" class="x12 padding-top">
                        <span class="x9" style="height:18px;overflow:hidden;"><?php echo ($zml["title"]); ?></span><span class="x3 text-right"><?php echo (date("m-d",$zml["time"])); ?></span>
                    </a><?php endforeach ?>
            </div>
        </div>
    </div>
    <!-- 底部 -->
    <div class="container-layout text-gray  bg-black bg-inverse padding-big-top padding-big-bottom margin-big-top" >
    <div class="container text-small">
        <div class="x10 height-big margin-bottom">
			<?php $info = D("Admin/Nav")->loadList("status =1 AND type =2 AND pid =0","");foreach ($info as $i=>$zml):$nav2=D("Admin/Nav")->loadList(array("pid"=>$zml["id"]));?><a href="<?php echo ($zml["url"]); ?>" class="padding-big-right text-gray"><?php echo ($zml["name"]); ?></a><?php endforeach ?>
        </div>
       
        <div class="x12 text-left text-little">版权所有 © 芝麻乐开源众筹系统 All Rights Reserved，赣ICP备：380959609 <a href="http://www.zhimale.com">芝麻乐</a>版权所有</div>
    </div>
</div>
<div class="fixed-bottom-right margin-right" style="width:40px;right:10px;z-index: 99999;">
<!--     <div class="x12 txt radius-small bg-red margin-small-bottom icon-qrcode text-large"></div>
    <div class="x12 txt radius-small bg-red margin-small-bottom icon-pencil-square-o text-large"></div>
    <div class="x12 txt radius-small bg-red margin-small-bottom icon-question text-large"></div> -->
    <a href="javascript:;"  onclick="slideFunction('top');"><div class="txt radius-small bg-red margin-small-bottom icon-arrow-up text-large"></div></a>
</div>

</body>
</html>