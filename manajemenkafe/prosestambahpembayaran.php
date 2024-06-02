<?php
// Include file koneksi.php untuk menghubungkan ke database
include 'koneksi.php';

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai yang dikirimkan dari form
    $nama_metode = $_POST['nama_metode'];
    $kategori_metode = $_POST['kategori_metode'];


    // Proses upload logo metode pembayaran
    $logo_metode = $_FILES['logo_metode']['name'];
    $target_dir = "img/";
    $target_file = $target_dir . basename($logo_metode);
    // Pindahkan file yang diupload ke lokasi yang ditentukan
    if (!move_uploaded_file($_FILES['logo_metode']['tmp_name'], $target_file)) {
        echo "<script>alert('Error uploading file');</script>";
    }

    // Siapkan query untuk menyimpan data ke database
    $query = "INSERT INTO metodepembayaran (nama_metode, kategori_metode, logo_metode) 
              VALUES ('$nama_metode', '$kategori_metode', '$logo_metode')";

    // Jalankan query untuk menyimpan data
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Metode pembayaran berhasil ditambahkan'); window.location.href = 'kelolametodepembayaran.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

// Tutup koneksi ke database
mysqli_close($conn);
?>
