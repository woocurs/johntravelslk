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
		
		
		if (empty($reference_number)) {
    
		$reference_number = strtoupper(substr(md5(time() . $mobile), 0, 10));
		} else {
   
		$stmt = $conn->prepare("SELECT name FROM tour_bookings WHERE reference_number = ? AND tour_package = ?");
		$stmt->bind_param("ss", $reference_number, $tour_package);
		$stmt->execute();
		$result = $stmt->get_result();
    
		if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

       
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                const refField = document.querySelector('input[name=\"reference_number\"]');
                
                
                if (refField) {
                    refField.value = '" . htmlspecialchars($row['name']) . "';
                }
                
            });
        </script>";
    } else {
       
        $errors[] = "Invalid reference number. Please enter a valid one.";
    }
    $stmt->close();
}


		
            
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
        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
		if (empty($mobile) || !preg_match("/^(\+?\d{1,3})?\d{10}$/", $mobile)) $errors[] = "Mobile number must be valid, with or without a country code.( e.g, 0712345678 or +94712345678).";
        if (!empty($whatsapp) && !preg_match("/^(\+?\d{1,3})?\d{10}$/", $whatsapp)) $errors[] = "WhatsApp number must be valid, with or without a country code.( e.g, 0712345678 or +94712345678).";
        if (empty($gender)) $errors[] = "Gender is required.";
		 if (empty($payment)) $errors[] = "Payment is required.";
        if (empty($dob)) $errors[] = "DOB is required.";
        if (empty($tour_package)) $errors[] = "Tour package is required.";
        if (!$terms) $errors[] = "You must agree to the terms and conditions.";
     
       
		
		
		
            if (empty($errors)) {
				
                storeBooking($conn,$name, $address, $nic, $mobile, $whatsapp, $email, $gender, $dob,$tour_package,$reference_number, $payment, $remark, $photo_path, $terms);
				  
				       $sms_message =  "Dear $name, your booking for $tour_package has been successfully received.\n"
							 ."Booking Details:\n"
                             . "NIC: $nic\n"
                             . "Mobile: $mobile\n"
                             . "Reference No: $reference_number\n"
                             . "Payment: $payment\n"
                             . "Thank you for choosing John Travels LK! \n"
							 . "Visit us: https://www.facebook.com/JohnTravelsLK  Contact us: +94 76 245 0858 \n";
							
                $sms_status = sendSMS($sms_message,$conn,$email, $name, $address, $nic, $mobile, $whatsapp, $gender, $dob, $tour_package, $reference_number, $payment, $remark);
				

				   
               $customer_msg = "Booking received! Confirmation will be sent to your email or mobile once approved!";
                $customer_msg .= $sms_status ? "Check your mobile for booking details Thank you!" : "failed to send confirmation Sms."; 

               echo "<script>window.onload = function() { showPopup('Success', '$customer_msg'); };</script>";
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
function sendSMS($sms_message, $conn, $email, $name, $address, $nic, $mobile, $whatsapp, $gender, $dob, $tour_package, $reference_number, $payment, $remark) {
   
    $mobile = preg_replace("/[^0-9]/", "", $mobile);

   
    if (substr($mobile, 0, 1) == '0') {
        $mobile = '94' . substr($mobile, 1);
    }

   
    if (strlen($mobile) != 11) {
       
        return false;
    }

    $url = "https://app.notify.lk/api/v1/send";
    $postData = [
        'user_id' => "28355",
        'api_key' => "jpWXAHATeXbXA4jAP1i3",
        'sender_id' => "JohnTravels",
        'to' => $mobile,
        'message' => $sms_message,
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($response, true);
    return isset($response['status']) && $response['status'] == "success";
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
window.location.href='tourpackages.php';
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
            background-image: url('images/bannaer_5.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-attachment: fixed;
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
            max-width: 150px;
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
		.required::after {
            content: " *";
            color: red;
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
                       value="<?php echo $selectedLocation; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="name">Name with Initials</label>
                     <input type="text" name="name" id="name" required value="<?php echo isset($name) ? $name : ''; ?>" placeholder="T.John">

            </div>
           
		    <div class="form-group">
                <label>Address</label>
                      <input type="text" name="address" id="address" required value="<?php echo isset($address) ? $address : ''; ?>" placeholder="No.377, Veppankulam,Vavuniya,Srilanka.">

            </div>
            <div class="form-group">
                <label>NIC Number</label>
               <input type="text" name="nic" id="nic" required value="<?php echo isset($nic) ? $nic : ''; ?>" placeholder="199843000123 or 981234567V ">

            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="email"  value="<?php echo isset($email) ? $email : ''; ?>" placeholder="info.johntravels@gmail.com">

            </div>
            <div class="form-group">
                <label>Mobile Number</label>
                <input type="text" name="mobile" id="mobile" required value="<?php echo isset($mobile) ? $mobile : ''; ?>" placeholder="Enter your mobile number Correctly(e.g, +9471234567)">

            </div>
            <div class="form-group">
                <label>WhatsApp Number</label>
                   <input type="text" name="whatsapp" id="whatsapp" value="<?php echo isset($whatsapp) ? $whatsapp : ''; ?>" placeholder="+9471234567">

            </div>
            <div class="form-group">
			 <div class="radio-group">
                <label>Gender</label>
                   <input type="radio" name="gender" id="male" value="Male" <?php echo (isset($gender) && $gender == 'Male') ? 'checked' : ''; ?>>
					<label for="male">Male</label>

               <input type="radio" name="gender" id="female" value="Female" <?php echo (isset($gender) && $gender == 'Female') ? 'checked' : ''; ?>>
			   <label for="female">Female</label>
                </div>
            </div>
			
            <div class="form-group">
                <label>Date of Birth</label>
                <input type="date" name="dob" id="dob" required value="<?php echo isset($dob) ? $dob : ''; ?>" >

            </div>
          <div class="form-group">
    <label for="payment">Payment Option</label>
    <select name="payment" id="payment" required>
        <option value="" disabled selected>Please select</option>
		
        <option value="Advance"<?php echo (isset($payment) && $payment == 'Advance') ? 'selected' : ''; ?>>Advance</option>
        <option value="Half Payment"<?php echo (isset($payment) && $payment == 'Half Payment') ? 'selected' : ''; ?>>Half Payment</option>
        <option value="Full Payment"<?php echo (isset($payment) && $payment == 'Full Payment') ? 'selected' : ''; ?>>Full Payment</option>
    </select>
</div>
            <div class="form-group">
                <label>Reference Number</label>
                  <input type="text" name="reference_number" id="reference_number" value="<?php echo isset($reference_number) ? $reference_number : ''; ?>" placeholder="Referred_by: (if available) ">

            </div>
            <div class="form-group">
                <label>Remark</label>
                 <textarea name="remark" id="remark"  placeholder="Any Special Needs or Requests"><?php echo isset($remark) ? $remark : ''; ?></textarea>

            </div>
            <div class="form-group">
                <label>Upload ID Photo (NIC/Passport/Licence)</label>
                <input type="file" name="photo" id="photo" required onchange="previewImage(event)"><br>
    <img id="photo-preview" src="" alt="Image Preview" style="display: none; max-width:500px;">

            </div>
		   
            <div class="form-group">
			
               <input type="checkbox" name="terms" id="terms" <?php echo isset($terms) && $terms ? 'checked' : ''; ?> required> I agree to the <a href="terms.php">terms and conditions</a>
            </div>
			 <div class="form-group">
            <button type="submit" class="submit-btn">Book Now</button>
			</div>
			 <div class="form-group">
            <button type="reset" class="reset-btn btn-secondary" onclick="clearPreview()">Clear</button>
			</div>
        </form>
    </div>
<script>
    
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById('photo-preview');
            preview.src = reader.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]); 
    }

    
    function clearPreview() {
        const preview = document.getElementById('photo-preview');
        preview.style.display = 'none'; 
        preview.src = ''; 
    }
</script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	
	
	 <?php include('footer/footer.php'); ?>
</body>
</html>