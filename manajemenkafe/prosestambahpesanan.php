<?php
include 'koneksi.php'; // Include the database connection

// Tangkap data dari form
$tanggal_pesanan = $_POST['tanggal_pesanan'];
$total_harga = $_POST['total_harga'];
$status_pesanan = $_POST['status_pesanan'];
$rincian_menu_dibeli = $_POST['rincian_menu_dibeli'];
$nama_pelanggan = $_POST['nama_pelanggan'];
$metode_pembayaran = $_POST['metode_pembayaran'];

// Query untuk mendapatkan customer_id berdasarkan nama_pelanggan
$query_customer = "SELECT customer_id FROM customers WHERE nama_pelanggan = '$nama_pelanggan'";
$result_customer = mysqli_query($conn, $query_customer);
if ($row_customer = mysqli_fetch_assoc($result_customer)) {
    $customer_id = $row_customer['customer_id'];
} else {
    echo "<script>alert('Error: Tidak dapat menemukan pelanggan dengan nama tersebut'); window.location.href = 'kelolapesanan.php';</script>";
    exit();
}

// Query untuk mendapatkan payment_id berdasarkan nama_metode
$query_payment = "SELECT id_metode FROM metodepembayaran WHERE nama_metode = '$metode_pembayaran'";
$result_payment = mysqli_query($conn, $query_payment);
if ($row_payment = mysqli_fetch_assoc($result_payment)) {
    $payment_id = $row_payment['id_metode'];
} else {
    echo "<script>alert('Error: Tidak dapat menemukan metode pembayaran dengan nama tersebut'); window.location.href = 'kelolapesanan.php';</script>";
    exit();
}

// Query untuk menambahkan transaksi pesanan baru ke dalam database
$query = "INSERT INTO orders (tanggal_pesanan, total_harga, status_pesanan, menudibeli, customer_id, id_metode) 
          VALUES ('$tanggal_pesanan', '$total_harga', '$status_pesanan', '$rincian_menu_dibeli', '$customer_id', '$payment_id')";

// Eksekusi query
if (mysqli_query($conn, $query)) {
    // Jika berhasil, arahkan kembali ke halaman utama dengan pesan sukses
    echo "<script>alert('Transaksi pesanan berhasil ditambahkan'); window.location.href = 'kelolapesanan.php';</script>";
} else {
    // Jika gagal, tampilkan pesan error
    echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
}

// Tutup koneksi ke database
mysqli_close($conn);
?>
