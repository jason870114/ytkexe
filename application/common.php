<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
error_reporting(E_ERROR | E_PARSE );
//分页公共类
function JsonRes($code,$data,$token,$total)   //编号,数据（数组）,token,分页总数
{

	    $result['code']=$code;                //必有
	    $result['des']=errdes($code);         //必有
	    if($data)  $result['data']=$data;     //可选
	    if($total)  $result['total']=$total;  //可选
	    if($token)  $result['token']=$token;  //可选

	    return json_encode($result);
}

//错误编码详情
function errdes($code)
{
	$arr = array(
		'200'=>"成功",
		'1001'=>"信息不存在",
		'1002'=>"验证密码错误",
		'1003'=>"图片过大",
		'1004'=>"不是标准的base64",
		'1005'=>"匹配不完整",
		'1006'=>"传入图片格式不正确",
		'1007'=>"传入图片失败",
		'1010'=>"信息未修改",
		'1011'=>"用户名或密码错误",
		'1012'=>"传入参数不能为空",
		'1013'=>"token不正确或已过期",
		'1014'=>"密码未修改",
		'1015'=>"原密码错误",
		'1016'=>"添加失败",
		'1017'=>"删除失败",
		'1018'=>"查询失败",
		'1019'=>"今天已经留过言了",
		'1020'=>"留言未成功",
		'1021'=>"已绑定用户，请解绑后操作",
		'1022'=>"超级管理员不能删除",
		'1023'=>"当前名称已存在",
		'1024'=>"该分类下有文章，不能删除",
		


	);
	if(!$arr[$code]){
		return "未知错误";
	}
	return $arr[$code];

}

//base64文件公共方法  
function base64($filestr,$filepath,$MaxSize = 300,$filetype = array('jpeg','jpg','png')){  //base64文件,文件路径，文件最大kb，文件类型（数组）
    //计算上传文件的大小
    $filesize = round(strlen($filestr)/1024/4*3,1);   //单位kb
    if($filesize>$MaxSize) return JsonRes(1003);
    $img = str_replace(array('_','-'), array('/','+'), $filestr);
    $b64img = substr($img, 0, 100);
    if (!preg_match('/^(data:\s*image\/(\w+);base64,)/', $b64img, $matches)) return JsonRes(1004);
    if (count($matches) < 3) return JsonRes(1005); 
    if (!in_array($matches[2], $filetype)) return JsonRes(1006); 
    $type = $matches[2]; 
    $basedirmain = $filepath.create_guid().'.'.$type;     
    if (!is_dir($filepath))  mkdir($filepath,0777,true); 
    $img = str_replace($matches[1], '', $img); 
    $img = base64_decode($img);
    if (!file_put_contents($basedirmain, $img)) return JsonRes(1007);
    $data['uploads'] = $basedirmain;
    return JsonRes(200,$data);

}

	

	

//二维码公共方法
function ewm($url,$logo){
	Vendor('phpqrcode.phpqrcode');
	$object = new \QRcode();
	$ad = 'Uploads/erweima/'.create_guid().'.png';   //erweima文件夹必须存在
	if(!$logo){ //判断是否带LOGO
        //生成二维码图片
        $level=3;
        $size=9;
        $errorCorrectionLevel =intval($level) ;//容错级别
        $matrixPointSize = intval($size);//生成图片大小
        $object->png($url,$ad, $errorCorrectionLevel, $matrixPointSize, 2); 
	}else{
        $errorCorrectionLevel = 'L';//容错级别   // 纠错级别：L、M、Q、H
        $matrixPointSize = 9;//生成图片大小     1到10
        //生成二维码图片  
        $object->png($url, $ad, $errorCorrectionLevel, $matrixPointSize, 2);  
        //$QR = 'erweima/'.create_guid().'.jpg';//已经生成的原始二维码图  
        $QR = $ad;
        if ($logo !== FALSE) {  
          $QR = imagecreatefromstring(file_get_contents($QR));  
          $logo = imagecreatefromstring(file_get_contents($logo));  
          $QR_width = imagesx($QR);//二维码图片宽度  
          $QR_height = imagesy($QR);//二维码图片高度  
          $logo_width = imagesx($logo);//logo图片宽度  
          $logo_height = imagesy($logo);//logo图片高度  
          $logo_qr_width = $QR_width / 5;  
          $scale = $logo_width/$logo_qr_width;  
          $logo_qr_height = $logo_height/$scale;  
          $from_width = ($QR_width - $logo_qr_width) / 2;  
          //重新组合图片并调整大小  
          imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,  
          $logo_qr_height, $logo_width, $logo_height);  
        }
        //输出图片  带logo图片
        imagepng($QR, $ad); 
	}
	return $ad;
}



//32位随机数 
function create_guid() {
    $charid = strtoupper(md5(uniqid(mt_rand(), true)));
    $hyphen = chr(45);// "-"
    $uuid = substr($charid, 0, 8)
    .substr($charid, 8, 4)
    .substr($charid,12, 4)
    .substr($charid,16, 4)
    .substr($charid,20,12);// "}"
    return $uuid;
}
//12位随机数
function create_guid2() {
    $charid = strtoupper(md5(uniqid(mt_rand(), true)));
    $hyphen = chr(45);// "-"
    $uuid = substr($charid, 0, 8).substr($charid, 8, 4);// "}"
    return $uuid;
}
//登录成功生成给出新的token
function loginToken(){
	
	//测试和官网是否匹配begin
    $payload=array('iss'=>'admin',
    	'iat'=>time(),
    	'exp'=>time()+3600,
    	'jti'=>md5(uniqid('JWT').time()));;
    $jwt=new \my\Jwt();
    //$Test = new \my\Test();
    $token=$jwt::getToken($payload);
    return $token;
	
}
//验证token
function yzToken($token){
  //import('jwt','./jwt','.php');
  $jwt=new \my\Jwt();
	 //对token进行验证签名
  $getPayload=$jwt->verifyToken($token);
  
  if(!$getPayload){
  	 return false;
  }
  return ture;
  


}
// //token过期验证，通过后生成新的token并增加30分钟
// function token_time($token){
// 	//通过查询数据库判断当前token是否失效，并查出ID及登录时间    1600秒
// 	//echo 1558522425-1558521225;
// 	$restime = M()->query("SELECT
// 					ykb_userlist.userlist_uuid,
// 					ykb_userlist.userlist_tokentime,
// 					ykb_userlist.userlist_name
// 					FROM
// 					ykb_userlist
// 					WHERE ykb_userlist.userlist_token in ('%s')",$token);

// 	$userlist_uuid = $restime[0]['userlist_uuid'];
// 	$userlist_tokentime = $restime[0]['userlist_tokentime'];
// 	$userlist_name = $restime[0]['userlist_name'];
// 	$nowtime = time();
// 	if($nowtime - $userlist_tokentime>3600){
// 		echo BuildState('1013','');
//         exit;
// 	}
// 	$newtoken = create_guid();//新token
// 	M()->execute("UPDATE ykb_userlist SET 
// 						userlist_token = '%s',	
// 						userlist_tokentime=unix_timestamp(now()),
// 						userlist_dltime=unix_timestamp(now()) 
// 						WHERE ykb_userlist.userlist_uuid='%s'",$newtoken,$userlist_uuid);    //存token，token过期时间,登录时间
// 	return $newtoken;


// }		
function headcommon(){
	    $postArr = input();  //传入参数
		return $postArr;
}


//返回JSON公共类
function BuildState($code,$jo)
{
		
	    $data['code']=$code;
	    $data['des']=errdes($code);
	    $data['data']=$jo;
	    return json_encode($data);
}


//不分页带token
function JsonDateToken($code,$jo,$token)
{
		
	    $data['code']=$code;
	    $data['des']=errdes($code);
	    $data['data']=$jo;
	    $data['token']=$token;
	    return json_encode($data);
}

//token公共类，适用只返回token
function TokenData($code,$token)
{
		
	    $data['code']=$code;
	    $data['des']=errdes($code);
	    $data['token']=$token;
	    return json_encode($data);
}
//分页                  表名,字段名,字段值,用户UUID,学校uuid，文章ID，审核状态
function selectList($table,$mhselect,$value,$user_uuid,$leftjoin,$school_uuid,$artclass_id,$article_manager_shzt){   

		$page = $_GET['page'];  //页码
		$limit = $_GET['limit']; //每页显示
		if(!$page){
			$page = 1;
		}
		if(!$limit){
			$limit=1;
		}
		$start = ($page-1)*$limit;
		
		if(!$mhselect){
			$sql = "SELECT count(*) as allcount FROM ".$table.$leftjoin." where 1=1 ";
			//$resall = M()->query("SELECT count(*) as allcount FROM %s",$table);
		}else{
			$sql = "SELECT count(*) as allcount FROM ".$table.$leftjoin." WHERE ".$mhselect." like  concat('%','" . $value . "','%')";
			//$resall = M()->query("SELECT count(*) as allcount FROM ".$table." WHERE ".$mhselect." like  concat('%','" . $value . "','%')");
		}
		if($user_uuid){
			$sql.=" and ".$table.".userlist_uuid='".$user_uuid."'";
			if($article_manager_shzt){
				$sql.=" and ykb_article_manager.article_manager_shzt=".$article_manager_shzt;
			}
		}else{
			if($table=='ykb_article_manager'){
				$sql.=" and ykb_article_manager.article_manager_shzt=2";
			}
			
		}
		if($school_uuid){
			$sql.=" and ".$table.".school_uuid='".$school_uuid."'";
		}
		if($artclass_id){
			$sql.=" and ".$table.".artclass_id='".$artclass_id."'";
		}
		$resall = Db()->query($sql);
		$total = $resall[0]['allcount'];
		if($page=='-1'){
			$limit = $total;
			$page=1;
			$start=0;

		}

		$data['page'] = $page;
		$data['start'] = $start;
		$data['limit'] = $limit;
		$data['total'] = $total;

		return $data;

}
//分页
function selectList2($table,$name,$value,$name2,$value2){

		$page = $_GET['page'];  //页码
		$limit = $_GET['limit']; //每页显示
		if(!$page){
			$page = 1;
		}
		if(!$limit){
			$limit=1;
		}
		$start = ($page-1)*$limit;
		if(!$name&&!$name2){
			$resall = Db()->query("SELECT count(*) as allcount FROM %s",$table);
		}elseif($name&&!$name2){
			$resall = Db()->query("SELECT count(*) as allcount FROM ".$table." WHERE ".$name." like  concat('%','" . $value . "','%')");
		}elseif(!$name&&$name2){
			$resall = Db()->query("SELECT count(*) as allcount FROM ".$table." WHERE ".$name2." like  concat('%','" . $value2 . "','%')");
		}else{
			$resall = Db()->query("SELECT count(*) as allcount FROM ".$table." 
				WHERE ".$name." like  concat('%','" . $value . "','%') and ".$name2." like  concat('%','" . $value2 . "','%')");
		}

		$total = $resall[0]['allcount'];
		if($page=='-1'){
			$limit = $total;
			$page=1;
			$start = 0;
		}

		$data['page'] = $page;
		$data['start'] = $start;
		$data['limit'] = $limit;
		$data['total'] = $total;

		return $data;

}
//用户管理
function selectList3($table,$name,$value,$name2,$value2,$inner){

		$page = $_GET['page'];  //页码
		$limit = $_GET['limit']; //每页显示
		if(!$page){
			$page = 1;
		}
		if(!$limit){
			$limit=1;
		}
		$start = ($page-1)*$limit;
		$tableAndInner = $table.$inner;
		if(!$name&&!$name2){
			$resall = Db()->query("SELECT count(*) as allcount FROM %s".$inner,$table);
		}elseif($name&&!$name2){
			$resall = Db()->query("SELECT count(*) as allcount FROM ".$tableAndInner." and ".$name." like  concat('%','" . $value . "','%')");
		}elseif(!$name&&$name2){
			$resall = Db()->query("SELECT count(*) as allcount FROM ".$tableAndInner." and ".$name2." like  concat('%','" . $value2 . "','%')");
		}else{
			$resall = Db()->query("SELECT count(*) as allcount FROM ".$tableAndInner." 
				and ".$name." like  concat('%','" . $value . "','%') and ".$name2." like  concat('%','" . $value2 . "','%')");
		}

		$total = $resall[0]['allcount'];
		if($page=='-1'){
			$limit = $total;
			$page=1;
			$start = 0;
		}

		$data['page'] = $page;
		$data['start'] = $start;
		$data['limit'] = $limit;
		$data['total'] = $total;

		return $data;

}
//ger的token是否传入判断
function pdtokennull(){
	$token = $_GET['token']; 
	//如果传token则更新token
	if($token){
		$newtoken = token_time($token);
	}else{
		$newtoken = '';
	}
	return $newtoken;
}
//分页类多条查询
function fydtcx($res,$total,$newtoken){
	if(!$res){
		return Jsonres('200',array(),'',$newtoken);
        exit;
	}
	return Jsonres('200',$res,$total,$newtoken);
}

//不分页类多条查询
function bfxdtcx($res,$newtoken){
	if(!$res){
		return JsonDateToken('200',array(),$newtoken);
        exit;
	}
	return JsonDateToken('200',$res,$newtoken);
}


//单条查询
function onlySelect($res,$newtoken){
	if(!$res){
		return JsonDateToken('200',(object)[],$newtoken);
        exit;
	}
	return JsonDateToken('200',$res[0],$newtoken);
}

//新增
function insertDes($res,$newtoken){
	if(!$res){
			return TokenData('1016',$newtoken);
            exit;
	}
		
	return TokenData('200',$newtoken);
}
//修改
function updateDes($res,$newtoken){
	if(!$res){
			return TokenData('1010',$newtoken);
            exit;
	}
		
	return TokenData('200',$newtoken);

}
//删除
function DelDes($res,$newtoken){
	if(!$res){
			return TokenData('1017',$newtoken);
            exit;
	}
		
	return TokenData('200',$newtoken);

}
