<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.zhimale.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  火鸡 <834758588@qq.com>
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Think\Controller;
class DelcaheController extends CommonController {
 public function index() { 
 header("Content-type: text/html; charset=utf-8");
  //清文件缓存
  $dirs = array('./Runtime/');
  @mkdir('Runtime',0777,true);
  //清理缓存
  foreach($dirs as $value) {
   $this->rmdirr($value);
  }
  $this->success('系统缓存清除成功！');
 } 
 
/////////////下面是处理方法
    
 public function rmdirr($dirname) {
  if (!file_exists($dirname)) {
   return false;
  }
  if (is_file($dirname) || is_link($dirname)) {
   return unlink($dirname);
  }
  $dir = dir($dirname);
  if($dir){
   while (false !== $entry = $dir->read()) {
    if ($entry == '.' || $entry == '..') {
     continue;
    }
    //递归
    $this->rmdirr($dirname . DIRECTORY_SEPARATOR . $entry);
   }
  }
  $dir->close();
  return rmdir($dirname);
 }
 }