<?php 
	class Model_barang extends CI_Model
	{

		function tampil_data()
		{
			$query="SELECT b.barang_id, b.nama_barang, b.harga, kb.nama_kategori
							FROM barang AS b, kategori_barang AS kb
							WHERE b.kategori_id = kb.kategori_id;
							";
			return $this->db->query($query);
		}

		function tampil_data_paging($halaman,$batas)
		{
			return $this->db->query("SELECT * FROM barang LIMIT $halaman,$batas");
		}

		function post($data)
		{
			$this->db->insert('barang', $data);
		}
		
		function get_one($id)
		{
			$param = array('barang_id'=>$id);
			return $this->db->get_where('barang', $param);
			
		}

		function edit($data, $id)
		{
			$this->db->where('barang_id', $id);
			$this->db->update('barang', $data);
		}

		function delete($id)
		{
			$this->db->where('barang_id', $id);
			$this->db->delete('barang');
		}
	}
?>
