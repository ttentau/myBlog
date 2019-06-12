<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/5/2
 * Time: 2:58
 */

namespace app\v1\controller;


use app\common\model\MessageModel;
use Ramsey\Uuid\Uuid;
use think\Db;

class Message extends Base {
    private $model;
    private $data;
    private $get;


    protected function initialize() {
        parent::initialize();
        $this->model = new MessageModel();
        $this->data = input('post.');
        $this->get = input('get.');
    }


    public function create($title, $content, $userId) {
        $data = [];
        $data['id'] = Uuid::uuid4()->toString();
        $data['title'] = $title;
        $data['content'] = $content;
        $data['userId'] = $userId;
        // 建立socket连接到内部推送端口
//        $client = stream_socket_client('tcp://127.0.0.1:5678');
//        fwrite($client, 'uid1'."\n");
//        echo fread($client, 8192);

        return $this->model->save($data);
    }

    public function index() {
        $result = $this->model->all();
        return success($result, 'message list');
    }

    public function del() {
        $msg = $this->model->get($this->get['id']);
        if (!$msg) {
            return fail('', '没有这条数据');
        }
        $result = $msg->delete();
        if ($result) {
            return success($result, '删除成功');
        }
        return fail($result, '删除失败');
    }

    public function delAll() {
        $result = Db::name('message')->delete(true);
        if ($result) {
            return success($result, '删除成功');
        }
        return fail($result, '删除失败');
    }
}