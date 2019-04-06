<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function success($data = "", $msg = "", $status = 1) {
    return json([
        "status" => $status,
        "msg" => $msg,
        "data" => $data,
    ]);
}

function fail($data = "", $msg = "", $status = -1) {
    return json([
        "status" => $status,
        "msg" => $msg,
        "data" => $data,
    ]);
}
function d($msg){
    dump($msg);
    die();
}

class  Status {
    public static $Normal = 0;
    public static $Delete = 1;
    public static $Hide = 2;
}