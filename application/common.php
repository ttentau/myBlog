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


// 应用公共文件
use Firebase\JWT\JWT;

function generateToken($id) {
    $token = array(
        "iss" => "ttentau",//签发者
        "aud" => "all", //面向的用户
        "iat" => time(), //签发时间
        "nbf" => time(), //在什么时候jwt开始生效 
        "exp" => time() + 60 * 60 * 24 * 5, //token 过期时间(5 天)
        'id' => $id //可以用户ID，可以自定义
    ); //Payload
    $jwt = JWT::encode($token, config('token_key'));
    return $jwt;
}

function decryptionToken($jwt) {
    $decoded = JWT::decode($jwt, config('token_key'), array('HS256'));
    return $decoded;
}

function verifyToken($jwt) {
    try {
        $decoded = JWT::decode($jwt, config('token_key'), array('HS256'));
        return $decoded;
    } catch (Exception $e) {
        return false;
    }
}


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

function d($msg) {
    dump($msg);
    die();
}

class  Status {
    public static $Normal = 0;
    public static $Delete = 1;
    public static $Hide = 2;
}