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
            background: url('images/inner-banner.jpg') no-repeat center center / cover;
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
            font-family: 'Playfair Display', Georgia, serif; 
            font-size: 2.3em; 
            margin-top: -50px; 
        }

        .image-grid {
            display: grid;
            background-color: #FAFAFA;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 10px;
            padding: 50px 150px;
        }

        .card {
            background-color: #B0B0B0;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .image {
            background-size: cover;
            background-position: center;
            width: 100%;
            height: 400px;
        }

        .image.small {
            background-size: cover;
            background-position: center;
            width: 100%;
            height: 230px;
            float: left;
            margin-right: 50px;
        }

        .details {
            padding: 15px;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.5);
            color: white;
        }

        .location {
            font-size: 12px;
            text-transform: uppercase;
            margin-bottom: 5px;
            color: white;
        }

        .title {
            font-size: 16px;
            font-weight: bold;
            color: white;
        }

        a {
            text-decoration: none; /* Ensure no underline globally */
        }

        /* Override hover effects on links */
        a:hover, a:focus {
            text-decoration: none !important; /* Ensure no underline on hover/focus */
        }

        /* Links inside .card */
        a.location, a.title {
            text-decoration: none; /* Remove underline */
            border-bottom: 2px solid transparent; /* Invisible border */
        }

        a.location:hover, a.title:hover,
        a.location:focus, a.title:focus {
            border-bottom: 2px solid #009688; /* Custom hover effect without underline */
        }

        .button {
            background-color: #009688;
            color: white;
            border: none !important; 
            outline: none !important;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            margin-top: 10px;
        }

        .button:hover {
            background-color: #00796b;
            transform: scale(1.05);
        }

        .buttonbook {
            background-color: #009688;
            color: white;
            border: none !important; 
            outline: none !important;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            display: inline-block;
            margin-top: 10px;
            margin-left: 7px;
        }

        .buttonbook:hover {
            background-color: #00796b;
            color: #fff; 
            border: none; 
            transform: scale(1.05);
        }

       /* Responsive Styles */
       @media (max-width: 768px) {
            .tourpackagestitle {
                font-size: 2em; /* Reduce font size on small screens */
                min-height: 40vh;
            }
            .tourpackagestitle::after {
                height: 40%; /* Reduce height on smaller screens */
                bottom: -50px; /* Adjust spacing */
            }

            .image-grid {
                padding: 40px; /* Reduce padding */
                gap: 5px;
            }

            .image {
                height: 300px; /* Adjust height for smaller screens */
                width: 100%;
            }

            .image.small {
                height: 150px; /* Smaller height for small images */
                margin-right: 20px;
            }

            .button, .buttonbook {
                font-size: 10px; /* Smaller button font size */
                padding: 3px 8px; /* Adjust padding */
            }
        }

        @media (max-width: 580px) {
            .tourpackagestitle {
                font-size: 1.5em;
                text-align: center;
                padding: 10px;
            }

            .tourpackagestitle::after {
                height: 20%; /* Reduce height on smaller screens */
                bottom: -30px; /* Adjust spacing */
            }

            .image-grid {
                padding: 60px;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }

            .image {
                width: 100%;
                height: 400px;
            }

            .image.small {
                height: 190px;
            }
        } 
        
    </style>
</head>
<body>
    <?php include 'header/header.php'; ?>

    <div class="tourpackagestitle">
        <h1>Tour Packages</h1>
    </div>
    
    <div class="image-grid">
        <?php
        $images = [
            ["location" => "KANDY", "title" => "Queen's Hotel", "image" => "destination_1.jpg", "size" => "large"],
            ["location" => "COLOMBO", "title" => "Lotus Tower", "image" => "destination_2.jpg", "size" => "large"],
            ["location" => "KANDY", "title" => "Temple of the Tooth", "image" => "destination_3.jpg", "size" => "large"],
            ["location" => "NUWARA ELIYA", "title" => "Tea Estate", "image" => "destination_4.jpg", "size" => "large"],
            ["location" => "BADULLA", "title" => "Nine Arch Bridge", "image" => "destination_5.jpg", "size" => "small"],
            ["location" => "COLOMBO", "title" => "World Trade Center", "image" => "destination_6.jpg", "size" => "small"],
            ["location" => "MATARA", "title" => "Modern Pedestrian Bridge", "image" => "destination_7.jpg", "size" => "small"],
            ["location" => "MATARA", "title" => "Dondra Lighthouse", "image" => "destination_8.jpg", "size" => "small"]
        ];

        foreach ($images as $img) {
            echo '<div class="card">';
            echo '<a href="viewpackages.php?location=' . urlencode($img["location"]) . '&title=' . urlencode($img["title"]) . '&image=' . urlencode($img["image"]) . '">';
            echo '<div class="image ' . ($img["size"] === "small" ? "small" : "") . '" style="background-image: url(images/' . $img["image"] . ');"></div>';
            echo '<div class="details">';
            echo '<span class="location">' . $img["location"] . '</span>';
            echo '<h3 class="title">' . $img["title"] . '</h3>';
            echo '<button class="button">Get More</button>';
            echo '<a href="booking.php?location=' . urlencode($img["location"]) . '&title=' . urlencode($img["title"]) . '&image=' . urlencode($img["image"]) . '">';
            echo '<button class="buttonbook">Book Now</button>';
            echo '</div></a></div>';
        }
        ?>
    </div>

    <?php include 'footer/footer.php'; ?>
</body>
</html>
