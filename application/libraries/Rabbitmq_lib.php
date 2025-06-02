<?php
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Rabbitmq_lib
{
    private $connection;
    private $channel;
    private $exchange = 'barang.exchange';

    public function __construct()
    {
        // Pastikan PhpAmqpLib sudah ter-install via Composer
        require_once APPPATH . '../vendor/autoload.php';

        // Konfigurasi RabbitMQ
        $host = 'localhost';
        $port = 5672;
        $user = 'guest';
        $pass = 'guest';

        // Inisialisasi koneksi dan channel
        $this->connection = new AMQPStreamConnection($host, $port, $user, $pass);
        $this->channel = $this->connection->channel();

        // Buat exchange dan queue jika belum ada
        $this->channel->exchange_declare($this->exchange, 'direct', false, true, false);
        $this->channel->queue_declare('barang.created', false, true, false, false);
        $this->channel->queue_bind('barang.created', $this->exchange, 'barang.created');
    }

    public function publish($routingKey, $message)
    {
        $msg = new AMQPMessage($message, ['delivery_mode' => 2]); // 2 = persistent
        $this->channel->basic_publish($msg, $this->exchange, $routingKey);
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }
}
