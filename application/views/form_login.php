<?php 
echo form_open('auth/login');
?>

<table class="table table-bordered">
	<tr>
		<td width="120">username</td>
		<td>
			<input type="text" class="form-control" name="username" placeholder="username">
		</td>
	</tr>
	<tr>
		<td>password</td>
		<td>
			<input type="password" class="form-control" name="password" placeholder="password">
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<button type="submit" class="btn btn-default" name="submit">Login</button>
		</td>
	</tr>
</table>
</form>
