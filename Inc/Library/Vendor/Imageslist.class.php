<?php

//include "Uploader.class.php";
namespace Vendor;

class Imageslist {

	public  function __construct(){
		//$CONFIG = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents("./Public/ueditor/php/config.json")), true);	
		$allowFiles =  Array ('.png','.jpg','.jpeg' ,'.gif' ,'.bmp' ) ;
		$listSize = 20;
		$path = C('UPLOAD_PATH').session('user.uin').'/';
		
		$allowFiles = substr(str_replace(".", "|", join("", $allowFiles)), 1);
		//print_r($CONFIG);
		/* 获取参数 */
		$size = isset($_GET['size']) ? htmlspecialchars($_GET['size']) : $listSize;
		$start = isset($_GET['start']) ? htmlspecialchars($_GET['start']) : 0;
		$end = $start + $size;

		/* 获取文件列表 */
		$path = $_SERVER['DOCUMENT_ROOT'] . (substr($path, 0, 1) == "/" ? "":"/") . $path;
		
		$files = $this->getfiles($path, $allowFiles);
		//print_r($files);
		if (!count($files)) {
			$result= json_encode(array(
				"state" => "no match file",
				"list" => array(),
				"start" => $start,
				"total" => count($files)
			));
		}

		/* 获取指定范围的列表 */
		$len = count($files);
		for ($i = min($end, $len) - 1, $list = array(); $i < $len && $i >= 0 && $i >= $start; $i--){
			//$files[$i]['url'] = C("UPLOAD_PATH").'/'.$files[$i]['url'];
			$files[$i]['url'] = str_replace('/./','/',$files[$i]['url']);

			//$list[] = str_replace('./','/',C("UPLOAD_PATH").'/'.$files[$i]);
			$list[] = $files[$i];
		}
		//倒序
		//for ($i = $end, $list = array(); $i < $len && $i < $end; $i++){
		//    $list[] = $files[$i];
		//}

		/* 返回数据 */
		$result = json_encode(array(
			"state" => "SUCCESS",
			"list" => $list,
			"start" => $start,
			"total" => count($files)
		));

		echo  $result;
	}
		/**
 * 遍历获取目录下的指定类型的文件
 * @param $path
 * @param array $files
 * @return array
 */
	public function getfiles($path, $allowFiles, &$files = array())
	{
		if (!is_dir($path)) return null;
		if(substr($path, strlen($path) - 1) != '/') $path .= '/';
		$handle = opendir($path);
		while (false !== ($file = readdir($handle))) {
			if ($file != '.' && $file != '..') {
				$path2 = $path . $file;
				if (is_dir($path2)) {
					$this->getfiles($path2, $allowFiles, $files);
				} else {
					if (preg_match("/\.(".$allowFiles.")$/i", $file)) {
						$files[] = array(
							'url'=> substr($path2, strlen($_SERVER['DOCUMENT_ROOT'])),
							'mtime'=> filemtime($path2)
						);
					}
				}
			}
		}
		return $files;
	}


}