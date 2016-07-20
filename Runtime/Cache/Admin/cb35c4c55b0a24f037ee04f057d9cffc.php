<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
  <title>$zml.title</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/Public/css/pintuer.css">
  <script src="/Public/js/jquery-1.8.3.min.js"></script>
  <script src="/Public/js/pintuer.js"></script>
  <script src="/Public/js/respond.js"></script>
  <script src="/Public/lib/layer/layer.js"></script>
  <script type="text/javascript" src="/Public/lib/validform/Validform.min.js"></script>
  <link href="/Public/lib/validform/style.css" rel="stylesheet" type="text/css">
</head>
<body>

  <div class="container">
    <div class="x12 padding">
		<h4 class="bg padding">当前项目状态 : <span class="text-red text-small">
			<?php if($item['status'] == '0'): ?>未审核<?php else: ?>审核通过<?php endif; ?>
			</span>
			<span class="padding-large-left text-small">
			修改为：
			<?php if($item['status'] == '0'): ?><a href="javascript:void(0)" onclick="changsta(<?php echo ($item['id']); ?>,1)" class="button radius-none bg-sub">审核通过</a>
			<?php else: ?>
				<a href="javascript:void(0)" onclick="changsta(<?php echo ($item['id']); ?>,0)" class="button radius-none bg-sub">取消审核</a><?php endif; ?>
			</span>
			<span class="text-gray text-small">
				修改为不审核网站前台则不会显示
			</span>
		</h4>
		<div class="clearfix"></div>
		<h2 class="padding bg margin-top margin-bottom">项目进度 
		<?php if($item['progress'] != '8'): ?><a href="javascript:void(0)" onclick="changsta(<?php echo ($item['id']); ?>,<?php echo ($item['progress'] + 1); ?>,'pro')" class="button radius-none bg-sub">进入下一个状态</a><?php endif; ?>
		</h2>
		
		<div class="step">
			<?php if(is_array($progress)): $i = 0; $__LIST__ = $progress;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="step-bar  <?php if($vo['id'] < $item['progress']): ?>complete<?php elseif($vo['id'] == $item['progress']): ?>active<?php endif; ?>" style="width:11%;"><span class="step-point icon-check"></span><span class="step-text"><?php echo ($vo["name"]); ?></span></span></div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		
    </div>
  </div>
<script type="text/javascript">

function changsta(id,sta,pro){
	layer.confirm('你确定要改变项目状态吗', {
    btn: ['确定','取消'] //按钮
}, function(){
     $.ajax({
        type: 'POST',
        url: '/index.php?s=/Admin/Item/item_editstatus/itemid/3.html',
        data: {
          id:id,
		  status:sta,
		  progress:pro
        },
        dataType: "json",
        beforeSend: function() {
          layer.load(2, {
            shade: [0.1, '#fff']
          })
        },
        success: function(data) {
          layer.closeAll();
          if (data.status == 1) {
            parent.layer.msg(data.info, {
              shift: 2,
              time: 1000,
              shade: [0.1, '#000'],
              end: function() {
                parent.location.reload()
              }
            })
          } else {
            parent.layer.alert(data.info, {
              icon: 5
            })
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