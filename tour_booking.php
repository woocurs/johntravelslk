<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['form_type'])) {
        $form_type = $_POST['form_type'];
        if ($form_type === 'booking') {
            $errors = [];  // Initialize errors

            $name = htmlspecialchars($_POST['name']);
            $address = htmlspecialchars($_POST['address']);
            $nic = htmlspecialchars($_POST['nic']);
            $email = htmlspecialchars($_POST['email']);
            $phone = htmlspecialchars($_POST['phone']);
            $tour_package = htmlspecialchars($_POST['tour_package']);
            $booking_date = htmlspecialchars($_POST['booking_date']);
            $people = htmlspecialchars($_POST['people']);
            $message = htmlspecialchars($_POST['message']);
            $terms = isset($_POST['terms']) ? 1 : 0;

            // Handle file upload
            $photo = $_FILES['photo'];
            $upload_dir = 'uploads/photos/';
            $photo_path = '';
            if ($photo['error'] === 0) {
                $file_extension = pathinfo($photo['name'], PATHINFO_EXTENSION);
                $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
                if (in_array(strtolower($file_extension), $allowed_extensions) && $photo['size'] < 5000000) {
                    $photo_path = $upload_dir . basename($photo['name']);
                    if (!file_exists($upload_dir)) {
                        mkdir($upload_dir, 0777, true); // Create directory if not exists
                    }
                    move_uploaded_file($photo['tmp_name'], $photo_path);
                } else {
                    $errors[] = "Invalid file type or size. Only JPG, JPEG, PNG, and GIF under 5MB are allowed.";
                }
            } else {
                $errors[] = "File upload error.";
            }
			
            // Validation checks
            if (empty($name)) $errors[] = "Name is required.";
            if (empty($nic)) $errors[] = "NIC is required.";
            if (empty($address)) $errors[] = "Address is required.";
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
           if (empty($phone) || !preg_match("/^(\+?\d{1,3})?\d{10}$/", $phone))  $errors[] = "Phone number must be exactly 10 digits or include the country code (e.g., +94771234567 or 94771234567).";
            if (empty($tour_package)) $errors[] = "Tour package is required.";
            if (empty($booking_date)) $errors[] = "Booking date is required.";
            if (!is_numeric($people) || $people <= 0) $errors[] = "Valid number of people required.";
            if (!$terms) $errors[] = "You must agree to the terms and conditions.";

            if (empty($errors)) {
				
                storeBooking($name, $address, $nic, $email, $phone, $tour_package, $booking_date, $people, $message, $photo_path, $terms);
					
                $headers = "From: noreply@johntravels.com";
                $confirmation_subject = "Booking Received";
                $confirmation_body = "Dear $name,\n\nThank you for booking with us.\n\nTour Package: $tour_package\nBooking Date: $booking_date\n\nRegards,\nJohn Travels LK";

                if (mail($email, $confirmation_subject, $confirmation_body, $headers)) {
                    $customer_msg = "Booking successful! A confirmation email has been sent to you.";
                } else {
                    $customer_msg = "Booking successful, but failed to send confirmation email.";
                }

                $admin_email = "info.johntravels@gmail.com"; 
                $admin_subject = "New Tour Booking Notification";
                $admin_body = "A new booking has been made with the following details:\n\nName: $name\nAddress: $address\nNIC: $nic\nEmail: $email\nPhone: $phone\nTour Package: $tour_package\nBooking Date: $booking_date\nNumber of People: $people\nMessage: $message\n\nRegards,\nJohn Travels Booking System";

                if (!mail($admin_email, $admin_subject, $admin_body)) {
                    $customer_msg .= " However, we could not notify the admin.";
                }

                echo "<script>window.onload = function() { showPopup('Success', '$customer_msg'); }</script>";
            } else {
                $error_msg = implode("<br>", $errors);
                echo "<script>window.onload = function() { showPopup('Error', '$error_msg'); }</script>";
            }
        }
    }
}

function storeBooking($name, $address, $nic, $email, $phone, $tour_package, $booking_date, $people, $message, $photo_path, $terms) {
	
    $conn = new mysqli("localhost", "root", "", "johntravels");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
		
    }
    $stmt = $conn->prepare("INSERT INTO tour_bookings (name, address, nic, email, phone, tour_package, booking_date, people, message, photo_path, terms_accepted) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssdisss", $name, $address, $nic, $email, $phone, $tour_package, $booking_date, $people, $message, $photo_path, $terms);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
?>

<script>
function showPopup(title, message) {
    document.getElementById('popup-title').innerText = title;
    document.getElementById('popup-message').innerHTML = message;
    document.getElementById('popup').style.display = 'flex';
}

function closePopup() {
    document.getElementById('popup').style.display = 'none';
}
</script>
<?php include('header/booking_header.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Booking</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   
   <!-- <link rel="stylesheet" href="styles/style.css">-->
    <style>
  
	
         /* Popup Alert */
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .popup-message {
            background-color: #d5d5d5;
            padding: 20px;
            border-radius: 5px;
            max-width: 500px;
            text-align: center;
        }

        .popup-message button {
            margin-top: 10px;
            background-color: #fe6161;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .popup-message button:hover {
            background-color: #00b4d8;
        }

   
	body {
            
            background-image: url('images/bannaer_5.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
			flex-direction:column;
            justify-content: center;
            align-items: center;
			min-height:100vh;
          
		   
        }
	
		 .container {
			 
            background-color: rgba(255, 255, 255, 0.9);
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
			margin-top:0px;	
			
         
        }
		      input[type="text"], input[type="number"], input[type="email"], input[type="tel"], input[type="file"], textarea, select {
            width: 100%;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-right: 2px;
            margin-top: 0px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box; 
        }

        .terms {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
        }
		   h2 {
            text-align: center;
            color:  #00b4d8;
            margin-bottom: 20px;
			font-weight:bold;
        }
		   .logo {
			
		width: 150px;
		height: auto;
		border-radius: 8px;
		margin-bottom: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
		
		.space{
			margin-top:0px;
			margin-left:0;
			margin-right:0;
			margin-bottom:40px;
		}


        .terms input[type="checkbox"] {
            margin-right: 10px;
        }
       
        .form-group label {
            font-weight: bold;
        }
        .form-control {
            border-radius: 5px;
            box-shadow: none;
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
			width:100%
        }
        .submit-btn:hover {
            background-color: #00B4D8;
        }
		
		 .reset-btn {
            background-color: #00B4D8;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            padding: 15px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
			width:100%
			
        }
        .reset-btn:hover {
            background-color: #FE6161;
        }
        .error {
            color: red;
            font-size: 0.9em;
        }
    </style>
   
</head>
<body>

<div class="space">
 </div>
<!-- Popup Modal -->
<div class="popup" id="popup">
    <div class="popup-message">
        <h4 id="popup-title"></h4>
        <p id="popup-message"></p>
        <button onclick="closePopup()">Ok</button>
    </div>
</div>
    <div class="container">
        <img src="images/logo.png" alt="Company Logo" class="logo">
        <h2 class="text-center">Book Your Tour</h2>
		     <?php if (!empty($errors)): ?>
                <div class="error">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
   
        <form action=" " method="POST" enctype="multipart/form-data">
		<input type="hidden" name="form_type" value="booking" >
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo isset($name) ? $name : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control" value="<?php echo isset($address) ? $address : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="nic">NIC</label>
                <input type="text" name="nic" id="nic" class="form-control" value="<?php echo isset($nic) ? $nic : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo isset($email) ? $email : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" name="phone" id="phone" class="form-control" value="<?php echo isset($phone) ? $phone : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="tour_package">Select Tour Package</label>
                <select name="tour_package" id="tour_package" class="form-control" required>
                    <option value="">-- Select Package --</option>
                    <option value="Colombo" <?php echo (isset($tour_package) && $tour_package == 'Colombo') ? 'selected' : ''; ?>>Colombo</option>
                    <option value="Badulla" <?php echo (isset($tour_package) && $tour_package == 'Badulla') ? 'selected' : ''; ?>>Badulla</option>
                    <option value="Kandy" <?php echo (isset($tour_package) && $tour_package == 'Kandy') ? 'selected' : ''; ?>>Kandy</option>
                    <option value="Galle" <?php echo (isset($tour_package) && $tour_package == 'Galle') ? 'selected' : ''; ?>>Galle</option>
                    <option value="Jaffna" <?php echo (isset($tour_package) && $tour_package == 'Jaffna') ? 'selected' : ''; ?>>Jaffna</option>
                </select>
            </div>
            <div class="form-group">
                <label for="booking_date">Booking Date</label>
                <input type="date" name="booking_date" id="booking_date" class="form-control" value="<?php echo isset($booking_date) ? $booking_date : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="people">Number of People</label>
                <input type="number" name="people" id="people" class="form-control" value="<?php echo isset($people) ? $people : ''; ?>" min="1" required>
            </div>
            <div class="form-group">
                <label for="message">Special Message (Optional)</label>
                <textarea name="message" id="message" class="form-control"><?php echo isset($message) ? $message : ''; ?></textarea>
            </div>
            <div class="form-group">
                <label for="photo">Upload Photo</label>
                <input type="file" name="photo" id="photo" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="terms">
                    <input type="checkbox" name="terms" id="terms" <?php echo isset($terms) && $terms ? 'checked' : ''; ?>> I agree to the <a href="#">terms and conditions</a>
                </label>
            </div>
       <div class="form-group">
            <button type="submit" class="submit-btn btn btn-primary">Book Now</button>
			  </div>
			 <div class="form-group">
			 <button type="reset" class="reset-btn btn btn-secondary">Clear</button>
			   </div>
        </form>
    </div>

    <!--    <script>
    
    function showPopup(title, message) {
        document.getElementById('popup-title').innerText = title;
        document.getElementById('popup-message').innerHTML = message;
        document.getElementById('popup').style.display = 'flex';
    }

    
    function closePopup() {
        document.getElementById('popup').style.display = 'none';
	
    }
</script>-->
 
     



   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	
	
	 <?php include('footer/footer.php'); ?>
</body>
</html>