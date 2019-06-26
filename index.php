<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
header('Access-Control-Allow-Origin: *');
// 绑定当前访问到index模块
define('BIND_MODULE','index');
// 定义应用目录
define('APP_PATH', __DIR__ . '/app/');
//加载第三方
# 在项目中加载初始化文件
include "./vendor/WeChatDeveloper/include.php";
// 加载框架引导文件
require __DIR__ . '/thinkphp/start.php';


// location /zhiyiapi/ {
//     if (!-e $request_filename){
//         rewrite  ^/zhiyiapi/(.*)$  /zhiyiapi/index.php?s=/$1  last;
//     }
// }
