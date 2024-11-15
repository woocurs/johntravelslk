<?php include 'header/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Image Grid</title>
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
            background: url('images/inner-banner.jpg') no-repeat center center / cover; /* Main background image */
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
            z-index: 3; 
            font-family: 'Playfair Display', Georgia, serif; 
            font-size: 2.3em; 
            margin-top: -50px; 
        }


        .image-grid {
            display: grid;
            background-color: #FAFAFA;
            grid-template-columns: repeat(4, 1fr); /* 4 items per row */
            gap: 10px;
            padding-right: 150px;
            padding-left: 150px;
            padding-top: 50px;
            padding-bottom: 50px;
        }

        .card {
            background-color: #B0B0B0;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .image {
            background-size: cover;
            background-position: center;
            width: 100%;
            height: 200px; /* Fixed height for all images */
        }

        .small{
            
        }

        .details {
            padding: 15px;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            text-align: left;
        }

        .location {
            font-size: 12px;
            color: #fff;
            text-transform: uppercase;
            margin-bottom: 5px;
            display: block;
        }

        .title {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
        }

        .button {
            background-color: #009688;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            display: inline-block;
            margin-top: 10px;
        }

        .button:hover {
            background-color: #00796b;
        }
    </style>
</head>
<body>
    <div class="tourpackagestitle"><br>
        <h1>Tour Packages</h1><br>
    </div>
    <div class="image-grid">
        <?php
        $images = [
            ["location" => "KANDY", "title" => "Queen's Hotel", "image" => "destination_1.jpg", "size" => "large"],
            ["location" => "COLOMBO", "title" => "Lotus Tower", "image" => "destination_2.jpg", "size" => "large"],
            ["location" => "BADULLA", "title" => "Nine Arch Bridge", "image" => "destination_5.jpg", "size" => "small"],
            ["location" => "COLOMBO", "title" => "World Trade Center", "image" => "destination_6.jpg", "size" => "small"],
            ["location" => "MATARA", "title" => "Modern Pedestrian Bridge", "image" => "destination_7.jpg", "size" => "small"],
            ["location" => "MATARA", "title" => "Dondra Lighthouse", "image" => "destination_8.jpg", "size" => "small"],
            ["location" => "KANDY", "title" => "Temple of the Tooth", "image" => "destination_3.jpg", "size" => "large"],
            ["location" => "NUWARA ELIYA", "title" => "Tea Estate", "image" => "destination_4.jpg", "size" => "large"]
        ];

        foreach ($images as $img) {
            echo '<div class="card ' . $img["size"] . '">';
            echo '<a href="viewpackages.php?location=' . urlencode($img["location"]) . '&title=' . urlencode($img["title"]) . '&image=' . urlencode($img["image"]) . '">';
            echo '<div class="image" style="background-image: url(images/' . $img["image"] . ');"></div>';
            echo '<div class="details">';
            echo '<span class="location">' . $img["location"] . '</span>';
            echo '<h3 class="title">' . $img["title"] . '</h3>';
            echo '<button class="button">Get More</button>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
        }
        ?>
    </div>

    <?php include 'footer/footer.php'; ?>
</body>
</html>
