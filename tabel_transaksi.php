
<?php
require_once 'koneksi.php';
require_once 'navbar1.php';

$query = mysqli_query(
    $koneksi,
    "SELECT
        tb_transaksi.*,
        tb_user.nama,
        tb_tiket.kategori,
        tb_tiket.harga_tiket
     FROM tb_transaksi
     JOIN tb_user
        ON tb_transaksi.id_user = tb_user.id_user
     JOIN tb_tiket
        ON tb_transaksi.id_tiket = tb_tiket.id_tiket
     ORDER BY tb_transaksi.id_transaksi DESC"
);
?>

<div class="container mt-4">

    <div class="card">

        <div class="card-header">
            <h3>Tabel Transaksi Tiket</h3>
        </div>

        <div class="card-body">

            <a href="form_transaksi.php"
               class="btn btn-primary mb-3">
                + Tambah Transaksi
            </a>

            <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Transaksi</th>
                            <th>Nama Customer</th>
                            <th>ID Tiket</th>
                            <th>Kategori</th>
                            <th>Jumlah Tiket</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        $no = 1;

                        if (mysqli_num_rows($query) > 0) {

                            while ($data = mysqli_fetch_assoc($query)) {
                        ?>

                        <tr>
                            <td><?= $no++; ?></td>

                            <td>
                                <?= $data['id_transaksi']; ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($data['nama']); ?>
                            </td>

                            <td>
                                <?= $data['id_tiket']; ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($data['kategori']); ?>
                            </td>

                            <td>
                                <?= $data['jml_tiket']; ?>
                            </td>

                            <td>
                                Rp <?= number_format(
                                    $data['total_harga'],
                                    0,
                                    ',',
                                    '.'
                                ); ?>
                            </td>
                        </tr>

                        <?php
                            }

                        } else {
                        ?>

                        <tr>
                            <td colspan="7" class="text-center">
                                Belum ada data transaksi.
                            </td>
                        </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>
        </div>
    </div>
</div>

<?php
require_once 'footer.php';
?>
