<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/3
 * Time: 0:22
 */

namespace app\v1\controller;


use think\App;
use think\Controller;
use think\facade\Request;

class Base extends Controller {

    public function __construct(App $app = null) {
        $this->checkRequestType();//一定要比tp先初始化
        $this->checkRoute();
        parent::__construct($app);

    }

    //检测option请求
    public function checkRequestType() {
        if (request()->method() == 'OPTIONS') {
            die();
        }

    }

    public function checkRoute() {
        $token = Request::header('access-token');
//        d($token);
//        $token = substr($token, 7, strlen($token));
        if ($this->isInWhiteList(Request::baseUrl())) {
            //路由白名单
        } else {
            $result = verifyToken($token);
            if (!$result) {
                echo "{\"status\":-1,\"msg\":\"token失效\",\"data\":\"\"}";
                die();
            }
        }
    }

    public function isInWhiteList($url) {
        $whiteList = ['/v1/user/login','/v1/article/show'];
        $result = false;
        foreach ($whiteList as $item) {
            if (strpos($url, $item) !== false) {
//                echo '包含';
                $result = true;
                break;
            } else {
//                echo '不包含';
            }
        }
        return $result;
    }
}