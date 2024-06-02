<?php
include 'koneksi.php'; 


if(isset($_GET['id'])) {

    $menu_id = mysqli_real_escape_string($conn, $_GET['id']);

 
    $query = "DELETE FROM menu WHERE menu_id = '$menu_id'";

    // Execute the query
    if(mysqli_query($conn, $query)) {
     
        header("Location: kelolamenu.php");
        exit();
    } else {

        echo "Error: " . mysqli_error($conn);
    }
} else {
  
    header("Location: kelolamenu.php");
    exit();
}

mysqli_close($conn);
?>
