<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
	<title><?php echo ($title); ?></title>
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
<body class="bg">
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
	<!-- 内容 -->
	<div class="container">
		<!-- 面包屑 -->
		<?php echo ($bread); ?>
		<div class="x12 margin-top">
			<!-- 左侧主要内容 -->
			<div class="x8 padding-right">
				<style>
				.tab .tab-nav li a{line-height:30px;border-radius:inherit;padding: 8px 40px;}
				.tab .tab-nav li {background-color: #fff;border-radius: inherit;}
				.tab .tab-nav .active{background-color: #EA544A; }
				.tab .tab-nav .active a{color: #fff;}
				</style>
				<div class="tab">
					<div class="tab-head">
						<ul class="tab-nav">
							<li <?php if($_GET['id'] == ''): ?>class="active"<?php endif; ?>><a href="/News">全部</a></li>
							<?php $info = M("news_category")->where(array('status'=>1))->limit("")->order("id desc")->select();foreach ($info as $i=>$zml):$zml["url"]=U("news/index",array("id"=>$zml["id"]));?><li <?php if($_GET['id'] == $zml['id']): ?>class="active"<?php endif; ?>><a href="<?php echo ($zml["url"]); ?>"><?php echo ($zml["name"]); ?></a></li><?php endforeach ?>
						</ul>
					</div>
					<div class="x12 tab-body bg-white padding-big">
						<!-- 新闻列表 -->
						<div class="tab-panel active" id="tab-a">
							<!-- 列表循环 -->
							<?php if(is_array($newslist)): $i = 0; $__LIST__ = $newslist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zml): $mod = ($i % 2 );++$i;?><div class="x12">
									<span class="x12 padding-big border-bottom">
										<a href="<?php echo ($zml["url"]); ?>">
											<span class="x10"><?php echo ($zml["title"]); ?></span>
											<span class="x2"><?php echo (date("m-d",$zml["time"])); ?></span>
										</a>
									</span>
								</div><?php endforeach; endif; else: echo "" ;endif; ?>
							
							<!-- 分页 -->
							<div class="x12 margin-big-top text-center">
								<ul class="pagination border-red pagination-small">
			                        <?php echo ($page); ?>
			                    </ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 右侧 -->
			<div class="x4 padding-left ">
	<div class="x12 bg-white margin-big-top padding-big">
		<h1>推荐项目</h1>
		<?php $itemList = D("User/item")->loadList("a.status =1 AND a.end_time >1468915416 AND a.isdel = 0","10","sort desc");foreach ($itemList as $i=>$zml):$zml["url"]=U("Item/info",array("id"=>$zml["id"]));$zml["last_time"]=gettime($zml["end_time"]-time());$zml["success_rate"]=D("User/ItemWithOrder")->successRate($zml["id"]);$zml["count_money"]=D("User/ItemWithOrder")->countMoney($zml["id"]);?><div class="x12 margin-big-top padding-bottom border-bottom">
				<img src="<?php echo ($zml["cover_img"]); ?>" alt="<?php echo ($zml["name"]); ?>" class="x12">
				<span class="x12  margin-top">
					<span class="x6">
						<span class="text-big">已募集</span>
						<span class="text-large text-red"><?php echo ($zml["success_rate"]); ?>%</span>
					</span>
					<span class="x6">
						<div class="x12 text-right"><a href="<?php echo ($zml["url"]); ?>" class="button bg-dot">开始认投</a></div>
					</span>
				</span>
			</div><?php endforeach ?>
	</div>
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