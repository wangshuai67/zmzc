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
		 <div class="step-bar active" style="width:20%;"><span class="step-point">2</span><span class="step-text">环境检测</span></div>
		 <div class="step-bar" style="width:20%;"><span class="step-point">3</span><span class="step-text">参数设置</span></div>
		 <div class="step-bar" style="width:20%;"><span class="step-point">4</span><span class="step-text">开始安装</span></div>
		 <div class="step-bar" style="width:20%;"><span class="step-point">5</span><span class="step-text">完成安装</span></div>
	</div>

    <div class="x12 padding">
        <div class="panel">
            <div class="panel-head">
                <span>环境检测</span>
            </div>
            <div class="panel-body">
				<h4 class="text-center bg padding">运行环境检查</h4>
                <table class="table table-hover table-bordered">
                   
                    <thead>
                        <tr>
                            <th>项目</th>
                            <th>所需配置</th>
                            <th>当前配置</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(is_array($check_env)): $i = 0; $__LIST__ = $check_env;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr>
                                <td><?php echo ($item['title']); ?></td>
                                <td><?php echo ($item['limit']); ?></td>
                                <td><i class="glyphicon <?php echo ($item['icon']); ?>"></i> <?php echo ($item['current']); ?></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
                <?php if(isset($check_dirfile)): ?><h4 class="text-center bg padding">目录、文件权限检查</h4>
					<table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>目录/文件</th>
                                <th>所需状态</th>
                                <th>当前状态</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($check_dirfile)): $i = 0; $__LIST__ = $check_dirfile;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr>
                                    <td><?php echo ($item['path']); ?></td>
                                    <td><i class="icon-check-square-o text-green"></i> 可写</td>
                                    <td><i class="glyphicon <?php echo ($item['icon']); ?>"></i> <?php echo ($item['title']); ?></td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table><?php endif; ?>
				 <h4 class="text-center bg padding">函数及扩展依赖性检查</h4>
				<table class="table table-hover table-bordered">
                <table class="table table-hover">
                   
                    <thead>
                        <tr>
                            <th>名称</th>
                            <th>检查结果</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(is_array($check_func_and_ext)): $i = 0; $__LIST__ = $check_func_and_ext;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr>
                                <td><?php echo ($item['name']); ?></td>
                                <td><i class="<?php echo ($item['icon']); ?>"></i> <?php echo ($item['title']); ?></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
				<div class="text-center">
					<a class="button bg-green ajax-get" href="javascript:void(0)">下一步</a>
					<a class="button bg-red" href="<?php echo U('step1');?>">上一步</a>
				</div>
            </div>
            <div class="panel-foot">
                <span>版权所有 (c) 2014－<?php echo date("Y",time()); echo C('INSTALL_COMPANY_NAME');?> 保留所有权利。</span>
            </div>
        </div>
    </div>
	<script>
		$(".ajax-get").click(function(){
			$.get('/index.php?s=/Index/step2.html',function(ret){
				if(ret.status==1){
					window.location.href=ret.url
				}else{
					 layer.msg(ret.info, {shift: 6});
				}
			})
		})
	</script>

        </div>
    </div>
</body>
</html>