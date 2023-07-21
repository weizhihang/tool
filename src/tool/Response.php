<?php

namespace Vzinger\Tool;

class Response
{


    /**
     * 操作成功
     * @param string $msg     提示消息
     * @param null   $data    返回数据
     * @param int    $code    错误码
     * @param null   $type    输出类型
     * @param array  $header  发送的 header 信息
     * @param array  $options Response 输出参数
     */
    public static function apiSuccess($msg = '', $data = null, $code = 1, $type = null, $header = [], $options = [])
    {
        $result = [
            'code' => $code,
            'msg'  => $msg,
            'time' => time(),
            'data' => $data,
        ];

        return json_encode($result);
    }

    /**
     * 返回 API 数据
     * @param string $msg     提示消息
     * @param null   $data    返回数据
     * @param int    $code    错误码
     * @param null   $type    输出类型
     * @param array  $header  发送的 header 信息
     * @param array  $options Response 输出参数
     */
    function apiError($msg = '', $data = null, $code = 0, $type = null, array $header = [], $options = [])
    {
        $result = [
            'code' => $code,
            'msg'  => $msg,
            'time' => time(),
            'data' => $data,
        ];

        return json_encode($result);
    }
}
