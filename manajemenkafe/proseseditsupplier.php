<?php
include 'koneksi.php'; 


if (isset($_GET['id'])) {
    $supplier_id = $_GET['id'];

  
    $query = "SELECT * FROM suppliers WHERE supplier_id = $supplier_id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }


    $row = mysqli_fetch_assoc($result);

 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_staf = $_POST['nama_supplier'];
        $nomor_telepon = $_POST['nomor_telepon'];
        $alamat = $_POST['alamat'];


        // Prepare the update query
        $query = "UPDATE suppliers SET 
                    nama_supplier = '$nama_staf', 
                    nomor_telepon = '$nomor_telepon', 
                    alamat = '$alamat' 
                  WHERE supplier_id = $supplier_id";

        // Execute the update query
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data berhasil diupdate'); window.location.href = 'kelolasuplier.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }
} else {
    echo "<script>alert('No staff ID specified.'); window.location.href = 'kelolasuplier.php';</script>";
    exit();
}
mysqli_close($conn);
?>
