<link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.bootstrap.css">

<div class="container">
    <h3>Laporan Transaksi</h3>

    <?= form_open('transaksi/laporan') ?>
    <table class="table table-bordered">
        <tr>
            <td>
                <div class="row">
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="tanggal1" placeholder="Tanggal Mulai">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="tanggal2" placeholder="Tanggal Selesai">
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-primary btn-sm" type="submit" name="submit">Proses</button>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    </form>

    <table class="table table-bordered" id="laporanTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Transaksi</th>
                <th>Operator</th>
                <th>Total Transaksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $total = 0;
            foreach ($record->result() as $r): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $r->tanggal_transaksi ?></td>
                    <td><?= $r->nama_lengkap ?></td>
                    <td><?= $r->total ?></td>
                </tr>
                <?php $total += $r->total; ?>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" ><div class="text-right">Total</div></td>
                <td><strong><?= $total ?></strong></td>
            </tr>
        </tfoot>
    </table>
</div>

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.1/js/dataTables.bootstrap.js"></script>

<script>
    new DataTable('#laporanTable');
</script>
