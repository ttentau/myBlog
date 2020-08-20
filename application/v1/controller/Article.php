<?php

namespace app\v1\controller;

use app\common\model\ArticleModel;
use app\common\model\CategoryModel;
use app\common\model\MessageModel;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Status;

class Article extends Base {
    private $model;


    public function initialize() {
        parent::initialize();
        $this->model = new ArticleModel();
    }

    //获取所有数据
    public function select() {
        $where = [];
        if (isset($this->get['title'])) {
            $where[] = ['title', 'like', '%' . $this->get['title'] . '%'];
        }
        $db = db('article');
        $list = $db
            ->alias('a')
            ->field('a.*,c.name categoryName')
            ->leftJoin('category c', 'c.id = a.categoryId')
            ->where($where)
            ->where('status', \ArticleStatus::$Normal)
            ->select();

        $data = $db
            ->page($this->offset, $this->limit)
            ->select();

        foreach ($data as &$datum) {
            $tags = db('article_relation_tag')
                ->alias('art')
                ->field('t.*')
                ->join('tag t', 't.id = art.tagId')
                ->where('art.articleId', $datum['id'])
                ->select();
            $datum['tags'] = $tags;
        }

        return success(['count' => count($list), 'list' => $data]);
    }

    //获取归档数据
    public function archive() {
        $list = db('article')
            ->alias('a')
            ->field('a.*,c.name categoryName')
            ->leftJoin('category c', 'c.id = a.categoryId')
            ->where('status', \ArticleStatus::$Normal)
            ->order('updateTime', 'desc')
            ->select();

        foreach ($list as &$datum) {
            $tags = db('article_relation_tag')
                ->alias('art')
                ->field('t.*')
                ->join('tag t', 't.id = art.tagId')
                ->where('art.articleId', $datum['id'])
                ->select();
            $datum['tags'] = $tags;
        }

        $years = [];
        foreach ($list as $item) {
            if (!isset($years[$item['year']])) {
                $years[$item['year']] = [];
            }
            $years[$item['year']][] = $item;
        }

        return success($years);
    }

    //后台修改获取的详情
    public function editDetail() {
        $res = db('article')->where('id', $this->get['id'])->find();
        $res['isCanComment'] = $res['isCanComment'] ? true : false;
        $res['isMarkdownEditor'] = $res['isMarkdownEditor'] ? true : false;
        $res['isTop'] = $res['isTop'] ? true : false;
        $tags = db('article_relation_tag')
            ->alias('art')
            ->field('t.*')
            ->join('tag t', 't.id = art.tagId')
            ->where('art.articleId', $res['id'])
            ->select();
        foreach ($tags as $tag) {
            $res['tags'][] = $tag['id'];
        }
        return success($res);
    }

    //后台预览获取的详情
    public function previewDetail() {
        $res = db('article')
            ->alias('a')
            ->field('a.*,c.name categoryName')
            ->leftJoin('category c', 'c.id = a.categoryId')
            ->where('a.id', $this->get['id'])
            ->find();
        $res['isCanComment'] = $res['isCanComment'] ? true : false;
        $res['isMarkdownEditor'] = $res['isMarkdownEditor'] ? true : false;
        $res['isTop'] = $res['isTop'] ? true : false;
        $tags = db('article_relation_tag')
            ->alias('art')
            ->field('t.*')
            ->join('tag t', 't.id = art.tagId')
            ->where('art.articleId', $res['id'])
            ->select();
        $res['tags'] = $tags;
        return success($res);
    }


    //添加
    public function create() {
        $this->checkHasProp($this->data, ['title' => '标题']);

        //检测数据库里是否已经存在这条数据
        $title = $this->data['title'];
        $post = db('article')->where(['title' => $title])->find();
        if ($post) {
            return fail($post, '标题不能重复');
        }
        $this->data['id'] = Uuid::uuid4()->toString();
        $now = Carbon::now();
        $this->data['createTime'] = $now->timestamp;
        $this->data['updateTime'] = $now->timestamp;
        $this->data['year'] = $now->year;
//        if ($this->data['isMarkdownEditor']) {
//            $this->data['htmlContent'] = '';
//        } else {
//            $this->data['mdContent'] = '';
//        }
        $tags = $this->data['tags'];
        foreach ($tags as $tag) {
            $art = [];
            $art['id'] = Uuid::uuid4()->toString();
            $art['articleId'] = $this->data['id'];
            $art['tagId'] = $tag;
            $art['createTime'] = time();
            db('article_relation_tag')->strict(false)->insert($art);
        }
        $result = db('article')->strict(false)->insert($this->data);

        if ($result) {
            return success($this->data, '添加成功');
        }
        return fail('', '添加失败');
    }

    //编辑
    public function edit() {
        //检测数据库里是否已经存在这条数据
        $post = db('article')->where(['id' => $this->data['id']])->find();
        if ($post) {
//            return fail($post, '标题不能重复');
        }
        $now = Carbon::now();
        $this->data['updateTime'] = $now->timestamp;
        $this->data['year'] = $now->year;
//        if ($this->data['isMarkdownEditor']) {
//            $this->data['htmlContent'] = '';
//        } else {
//            $this->data['mdContent'] = '';
//        }

        if (isset($this->data['tags'])) {
            db('article_relation_tag')->where('articleId', $post['id'])->delete();
            $tags = $this->data['tags'];
            foreach ($tags as $tag) {
                $art = [];
                $art['id'] = Uuid::uuid4()->toString();
                $art['articleId'] = $this->data['id'];
                $art['tagId'] = $tag;
                $art['createTime'] = time();
                db('article_relation_tag')->strict(false)->insert($art);
            }
        }

        $result = db('article')->where('id', $this->data['id'])->strict(false)->update($this->data);
        if ($result) {
            return success($this->data, '修改成功');
        }
        return fail('', '修改失败');
    }


    public function del() {
        $this->model->del($this->get['id']);
        return success(null, '删除成功');
    }


    //批量回收
    public function delMore() {
        foreach ($this->data as $item) {
            $this->model->del($item['id']);
        }
        return success(null, '删除成功');
    }


    //获取分类和标签
    public function tagAndCategoryList() {
        $tags = db('tag')->select();
        $categories = db('category')->select();
        return success(['tags' => $tags, 'categories' => $categories]);
    }
}
