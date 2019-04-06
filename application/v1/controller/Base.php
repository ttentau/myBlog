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
//        $this->checkRoute();
        parent::__construct($app);

    }

    //检测option请求
    public function checkRequestType() {
        if (request()->method() == 'OPTIONS') {
            die();
        }

    }

    public function checkRoute() {
        $data = input('post.');
        $token = Request::header('AccessToken');
        if ($this->isInWhiteList(Request::baseUrl())) {
            //路由白名单
        } else {
            $result = verifyToken($token);
            if ($result) {
                $token = (array)$result;
                if ($token['id'] === $data['CreateBy'] && $token['exp'] > time()) {

                } else {
                    echo "{\"status\":-1,\"msg\":\"token失效\",\"data\":\"\"}";
                    die();
                }
            } else {
                echo "{\"status\":-1,\"msg\":\"token失效\",\"data\":\"\"}";
                die();
            }
        }
    }

    public function isInWhiteList($url) {
        $whiteList = ['register', 'login','AndroidUploadFile',
            'getPatientsBySn', 'getPatientDrugs','getAlarmClocks','getOneClinical',
            'checkLastVersion','downloadApk',
            'download-apk','check-last-version','change-password','get-one-day-takedrugrecords','get-all-takedrugrecords','get-alarm-clocks',
            'get-token','get-image','get-patient-drugs','get-one-clinical','get-patients-by-sn'
        ];
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