<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/4/2
 * Time: 13:33
 */
class Config
{
    /**
     * @var array 配置参数
     */
    private static $config = [];
    /**
     * 加载配置文件（PHP格式）
     * @access public
     * @param  string $file  配置文件名
     * @return mixed
     */
    private static function loadConfig($file)
    {
        /* 如果已加载了配置文件 */
        if ($file == null || isset(self::$config[$file])){
            return;
        }
        /* 判断文件是否存在 */
        $confDir = COMMON_PATH."conf".DS;
        if (!file_exists($confDir . $file . '.php')) {
            throw new  Exception('Config file ' . $file . ' not find!');
        }
        self::$config[$file] = include_once $confDir . $file . '.php';
    }

    /**
     * 获取配置参数 为空则获取所有配置
     * @access public
     * @param $key
     * @param null $type
     * @param $file
     * @return mixed
     * @throws Exception
     */
    public static function get($file, $type = null, $key = null)
    {
        //如果没有加载，则加载
        self::loadConfig($file);

        /* 没填file或没找到 */
        if (is_null($file) || !isset(self::$_config[$file])) {
            return null;
        }
        /* 如果没有type */
        if(is_null($type)) {
            return self::$_config[$file];
        }
        /* 如果找不到type */
        if(!isset(self::$_config[$file][$type])) {
            return null;
        }
        /* 如果没有file */
        if(is_null($key)){
            return self::$_config[$file][$type];
        }
        /* 如果找不到file */
        if(!isset(self::$_config[$file][$type][$key])){
            return null;
        }
        /* 返回配置值 */
        return self::$_config[$file][$type][$key];
    }
}