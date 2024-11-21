<?php include 'header/header.php'; ?>
<?php 

if (isset($_GET['location']) && isset($_GET['title']) && isset($_GET['image'])) {
    $location = htmlspecialchars($_GET['location']);
    $title = htmlspecialchars($_GET['title']);
    $image = htmlspecialchars($_GET['image']);
  
    $size = isset($_GET['size']) ? htmlspecialchars($_GET['size']) : 'small';
} else {
  
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
            background-color: #FFFDE7;
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
            background-color: #FFFDE7;
        }

        .tourpackagestitle::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                linear-gradient(to right, rgba(0, 0, 0, 3.9), rgba(0, 0, 0, 0) 30%, rgba(0, 0, 0, 0) 70%, rgba(0, 0, 0, 3.9) 100%), 
                url('images/inner-banner.jpg') no-repeat center center / cover;
            z-index: 1;
        }

        .tourpackagestitle::after {
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

        .tourpackagestitle h1 {
            position: relative;
            z-index: 3; 
            font-family: 'Arial', sans-serif;
        }

        .hero-section {
            position: relative;
            text-align: center;
            padding: 12px;
            padding-left: 20px;
            margin-top: -230px; 
            color: white;
            z-index: 4; 
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
            justify-content: left;
            align-items: left;
            gap: -200px;
            padding: 10px;
        }

        .foreground-image img{
            width: 60%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }
        .details{
            margin-top: 150px !important;
        }

        .info{
            margin-left: -50px !important;
        }

        .info h2{
            font-family: 'Playfair Display', Georgia, serif; 
            font-size: 3.5em;
            color: white;         
            text-transform: uppercase;   
            letter-spacing: 1px;          
            line-height: 1.2;
            text-align: left;            
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
            background-color: #00B4D8;
            color: white;
            border: none;
            text-decoration: none;
         }
         
         @media (max-width: 768px) {
        .tourpackagestitle h1 {
            font-size: 1.8em; 
            padding: 0 10px; 
            margin-left: 20px;
        }

        .content {
            flex-direction: column;
            align-items: center; 
            padding: 20px;
            width: 100%; 
        }

        .foreground-image img {
            width: 100%; 
            max-width: none;
            height: auto;
        }

        .info {
            margin-top: -10px !important;
            max-width: 100%; 
            text-align: center; 
            margin: 0; 
            padding: 10px; 
        }

        .info h2 {
            margin-bottom: -150px !important;
            font-size: 2.2em; 
            margin-bottom: 10px;
        }

        .info p {
            font-size: 1.1em; 
            line-height: 1.6; 
            text-align: justify;
            margin: 10px 0;
        }

        .tourpackagestitle::after {
            background-size: contain; 
            background-position: center 40px; 
        }

        .button {
            width: 100%;
            padding: 12px;
            font-size: 1.2em; 
            margin-left: 90px;
        }
        .tourpackagestitle::after {
            bottom: -80px; 
        }

        .tourpackagestitle::after {
            background-position: center 40px; 
        }


        .hero-section {
            padding: 30px 0;
            background-size: cover; 
        }
    }

@media (max-width: 480px) {
    
    .details{
        margin-top:-150px;
    }
    .tourpackagestitle h1 {
        font-size: 1.5em; 
        padding: 0 10px; 
        margin-left:20px;
    }

    .info h2 {
        font-size: 1.8em;
        margin-left:50px;
        color:black;
    }

    .button {
        font-size: 1.1em; 
        padding: 12px 55px;
        margin-left:50px;
    }

    .foreground-image img {
        width: 50%;
        max-width: 50%;
        height: auto;
    }

    .info p {
        font-size: 1em; 
    }
}

    </style>
</head>
<body>
    <div class="tourpackagestitle">
        
    </div>

    <div class="hero-section">
        <div class="content">
            <?php if ($size == 'small'): ?> 
                <div class="foreground-image">
                    <img src="images/<?php echo $image; ?>" alt="<?php echo $title; ?>">
                </div>
                <div class="info">
                    <h2><?php echo $title; ?></h2>
                    <div class="details">
                        <p>Location: <?php echo $location; ?></p>
                        <p>Description goes here with details about this tour package, distance, highlights, etc.</p>
                        <div>
                       <a href="booking.php?location=<?php echo $location; ?>&title=<?php echo $title; ?>&image=<?php echo $image; ?>" class="button">Book Now</a>
                    </div>

                    </div>
                </div>
            <?php else: ?> 
                <div class="foreground-image1">
                    <img src="images/<?php echo $image; ?>" alt="<?php echo $title; ?>"style="width: 370px; height: 200px;">
                </div>
                <div class="info">
                    <h2><?php echo $title; ?></h2>
                    <div class="details" style="margin-top: -30px;" >
                        <p>Location: <?php echo $location; ?></p>
                        <p>Description goes here with details about this tour package, distance, highlights, etc.</p>
                        <div>
                       <a href="booking.php?location=<?php echo $location; ?>&title=<?php echo $title; ?>&image=<?php echo $image; ?>" class="button">Book Now</a>
                    </div>

                    </div>
                </div>
            <?php endif; ?> 
        </div>
    </div>
   
    <?php include 'footer/footer.php'; ?>
</body>
</html>
