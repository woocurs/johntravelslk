<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "johntravels";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$err = [];
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['form_type'])) {
        $form_type = $_POST['form_type'];

        if ($form_type === 'contact') {
            $name = htmlspecialchars(trim($_POST['name']));
            $phone = htmlspecialchars(trim($_POST['phone']));
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $msg = htmlspecialchars(trim($_POST['msg']));

            if (empty($name)) {
                $err[] = "Name is required.";
            }
            if (empty($phone) || !preg_match("/^(\+?\d{1,3})?\d{10}$/", $phone)) {
                $err[] = "Phone number must be exactly 10 digits or include the country code (e.g., +94771234567 or 94771234567).";
            }
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $err[] = "Valid email address is required.";
            }
            if (empty($msg)) {
                $err[] = "Message cannot be empty.";
            }

            if (empty($err)) {
                $sql = "INSERT INTO contact_us (name, phone, email, message) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $name, $phone, $email, $msg);

                if ($stmt->execute()) {
                    $to = "thivagini.woocurs@gmail.com";
                    $subject = "New Contact Message from " . $name;
                    $body = "You have received a new message from the contact form on your website.\n\n";
                    $body .= "Name: $name\n";
                    $body .= "Phone: $phone\n";
                    $body .= "Email: $email\n\n";
                    $body .= "Message:\n$msg\n";

                    $headers = "From: $email\r\n";
                    $headers .= "Reply-To: $email\r\n";

                    if (mail($to, $subject, $body, $headers)) {
                        $success_message = "Thank you, your message has been sent.";
                    } else {
                        $err[] = "There was an error sending your message. Please try again.";
                    }
                } else {
                    $err[] = "There was an error storing your message. Please try again.";
                }

                $stmt->close();
            }
        }
    }
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Section</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
	<link rel="stylesheet" href="styles/styles.css">
    <style>
	
body {
    font-family: 'Roboto', sans-serif;
   <!-- margin: 0;-->
    padding: 0;
    background-color: #f4f4f4;
	margin-bottom:0px;
	margin-top:200px;
	margin-left:0;
	margin-right:0;
}




.form-group label {
    font-weight: bold;
    font-size: 1.1rem;
}

.form-control {
    border-radius: 5px;
    padding: 10px;
    font-size: 1rem;
    box-shadow: none;
    width: 100%;
}

.submit-btn {
    background-color: #FE6161;
    color: white;
    font-weight: bold;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    transition: background-color 0.3s;
    width: 100%;
}

.submit-btn:hover {
    background-color: #00B4D8;
}


.err {
    color: red;
    font-size: 0.9em;
}

.alert {
    margin-bottom: 20px;
    padding: 15px;
    font-size: 1rem;
}

.alert-danger {
    background-color: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
}

.alert-success {
    background-color: #d4edda;
    border-color: #c3e6cb;
    color: #155724;
}
    .modal-content {
            padding: 20px;
        }
        .modal-header {
            border-bottom: none;
        }
        .modal-footer {
            border-top: none;
            justify-content: center;
        }
        .alert-success {
            color: #155724;
            background-color: #d4edda;
        }
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
        }
.contact-form input, .contact-form textarea {
    width: 80%;
    padding: 5px;
    margin: 4px 0;
    border-radius: 4px;
    border: 1px solid #ccc;
}


.contact-form button {
    padding: 6px 10px;
    background-color: #FE6161;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 80%;
}

.contact-form button:hover {
    background-color: #00B4D8;
}


footer {
	margin-top:20px;
    background-color: #333;
    color: white;
    padding: 0px 0;
	width:100%;
	 display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
			margin-bottom:0;
          
}

img {
			
		width: 60px;
		height: auto;
		border-radius: 8px;
		margin-bottom: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
		
		.logo-container {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-top: 10px;
}

.logo-container img {
    width: 100px;
    height: auto;
    border-radius: 8px;
}
.logo-container {
    display: flex;
    align-items: center;
    gap: 30px;
    margin-top: 10px;
}

.logo-container img {
    width: 60px;
    height: auto;
    border-radius: 8px;
}

footer .footer-bottom {
    background-color: #222;
    text-align: center;
    font-size: 0.9rem;
	 display: flex;
     flex-wrap: wrap;
     justify-content: space-around;
	 padding-bottom:0;
   padding: 30px 0;
	width:100%;
	margin-bottom:0;
}

.footer-section {
	margin-top:20px;
    margin-bottom: 10px;
	margin-left:10px;
	text-align: center;
}

.footer-section h3 {
    font-size: 1.2rem;
    margin-bottom: 10px;
	color:#00b4d8;
}

.footer-section p {
    margin: 5px 0;
}

.footer-bottom-section {
    font-size: 0.8rem;
    color: #aaa;
	 text-align: center;
	 margin-left:20px;
	
}
.footer-section a {
    color:  white;
    text-decoration: none;
}

.footer-bottom-section a {
    color:  #00B4D8;
    text-decoration: none;
}

footer a:hover {
    text-decoration: none;
	color:#FE6161;
}


@media (max-width: 768px) {
    .container {
        padding: 20px;
    }
	.logo-container {
        gap: 20px;
    }

    .footer-section {
        text-align: center;
    }

    .footer-section h3 {
        font-size: 1rem;
    }

    .footer-bottom-section {
        font-size: 0.7rem;
    }
}

@media (max-width: 480px) {
    .submit-btn {
        padding: 12px 0;
    }

    .form-group label,
    .form-control {
        font-size: 0.9rem;
    }
}

    </style>
</head>
<body>

<?php if (!empty($err)) { ?>
    <script type="text/javascript">
        window.onload = function() {
            alert("<?php echo implode("\n", $err); ?>");
        };
    </script>
<?php } elseif (isset($success_message)) { ?>
    <script type="text/javascript">
        window.onload = function() {
            alert("<?php echo $success_message; ?>");
        };
    </script>
<?php } ?>

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
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> "  method="POST">
	  <input type="hidden" name="form_type" value="contact" >
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="tel" name="phone" placeholder="Phone Number" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="msg" rows="4" placeholder="Your Message" required></textarea>
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
        <img src="images/logo.png" alt="John Travels Logo" >
        <span style="font-size: 1.2em; color: #f1f1f1; vertical-align: middle; margin-left: 10px;">John Travels LK</span>
    </div>

    <div class="footer-bottom-section">
        <span><p>&copy; 2024 John Travels LK. All rights reserved.<p></span>
    </div>
</div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>