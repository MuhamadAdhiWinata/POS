<?php
	class Barang extends CI_Controller
	{
		function __construct(){
			parent ::__construct();
			$this->load->model('model_barang');
			$this->load->library('redisdb');
			
			check_session();
		}

		function index()
		{
			// $data['record']=$this->model_barang->tampil_data()->result();
			// $this->template->load('template','barang/lihat_data',$data);

			$cacheKey = 'barang_list';
        $data = $this->redisdb->get($cacheKey);

        if (!$data) {
					// jadikan alert	
					echo "<script>console.log('Data Dari Database');</script>";
					$data = json_encode($this->model_barang->tampil_data()->result());
					$this->redisdb->set($cacheKey, $data, 300); // Cache selama 5 menit
        }else{
					echo "<script>console.log('Data Dari RedisCache');</script>";
				}

        $result['record'] = json_decode($data);
        $this->template->load('template','barang/lihat_data', $result);
		}
		
		function post()
		{
			if (isset($_POST['submit'])) 
			{
				//proses barang
				$nama			= $this->input->post('nama_barang');
				$kategori	= $this->input->post('kategori');
				$harga		= $this->input->post('harga');
				$data			= array('nama_barang'=>$nama,
													'kategori_id'=>$kategori,
													'harga'=>$harga);
				$this->model_barang->post($data);

				// Hapus cache setelah insert
				$this->redisdb->delete('barang_list'); 

				redirect('barang');
			} else {
				$this->load->model('model_kategori');
				$data['kategori']= $this->model_kategori->tampilkan_data()->result();
				// $this->load->view('barang/form_input',$data);
				$this->template->load('template','barang/form_input',$data);
			}
		}

		function edit()
		{
			if (isset($_POST['submit'])) 
			{
				//proses barang
				$id				= $this->input->post('id');
				$nama			= $this->input->post('nama_barang');
				$kategori	= $this->input->post('kategori');
				$harga		= $this->input->post('harga');
				$data			= array('nama_barang'=>$nama,
													'kategori_id'=>$kategori,
													'harga'=>$harga);
				$this->model_barang->edit($data, $id);

				// Hapus cache setelah insert
				$this->redisdb->delete('barang_list');
				
				redirect('barang');
			} else {
				$id= $this->uri->segment(3); 
				$this->load->model('model_kategori');
				$data['kategori']	= $this->model_kategori->tampilkan_data()->result();
				$data['record']		= $this->model_barang->get_one($id)->row_array();
				// $this->load->view('barang/form_edit',$data);
				$this->template->load('template','barang/form_edit',$data);
			}
		}
		
		function delete()
		{
			$id= $this->uri->segment(3);
			$this->model_barang->delete($id);

			// Hapus cache setelah insert
			$this->redisdb->delete('barang_list'); 

			redirect('barang');
		}

	}
?>
