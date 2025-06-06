<?php
	class Kategori extends CI_Controller
	{
		function __construct()
		{
			parent ::__construct();
			$this->load->model('model_kategori');
			$this->load->library('redisdb');
			

			check_session();
		}

		function index()
		{
			$cacheKey = 'kategori_barang';
			$data = $this->redisdb->get($cacheKey);

			if (!$data) {
					echo "<p style='color:red;'>Data dari <strong>Database</strong></p>";
					$data = json_encode($this->model_kategori->tampilkan_data()->result());
					$this->redisdb->set($cacheKey, $data, 300); // Cache selama 5 menit    
			}else{
					echo "<p style='color:green;'>Data dari <strong>Redis Cache</strong></p>";
			}

			$result['record'] = json_decode($data);
			$this->template->load('template','kategori/lihat_data',$result);    
		}


		function post()
		{
			if (isset($_POST['submit'])) 
			{
				//proses kategori
				$this->model_kategori->post();
				// Hapus cache setelah insert
				$this->redisdb->delete('kategori_barang');
				redirect('kategori');
			} else {
				// $this->load->view('kategori/form_input');
				$this->template->load('template','kategori/form_input');
			}
			
		}

		function edit()
		{
			if (isset($_POST['submit'])) 
			{
				//proses kategori
				$this->model_kategori->edit();

				// hapus chace setelah insert
				$this->redisdb->delete('kategori_barang');

				redirect('kategori');
			} else {
				$id= $this->uri->segment(3);
				$data['record']= $this->model_kategori->get_one($id)->row_array();
				// $this->load->view('kategori/form_edit', $data);
				$this->template->load('template','kategori/form_edit',$data);
			}
		}

		function delete()
		{
			$id= $this->uri->segment(3);
			$this->model_kategori->delete($id);
			// hapus chace setelah insert
			$this->redisdb->delete('kategori_barang');
			redirect('kategori');
		}

	}

?>
