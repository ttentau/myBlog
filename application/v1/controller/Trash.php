<?php


namespace app\v1\controller;

use app\common\model\ArticleModel;
use Status;

class Trash extends Base {
    private $model;
    private $data;
    private $get;


    protected function initialize() {
        parent::initialize();
        $this->model = new ArticleModel();
        $this->data = input('post.');
        $this->get = input('get.');

    }


    //获取所有数据
    public function index() {
        $offset = $this->get['offset'];
        $limit = $this->get['limit'];
        $list = $this->model->where(['status' => Status::$Delete])->all();
        $data = $this->model->where(['status' => Status::$Delete])->limit($offset * $limit, $limit)->all();
        return success(['count' => count($list), 'list' => $data]);
    }


    //恢复
    public function restore() {
        $post = $this->model->get(input('get.id'));
        if (!$post) {
            return fail('', '没有这条数据');
        }
        $post->status = Status::$Normal;
        $result = $post->save();
        if ($result) {
            return success($post, '恢复成功');
        }
        return fail($result, '恢复失败');
    }

    //删除
    public function del() {
        $post = $this->model->get(input('get.id'));
        if (!$post) {
            return fail('', '没有这条数据');
        }
        $result = $post->delete();
        if ($result) {
            return success($post, '彻底删除成功');
        }
        return fail($result, '彻底删除失败');
    }

}