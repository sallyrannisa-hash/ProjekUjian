
<?php
require_once 'koneksi.php';

if (isset($_POST['tambah'])) {

    $username = $_POST['username'];
    $password = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $nama = $_POST['nama'];

    $query = "INSERT INTO tb_user
              (username, pass, role, nama)
              VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($koneksi, $query);

    mysqli_stmt_bind_param(
        $stmt,
        "ssss",
        $username,
        $password,
        $role,
        $nama
    );

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
            alert('Data berhasil ditambahkan!');
            window.location='tabel_customer.php';
        </script>";
        exit;
    } else {
        echo "Gagal: " . mysqli_error($koneksi);
    }
}

require_once 'navbar1.php';
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    <h3>Form Tambah Customer</h3>
                </div>

                <div class="card-body">

                    <form action="" method="POST">

                        <div class="mb-3">
                            <label class="form-label">Username:</label>
                            <input type="text" class="form-control"
                                   name="username" 
                             placeholder="Masukkan Username"
                                   min="0"
                                   step="0.01"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password:</label>
                            <input type="password" class="form-control"
                                   name="pass" placeholder="Masukkan Password"
                                   min="0"
                                   step="0.01"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Role:</label>
                            <select class="form-select" name="role" required>
                                <option value="">Pilih Role</option>
                                <option value="admin">Admin</option>
                                <option value="customer">Customer</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap:</label>
                            <input type="text" class="form-control"
                                   name="nama" placeholder="Masukkan Nama Lengkap"
                                   required>
                        </div>

                        <button type="submit" name="tambah"
                                class="btn btn-primary">
                            Simpan Data
                        </button>

                        <a href="tabel_customer.php"
                           class="btn btn-secondary">
                            Kembali
                        </a>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>
