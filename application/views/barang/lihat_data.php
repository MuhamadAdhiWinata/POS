<link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.bootstrap.css">

<div class="container">
    <h3>Data Barang</h3>
    <?php echo anchor('barang/post', 'Tambah Data', ['class' => 'btn btn-success btn-sm']); ?>
    <hr>

    <table class="table table-striped" id="example">
        <thead>
            <tr class="active">
                <th width="10">No</th>
                <th>Nama Barang</th>
                <th>Kategori Barang</th>
                <th>Harga</th>
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
                    <td><?= $r->nama_barang ?></td>
                    <td><?= $r->nama_kategori ?></td>
                    <td><?= $r->harga ?></td>
                    <td>
						<p class="text-center">
							<?= anchor('barang/edit/' . $r->barang_id, 'Edit') ?>
							<?= anchor('barang/delete/' . $r->barang_id, 'Delete') ?>
						</p>
					</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.1/js/dataTables.bootstrap.js"></script>

<script>
    new DataTable('#example');
</script>
