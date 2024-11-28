<?php

include 'database/db.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
  	if (isset($_POST['form_type'])) {
        $form_type = $_POST['form_type'];

        if ($form_type === 'apply') {
			

		$recaptchaSecret = '6Lds54sqAAAAAA_wlRH612F1JzGOnMby5W-G0ZtR'; 
		if (isset($_POST['g-recaptcha-response'])) {
    $recaptchaResponse = $_POST['g-recaptcha-response'];

   
    $verifyURL = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $recaptchaSecret,
        'response' => $recaptchaResponse,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    ];

    $options = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/x-www-form-urlencoded',
            'content' => http_build_query($data)
        ]
    ];
    $context = stream_context_create($options);
    $verify = file_get_contents($verifyURL, false, $context);
    $captchaSuccess = json_decode($verify);

    if (!$captchaSuccess->success) {
      echo "<script>alert('CAPTCHA verification failed. Please try again.');</script>";
      
	} 
    } else {
		echo "<script>alert('Please complete CAPTCHA');</script>";
        
    }
			
			
    
    $name = $_POST['name'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
   // $message = $_POST['message'];
    $position = $_POST['position'];

   
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] == UPLOAD_ERR_OK) {
        
        $allowedFileTypes = ['pdf', 'doc', 'docx'];
        $maxFileSize = 5 * 1024 * 1024; 

        $fileName = $_FILES['cv']['name'];
        $fileTmpName = $_FILES['cv']['tmp_name'];
        $fileSize = $_FILES['cv']['size'];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        
        if (!in_array($fileType, $allowedFileTypes)) {
            echo "<script>alert('Invalid file type. Only PDF, DOC, and DOCX are allowed.');</script>";
            exit();
        }

       
        if ($fileSize > $maxFileSize) {
            echo "<script>alert('File size exceeds the limit of 5MB');</script>";
            exit();
        }

        
        $uploadDir = 'uploads/cvs/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $newFileName = uniqid() . '.' . $fileType;
        $filePath = $uploadDir . $newFileName;

       
        if (!move_uploaded_file($fileTmpName, $filePath)) {
            echo "<script>alert('Error uploading file');</script>";
            exit();
        }
    } else {
        echo "<script>alert('No file uploaded or there was an error with the file upload');</script>";
        exit();
    }

   
    $query = "INSERT INTO job_applications (name, address, mobile, email, position, cv_file) VALUES (?, ?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ssssss", $name, $address, $mobile, $email,  $position, $filePath);

        if ($stmt->execute()) {

    
 
    echo "<script>alert('Application submitted successfully');</script>";
} else {
    echo "<script>alert('Error submitting the application. Please try again later'); window.location.href = 'careers.php';</script>";
}
            

        $stmt->close();
    } else {
        echo "<script>alert('Error preparing the query.');</script>";
    }

    
    $conn->close();
	
		}
	}
} 
	
?>


<?php include 'header/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career</title>
    <link rel="stylesheet" href="styles/careers.css">
    <link rel="stylesheet" href="styles/css/bootstrap.min.css">

    <style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 9999;
        }

        .popup-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            max-width: 500px;
            background: #fff;
            padding: 20px;
            margin:20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            
        }

        .close-popup {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            color: #333;
        }



.center{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
}

.popup{
    position: absolute;
    top: -150%;
    left: 50%;
    opacity: 0;
    transform: translate(-50%,-50%) scale(1.25);
    width: 400px;
    padding: 20px 30px;
    background: #fff;
    box-shadow: 2px 2px 5px 5px rgb(0, 0, 0, 0.15);
    border-radius: 10px;
    transition: top 0ms ease-in-out 200ms,
                opacity 200ms ease-in-out 0ms,
                transform 20ms ease-in-out 0ms;

}
.popup.active{
    top: 50%;
    opacity: 1;
    transform: translate(-50%,-50%) scale(1);
    transition: top 0ms ease-in-out 0ms,
                opacity 200ms ease-in-out 0ms,
                transform 20ms ease-in-out 0ms;
}

.popup .close-btn{
    position: absolute;
    top: 10px;
    right: 10px;
    width: 15px;
    height: 15px;
    background: #888;
    color: #eee;
    text-align: center;
    line-height: 15px;
    border-radius: 15px;
    cursor: pointer;
}
.popup .form h2{
    text-align: center;
    color: #222;
    margin: 10px 0px 20px;
    font-size: 25px;
}
.popup .form .form-element{
    margin: 15px 0px;
}
.popup .form .form-element label{
    font-size: 14px;
    color: #222;
}
.popup .form .form-element input[type="text"],
.popup .form .form-element input[type="text"],
.popup .form .form-element input[type="email"],
.popup .form .form-element input[type="file"]{
    margin-top:5px;
    display: block;
    width: 100%;
    padding: 10px;
    outline: none;
    border: 1px solid #aaa;
    border-radius: 5px;

}
.popup .form .form-element{
    width: 100%;
    height: 40px;
    border: none;
    outline: none;
    font-size: 16px;
    background: #222;
    color: #f5f5f5;
    border-radius: 10px;
    cursor: pointer;

}

.popup-content input{
    width: 100%;
    padding: 5px;
    margin: 5px 0;
    border: 1px solid;
    border-radius: 5px;
    
}




    </style>

</head>
<body>

    <section class="inner-banner-wrap">
        <div class="inner-banner-container" style="background-image: url(images/inner-banner-new.jpg);">
            <div class="container">
                <h1 class="heading text-center">Career</h1>
            </div>
            <img src="images/banner-pattern.png">
        </div>
        
    </section>
    <section class="about-page-section">
        <div class="container">
            <div class="vacancy-section">
                <div class="section-heading text-center">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <h5 class="dash-style">VACANCY / CAREERS</h5>
                            <h2>LET'S JOIN WITH US!</h2>
                            <p>Our work philosophy is simple. We want to grow, and we want you to grow. And to make that happen, we encourage you to explore your journey your own way .</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="vacancy-container col-lg-8">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="vacancy-content">
                                <h5>Part Time</h5>
                                <h3>Travel Agent</h3>
                                <p>It sounds like you're looking for information related to a travel agent offering local bus services or coordinating bus travel.</p>
                                <button class="apply-now-btn" data-position="Travel Agent">Apply Now</button>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="vacancy-content">
                                <h5>Part Time</h5>
                                <h3>Tour Guide</h3>
                                <p>Provide a brief description of the bus tour, highlighting the major attractions and experiences.Offering explanations about landmarks and destinations.</p>
                                <button class="apply-now-btn" data-position="Tour Guide">Apply Now</button> 
                            </div>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="vacancy-content">
                                <h5>Part Time</h5>
                                <h3>Trip Supervisor</h3>
                                <p>Ensuring that the tour adheres to the planned schedule and that all stops, attractions, and points of interest are included.</p>
                                <button class="apply-now-btn" data-position="Trip Supervisor">Apply Now</button>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="vacancy-content">
                                <h5>Part Time</h5>
                                <h3>Photo Grapher/Cheer Boys</h3>
                                <p>Photographer cheering boys capture the moment, boys-smiles are the secret to timeless shots!</p>
                                <button class="apply-now-btn" data-position="Photo Grapher/Cheer Boys">Apply Now</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="vacancy-form">
                            <img src="images/destination_1.jpg" alt>
                        </div>
                    </div>
                </div>
            </div>
            <!--<div class="about-service-wrap">
                <div class="section-heading">
                    <div class="row no-gutters align-items-end">
                        <div class="col-lg-6">
                            <h5 class="dash-style">OUR BENEFITS</h5>
                            <h2>OUR TRAVELS HAS BEEN BEST AMONG OTHERS SINCE 2023</h2>
                        </div>
                        <div class="col-lg-6">
                            <div class="section-disc">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="about-service-container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="about-service">
                                <div class="about-service-icon">
                                    <img src="images/icon19.png" alt=>
                                </div>
                                <div class="about-service-content">
                                    <h4>Archivements</h4>
                                    <p>Mailestones Target.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="about-service">
                                <div class="about-service-icon">
                                    <img src="images/icon20.png" alt>
                                </div>
                                <div class="about-service-content">
                                    <h4>Well Bouns</h4>
                                    <p>Get bouns on every Trips.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="about-service">
                                <div class="about-service-icon">
                                    <img src="images/icon21.png" alt>
                                </div>
                                <div class="about-service-content">
                                    <h4>Experience</h4>
                                    <p>Enhance your Skills.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
        </div>
    </div>


    <div class="center">
    <div class="popup-overlay" id="applyPopup">
        <div class="popup-content">
        <span class="close-popup" id="closePopup">&times;</span>
        <h2>Send Your Details</h2>
             <form action=" " method="POST" enctype="multipart/form-data">
    <input type="hidden" name="form_type" value="apply">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    <input type="hidden" id="jobPosition" name="position">
    <div class="form-element">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div class="form-element">
        <label for="address">Address</label>
        <input type="text" id="address" name="address" required>
    </div>
    <div class="form-element">
        <label for="mobile">Mobile No</label>
        <input type="tel" id="mobile" name="mobile" maxlength="10" pattern="[0-9]{10}" placeholder="Please enter the 10 digit" required>
    </div>
    <div class="form-element">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div class="form-element">
        <label for="file">Upload CV</label>
        <input type="file" id="cv" name="cv" required>
    </div>
	
	  <div class="form-element">
	<div class="g-recaptcha" data-sitekey="6Lds54sqAAAAALV-98g_sKaXQQX9llA4o-UbgKV1"></div>
	</div>
	
    <div class="button">
        <input type="submit" id="submit" value="Submit">
    </div>
</form>
                </div>
        </div>
    </div>
    
     
    <script>
        
        const applyButtons = document.querySelectorAll('.apply-now-btn');
        const popupOverlay = document.getElementById('applyPopup');
        const closePopup = document.getElementById('closePopup');
        const jobPositionInput = document.getElementById('jobPosition');

        applyButtons.forEach(button => {
            button.addEventListener('click', function () {
                jobPositionInput.value = this.dataset.position;
                popupOverlay.style.display = 'block';
            });
        });

        
        closePopup.addEventListener('click', () => {
            popupOverlay.style.display = 'none';
        });
    
        
        window.addEventListener('click', (e) => {
            if (e.target === popupOverlay) {
                popupOverlay.style.display = 'none';
            }
        });
    </script>
	 <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <?php include 'footer/footer.php'; ?>
</body>
</html>