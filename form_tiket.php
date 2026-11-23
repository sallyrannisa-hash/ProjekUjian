
<?php
require_once 'koneksi.php';

if (isset($_POST['tambah'])) {

    $kategori = $_POST['kategori'];
    $harga_tiket = $_POST['harga_tiket'];

    $query = "INSERT INTO tb_tiket (kategori, harga_tiket)
              VALUES (?, ?)";

    $stmt = mysqli_prepare($koneksi, $query);

    mysqli_stmt_bind_param(
        $stmt,
        "sd",
        $kategori,
        $harga_tiket
    );

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
                alert('Data tiket berhasil disimpan!');
                window.location='tabel.php';
              </script>";
        exit;
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($koneksi);
    }
}

require_once 'navbar1.php';
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    <h3>Form Tambah Tiket</h3>
                </div>

                <div class="card-body">

                    <form action="" method="POST">

                        <div class="mb-3">
                            <label class="form-label">Kategori Tiket:</label>

                            <div class="form-check">
                                <input class="form-check-input"
                                       type="radio"
                                       name="kategori"
                                       value="umum"
                                       required>

                                <label class="form-check-label">
                                    Umum
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input"
                                       type="radio"
                                       name="kategori"
                                       value="membership"
                                       required>

                                <label class="form-check-label">
                                    Membership
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Harga Tiket:</label>

                            <input type="number"
                                   class="form-control"
                                   name="harga_tiket"
                                   placeholder="Masukkan harga tiket"
                                   min="0"
                                   step="0.01"
                                   required>
                        </div>

                        <hr>

                        <button type="submit"
                                name="tambah"
                                class="btn btn-primary">
                            Simpan Data
                        </button>

                        <a href="tabel.php"
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
