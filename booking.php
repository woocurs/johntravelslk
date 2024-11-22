<?php
include "database/db.php";

	
$selectedLocation = isset($_GET['location']) ? $_GET['location'] : '';
$selectedPackage = isset($_GET['title']) ? $_GET['title'] : '';
$selectedImage = isset($_GET['image']) ? $_GET['image'] : '';
 $size = isset($_GET['size']) ? htmlspecialchars($_GET['size']) : 'large'; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['form_type'])) {
        $form_type = $_POST['form_type'];
        if ($form_type === 'booking') {
            $errors = [];  
			
          $name = htmlspecialchars($_POST['name']);
        $address = htmlspecialchars($_POST['address']);
        $nic = htmlspecialchars($_POST['nic']);
        $email = htmlspecialchars($_POST['email']);
        $mobile = htmlspecialchars($_POST['mobile']);
        $whatsapp = htmlspecialchars($_POST['whatsapp']);
        $gender = htmlspecialchars($_POST['gender']);
        $dob = $_POST['dob'];
        $payment = htmlspecialchars($_POST['payment']);
        $reference_number = htmlspecialchars($_POST['reference_number']);
        $remark = htmlspecialchars($_POST['remark']);
        $tour_package = htmlspecialchars($_POST['tour_package']);
        $terms = isset($_POST['terms']) ? 1 : 0;
		
		
            
            $photo = $_FILES['photo'];
            $upload_dir = 'uploads/photos/';
            $photo_path = '';
            if ($photo['error'] === 0) {
                $file_extension = pathinfo($photo['name'], PATHINFO_EXTENSION);
                $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
                if (in_array(strtolower($file_extension), $allowed_extensions) && $photo['size'] < 5000000) {
                    $photo_path = $upload_dir . basename($photo['name']);
                    if (!file_exists($upload_dir)) {
                        mkdir($upload_dir, 0777, true); 
                    }
                    move_uploaded_file($photo['tmp_name'], $photo_path);
                } else {
                    $errors[] = "Invalid file type or size. Only JPG, JPEG, PNG, and GIF under 5MB are allowed.";
                }
            } else {
                $errors[] = "File upload error.";
            }
			
            
            if (empty($name)) $errors[] = "Name is required.";
        if (!preg_match("/^[0-9]{9}[vV]$|^[0-9]{12}$/", $nic)) $errors[] = "NIC must be valid (9 digits + 'V' or 12 digits).";
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
        if (empty($mobile) || !preg_match("/^\+\d{1,3}\d{10}$/", $mobile)) $errors[] = "Mobile number must include country code and 10 digits.";
        if (!empty($whatsapp) && !preg_match("/^\+\d{1,3}\d{10}$/", $whatsapp)) $errors[] = "WhatsApp number must include country code and 10 digits.";
        if (empty($gender)) $errors[] = "Gender is required.";
		 if (empty($payment)) $errors[] = "Payment is required.";
        if (empty($dob)) $errors[] = "DOB is required.";
        if (empty($tour_package)) $errors[] = "Tour package is required.";
        if (!$terms) $errors[] = "You must agree to the terms and conditions.";
     
        $refered_by = '';
        if (!empty($reference_number)) {
            $stmt = $conn->prepare("SELECT name FROM tour_bookings WHERE reference_number = ? AND tour_package = ?");
            $stmt->bind_param("ss", $reference_number, $tour_package);
            $stmt->execute();
            $stmt->bind_result($refered_by);
            $stmt->fetch();
            $stmt->close();
            if (empty($refered_by)) $errors[] = "Invalid reference number.";
        }
		
		
		
            if (empty($errors)) {
				
                storeBooking($conn,$name, $address, $nic, $mobile, $whatsapp, $email, $gender, $dob,$tour_package,$reference_number, $payment, $remark, $photo_path, $terms);
					
                $headers = "From: noreply@johntravels.com";
                $confirmation_subject = "Booking Received";
                $confirmation_body = "Dear $name,\n\nThank you for booking with us.\n\nTour Package: $tour_package\nBooking Payment: $payment\n\nRegards,\nJohn Travels LK";

                if (mail($email, $confirmation_subject, $confirmation_body, $headers)) {
                    $customer_msg = "Booking successfully received! Once confirmed, a confirmation will be sent to your email. Thank you!.";
                } else {
                    $customer_msg = "Booking successful, but failed to send confirmation email.";
                }
				$headers = "From: $email";
                $admin_email = "info.johntravels@gmail.com"; 
                $admin_subject = "New Tour Booking Notification";
                $admin_body = "A new booking has been made with the following details:\n\nName: $name\nAddress: $address\nNIC: $nic\nEmail: $email\nPhone: $mobile\nWhatsapp: $whatsapp\nGender: $gender\nDOB: $dob\nTour Package: $tour_package\nPayment: $payment\nReference_Number: $reference_number\nremark: $remark\nPhoto_path: $photo_path\n\nRegards,\nJohn Travels Booking System";

                if (!mail($admin_email, $admin_subject, $admin_body,$headers)) {
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

function storeBooking($conn,$name, $address, $nic, $mobile, $whatsapp, $email, $gender, $dob,$tour_package,$reference_number, $payment, $remark, $photo_path, $terms) {
	
     
	$stmt = $conn->prepare("INSERT INTO tour_bookings (name, address, nic, phone, whatsapp, email, gender, dob,tour_package, reference_number, payment, remark, photo_path, terms_accepted) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?, ?)");
   
	$stmt->bind_param("sssssssdssssss", $name, $address, $nic, $mobile, $whatsapp, $email, $gender, $dob,$tour_package,$reference_number, $payment, $remark, $photo_path, $terms);
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
   
  
    <style>
          @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
          background-image: url('images/<?php echo $selectedImage ? $selectedImage : 'images/bannaer_5.jpg'; ?>');
			background-size: cover;
			
			background-repeat:no-repeat;
            background-position: center;
            display: flex;
			flex-direction:column;
            justify-content: center;
            align-items: center;
			min-height:100vh;
			background-attachment:fixed;
          
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 150px;
            height: auto;
        }

        h2 {
            text-align: center;
            color:  #00b4d8;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 15px;
        }
		

        label::before {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
		.required::after {
            content: " *";
            color: red;
        }

        input[type="text"],
        input[type="number"],
        input[type="email"],
        input[type="tel"],
        input[type="file"],
        input[type="date"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        textarea {
            resize: none;
        }

        
		
	.radio-group {
    display: flex;
    align-items: center;
    gap:20px; 
}



.radio-group form-label {
    position: relative;
    padding-left: 25px; 
    cursor: pointer;
}

.radio-group form-label::before {
    content: "";
    position: absolute;
    left: 0;
    top: 2px;
    width: 16px;
    height: 16px;
    border: 2px solid #007BFF; 
    border-radius: 50%;
    background: white;
    box-sizing: border-box;
}

.radio-group input[type="radio"]:checked +form-label::before {
    background: #007BFF;
    border: 2px solid #007BFF;
}

.radio-group input[type="radio"]:checked +form-label::after {
    content: "";
    position: absolute;
    left: 6px;
    top: 6px;
    width: 10px;
    height: 10px;
    background: white;
    border-radius: 50%;
}
 .terms a{
            text-decoration:none;
        }

        .submit-btn,
        .reset-btn {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn {
            background-color: #28a745;
            color: #fff;
        }

        .submit-btn:hover {
            background-color: #218838;
        }

        .reset-btn {
            background-color:#708090; 
            color: #fff;
        }

        .reset-btn:hover {
            background-color:#696969; 
        }

        input::placeholder,
        textarea::placeholder {
           
            color: #999;
        }

        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .popup-message {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .popup-message button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .popup-message button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            h2 {
                font-size: 20px;
            }

            .form-group label {
                font-size: 14px;
            }

            input,
            textarea {
                font-size: 13px;
            }

            .submit-btn,
            .reset-btn {
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            h2 {
                font-size: 18px;
            }

            input,
            textarea {
                font-size: 12px;
            }

            .submit-btn,
            .reset-btn {
                font-size: 12px;
                padding: 10px;
            }

            .popup-message {
                width: 90%;
            }
        }
	

    </style>
   
</head>
<body>

<div class="space">
 </div>

<div class="popup" id="popup">
    <div class="popup-message">
        <h4 id="popup-title"></h4>
        <p id="popup-message"></p>
        <button onclick="closePopup()">Ok</button>
    </div>
</div>
    <div class="container">
        <img src="images/Logo.png" alt="Johntravels" class="logo">
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
            <input type="hidden" name="form_type" value="booking">
            <div class="form-group">
                <label for="tour_package">Your Tour Package</label>
                <input type="text" name="tour_package" id="tour_package" class="form-control" 
                       value="<?php echo $selectedPackage . '-' . $selectedLocation; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="name" class="required">Name with Initials</label>
                <input type="text" name="name" id="name" required>
            </div>
           
		    <div class="form-group">
                <label class="required">Address</label>
                <input type="text" name="address" required>
            </div>
            <div class="form-group">
                <label class="required">NIC Number</label>
                <input type="text" name="nic" required>
            </div>
            <div class="form-group">
                <label class="required">Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label class="required">Mobile Number</label>
                <input type="tel" name="mobile" required>
            </div>
            <div class="form-group">
                <label>WhatsApp Number</label>
                <input type="tel" name="whatsapp">
            </div>
            <div class="form-group">
			 <div class="radio-group">
                <label class="required">Gender</label>
                <input type="radio" name="gender" value="Male" required> <div class="form-label">Male</div>
                <input type="radio" name="gender" value="Female" required> <div class="form-label">Female</div>
            </div></div>
            <div class="form-group">
                <label class="required">Date of Birth</label>
                <input type="date" name="dob" required>
            </div>
          <div class="form-group">
    <label class="required" for="payment">Payment Option</label>
    <select name="payment" id="payment" required>
        <option value="" disabled selected>Please select</option>
		
        <option value="Advance">Advance</option>
        <option value="Half Payment">Half Payment</option>
        <option value="Full Payment">Full Payment</option>
    </select>
</div>
            <div class="form-group">
                <label>Reference Number</label>
                <input type="text" name="reference_number" placeholder="Referred by:">
            </div>
            <div class="form-group">
                <label>Remark</label>
                <textarea name="remark" placeholder="Special needs or requests"></textarea>
            </div>
            <div class="form-group">
                <label class="required">Upload ID Photo</label>
                <input type="file" name="photo" id="photo"  required>
            </div>
		   
            <div class="form-group">
			
               <input type="checkbox" name="terms" id="terms" <?php echo isset($terms) && $terms ? 'checked' : ''; ?> required> I agree to the <a href="#">terms and conditions</a>
            </div>
			 <div class="form-group">
            <button type="submit" class="submit-btn">Book Now</button>
			</div>
			 <div class="form-group">
            <button type="reset" class="reset-btn btn-secondary">Clear</button>
			</div>
        </form>
    </div>


     



   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	
	
	 <?php include('footer/footer.php'); ?>
</body>
</html>