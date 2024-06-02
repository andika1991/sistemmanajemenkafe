<?php
include 'session.php';
if (!isset($_SESSION['id'])) {
    echo "<script>window.location.href = 'login.html';</script>";
    exit();
}

if (isset($_GET['id'])) {
    $reservasi_id = $_GET['id'];
$query = "SELECT reservations.*, customers.nama_pelanggan FROM reservations JOIN customers ON reservations.customer_id = customers.customer_id WHERE reservations.reservasi_id = $reservasi_id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Fetch the data
    $row = mysqli_fetch_assoc($result);
} else {
    echo "<script>alert('No menu ID specified.'); window.location.href = 'kelolamenu.php';</script>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            color: #212529;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #343a40;
            color: white;
            padding-top: 50px;
            transition: all 0.3s ease;
            z-index: 1;
            overflow-x: hidden;
        }

        .sidebar-collapsed {
            width: 60px;
        }

        .sidebar ul {
            list-style-type: none;
            padding-left: 0;
        }

        .sidebar li {
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
            border-bottom: 1px solid #495057;
        }

        .sidebar li:last-child {
            border-bottom: none;
        }

        .sidebar li:hover {
            background-color: #007bff;
        }

        .sidebar li.active {
            background-color: #007bff;
        }

        .sidebar li a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .sidebar .icon {
            margin-right: 10px;
        }

        .sidebar .submenu {
            display: none;
            padding-left: 30px;
        }

        .sidebar .submenu.active {
            display: block;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .content-collapsed {
            margin-left: 60px;
        }

        .navbar-brand {
            color: white;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-100%);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .hamburger {
            font-size: 24px;
            cursor: pointer;
            color: white;
            margin-left: auto;
            position: absolute;
            left: 10px;
            top: 10px;
            z-index: 2;
        }

        .table img {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar" style="animation: slideIn 0.5s forwards;">
        <span class="hamburger" id="sidebarToggle">&#9776;</span>
        <img src="img/khazanah.png" style="width:200px;height:140px; position:absolute; margin-top:-95px; margin-left:30px;">
        <p style="color:white ;position:relative;font-weight:bold; margin-left:40px; ">Manajemen Kafe</p>
        <ul>
            <li>
                <a href="dashboard.php">
                    <i class="bi bi-house-door icon" style="color: green;"></i>Dashboard
                </a>
            </li>
            <li class="active">
                <a href="kelolapesanan.php">
                    <i class="bi bi-clipboard-check icon" style="color: green;"></i>Kelola Pesanan
                </a>
            </li>
            <li >
                <a href="kelolamenu.php">
                    <i class="bi bi-cup-hot-fill icon" style="color: green;"></i>Kelola Menu
                </a>
            </li>
            <li>
                <a href="kelolareservasi.php">
                    <i class="bi bi-calendar2-check icon" style="color: green;"></i>Kelola Reservasi
                </a>
            </li>
            <li>
                <a href="kelolainventory.php">
                    <i class="bi bi-box icon" style="color: green;"></i>Kelola Inventory
                </a>
            </li>
            <li>
                <a href="kelolametodepembayaran.php">
                    <i class="bi bi-credit-card icon" style="color: green;"></i>Metode Pembayaran
                </a>
            </li>
            <li>
                <a href="kelolastaf.php">
                    <i class="bi bi-people icon" style="color: green;"></i>Kelola Staf
                </a>
            </li>
            <li>
                <a href="kelolasuplier.php">
                    <i class="bi bi-truck icon" style="color: green;"></i>Kelola Supplier
                </a>
            </li>
            <li>
                <a href="kelolapelanggan.php">
                    <i class="bi bi-person icon" style="color: green;"></i>Kelola Pelanggan
                </a>
            </li>
        </ul>
    </div>

    <!-- Content -->
    <div class="content" id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Admin Dashboard</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-fill icon" style="color: green;"></i>
                                <?php echo $_SESSION['first_name']; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="login.html">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main>
        <form action="proseseditreservasi.php?id=<?php echo $reservasi_id; ?>" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="jadwal_reservasi" class="form-label">Jadwal Reservasi</label>
        <input type="date" class="form-control" id="jadwal_reservasi" name="jadwal_reservasi" value="<?php echo $row['tanggal_reservasi']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="jumlah_orang" class="form-label">Jumlah Orang</label>
        <input type="number" class="form-control" id="jumlah_orang" name="jumlah_orang" value="<?php echo $row['jumlah_orang']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="catatan" class="form-label">Catatan</label>
        <textarea class="form-control" id="catatan" name="catatan" rows="3" required><?php echo $row['catatan']; ?></textarea>
    </div>
    <div class="mb-3">
        <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
        <select class="form-select" id="nama_pelanggan" name="nama_pelanggan" required>
            <option value="">Pilih Nama Pelanggan</option>
            <!-- Isi dengan data dari database customers -->
            <?php
            // Query untuk mengambil nama pelanggan dari database
            $query_pelanggan = "SELECT nama_pelanggan FROM customers";
            $result_pelanggan = mysqli_query($conn, $query_pelanggan);

            // Periksa jika query berhasil dieksekusi
            if ($result_pelanggan) {
                // Loop untuk menampilkan opsi nama pelanggan
                while ($row_pelanggan = mysqli_fetch_assoc($result_pelanggan)) {
                    $selected = ($row_pelanggan['nama_pelanggan'] == $row['nama_pelanggan']) ? 'selected' : '';
                    echo "<option value='" . $row_pelanggan['nama_pelanggan'] . "' $selected>" . $row_pelanggan['nama_pelanggan'] . "</option>";
                }
            } else {
                echo "<option value=''>Error: Tidak dapat mengambil data pelanggan</option>";
            }
            ?>
        </select>
    </div>
    <input type="submit" class="btn btn-primary" value="Simpan Perubahan"></input>
</form>
</main>

        <footer class="text-center mt-4">
            <p>&copy; 2024 Serambi Cafe. All rights reserved.</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            var sidebar = document.getElementById('sidebar');
            var content = document.getElementById('content');
            sidebar.classList.toggle('sidebar-collapsed');
            content.classList.toggle('content-collapsed');
        });
    </script>

</body>

</html>

<?php
mysqli_close($conn);
?>
