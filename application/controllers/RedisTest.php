<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RedisTest extends CI_Controller {

    public function index()
    {
        $this->load->library('redis'); 

        $client = $this->redis->dataconfig();

        $client->set('ci_redis_test', 'Halo dari CodeIgniter');
        $value = $client->get('ci_redis_test');

        echo "Data Redis: " . $value;
    }

}
