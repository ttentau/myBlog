<?php

namespace app\v1\controller;

use app\common\model\ArticleModel;
use Ramsey\Uuid\Uuid;
use Status;

class Article extends Base {
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
        $where = [];
        if (array_key_exists('title', $this->get)) {
            $title = $this->get['title'];
            $where['title'] = $title;
        }
//        d($where);
        $list = $this->model->where($where)->where('status','<>',Status::$Delete)->all();
        $data = $this->model->where($where)->where('status','<>',Status::$Delete)->limit($offset * $limit, $limit)->all();
        return success(['count' => count($list), 'list' => $data]);
    }

    //获取一条数据
    public function one() {
        $data = $this->model->find(['id' => $this->get['id']]);
        return success(['count' => 1, 'list' => $data]);
    }

    //获取所有可见的帖子
    public function show() {
        $offset = $this->get['offset'];
        $limit = $this->get['limit'];
        $list = $this->model->where(['status' => Status::$Normal])->all();
        $data = $this->model->where(['status' => Status::$Normal])->limit($offset * $limit, $limit)->all();
        return success(['count' => count($list), 'list' => $data]);
    }


    //添加
    public function create() {
        //检测数据库里是否已经存在这条数据
        $title = $this->data['title'];
        $post = $this->model->where(['title' => $title])->find();
        if ($post) {
            return fail($post, '已经存在这条数据了');
        }
        $this->data['id'] = Uuid::uuid4()->toString();
        $result = $this->model->allowField(true)->save($this->data);
        if ($result) {
            return success($this->data, '添加成功');
        }
        return fail('', '添加失败');
    }

    //编辑
    public function edit() {
        $result = $this->model->allowField(true)->save($this->data,['id'=>$this->data['id']]);
        if ($result) {
            return success($this->data, '修改成功');
        }
        return fail('', '修改失败');
    }

    //回收
    public function trash() {
        $post = $this->model->get(input('get.id'));
        if (!$post) {
            return fail('', '没有这条数据');
        }
        $post->status = Status::$Delete;
        $result = $post->save();
        if ($result) {
            return success($post, '回收成功');
        }
        return fail($result, '回收失败');
    }


}
