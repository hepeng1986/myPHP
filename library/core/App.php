<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/4/2
 * Time: 9:57
 * 静态类？
 */
class App
{
    /*
     * 构造函数
     */
    public function __construct ()
    {
        /* 错误异常注册 */
        AppException::init();
        /* 加载配置 */
        Config::init();
    }
    /*
     * 应用程序
     */
    public function run()
    {

    }
}