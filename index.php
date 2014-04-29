<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
//如果你不是Windows环境下面的话，需要对应用目录Application设置可写权限才能自动生成。
// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',true);

// 定义应用目录
define('APP_PATH','./Application/');

//define('BIND_MODULE','Mobile');


/* define ( 'BUILD_CONTROLLER_LIST', 'Index,User,Product,ProductCategory,Order,Chat,PictureManagement,ShippingAddress' );
define ( 'BUILD_MODEL_LIST', 'User,Product,ProductCategory,Order,OrderItem,Message,Advisory,Picture,Address' ); */

//如果你的环境足够安全，不希望生成目录安全文件，可以在入口文件里面关闭目录安全文件的生成
define('BUILD_DIR_SECURE', false);

// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';