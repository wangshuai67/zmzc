<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <title>项目列表 - 芝麻乐开源众筹系统</title>
    <meta name="keywords" content="芝麻乐众筹管理后台"/>
    <meta name="description" content="芝麻乐众筹管理后台"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/css/pintuer.css">
    <link rel="stylesheet" href="/Template/Home/default/css/zml.css">
    <script src="/Public/js/jquery-1.8.3.min.js"></script>
    <script src="/Public/js/pintuer.js"></script>
    <script src="/Public/js/respond.js"></script>
    <script src="/Public/js/goTop.js"></script>
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
        <!-- 类别 -->
        <div class="x12 bg-white padding margin-top">
            <span class="x2 text-right">类别：</span>
            <span class="x10 text-small height-small">
                <?php if(is_array($categorylist)): $i = 0; $__LIST__ = $categorylist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zml): $mod = ($i % 2 );++$i;?><a href="<?php echo ($zml["url"]); ?>" class="text-gray"><span class="padding-left"><?php echo ($zml["name"]); ?></span></a><?php endforeach; endif; else: echo "" ;endif; ?>
            </span>
        </div>
        <div class="x12  padding-small">
        <!-- 项目循环开始 -->
        <?php if(is_array($itemlist)): $i = 0; $__LIST__ = $itemlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zml): $mod = ($i % 2 );++$i;?><div class="x12 bg-white padding margin-top">
                <span class="x12 margin-small-bottom">
                    <h4><?php echo ($zml["name"]); ?></h4>
                </span>
                <a href="<?php echo ($zml["url"]); ?>">
                    <img src="<?php echo ($zml["cover_img"]); ?>" alt="<?php echo ($zml["name"]); ?>" class="img-responsive"/>
                </a>
                <span class="x12 margin-top">
                    <div class="progress progress-small progress-striped active">
                        <div class="progress-bar bg-sub" style="width:<?php echo ($zml["success_rate"]); ?>%;"></div>
                    </div>
                </span>
                <span class="x12 margin-top text-small padding-bottom height">
                    <span class="x3">
                        <span class="x6">完成:</span>
                        <span class="x6 text-red"><?php echo ($zml["success_rate"]); ?>%</span>
                    </span>
                    <span class="x6">
                        <span class="x4">目标:</span>
                        <span class="x8 text-red"><?php echo ($zml["raising_money"]); ?></span>
                    </span>
                    <span class="x3" style="margin-top:-6px">
                        <a href="<?php echo ($zml["url"]); ?>" class="button button-small bg-dot fadein-right">支持</a>
                    </span>
                </span>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
            <!-- 项目循环结束 -->
        </div>
    <div class="x12 text-center padding"><ul class="pagination border-red pagination-small"><?php echo ($page); ?></ul></div>
    </div>
    <!-- 引入底部文件 -->
    <div class="x12" style="height:50px;"></div>
    <div class="x12 text-center text-white fixed-bottom">
    	<a href="/" class="text-white"><span class="x3 bg-red padding"><span class="icon-home padding-small-right"></span>首页</span></a>
    	<a href="<?php echo U('Home/Item/index');?>" class="text-white"><span class="x3 bg-red padding border-left"><span class="icon-stack-exchange padding-small-right"></span>项目</span></a>
        <a href="<?php echo U('Home/News/index');?>" class="text-white"><span class="x3 bg-red padding border-left"><span class="icon-comments-o padding-small-right"></span>动态</span></a>
        <a href="<?php echo U('User/Index/index');?>" class="text-white"><span class="x3 bg-red padding border-left"><span class="icon-user padding-small-right"></span>我</span></a>
    </div>
</body>
</html>