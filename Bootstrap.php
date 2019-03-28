<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//定义路径
define('DS', DIRECTORY_SEPARATOR);
//定义常量
defined('APP_PATH') or define('APP_PATH', dirname(__DIR__ ). DS .'app'.DS);
define('ROOT_PATH', dirname(APP_PATH).DS);
define('LIB_PATH', ROOT_PATH.'library'.DS);
define('CORE_PATH', LIB_PATH.'core'.DS);
define('COMMON_PATH', APP_PATH.'common'.DS);

//默认日志级别
define('LOG_LEVEL',     2);
define('LOG_ERROR',     2);
define('LOG_DEBUG',     4);
define('LOG_SYS',     1);

// 自动加载
require CORE_PATH.'Loader.php';
// 应用初始化
App::run();
