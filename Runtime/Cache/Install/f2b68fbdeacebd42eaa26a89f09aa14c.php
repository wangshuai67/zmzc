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
		 <div class="step-bar active " style="width:20%;"><span class="step-point">4</span><span class="step-text">开始安装</span></div>
		 <div class="step-bar" style="width:20%;"><span class="step-point">5</span><span class="step-text">完成安装</span></div>
	</div>
    <div class="x12 padding">
        <div class="panel">
            <div class="panel-head">
                <span>开始安装</span>
            </div>
            <div class="panel-body">
                <div id="show-list" class="install-database">
                </div>
                <script type="text/javascript">
                    var list   = document.getElementById('show-list');
                    function showmsg(msg, classname){
                        var li = document.createElement('p');
                        li.innerHTML = msg;
                        classname && li.setAttribute('class', classname);
                        list.appendChild(li);
                        document.scrollTop += 30;
                    }
                </script>
                <button class="button disabled">正在<?php if(($_SESSION['ENV_PREInstall_']['update']) == "1"): ?>升级<?php else: ?>安装<?php endif; ?>，请稍后...</button>
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