<?php

namespace Vzinger\Tool;

class Mixed
{

    /**
     * 生成一个uuid  带 -
     * @return string
     */
    public static function uuid()
    {
        $chars = md5(uniqid(mt_rand(), true));
        $uuid = substr($chars, 0, 8) . '-'
            . substr($chars, 8, 4) . '-'
            . substr($chars, 12, 4) . '-'
            . substr($chars, 16, 4) . '-'
            . substr($chars, 20, 12);
        return $uuid;
    }

    /**
     * 生成一个uuid  不带 -
     * @return string
     */
    public static function unique()
    {
        $chars = md5(uniqid(mt_rand(), true));
        $uuid = substr($chars, 0, 8)
            . substr($chars, 8, 4)
            . substr($chars, 12, 4)
            . substr($chars, 16, 4)
            . substr($chars, 20, 12);
        return $uuid;
    }


    /**
     * 生成一个随机字符串
     * @param $length
     * @return string
     */
    function getNonceStr($length = 8)
    {
// 密码字符集，可任意添加你需要的字符
        $chars = 'abcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*-_ +=';
        $str = '';
        for ($i = 0; $i < $length; $i++) {
// 这里提供两种字符获取方式
// 第一种是使用 substr 截取$chars中的任意一位字符；
// 第二种是取字符数组 $chars 的任意元素
// $password .= substr($chars, mt_rand(0, strlen($chars) – 1), 1);
            $str .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $str;
    }

    /**
     * 加密函数
     * @param $txt
     * @param string $key
     * @return string
     */
    public static function encrypt($txt, $key = 'vzinger')
    {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-=+";
        $nh = rand(0, 64);
        $ch = $chars[$nh];
        $mdKey = md5($key . $ch);
        $mdKey = substr($mdKey, $nh % 8, $nh % 8 + 7);
        $txt = base64_encode($txt);

        $tmp = '';
        $j = 0;
        $k = 0;
        for ($i = 0; $i < strlen($txt); $i++) {
            $k = $k == strlen($mdKey) ? 0 : $k;
            $j = ($nh + strpos($chars, $txt[$i]) + ord($mdKey[$k++])) % 64;
            $tmp .= $chars[$j];
        }
        return urlencode($ch . $tmp);
    }

    /**
     * 解密函数
     * @param $txt
     * @param string $key
     * @return false|string
     */
    public static function decrypt($txt, $key = 'vzinger')
    {
        $txt = urldecode($txt);
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-=+";
        $ch = $txt[0];
        $nh = strpos($chars, $ch);
        $mdKey = md5($key . $ch);
        $mdKey = substr($mdKey, $nh % 8, $nh % 8 + 7);
        $txt = substr($txt, 1);
        $tmp = '';
        $j = 0;
        $k = 0;
        for ($i = 0; $i < strlen($txt); $i++) {
            $k = $k == strlen($mdKey) ? 0 : $k;
            $j = strpos($chars, $txt[$i]) - $nh - ord($mdKey[$k++]);
            while ($j < 0) $j += 64;
            $tmp .= $chars[$j];
        }
        return base64_decode($tmp);
    }
}
