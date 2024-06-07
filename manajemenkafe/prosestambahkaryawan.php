<?php
include 'koneksi.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $posisi = $_POST['posisi']; 
    $gaji = $_POST['gaji']; 




        $query = "INSERT INTO staff (nama_staff, nomor_telepon, posisi, gaji) VALUES ('$nama', '$nomor_telepon', '$posisi', '$gaji')";

      
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data berhasil ditambahkan'); window.location.href = 'kelolastaf.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Error uploading file');</script>";
    }

?>