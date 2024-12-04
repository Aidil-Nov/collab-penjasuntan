<?php
session_start();

// Cek sesi atau cookie untuk autentikasi admin
if (!isset($_SESSION['admin_id']) && isset($_COOKIE['admin_id'])) {
    $_SESSION['admin_id'] = $_COOKIE['admin_id'];
    $_SESSION['username'] = $_COOKIE['username'];
}

// Redirect ke halaman login jika tidak ada sesi
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../Admin/index.php");
    exit;
}
?>

<?php
include '../include/sidebar.php'; 
include '../Data/db_connect.php'; // Koneksi ke database

// Cek koneksi ke database
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Variabel untuk pesan status
$addSuccess = false;
$updateSuccess = false;
$deleteSuccess = false;

// Pagination variables
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10; // Default 10 records per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Default halaman pertama
$offset = ($page - 1) * $limit; // Hitung offset

// Search functionality
$search = isset($_POST['search']) ? mysqli_real_escape_string($conn, $_POST['search']) : '';
$searchCondition = !empty($search) ? "WHERE nama LIKE '%$search%' OR jabatan LIKE '%$search%'" : '';

// Menangani pengunggahan file PDF dan menambah data ke database
if (isset($_POST['add_sk']) && isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    // Ambil data dari form
    $nama_file = mysqli_real_escape_string($conn, trim($_POST['nama_file']));
    $created_at = date('Y-m-d H:i:s'); // Tanggal dibuat otomatis

    // Proses unggah file
    $file = $_FILES['file'];
    $targetDir = '../uploads/';  // Direktori tempat file disimpan
    $newFileName = time() . '_' . basename($file['name']);
    $filePath = $targetDir . $newFileName;

    // Validasi tipe file
    $allowedTypes = ['application/pdf'];
    $fileType = mime_content_type($file['tmp_name']);
    if (!in_array($fileType, $allowedTypes)) {
        echo "<script>alert('Hanya file PDF yang diperbolehkan.');</script>";
        exit;
    }

    // Cek apakah dokumen sudah ada di database
    $checkQuery = "SELECT * FROM SK LIMIT 1"; // Ambil 1 data dari tabel SK
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Hapus file lama jika ada
        $oldFile = mysqli_fetch_assoc($checkResult);
        $oldFilePath = $oldFile['file_path'];

        if (file_exists($oldFilePath)) {
            unlink($oldFilePath); // Hapus file dari server
        }

        // Hapus data file lama dari database
        $deleteQuery = "DELETE FROM SK WHERE id = ?";
        $stmt = mysqli_prepare($conn, $deleteQuery);
        mysqli_stmt_bind_param($stmt, 'i', $oldFile['id']);
        mysqli_stmt_execute($stmt);
    }

    // Pindahkan file ke folder tujuan
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        // Masukkan data file baru ke database
        $query = "INSERT INTO SK (nama_file, file_path, created_at) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'sss', $nama_file, $filePath, $created_at);

        if (mysqli_stmt_execute($stmt)) {
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Gagal mengunggah file.');</script>";
    }
}

// Hapus Dokumen SK
if (isset($_POST['delete_sk'])) {
    $id = mysqli_real_escape_string($conn, trim($_POST['id']));

    // Ambil path file yang akan dihapus
    $getFileQuery = "SELECT file_path FROM SK WHERE id = ?";
    $stmt = mysqli_prepare($conn, $getFileQuery);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $fileData = mysqli_fetch_assoc($result);
        $filePathToDelete = $fileData['file_path'];

        // Hapus file dari server
        if (file_exists($filePathToDelete)) {
            unlink($filePathToDelete);
        }

        // Hapus data file dari database
        $deleteQuery = "DELETE FROM SK WHERE id = ?";
        $stmt = mysqli_prepare($conn, $deleteQuery);
        mysqli_stmt_bind_param($stmt, 'i', $id);

        if (mysqli_stmt_execute($stmt)) {
        } else {
            echo "<script>alert('Error saat menghapus data.');</script>";
        }
    }
}

// Tambah Data Anggota
if (isset($_POST['add_member'])) {
    $nama = mysqli_real_escape_string($conn, trim($_POST['nama']));
    $jabatan = mysqli_real_escape_string($conn, trim($_POST['jabatan']));
    $nim = mysqli_real_escape_string($conn, trim($_POST['nim']));

    $query = "INSERT INTO organisasi (nama, jabatan, nim) VALUES ('$nama', '$jabatan', '$nim')";
    if (mysqli_query($conn, $query)) {
        $addSuccess = true;
    }
}

// Update Data Anggota
if (isset($_POST['update_member'])) {
    $id = mysqli_real_escape_string($conn, trim($_POST['id']));
    $nama = mysqli_real_escape_string($conn, trim($_POST['nama']));
    $jabatan = mysqli_real_escape_string($conn, trim($_POST['jabatan']));
    $nim = mysqli_real_escape_string($conn, trim($_POST['nim']));

    $query = "UPDATE organisasi SET nama='$nama', jabatan='$jabatan', nim='$nim' WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        $updateSuccess = true;
    }
}

// Hapus Data Anggota
if (isset($_POST['delete_member'])) {
    $id = mysqli_real_escape_string($conn, trim($_POST['id']));

    $query = "DELETE FROM organisasi WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        $deleteSuccess = true;
    }
}

// Ambil Data untuk Ditampilkan
$totalQuery = "SELECT COUNT(*) as total FROM organisasi $searchCondition";
$totalResult = mysqli_query($conn, $totalQuery);
$totalRow = mysqli_fetch_assoc($totalResult);
$totalRows = $totalRow['total'];
$totalPages = ceil($totalRows / $limit);

$query = "SELECT * FROM organisasi $searchCondition LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $query);

// Ambil data dari tabel SK
$skQuery = "SELECT * FROM SK";
$skResult = mysqli_query($conn, $skQuery);

// Cek apakah query berhasil
if (!$result) {
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
    <title>Data Organisasi</title>
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
        <h3 class="mb-4">SURAT KEPUTUSAN</h3>

        <!-- Tombol Tambah SK -->
        <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addModalSK">
            <i class="fas fa-plus"></i> Tambah File SK
        </button>

        <!-- Tabel Data SK -->
        <div class="table-responsive form-container">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama File</th>
                        <th>File Path</th>
                        <th>Tanggal Upload</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($skResult) && mysqli_num_rows($skResult) > 0): ?>
                        <?php $no = 1; ?>
                        <?php while ($row = mysqli_fetch_assoc($skResult)): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row['nama_file']) ?></td>
                                <td>
                                    <a href="<?= htmlspecialchars($row['file_path']) ?>" target="_blank" class="btn btn-primary">Download</a>
                                </td>
                                <td><?= htmlspecialchars($row['created_at']) ?></td>
                                <td>
                                    <button class="btn btn-danger btn-delete" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModalSK" 
                                            data-id="<?= htmlspecialchars($row['id']) ?>">
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

        <!-- Modal Tambah Data SK -->
        <div class="modal fade" id="addModalSK" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Data SK</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Input Nama File -->
                            <div class="mb-3">
                                <label for="nama_file" class="form-label">Nama File</label>
                                <input type="text" class="form-control" name="nama_file" id="nama_file" required>
                            </div>

                            <!-- Input File PDF -->
                            <div class="mb-3">
                                <label for="file" class="form-label">Pilih File PDF</label>
                                <input type="file" class="form-control" name="file" id="file" accept=".pdf" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" name="add_sk" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Hapus Data SK -->
        <div class="modal fade" id="deleteModalSK" tabindex="-1" aria-labelledby="deleteModalSKLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalSKLabel">Hapus Data SK</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="deleteId">
                            <p>Apakah Anda yakin ingin menghapus data SK ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" name="delete_sk" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <h3 class="mb-4">DATA ANGGOTA ORGANISASI</h3>

        <!-- Tombol Tambah Anggota -->
        <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addModalAnggota">
            <i class="fas fa-plus"></i> Tambah Data
        </button>

        <!-- Search Form -->
        <form method="POST" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari Nama atau Jabatan" value="<?php echo htmlspecialchars($search); ?>">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </form>

        <!-- Pagination Controls -->
        <div class="mb-4">
            <label for="limit">Tampilkan:</label>
            <select id="limit" class="form-select d-inline-block w-auto" onchange="location = this.value;">
                <option value="organisasi.php?limit=10" <?php if ($limit == 10) echo 'selected'; ?>>10</option>
                <option value="organisasi.php?limit=20" <?php if ($limit == 20) echo 'selected'; ?>>20</option>
                <option value="organisasi.php?limit=30" <?php if ($limit == 30) echo 'selected'; ?>>30</option>
            </select>
            <span> data per halaman</span>
        </div>

        <!-- Tabel Data Anggota -->
        <div class="table-responsive form-container">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>NIM</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = $offset + 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['jabatan']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nim']) . "</td>";
                    echo "<td>
                            <button class='btn btn-primary btn-edit' data-bs-toggle='modal' data-bs-target='#editModalAnggota' 
                                data-id='{$row['id']}' data-nama='{$row['nama']}' 
                                data-jabatan='{$row['jabatan']}' data-nim='{$row['nim']}'>Edit</button>
                            <button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteModalAnggota'
                                data-id='{$row['id']}'>Hapus</button>
                        </td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>&limit=<?php echo $limit; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>&limit=<?php echo $limit; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?php if ($page >= $totalPages) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>&limit=<?php echo $limit; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Modal Tambah Data Anngota -->
        <div class="modal fade" id="addModalAnggota" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Data Anggota</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" name="jabatan" required>
                            </div>
                            <div class="mb-3">
                                <label for="nim" class="form-label">NIM</label>
                                <input type="text" class="form-control" name="nim" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" name="add" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit Data Anggota -->
        <div class="modal fade" id="editModalAnggota" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Data Anggota</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="editId">
                            <div class="mb-3">
                                <label for="editNama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="editNama" name="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="editJabatan" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" id="editJabatan" name="jabatan" required>
                            </div>
                            <div class="mb-3">
                                <label for="editNim" class="form-label">NIM</label>
                                <input type="text" class="form-control" id="editNim" name="nim" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" name="update" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Hapus Data Anggota -->
        <div class="modal fade" id="deleteModalAnggota" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus Data Anggota</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="deleteId">
                            <p>Apakah Anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" name="delete" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const editModal = document.getElementById('editModalAnggota');
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const nama = button.getAttribute('data-nama');
            const jabatan = button.getAttribute('data-jabatan');
            const nim = button.getAttribute('data-nim');

            editModal.querySelector('#editId').value = id;
            editModal.querySelector('#editNama').value = nama;
            editModal.querySelector('#editJabatan').value = jabatan;
            editModal.querySelector('#editNim').value = nim;
        });

        const deleteModal = document.getElementById('deleteModalAnggota');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            deleteModal.querySelector('#deleteId').value = id;
        });

        // Modal Hapus Data SK
        const deleteModalSK = document.getElementById('deleteModalSK');
        deleteModalSK.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; 
            const id = button.getAttribute('data-id'); 
            const modalBodyInput = deleteModalSK.querySelector('.modal-body #deleteId');
            modalBodyInput.value = id;
        });
    </script>
</body>
</html>
