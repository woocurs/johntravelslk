<?php
// PHP variables for contact information
$contact_number = "+94 76 245 0858";
$email = "info.johntravels@gmail.com";
$address = "#377 B 1/1, Mannar Road, Veppankulam, Vavuniya, Sri Lanka";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>John Travels LK</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>

<!-- Top Bar with Contact Information and Social Media Icons -->
<div class="top-bar">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <div class="contact-info1">
                <span><i class="fas fa-phone-alt"></i> <?php echo $contact_number; ?></span>
                <span><i class="fas fa-envelope"></i> 
                    <a href="mailto:info.johntravels@gmail.com<?php echo $email; ?>" style="color: inherit; text-decoration: none;">
                        <?php echo $email; ?>
                    </a>
                </span>
                <span><i class="fas fa-map-marker-alt"></i> <?php echo $address; ?></span>
            </div>
            <div class="social-icons">
                <a href="https://www.facebook.com/johntravelslk"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.youtube.com/@johntravelslk"><i class="fab fa-youtube"></i></a>
                <a href="https://www.instagram.com/john_travels_lk/"><i class="fab fa-instagram"></i></a>
                <a href="https://api.whatsapp.com/message/JHT7ZVJLWFUUP1?autoload=1&app_absent=0"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
    </div>
</div>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="images/John_Travels_LK_Banner_R.png" alt="Logo"> 
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="tourpackages.php">Tour Packages</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Gallery</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Careers</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Admin Dashboard</a></li>
                <li class="nav-item"><a class="nav-link btn btn-login" href="#">Tour</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.style.backgroundColor = 'rgba(0, 0, 0, 0.8)'; // Set the color and opacity
        } else {
            navbar.style.backgroundColor = 'transparent'; // Return to transparent
        }
    });
</script>

</body>
</html>