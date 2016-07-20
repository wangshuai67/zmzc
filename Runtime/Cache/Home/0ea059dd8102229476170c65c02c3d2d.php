<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <title><?php echo ($zml["title"]); ?> - 芝麻乐开源众筹系统</title>
    <meta name="keywords" content="芝麻乐众筹管理后台"/>
    <meta name="description" content="芝麻乐众筹管理后台"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/css/pintuer.css">
    <link rel="stylesheet" href="/Template/Home/default/css/zml.css">
    <script src="/Public/js/jquery-1.8.3.min.js"></script>
    <script src="/Public/js/pintuer.js"></script>
    <script src="/Public/js/respond.js"></script>
    <script src="/Public/js/TouchSlide.1.1.source.js"></script>
    <script src="/Public/layer_m/layer.m.js"></script>
</head>
<body>
    <div class="x12">
        <style>
        .tab .tab-nav li {line-height:30px;border-radius:inherit;padding: 8px 40px;}
        .tab .tab-nav li {background-color: #fff;border-radius: inherit;}
        .tab .tab-nav .active{background-color: #EA544A; }
        .tab .tab-nav .active a{color: #fff;}
        </style>
        <div class="tab">
            <div class="x12">
                <span class="x12 bg-red text-white padding text-center height-big"><h5>全新互联网金融模式——人人都可成为股东。</h5></span>
                <span class="text-small text-gray bg-white padding float-right" style="margin-top:9px">发布时间：<?php echo (date("Y-m-d",$zml["time"])); ?></span>
            </div>
            <div class="x12 tab-body bg-white">
                <!-- 新闻列表 -->
                <div class="tab-panel active" id="tab-a">

                    <!-- 新闻内页 -->
                    <div class="x12 padding">
                        <?php echo ($zml["content"]); ?>
                    </div>
                </div>
            </div>
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