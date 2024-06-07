<?php
include 'koneksi.php'; 


if (isset($_GET['staff_id'])) {
    $staff_id = $_GET['staff_id'];

  
    $query = "SELECT * FROM staff WHERE staff_id = $staff_id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }


    $row = mysqli_fetch_assoc($result);

 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_staf = $_POST['nama_staf'];
        $nomor_telepon = $_POST['nomor_telepon'];
        $posisi = $_POST['posisi'];
        $gaji = $_POST['gaji'];

        // Prepare the update query
        $query = "UPDATE staff SET 
                    nama_staff = '$nama_staf', 
                    nomor_telepon = '$nomor_telepon', 
                    posisi = '$posisi', 
                    gaji = '$gaji' 
                  WHERE staff_id = $staff_id";

        // Execute the update query
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data berhasil diupdate'); window.location.href = 'kelolastaf.php';</script>";
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
