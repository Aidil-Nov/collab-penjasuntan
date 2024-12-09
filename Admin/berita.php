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

$addSuccess = false;
$updateSuccess = false;
$deleteSuccess = false;

// Pagination variables
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10; // Default to 10 records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Default to first page
$offset = ($page - 1) * $limit; // Calculate offset

// Search functionality
$search = isset($_POST['search']) ? mysqli_real_escape_string($conn, $_POST['search']) : '';

// Add data
if (isset($_POST['add'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $highlight = mysqli_real_escape_string($conn, $_POST['highlight']);
    $isi = mysqli_real_escape_string($conn, $_POST['isi']);
    
    // File upload handling
    $foto = '';
    if (isset($_FILES['foto']['name']) && $_FILES['foto']['error'] == 0) {
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $fileExtension = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

        if (in_array($fileExtension, $allowedExtensions)) {
            $foto = '../uploads/' . time() . '_' . basename($_FILES['foto']['name']);
            if (!move_uploaded_file($_FILES['foto']['tmp_name'], $foto)) {
                echo "<script>alert('Gagal mengunggah file foto.');</script>";
            }
        } else {
            echo "<script>alert('Format file foto tidak didukung. Hanya JPG, JPEG, dan PNG.');</script>";
        }
    }

    // Add to database
    if ($foto) {
        $query = "INSERT INTO berita (judul, highlight, isi, foto, tanggal_upload) 
                  VALUES ('$judul', '$highlight', '$isi', '$foto', NOW())";
    } else {
        $query = "INSERT INTO berita (judul, highlight, isi, tanggal_upload) 
                  VALUES ('$judul', '$highlight', '$isi', NOW())";
    }

    if (mysqli_query($conn, $query)) {
        $addSuccess = true;
    } else {
        echo "<script>alert('Terjadi kesalahan saat menambahkan data: " . mysqli_error($conn) . "');</script>";
    }
}

// Update data
if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $highlight = mysqli_real_escape_string($conn, $_POST['highlight']);
    $isi = mysqli_real_escape_string($conn, $_POST['isi']);

    // Foto handling
    if (isset($_FILES['foto']['name']) && $_FILES['foto']['error'] == 0) {
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $fileExtension = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

        if (in_array($fileExtension, $allowedExtensions)) {
            $foto = '../uploads/' . time() . '_' . basename($_FILES['foto']['name']);
            move_uploaded_file($_FILES['foto']['tmp_name'], $foto);

            // Hapus file lama jika ada
            $oldFotoQuery = "SELECT foto FROM berita WHERE id='$id'";
            $oldFotoResult = mysqli_query($conn, $oldFotoQuery);
            $oldFotoRow = mysqli_fetch_assoc($oldFotoResult);
            if (file_exists($oldFotoRow['foto'])) {
                unlink($oldFotoRow['foto']);
            }

            // Update query with new foto
            $query = "UPDATE berita SET judul='$judul', highlight='$highlight', isi='$isi', foto='$foto' WHERE id='$id'";
        } else {
            echo "<script>alert('Format file foto tidak didukung. Hanya JPG, JPEG, dan PNG.');</script>";
        }
    } else {
        $query = "UPDATE berita SET judul='$judul', highlight='$highlight', isi='$isi' WHERE id='$id'";
    }

    if (mysqli_query($conn, $query)) {
        $updateSuccess = true;
    } else {
        echo "<script>alert('Terjadi kesalahan saat mengupdate data: " . mysqli_error($conn) . "');</script>";
    }
}

// Delete data
if (isset($_POST['delete'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $query = "DELETE FROM berita WHERE id='$id'";

    if (mysqli_query($conn, $query)) {
        $deleteSuccess = true;
    } else {
        echo "<script>alert('Terjadi kesalahan saat menghapus data: " . mysqli_error($conn) . "');</script>";
    }
}

// Fetch data with pagination and search
$query = "SELECT * FROM berita WHERE 
          judul LIKE '%$search%' OR 
          highlight LIKE '%$search%' 
          LIMIT $offset, $limit";
$result = mysqli_query($conn, $query);

// Count total records for pagination
$totalQuery = "SELECT COUNT(*) as total FROM berita WHERE 
               judul LIKE '%$search%' OR 
               highlight LIKE '%$search%'";
$totalResult = mysqli_query($conn, $totalQuery);
$totalRow = mysqli_fetch_assoc($totalResult);
$totalRecords = $totalRow['total'];
$totalPages = ceil($totalRecords / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Data Berita</title>
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
        <h3 class="mb-4">DATA BERITA</h3>

        <!-- Tombol Tambah -->
        <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="fas fa-plus"></i> Tambah Data
        </button>

        <!-- Search Form -->
        <form method="POST" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari Judul atau Highlight" value="<?php echo htmlspecialchars($search); ?>">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </form>
        
        <!-- Pagination Controls -->
        <div class="mb-4">
            <label for="limit">Tampilkan:</label>
            <select id="limit" class="form-select d-inline-block w-auto" onchange="location = this.value;">
                <option value="berita.php?limit=10" <?php if ($limit == 10) echo 'selected'; ?>>10</option>
                <option value="berita.php?limit=20" <?php if ($limit == 20) echo 'selected'; ?>>20</option>
                <option value="berita.php?limit=30" <?php if ($limit == 30) echo 'selected'; ?>>30</option>
            </select>
            <span> data per halaman</span>
        </div>

        <!-- Tabel Data -->
        <div class="table-responsive form-container">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Judul</th>
                        <th>Highlight</th>
                        <th>View Count</th>
                        <th>Tanggal Upload</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = $offset + 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td><img src='" . htmlspecialchars($row['foto']) . "' alt='Foto' style='width: 100px; height: auto;'></td>";
                        echo "<td>" . htmlspecialchars($row['judul']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['highlight']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['view_count']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tanggal_upload']) . "</td>";
                        echo "<td>
                                <button class='btn btn-primary btn-edit mb-2' data-bs-toggle='modal' data-bs-target='#editModal' 
                                    data-id='{$row['id']}' data-judul='{$row['judul']}' 
                                    data-highlight='{$row['highlight']}' data-isi='{$row['isi']}' 
                                    data-tanggal_upload='{$row['tanggal_upload']}'>Edit</button>
                                <button class='btn btn-danger btn-delete' data-bs-toggle='modal' data-bs-target='#deleteModal' 
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

        <!-- Modal Tambah Data -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">Tambah Berita</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="judul" required>
                            </div>
                            <div class="mb-3">
                                <label for="highlight" class="form-label">Highlight</label>
                                <textarea class="form-control" name="highlight" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="isi" class="form-label">Isi Berita</label>
                                <textarea class="form-control" name="isi" rows="5" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" class="form-control" name="foto" accept=".jpg,.jpeg,.png">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" name="add" class="btn btn-primary">Tambah Berita</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit Data -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Berita</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="editId">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="judul" id="editJudul" required>
                            </div>
                            <div class="mb-3">
                                <label for="highlight" class="form-label">Highlight</label>
                                <textarea class="form-control" name="highlight" id="editHighlight" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="isi" class="form-label">Isi Berita</label>
                                <textarea class="form-control" name="isi" id="editIsi" rows="5" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto Baru</label>
                                <input type="file" class="form-control" name="foto" accept=".jpg,.jpeg,.png">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" name="update" class="btn btn-primary">Update Berita</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Hapus Data -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Hapus Berita</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="deleteId">
                            <p>Apakah Anda yakin ingin menghapus berita ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" name="delete" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Script untuk modal Edit
        const editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const judul = button.getAttribute('data-judul');
            const highlight = button.getAttribute('data-highlight');
            const isi = button.getAttribute('data-isi');

            document.getElementById('editId').value = id;
            document.getElementById('editJudul').value = judul;
            document.getElementById('editHighlight').value = highlight;
            document.getElementById('editIsi').value = isi;
        });

        // Script untuk modal Hapus
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            document.getElementById('deleteId').value = id;
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
