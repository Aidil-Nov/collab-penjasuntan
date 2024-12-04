<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Pendidikan Jasmani</title>
    <link rel="icon" href="http://localhost/Pendidikan%20Jasmani/assets/Icon.svg" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Top Navigation Styling */
        .top-nav {
            height: 60px;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            z-index: 1100;
            width: calc(100% - 250px);
            border-bottom: 1px solid #ddd;
            position: fixed;
            top: 0;
            left: 250px;
            transition: left 0.3s ease;
        }

        /* Sidebar Styling */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background-color: #ffffff;
            border-right: 1px solid #ddd;
            color: #333;
            padding-top: 20px;
            transition: transform 0.3s ease;
            z-index: 1101;
            overflow-y: auto;
        }

        /* Profile Section */
        .profile {
            text-align: center;
            margin-bottom: 30px;
            padding-left: 10px;
        }

        .profile img {
            width: 220px;
        }

        /* Menu Section */
        .menu a {
            display: block;
            padding: 12px;
            color: #333;
            text-decoration: none;
            font-size: 17px;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .menu a:hover, .menu a.active {
            background-color: #f5f5f5;
            border-left-color: orange;
            color: orange;
        }

        .menu i {
            margin-right: 8px;
        }

        /* Logout Section */
        .logout {
            position: absolute;
            bottom: 20px;
            width: 100%;
        }

        .logout a {
            display: block;
            padding: 12px;
            text-align: center;
            color: #333;
            background-color: #f5f5f5;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .logout a:hover {
            background-color: orange;
            color: #fff;
        }

        /* Main Content Adjustments */
        .content {
            margin-left: 250px;
            padding: 20px;
            margin-top: 60px;
            transition: margin-left 0.3s ease;
        }

        /* Smaller Search Bar Styling */
        .search-bar {
            flex-grow: 0;
            width: 200px; /* Reduced width for search bar */
            margin-right: 20px;
        }

        .search-bar input {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        /* Admin Profile Styling in Top Nav */
        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%; /* Ensures circular shape */
            object-fit: cover;
        }

        /* Hamburger Menu for Mobile */
        .hamburger {
            font-size: 24px;
            color: #333;
            cursor: pointer;
            display: none;
        }

        /* Overlay background */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 1100;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            .top-nav {
                left: 0;
                width: 100%;
                padding: 0 10px; /* Adjust padding for a more compact layout */
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .sidebar {
                transform: translateX(-250px);
                z-index: 1101;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .hamburger {
                display: block;
                margin-right: 10px;
            }

            .search-bar {
                flex-grow: 1; /* Allow search bar to take available space */
                width: auto;
                max-width: 150px; /* Set a max width to prevent overflow */
                margin-right: 10px;
            }

            .content {
                margin-left: 0;
            }

            /* Ensure overlay shows on mobile */
            .overlay {
                display: block;
                z-index: 1100;
            }
        }
    </style>
</head>
<body>

    <!-- Top Navigation Bar -->
    <div class="top-nav">
        <!-- Hamburger Menu for Mobile -->
        <div class="hamburger" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </div>

        <!-- Search Bar -->
        <div class="search-bar">
            <input type="text" placeholder="Cari...">
        </div>

        <!-- Admin Profile -->
        <div class="admin-profile d-flex align-items-center">
            <i class="bi bi-person-circle" style="font-size: 2rem;"></i>
            <span class="ms-2">Admin 1</span>
        </div>
    </div>

    <!-- Overlay -->
    <div id="overlay" class="overlay" onclick="closeSidebar()"></div>

    <!-- Sidebar Section -->
    <div class="sidebar" id="sidebar">
        <!-- Profile Section -->
        <div class="profile">
            <img src="http://localhost/Pendidikan%20Jasmani/assets/Logo.svg" alt="Admin Logo">
        </div>

        <!-- Menu Section -->
        <?php
        // Dapatkan nama file saat ini
        $current_page = basename($_SERVER['PHP_SELF']);
        ?>

        <div class="menu" id="menuLinks">
            <a href="../Admin/dashboard.php" id="menu-dashboard" class="<?= $current_page == 'dashboard.php' ? 'active' : '' ?>">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="../Admin/berita.php" id="menu-berita" class="<?= $current_page == 'berita.php' ? 'active' : '' ?>">
                <i class="fas fa-newspaper"></i> Berita
            </a>
            <a href="../Admin/dosen.php" id="menu-dosen" class="<?= $current_page == 'dosen.php' ? 'active' : '' ?>">
                <i class="fas fa-chalkboard-teacher"></i> Dosen
            </a>
            <a href="../Admin/organisasi.php" id="menu-organisasi" class="<?= $current_page == 'organisasi.php' ? 'active' : '' ?>">
                <i class="fas fa-users"></i> Organisasi
            </a>
            <a href="../Admin/galeri.php" id="menu-galeri" class="<?= $current_page == 'galeri.php' ? 'active' : '' ?>">
                <i class="fas fa-image"></i> Galeri
            </a>
            <a href="../Admin/pkm.php" id="menu-pkm" class="<?= $current_page == 'pkm.php' ? 'active' : '' ?>">
                <i class="fas fa-book"></i> PKM
            </a>
        </div>

        <!-- Logout Section -->
        <div class="logout">
            <a href="../Include/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div> 

    <!-- Main Content Section -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('show');
            overlay.style.display = sidebar.classList.contains('show') ? 'block' : 'none';
        }

        function closeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.remove('show');
            overlay.style.display = 'none';
        }

        // Toggle dropdown menu visibility
        function toggleDropdown(event) {
            event.preventDefault();
            const dropdownMenu = event.target.nextElementSibling;
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        }

        // Close dropdown if clicking outside
        document.addEventListener('click', function(event) {
            const isClickInside = event.target.closest('.dropdown');
            if (!isClickInside) {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.style.display = 'none';
                });
            }
        });
    </script>

</body>
</html>