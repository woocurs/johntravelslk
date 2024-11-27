<?php

 include ('database/db.php');



$name = $mail = $phone =$message = "";
$successMessage = $errorMessage = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['form_type'])) {
        $form_type = $_POST['form_type'];
        if ($form_type === 'contact_us') {
    $name = htmlspecialchars($_POST['name']);
    $mail = htmlspecialchars($_POST['mail']);
	 $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

 
    if (!empty($name) &&  !empty($phone) && !empty($mail) && !empty($message)) {
		if (preg_match("/^(\+?\d{1,3})?\d{10}$/", $phone)) {
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
          
            $stmt = $conn->prepare("INSERT INTO contact_us (name, email,phone, message) VALUES (?, ?,?, ?)");
            $stmt->bind_param("ssss", $name, $mail, $phone,$message);

            if ($stmt->execute()) {
				$adminEmail = "info.johntravels@gmail.com"; 
				$subject = "New Contact Us Message";
				$emailBody = "You have received a new message from the Contact Us form:\n\n";
				$emailBody .= "Name: $name\n";
				$emailBody .= "Email: $mail\n";
				$emailBody .= "Phone: $phone\n";
				$emailBody .= "Message:\n$message\n\n";
				$emailBody .= "This email was sent from the Contact Us form on John Travels LK.";
				if (mail($adminEmail, $subject, $emailBody, "From: johntravelslk@contact")) {

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
            $errorMessage = "phone number must be valid, with or without a country code. (e.g, +94712345678 or 0712345678).";
        }
    } else {
        $errorMessage = "All fields are required.";
    }
}
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
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="styles/css/bootstrap.min.css">
    <style>
        body {
           font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
			
        }
		    .contacttitle {
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
            background-color: #f3f3f3;
			font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }
        
	
        .contacttitle::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
			 height: 80%;
            background: 
            linear-gradient(to right, rgba(0, 0, 0, 3.9), rgba(0, 0, 0, 0) 30%, rgba(0, 0, 0, 0) 70%, rgba(0, 0, 0, 3.9) 100%), 
            url('images/img26.jpg') no-repeat center center / cover;
            z-index:2;
        }
		   .contacttitle::after {
            content: "";
            position: absolute;
            bottom: -70px;
            left: 0;
            right: 0;
            height: 50%; 
            background: url('images/banner-pattern.png') no-repeat center top; 
            background-size: contain;
            opacity: 1;
            z-index: 2;
        }
		   .contacttitle h1 {
            position: relative;
            z-index: 3; 
			margin-bottom:100px;
			font-size: 2.5em;
          font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
			text-align:center;
        }
		
		.contact-info1 p{
			padding-top:20px;
			
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
.social-media h2 {
	margin-top:30px;
  
	
}
.social-media a {
	margin-top:30px;
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
	 
        .contacttitle h1 {
            font-size: 1.8em; 
            padding: 0 10px; 
            margin-left: 20px;
        }
}
@media (max-width: 480px) {
    
    .details{
        margin-top:-150px;
    }
    .contacttitle h1 {
        font-size: 1.5em; 
        padding: 0 10px; 
        margin-left:20px;
    }
}
    </style>
</head>
<body>
 <div class="contacttitle">
     <h1> Contact Us  </h1>
    </div>
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
		  <input type="hidden" name="form_type" value="contact_us">
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" placeholder="Name with initials" required>

            <label for="email">Your Email</label>
            <input type="email" id="mail" name="mail" value="<?php echo $mail; ?>" placeholder="Your Email" required>
			
			<label for="email">Your Phone Number</label>
            <input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>" placeholder="0712345678 or +94712345678" required>

            <label for="message">Your Message</label>
            <textarea id="message" name="message" rows="4" required><?php echo $message; ?></textarea>

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
                <a href="https://wa.me/message/JHT7ZVJLWFUUP1"><i class="fab fa-whatsapp"></i></a>
           
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

