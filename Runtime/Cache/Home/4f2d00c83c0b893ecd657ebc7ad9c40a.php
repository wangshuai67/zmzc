<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <title><?php echo ($title); ?> - 芝麻乐开源众筹系统</title>
    <meta name="keywords" content="<?php echo ($keywords); ?>"/>
    <meta name="description" content="<?php echo ($description); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/css/pintuer.css">
    <link rel="stylesheet" href="/Template/Home/default/css/zml.css">
    <script src="/Public/js/jquery-1.8.3.min.js"></script>
    <script src="/Public/js/pintuer.js"></script>
    <script src="/Public/js/respond.js"></script>
    <script src="/Public/js/TouchSlide.1.1.source.js"></script>
    <script src="/Public/lib/layer_m/layer.m.js"></script>
</head>
<body>
    <div class="x12 padding">
        <!-- 新闻列表 -->
        <style>
        .tab .tab-nav li a{line-height:30px;border-radius:inherit;padding: 6px 10px;}
        .tab .tab-nav li {background-color: #fff;border-radius: inherit;}
        .tab .tab-nav .active{background-color: #EA544A; }
        .tab .tab-nav .active a{color: #fff;}
        .tab-panel img{max-width:100%}
        </style>
        <div class="x12 tab text-small margin-top">
        <div class="tab">
            <ul class="tab-nav" style="padding-left:0px;">
                <?php $info = M("news_category")->where(array('status'=>1))->limit("")->order("id desc")->select();foreach ($info as $i=>$zml):$zml["url"]=U("news/index",array("id"=>$zml["id"]));?><li <?php if($_GET['id'] == $zml['id']): ?>class="active"<?php endif; ?>><a href="<?php echo ($zml["url"]); ?>"><?php echo ($zml["name"]); ?></a></li><?php endforeach ?>
            </ul>
        </div>
        <!-- 新闻列表 -->
        <div class="x12 tab-body bg-white padding">
            <div class="tab-panel active" id="tab-a">
                <!-- 列表循环开始 -->
                <?php if(is_array($newslist)): $i = 0; $__LIST__ = $newslist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zml): $mod = ($i % 2 );++$i;?><div class="x12">
                        <span class="x12 padding-top padding-bottom border-bottom">
                            <a href="<?php echo ($zml["url"]); ?>">
                                <span class="x10"><?php echo ($zml["title"]); ?></span>
                                <span class="x2"><?php echo (date("m-d",$zml["time"])); ?></span>
                            </a>
                        </span>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                <!-- 列表循环结束 -->
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
    <div class="x12" style="height:50px;"></div>
    <div class="x12 text-center text-white fixed-bottom">
    	<a href="/" class="text-white"><span class="x3 bg-red padding"><span class="icon-home padding-small-right"></span>首页</span></a>
    	<a href="<?php echo U('Home/Item/index');?>" class="text-white"><span class="x3 bg-red padding border-left"><span class="icon-stack-exchange padding-small-right"></span>项目</span></a>
        <a href="<?php echo U('Home/News/index');?>" class="text-white"><span class="x3 bg-red padding border-left"><span class="icon-comments-o padding-small-right"></span>动态</span></a>
        <a href="<?php echo U('User/Index/index');?>" class="text-white"><span class="x3 bg-red padding border-left"><span class="icon-user padding-small-right"></span>我</span></a>
    </div>
</body>
</html>