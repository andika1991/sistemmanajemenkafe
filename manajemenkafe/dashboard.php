<?php
include 'session.php';
if (!isset($_SESSION['id'])) {
    echo "<script>window.location.href = 'index.html';</script>";
    exit();
}


$querytotalpendapatanbulanan = "SELECT SUM(total_harga) AS total_pendapatan_bulanan
          FROM orders
          WHERE status_pesanan = 'Sukses' 
          AND MONTH(tanggal_pesanan) = MONTH(CURRENT_DATE())
          AND YEAR(tanggal_pesanan) = YEAR(CURRENT_DATE())";

// Execute the query
$result = mysqli_query($conn, $querytotalpendapatanbulanan);
$row = mysqli_fetch_assoc($result);
$total_pendapatan_bulanan = $row['total_pendapatan_bulanan'];



$query_menu = "SELECT COUNT(*) AS total_menu FROM menu";
$result_menu = mysqli_query($conn, $query_menu);
$row_menu = mysqli_fetch_assoc($result_menu);
$total_menu = $row_menu['total_menu'];

$query_pelanggan = "SELECT COUNT(*) AS total_pelanggan FROM customers";
$result_pelanggan = mysqli_query($conn, $query_pelanggan);
$row_pelanggan = mysqli_fetch_assoc($result_pelanggan);
$total_pelanggan = $row_pelanggan['total_pelanggan'];


$query_karyawan = "SELECT COUNT(*) AS total_karyawan FROM staff";
$result_karyawan = mysqli_query($conn, $query_karyawan);
$row_karyawan = mysqli_fetch_assoc($result_karyawan);
$total_karyawan = $row_karyawan['total_karyawan'];


$query_sales = "
    SELECT 
        DATE_FORMAT(tanggal_pesanan, '%Y-%m') AS bulan,
        SUM(total_harga) AS total_penjualan 
    FROM orders 
    WHERE status_pesanan = 'Sukses'
    GROUP BY bulan
    ORDER BY bulan
";

$result_sales = mysqli_query($conn, $query_sales);

$monthlySales = [];
if ($result_sales) {
    while ($row = mysqli_fetch_assoc($result_sales)) {
        $monthlySales[$row['bulan']] = $row['total_penjualan'];
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);

// Initialize sales data for each month
$months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
$salesData = array_fill(0, 12, 0);

foreach ($monthlySales as $bulan => $total_penjualan) {
    $monthIndex = (int)substr($bulan, 5, 2) - 1;
    $salesData[$monthIndex] = $total_penjualan;
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
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
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar" style="animation: slideIn 0.5s forwards;">
        <span class="hamburger" id="sidebarToggle">&#9776;</span>
        <img src="img/khazanah.png" style="width:200px;height:140px; position:absolute; margin-top:-95px; margin-left:30px;">
        <p style="color:white ;position:relative;font-weight:bold; margin-left:40px; ">Manajemen Kafe</p>
        <ul>
            <li class="active">
                <a href="#">
                    <i class="bi bi-house-door icon" style="color: green;"></i>Dashboard
                </a>
            </li>
            <li>
                <a href="kelolapesanan.php">
                    <i class="bi bi-clipboard-check icon" style="color: green;"></i>Kelola Pesanan
                </a>
            </li>
            <li>
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
                                <li><a class="dropdown-item" href="index.html">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container mt-4">
            <h1>Selamat Datang di Sistem Manajemen Serambi Kafe</h1>
            <p>Manajemen Data Serambi Cafe.</p>

            <!-- Cards Section -->
            <div class="row">
                <div class="col-md-3">
                    <div class="card text-white bg-primary mb-3 card-custom">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-cash-stack"></i> Total Pendapatan(Monthly)</h5>
                            <p class="card-text"><?php echo 'Rp.' . number_format($total_pendapatan_bulanan, 0, ',', '.'); ?></p>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-success mb-3 card-custom">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-card-list"></i> Total Menu</h5>
                            <p class="card-text"><?php echo $total_menu ; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-warning mb-3 card-custom">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-people-fill"></i> Total Pelanggan</h5>
                            <p class="card-text"><?php echo $total_pelanggan ; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-danger mb-3 card-custom">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-person-badge-fill"></i> Karyawan Aktif</h5>
                            <p class="card-text"><?php echo $total_karyawan ; ?></p>
                        </div>
                    </div>
                </div>
            </div>
    <!-- Sales Chart Section -->
    
    <!-- End of Sales Chart Section -->
</div>
<div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight:bold;text-align:center;">Grafik Penjualan Bulanan</h5>
                    <canvas id="monthlySalesChart" width="400" height="200" style="margin-top:0px; margin-left:270px;width:400px; height:200px;"></canvas>
                </div>
            </div>
        </div>
    </div>

      
    <footer class="text-center mt-4">
            <p>&copy; 2024 Serambi Cafe. All rights reserved.</p>
        </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            var sidebar = document.getElementById('sidebar');
            var content = document.getElementById('content');
            sidebar.classList.toggle('sidebar-collapsed');
            content.classList.toggle('content-collapsed');
        });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('monthlySalesChart').getContext('2d');
        var monthlySalesData = {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            datasets: [{
                label: 'Grafik Total Penjualan Bulanan',
                data: <?php echo json_encode(array_values($salesData)); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        var monthlySalesChart = new Chart(ctx, {
            type: 'bar',
            data: monthlySalesData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + context.raw.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    });
</script>

</body>

</html>
