<?php
include 'koneksi.php';


// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_barang = $_POST['nama_barang'];
    $jumlah_barang = $_POST['jumlah_barang'];
    $kondisi = $_POST['kondisi'];
    $foto_barang = $_FILES['foto_barang']['name'];
    $target_dir = "img/";
    $target_file = $target_dir . basename($foto_barang);

    // Upload the image
    if (move_uploaded_file($_FILES['foto_barang']['tmp_name'], $target_file)) {
        // Prepare the insert query
        $query = "INSERT INTO inventory (nama_barang, jumlah, kondisi, foto_barang) VALUES ('$nama_barang', '$jumlah_barang', '$kondisi', '$foto_barang')";

        // Execute the query
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data berhasil ditambahkan'); window.location.href = 'kelolainventory.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Error uploading file');</script>";
    }
}
?>