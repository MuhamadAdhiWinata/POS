<?php
	class Worker extends CI_Controller
	{
			public function barang()
			{
					$this->load->library('queue');
					$this->queue->consume();
			}
	}

?>
