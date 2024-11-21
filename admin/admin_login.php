<?php
session_start();
require '../database/db.php'; 


$errorMessage = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

   
    $stmt = $conn->prepare("SELECT id, password FROM admin_details WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $store_password);
        $stmt->fetch();

        
        if ($password== $store_password) {
            $_SESSION['admin_id'] = $id;
            header("Location: admin_dashboard.php"); 
            exit();
        } else {
            $errorMessage = 'Incorrect password!';
        }
    } else {
        $errorMessage = 'No account found with that email!';
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="380x380" href="../images/Logo.png">
    <title>Admin Login - John Travels LK</title>
    <style>
        
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0; 
            padding: 0; 
            background-image: url('../images/bannaer_21.jpg'); 
            background-size: cover; 
            background-position: 10% center; 
            background-repeat: no-repeat; 
            font-family: Arial, sans-serif;
        }

        
        .login-container {
            background-color: #fff;
            padding: 30px;
            width: 325px;
            height: 250px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

       
        .login-container img {
            width: 150px;
            height: 50px;
        }

        .login-container h2 {
            font-size: 24px;
            margin: 10px 0;
        }

        
        .input-field {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        
        .login-btn {
            width: 95%;
            padding: 10px;
            background-color: #0791BE;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .login-btn:hover {
            background-color: #0056b3;
        }

        
        .forgot-password {
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        
        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <img src="../images/John_Travels_LK_Banner.png" alt="John Travels LK Logo">
        
        <form action="admin_login.php" method="POST">
            <input type="email" name="email" placeholder="E-Mail" class="input-field" required>
            <input type="password" name="password" placeholder="Password" class="input-field" required>
            <button type="submit" class="login-btn">Login</button>
            <a href="#" class="forgot-password">Forgot Password?</a>
        </form>
        <?php if ($errorMessage): ?>
            <div class="error-message"><?php echo htmlspecialchars($errorMessage); ?></div>
        <?php endif; ?>
    </div>

</body>
</html>
