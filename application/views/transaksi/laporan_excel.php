<table border="1">
	<tr>
		<th>No</th>
		<th>Tanggal Transaksi</th>
		<th>Operator</th>
		<th>Total Transaksi</th>
	</tr>
	<?php
		$no=1;
		$total=0;
		foreach ($record->result() as $r) {
			echo "<tr><td>$no</td>
								<td>$r->tanggal_transaksi</td> 
								<td>$r->nama_lengkap</td> 
								<td>$r->total</td>
						</tr>";
						$no++;
						$total = $total+$r->total;
		}
	?>
	<tr>
		<td colspan="3" class="text-right">Total</td>
		<td><?php echo $total;?></td>
	</tr>
</table>
