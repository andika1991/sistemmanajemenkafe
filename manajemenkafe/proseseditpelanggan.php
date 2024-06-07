<?php
include 'koneksi.php'; 


if (isset($_GET['id'])) {
    $customer_id = $_GET['id'];

  
    $query = "SELECT * FROM customers WHERE customer_id = $customer_id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }


    $row = mysqli_fetch_assoc($result);

 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = $_POST['nama'];
        $nomor_telepon = $_POST['nomor_telepon'];
        $email = $_POST['email'];
        $alamat = $_POST['alamat'];

        // Prepare the update query
        $query = "UPDATE customers SET 
                    nama_pelanggan = '$nama', 
                    nomor_telepon = '$nomor_telepon', 
                    alamat = '$alamat', 
                    email = '$email' 
                  WHERE customer_id = $customer_id";

        // Execute the update query
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data berhasil diupdate'); window.location.href = 'kelolapelanggan.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }
} else {
    echo "<script>alert('No staff ID specified.'); window.location.href = 'kelolastaf.php';</script>";
    exit();
}
mysqli_close($conn);
?>
