<h3>Form Transaksi</h3>
<?php 
	echo form_open('transaksi');
?>
<table class="table table-bordered">
	<tr class="success"><th>Form</th></tr>
	<tr>
		<th>
			<div class="col-sm-6">
				<input list="barang" class="form-control" name="barang" placeholder="masukkan nama barang">
			</div>
			<div class="col-sm-1">
				<input type="text" class="form-control" name="qty" placeholder="QTY">
			</div>
		</th>
	</tr>
	<tr>
		<td>
			<div class="col-sm-1">
				<button type="submit" name="submit" class="btn btn-default">Simpan</button>
			</div>
			<?php echo anchor('transaksi/selesai_belanja','Selesai',array('class'=>'btn btn-default'))?>
		</td>
	</tr>
</table>

<table class="table table-bordered">
		<tr class="success" ><th colspan="6">Detail Transaksi</th></tr>
		<tr>
			<th>No</th>
			<th>Nama Barang</th>
			<th>Qty</th>
			<th>Harga</th>
			<th>Sub Total</th>
			<th>Cancel</th>
		</tr>
		<?php
			$no=1;
			$total=0;
			foreach ($detail->result() as $r)
			{
				echo "<tr>
								<td>$no</td> 
								<td>$r->nama_barang</td> 
								<td>$r->qty</td> 
								<td>$r->harga</td> 
								<td>".$r->qty*$r->harga."</td>
								<td>".anchor('transaksi/hapusitem/'.$r->t_detail_id,'Hapus')."</td>
							</tr>";
				$total= $total+($r->qty*$r->harga);			
				$no++;
			}
		?>
		<tr>
			<td colspan="4"><p align="right">Total</p></td>
			<td><?php echo $total;?></td>
		</tr>
</table>

<datalist id="barang">
	<?php 
		foreach ($barang->result() as $b)
		{
			echo "<option value='$b->nama_barang'></option>";
		}
	?>
</datalist>
