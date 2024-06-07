<?php
include 'koneksi.php'; 


if (isset($_GET['id'])) {
    $staff_id = $_GET['id'];

  
    $query = "DELETE FROM staff WHERE staff_id= $staff_id";

    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data Karyawan berhasil dihapus'); window.location.href = 'kelolastaf.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
} else {
    echo "<script>alert('No ID specified.'); window.location.href = 'kelolastaf.php';</script>";
}
mysqli_close($conn);
?>
