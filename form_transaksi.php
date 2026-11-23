
<?php
require_once 'koneksi.php';

if (isset($_POST['tambah'])) {

    $id_user = (int) $_POST['id_user'];
    $id_tiket = (int) $_POST['id_tiket'];
    $jml_tiket = (int) $_POST['jml_tiket'];

    if ($jml_tiket < 1) {
        die("Jumlah tiket minimal 1.");
    }

    // Mengambil harga tiket dari database
    $cek = mysqli_prepare(
        $koneksi,
        "SELECT harga_tiket FROM tb_tiket WHERE id_tiket = ?"
    );

    mysqli_stmt_bind_param($cek, "i", $id_tiket);
    mysqli_stmt_execute($cek);

    $hasil = mysqli_stmt_get_result($cek);
    $tiket = mysqli_fetch_assoc($hasil);

    if (!$tiket) {
        die("Tiket tidak ditemukan.");
    }

    // Menghitung total harga
    $total_harga = $tiket['harga_tiket'] * $jml_tiket;

    // Menyimpan transaksi
    $query = "INSERT INTO tb_transaksi
              (id_user, id_tiket, jml_tiket, total_harga)
              VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($koneksi, $query);

    mysqli_stmt_bind_param(
        $stmt,
        "iiid",
        $id_user,
        $id_tiket,
        $jml_tiket,
        $total_harga
    );

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
                alert('Transaksi berhasil disimpan!');
                window.location='tabel_transaksi.php';
              </script>";
        exit;
    } else {
        echo "Gagal menyimpan transaksi: " . mysqli_error($koneksi);
    }

    mysqli_stmt_close($stmt);
}

// Mengambil data customer
$customer = mysqli_query(
    $koneksi,
    "SELECT id_user, nama FROM tb_user
     WHERE role = 'customer'
     ORDER BY nama ASC"
);

// Mengambil data tiket
$tiket = mysqli_query(
    $koneksi,
    "SELECT * FROM tb_tiket ORDER BY id_tiket ASC"
);

require_once 'navbar1.php';
?>

<div class="container mt-4">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">

                <div class="card-header">
                    <h3>Form Transaksi Tiket</h3>
                </div>

                <div class="card-body">

                    <h5>Data Pembelian Tiket</h5>
                    <hr>

                    <form action="" method="POST">

                        <div class="mb-3">
                            <label class="form-label">
                                Pilih Customer:
                            </label>

                            <select class="form-select"
                                    name="id_user" required>

                                <option value="">
                                    Pilih Customer
                                </option>

                                <?php while ($data = mysqli_fetch_assoc($customer)) { ?>

                                    <option value="<?= $data['id_user']; ?>">
                                        <?= htmlspecialchars($data['nama']); ?>
                                    </option>

                                <?php } ?>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Pilih Tiket:
                            </label>

                            <select class="form-select"
                                    name="id_tiket" required>

                                <option value="">
                                    Pilih Kategori Tiket
                                </option>

                                <?php while ($data = mysqli_fetch_assoc($tiket)) { ?>

                                    <option value="<?= $data['id_tiket']; ?>">
                                        <?= htmlspecialchars($data['kategori']); ?>
                                        - Rp <?= number_format($data['harga_tiket'], 0, ',', '.'); ?>
                                    </option>

                                <?php } ?>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Jumlah Tiket:
                            </label>

                            <input type="number"
                                   class="form-control"
                                   name="jml_tiket"
                                   min="1"
                                   placeholder="Masukkan Jumlah Tiket"
                                   required>
                        </div>

                        <hr>

                        <button type="submit"
                                name="tambah"
                                class="btn btn-primary">
                            Simpan Transaksi
                        </button>

                        <a href="tabel_transaksi.php"
                           class="btn btn-secondary">
                            Kembali
                        </a>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<?php
require_once 'footer.php';
?>
