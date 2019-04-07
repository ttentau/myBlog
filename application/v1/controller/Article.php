<?php

namespace app\v1\controller;

use app\common\model\ArticleModel;
use app\common\model\CategoryModel;
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
        if (isset($this->get['title'])) {
            $where['title'] = $this->get['title'];
        }
        if (isset($this->get['categoryId'])) {
            $where['categoryId'] = $this->get['categoryId'];
        }
        $list = $this->model->where($where)->where('status', '<>', Status::$Delete)->all();
        $data = $this->model->where($where)->where('status', '<>', Status::$Delete)->order('createTime', 'desc')->limit($offset * $limit, $limit)->all();
        //一定要调用一下，才有值
        foreach ($data as &$item) {
            $item->category;
        }
        return success(['count' => count($list), 'list' => $data]);
    }

    //获取一条数据
    public function one() {
        $data = $this->model->find(['id' => $this->get['id']]);
        //一定要调用一下，才有值
        $data->category;
        return success(['count' => 1, 'list' => $data]);
    }

    //获取所有可见的帖子
    public function show() {
        $offset = $this->get['offset'];
        $limit = $this->get['limit'];
        $where = [];
        if (isset($this->get['title'])) {
            $where['title'] = $this->get['title'];
        }
        $list = $this->model->where($where)->where(['status' => Status::$Normal])->all();
        $data = $this->model->where($where)->where(['status' => Status::$Normal])->order('createTime', 'desc')->limit($offset * $limit, $limit)->all();
        //一定要调用一下，才有值
        foreach ($data as &$item) {
            $item->category;
        }

        //如果有title这个属性的话，说明是筛选一条，那么给这条的点击数加1
        if (isset($this->get['title'])) {
            $data[0]->clickCount = $data[0]->clickCount + 1;
            $data[0]->save();
        }
        return success(['count' => count($list), 'list' => $data]);
    }


    //添加
    public function create() {
        //检测数据库里是否已经存在这条数据
        $title = $this->data['title'];
        $post = $this->model->where(['title' => $title])->find();
        if ($post) {
            return fail($post, '标题不能重复');
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
        $result = $this->model->allowField(true)->save($this->data, ['id' => $this->data['id']]);
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
