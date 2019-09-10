<?php


namespace app\v1\controller;

use app\common\model\tagModel;
use Ramsey\Uuid\Uuid;

class Tag extends Base {

    //获取所有数据
    public function select() {
        $db = db('tag');
        $list = $db
            ->select();

        $data = $db
            ->page($this->offset, $this->limit)
            ->select();

        return success(['count' => count($list), 'list' => $data]);
    }

    public function detail() {
        $res = db('tag')->where('id', $this->get['id'])->find();
        return success($res);
    }


    public function create() {
        //检测数据库里是否已经存在这条数据
        $this->data['id'] = Uuid::uuid4()->toString();
        $this->data['createTime'] = time();
        $result = db('tag')->strict(false)->insert($this->data);
        if ($result) {
            return success($this->data, '添加成功');
        }
        return fail('', '添加失败');
    }

    public function del() {
        $result = db('tag')
            ->where('id', $this->get['id'])
            ->delete();
        if ($result) {
            return success($result, '删除成功');
        }
        return fail($result, '删除失败');
    }


    //批量回收
    public function delMore() {
        foreach ($this->data as $item) {
            db('tag')->where('id', $item['id'])->delete();
        }
        return success(null, '删除成功');
    }

    public function edit() {
        $result = db('tag')
            ->where(['id' => $this->data['id']])
            ->strict(false)
            ->update($this->data);
        if ($result) {
            return success($this->data, '修改成功');
        }
        return fail('', '修改失败');
    }

}