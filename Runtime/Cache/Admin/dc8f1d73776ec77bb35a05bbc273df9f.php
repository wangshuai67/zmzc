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
		<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U($vo['name']);?>" class="button  padding-top padding-big-left border-none radius-none padding-bottom x12 <?php if('/index.php?s=/Admin/Index/index.html' == '/'.$vo['name'].'.html'): ?>bg-sub<?php endif; ?>"> <?php echo ($vo["title"]); ?> <span class="float-right icon-angle-right"></span></a>
		<?php if(is_array($vo["sub_menu"])): $i = 0; $__LIST__ = $vo["sub_menu"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a href="<?php echo U($v['name']);?>" class="padding-large-left button x12  border-none radius-none <?php if('/index.php?s=/Admin/Index/index.html' == '/'.$v['name'].'.html'): ?>bg-sub<?php endif; ?>"><span class="padding-left"><?php echo ($v["title"]); ?><span class="float-right icon-angle-right"></span></span></a><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
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
</script><div class="x12 padding">	<a href="<?php echo U('Admin/Funds/payment_details');?>" class="x4 padding-large bg-green text-center text-white" >		<p><?php echo ((isset($allin) && ($allin !== ""))?($allin):'0.00'); ?></p>		<p>总进账(充值)</p>	</a>	<a href="<?php echo U('Admin/Funds/withdrawals');?>" class="x4 padding-large bg-sub text-center text-white " >		<p><?php echo ((isset($allout) && ($allout !== ""))?($allout):'0.00'); ?></p>		<p>总出账(提现)</p>	</a>	<div class="x4 padding-large bg-yellow text-center text-white " >		<p><?php echo ($allin - $allout); ?></p>		<p>总余额</p>	</div>	<div class="x12 margin-top">		<?php if($reviewed != '0'): ?><p class="bg-red-light padding"><a href="<?php echo U('Admin/Item/index/progress/0');?>" >您有 <?php echo ($reviewed); ?> 个项目未审核</a></p><?php endif; ?>		<?php if($withdrawals != '0'): ?><p class="bg-red-light padding"><a href="<?php echo U('Admin/Funds/withdrawals/status/0');?>" >您有 <?php echo ($withdrawals); ?> 笔未处理的提现</a></p><?php endif; ?>		<?php if($zhimale): ?><p class="bg-red-light padding"><?php echo ($zhimale); ?></p><?php endif; ?>	</div>    <div class="x12">        <div id="countoption" class=" x12 padding-big" style="height:300px"></div>    </div>    <div class="x12">        <div id="money" class=" x12 padding-big" style="height:300px"></div>    </div>    <div class="x12">        <div id="user" class=" x12 padding-big" style="height:300px"></div>    </div>    <div class="x12">        <div id="sumup" class=" x12 padding-big" style="height:300px"></div>    </div></div></div><!-- 底部 --></div></body><script src="/Public/js/jquery-1.8.3.min.js"></script><script src="/Public/lib/echarts/echarts.js"></script><script type="text/javascript">// 路径配置require.config({    paths: {        echarts: '/Public/lib/echarts'    }});// 使用require(    [        'echarts',        'echarts/chart/pie', // 使用饼图        'echarts/chart/funnel', // 使用漏斗        'echarts/chart/line', // 使用折线        'echarts/chart/bar', // 使用柱状    ],function (ec) {// 实例化图表var sumup = ec.init(document.getElementById('sumup'));var count = ec.init(document.getElementById('countoption'));var money = ec.init(document.getElementById('money'));var user  = ec.init(document.getElementById('user'));// 投资比例var sumupoption = {    title : {        text: '投资比例',        subtext: '截止目前',        x:'center'    },    tooltip : {        trigger: 'item',        formatter: "{a} <br/>{b} : {c} ({d}%)"    },    legend: {        orient : 'vertical',        x : 'left',        data:['收藏','投资','约谈','领投']    },    toolbox: {        show : true,        feature : {            //mark : {show: true},            //dataView : {show: true, readOnly: false},            magicType : {                        show: true,                         type: ['pie', 'funnel'],                        option: {                            funnel: {                                x: '25%',                                width: '50%',                                funnelAlign: 'left',                                max: 1548                            }                        }                    },                    //restore : {show: true},                    saveAsImage : {show: true}        }    },    calculable : true,    series : [                {                    //name:'访问来源',                    type:'pie',                    radius : '55%',                    center: ['50%', '60%'],                    data:[                        {value:<?php echo ($sumup["collect_item"]); ?>, name:'收藏'},                        {value:<?php echo ($sumup["with_item"]); ?>,name:'投资'},                        {value:<?php echo ($sumup["interview"]); ?>, name:'约谈'},                        {value:<?php echo ($sumup["lead"]); ?>, name:'领投'},                    ]                }            ]    };// 投资统计var countoption = {        title : {            text: '投资统计',            subtext: '本月'        },        tooltip : {            trigger: 'axis'        },        legend: {            data:['收藏','约谈','投资']        },        toolbox: {            show : true,            feature : {                //mark : {show: true},                dataView : {show: true, readOnly: false},                magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},                // restore : {show: true},                saveAsImage : {show: true}            }        },        calculable : true,        xAxis : [            {                type : 'category',                boundaryGap : false,                data : [<?php echo ($count["data"]); ?>]            }        ],        yAxis : [            {                type : 'value'            }        ],        series : [            {                name:'收藏',                type:'line',                smooth:true,                itemStyle: {normal: {areaStyle: {type: 'default'}}},                data:[<?php echo ($count["collect_item"]); ?>]            },            {                name:'约谈',                type:'line',                smooth:true,                itemStyle: {normal: {areaStyle: {type: 'default'}}},                data:[<?php echo ($count["with_item"]); ?>]            },            {                name:'投资',                type:'line',                smooth:true,                itemStyle: {normal: {areaStyle: {type: 'default'}}},                data:[<?php echo ($count["interview"]); ?>]            }        ]    };    //资金统计    var moneyoption = {        title : {            text: '财务统计',            subtext: '本月'        },        tooltip : {            trigger: 'axis'        },        legend: {            data:['进账','出账']        },        toolbox: {            show : true,            feature : {                //mark : {show: true},                dataView : {show: true, readOnly: false},                magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},                //restore : {show: true},                saveAsImage : {show: true}            }        },        calculable : true,        xAxis : [            {                type : 'category',                boundaryGap : false,                data : [<?php echo ($count["data"]); ?>]            }        ],        yAxis : [            {                type : 'value'            }        ],        series : [            {                name:'进账',                type:'line',                stack: '总量',                data:[<?php echo ($count["inmoney"]); ?>]            },            {                name:'出账',                type:'line',                stack: '总量',                data:[<?php echo ($count["outmoney"]); ?>]            },        ]    };    useroption = {        title : {            text: '用户统计',            subtext: '本月'        },        tooltip : {            trigger: 'axis'        },        legend: {            data:['注册']        },        toolbox: {            show : true,            feature : {                dataView : {show: true, readOnly: false},                magicType : {show: true, type: ['line', 'bar']},                saveAsImage : {show: true}            }        },        calculable : true,        xAxis : [            {                type : 'category',                data : [<?php echo ($count["data"]); ?>]            }        ],        yAxis : [            {                type : 'value'            }        ],        series : [            {                name:'注册',                type:'bar',                data:[<?php echo ($count["user"]); ?>],            },        ]    };                        // 为echarts对象加载数据     sumup.setOption(sumupoption);     count.setOption(countoption);     money.setOption(moneyoption);     user.setOption(useroption);     });</script></html>