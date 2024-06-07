<?php
include 'koneksi.php'; 


if (isset($_GET['id'])) {
    $customer_id = $_GET['id'];


    $query = "DELETE FROM customers WHERE customer_id = $customer_id";

  
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Metode pembayaran berhasil dihapus'); window.location.href = 'kelolapelanggan.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
} else {
    echo "<script>alert('No ID specified.'); window.location.href = 'kelolapelanggan.php';</script>";
}
mysqli_close($conn);
?>
