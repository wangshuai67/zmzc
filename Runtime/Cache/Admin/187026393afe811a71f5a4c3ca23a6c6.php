<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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
		<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U($vo['name']);?>" class="button  padding-top padding-big-left border-none radius-none padding-bottom x12 <?php if('/index.php?s=/Admin/Item/item_category.html' == '/'.$vo['name'].'.html'): ?>bg-sub<?php endif; ?>"> <?php echo ($vo["title"]); ?> <span class="float-right icon-angle-right"></span></a>
		<?php if(is_array($vo["sub_menu"])): $i = 0; $__LIST__ = $vo["sub_menu"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a href="<?php echo U($v['name']);?>" class="padding-large-left button x12  border-none radius-none <?php if('/index.php?s=/Admin/Item/item_category.html' == '/'.$v['name'].'.html'): ?>bg-sub<?php endif; ?>"><span class="padding-left"><?php echo ($v["title"]); ?><span class="float-right icon-angle-right"></span></span></a><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
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
		<h3 class="x3">项目分类管理</h3>
		<a href="javascript:void(0)" class="adds float-right bg-sub button icon-plus" type="button" onclick="node_add()"> 添加分类</a>
      </div>
      <div class="x12 padding">
     
        <table class="table table-bordered table-hover">
          <tbody>
            <tr>
              <th>ID</th><th>分类名称</th><th>PID</th><th>排序</th><th>创建时间</th><th>操作</th>
            </tr>

            <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="tr<?php echo ($vo["id"]); ?>" class="height">
              <td><?php echo ($vo["id"]); ?></td>
              <td id="trname<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></td>
              <td><?php echo ($vo["pid"]); ?></td>
              <td><?php echo ($vo["sort"]); ?></td>
              <td><?php echo (date("Y-m-d H:i",$vo["create_time"])); ?></td>
              <td>
                <!-- <button class="update button bg-main" id="s0<?php echo ($vo["id"]); ?>" sid="<?php echo ($vo["id"]); ?>" sname="<?php echo ($vo["name"]); ?>">编辑</button> -->

                <button class="updates button button-small bg-sub" id="s0<?php echo ($vo["id"]); ?>" sid="<?php echo ($vo["id"]); ?>" sname="<?php echo ($vo["name"]); ?>">编辑</button>

                <button class="del button button-small bg-sub" sid="<?php echo ($vo["id"]); ?>" sname="<?php echo ($vo["name"]); ?>">删除</button>

              </td>
            </tr>

            <?php if(is_array($vo["lower"])): $k = 0; $__LIST__ = $vo["lower"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rs): $mod = ($k % 2 );++$k;?><tr id="tr<?php echo ($rs["id"]); ?>" class="height">
              <td><?php echo ($rs["id"]); ?></td>
              <td id="trname<?php echo ($rs["id"]); ?>">├──　　<?php echo ($rs["name"]); ?></td>
              <td><?php echo ($rs["pid"]); ?></td>
              <td><?php echo ($rs["sort"]); ?></td>
              <td><?php echo (date("Y-m-d H:i",$rs["create_time"])); ?></td>
              <td>
                <!-- <button class="update button bg-main" id="s0<?php echo ($rs["id"]); ?>" sid="<?php echo ($rs["id"]); ?>" sname="<?php echo ($rs["name"]); ?>">编辑</button> -->

                <button class="updates button button-small bg-sub" id="s0<?php echo ($rs["id"]); ?>" sid="<?php echo ($rs["id"]); ?>" sname="<?php echo ($rs["name"]); ?>">编辑</button>

                <button class="del button button-small bg-sub" sid="<?php echo ($rs["id"]); ?>" sname="<?php echo ($rs["name"]); ?>">删除</button>

              </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>

          </tbody>
        </table>
		 <div class="margin-big-top">
          <ul class="pagination">
            <?php echo ($page); ?>
          </ul>
			</div>
        </div>


  	<!-- 底部 -->
    

<script type="text/javascript">
$(function(){
  //全局配置
  layer.config({
    extend: [
      'extend/layer.ext.js'
      ]
  });

    //添加分类
    $('.adds').click(function(){
      layer.open({
        type: 2,
        title: '添加分类',
        shadeClose: true,
        shade: 0.8,
        area: ['980px', '570px'],
        content: '<?php echo U('/Admin/Item/item_category_add');?>'
      });
    });

    //修改分类
    $('.updates').click(function(){
      var sid = $(this).attr('sid');
      layer.open({
        type: 2,
        title: '修改分类：'+ $(this).attr('sname'),
        shadeClose: true,
        shade: 0.8,
        area: ['480px', '570px'],
        content: '<?php echo U('/Admin/Item/item_category_edit');?>?id='+sid
      });
    });
    //删除
    $('.del').click(function(){
        var sid = $(this).attr('sid');
        layer.confirm('确定要删除 "'+ $(this).attr('sname') +'" 吗？', {icon: 3},function(){
            $.ajax({
                type: 'POST',
                url: '<?php echo U('/Admin/Item/item_category_del');?>',
                data:{
                    id:sid
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
                                $("#tr"+sid).remove();
                            }
                        });
                    }else{
                        layer.alert(data.info,{icon: 5});
                    }
                }
            });
        });
    });


});

</script>
</body>
</html>