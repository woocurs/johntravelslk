<?php include 'header/header.php'; ?>
<?php 
// Check if the necessary parameters are provided
if (isset($_GET['location']) && isset($_GET['title']) && isset($_GET['image'])) {
    $location = htmlspecialchars($_GET['location']);
    $title = htmlspecialchars($_GET['title']);
    $image = htmlspecialchars($_GET['image']);
} else {
    // Redirect to a default page or show an error if parameters are missing
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: gray;
            margin: 0;
        }

        .tourpackagestitle {
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
        }

        .tourpackagestitle::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                linear-gradient(to right, rgba(0, 0, 0, 3.9), rgba(0, 0, 0, 0) 30%, rgba(0, 0, 0, 0) 70%, rgba(0, 0, 0, 3.9)100%), 
                url('images/inner-banner.jpg') no-repeat center center / cover;
            z-index: 1;
        }

        .tourpackagestitle::after {
            content: "";
            position: absolute;
            bottom: -60px;
            left: 0;
            right: 0;
            height: 50%; /* Adjust this to control how much of the pattern overlays the main background */
            background: url('images/banner-pattern.png') no-repeat center top; /* Pattern overlay */
            background-size: contain;
            opacity: 1; /* Adjust opacity as needed */
            z-index: 2;
        }

        .tourpackagestitle h1 {
            position: relative;
            z-index: 3; /* Ensure the text appears above both background images */
            font-family: 'Arial', sans-serif;
        }

        .hero-section {
            position: relative;
            text-align: center;
            padding-top:-200px;
            padding: 12px;
            padding-left:20px;
            margin-top: -280px; 
            color: white;
            z-index: 4; /* Bring hero-section above tourpackagestitle */
        }

        .tourpackagestitle h1 {
            position: relative;
            z-index: 3; 
            font-family: 'Playfair Display', Georgia, serif; 
            font-size: 2.3em; 
            margin-top: -50px; 
        }

        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
            padding: 10px;
        }

        .foreground-image img {
            width: 270px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }

        .info h2 {
            font-family: 'Playfair Display', Georgia, serif; 
            font-size: 3.5em;
            margin-top: -80px; 
            color: white;         
            text-transform: uppercase;   
            letter-spacing: 1px;          
            line-height: 1.2;
            text-align: left;            
        }
        .info .details{
            margin-top: 160px;
        }

        .info p {
            max-width: 400px;
            line-height: 1.6;
            color: black;
            text-align: justify;
        }

        .button {
            padding: 10px 20px;
            background-color: #ff6b6b;
            margin-left: -350px;
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #004d00;
        }

    </style>
</head>
<body>
    <div class="tourpackagestitle">
        
    </div>

    <div class="hero-section">
        <div class="content">
            <div class="foreground-image">
                <img src="images/<?php echo $image; ?>" alt="<?php echo $title; ?>">
            </div>

            <div class="info">
                <h2><?php echo $title; ?></h2>
                <div class="details">
                    <p>Location: <?php echo $location; ?></p>
                    <p>Description goes here with details about this tour package, distance, highlights, etc.</p>
                <div>
                    <a href="#" class="button">Book Now</a>
                </div>
                </div>
            </div>
        </div>
    </div>
   
    <?php include 'footer/footer.php'; ?>
</body>
</html>
