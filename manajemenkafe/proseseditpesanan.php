<?php
include 'koneksi.php'; // Include the database connection

// Check if the order ID is set in the GET request
if (isset($_GET['id'])) {
    $id_pesanan = $_GET['id'];

    // Query to select data based on id_pesanan
    $query = "SELECT * FROM orders WHERE order_id = $id_pesanan";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Fetch the data
    $row = mysqli_fetch_assoc($result);

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $tanggal_pesanan = $_POST['tanggal_pesanan'];
        $total_harga = $_POST['total_harga'];
        $status_pesanan = $_POST['status_pesanan'];
        $rincian_menu_dibeli = $_POST['rincian_menu_dibeli'];
        $nama_pelanggan = $_POST['nama_pelanggan'];
        $metode_pembayaran = $_POST['metode_pembayaran'];

        // Prepare the update query
        $query = "
            UPDATE orders SET 
                tanggal_pesanan = '$tanggal_pesanan', 
                total_harga = '$total_harga', 
                status_pesanan = '$status_pesanan', 
              menudibeli = '$rincian_menu_dibeli',
               orderby = (SELECT nama_pelanggan FROM customers WHERE nama_pelanggan = '$nama_pelanggan'),
                metodepembayaran = (SELECT nama_metode FROM metodepembayaran WHERE nama_metode = '$metode_pembayaran')
            WHERE order_id = $id_pesanan
        ";

        // Execute the update query
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data berhasil diupdate'); window.location.href = 'kelolapesanan.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }
} else {
    echo "<script>alert('No order ID specified.'); window.location.href = 'kelolapesanan.php';</script>";
    exit();
}
mysqli_close($conn);
?>
