<?php
include 'koneksi.php';


// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_menu = $_POST['nama_menu'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $foto_produk = $_FILES['foto_produk']['name'];
    $target_dir = "img/";
    $target_file = $target_dir . basename($foto_produk);

    // Upload the image
    if (move_uploaded_file($_FILES['foto_produk']['tmp_name'], $target_file)) {
        // Prepare the insert query
        $query = "INSERT INTO menu (nama_menu, foto_produk, harga, deskripsi) VALUES ('$nama_menu', '$foto_produk', '$harga', '$deskripsi')";

        // Execute the query
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data berhasil ditambahkan'); window.location.href = 'kelolamenu.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Error uploading file');</script>";
    }
}
?>