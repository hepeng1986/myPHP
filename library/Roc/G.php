<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/4/2
 * Time: 16:33
 * 存在框架内部用到的全局函数
 */
class G
{
    /**
     * 提取出异常错误里的详细信息
     *
     * @param object $oExp
     * @param string $sImp
     */
    public static function dealException ($oExp, $sImp = "\n")
    {
        $aMsg = array();
        $aMsg[] = '# 错误时间 => ' . date('Y-m-d H:i:s');
        $aMsg[] = '# 请求URL=> ' . Yaf_G::getUrl();
        $aMsg[] = '# 请求参数 => ' . json_encode(self::getParams(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        if ($oExp->getCode() > 0) {
            $aMsg[] = '# 错误代码 => ' . $oExp->getCode();
        }
        $aMsg[] = '# 错误消息 => ' . $oExp->getMessage();
        $aMsg[] = '# 错误位置 => ' . $oExp->getFile() . '(' . $oExp->getLine() . '行)';
        $aEtrac = $oExp->getTrace();
        $iTotalEno = count($aEtrac) - 1;
        $iEno = 0;
        foreach ($aEtrac as $iEno => $aTrace) {
            $aMsg[] = '================================================================' . $sImp;
            $tmp = '第' . ($iTotalEno - $iEno) . '步 ';
            if (isset($aTrace['file'])) {
                $tmp .= '文件:' . $aTrace['file'] . ' (' . $aTrace['line'] . '行)';
            }

            $tmp .= $sImp . '函数名：';
            if (isset($aTrace['class'])) {
                $tmp .= $aTrace['class'] . '->';
            }
            $tmp .= $aTrace['function'] . '()';
            if (isset($aTrace['args']) && ! empty($aTrace['args'])) {
                $aTmpArg = array();
                foreach ($aTrace['args'] as $ano => $aArg) {
                    $atmp = $sImp . '@参数_' . $ano . '( ' . gettype($aArg) . ' ) = ';
                    if (is_numeric($aArg) || is_string($aArg)) {
                        $atmp .= $aArg;
                    } elseif (is_object($aArg)) {
                        $atmp .= get_class($aArg);
                    } else {
                        $atmp .= json_encode($aArg);
                    }
                    $aTmpArg[] = $atmp;
                }
                $tmp .= implode('', $aTmpArg);
            }
            $aMsg[] = $tmp;
        }
        return implode($sImp, $aMsg);
    }
}