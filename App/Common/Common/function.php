<?php 

function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}
//图片裁剪
function cut_image($img, $width, $height, $type = 3){
    if(empty($width)&&empty($height)){
        return $img;
    }
    $imgDir = realpath(ROOT_PATH.$img);
    if(!is_file($imgDir)){
        return $img;
    }
    $imgInfo = pathinfo($img);
    $newImg = $imgInfo['dirname'].'/cut_'.$width.'_'.$height.'_'.$imgInfo["basename"];
    $newImgDir = ROOT_PATH.$newImg;
    if(!is_file($newImgDir)){
        $image = new \Think\Image();
        $image->open($imgDir);
        $image->thumb($width, $height,$type)->save($newImgDir);
    }
    return $newImg;
}
//默认数据
function default_data($data,$var){
	$info = !empty($data) ? $data: $var;
    return $info;
}
//获取变量
function zml_web($type){
	if ($type=='title') {
		$data = C('WEB_TITLE');
	}
	$this->title=C('WEB_TITLE');
}
//获取用户相关信息
function user($uin,$field){
    if ($field) {
        $info = M('user')->where(array('uin'=>$uin))->getField($field);
    }else{
        $info = M('user')->where(array('uin'=>$uin))->find();
    }
    return  $info;
}
//新闻分类调用函数 获取新闻分类相关信息
function news_category($id,$field){
	$info = M('news_category')->where(array('id'=>$id))->find();
	$info['url'] = U('news/index',array('id'=>$id));
	return  $field ? $info[$field]: $info;
}
//项目分类调用函数 获取项目分类相关信息
function item_category($id,$field){
    $info = M('item_category')->where(array('id'=>$id))->find();
    $info['url'] = U('Item/index',array('id'=>$id));
    return  $field ? $info[$field]: $info;
}
/**
 * 加密密码
 * @param string    $data   待加密字符串
 * @return string 返回加密后的字符串
 */
function encrypt($data) {
    return md5(md5(C('AUTH_CODE').md5($data)));
    //return md5(C("AUTH_CODE") . md5($data));
}


//根据代码地区获取地址
function region_address($region_id){
    $region = M('region')->where(array('id'=>$region_id))->find();

    $address_info['a'] = $region;

    if ($region['pid']!=0) {
        $address_info['b'] = M('region')->where(array('id'=>$region['pid']))->find();
    }

    if ($address_info['b']['pid']!=0) {
         $address_info['c'] = M('region')->where(array('id'=>$address_info['b']['pid']))->find();
    }

    if (count($address_info)==1) {
        $address_data['province'] = $address_info['a']['name'];
        
        $address_data['info'] = $address_info['a']['name'];
    }elseif (count($address_info)==2) {
        $address_data['province'] = $address_info['b']['name'];
        $address_data['city'] = $address_info['a']['name'];

        $address_data['info'] = $address_info['b']['name'].' '.$address_info['a']['name'];
    }else{
        $address_data['province'] = $address_info['c']['name'];
        $address_data['city'] = $address_info['b']['name'];
        $address_data['counties'] = $address_info['a']['name'];

        $address_data['info'] = $address_info['c']['name'].' '.$address_info['b']['name'].' '.$address_info['a']['name'];
    }
	
    return $address_data['info'];
}

//增加用户操作记录
function user_log($uin,$con,$type){
	$data['uin']=$uin;
	$data['con']=$con;
	$data['type']=$type;
	$data['time']=time();
	if(M('user_do_log')->token(true)->add($data)){
		return true;
	}else{
		return false;
	}
}
//传地区库的PID列出全部的下级
function get_region($pid){
	$region=M('region')->where(array('pid'=>$pid))->select();		
	return $region;
}
//传分类PID或取下级分类
function get_category($pid){
	$region=M('item_category')->where(array('pid'=>$pid))->select();		
	return $region;
}
//通过分类ID找出所有上级分类ID和name
function getupcate($id){    
    $cate=M('item_category')->order('pid asc')->select();
    $arr=array();
    foreach($cate as $v){
        if($v['id']==$id){
            $arr[]=$v;
            $arr=array_merge($arr,getupcate($v['pid']));
        }
    }
    return $arr;
}
//转换剩余时间格式
function gettime($time){
    if ($time < 0) {  
        return '已结束';  
    } else {  
        if ($time < 60) {  
            return $time . '秒';  
        } else {  
            if ($time < 3600) {  
                return floor($time / 60) . '分钟';  
            } else {  
                if ($time < 86400) {  
                    return floor($time / 3600) . '小时';  
                } else {  
                    if ($time < 259200) {//3天内  
                        return floor($time / 86400) . '天';  
                    } else {  
                        return floor($time / 86400) . '天';  
                    }  
                }  
            }  
        }  
    }  
}
function doLog($uin,$status = '0'){
    $where['uin'] = empty($uin) ? session('user.uin') : $uin;
    $where['status'] = $status;
    return D('User/UserDoLog')->countList($where);
}


/**
 * 将一个字符串部分字符用*替代隐藏
 * @param string    $string   待转换的字符串
 * @param int       $bengin   起始位置，从0开始计数，当$type=4时，表示左侧保留长度
 * @param int       $len      需要转换成*的字符个数，当$type=4时，表示右侧保留长度
 * @param int       $type     转换类型：0，从左向右隐藏；1，从右向左隐藏；2，从指定字符位置分割前由右向左隐藏；3，从指定字符位置分割后由左向右隐藏；4，保留首末指定字符串
 * @param string    $glue     分割符
 * @return string   处理后的字符串
 */
function hideStr($string, $bengin = 0, $len = 4, $type = 0, $glue = "@") {
    if (empty($string))
        return false;
    $array = array();
    if ($type == 0 || $type == 1 || $type == 4) {
        $strlen = $length = mb_strlen($string);
        while ($strlen) {
            $array[] = mb_substr($string, 0, 1, "utf8");
            $string = mb_substr($string, 1, $strlen, "utf8");
            $strlen = mb_strlen($string);
        }
    }
    switch ($type) {
        case 1:
            $array = array_reverse($array);
            for ($i = $bengin; $i < ($bengin + $len); $i++) {
                if (isset($array[$i]))
                    $array[$i] = "*";
            }
            $string = implode("", array_reverse($array));
            break;
        case 2:
            $array = explode($glue, $string);
            $array[0] = hideStr($array[0], $bengin, $len, 1);
            $string = implode($glue, $array);
            break;
        case 3:
            $array = explode($glue, $string);
            $array[1] = hideStr($array[1], $bengin, $len, 0);
            $string = implode($glue, $array);
            break;
        case 4:
            $left = $bengin;
            $right = $len;
            $tem = array();
            for ($i = 0; $i < ($length - $right); $i++) {
                if (isset($array[$i]))
                    $tem[] = $i >= $left ? "*" : $array[$i];
            }
            $array = array_chunk(array_reverse($array), $right);
            $array = array_reverse($array[0]);
            for ($i = 0; $i < $right; $i++) {
                $tem[] = $array[$i];
            }
            $string = implode("", $tem);
            break;
        default:
            for ($i = $bengin; $i < ($bengin + $len); $i++) {
                if (isset($array[$i]))
                    $array[$i] = "*";
            }
            $string = implode("", $array);
            break;
    }
    return $string;
}

/**
 * 功能：字符串截取指定长度
 * @param string    $string      待截取的字符串
 * @param int       $len         截取的长度
 * @param int       $start       从第几个字符开始截取
 * @param boolean   $suffix      是否在截取后的字符串后跟上省略号
 * @return string               返回截取后的字符串
 */
function cutStr($str, $len = 100, $start = 0, $suffix = 1) {
    $str = strip_tags(trim(strip_tags($str)));
    $str = str_replace(array("\n", "\t"), "", $str);
    $strlen = mb_strlen($str);
    while ($strlen) {
        $array[] = mb_substr($str, 0, 1, "utf8");
        $str = mb_substr($str, 1, $strlen, "utf8");
        $strlen = mb_strlen($str);
    }
    $end = $len + $start;
    $str = '';
    for ($i = $start; $i < $end; $i++) {
        $str.=$array[$i];
    }
    return count($array) > $len ? ($suffix == 1 ? $str . "&hellip;" : $str) : $str;
}

/**
 * 功能：短信发送函数
 * @param string $phone    接收者手机号码
 * @param string $message   短信内容
 * @return boolean
 */
function send_sms($phone,$message) {
    $message = $message.'【'.C('ZHIMALE.SMS_SIGN').'】';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://sms.zhimale.com/api/sms/send.json");

    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
    curl_setopt($ch, CURLOPT_HEADER, FALSE);

    curl_setopt($ch, CURLOPT_HTTPAUTH , CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD  , 'api:key-'.C('ZHIMALE.SMS_API_KEY'));

    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array('phone' => $phone,'message' => $message));

    $res = curl_exec( $ch );
    curl_close( $ch );
    //$res  = curl_error( $ch );
    $res = json_decode($res,true);

    return $res;
}

//检测短信平台是否配置
function is_sms() {
    if (C('ZHIMALE.SMS_API_KEY') and C('ZHIMALE.SMS_SIGN')) {
        $res = true;
    }else{
        $res = false;
    }

    return $res;
}
//curlget 请求函数
function curl_get($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    $res = curl_exec($ch);
    curl_close($ch);
    return $res;
}