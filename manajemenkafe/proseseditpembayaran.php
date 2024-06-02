<?php
include 'koneksi.php'; // Include the database connection

// Check if the menu_id is set in the GET request
if (isset($_GET['id'])) {
    $id_metode = $_GET['id'];

    // Query to select data based on menu_id
    $query = "SELECT * FROM metodepembayaran WHERE id_metode = $id_metode";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Fetch the data
    $row = mysqli_fetch_assoc($result);

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_metode = $_POST['nama_metode'];
        $kategori_metode = $_POST['kategori_metode'];
        
        // Check if a new logo is uploaded
        if ($_FILES['logo_metode']['name']) {
            $logo_metode = $_FILES['logo_metode']['name'];
            $target_dir = "img/";
            $target_file = $target_dir . basename($logo_metode);

            // Upload the new image
            if (move_uploaded_file($_FILES['logo_metode']['tmp_name'], $target_file)) {
                // Update the logo only if a new file is uploaded
                $query = "UPDATE metodepembayaran SET nama_metode = '$nama_metode', kategori_metode = '$kategori_metode', logo_metode = '$logo_metode' WHERE id_metode = $id_metode";
            } else {
                echo "<script>alert('Error uploading file');</script>";
            }
        } else {
            // If no new logo uploaded, retain the existing logo
            $query = "UPDATE metodepembayaran SET nama_metode = '$nama_metode', kategori_metode = '$kategori_metode' WHERE id_metode = $id_metode";
        }

        // Execute the update query
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data berhasil diupdate'); window.location.href = 'kelolametodepembayaran.php';</script>";
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
