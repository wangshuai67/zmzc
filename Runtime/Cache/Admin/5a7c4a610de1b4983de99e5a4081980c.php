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
		<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U($vo['name']);?>" class="button  padding-top padding-big-left border-none radius-none padding-bottom x12 <?php if('/index.php?s=/Admin/Nav/index.html' == '/'.$vo['name'].'.html'): ?>bg-sub<?php endif; ?>"> <?php echo ($vo["title"]); ?> <span class="float-right icon-angle-right"></span></a>
		<?php if(is_array($vo["sub_menu"])): $i = 0; $__LIST__ = $vo["sub_menu"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a href="<?php echo U($v['name']);?>" class="padding-large-left button x12  border-none radius-none <?php if('/index.php?s=/Admin/Nav/index.html' == '/'.$v['name'].'.html'): ?>bg-sub<?php endif; ?>"><span class="padding-left"><?php echo ($v["title"]); ?><span class="float-right icon-angle-right"></span></span></a><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
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
 
    <div class="x12 padding-top padding border-bottom">
		<h3 class="x3">导航管理</h3>
		<a href="javascript:void(0)" class="float-right bg-sub button icon-plus" type="button" onclick="iframe('<?php echo U('Admin/Nav/nav_edit');?>')"> 添加导航</a>
      </div>
      <div class="x12 padding">
        <table class="table table-bordered table-hover">
          <tbody>
            <tr>
             <th>标题</th>
			 <th>链接</th>
			 <th>导航位置</th>
			 <th>排序</th>
			 <th>状态</th>
			 <th>操作</th>
            </tr>

            <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="tr<?php echo ($vo["id"]); ?>" class="height">
             
              <td><?php echo ($vo["name"]); ?></td>
              <td><?php echo ($vo["url"]); ?></td>
              <td><?php if($vo['type'] == '2'): ?>底部导航<?php elseif($vo['type'] == '1'): ?>中间导航<?php else: ?>头部导航<?php endif; ?></td>
              <td><?php echo ($vo["sort"]); ?></td>
              <td><?php if($vo['status'] == '1'): ?>正常<?php else: ?>隐藏<?php endif; ?></td>
              <td>
                <button class="del button button-small bg-sub" onclick="del(<?php echo ($vo["id"]); ?>)">删除</button>
                <a href="javascript:void(0)" class=" button button-small bg-sub" onclick="iframe('<?php echo U('Admin/Nav/nav_edit',array('id'=>$vo['id']));?>')" >修改</a>
              </td>
            </tr>
			<?php if(is_array($vo["sub"])): $i = 0; $__LIST__ = $vo["sub"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr id="tr<?php echo ($v["id"]); ?>" class="height">
             
              <td> ├──　　<?php echo ($v["name"]); ?></td>
              <td><?php echo ($v["url"]); ?></td>
              <td><?php if($v['type'] == '2'): ?>底部导航<?php elseif($v['type'] == '1'): ?>中间导航<?php else: ?>头部导航<?php endif; ?></td>
              <td><?php echo ($v["sort"]); ?></td>
              <td><?php if($v['status'] == '1'): ?>正常<?php else: ?>隐藏<?php endif; ?></td>
              <td>
                <button class="del button button-small bg-sub" onclick="del(<?php echo ($v["id"]); ?>)">删除</button>
                <a href="javascript:void(0)"  onclick="iframe('<?php echo U('Admin/Nav/nav_edit',array('id'=>$v['id']));?>')"  class=" button button-small bg-sub" >修改</a>
              </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>

          </tbody>
        </table>
		<div class="margin-big-top">
          <ul class="pagination pagination-group">
            <?php echo ($page); ?>
          </ul>
        </div>
        </div>

        


      </div>
    </div>
  	<!-- 底部 -->
    
  </div>
<script type="text/javascript">

function iframe(url){
		layer.open({
        type: 2,
        title: '提示',
        shadeClose: true,
        shade: 0.8,
        area: ['1000px', '370px'],
        content: url
      });
	}

    //删除
function del(id){  
layer.confirm('确定要删除吗？', {
    btn: ['确定','点错了'] //按钮
}, function(){
   $.ajax({
			type: 'POST',
			url: '<?php echo U('/Admin/Nav/nav_del');?>',
			data:{
				id:id
			},
			dataType: "json",
			beforeSend: function() {
			  layer.closeAll();
			  layer.load(2,{shade: [0.1,'#000']});
			},
			success: function(data){
			  layer.closeAll();
				if (data.status == 1) {
					
					layer.msg(data.info, {
						shift: 2,
						time: 1000,
						shade: [0.1,'#000'],
						end: function(){
							$("#tr"+id).remove();
						}
					});
				}else{
					layer.alert(data.info,{icon: 5});
				}
			}
		});
}, function(){
    layer.msg('你选择了取消', {shift: 6});
});

		
}
   

</script>
</body>
</html>