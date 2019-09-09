<?php


namespace app\v1\controller;

use app\common\model\CategoryModel;
use Ramsey\Uuid\Uuid;
use Status;

class Category extends Base {

    private $model;

    public function initialize() {
        parent::initialize();
        $this->model = new CategoryModel();

    }

    //获取所有数据
    public function select() {

        $db = db('category');
        $list = $db
            ->select();

        $data = $db
            ->page($this->offset,$this->limit)
            ->select();

        return success(['count' => count($list), 'list' => $data]);
    }

    public function detail(){
        $res = db('category')->where('id',$this->get['id'])->find();
        return success($res);
    }


    public function create() {
        //检测数据库里是否已经存在这条数据
        $name = $this->data['name'];
        $category = $this->model->where(['name' => $name])->find();
        if ($category) {
            return fail($category, '已经存在这条数据了');
        }
        $this->data['id'] = Uuid::uuid4()->toString();
        $this->data['createTime'] = time();
        $result = $this->model->allowField(true)->save($this->data);
        if ($result) {
            return success($this->data, '添加成功');
        }
        return fail('', '添加失败');
    }

    public function del() {
        $result = db('category')
            ->where('id',$this->get['id'])
            ->delete();
        if ($result) {
            return success($result, '删除成功');
        }
        return fail($result, '删除失败');
    }


    //批量回收
    public function delMore() {
        foreach ($this->data as $item) {
            db('category')->where('id',$item['id'])->delete();
        }
        return success(null, '删除成功');
    }

    public function edit() {
        $result = $this->model->allowField(true)->save($this->data, ['id' => $this->data['id']]);
        if ($result) {
            return success($this->data, '修改成功');
        }
        return fail('', '修改失败');
    }

}