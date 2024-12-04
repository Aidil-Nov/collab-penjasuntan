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
// Sertakan sidebar dan koneksi database
include '../include/sidebar.php'; 
include '../Data/db_connect.php'; 

// Ambil bulan dan tahun dari parameter GET (jika ada)
$bulan = isset($_GET['bulan']) ? intval($_GET['bulan']) : date('m');
$tahun = isset($_GET['tahun']) ? intval($_GET['tahun']) : date('Y');

// Query untuk mengambil data pembaca berita berdasarkan bulan dan tahun yang dipilih
$sql = "
    SELECT 
        MONTH(tanggal_pembacaan) AS bulan, 
        YEAR(tanggal_pembacaan) AS tahun, 
        COUNT(*) AS total_view,
        berita_id
    FROM pembaca_berita
    WHERE MONTH(tanggal_pembacaan) = ? AND YEAR(tanggal_pembacaan) = ?
    GROUP BY YEAR(tanggal_pembacaan), MONTH(tanggal_pembacaan), berita_id
    ORDER BY tahun DESC, bulan DESC
";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die('Error in preparing statement: ' . $conn->error);
}

$stmt->bind_param("ii", $bulan, $tahun);  // Bind parameter bulan dan tahun
$stmt->execute();
$result = $stmt->get_result();
$data_pembaca = [];

// Mengecek apakah data ada dan memasukkannya ke dalam array
while ($row = $result->fetch_assoc()) {
    $data_pembaca[] = [
        'bulan' => $row['bulan'],
        'tahun' => $row['tahun'],
        'total_view' => $row['total_view'],
        'berita_id' => $row['berita_id']
    ];
}

// Menutup koneksi
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="http://localhost/Pendidikan%20Jasmani/assets/Icon.svg" type="image/svg+xml">
    <title>Admin Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        .content {
            margin-left: 250px;
            padding: 20px;
            margin-top: 60px;
        }

        @media (max-width: 768px) {
            .content {
                margin-left: 0;
                padding: 10px;
            }
        }
        
        .welcome-container {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            text-align: center;
        }

        .welcome-container h1 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .welcome-container p {
            font-size: 1.2rem;
            color: #6c757d;
        }

        .card-cta {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card-cta .card {
            width: 18rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-cta .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .table-container {
            margin-top: 30px;
        }

        .table-container .table-responsive {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .chart-container {
            margin-top: 30px;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .card .bi {
            font-size: 3rem;
        }

        .card-title {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="content">
        <!-- Welcome Section -->
        <div class="welcome-container">
            <h1>Selamat Datang di Dashboard Admin</h1>
            <p>Ini adalah halaman utama untuk mengelola berbagai fitur di sistem Anda.</p>
        </div>

        <!-- CTA Cards -->
        <div class="card-cta">
            <a href="berita.php" class="text-decoration-none">
                <div class="card bg-primary text-white text-center">
                    <div class="card-body">
                        <i class="bi bi-newspaper h1"></i>
                        <h5 class="card-title mt-3">Kelola Berita</h5>
                        <p class="card-text">Tambah atau edit berita.</p>
                    </div>
                </div>
            </a>

            <a href="matkul.php" class="text-decoration-none">
                <div class="card bg-success text-white text-center">
                    <div class="card-body">
                        <i class="bi bi-book h1"></i>
                        <h5 class="card-title mt-3">Kelola Mata Kuliah</h5>
                        <p class="card-text">Atur data mata kuliah.</p>
                    </div>
                </div>
            </a>

            <a href="galeri.php" class="text-decoration-none">
                <div class="card bg-info text-white text-center">
                    <div class="card-body">
                        <i class="bi bi-images h1"></i>
                        <h5 class="card-title mt-3">Kelola Galeri</h5>
                        <p class="card-text">Tambah atau hapus foto galeri.</p>
                    </div>
                </div>
            </a>

            <a href="admin.php" class="text-decoration-none">
                <div class="card bg-warning text-white text-center">
                    <div class="card-body">
                        <i class="bi bi-person-circle h1"></i>
                        <h5 class="card-title mt-3">Kelola Admin</h5>
                        <p class="card-text">Atur pengguna admin.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Tabel Berita -->
        <div class="table-container">
            <h5>Berita Terbaru</h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Judul</th>
                            <th>Highlight Berita</th>
                            <th>Jumlah View</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    // Query untuk mengambil 5 berita terbaru
                    $sql = "SELECT id, foto, judul, highlight, view_count FROM berita ORDER BY tanggal_upload DESC LIMIT 5";
                    $result = $conn->query($sql);

                    // Menampilkan data dari database
                    if ($result->num_rows > 0) {
                        $no = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td><img src='" . htmlspecialchars($row['foto']) . "' alt='Foto' style='width: 100px; height: auto;'></td>";
                            echo "<td>" . $row['judul'] . "</td>";
                            echo "<td>" . $row['highlight'] . "</td>";
                            echo "<td>" . $row['view_count'] . "</td>";
                            echo "<td>
                                    <button class='btn btn-primary btn-edit mb-2' data-bs-toggle='modal' data-bs-target='#editModal' 
                                        data-id='{$row['id']}' data-judul='{$row['judul']}' >Edit</button>
                                    <button class='btn btn-danger btn-delete' data-bs-toggle='modal' data-bs-target='#deleteModal' 
                                        data-id='{$row['id']}'>Hapus</button>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>Tidak ada data berita</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <a href="berita.php" class="btn btn-primary mt-3 mb-3">Lihat Lainnya</a>
        </div>

        <!-- Diagram Garis -->
        <form method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <select name="bulan" class="form-select">
                        <option value="01" <?php echo ($bulan == '01') ? 'selected' : ''; ?>>Januari</option>
                        <!-- (Other months remain unchanged) -->
                    </select>
                </div>
                <div class="col-md-4">
                    <select name="tahun" class="form-select">
                        <option value="2024" <?php echo ($tahun == '2024') ? 'selected' : ''; ?>>2024</option>
                        <!-- (Other years remain unchanged) -->
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Tampilkan Grafik</button>
                </div>
            </div>
        </form>

        <div class="chart-container">
            <h5>Statistik Pembaca Berita</h5>
            <canvas id="newsChart"></canvas>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('newsChart').getContext('2d');
        const pembacaData = <?php echo json_encode($data_pembaca); ?>;

        const labels = pembacaData.map(item => `Bulan ${item.bulan} ${item.tahun}`);
        const data = pembacaData.map(item => item.total_view);

        const newsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pembaca Berita',
                    data: data,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
