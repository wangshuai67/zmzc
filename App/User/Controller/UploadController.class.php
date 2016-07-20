<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.zhimale.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  预感 <442648313@qq.com>
// +----------------------------------------------------------------------
namespace User\Controller;
use Think\Controller;
class UploadController extends PublicController {
    public function index(){
		if(!IS_POST){
			date_default_timezone_set("Asia/Chongqing");
			error_reporting(E_ERROR);
			header("Content-Type: text/html; charset=utf-8");
			$CONFIG = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents('.'.C('JS')."ueditor1_4_3-utf8-php/php/config.json")), true);				
			$action = I('get.action');
			switch ($action) {
				case 'config':
					$result =  json_encode($CONFIG);
					echo $result;
					break;
				case 'listimage':
					$result = new \Vendor\Imageslist();// 实例化上传类	
					echo $result;					
					break;				
				 default:
					$this->display();
					break;
			}
		}else{
			//本地配置
			$config = array(
					//'maxSize'    =    3145728,
					'rootPath'   =>    C('rootPath'),
					'savePath'   =>    '',
					'saveName'   =>    array('uniqid',''),
					'exts'       =>   explode(',',C('upload_exts')),
					'autoSub'    =>    false,
					//'subName'    =>    array('date','Ymd'),
			);
			
			$type='Local';
			$upload = new \Think\Upload($config,$type);// 实例化上传类				
			$info   =   $upload->upload();
		//print_r($info);
		if(!$info) {// 上传错误提示错误信息
			$this->error($upload->getError()) ;
		}else{// 上传成功			
			foreach($info as $file){
					$imgurl=C('rootPath').$file['savepath'].$file['savename'];
					$image = new \Think\Image();				
					if(C('IS_thumb')=='1'){	
						$image->open($imgurl);					
						$image->thumb(C('thumb_width'), C('thumb_height'),C('thumb_leixin'))->save($imgurl);	
					}
					if(C('IS_water')=='1'){
						if(C('water_lbs')=='10'){
							$lbs=rand(1,9);
						}
						$image->open($imgurl)->water('.'.C('water'),$lbs,C('water_touming'))->save($imgurl);
					}					
				
				echo json_encode(array(
								'status' 	=> 1,
								'error' 	=> 0,
								'url'		=>str_replace('./','/',$imgurl),
								'original'	=>$file['name'],
								'state'		=>'SUCCESS'
				));
			}
		}
		}
    }
}