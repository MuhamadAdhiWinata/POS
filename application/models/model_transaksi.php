<?php 
	class Model_transaksi extends CI_Model
	{

		function simpan_barang()
		{
			$nama_barang	= $this->input->post('barang');
			$qty					= $this->input->post('qty');
			$idbarang			= $this->db->get_where('barang',array('nama_barang'=>$nama_barang))->row_array();
			$data 				= array('barang_id'=>$idbarang['barang_id'],
														'qty'=>$qty,
														'harga'=>$idbarang['harga'],
														'status'=>'0');
													$this->db->insert('transaksi_detail', $data);							
		}

		function tampilkan_detail_transaksi()
		{
			$query = "SELECT td.t_detail_id,td.qty,td.harga,b.nama_barang, td.status as status
								FROM transaksi_detail as td, barang as b 
								WHERE b.barang_id=td.barang_id and td.status ='0'";
			return $this->db->query($query);
		}

		function hapusitem($id)
		{
			$this->db->where('t_detail_id', $id);
			$this->db->delete('transaksi_detail');			
		}

		function selesai_belanja($data)
		{
			$this->db->insert('transaksi', $data);
			$last_id = $this->db->query("SELECT transaksi_id FROM transaksi ORDER BY transaksi_id DESC")->row_array();
			$this->db->query("UPDATE transaksi_detail SET transaksi_id='".$last_id['transaksi_id']."' WHERE status='0'");
			$this->db->query("UPDATE transaksi_detail SET status='1' WHERE status='0'");
		}

		function laporan_default()
		{
			$query = "SELECT t.tanggal_transaksi, o.nama_lengkap, SUM(td.harga * td.qty) AS total
								FROM transaksi AS t, transaksi_detail AS td, operator AS o
								WHERE td.transaksi_id = t.transaksi_id 
								AND o.operator_id = t.operator_id
								GROUP BY t.transaksi_id";
			return $this->db->query($query);
		}

		function laporan_periode($tanggal1,$tanggal2)
		{
			$query = "SELECT t.tanggal_transaksi, o.nama_lengkap, SUM(td.harga * td.qty) AS total
								FROM transaksi AS t, transaksi_detail AS td, operator AS o
								WHERE td.transaksi_id = t.transaksi_id 
								AND o.operator_id = t.operator_id
								AND t.tanggal_transaksi
								BETWEEN '$tanggal1' AND '$tanggal2'
								GROUP BY t.transaksi_id";
			return $this->db->query($query);
		}
		
	}
?>
