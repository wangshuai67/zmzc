<?php if (!defined('THINK_PATH')) exit(); if(C('LAYOUT_ON')) { echo ''; } ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>即将跳转 --芝麻乐开源众筹系统</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/Public/css/pintuer.css">
	<script src="/Public/js/jquery-1.8.3.min.js"></script>
	<script src="/Public/js/pintuer.js"></script>
	<script src="/Public/js/respond.js"></script>
	<script src="/Public/lib//layer/layer.js"></script>
</head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body style="background:#e7e8eb width:1">
	<style>
	.mynav li{width: 80px;height: 36px;line-height: 36px;float: left;text-align: center;margin-right: 5px;border-radius: 3px;position: relative;display: block;}
	.mynav .active{background-color: #ea544a;}
	.mynav .active a{color: #fff;}
	</style>
	<div class="x12 margin-big-bottom text-little padding-small bg-black text-pale" id="top">
		<div class="container">
			<span class="x2">欢迎来到芝麻乐众筹系统！</span>
			<span class="x10 text-right text-pale"><a href="/User.html" class="text-pale">13766325752 进入用户中心</a> | <a href="/User/Login/logout.html" class="text-pale">退出</a></span>
		</div>
	</div>
	<div class="container-layout  bg-white">
		<div class="container padding-big-top padding-big-bottom">
			<div class="x12">
				<div class="x2">
					<a href="/"><span class=" text-red" style="font-size: 32px;">芝麻乐</span><span class="text-gray padding-left">股权众筹系统</span></a>
				</div>
				<div class="x10 padding-top">
					<div class="x8">
						<ul class="mynav text-big float-right padding-big-right">
							<li><a href="/">首页</a></li>
							<li class="active"><a href="/Item">项目</a></li>
							<!--             <li><a href="#">动态</a></li> -->
							<li><a href="/News">新闻</a></li>
						</ul>
					</div>
					<div class="x4">
						<form id="form">
							<div class="input-group padding-little-top">
								<input type="text" class="input border-red" name="keywords" size="30" placeholder="项目名称" datatype="*">
								<span class="addbtn"><button type="submit" class="button bg-red" onclick="select()">搜!</button></span>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="x12 text-center margin-large-top">
		<?php if(isset($message)) {?>
		<p class="text-large"><?php echo($message); ?></p>
		<?php }else{?>
		<p class="text-large"><?php echo($error); ?></p>
		<?php }?>
		<p class="text-large"></p>
		<p class="text-big">
			页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
		</p>
	</div>
	<script type="text/javascript">
	(function(){
		var wait = document.getElementById('wait'),href = document.getElementById('href').href;
		var interval = setInterval(function(){
			var time = --wait.innerHTML;
			if(time <= 0) {
				location.href = href;
				clearInterval(interval);
			};
		}, 1000);
	})();
	</script>
</body>
</html>