<?php
include 'koneksi.php'; // Include the database connection

// Check if the id is set in the GET request
if (isset($_GET['id'])) {
    $id_metode = $_GET['id'];

    // Query to delete the method from the database
    $query = "DELETE FROM metodepembayaran WHERE id_metode = $id_metode";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Metode pembayaran berhasil dihapus'); window.location.href = 'kelolametodepembayaran.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
} else {
    echo "<script>alert('No ID specified.'); window.location.href = 'kelolametodepembayaran.php';</script>";
}
mysqli_close($conn);
?>
