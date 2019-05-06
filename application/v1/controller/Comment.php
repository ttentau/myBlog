<?php


namespace app\v1\controller;


use app\common\model\CommentModel;
use Ramsey\Uuid\Uuid;

class Comment extends Base {
    private $model;
    private $post;
    private $get;


    protected function initialize() {
        parent::initialize();
        $this->model = new CommentModel();
        $this->post = input('post.');
        $this->get = input('get.');
    }

    public function create() {
        $this->post['id'] = Uuid::uuid4()->toString();
        if (!isset($this->post['userName'])) {
            $this->post['userName'] = '未知用户';
        }
        $result = $this->model->allowField(true)->save($this->post);
        if ($result) {
            return success($this->model->all(['articleId' => $this->post['articleId']]), '评论成功');
        }
        return fail('', '评论失败');
    }

    public function index() {
        return success($this->model->all(['articleId' => $this->get['articleId']]), '评论成功');
    }

}