<?php

include 'koneksi.php'; 

// Check if the inventory_id is set in the GET request
if (isset($_GET['inventory_id'])) {
    $inventory_id = $_GET['inventory_id'];

    // Query to select data based on inventory_id
    $query = "SELECT * FROM inventory WHERE inventory_id = $inventory_id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Fetch the data
    $row = mysqli_fetch_assoc($result);

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_barang = $_POST['nama_barang'];
        $jumlah_barang = $_POST['jumlah_barang'];
        $kondisi = $_POST['kondisi'];
        $foto_barang = $row['foto_barang']; // Default to existing photo

        // Check if a new photo is uploaded
        if ($_FILES['foto_barang']['name']) {
            $foto_barang = $_FILES['foto_barang']['name'];
            $target_dir = "img/";
            $target_file = $target_dir . basename($foto_barang);

            // Upload the new image
            if (!move_uploaded_file($_FILES['foto_barang']['tmp_name'], $target_file)) {
                echo "<script>alert('Error uploading file');</script>";
            }
        }

        // Prepare the update query
        $query = "UPDATE inventory SET 
                    nama_barang = '$nama_barang', 
                    jumlah = '$jumlah_barang', 
                    kondisi = '$kondisi', 
                    foto_barang = '$foto_barang' 
                  WHERE inventory_id = $inventory_id";

        // Execute the update query
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data berhasil diupdate'); window.location.href = 'kelolainventory.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }
} else {
    echo "<script>alert('No inventory ID specified.'); window.location.href = 'kelolainventory.php';</script>";
    exit();
}
mysqli_close($conn);
?>
