
<?php
require_once 'koneksi.php';
require_once 'navbar1.php';

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM tb_tiket ORDER BY id_tiket DESC"
);
?>

<div class="container mt-4">

    <div class="card">

        <div class="card-header">
            <h3>Tabel Tiket Kolam Renang</h3>
        </div>

        <div class="card-body">

            <a href="form_tiket.php"
               class="btn btn-primary mb-3">
                + Tambah Tiket
            </a>

            <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Tiket</th>
                            <th>Kategori</th>
                            <th>Harga Tiket</th>
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
                                <?= $data['id_tiket']; ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($data['kategori']); ?>
                            </td>

                            <td>
                                Rp <?= number_format(
                                    $data['harga_tiket'],
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
                            <td colspan="4" class="text-center">
                                Belum ada data tiket.
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
