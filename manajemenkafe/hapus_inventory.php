<?php
include 'koneksi.php'; 


if(isset($_GET['id'])) {

    $inventory_id = mysqli_real_escape_string($conn, $_GET['id']);

 
    $query = "DELETE FROM inventory WHERE inventory_id = '$inventory_id'";

    // Execute the query
    if(mysqli_query($conn, $query)) {
     
        header("Location: kelolainventory.php");
        exit();
    } else {

        echo "Error: " . mysqli_error($conn);
    }
} else {
  
    header("Location: kelolainventory.php");
    exit();
}

mysqli_close($conn);
?>
