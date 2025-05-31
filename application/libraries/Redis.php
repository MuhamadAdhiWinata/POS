<?php

require_once APPPATH . '../vendor/autoload.php'; // Menggunakan autoloader dari Composer

use Predis\Client;

/**
 *
 */
class Redis
{

	function dbms()
	{
		$client = new Predis\Client([
			'scheme' => 'tcp',
			'host'   => getenv('REDIS_HOST'),
			'port'   => getenv('REDIS_PORT'),
			'password' => getenv('REDIS_PASSWORD'),
			'database' => getenv('REDIS_DATABASE')
		]);

		return $client;
	}

	function dataconfig()
	{
		$client = new Predis\Client([
			'scheme' => 'tcp',
			'host'   => '127.0.0.1',
			'port'   => 6380,
			'database' => 1
		]);

		return $client;
	}

	function redis_report()
	{
		$client = new Predis\Client([
			'scheme' => 'tcp',
			'host'   => getenv('REDIS_HOST'),
			'port'   => getenv('REDIS_PORT'),
			'password' => getenv('REDIS_PASSWORD'),
			'database' => getenv('REDIS_DATABASE_redis_report')
		]);

		return $client;
	}
}
