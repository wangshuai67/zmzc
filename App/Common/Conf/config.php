<?php
$config = array(
	//'配置项'=>'配置值'
	'URL_MODEL'            =>3,    //2是去除index.php
    'DB_FIELDTYPE_CHECK'   =>true,
    'TMPL_STRIP_SPACE'     =>true,
    'OUTPUT_ENCODE'        =>true, // 页面压缩输出

    'MODULE_ALLOW_LIST'    =>    array('Home','User','Admin','Install'),
    'DEFAULT_MODULE'       =>    'Home',  // 默认模块

    //加密混合值
	'AUTH_CODE' => 'ZhiMaLe',
    //数据库配置
	
	/* 'SESSION_OPTIONS'=>array(
		'type'=> 'db',//session采用数据库保存
		'expire'=>604800,//session过期时间，如果不设就是php.ini中设置的默认值
		), */
	'SESSION_TABLE'=>'zml_session', //必须设置成这样，如果不加前缀就找不到数据表，这个需要注意
	'TAGLIB_BUILD_IN' => 'cx,TagLib\Zml',//芝麻乐标签库
	'TAGLIB_PRE_LOAD' => 'TagLib\Zml',//芝麻乐命名范围
	


);


$web_config = dirname(__FILE__).'/web_config.php';
$web_config = file_exists($web_config) ? include "$web_config" : array();

$upload = dirname(__FILE__).'/upload.php';
$upload = file_exists($upload) ? include "$upload" : array();

$pay_config = dirname(__FILE__).'/pay_config.php';
$pay_config = file_exists($pay_config) ? include "$pay_config" : array();

$sms_config = dirname(__FILE__).'/sms_config.php';
$sms_config = file_exists($sms_config) ? include "$sms_config" : array();

$db_config = dirname(__FILE__).'/db_config.php';
$db_config = file_exists($db_config) ? include "$db_config" : array();

return array_merge($db_config,$config,$web_config,$pay_config,$sms_config,$upload);