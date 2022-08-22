<?php


namespace tool;


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


}
