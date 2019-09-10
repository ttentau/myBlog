<?php

namespace app\common\model;


class ArticleModel extends BaseModel {
    protected $table = 'article';

    public function category() {
        return $this->hasOne('CategoryModel', 'id', 'categoryId');
    }

    public function del($id) {
        db('article')->where('id', $id)->update(['status'=>\ArticleStatus::$Delete,'isTop'=>false]);
    }

}