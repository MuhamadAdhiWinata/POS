<h3>Edit Data Operator</h3>
<?php 
	echo form_open('operator/edit')
?>
<input type="hidden" value="<?php echo $record['operator_id']?>" name="id">
<table class="table table-bordered">
	<tr>
		<td width="120">Nama Lengkap</td>
		<td>
			<div style="width: 360px;">
				<input type="text" class="form-control" name="nama" value="<?php echo $record['nama_lengkap']?>" placeholder="nama lengkap">
			</div>
		</td>
	</tr>
	<tr>
		<td>Username</td>
		<td>
			<div style="width: 360px;">
				<input type="text" class="form-control" name="username" value="<?php echo $record['username']?>" placeholder="username">
			</div>
		</td>
	</tr>
	<tr>
		<td>Password</td>
		<td>
			<div style="width: 360px;">
				<input type="password" class="form-control" name="password" placeholder="password">
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
