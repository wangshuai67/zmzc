<?php
$config = array(
	//'配置项'=>'配置值'
	'DEFAULT_THEME'        =>ZMLTPL,  //默认模板
	//'DEFAULT_THEME'        =>'default',  //默认模板
	'TMPL_PARSE_STRING'  => array(
		'__THEME__'     => __ROOT__.'/Template/Home', // 增加新的JS类库路径替换规则
	),
);
$zml_tmpl_config = CONF_PATH.'ZML_TMPL_PARSE_STRING.php';
$zml_tmpl_config = file_exists($zml_tmpl_config) ? include "$zml_tmpl_config" : array();
$config['TMPL_PARSE_STRING'] = array_merge($config['TMPL_PARSE_STRING'], $zml_tmpl_config);
return array_merge($config, $zml_tmpl_config);