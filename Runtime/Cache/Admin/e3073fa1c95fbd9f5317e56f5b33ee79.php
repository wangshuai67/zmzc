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
		<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U($vo['name']);?>" class="button  padding-top padding-big-left border-none radius-none padding-bottom x12 <?php if('/index.php?s=/Admin/User/user_attest.html' == '/'.$vo['name'].'.html'): ?>bg-sub<?php endif; ?>"> <?php echo ($vo["title"]); ?> <span class="float-right icon-angle-right"></span></a>
		<?php if(is_array($vo["sub_menu"])): $i = 0; $__LIST__ = $vo["sub_menu"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a href="<?php echo U($v['name']);?>" class="padding-large-left button x12  border-none radius-none <?php if('/index.php?s=/Admin/User/user_attest.html' == '/'.$v['name'].'.html'): ?>bg-sub<?php endif; ?>"><span class="padding-left"><?php echo ($v["title"]); ?><span class="float-right icon-angle-right"></span></span></a><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
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
			<a href="/index.php?s=/Admin/User/user_attest.html" class="padding text-sub">全部</a>
			<a href="/index.php?s=/Admin/User/user_attest/status/2" class="padding <?php if($_GET['status'] == '2'): ?>text-green<?php else: ?> text-sub<?php endif; ?>">已拒绝</a>
			<a href="/index.php?s=/Admin/User/user_attest/status/1" class="padding <?php if($_GET['status'] == '1'): ?>text-green<?php else: ?> text-sub<?php endif; ?>">已通过</a>
			<a href="/index.php?s=/Admin/User/user_attest/status/0" class="padding <?php if($_GET['status'] == '0'): ?>text-green<?php else: ?> text-sub<?php endif; ?>">未审核</a>
			
	  </div>
      <div class="x12 padding">

        <div class="margin-big-top">
        <table class="table table-bordered table-hover text-small">
          <tbody>
            <tr>
			  <th>手机号码</th>
			  <th>名字</th>
			  <th>性别</th>
			  <th>地区</th>
			  <th>注册时间</th>
			  <th>认证状态</th>
			  <th>操作</th>
            </tr>

            <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr  class="height">
              <td ><?php echo ($vo["phone"]); ?></td>
              <td><?php echo ($vo["user_name"]); ?></td>
              <td><?php if($vo['sex'] == '1' ): ?>男<?php elseif($vo['sex'] == 2 ): ?>女<?php else: ?>未知<?php endif; ?></td>
              <td><?php echo region_address($vo['area']);?></td>
              <td><?php echo (date("Y-m-d H:i",$vo["create_time"])); ?></td>
              <td>
			  <?php if($vo['attest_status'] == '0' ): ?><span class="text-red">未审核</span>			
			  <?php elseif($vo['attest_status'] == '1' ): ?>
				<span class="text-green">审核通过</span>
				<?php else: ?>
				已拒绝<?php endif; ?>
			  </td>              
              <td>
				<a href="javascript:void(0)" class="text-blue" onclick="seecard('<?php echo ($vo["card_positive"]); ?>')">身份证正面</a>
				<a href="javascript:void(0)" class="text-blue padding-left" onclick="seecard('<?php echo ($vo["card_negative"]); ?>')">身份证背面</a>
				<br />
				 <?php if($vo['attest_status'] == '0' ): ?><a href="javascript:void(0)" onclick="pass(<?php echo ($vo["id"]); ?>,1)" class="text-sub icon-check "> 通过</a>
					<a href="javascript:void(0)" onclick="pass(<?php echo ($vo["id"]); ?>,2)" class="text-red icon-ban"> 拒绝</a><?php endif; ?>
              </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
        </table>
        </div>

        <div class="margin-big-top">
          <ul class="pagination">
            <?php echo ($page); ?>
          </ul>
        </div>
      </div>
    </div>
  	<!-- 底部 -->
    
  </div>
<script>
	function seecard(pic){
		var html='<img src="'+pic+'" width="558"/>';
		layer.open({
			content: html,
			area: ['600px', '500px'],
			scrollbar: false
			});
	}
	//审核
	function pass(id,status){
		$.post('/index.php?s=/Admin/User/attest_pass',{id:id,status:status},function(ret){
			if(ret.status==1){
				layer.msg(ret.info, {
					offset: 200,
					shift: 2
				});
				window.location.reload()
			}else{
				layer.msg(ret.info, {
					offset: 200,
					shift: 2
				});
			}
		})
	}
</script>
</body>
</html>