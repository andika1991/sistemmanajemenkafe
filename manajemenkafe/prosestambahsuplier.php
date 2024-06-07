<?php
include 'koneksi.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_supplier = $_POST['nama_supplier'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $alamat = $_POST['alamat']; 
   




        $query = "INSERT INTO suppliers (nama_supplier, nomor_telepon, alamat) VALUES ('$nama_supplier', '$nomor_telepon', '$alamat')";

      
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data berhasil ditambahkan'); window.location.href = 'kelolasuplier.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Error uploading file');</script>";
    }

?>