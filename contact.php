
<?php

 include ('database/db.php');

$adminEmail = "info.johntravels@gmail.com"; 
$subject = "New Contact Us Message";

$name = $mail = $message = "";
$successMessage = $errorMessage = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $mail = htmlspecialchars($_POST['mail']);
    $message = htmlspecialchars($_POST['message']);

 
    if (!empty($name) && !empty($mail) && !empty($message)) {
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
          
            $stmt = $conn->prepare("INSERT INTO contact_us (name, email, message) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $mail, $message);

            if ($stmt->execute()) {
				$emailBody = "You have received a new message from the Contact Us form:\n\n";
				$emailBody .= "Name: $name\n";
				$emailBody .= "Email: $mail\n";
				$emailBody .= "Message:\n$message\n\n";
				$emailBody .= "This email was sent from the Contact Us form on John Travels LK.";
				if (mail($adminEmail, $subject, $emailBody, "From: $mail")) {

                $successMessage = "Thank you! Your message has been successfully sent.";
                $name = $mail = $message = ""; 
				
            } else {
                $errorMessage = "Sorry, your message could not be sent. Please try again later.";
			}
            }

            $stmt->close();
        } else {
            $errorMessage = "Invalid email address.";
        }
    } else {
        $errorMessage = "All fields are required.";
    }
}

$conn->close();
?>
<?php
include "header/header.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - John Travels LK</title>
    
	<link rel="stylesheet" href="styles/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
		    .headertitle {
            margin-top: 0;
            text-align: center;
            min-height: 50vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2.5em;
            font-weight: bold;
            background-color: #FFFDE7;
        }
        header {
            background: url('images/destination_6.jpg') no-repeat center center/cover;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2.5rem;
            font-weight: bold;
			text-align:center;
        }
		   .header::after {
            content: "";
            position: absolute;
            bottom: -60px;
            left: 0;
            right: 0;
            height: 50%; 
            background: url('images/banner-pattern.png') no-repeat center top; 
            background-size: contain;
            opacity: 1;
            z-index: 2;
        }
		   .header h1 {
            position: relative;
            z-index: 3; 
            font-family: 'poppins', sans-serif;
			text-align:center;
        }
		.contact-info1 a{
			text-decoration: none;
			color: #333;
			
		}
		
		.contact-info1 a:hover{
			text-decoration: none;
			color: #0056b3;
		}
		.contact-info1 i:hover{
			text-decoration: none;
			color: #0056b3;
		}


        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			width:100%;
        }

        .form-section, .details-section {
            display: inline-block;
            vertical-align: top;
            width: 48%;
            margin-right: 4%;
        }

        .details-section {
            width: 48%;
        }

        form {
            margin-top: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 4px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }

        .map-container {
            margin-top: 20px;
        }

        iframe {
            width: 100%;
            height: 300px;
            border: 0;
        }
		.contact-container {
    display: flex; 
    justify-content: space-between; 
    gap: 20px; 
    flex-wrap: wrap;
    margin-top: 20px;
}

.form-section,
.details-section {
    flex: 1;
    min-width: 300px; 
}

h2 {
    color:darkblue;
	font-weight:bold;
    margin-bottom: 15px;
	font-size:1rem;
}

p {
    line-height: 1.6;
}

form {
    margin-top: 20px;
}

input,
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    background-color:  #FE6161;
    color: #fff;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
    border-radius: 4px;
}

button:hover {
    background-color: #0056b3;
}

.social-media a {
    display: inline-block;
    margin-right: 10px;
	color:  #0056b3;
	
}

.social-media i {
	width:100%;
	height:100%;
    width: 50px;
    height:50px;
    vertical-align: middle;
	color:  #FE6161;
}
.social-media i:hover {
  
	color:  #0056b3;
}

@media (max-width: 768px) {
    .contact-container {
        flex-direction: column; 
    }
}
    </style>
</head>
<body>
<header>
    Contact Us
</header>
<div class="container">
    <?php if ($successMessage): ?>
        <div class="message success"><?php echo $successMessage; ?></div>
    <?php elseif ($errorMessage): ?>
        <div class="message error"><?php echo $errorMessage; ?></div>
    <?php endif; ?>
<div class="contact-container">
    <div class="form-section">
        <h2>Contact Us to Get More Info</h2>
        <form method="POST" action="contact.php">
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>

            <label for="email">Your Email</label>
            <input type="email" id="mail" name="mail" value="<?php echo $mail; ?>" required>

            <label for="message">Your Message</label>
            <textarea id="message" name="message" rows="5" required><?php echo $message; ?></textarea>

            <button type="submit">Submit Message</button>
        </form>
    </div>

    <div class="details-section">
        <h2>Need Help? Contact Us!</h2>
 <div class="contact-info1">

        <p>
            <strong>Location Address:</strong><br>
            <span> <a href="https://maps.app.goo.gl/VKB6ddL1LxTJPPKaA" target="_blank" ><i class="fas fa-map-marker-alt"></i>
          # 377 B 1/1, Mannar Road, Veppankulam, Vavuniya, Sri Lanka </a></span>
        </p>
        <p>
            <strong>Email Address:</strong><br>
              <span>
                    <a href="mailto:info.johntravels@gmail.com"><i class="fas fa-envelope"></i> info.johntravels@gmail.com</a></span>
        </p>
        <p>
            <strong>Phone Number:</strong><br>
                      <span><a href="tel:+94 76 245 0858" ><i class="fas fa-phone-alt"></i> 
       +94 76 245 0858 </a></span>
        </p>
		</div>
        <div class="social-media">
            <h2>Follow us on social media:</h2>
            <a href="https://www.facebook.com/johntravelslk"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.youtube.com/@johntravelslk"><i class="fab fa-youtube"></i></a>
                <a href="https://www.instagram.com/john_travels_lk/"><i class="fab fa-instagram"></i></a>
                <a href="https://api.whatsapp.com/message/JHT7ZVJLWFUUP1?autoload=1&app_absent=0"><i class="fab fa-whatsapp"></i></a>
           
        </div>
    </div>
</div>
</div>
<div class="container map-container">
    <iframe
        src="https://maps.google.com/maps?q=woocurs,vavuniya+srilanka&t=&z=13&ie=UTF8&iwloc=&output=embed"
        allowfullscreen="" loading="lazy"></iframe>
</div>

	<?php include "footer/footer.php" ?>
</body>
</html>


     

              

               