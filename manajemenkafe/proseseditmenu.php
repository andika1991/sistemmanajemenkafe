<?php

include 'koneksi.php'; // Include the database connection

// Check if the menu_id is set in the GET request
if (isset($_GET['menu_id'])) {
    $menu_id = $_GET['menu_id'];

    // Query to select data based on menu_id
    $query = "SELECT * FROM menu WHERE menu_id = $menu_id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Fetch the data
    $row = mysqli_fetch_assoc($result);

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_menu = $_POST['nama_menu'];
        $harga = $_POST['harga'];
        $deskripsi = $_POST['deskripsi'];
        $foto_produk = $row['foto_produk']; // Default to existing photo

        // Check if a new photo is uploaded
        if ($_FILES['foto_produk']['name']) {
            $foto_produk = $_FILES['foto_produk']['name'];
            $target_dir = "img/";
            $target_file = $target_dir . basename($foto_produk);

            // Upload the new image
            if (!move_uploaded_file($_FILES['foto_produk']['tmp_name'], $target_file)) {
                echo "<script>alert('Error uploading file');</script>";
            }
        }

        // Prepare the update query
        $query = "UPDATE menu SET 
                    nama_menu = '$nama_menu', 
                    foto_produk = '$foto_produk', 
                    harga = '$harga', 
                    deskripsi = '$deskripsi' 
                  WHERE menu_id = $menu_id";

        // Execute the update query
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data berhasil diupdate'); window.location.href = 'kelolamenu.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }
} else {
    echo "<script>alert('No menu ID specified.'); window.location.href = 'kelolamenu.php';</script>";
    exit();
}
mysqli_close($conn);
?>
