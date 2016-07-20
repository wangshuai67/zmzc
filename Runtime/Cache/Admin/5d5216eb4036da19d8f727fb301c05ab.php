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
		<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U($vo['name']);?>" class="button  padding-top padding-big-left border-none radius-none padding-bottom x12 <?php if('/index.php?s=/Admin/System/payment.html' == '/'.$vo['name'].'.html'): ?>bg-sub<?php endif; ?>"> <?php echo ($vo["title"]); ?> <span class="float-right icon-angle-right"></span></a>
		<?php if(is_array($vo["sub_menu"])): $i = 0; $__LIST__ = $vo["sub_menu"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a href="<?php echo U($v['name']);?>" class="padding-large-left button x12  border-none radius-none <?php if('/index.php?s=/Admin/System/payment.html' == '/'.$v['name'].'.html'): ?>bg-sub<?php endif; ?>"><span class="padding-left"><?php echo ($v["title"]); ?><span class="float-right icon-angle-right"></span></span></a><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
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
	<h5>支付配置</h5>
	
</div>
<div class="clearfix"></div>
<div class="padding  x12 ">
	<div class="border x12 margin-bottom">
	<div class="bg padding ">支付接口配置</div>
		<?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zml): $mod = ($i % 2 );++$i;?><div class="height-large padding border-bottom x12">
			<span class="text-gray x2 padding height"><img src="<?php echo ($zml["ico"]); ?>" width="23"> <?php echo ($zml["title"]); ?></span>
			<span class="x8" >
				<?php if($zml["status"] == 1): if($zml["partner"] ): echo ($zml["partner"]); ?>
						<?php else: ?>
						<?php echo ($zml["business"]); endif; endif; ?>
				<span class="text-gray padding-left"></span>
			</span>

			<span class="x1" >
				<?php if($zml["status"] == 1): ?><button class="config button border-mix" title="<?php echo ($zml["title"]); ?>" type="<?php echo ($zml["type"]); ?>">配置</button><?php endif; ?>
			</span>
			
			<?php if($zml["status"] == 1): ?><button class="status button border-dot" title="<?php echo ($zml["title"]); ?>接口卸载" status="uninstall" type="<?php echo ($zml["type"]); ?>">卸载</button>
				<?php else: ?>
				<button class="status button border-sub" title="<?php echo ($zml["title"]); ?>接口安装" status="install" type="<?php echo ($zml["type"]); ?>">安装</button><?php endif; ?>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>
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
			area: ['500px', '380px'],
			fix: true,
			//maxmin: true,
			title:title+'配置',
			content: '/index.php?s=/Admin/System/payment_set/type/'+type
		});
    });
})

$(function(){
	$('.status').click(function(){
		var title = $(this).attr('title');
		var type = $(this).attr('type');
	    var status = $(this).attr('status');
		parent.layer.confirm('确定进行'+title+'？', {icon: 3},function(){
	        layer.open({
				type: 2,
				area: ['500px', '350px'],
				fix: true,
				//maxmin: true,
				title:title,
				content: '/index.php?s=/Admin/System/payment_status/type/'+type+'/status/'+status
			});
	    });
    });
})
</script>
</body>
</html>