<h3>Tambah Data Operator</h3>
<?php 
	echo form_open('operator/post')
?>
<table class="table table-bordered">
	<tr>
		<td>Nama Lengkap</td>
		<td>
			<div style="width: 360px;">
				<input type="text" class="form-control" name="nama" placeholder="nama lengkap">
			</div>
		</td>
	</tr>
	<tr>
		<td width="130">Username</td>
		<td>
			<div style="width: 360px;">
				<input type="text" class="form-control" name="username" placeholder="username">
			</div>
		</td>
	</tr>
	<tr>
		<td>Password</td>
		<td>
			<div style="width: 360px;">
				<input type="password" class="form-control" class="form-control" name="password" placeholder="password">
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<button type="submit" class="btn btn-primary btn-sm" name="submit">Simpan</button>
			<?php echo anchor('operator','Kembali',array('class'=>'btn btn-danger btn-sm'))?>
		</td>	
	</tr>
</table>
</form>
