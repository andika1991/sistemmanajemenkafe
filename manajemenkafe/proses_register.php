<?php


include 'koneksi.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["inputFirstName"]) && isset($_POST["inputLastName"]) && isset($_POST["inputEmail"]) && isset($_POST["inputPassword"]) && isset($_POST["inputPasswordConfirm"])) {
        
      
        $first_name = htmlspecialchars($_POST["inputFirstName"]);
        $last_name = htmlspecialchars($_POST["inputLastName"]);
        $email = htmlspecialchars($_POST["inputEmail"]);
        $password = htmlspecialchars($_POST["inputPassword"]);
        $confirm_password = htmlspecialchars($_POST["inputPasswordConfirm"]);
        
       
    
        if ($password === $confirm_password) {
          
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

         
            $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";

            
            $stmt = $conn->prepare($sql);

           
            $stmt->bind_param("ssss", $first_name, $last_name, $email, $hashed_password);

           
            if ($stmt->execute()) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error; 
            }
            echo "<script>
            window.location.href = 'daftar_sukses.html';
          </script>";
            $stmt->close();
            $conn->close();
        } else {
            echo "Passwords do not match";
        }
    } else {
        echo "All fields are required";
    }
}
?>
