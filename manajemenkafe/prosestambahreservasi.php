<?php
include 'koneksi.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $jadwal_reservasi = $_POST['jadwal_reservasi'];
    $jumlah_orang = $_POST['jumlah_orang'];
    $catatan = $_POST['catatan'];
    $nama_pelanggan = $_POST['nama_pelanggan'];

    // Query untuk mendapatkan customer_id berdasarkan nama_pelanggan
    $query_pelanggan = "SELECT customer_id FROM customers WHERE nama_pelanggan = '$nama_pelanggan'";
    $result_pelanggan = mysqli_query($conn, $query_pelanggan);

    if ($result_pelanggan && mysqli_num_rows($result_pelanggan) > 0) {
        $row_pelanggan = mysqli_fetch_assoc($result_pelanggan);
        $customer_id = $row_pelanggan['customer_id'];

        // Query untuk menambahkan reservasi baru
        $query = "INSERT INTO reservations (tanggal_reservasi, jumlah_orang, catatan, customer_id) 
                  VALUES ('$jadwal_reservasi', $jumlah_orang, '$catatan', $customer_id)";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Reservasi berhasil ditambahkan'); window.location.href = 'kelolareservasi.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Error: Tidak dapat menemukan pelanggan');</script>";
    }
} else {
    echo "<script>alert('Invalid request'); window.location.href = 'tambahreservasi.php';</script>";
}

mysqli_close($conn);
?>
