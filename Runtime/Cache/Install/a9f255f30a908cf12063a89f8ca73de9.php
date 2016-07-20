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
		 <div class="step-bar active" style="width:20%;"><span class="step-point">3</span><span class="step-text">参数设置</span></div>
		 <div class="step-bar" style="width:20%;"><span class="step-point">4</span><span class="step-text">开始安装</span></div>
		 <div class="step-bar" style="width:20%;"><span class="step-point">5</span><span class="step-text">完成安装</span></div>
	</div>

    <div class="x12 padding">
        <div class="panel">
            <div class="panel-head">
                <span>参数设置 数据库连接信息</span>
            </div>
            <div class="panel-body">
                <form class="form form-x x8 x4-move" action="/index.php?s=/Index/step3.html" method="post" target="_self">
                    <div class="form-group">
                        <label class="label">数据库连接类型：</label>
                        <div class="form-group">
                            <select name="DB_TYPE" class="input input-auto box-shadow-none radius-none">
                                <option>mysql</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">数据库服务器：</label>
                        <div class="form-group">
                            <input class="input input-auto box-shadow-none radius-none" value="localhost" size="50" type="text" name="DB_HOST" placeholder="数据库服务器IP，一般为127.0.0.1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">数据库名：</label>
                        <div class="form-group">
                            <input class="input input-auto box-shadow-none radius-none" value="zhimale" size="50" type="text" name="DB_NAME" placeholder="如不知晓，请咨询您的空间商">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">数据库用户名：</label>
                        <div class="form-group">
                            <input class="input input-auto box-shadow-none radius-none" size="50" type="text" name="DB_USER" placeholder="如不知晓，请咨询您的空间商">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">数据库密码：</label>
                        <div class="form-group">
                            <input class="input input-auto box-shadow-none radius-none" size="50" type="password" name="DB_PWD" placeholder="如不知晓，请咨询您的空间商">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="label">安装体验数据：</label>
                        <div class="form-group">
                            <input name="tiyan" type="radio" value="1" checked > 是
                            <input name="tiyan" type="radio" value="0" > 否
                        </div>
                    </div>
                </form>
                <div class="clearfix"></div>
				<div class="text-center">
					<input type="button" class="button bg-green ajax-post"  value="下一步">
					<a class="button bg-red" href="<?php echo U('step2');?>">上一步</a>
				</div>
            </div>
            <div class="panel-foot">
                <span>版权所有 (c) 2014－<?php echo date("Y",time()); echo C('INSTALL_COMPANY_NAME');?> 保留所有权利。</span>
            </div>
        </div>
    </div>
	<script>
		$(".ajax-post").click(function(){
			var DB_TYPE=$("select[name='DB_TYPE']").val();
			var DB_HOST=$("input[name='DB_HOST']");
			var DB_NAME=$("input[name='DB_NAME']");
			var DB_USER=$("input[name='DB_USER']");
			var DB_PWD=$("input[name='DB_PWD']");
			var tiyan=$("input[name='tiyan']:checked").val();
		
			
			if(DB_HOST.val().length < 1){
				layer.tips('数据库服务器不能为空', DB_HOST);
				DB_HOST.focus();
				return false
			}
			
			if(DB_NAME.val().length < 1){
				layer.tips('数据库名字不能为空', DB_NAME);
				DB_NAME.focus();
				return false
			}
			
			if(DB_USER.val().length < 1){
				layer.tips('数据库用户名不能为空', DB_USER);
				DB_USER.focus();
				return false
			}
			
			layer.msg('正在安装.....过程有点长!',{shift:2},function(){
				$.post('/index.php?s=/Index/step3.html',{
					DB_TYPE:DB_TYPE,
					DB_HOST:DB_HOST.val(),
					DB_NAME:DB_NAME.val(),
					DB_USER:DB_USER.val(),
					DB_PWD:DB_PWD.val(),
					tiyan:tiyan
				},function(ret){
					if(ret.status==1){
						
						window.location.href=ret.url
					}else{
						 layer.msg(ret.info, {shift: 6});
					}
				})
				
			});
			
		})
	</script>

        </div>
    </div>
</body>
</html>