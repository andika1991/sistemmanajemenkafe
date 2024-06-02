<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];

    // Query to check the user's credentials
    $query = "SELECT id, first_name, password FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $row['password'])) {
            $_SESSION['email'] = $email;
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['id'] = $row['id'];

          
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "<script>
        
        window.location.href = 'login.html';
          </script>";
    }
    
}
?>
