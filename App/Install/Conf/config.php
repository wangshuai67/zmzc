<?php

/**
 * 安装程序配置文件
 */
return array(
    //产品配置
    'INSTALL_PRODUCT_NAME'   => '芝麻乐众筹系统', //产品名称
    'INSTALL_WEBSITE_DOMAIN' => 'http://www.zhimale.com', //官方网址
    'INSTALL_COMPANY_NAME'   => '江西芝麻乐网络科技有限公司', //公司名称
    'ORIGINAL_TABLE_PREFIX'  => 'zml_', //默认表前缀
  
    //前缀设置避免冲突
    'DATA_CACHE_PREFIX' => ENV_PRE.MODULE_NAME.'_', //缓存前缀
    'SESSION_PREFIX'    => ENV_PRE.MODULE_NAME.'_', //Session前缀
    'COOKIE_PREFIX'     => ENV_PRE.MODULE_NAME.'_', //Cookie前缀

    //是否开启模板编译缓存,设为false则每次都会重新编译
    'TMPL_CACHE_ON' => false, 
);
