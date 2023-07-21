<?php


namespace Vzinger\Tool;

class TimeTool
{


    /**
     * 返回某月开始和结束的时间戳
     *
     * @return array
     */
    public static function month($date='now'){
        list($y, $m, $t) = explode('-', date('Y-m-t',strtotime($date)));
        return [
            mktime(0, 0, 0, $m, 1, $y),
            mktime(23, 59, 59, $m, $t, $y),
        ];
    }
    /**
     * 返回某天开始和结束的时间戳
     *
     * @return array
     */
    public static function day($date='now'){
        list($y, $m, $d) = explode('-', date('Y-m-d',strtotime($date)));
        return [
            mktime(0, 0, 0, $m, $d, $y),
            mktime(23, 59, 59, $m, $d, $y),
        ];
    }



    /**
     * 秒转化为天时分
     * @param $second
     * @return string
     */
    public static function convert($second)
    {
        $newtime = '';
        $d = floor($second / (3600*24));
        $h = floor(($second % (3600*24)) / 3600);
        $m = floor((($second % (3600*24)) % 3600) / 60);
        if ($d>'0') {
            if ($h == '0' && $m == '0') {
                $newtime= $d.'天';
            } else {
                $newtime= $d.'天'.$h.'小时'.$m.'分钟';
            }
        } else {
            if ($h!='0') {
                if ($m == '0') {
                    $newtime= $h.'小时';
                } else {
                    $newtime= $h.'小时'.$m.'分';
                }
            } else {
                $newtime= $m.'分';
            }
        }
        return $newtime;
    }

    /**
     * 将描述转化为00:00:00格式
     * @param $seconds
     * @param false $is_floor 秒之后是否带小数点
     * @return string
     */
    public static function secondsToTime($seconds,$is_floor=false) {

        $decimal = $seconds * 100 % 100;

        $seconds = floor($seconds);
        $hours = floor($seconds / 3600);

        $minutes = floor(($seconds - ($hours * 3600)) / 60);

        $seconds = $seconds - ($hours * 3600) - ($minutes * 60);

        $str =  str_pad($hours, 2, '0', STR_PAD_LEFT).':'.str_pad($minutes, 2, '0', STR_PAD_LEFT).':'.str_pad($seconds, 2, '0', STR_PAD_LEFT);

        if($is_floor){
            $str = $str . '.' . $decimal;
        }
        return $str;
    }
}
