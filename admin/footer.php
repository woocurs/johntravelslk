<?php
include "../database/db.php";

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
                    $to = "info.johntravels@gmail.com";
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
    <link rel="stylesheet" href="../styles/style.css">
    <style>
        footer {
            background-color: #333;
            color: #fff;
            margin-top: 0;
            padding: 40px 20px;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        footer h3 {
            font-size: 18px;
            margin-bottom: 15px;
        }

        footer p,
        footer a {
            color: #bbb;
            font-size: 14px;
            text-decoration: none;
        }

        footer a:hover {
            color: #fff;
        }


        .footer-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .footer-section {
            flex: 1 1 30%;
            min-width: 250px;
            padding: 10px;
        }


        .footer-section .contact-form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .contact-form input,
        .contact-form textarea,
        .contact-form button {
            width: 50%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #555;
            border-radius: 4px;
            background-color: #444;
            color: #fff;
            height: 30px;
            text-align: center;
        }

        .contact-form button {
            background-color: #00B4D8;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 50%;
            text-align: center;
        }

        .contact-form button:hover {
            background-color: #FE6161;
        }


        @media (max-width: 768px) {
            .footer-container {
                flex-direction: column;
            }

            .footer-section {
                flex: 1 1 100%;
            }
        }


        .bottom-footer {
            border-top: 1px solid #444;
            padding-top: 10px;
            font-size: 12px;
        }

        .bottom-footer p {
            margin: 5px 0;
        }

        .footer-section a {
            color: white;
            text-decoration: none;
        }

        .footer-bottom-section a {
            color: #00B4D8;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: none;
            color: #FE6161;
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
    </style>
</head>

<body>

    <?php if (!empty($err)) { ?>
        <script type="text/javascript">
            window.onload = function () {
                alert("<?php echo implode("\n", $err); ?>");
            };
        </script>
    <?php } elseif (!empty($success_message)) { ?>
        <script type="text/javascript">
            window.onload = function () {
                alert("<?php echo $success_message; ?>");
            };
        </script>
    <?php } ?>

    <footer class="footer">

        <div class="footer-section">
            <h3>About Us</h3>
            <p>John Travels - Trips by Woocurs. Make lifelong memories.</p>
            <div class="logo-container">
                <img src="../images/logo1.png" alt="Woocurs" width="100px" height="100px">
                <img src="../images/logo.png" alt="John Group">
            </div>
        </div>

        <div class="footer-section contact-info">
            <h3>Contact Information</h3>
            <p>Explore a new world with us!</p>
            <p><a href="https://maps.app.goo.gl/VKB6ddL1LxTJPPKaA" target="_blank"><i class="fa fa-map-marker"></i> 377
                    B 1/1, Mannar Road, Veppankulam, Vavuniya, Sri Lanka</a></p>
            <p><a href="tel:+94 76 245 0858"><i class="fa fa-phone"></i>+94 76 245 0858</a></p>
            <p><a href="mailto:info.johntravels@gmail.com"><i class="fa fa-envelope"></i> info.johntravels@gmail.com</a>
            </p>
        </div>

        <div class="footer-section contact-form">
            <h3>Contact Us</h3>
            <p>Get the latest updates and news from us.</p>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> " method="POST">
                <input type="hidden" name="form_type" value="contact">
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
                <img src="../images/logo.png" alt="John Travels Logo">
                <span style="font-size: 1.2em; color: #f1f1f1; vertical-align: middle; margin-left: 10px;">John Travels
                    LK</span>
            </div>

            <div class="footer-bottom-section">
                <span>
                    <p>&copy; 2024 John Travels LK. All rights reserved.
                    <p>
                </span>
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