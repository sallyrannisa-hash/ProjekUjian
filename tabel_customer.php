
<?php
require_once 'koneksi.php';
require_once 'navbar1.php';

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM tb_user ORDER BY id_user DESC"
);
?>

<div class="container mt-4">

    <div class="card">

        <div class="card-header">
            <h3>Tabel Customer Kolam Renang</h3>
        </div>

        <div class="card-body">

            <a href="form_user.php"
               class="btn btn-primary mb-3">
                + Tambah User
            </a>

            <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID User</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Nama</th>
                        </tr>
                    </thead>

                    <tbody>
    <?php
    $no = 1;

    while ($data = mysqli_fetch_assoc($query)) {
    ?>
        <tr>
            <td><?= $no++; ?></td>

            <td><?= $data['id_user']; ?></td>

            <td><?= htmlspecialchars($data['username']); ?></td>

            <td>********</td>

            <td><?= htmlspecialchars($data['role']); ?></td>

            <td><?= htmlspecialchars($data['nama']); ?></td>
        </tr>
    <?php } ?>
</tbody>

                        <?php
                        $no = 1;

                        if (mysqli_num_rows($query) > 0) {

                            while ($data = mysqli_fetch_assoc($query)) {
                        ?>

                        <tr>

                            <td><?= $no++; ?></td>

                            <td>
                                <?= $data['id_user']; ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($data['username']); ?>
                            </td>

                            <td>
                                ********
                            </td>

                            <td>
                                <?= htmlspecialchars($data['role']); ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($data['nama']); ?>
                            </td>

                        </tr>

                        <?php
                            }

                        } else {
                        ?>

                        <tr>
                            <td colspan="6" class="text-center">
                                Belum ada data user.
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
