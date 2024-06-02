<?php
include 'koneksi.php'; // Include the database connection

// Check if the id is set in the GET request
if (isset($_GET['id'])) {
    $reservasi_id = $_GET['id'];

    // Query to delete the method from the database
    $query = "DELETE FROM reservations WHERE reservasi_id= $reservasi_id";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Jadwal Reservasi berhasil dihapus'); window.location.href = 'kelolareservasi.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
} else {
    echo "<script>alert('No ID specified.'); window.location.href = 'kelolareservasi.php';</script>";
}
mysqli_close($conn);
?>
