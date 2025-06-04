<?php 
	class Model_operator extends CI_Model {

		function login($username, $password)
		{
			$check= $this->db->get_where('operator',array('username'=>$username,'password'=> md5($password)));
			if ($check->num_rows()>0) 
			{
				return 1;
			} else {
				return 0;
			}	
		}

		function tampildata()
		{
			return $this->db->get('operator');
		}

		function get_one($id)
		{	
			$param= array('operator_id'=>$id);
			return $this->db->get_where('operator',$param);
		}

		public function simpanDariQueue($data)
		{
			return $this->db->insert('operator', [
				'nama_lengkap' => $data['nama_lengkap'],
				'username'     => $data['username'],
				'password'     => $data['password']
			]);
		}

	}
?>
