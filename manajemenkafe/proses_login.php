<?php
include 'session.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST["inputEmail"]) && isset($_POST["inputPassword"])) {
        
       
        $email = htmlspecialchars($_POST["inputEmail"]);
        $password = htmlspecialchars($_POST["inputPassword"]);
        
     
        $sql = "SELECT * FROM users WHERE email = ?";
        
      
        $stmt = $conn->prepare($sql);
        
    
        $stmt->bind_param("s", $email);
        
        
        $stmt->execute();
        
      
        $result = $stmt->get_result();
        
     
        if ($result->num_rows == 1) {
          
            $row = $result->fetch_assoc();
        
            if (password_verify($password, $row['password'])) {
                echo "<script>
                window.location.href = 'dashboard.php';
              </script>";
            } else {
              
                echo "Kata sandi salah";
            }
        } else {
  
            echo "Email tidak ditemukan";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Email dan kata sandi diperlukan";
    }
}
?>
