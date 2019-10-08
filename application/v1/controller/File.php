<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/5/27
 * Time: 20:20
 */

namespace app\v1\controller;


use think\Image;

class File extends Base {

    /*
     * 文件上传
     * */
    public function upload() {

//        检测目录是否存在
        $upload = './static/uploads';
        if (!is_dir($upload)) {
            mkdir($upload);
        }
        $videos = './static/uploads/videos';
        if (!is_dir($videos)) {
            mkdir($videos);
        }
        $images = './static/uploads/images';
        if (!is_dir($images)) {
            mkdir($images);
        }
        $others = './static/uploads/others';
        if (!is_dir($others)) {
            mkdir($others);
        }


        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('file');
        $fileInfo = $file->getInfo();
        $fileName = $fileInfo['name'];
        $fileNameNew = iconv('utf-8', 'gb2312', $fileName);

        $url = '';
        switch (pathinfo($fileName, PATHINFO_EXTENSION)) {
            case 'jpeg':
            case 'jpg':
            case 'png':
            case 'svg':
            case 'gif':
            case 'img':
            case 'IMG':
            case 'JPG':
            case 'JPEG':
            case 'GIF':
            case 'SVG':
                $url = 'images';
//                $info = $file->move('./static/uploads/images');
                $dir = './static/uploads/images/' . date('Ymd');
                if (!is_dir($dir)) {
                    mkdir($dir);
                }
                $info = $file->move($dir, $fileNameNew);
                break;
            case 'mp4':
            case 'mp3':
            case 'aac':
            case 'avi':
            case 'rmvb':
            case '3gp':
            case 'flv':
            case 'mtv':
                $url = 'videos';
                $dir = './static/uploads/videos/' . date('Ymd');
                if (!is_dir($dir)) {
                    mkdir($dir);
                }
                $info = $file->move($dir, $fileNameNew);
                break;
            default:
                $url = 'others';
                $dir = './static/uploads/others/' . date('Ymd');
                if (!is_dir($dir)) {
                    mkdir($dir);
                }
                $info = $file->move($dir, $fileNameNew);
                break;
        }
        if ($info) {
//            echo date('Ymd') . DIRECTORY_SEPARATOR . $fileName;
            return success($url . DIRECTORY_SEPARATOR . date('Ymd') . DIRECTORY_SEPARATOR . $fileName, '上传成功');
        } else {
            echo $file->getError();
        }
    }


    public function uploadImg() {
        $cropArr = json_decode(input('post.crop_arr'));
        $file = request()->file('file');
        if (!$file) return fail('', '请选择文件');

//        检测目录是否存在
        $upload = './static/uploads';
        if (!is_dir($upload)) {
            mkdir($upload);
        }
        $videos = './static/uploads/videos';
        if (!is_dir($videos)) {
            mkdir($videos);
        }
        $images = './static/uploads/images';
        if (!is_dir($images)) {
            mkdir($images);
        }
        $others = './static/uploads/others';
        if (!is_dir($others)) {
            mkdir($others);
        }

        $fileInfo = $file->getInfo();
        $fileName = $fileInfo['name'];
        $fileNameNew = iconv('utf-8', 'gb2312', $fileName);

        $dir = './static/uploads/images/' . date('Ymd');
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        $info = $file->move($dir, $fileNameNew);

        $imgUrl = 'images' . DIRECTORY_SEPARATOR . date('Ymd') . DIRECTORY_SEPARATOR . $fileName;

        $image = Image::open($dir . DIRECTORY_SEPARATOR . $fileNameNew);
        if ($cropArr) {
            foreach ($cropArr as $item) {
                $image->thumb($item->w, $item->h, \think\Image::THUMB_CENTER)->save($dir . DIRECTORY_SEPARATOR . $fileNameNew . $item->w . 'x' . $item->h);
            }
        }

        if ($info) {
//            echo date('Ymd') . DIRECTORY_SEPARATOR . $fileName;
            return success($imgUrl, '上传成功');
        } else {
            echo $file->getError();
        }
    }
}