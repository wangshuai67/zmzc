<?php
$config = array(
	'SHOW_PAGE_TRACE'=>0,
	'TMPL_DETECT_THEME' => 1, 
	'DEFAULT_THEME'        =>ZMLTPL,  //默认模板
	
	'TMPL_PARSE_STRING'=>array(
		'__CSS__'=> __ROOT__.'/Template/User/'.ZMLTPL.'/Public/style/',
		'__JS__'=> __ROOT__.'/Template/User/'.ZMLTPL.'/Public/js/',
		'__IMG__'=> __ROOT__.'/Template/User/'.ZMLTPL.'/Public/img/',
		'__LIB__'=> __ROOT__.'/Public/lib/',
	
	 ),
);

$zml_tmpl_config = CONF_PATH.'ZML_TMPL_PARSE_STRING.php';
$zml_tmpl_config = file_exists($zml_tmpl_config) ? include "$zml_tmpl_config" : array();
$config['TMPL_PARSE_STRING'] = array_merge($config['TMPL_PARSE_STRING'], $zml_tmpl_config);


return array_merge($config, $zml_tmpl_config);