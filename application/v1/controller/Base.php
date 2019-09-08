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

    protected $token = null;
    protected $data;
    protected $get;
    protected $userId;
    protected $tokenData;

    public function __construct(App $app = null) {
        $this->checkRequestType();//一定要比tp先初始化
//        $this->checkRoute();
        parent::__construct($app);
    }

    public function initialize() {
        parent::initialize();
        $this->data = input('post.');
        $this->get = input('get.');
        $this->userId = input('post.userId');
        if (!$this->userId) {
            $this->userId = input('get.userId');
        }
    }

    //检测option请求
    public function checkRequestType() {
        if (request()->method() == 'OPTIONS') {
            response([], 200, [], 'json')->send();
            die();
        }
    }

    public function checkRoute() {
        $this->token = Request::header('access-token');
//        d($this->token);
//        $token = substr($token, 7, strlen($token));
        if ($this->isInWhiteList(Request::baseUrl())) {
            //路由白名单
        } else {
            if (!$this->token) {
                response(["code" => -1, "msg" => 'token失效', "data" => []], 200, [], 'json')->send();
                die();
            }
            $result = verifyToken($this->token);
            if (!$result) {
                response(["code" => -1, "msg" => 'token失效', "data" => []], 401, [], 'json')->send();
                die();
            } else {
                $this->tokenData = decryptionToken($this->token)->id;
            }
        }
    }

    public function isInWhiteList($url) {
        $whiteList = [
            '/v1/user/login',
            '/v1/article/show',
            'file/upload',
            'comment/create',
            'comment/index'];
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


//    检测是否有这个属性
    public function checkHasProp($data, $props) {
        foreach ($props as $key => $value) {
            if (!isset($data[$key])) {
                response(["code" => '999999', "msg" => '缺少' . $value, "data" => []], 200, [], 'json')->send();
                die();
            }
            if ($data[$key] === '') {
                response(["code" => '999999', "msg" => $value . '不能为空', "data" => []], 200, [], 'json')->send();
                die();
            }
        }
    }
}