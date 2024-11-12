<!--?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "johntravels"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    $errors = [];

    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (empty($phone) || !preg_match("/^[0-9]{10}$/", $phone)) {
        $errors[] = "Valid 10-digit phone number is required.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email address is required.";
    }

    if (empty($message)) {
        $errors[] = "Message cannot be empty.";
    }

    if (empty($errors)) {
        // Insert into database
        $sql = "INSERT INTO contact_us (name, phone, email, message) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $phone, $email, $message);

        if ($stmt->execute()) {
            // Send email
            $to = "info.johntravels@gmail.com";
            $subject = "New Contact Message from " . $name;
            $body = "You have received a new message from the contact form on your website.\n\n";
            $body .= "Name: $name\n";
            $body .= "Phone: $phone\n";
            $body .= "Email: $email\n\n";
            $body .= "Message:\n$message\n";

            $headers = "From: $email\r\n";
            $headers .= "Reply-To: $email\r\n";

            if (mail($to, $subject, $body, $headers)) {
                echo "Thank you, your message has been sent.";
            } else {
                echo "Sorry, there was an error sending your message. Please try again.";
            }
        } else {
            echo "Sorry, there was an error storing your message. Please try again.";
        }

        $stmt->close();
    } else {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }

    $conn->close();
}
?-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Section</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../footer/styles.css">
    <style>
    .footer {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
            background-color: #333;
            color: white;
        }

        .footer-section {
            flex: 1 1 300px;
            padding: 20px;
            max-width: 400px;
        }

        .footer-section h3 {
            font-size: 1.5em;
            color: #00B4D8;
        }

        .footer-section p {
            line-height: 1.6;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 60px;
            margin-top: 10px;
        }

        .logo-container img {
            width: 60px;
            height: auto;
            border-radius: 8px;
        }

        .contact-info p, .contact-info a {
            margin: 5px 0;
            color: #f1f1f1;
            display: flex;
            align-items: center;
        }

        .contact-info a {
            text-decoration: none;
        }

        .contact-info a:hover {
            text-decoration: none;
        }

        .contact-info i {
            margin-right: 10px;
            color: #FE6161;
        }

        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .contact-form button {
            padding: 10px 15px;
            background-color: #FE6161;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .contact-form button:hover {
            background-color: #00B4D8;
        }

        /* Footer Bottom Styling */
        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #222;
            padding: 10px;
            color: white;
            flex-wrap: wrap;
        }

        .footer-bottom-section {
            flex: 1 1 200px;
            text-align: center;
            padding: 5px;
        }

        .footer-bottom a {
            color: #00B4D8;
            text-decoration: none;
            margin: 0 10px;
        }

        .footer-bottom a:hover {
            text-decoration: none;
            color: #FE6161;
        }

        @media (max-width: 768px) {
            .footer {
                flex-direction: column;
                align-items: center;
            }
            .footer-section {
                max-width: 100%;
            }
            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }
            .footer-bottom-section {
                flex: 1 1 100%;
                margin-bottom: 10px;
            }
        }   
        </style>
</head>
<body>

<footer class="footer">
    <div class="footer-section">
        <h3>About Us</h3>
        <p>John Travels - Trips by Woocurs. Make lifelong memories.</p>
        <div class="logo-container">
            <img src="images/logo1.png" alt="Woocurs" width="100px" height="100px">
            <img src="images/logo.png" alt="John Group">
        </div>
    </div>

    <div class="footer-section contact-info">
        <h3>Contact Information</h3>
        <p>Explore a new world with us!</p>
        <p><a href="https://maps.app.goo.gl/VKB6ddL1LxTJPPKaA" target="_blank"><i class="fa fa-map-marker"></i>377 B 1/1, Mannar Road, Veppankulam, Vavuniya, Sri Lanka</a></p>
        <p><a href="tel:+94 76 245 0858"><i class="fa fa-phone"></i>+94 76 245 0858</a></p>
        <p><a href="mailto:info.johntravels@gmail.com"><i class="fa fa-envelope"></i> info.johntravels@gmail.com</a></p>
    </div>

    <div class="footer-section contact-form">
        <h3>Contact Us</h3>
        <p>Get the latest updates and news from us.</p>
      <form action="footerpage.php" method="POST">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="text" name="phone" placeholder="Phone Number" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" rows="4" placeholder="Your Message" required></textarea>
            <button type="submit">Send</button>
        </form>
    </div>
	

<div class="footer-bottom">
    <div class="footer-bottom-section">
        <a href="#">Privacy Policy</a> | 
        <a href="#">Terms & Conditions</a> | 
        <a href="#">FAQ</a>
    </div>

    <div class="footer-bottom-section">
        <img src="images/Logo.png" alt="John Travels Logo" width="100px" height="100px" >
        <span style="font-size: 1.2em; color: #f1f1f1; vertical-align: middle; margin-left: 10px;">John Travels LK</span>
    </div>

    <div class="footer-bottom-section">
        <span><p>&copy; 2024 John Travels LK. All rights reserved.<p></span>
    </div>
</div>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>