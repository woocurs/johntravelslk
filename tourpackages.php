<?php include 'header/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Image Grid</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
            text-decoration: none; 
        }

       
        a:hover, a:focus {
            text-decoration: none !important; 
        }

       
        a.location, a.title {
            text-decoration: none; 
            border-bottom: 2px solid transparent; 
        }

        a.location:hover, a.title:hover,
        a.location:focus, a.title:focus {
            border-bottom: 2px solid #009688;
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


        .popup-content {
            position: relative;
            display: inline-block;
        }

        .popup-content img {
            max-width: 100%;
            border-radius: 5px;
        }

        .download-btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background-color: #009688;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .download-btn i {
            font-size: 16px;
        }

        .download-btn:hover {
            background-color: #00796b;
            transform: scale(1.05);
        }
        /* Popup styles */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            max-width: 490px;
            height: auto;
            max-height: 600px;
            background-color: white;
            border-radius: 3px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            z-index: 10;
            padding: 20px;
            text-align: center;
            overflow: auto;
        }

        .popup img {
            width: auto !important; 
            max-width: 100% !important; 
            height: 550px !important; 
        }

        .popup-content {
            position: relative;
            display: inline-block;
        }

        .popup-content img {
            max-width: 100%;
            border-radius: 5px;
        }
        .close {
            cursor: pointer;
        }
        

        .download-btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background-color: black;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-bottom: 10px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .download-btn i {
            font-size: 16px;
        }

        .download-btn:hover {
            background-color: #00796b;
            border: none !important; 
            outline: none !important;
            transform: scale(1.05);
        }


        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 9;
        }
        .overlay, .popup {
            transition: none !important;
        }
                .details .icon {
            position: absolute; 
            right: 10px; 
            top: 10px; 
            font-size: 18px; 
            color: white; 
            cursor: pointer; 
            z-index: 4; 
            transition: transform 0.2s ease, color 0.3s ease;
        }

        .details .icon:hover {
            transform: scale(1.2); 
            color: #009688; 
        }
        

      
       @media (max-width: 768px) {
            .tourpackagestitle {
                font-size: 2em;
                min-height: 40vh;
            }
            .tourpackagestitle::after {
                height: 40%; 
                bottom: -50px; 
            }

            .image-grid {
                padding: 40px; 
                gap: 5px;
            }

            .image {
                height: 300px; 
                width: 100%;
            }

            .image.small {
                height: 150px; 
                margin-right: 20px;
            }

            .button, .buttonbook {
                font-size: 10px; 
                padding: 3px 8px; 
            }
        }

        @media (max-width: 580px) {
            .tourpackagestitle {
                font-size: 1.5em;
                text-align: center;
                padding: 10px;
            }

            .tourpackagestitle::after {
                height: 20%; 
                bottom: -30px; 
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
    
    <div class="tourpackagestitle">
        <h1>Tour Packages</h1>
    </div>
    
    <div class="image-grid">
        <?php
        $images = [
            ["location" => "KANDY", "title" => "Queen's Hotel", "image" => "destination_1.jpg", "size" => "large"],
            ["location" => "Colombo", "title" => "Lotus Tower", "image" => "destination_2.jpg", "size" => "large"],
            ["location" => "Batticaloa", "title" => "Pasikudah Beach", "image" => "destination_3.jpg", "size" => "large"],
            ["location" => "NUWARA ELIYA", "title" => "Tea Estate", "image" => "destination_4.jpg", "size" => "large"],
            ["location" => "Badulla", "title" => "Nine Arch Bridge", "image" => "destination_5.jpg", "size" => "small"],
            ["location" => "Matale", "title" => "Riverston", "image" => "destination_6.jpg", "size" => "small"],
            ["location" => "Trincomalee", "title" => "Kinniya Bridge", "image" => "destination_7.jpg", "size" => "small"],
            ["location" => "Anuradhapura", "title" => "Sigiriya", "image" => "destination_8.jpg", "size" => "small"]
        ];

        $popupImages = [
            "Kandy.png", "Galle_Matara_Colombo.png", "batticaloa.png", 
            "NuwaraEliya.png",  "Badulla.png", "Matale.png",
            "Trincomalee.png", "Anuradhapura_Dambulla_Sigiriya.png"
        ];
        
        $counter = 0;
            
        foreach ($images as $img) {
            echo '<div class="card">';
            echo '<a href="viewpackages.php?location=' . urlencode($img["location"]) . '&title=' . urlencode($img["title"]) . '&image=' . urlencode($img["image"]) . '">';
            echo '<div class="image ' . ($img["size"] === "small" ? "small" : "") . '" style="background-image: url(images/' . $img["image"] . ');"></div>';
            echo '<div class="details">';
            echo '<span class="location">' . $img["location"] . '</span>';
            echo '<h3 class="title">' . $img["title"] . '</h3>';
            echo '<button class="button">Get More</button>';
            echo '<a href="tour_booking.php?location=' . urlencode($img["location"]) . '&title=' . urlencode($img["title"]) . '&image=' . urlencode($img["image"]) . '">';
            echo '<button class="buttonbook">Book Now</button></a>';
            echo '<i class="fas fa-expand icon" onclick="event.stopPropagation(); openPopup(\'images/' . $popupImages[$counter] . '\')"></i>';
            echo '</div></a></div>';
            $counter++;
        }        
        ?>
    </div>
    
    <div class="overlay" onclick="closePopup()"></div>

    <div class="popup">
    <span class="close" onclick="closePopup()">×</span>
    <div class="popup-content">
        <img id="popup-img" src="" alt="Image">
        <button class="download-btn" onclick="downloadImage()">
            <i class="fas fa-download"></i> Download
        </button>
    </div>
</div>


<script>
    
    document.querySelector('.overlay').style.display = 'none';
    document.querySelector('.popup').style.display = 'none';

    
    function openPopup(imageSrc) {
        document.querySelector('.overlay').style.display = 'block';
        document.querySelector('.popup').style.display = 'block';
        document.getElementById('popup-img').src = imageSrc;
    }

    
    function closePopup() {
        document.querySelector('.overlay').style.display = 'none';
        document.querySelector('.popup').style.display = 'none';
    }

    
    function downloadImage() {
        const imageSrc = document.getElementById('popup-img').src; 
        const link = document.createElement('a'); 
        link.href = imageSrc;
        link.download = imageSrc.split('/').pop(); 
        link.click(); 
    }

    
    window.addEventListener('load', function() {
        
        setTimeout(function() {
            document.querySelector('.overlay').style.display = 'none';
            document.querySelector('.popup').style.display = 'none';
        }, 200); 
    });
</script>

    <?php include 'footer/footer.php'; ?>
</body>
</html>
