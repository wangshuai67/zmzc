<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>安装<?php echo C('INSTALL_PRODUCT_NAME');?>－<?php echo ($meta_title); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <link rel="stylesheet" type="text/css" href="/Public/css/pintuer.css">
    <script type="text/javascript" src="/Public/js/jquery-1.8.3.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="/Public/lib/layer/layer.js" charset="utf-8"></script>
 
    
</head>
<body style="background-color: #f6f6f6;">
	<div class="x12 bg-white border-bottom">
		<div class="container">
			<div class="height-large">
			<span><?php echo C('INSTALL_PRODUCT_NAME');?></span>
			</div>
		</div>
	</div>
    <div class="container">
        <div class="x12 padding bg-white margin-top">
            
<div class="step">
		 <div class="step-bar complete " style="width:20%;"><span class="step-point icon-check"></span><span class="step-text">安装协议</span></span></div>
		 <div class="step-bar complete" style="width:20%;"><span class="step-point">2</span><span class="step-text">环境检测</span></div>
		 <div class="step-bar complete" style="width:20%;"><span class="step-point">3</span><span class="step-text">参数设置</span></div>
		 <div class="step-bar complete" style="width:20%;"><span class="step-point">4</span><span class="step-text">开始安装</span></div>
		 <div class="step-bar active" style="width:20%;"><span class="step-point">5</span><span class="step-text">完成安装</span></div>
	</div>
    <div class="x12">
        <div class="panel">
            <div class="panel-head">
                <span>恭喜您，<?php echo C('INSTALL_PRODUCT_NAME');?>安装完成！</span>
            </div>
            <div class="panel-body">
				
				<div class="keypoint bg-blue bg-inverse radius text-center">
					<h1 class=" text-white">恭喜您，<?php echo C('INSTALL_PRODUCT_NAME');?>安装完成！</h1>
					<p class="text-white">默认后台账号：admin   密码：admin123  请进入后台及时修改账号密码</p>
					<p>
						 <a class="button bg-green" target="_blank" href="<?php echo U('Admin/Index/index');?>">登录后台</a>
						 <a class="button bg-red" target="_blank" href="/">访问首页</a>
                    </p>
				</div>
            </div>
            <div class="panel-foot">
                <span>版权所有 (c) 2014－<?php echo date("Y",time()); echo C('INSTALL_COMPANY_NAME');?> 保留所有权利。</span>
            </div>
        </div>
    </div>

        </div>
    </div>
</body>
</html>