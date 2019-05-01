<?php


namespace app\v1\controller;

use app\common\model\CategoryModel;
use Ramsey\Uuid\Uuid;
use Status;

class Category extends Base {

    private $model;
    private $data;
    private $get;


    protected function initialize() {
        parent::initialize();
        $this->model = new CategoryModel();
        $this->data = input('post.');
        $this->get = input('get.');

    }

    //获取所有数据
    public function index() {
        $list = $this->model->all();
        return success(['count' => count($list), 'list' => $list]);
    }


    public function create() {
        //检测数据库里是否已经存在这条数据
        $name = $this->data['name'];
        $category = $this->model->where(['name' => $name])->find();
        if ($category) {
            return fail($category, '已经存在这条数据了');
        }
        $this->data['id'] = Uuid::uuid4()->toString();
        $result = $this->model->allowField(true)->save($this->data);
        if ($result) {
            return success($this->data, '添加成功');
        }
        return fail('', '添加失败');
    }

    public function del() {
        $category = $this->model->get($this->get['id']);
        if (!$category) {
            return fail('', '没有这条数据');
        }
        $articles = model('ArticleModel')->where(['categoryId' => $category->id])->all();
        if (count($articles)){
            foreach ($articles as $article){
                $article->category;
            }
            return fail($articles, '还有关联的文章');
        }
        $result = $category->delete();
        if ($result) {
            return success($result, '删除成功');
        }
        return fail($result, '删除失败');
    }

    public function edit() {
        $result = $this->model->allowField(true)->save($this->data, ['id' => $this->data['id']]);
        if ($result) {
            return success($this->data, '修改成功');
        }
        return fail('', '修改失败');
    }

}