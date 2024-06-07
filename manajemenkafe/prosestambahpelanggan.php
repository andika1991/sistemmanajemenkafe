<?php
include 'koneksi.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $alamat = $_POST['alamat']; 
    $email = $_POST['email']; 




        $query = "INSERT INTO customers (nama_pelanggan, nomor_telepon, alamat, email) VALUES ('$nama', '$nomor_telepon', '$alamat', '$email')";

      
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data berhasil ditambahkan'); window.location.href = 'kelolapelanggan.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Error uploading file');</script>";
    }

?>