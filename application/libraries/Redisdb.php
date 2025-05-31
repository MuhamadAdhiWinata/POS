<?php
require_once APPPATH . '../vendor/autoload.php'; // Composer autoloader

use Predis\Client;

class Redisdb
{
    protected $redis;

    public function __construct()
    {
        $this->redis = new Client([
            'scheme' => 'tcp',
            'host'   => '127.0.0.1',
            'port'   => 6380,
            'database' => 0
        ]);
    }

    public function set($key, $value, $expireInSeconds = null)
    {
        $this->redis->set($key, $value);
        if ($expireInSeconds) {
            $this->redis->expire($key, $expireInSeconds);
        }
    }

    public function get($key)
    {
        return $this->redis->get($key);
    }

    public function delete($key)
    {
        return $this->redis->del([$key]);
    }
}
