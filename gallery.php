<?php

$images = [
	["src" => "images/tour39.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour1.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour4.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour3.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour2.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour7.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour5.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour6.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour28.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour29.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour18.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour27.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour21.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour20.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour22.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour26.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour16.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour15.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour17.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour25.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour19.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour23.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour24.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour30.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour35.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour31.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour32.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour33.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour34.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour9.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour10.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour11.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour12.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour13.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/tour14.jpg", "alt" => " ", "caption" => " "],
    ["src" => "images/destination_2.jpg", "alt" => "", "caption" => " "],
    ["src" => "images/destination_1.jpg", "alt" => "", "caption" => " "],
    ["src" => "images/destination_3.jpg", "alt" => "", "caption" => " "],
    ["src" => "images/destination_4.jpg", "alt" => "", "caption" => " "],
    ["src" => "images/destination_5.jpg", "alt" => " ", "caption" => " "],
    ["src" => "images/destination_6.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/destination_7.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/destination_8.jpg", "alt" => " ", "caption" => " "],
	["src" => "images/pasikudahbeach.png", "alt" => " ", "caption" => " "],
	["src" => "images/tour8.jpg", "alt" => " ", "caption" => " "]
		
];

?>
<?php include("header/header.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - John Travels LK</title>
	   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="styles/css/bootstrap.min.css">
    <style>
        body {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            line-height: 1.6;
            background: #f7f7f7;
            margin: 0;
            padding: 0;
			background-color:#f3f3f3;
            background-size: cover;
            background-position: center;
        }

	
        header {
            background: url('images/img26.jpg') no-repeat center center/cover;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3.5rem;
            font-weight: bold;
			text-align:center;
			font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
			
        }
		  .header::before {
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
			text-align:center;
			
        }
		 .header  h1{
            position: relative;
            z-index: 3; 
			margin-bottom:100px;
			font-size: 3.5em;
          font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
			text-align:center;
			font-weight:bold;
        }


       
        .gallery {
            padding: 20px;
            max-width: 1200px;
            margin: auto;
            text-align: center;
			background-color:#e7e7e7;
			
			
        }

        .gallery h1 {
            font-size: 2.5em;
            margin-bottom: 15px;
            color: #333;
			
        }

        .gallery p {
            margin-bottom: 25px;
            color: #555;
            font-size: 1.1em;
			
        }

  .gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); 
    gap: 20px;
}

.gallery-item {
    position: relative;
    overflow: hidden;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.gallery-item img {
    width: 100%; 
    height: 150px;
    object-fit: cover; 
    border-radius: 10px;
    transition: transform 0.3s ease;
	
}

.gallery-item:hover img {
    transform: scale(1.1);
	
}
    
.fullscreen-viewer {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.9);
    display: flex;
    justify-content: center;
    align-items: center;
    visibility: hidden;
    opacity: 0;
    transition: visibility 0s, opacity 0.3s ease;
	
}

.fullscreen-viewer img {
    width: 90%;
    max-width: 100%; 
    max-height: 90%; 
    object-fit: contain; 
    border-radius: 10px;
}

.fullscreen-viewer:target {
    visibility: visible;
    opacity: 1;
	
}

.close-viewer {
    position: absolute;
    top: 20px;
    right: 20px;
    font-size: 2em;
    color: #fff;
    text-decoration: none;
    background: rgba(0, 0, 0, 0.5);
    padding: 5px 15px;
    border-radius: 5px;
    cursor: pointer;
}

    .nav-icon {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 2.5em;
            color: white;
            text-decoration: none;
            background: rgba(0, 0, 0, 0.5);
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
        }

        .prev {
            left: 20px;
        }

        .next {
            right: 20px;
        }

    </style>
</head>
<body>

<header>

  Our Travel Gallery
</header>
<section class="gallery">

    <p>Explore some of the beautiful destinations we've taken our clients to.</p>
    <div class="gallery-grid">
        <?php foreach ($images as $key => $image): ?>
            <a href="#img<?php echo $key; ?>" class="gallery-item">
                <img src="<?php echo $image['src']; ?>" alt="<?php echo $image['alt']; ?>">
                <p><?php echo $image['caption']; ?></p>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<?php foreach ($images as $key => $image): ?>
    <div id="img<?php echo $key; ?>" class="fullscreen-viewer">
        <a href="#" class="close-viewer">×</a>
        <img src="<?php echo $image['src']; ?>" alt="<?php echo $image['alt']; ?>">
		<?php if ($key > 0): ?>
            <a href="#img<?php echo $key - 1; ?>" class="nav-icon prev">‹</a>
        <?php endif; ?>
        <?php if ($key < count($images) - 1): ?>
            <a href="#img<?php echo $key + 1; ?>" class="nav-icon next">›</a>
        <?php endif; ?>

    </div>
<?php endforeach; ?>

<?php include("footer/footer.php"); ?>
</body>
</html>