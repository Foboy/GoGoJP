<?php
return array (
		// '配置项'=>'配置值'
		'DB_TYPE' => 'pdo', // 数据库类型
		/* 
		'DB_HOST' => 'localhost', // 服务器地址
		'DB_NAME' => 'gogojp', // 数据库名 */
		'DB_USER' => 'root', // 用户名
		'DB_PWD' => '111111', // 密码
		'DB_PORT' => '3306', // 端口
		'DB_PREFIX' => 'gogojp_' , // 数据库表前缀
		'DB_DSN'       =>  'mysql:host=localhost;dbname=gogojp;',     // 数据库连接DSN 用于PDO方式
		'DB_CHARSET'=> 'utf8',
		// 关闭字段缓存
		'DB_FIELDS_CACHE'=>false,
		'URL_MODEL'=>3 ,//URL兼容模式
		'VAR_PATHINFO'=>'url'    //兼容模式PATHINFO获取变量例如 ?url=/module/action/id/1 后面的参数取决于URL_PATHINFO_DEPR
);