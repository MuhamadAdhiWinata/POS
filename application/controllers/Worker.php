<?php
	class Worker extends CI_Controller
{
    public function run($entitas)
    {
        $config = [
            'barang' => [
                'queue'   => 'barang_queue',
                'exchange'=> 'barang_exchange',
                'route'   => 'barang_routing_key',
                'model'   => 'model_barang',
                'method'  => 'simpanDariQueue'
            ],
            'kategori_barang' => [
                'queue'   => 'kategori_queue',
                'exchange'=> 'kategori_exchange',
                'route'   => 'kategori_routing_key',
                'model'   => 'model_kategori',
                'method'  => 'simpanDariQueue'
            ],
            'operator' => [
                'queue'   => 'operator_queue',
                'exchange'=> 'operator_exchange',
                'route'   => 'operator_routing_key',
                'model'   => 'model_operator',
                'method'  => 'simpanDariQueue'
            ]
        ];

        if (!isset($config[$entitas])) {
            show_error("Entitas '{$entitas}' tidak dikenali.");
            return;
        }

        $this->load->library('queue');
        $params = $config[$entitas];
        $this->queue->consume(
            $params['queue'],
            $params['exchange'],
            $params['route'],
            $params['model'],
            $params['method']
        );
    }
}

?>
