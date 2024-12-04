<?php
session_start();

// Jika sesi belum ada, cek cookie
if (!isset($_SESSION['admin_id']) && isset($_COOKIE['admin_id'])) {
    $_SESSION['admin_id'] = $_COOKIE['admin_id'];
    $_SESSION['username'] = $_COOKIE['username'];
}

// Jika tidak ada sesi atau cookie, redirect ke login
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../Admin/index.php");
    exit;
}
?>

<?php
include '../include/sidebar.php';
include '../Data/db_connect.php'; // Koneksi ke database

// Inisialisasi variabel untuk pesan
$addSuccess = false;
$updateSuccess = false;
$deleteSuccess = false;

// Cek koneksi database
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Menangani pengunggahan file gambar dan menambah data ke database
if (isset($_POST['add_dosen']) && isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
    // Ambil data dari form
    $nama = mysqli_real_escape_string($conn, trim($_POST['nama']));

    // Proses unggah file
    $file = $_FILES['gambar'];
    $targetDir = '../uploads/';  // Direktori tempat file disimpan
    $newFileName = time() . '_' . basename($file['name']);
    $filePath = $targetDir . $newFileName;

    // Validasi tipe file
    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    $fileType = mime_content_type($file['tmp_name']);
    if (!in_array($fileType, $allowedTypes)) {
        echo "<script>alert('Hanya file gambar (JPEG/PNG) yang diperbolehkan.');</script>";
        exit;
    }

    // Pindahkan file ke folder tujuan
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        // Masukkan data file baru ke database
        $query = "INSERT INTO strukturdosen (nama, gambar) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'ss', $nama, $filePath);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Data berhasil ditambahkan.');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Gagal mengunggah file.');</script>";
    }
}

// Hapus Gambar Struktur Dosen
if (isset($_POST['delete_dosen'])) {
    // Ambil ID dari input hidden
    $no = mysqli_real_escape_string($conn, trim($_POST['no']));

    // Ambil path file yang akan dihapus dari database
    $getFileQuery = "SELECT gambar FROM strukturdosen WHERE no = ?";
    $stmt = mysqli_prepare($conn, $getFileQuery);
    mysqli_stmt_bind_param($stmt, 'i', $no);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $fileData = mysqli_fetch_assoc($result);
        $filePathToDelete = $fileData['gambar'];

        // Hapus file dari server jika file ada
        if (file_exists($filePathToDelete)) {
            unlink($filePathToDelete); // Hapus file dari folder
        }

        // Hapus data dari database
        $deleteQuery = "DELETE FROM strukturdosen WHERE no = ?";
        $stmt = mysqli_prepare($conn, $deleteQuery);
        mysqli_stmt_bind_param($stmt, 'i', $no);

        if (mysqli_stmt_execute($stmt)) {
        } else {
            echo "<script>alert('Error saat menghapus data.');</script>";
        }
    } else {
        echo "<script>alert('Data tidak ditemukan.');</script>";
    }
}


// Fungsi untuk mengupload file
function uploadFile($file, $targetDir = '../uploads/')
{
    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    $fileName = $file['name'];
    $fileTmp = $file['tmp_name'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
    if (!in_array($fileExtension, $allowedExtensions)) {
        return ['error' => "Format file tidak didukung. Hanya JPG, JPEG, dan PNG yang diizinkan."];
    }

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $newFileName = time() . '_' . basename($fileName);
    $filePath = $targetDir . $newFileName;

    if (move_uploaded_file($fileTmp, $filePath)) {
        return ['path' => $filePath];
    }

    return ['error' => "Gagal mengunggah file."];
}        

// Tambah Data
if (isset($_POST['add'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $nip = mysqli_real_escape_string($conn, $_POST['nip']);
    $jabatan = mysqli_real_escape_string($conn, $_POST['jabatan']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
    $foto = null;

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $upload = uploadFile($_FILES['foto']);
        if (isset($upload['path'])) {
            $foto = $upload['path'];
        } else {
            echo "<script>alert('{$upload['error']}');</script>";
        }
    }

    $query = "INSERT INTO dosen (nama, nip, jabatan, email, telepon, foto, created_at, updated_at) 
              VALUES ('$nama', '$nip', '$jabatan', '$email', '$telepon', '$foto', NOW(), NOW())";

    if (mysqli_query($conn, $query)) {
    } else {
        echo "<script>alert('Terjadi kesalahan: " . mysqli_error($conn) . "');</script>";
    }
}

// Update Data
if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $nip = mysqli_real_escape_string($conn, $_POST['nip']);
    $jabatan = mysqli_real_escape_string($conn, $_POST['jabatan']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
    $foto = null;

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $upload = uploadFile($_FILES['foto']);
        if (isset($upload['path'])) {
            $foto = $upload['path'];

            // Hapus file lama
            $oldFotoQuery = "SELECT foto FROM dosen WHERE id='$id'";
            $oldFotoResult = mysqli_query($conn, $oldFotoQuery);
            if ($oldFotoResult && mysqli_num_rows($oldFotoResult) > 0) {
                $oldFotoRow = mysqli_fetch_assoc($oldFotoResult);
                if (file_exists($oldFotoRow['foto'])) {
                    unlink($oldFotoRow['foto']);
                }
            }
        } else {
            echo "<script>alert('{$upload['error']}');</script>";
        }
    }

    if ($foto) {
        $query = "UPDATE dosen SET nama='$nama', nip='$nip', jabatan='$jabatan', email='$email', telepon='$telepon', foto='$foto', updated_at=NOW() WHERE id='$id'";
    } else {
        $query = "UPDATE dosen SET nama='$nama', nip='$nip', jabatan='$jabatan', email='$email', telepon='$telepon', updated_at=NOW() WHERE id='$id'";
    }

    if (mysqli_query($conn, $query)) {
    } else {
        echo "<script>alert('Terjadi kesalahan: " . mysqli_error($conn) . "');</script>";
    }
}

// Hapus Data
if (isset($_POST['delete'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    if (empty($id)) {
        echo "<script>alert('ID tidak ditemukan!');</script>";
    } else {
        // Hapus file foto jika ada
        $fotoQuery = "SELECT foto FROM dosen WHERE id='$id'";
        $fotoResult = mysqli_query($conn, $fotoQuery);
        if ($fotoResult && mysqli_num_rows($fotoResult) > 0) {
            $fotoRow = mysqli_fetch_assoc($fotoResult);
            if (!empty($fotoRow['foto']) && file_exists($fotoRow['foto'])) {
                unlink($fotoRow['foto']);
            }
        }

        // Hapus data dari database
        $query = "DELETE FROM dosen WHERE id='$id'";
        if (mysqli_query($conn, $query)) {
        } else {
            echo "<script>alert('Gagal menghapus data: " . mysqli_error($conn) . "');</script>";
        }
    }
}

// Ambil data dari tabel strukturdosen
$strukturdosenQuery = "SELECT * FROM strukturdosen";  // Perbaiki nama variabel query
$strukturdosenResult = mysqli_query($conn, $strukturdosenQuery);  // Jalankan query

// Cek apakah query berhasil
if (!$strukturdosenResult) {
    die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Data Dosen</title>
    <style>
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
            overflow-y: auto;
        }
        .form-container {
            width: 100%;
            margin: 20px auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .btn-add {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            text-align: center;
            display: inline-flex;
            align-items: center;
            margin-bottom: 20px;
            transition: background-color 0.3s;
        }
        .btn-add:hover {
            background-color: #0056b3;
        }
        .modal {
            z-index: 9999; /* Pastikan nilai ini sangat tinggi */
        }
        .modal-backdrop {
            z-index: 9998; /* Sedikit di bawah modal */
        }
    </style>
</head>
<body>
    <div class="content">
        <h3 class="mb-4">STRUKTUR DOSEN</h3>

        <!-- Tombol Tambah Struktur Dosen -->
        <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addModalStruktur">
            <i class="fas fa-plus"></i> Tambah File Struktur Dosen
        </button>

        <!-- Tabel Data Struktur Dosen -->
        <div class="table-responsive form-container">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Tanggal Upload</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($strukturdosenResult) > 0): ?>
                        <?php $no = 1; ?>
                        <?php while ($row = mysqli_fetch_assoc($strukturdosenResult)): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row['nama']) ?></td>
                                <td>
                                    <img src="<?= htmlspecialchars($row['gambar']) ?>" alt="gambar" style="width: 100px; height: auto;">
                                </td>
                                <td><?= htmlspecialchars($row['tanggal_upload']) ?></td>
                                <td>
                                    <button class="btn btn-danger btn-delete" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModalStruktur" 
                                            data-id="<?= htmlspecialchars($row['no']) ?>">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">Data tidak ditemukan</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Modal Tambah Data Struktur Dosen -->
        <div class="modal fade" id="addModalStruktur" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Data Struktur Dosen</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Input Nama Dosen -->
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama File</label>
                                <input type="text" class="form-control" name="nama" id="nama" required>
                            </div>

                            <!-- Input File Gambar -->
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Pilih File Gambar</label>
                                <input type="file" class="form-control" name="gambar" id="gambar" accept=".jpg,.jpeg,.png" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" name="add_dosen" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Hapus Data Struktur Dosen -->
        <div class="modal fade" id="deleteModalStruktur" tabindex="-1" aria-labelledby="deleteModalStrukturLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalStrukturLabel">Hapus Data Struktur Dosen</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Input ID yang akan dihapus -->
                            <input type="hidden" name="no" id="deleteNo">
                            <p>Apakah Anda yakin ingin menghapus data Struktur Dosen ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" name="delete_dosen" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <h3 class="mb-4">DATA DOSEN</h3>

        <!-- Tombol Tambah -->
        <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="fas fa-plus"></i> Tambah Data
        </button>
        
        <!-- Card Layout for Dosen Data -->
        <div class="container my-4">
            <div class="row">
                <?php
                // Query SQL untuk mendapatkan data dosen
                $sql = "SELECT * FROM dosen";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card shadow-sm border-0">
                                <!-- Foto Profil -->
                                <div class="card-header bg-light text-center">
                                    <img src="<?php echo htmlspecialchars($row['foto']); ?>" 
                                        alt="Foto Dosen" 
                                        class="rounded-circle shadow-sm mb-2" 
                                        width="100" height="100" 
                                        style="object-fit: cover;">
                                    <h5 class="card-title mb-0 mt-2"><?php echo htmlspecialchars($row['nama']); ?></h5>
                                    <small class="text-muted">NIP: <?php echo htmlspecialchars($row['nip']); ?></small>
                                </div>
                                <!-- Biodata Dosen -->
                                <div class="card-body">
                                    <p class="mb-1"><strong>Jabatan:</strong> <?php echo htmlspecialchars($row['jabatan']); ?></p>
                                    <p class="mb-1"><strong>Email:</strong> <a href="mailto:<?php echo htmlspecialchars($row['email']); ?>" class="text-decoration-none"><?php echo htmlspecialchars($row['email']); ?></a></p>
                                    <p class="mb-1"><strong>Telepon:</strong> <?php echo htmlspecialchars($row['telepon']); ?></p>
                                </div>
                                <!-- Tombol Aksi -->
                                <div class="card-footer bg-white d-flex justify-content-between">
                                    <button class="btn btn-sm btn-primary btn-edit" data-bs-toggle="modal" data-bs-target="#editModal" 
                                            data-id="<?php echo $row['id']; ?>" 
                                            data-nama="<?php echo htmlspecialchars($row['nama']); ?>" 
                                            data-nip="<?php echo htmlspecialchars($row['nip']); ?>" 
                                            data-jabatan="<?php echo htmlspecialchars($row['jabatan']); ?>" 
                                            data-email="<?php echo htmlspecialchars($row['email']); ?>" 
                                            data-telepon="<?php echo htmlspecialchars($row['telepon']); ?>" 
                                            data-foto="<?php echo htmlspecialchars($row['foto']); ?>">Edit</button>
                                    <button class='btn btn-sm btn-danger btn-delete' 
                                            data-bs-toggle='modal' 
                                            data-bs-target='#deleteModal' 
                                            data-id='<?php echo $row['id']; ?>'>
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            Tidak ada data dosen yang ditemukan.
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Data Dosen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" required>
                        </div>
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="text" class="form-control" id="telepon" name="telepon" required>
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" name="add" class="btn btn-primary">Tambah Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Data -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Dosen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="editId">
                        <div class="mb-3">
                            <label for="editNama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="editNama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="editNip" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="editNip" name="nip" required>
                        </div>
                        <div class="mb-3">
                            <label for="editJabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" id="editJabatan" name="jabatan" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="editTelepon" class="form-label">Telepon</label>
                            <input type="text" class="form-control" id="editTelepon" name="telepon" required>
                        </div>
                        <div class="mb-3">
                            <label for="editFoto" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="editFoto" name="foto">
                            <img src="" id="currentFoto" alt="Foto Dosen" width="100" class="mt-2">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" name="update" class="btn btn-primary">Update Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Data -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Hapus Data Dosen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="deleteId">
                        <p>Apakah Anda yakin ingin menghapus data dosen ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" name="delete" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            document.getElementById('editId').value = button.getAttribute('data-id');
            document.getElementById('editNama').value = button.getAttribute('data-nama');
            document.getElementById('editNip').value = button.getAttribute('data-nip');
            document.getElementById('editJabatan').value = button.getAttribute('data-jabatan');
            document.getElementById('editEmail').value = button.getAttribute('data-email');
            document.getElementById('editTelepon').value = button.getAttribute('data-telepon');
            document.getElementById('currentFoto').src = button.getAttribute('data-foto');
        });
        const deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                document.getElementById('deleteId').value = button.getAttribute('data-id');
            });

        // Pastikan modal mendapat ID yang benar saat tombol hapus diklik
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const no = this.getAttribute('data-id'); // Ambil nilai 'data-id'
                document.getElementById('deleteNo').value = no; // Set nilai input hidden dengan 'no'
            });
        });

    </script>
</body>
</html>
