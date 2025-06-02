<?php
require_once APPPATH . 'libraries/PhpAmqpLib/Connection/AMQPStreamConnection.php';
require_once APPPATH . 'libraries/PhpAmqpLib/Message/AMQPMessage.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Rabbitmq
{
    private $connection;
    private $channel;

    public function __construct()
    {
        $this->connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $this->channel = $this->connection->channel();

        $this->channel->queue_declare('queue_barang', false, true, false, false);
    }

    public function publish($message)
    {
        $msg = new AMQPMessage($message, ['delivery_mode' => 2]); // 2 = persistent
        $this->channel->basic_publish($msg, '', 'queue_barang');
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }
}
