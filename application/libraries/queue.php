<?php if (!defined("BASEPATH")) exit("No direct script access allowed");
/**
 * @name		  CodeIgniter Message Queue Library using PHP PHP-AMQPLib Client
 * @author		Jogi Silalahi
 * @link		  http://jogisilalahi.com
 *
 * This message queue library is a wrapper CodeIgniter library using PHP-AMQPLib
 */

require_once APPPATH . 'third_party/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Queue {

    /**
     * Confirguration
     * Default configuration intialized from queue config file
     */
    var $host = 'localhost';
    var $port = '5672';
    var $user = 'guest';
    var $pass = 'guest';

    /**
     * Connection
     */
    var $connection = null;

    /**
     * Channel
     */
    var $channel = null;


    /**
     * Constructor with configuration array
     *
     * @param array $config
     */
    public function __construct($config=array()) {

	    // Configuration
  		if ( ! empty($config) ) {
  			$this->initialize($config);
  		}

  		// Connecting to message server
  		$this->connection = new AMQPConnection($this->host, $this->port, $this->user, $this->pass);
  		$this->channel = $this->connection->channel();

    }

    /**
     * Initialize with configuration array
     *
     * @param array $config
     */
    public function initialize($config=array()) {
	    foreach ($config as $key=>$value) {
		     $this->{$key} = $value;
	    }
    }

    /**
     * Queuing new message
     *
     * @param string $job
     * @param array $data
     * @param string $route
     */
    public function push($job, $data=array(), $route=null) {

    	// AMQP Message in string, in this case we using JSON
    	if( is_array($data) ) {
	    	$data = json_encode($data);
    	}
    	$message = new AMQPMessage($data);

    	$this->channel->exchange_declare($job, 'direct', false, false, false);
    	$this->channel->basic_publish($message, $job, $route);
    }


    /**
     * Queuing scheduled message
     *
     * @param integer $delay
     * @param array $job
     * @param array $data
     * @param string $route
     */
    public function later($delay, $job, $data, $route=null) {
	    // TODO: implement scheduled message
    }

    /**
     * Destructor
     */

    /**
     * Publish data barang ke exchange dan binding otomatis ke queue
     *
     * @param array $data
     */
    public function publish($entity, $data = array()) {
    $exchange 	= $entity . '_exchange';
    $queue		= $entity . '_queue';
    $routingKey = $entity . '_routing_key';

    // Convert data to JSON
    $message = new AMQPMessage(json_encode($data));

    // Declare exchange, queue, and bind
    $this->channel->exchange_declare($exchange, 'direct', false, true, false);
    $this->channel->queue_declare($queue, false, true, false, false);
    $this->channel->queue_bind($queue, $exchange, $routingKey);

    // Publish
    $this->channel->basic_publish($message, $exchange, $routingKey);
}


    public function consume($queue, $exchange, $route, $model, $method)
	{
		$this->channel->exchange_declare($exchange, 'direct', false, true, false);
		$this->channel->queue_declare($queue, false, true, false, false);
		$this->channel->queue_bind($queue, $exchange, $route);

		echo " [*] Menunggu pesan dari queue '{$queue}'. Tekan CTRL+C untuk keluar\n";

		$callback = function ($msg) use ($model, $method) {
			echo " [x] Diterima: ", $msg->body, "\n";

			$data = json_decode($msg->body, true);

			$CI =& get_instance();
			$CI->load->model($model);

			if (method_exists($CI->$model, $method)) {
				$CI->$model->$method($data);
				echo " [v] Data disimpan ke DB via {$model}::{$method}()\n";
			} else {
				echo " [!] ERROR: Method {$method} tidak ditemukan di model {$model}\n";
			}
		};

		$this->channel->basic_consume($queue, '', false, true, false, false, $callback);

		while (count($this->channel->callbacks)) {
			$this->channel->wait();
		}
	}



    public function __destruct() {

    	// Channel closing
	    if( $this->channel) {
		    $this->channel->close();
	    }

	    // Connection closing
	    if( $this->connection) {
		    $this->connection->close();
	    }
    }

}
/* End of file queue.php */
/* Location: ./application/libraries/queue.php */
