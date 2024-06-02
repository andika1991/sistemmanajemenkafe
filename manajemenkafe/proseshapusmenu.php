<?php

include 'koneksi.php'; // Include the database connection

// Check if the menu_id is set in the GET request
if (isset($_GET['menu_id'])) {
    $menu_id = $_GET['menu_id'];

    // Prepare the delete query
    $query = "DELETE FROM menu WHERE menu_id = $menu_id";

    // Execute the delete query
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Menu item successfully deleted'); window.location.href = 'kelolamenu.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
} else {
    echo "<script>alert('No menu ID specified.'); window.location.href = 'kelolamenu.php';</script>";
    exit();
}
mysqli_close($conn);
?>
