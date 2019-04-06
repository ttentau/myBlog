<?php

namespace app\common\model;


class ArticleModel extends BaseModel {
    protected $table = 'article';

    public function category() {
        return $this->hasOne('CategoryModel','id','categoryId');
    }
}