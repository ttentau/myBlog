<?php


namespace app\v1\controller;


use app\common\model\ConfigModel;
use app\common\model\UserModel;
use Ramsey\Uuid\Uuid;

class User extends Base {
    private $model;
    private $data;
    private $get;


    protected function initialize() {
        parent::initialize();
        $this->model = new UserModel();
        $this->data = input('post.');
        $this->get = input('get.');

    }

    public function login() {
        if (!isset($this->data['username']) || !isset($this->data['password'])) {
            return fail("", '用户名或密码不能为空');
        }
        $user = $this->model->where(['username' => $this->data['username']])->find();
        if ($user) {
            if ($user->password === $this->data['password'] && $user->isAdmin === 1) {
                $user->lastLoginTime = $user->loginTime;
                $user->loginTime = time();
                $user->ip = request()->ip();
                $user->save();
                unset($user['password']);
                return success(['token' => generateToken($user->id), 'user' => $user], '登录成功');
            } else {
                return fail('', '用户名或密码错误');
            }
        } else {
            return fail('', '用户名或密码错误');
        }


    }

    public function create() {
        //检测数据库里是否已经存在这条数据
        $username = $this->data['username'];
        $user = $this->model->where(['username' => $username])->find();
        if ($user) {
            return fail($user, '用户名重复');
        }
        $this->data['id'] = Uuid::uuid4()->toString();
        $result = $this->model->allowField(true)->save($this->data);
        if ($result) {
            return success($this->data, '添加成功');
        }
        return fail('', '添加失败');
    }

    //获取配置信息
    public function config() {
        $config = model('configModel')->all();
        return success($config[0], 'ok');
    }

    //获取配置信息
    public function editConfig() {
        $result = model('configModel')->allowField(true)->save($this->data, ['id' => $this->data['id']]);
        if ($result) {
            return success($this->data, '修改成功');
        }
        return fail('', '修改失败');
    }
}