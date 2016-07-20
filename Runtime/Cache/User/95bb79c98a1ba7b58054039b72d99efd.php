<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <title>会员中心 - 芝麻乐开源众筹系统</title>
    <meta name="keywords" content="芝麻乐众筹管理后台"/>
    <meta name="description" content="芝麻乐众筹管理后台"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/css/pintuer.css">
    <script src="/Public/js/jquery-1.8.3.min.js"></script>
    <script src="/Public/js/pintuer.js"></script>
    <script src="/Public/js/respond.js"></script>
    <script src="/Public/js/goTop.js"></script>
    <script src="/Public/js/TouchSlide.1.1.source.js"></script>
    <!-- <script src="/Public/lib/layer_m/layer.m.js"></script>-->
    <script src="/Public/lib/layer/layer.js"></script>
</head>
<body class="x12 bg">
    <div class="x12 bg-white padding-small margin-top">
        <span class="x3">
            <img src="<?php if($user['header']): echo cut_image($user['header'],'50','50'); else: ?>/Template/User/wap/Public/img/user-logo.jpg<?php endif; ?>" class="header radius-circle"  width="50" height="50">
        </span>
        <span class="x9">
            <span class="x6 margin-top"><?php echo ($phone); ?></span>
            <span class="x6 margin-top text-small text-right text-red">￥ <?php echo ($money); ?>元</span>
        </span>
    </div>
    <a href="<?php echo U('Investor/collect_item');?>" class="x12 bg-white padding-small margin-top">
        <span class="x11 padding text-small"><i class="icon-unlink text-yellow"></i> 我收藏的项目</span>
        <span class="x1 padding icon-angle-right"></span>
    </a>
    <a href="<?php echo U('Investor/with_item');?>" class="x12 bg-white padding-small border-top">
        <span class="x11 padding text-small"><i class="icon-plus text-yellow"></i> 我投资的项目</span>
        <span class="x1 padding icon-angle-right"></span>
    </a>
    <a href="<?php echo U('Investor/interview_item');?>" class="x12 bg-white padding-small border-top">
        <span class="x11 padding text-small"><i class="icon-bullhorn text-yellow"></i> 我约谈的项目</span>
        <span class="x1 padding icon-angle-right"></span>
    </a>
    <a href="<?php echo U('Investor/lead');?>" class="x12 bg-white padding-small border-top">
        <span class="x11 padding text-small"><i class="icon-magnet text-yellow"></i> 我领投的项目</span>
        <span class="x1 padding icon-angle-right"></span>
    </a>
    <a href="<?php echo U('Funds/money_details');?>" class="x12 bg-white padding-small margin-top">
        <span class="x11 padding text-small"><i class="icon-cny text-yellow"></i> 资金明细</span>
        <span class="x1 padding icon-angle-right"></span>
    </a>
    <a href="<?php echo U('Dolog/index');?>" class="x12 bg-white padding-small margin-top">
        <span class="x11 padding text-small"><i class="icon-bell-o text-yellow"></i> 消息中心<span class="badge bg-dot float-right"><?php echo doLog();?>条未读</span></span>
        <span class="x1 padding icon-angle-right"></span>
    </a>
    <a href="<?php echo U('User/Login/logout');?>" class="x12 bg-white padding-small border-top">
        <span class="x11 padding text-small"><i class="icon-power-off text-yellow"></i> 退出登录</span>
        <span class="x1 padding icon-angle-right"></span>
    </a>
    <!-- 底部导航 -->
        <div class="x12" style="height:50px;"></div>
    <div class="x12 text-center text-white fixed-bottom">
        <a href="/" class="x3 bg-red text-white padding"><span class="icon-home padding-small-right"></span>首页</a>
        <a href="/Item" class="x3 bg-red text-white padding border-left border-right"><span class="icon-legal padding-small-right"></span>项目</a>
        <a href="/News" class="x3 bg-red text-white padding border-left border-right"><span class="icon-legal padding-small-right"></span>动态</a>
        <a href="/User" class="x3 bg-red padding text-white"><span class="icon-user padding-small-right"></span>我</a>
    </div>
    
</body>
</html>