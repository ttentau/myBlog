<?php


namespace app\v1\controller;


class File extends Base {

    public function upload(){
        $file = request()->file('file');
        if ($file) {
            $info = $file->move('./static/image');
            return success($info->getSaveName(),'上传成功');
        }
        return success([],'上传失败');
    }

}