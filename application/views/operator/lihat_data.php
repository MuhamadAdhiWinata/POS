<link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.bootstrap.css">

<h3>Data Operator</h3>

<?php
	echo anchor('operator/post','Tambah Data', array('class'=>'btn btn-success btn-sm'));
?>
<hr>
<table class="table table-striped" id="example">
        <thead>
            <tr class="active">
								<th width="10">No</th>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Login Terakhir</th>
                <th>
					<div class="text-center">
						Operasi
					</div>
					</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            foreach ($record as $r): ?>
                <tr>
                    <td><p class="text-center"><?= $no++ ?></p></td>
                    <td><?= $r->nama_lengkap ?></td>
                    <td><?= $r->username ?></td>
                    <td><?= $r->last_log ?></td>
                    <td>
											<p class="text-center">
												<?= anchor('operator/edit/'.$r->operator_id,'Edit') ?>
												<?= anchor('operator/delete/'.$r->operator_id,'Delete') ?>
											</p>
										</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.1/js/dataTables.bootstrap.js"></script>

<script>
    new DataTable('#example');
</script>
