<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/4/1
 * Time: 17:11
 */
function autoload ($sClassName)
{
    $sFile = implode(DS, explode('_', $sClassName)) . '.php';
    $aDir = ["core","util","extend"];
    foreach ($aDir as $dk=>$dv){
        $sPath = LIB_PATH.$dv.DS;
        if (file_exists($sPath  . $sFile)) {
            require_once $sPath  . $sFile;
            return true;
        }
    }
    return false;
}
/*
 * 自动加载
 */
spl_autoload_register('autoload');
//Composer
require_once ROOT_PATH . 'vendor'.DS."autoload.php";