<?php
/**
 * @Author: hepeng
 * @Date: 2018/12/21
 */
return [
    /* 默认数据库配置,使用Model时没有指定数据库使用的默认配置。多个数据库自己添加 */
    'default'=>[
        'type'        => 'mysql',     // 数据库类型  mysql,sqlserver,oracle,sqlite
        'host'        => 'localhost', // 服务器地址
        'db'    => 'test',// 数据库名
        'user'    => 'root',// 用户名
        'pass'    => 'root',// 密码
        'port'        => '3306',// 端口 默认为3306
    ],

];
