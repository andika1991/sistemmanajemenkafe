<?php
include 'koneksi.php'; 


if (isset($_GET['id'])) {
    $supplier_id = $_GET['id'];

  
    $query = "DELETE FROM suppliers WHERE supplier_id= $supplier_id";

    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data Suplier berhasil dihapus'); window.location.href = 'kelolasuplier.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
} else {
    echo "<script>alert('No ID specified.'); window.location.href = 'kelolasuplier.php';</script>";
}
mysqli_close($conn);
?>
