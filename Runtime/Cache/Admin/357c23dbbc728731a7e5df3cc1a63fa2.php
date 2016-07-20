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
 
		
      <div class="x12 padding ">
			<div class="x6 padding">
				用户总数：<span class="text-dot"><?php echo ($alluser); ?></span> 个
				<a href="/index.php?s=/Admin/User" class="text-sub">全部</a>
			</div>
			<div class="x6 padding-bottom">
				<form action="/index.php?s=/Admin/User/index/getuser/ok.html" method="get" >
				<input type="text" name="key" size="50" class="input input-auto box-shadow-none radius-none"  placeholder="手机号 / 姓名 / 地区进行搜索"/>
				<button type="submit"  class="button box-shadow-none bg-sub radius-none icon-search"  /> 搜索</button>
				</form>
			</div>
         <table class="table table-bordered table-hover text-small">
          <tbody>
            <tr>
            
			  <th>手机号码</th>
			  <th>名字</th>
			  <th>性别</th>
			  <th><?php if($_GET['money'] != 'asc'): ?><a href="/index.php?s=/Admin/User?money=asc" class="text-blue">余额 <span class="icon-caret-down"></span></a>
				<?php else: ?>
					<a href="/index.php?s=/Admin/User" class="text-blue">余额 <span class="icon-caret-up"></span></a><?php endif; ?>
			</th>
			  <th>
			  <?php if($_GET['points'] != 'asc'): ?><a href="/index.php?s=/Admin/User?points=asc" class="text-blue">积分 <span class="icon-caret-down"></span></a>
				<?php else: ?>
					<a href="/index.php?s=/Admin/User" class="text-blue">积分 <span class="icon-caret-up"></span></a><?php endif; ?>
			  </th>
			  <th>发布的项目</th>
			  <th>领投的项目</th>
			  <th>提过的问题</th>
			  <th>地区</th>
			  <th>
				<?php if($_GET['create_time'] != 'asc'): ?><a href="/index.php?s=/Admin/User?create_time=asc" class="text-blue">注册时间 <span class="icon-caret-down"></span></a>
				<?php else: ?>
					<a href="/index.php?s=/Admin/User" class="text-blue">注册时间 <span class="icon-caret-up"></span></a><?php endif; ?>
			  </th>
			  <th>
				选择
			  </th>
            </tr>

            <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr  class="height">
              <td ><?php echo ($vo["phone"]); ?></td>
              <td><?php echo ($vo["name"]); ?></td>
              <td><?php if($vo['sex'] == '1' ): ?>男<?php elseif($vo['sex'] == 2 ): ?>女<?php else: ?>未知<?php endif; ?></td>             
              <td><?php echo ($vo["money"]); ?></td>
              <td><?php echo ($vo["points"]); ?></td>
              <td><?php echo ($vo["item"]); ?> 个</td>
              <td><?php echo ($vo["itemLead"]); ?> 个</td>
              <td><?php echo ($vo["questions"]); ?> 个</td>
			  <td><?php echo region_address($vo['area']);?></td>
              <td><?php echo (date("Y-m-d H:i",$vo["create_time"])); ?></td>
              <td><button class="button button-small bg-sub" type="button" onclick="choose(<?php echo ($vo["uin"]); ?>)">选择</button></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
        </table>
        <div class="margin-big-top">
          <ul class="pagination">
            <?php echo ($page); ?>
          </ul>
        </div>
 </div>
    </div>
  

<script>
function choose(uin){
 parent.$("input[name='uin']").val(uin);
 parent.layer.closeAll();
}


</script>
</body>
</html>