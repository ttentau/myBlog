<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/5/2
 * Time: 21:34
 */

namespace app\http;

use think\worker\Server;
use Workerman\Worker;

class MyWorker extends Server {
    protected $socket = 'http://0.0.0.0:2346';
    public $mConnection = null;

    public function onWorkerStart($worker) {
        $inner_text_worker = new Worker('Text://0.0.0.0:5678');
        $inner_text_worker->onMessage = function ($connection, $data) {
            if ($this->mConnection) {
                $this->mConnection->send('tttt');
            }
        };
        $inner_text_worker->listen();
    }

    public function onMessage($connection, $data) {
        $connection->send($data . '666');
        $this->mConnection = $connection;
    }
}