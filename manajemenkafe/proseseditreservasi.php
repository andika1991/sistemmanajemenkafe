<?php
include 'koneksi.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reservasi_id = $_GET['id'];
    $jadwal_reservasi = $_POST['jadwal_reservasi'];
    $jumlah_orang = $_POST['jumlah_orang'];
    $catatan = $_POST['catatan'];
    $nama_pelanggan = $_POST['nama_pelanggan'];


    $query_pelanggan = "SELECT customer_id FROM customers WHERE nama_pelanggan = '$nama_pelanggan'";
    $result_pelanggan = mysqli_query($conn, $query_pelanggan);

    if ($result_pelanggan && mysqli_num_rows($result_pelanggan) > 0) {
        $row_pelanggan = mysqli_fetch_assoc($result_pelanggan);
        $customer_id = $row_pelanggan['customer_id'];


        $query = "UPDATE reservations SET tanggal_reservasi = '$jadwal_reservasi', jumlah_orang = $jumlah_orang, catatan = '$catatan', customer_id = $customer_id WHERE reservasi_id = $reservasi_id";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Reservasi berhasil diupdate'); window.location.href = 'kelolareservasi.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Error: Tidak dapat menemukan pelanggan');</script>";
    }
} else {
    echo "<script>alert('Invalid request'); window.location.href = 'editreservasi.php';</script>";
}

mysqli_close($conn);
?>
