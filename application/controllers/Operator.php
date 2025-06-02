<?php 
	class Operator extends CI_Controller
	{
		function __construct()
		{
			parent :: __construct();
			$this->load->model('model_operator');
			$this->load->library('redisdb');
			
			check_session();
			
		}

		function index()
		{
			// $data['record']= $this->model_operator->tampildata();
			// // $this->load->view('operator/lihat_data',$data);
			// $this->template->load('template','operator/lihat_data',$data);
			$cacheKey = 'operator';
			$data = $this->redisdb->get($cacheKey);

			if (!$data) {
					echo "<script>console.log('Data Dari database');</script>";
					$data = json_encode($this->model_operator->tampildata()->result());
					$this->redisdb->set($cacheKey, $data, 300); // Cache selama 5 menit    
			}else{
					echo "<script>console.log('Data Dari RedisCache');</script>";
			}

			$result['record'] = json_decode($data);
			$this->template->load('template','operator/lihat_data',$result);
		}

		function post()
		{
			if (isset($_POST['submit'])) {
				// proses
				$nama 		= $this->input->post('nama',true);
				$username = $this->input->post('username',true);
				$password = $this->input->post('password',true);
				$data 		= array('nama_lengkap'=>$nama,
													'username' =>$username,
													'password'=>md5($password));
				$this->db->insert('operator', $data);
				$this->redisdb->delete('operator');
				redirect('operator');
			} else {
				// $this->load->view('operator/form_input');
				$this->template->load('template','operator/form_input');
			}
		}

		function edit()
		{
			if (isset($_POST['submit'])) {
				// proses
				$id 			= $this->input->post('id',true);
				$nama 		= $this->input->post('nama',true);
				$username = $this->input->post('username',true);
				$password = $this->input->post('password',true);
				if (empty($password)) {
					$data 		= array('nama_lengkap'=>$nama,
					'username' =>$username);
				} else {
					$data 		= array('nama_lengkap'=>$nama,
					'username' =>$username,
					'password' =>md5($password));
				}
				$this->db->where('operator_id', $id);
				$this->db->update('operator', $data);
				$this->redisdb->delete('operator');
				redirect('operator');
			} else {
				$id= $this->uri->segment(3);
				$data['record']= $this->model_operator->get_one($id)->row_array();
				//$this->load->view('operator/form_edit',$data);
				$this->template->load('template','operator/form_edit',$data);
			}
		}
		
		function delete()
		{
			$id= $this->uri->segment(3);
			$this->db->where('operator_id', $id);
			$this->db->delete('operator');
			$this->redisdb->delete('operator');
			redirect('operator');
			
		}


	}
?>
