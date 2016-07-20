<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html lang="zh-cn">

<head>

<title>登录</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="/Public/css/pintuer.css">

<script src="/Public/js/jquery-1.8.3.min.js"></script>

<script src="/Public/js/pintuer.js"></script>

<script src="/Public/js/respond.js"></script>

<script src="/Public/lib//layer/layer.js"></script>

</head>

<body  onkeydown="BindEnter(event)"> 



<script type="text/javascript">

function BindEnter(obj)

{

    if(obj.keyCode == 13)

        {

            login()

          

        }

}

</script>

<div class="x12">

	<div class="x12 text-center">

		<span class="padding"><img src="/uploads/1/20151017/zmlcms_1445061661767.png" alt="芝麻乐开源众筹系统" class="padding"></span>

	</div>

	<div class="x12 float-right bg-white padding">

		<h4 class="padding-bottom">用户登录</h4>

		<div class="form-group">

			<div class="field field-icon">	

				<span class="padding-small-top icon icon-user"></span>					

				<input type="text"  placeholder="手机号" name="phone" class="input box-shadow-none text-small input-big radius-none" />					

			</div>

		</div>

		<div class="form-group">

			<div class="field field-icon">	

				<span class="padding-small-top icon icon-key"></span>						

				<input type="password" name="pwd" placeholder="密码" class="input box-shadow-none text-small input-big radius-none" />

			</div>

		</div>

		<div class="form-group">

					

			  <div class="field field-icon">	

				<span class="padding-small-top icon icon-check-square-o"></span>

				  <input type="text " size="10" class="input radius-none input-big box-shadow-none text-small input-auto" name="verify"   placeholder="验证码" />

				  <span class="addbtn padding-left"><img src="<?php echo U('Home/Verify/index');?>" id="code" width="80" height="35"/></span>

					<a href="javascript:void(0)"  onclick="verifys('code')" class="text-blue">换一张</a>

			  </div>

			

		</div>

		<a href="javascript:void(0)"  class="x12 bg-red text-center padding text-white margin-bottom" onclick="login(this)">登 录</a>

		<div class="x12 margin-top">

			<span>还没有账号 ? 【<a href="/index.php?s=/User/Login/reg" class="text-blue">注册账号</a>】</span>

			<span><a href="/index.php?s=/User/Login/forgotpwd" class="text-blue">忘记密码 ? </a></span>

		</div>

	</div> 

</div>

	<script>

		function verifys(id){

			document.getElementById(id).src="<?php echo U('Home/Verify/index');?>&"+Math.random(); 

		}

		function login(d){

			var phone=$("input[name='phone']")

			var pwd=$("input[name='pwd']")

			var verify=$("input[name='verify']")

			if(phone.val()==''){

				layer.tips('手机号不能为空', phone,{tips: [1, '#f60']});

				phone.focus();

				return false

			}

			if(pwd.val()==''){

				layer.tips('密码不能为空', pwd,{tips: [1, '#f60']});

				pwd.focus();

				return false			

			}

			if(verify.val()==''){

				layer.tips('验证码不能为空', verify,{

					tips:4,

				});

				verify.focus();

				return false			

			}

			$(d).text('登录中...');

			$.post(

				"/index.php?s=/User/Login",

				{

					phone:phone.val(),

					pwd:pwd.val(),				

					verify:verify.val(),

				},function (data){

					if (data.status == 1) {

						window.location.href=data.url

					}else{

						layer.msg(data.info);

						$(d).text('登 录');

					}

				}

			)

		}

	</script>

	    <div class="x12" style="height:50px;"></div>
    <div class="x12 text-center text-white fixed-bottom">
        <a href="/" class="x3 bg-red text-white padding"><span class="icon-home padding-small-right"></span>首页</a>
        <a href="/Item" class="x3 bg-red text-white padding border-left border-right"><span class="icon-legal padding-small-right"></span>项目</a>
        <a href="/News" class="x3 bg-red text-white padding border-left border-right"><span class="icon-legal padding-small-right"></span>动态</a>
        <a href="/User" class="x3 bg-red padding text-white"><span class="icon-user padding-small-right"></span>我</a>
    </div>
    

</body>

</html>