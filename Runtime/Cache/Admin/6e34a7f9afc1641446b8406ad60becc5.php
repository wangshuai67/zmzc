<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <title>芝麻乐众筹管理后台</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/Public/css/pintuer.css">
  <script src="/Public/js/jquery-1.8.3.min.js"></script>
  <script src="/Public/js/pintuer.js"></script>
  <script src="/Public/js/respond.js"></script>
  <script src="/Public/lib/layer/layer.js"></script>
</head>
<body style="background:#fafafa;">
	<!-- 导航 -->

<div class="container-layout  bg-white border-bottom margin-bottom">
  <div class="container padding-big-top padding-big-bottom">
    <div class="x12">
      <div class="x2 ">
        <a href="javascript:void(0)">
          <span class=" text-red" style="font-size: 32px;">芝麻乐</span><span class="text-gray padding-left">众筹管理后台</span>
        </a>
      </div>
		<div class="x8  text-right float-right">			<div class="navbar-text navbar-right hidden-s">
			 <span class="padding-right"> 欢迎登录 <?php echo session('admin_username');?> ( <?php echo ($group_name); ?>  ) </span>	
			 <a href="javascript:void(0)" onclick="my_edit()" class="button button-small icon-cog bg-blue"> 设置</a>
			  <a href="/" target="_blank"  class="button button-small icon-link bg-blue"> 访问网站</a>
			 <button type="button" onclick="delcahe()" class="button button-small icon-power-off bg-blue"> 删除缓存</button>			 <button type="button" id="loginout" class="button button-small icon-power-off bg-blue"> 退出系统</button></div>
		</div>
      </div>
    </div>
  </div>
<script>	function delcahe(){		$.get("/index.php?s=/Admin/Delcahe/index",function(ret){			layer.msg(ret.info,{shift:2})		})	}
	function my_edit(id){	
		layer.open({
			type: 2,
			area: ['700px', '360px'],
			fix: true, //不固定
			maxmin: true,
			title:'用户设置',
			content: '/index.php?s=/Admin/Auth/my_edit'
		});
	}
</script>
 <div class="container">
	<div class="border x12">
    <div class="x2 bg-white border-right">	
	<div class="x12" style="min-height:800px">
	<div class="x12 border-bottom padding-bottom">
		<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U($vo['name']);?>" class="button  padding-top padding-big-left border-none radius-none padding-bottom x12 <?php if('/index.php?s=/Admin/System/sms.html' == '/'.$vo['name'].'.html'): ?>bg-sub<?php endif; ?>"> <?php echo ($vo["title"]); ?> <span class="float-right icon-angle-right"></span></a>
		<?php if(is_array($vo["sub_menu"])): $i = 0; $__LIST__ = $vo["sub_menu"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a href="<?php echo U($v['name']);?>" class="padding-large-left button x12  border-none radius-none <?php if('/index.php?s=/Admin/System/sms.html' == '/'.$v['name'].'.html'): ?>bg-sub<?php endif; ?>"><span class="padding-left"><?php echo ($v["title"]); ?><span class="float-right icon-angle-right"></span></span></a><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
	</div>
	<div class="clearfix"></div>
		<div class="padding text-center text-small text-gray">
			<a href="http://www.zhimale.com" class=" text-gray padding-right">帮助中心</a>|
			<a href="http://www.zhimale.com" class="text-gray padding-left">联系我们</a>
			<span class="text-gray padding-top x12">ZHIMALE 版权所有</span>			<span class="text-gray padding-top x12">版本号 <?php echo ZHIMALE_V ?></span>
		</div> 
	</div>
            
    </div>
    <div class="x10 bg-white" style="min-height:680px;">
<script>

  $(function(){
    $('#loginout').click(function(){
      layer.confirm('确定要退出吗？', {icon: 3},function(){
        parent.layer.msg('退出成功!', {
          shift: 2,
          time: 1000,
          shade: [0.1,'#000'],
          end: function(){
            window.location.href = '<?php echo U('/Admin/Public/logout');?>';
          }
        });
      });
     });
  });

  //全局配置
layer.config({
    extend: [
        'extend/layer.ext.js' 
    ]
});
</script>

<div class="x12 padding border-bottom height-big">

	<h5>短信平台</h5>

	

</div>

<div class="clearfix"></div>

<div class="padding  x12 ">

	<div class="border x12 margin-bottom">

	<div class="bg padding ">短信平台配置</div>

		<div class="height-large padding border-bottom x12">

			<span class="text-gray x2 padding height">短信平台</span>

			<span class="x5" >

				<a href="https://sms.zhimale.com/" target="_blank">芝麻乐短信平台</a>

				<span class="text-gray padding-left"></span>

			</span>

			<span class="x1" >

				<button class="config button border-sub">配置</button>

			</span>

		</div>

		<div class="height-large padding border-bottom x12">

			<span class="text-gray x2 padding height">API KEY</span>

			<span class="x5" >

				<?php echo (C("ZHIMALE.SMS_API_KEY")); ?>

				<span class="text-gray padding-left"></span>

			</span>

		</div>

		<div class="height-large padding border-bottom x12">

			<span class="text-gray x2 padding height">短信签名</span>

			<span class="x5" >

				<?php echo (C("ZHIMALE.SMS_SIGN")); ?>

				<span class="text-gray padding-left"></span>

			</span>

		</div>

		<div class="height-large padding border-bottom x12">

			<span class="text-gray x2 padding height">短信余额</span>

			<span class="x5" >

				<?php if($status_info["code"] == 0): ?><span class="text-red"><?php echo ($status_info["deposit"]); ?></span> 条

				<?php else: ?>

				<span class="text-gray">短信平台配置不正确，代码 <?php echo ($status_info["code"]); ?></span><?php endif; ?>

			</span>

			<?php if($status_info["code"] == 0): ?><span class="x2" >

				<button class="sms_test button border-sub">短信测试</button>

			</span><?php endif; ?>

		</div>

	</div>

	<div class="clearfix"></div>

</div>

<script type="text/javascript">

$(function(){

    $('.config').click(function(){

        var type = $(this).attr('type');

        var title = $(this).attr('title');

        layer.open({

			type: 2,

			area: ['500px', '250px'],

			fix: true,

			title:'短信平台配置',

			content: "<?php echo U('Admin/System/sms_config');?>"

		});

    });



    $('.sms_test').click(function(){

    	layer.prompt({title: '请输入手机号码', formType: 3,value:''}, function(phone){

    		$.ajax({

                type: 'POST',

                url: '<?php echo U('Admin/System/sms');?>',

                data:{

                    phone:phone

                },

                dataType: "json",



                success: function(data){

                    if (data.status == 1) {

                        parent.layer.msg(data.info, {

                            shift: 2,

                            time: 1000,

                            shade: [0.1,'#000'],

                            end: function(){

                                parent.layer.alert(data.message,{title:'测试内容',icon: 1});

                            }

                        });

                    }else if (data.status == 0) {

                        parent.layer.alert(data.info,{icon: 5});

                    }else{

                        parent.layer.alert('请求失败...',{icon: 2});

                    }

                },

            });

    	});

    });

})

</script>

</body>

</html>