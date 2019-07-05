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
    protected $_dispatcher = null;
    /*
     * 构造函数
     */
    public function __construct (){}
    /*
     * 应用程序
     */
    public static function run()
    {
        self::initCommon();
        /* 路由执行 */
        $dispatcher = Yaf_Dispatcher::getInstance();
        $dispatcher->dispatch();
    }
    public static function initCommon(){
        /* 错误异常注册 */
        AppException::init();
        /* 加载配置 */
        Config::init();
        //加载公共函数
        G::Load();
    }
}