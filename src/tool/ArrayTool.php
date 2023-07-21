<?php

namespace Vzinger\Tool;

class ArrayTool
{

    /**
     * 判断参数是否为空
     * @param $key
     * @param $data
     * @return bool
     */
    public static function is_empty($key,$data){

        return !(isset($data[$key]) && $data[$key] !== '' && $data[$key] !== []);

    }

    /**
     * 批量判断参数是否为空
     * @param $keys
     * @param $data
     * @return bool
     */
    public static function is_have_empty($keys, $data)
    {

        $res = false;
        foreach ($keys as $value){
            if(self::is_empty($value,$data)){
                $res = true;
            }
        }
        return $res;
    }
}
