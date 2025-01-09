<?php include 'header/header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="380x380" href="images/logo.png">
    <title>Woocurs Tours</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        .carousel {
            position: relative;
            height: 120vh;
            width: 100%;
            overflow: hidden;
        }

        .slide {
            position: absolute;
            height: 100%;
            width: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity 1s;
        }

        .slide.active {
            opacity: 1;
        }

        .slide:nth-child(1) {
            background-image: url("images/slider-banner-1.jpg");
        }

        .slide:nth-child(2) {
            background-image: url("images/slider-banner-2.jpg");
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            box-sizing: border-box;
            pointer-events: auto;
        }

        .left-content {
            max-width: 40%;
            padding-left: 100px;
            margin-top: -200px;
        }

        .left-content h1 {
            font-size: 3em;
            margin-top: 20px;
        }

        .left-content p {
            font-size: 1.2em;
            margin: 20px 0;
        }

        .left-content .button {
            display: inline-block;
            padding: 15px 30px;
            background-color: #ff4b4b;
            color: white;
            text-decoration: none;
            font-size: 1.2em;
            border-radius: 3px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            cursor: pointer;
            position: relative;
            z-index: 10;
        }

        .left-content .button:hover {
            background-color: #ff6b6b;
            transform: scale(0.55);
        }

        .right-content {
            max-width: 40%;
            padding-right: 100px;
            text-align: left;
            margin-top: 190px;
        }

        .right-content p {
            font-size: 1em;
            opacity: 0.8;
        }

        .overlay h1 {
            font-size: 4em;
            margin: 0;
            margin-top: -100px;
        }

        .overlay p {
            font-size: 1.2em;
            margin: 20px 0;
        }

        .overlay .button {
            padding: 10px 20px;
            background-color: #ff4b4b;
            color: white;
            text-decoration: none;
        }

        .overlay .button:hover {
            background-color: #00B4D8;
            transform: scale(1.05);
        }

        .scrollclick .prev,
        .scrollclick .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            font-size: 2em;
            color: white;
            background-color: transparent;
            padding: 10px;
            border: none;
            transform: translateY(-50%);
            transition: color 0.3s;
        }

        .scrollclick .prev {
            left: 20px;
        }

        .scrollclick .next {
            right: 20px;
        }

        .scrollclick .prev:hover,
        .scrollclick .next:hover,
        .scrollclick .prev:focus,
        .scrollclick .next:focus {
            color: #313333;
            border: none;
            outline: none;
        }

        @media (max-width: 1200px) {

            .left-content,
            .right-content {
                max-width: 70%;
                padding: 15px;
            }

        }

        @media (max-width: 992px) {
            .overlay {
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 10px;
            }

            .left-content,
            .right-content {
                max-width: 100%;
                margin: 0;
                padding: 20px;
                text-align: center;
            }

            .left-content h1,
            .overlay h1 {
                font-size: 2.5em;
            }

            .left-content p,
            .overlay p {
                font-size: 1em;
                margin: 15px 0;
            }
        }

        @media (max-width: 768px) {
            .navbar .nav-item .nav-link {
                font-size: 14px;
                padding: 8px;
            }

            .left-content,
            .right-content {
                padding: 5px 15px;
            }

            .overlay {
                padding: 10px;
            }

            .overlay h1 {
                font-size: 1.8em;
            }

            .left-content h1 {
                margin-bottom: 10px;
            }

            .left-content p {
                padding: 5px 0;
            }
        }

        @media (max-width: 576px) {

            .overlay {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                text-align: center;
                padding: 60px;
            }

            .left-content h1 {
                font-size: 2.0em;
                margin-bottom: 10px;
            }

            .left-content p {
                font-size: 1.0em;
                padding: 15px;
                margin-bottom: 15px;
                color: #ffffff;
                border-radius: 8px;
            }

            .left-content .button {
                font-size: 1.0em;
                padding: 8px 15px;
                margin-bottom: 15px;
                margin-top: 15px;
                border-radius: 5px;
            }

            .right-content {
                text-align: center;
                margin-top: 0px;
            }

            .right-content p {
                font-size: 1.0em;
                padding: 15px;
                color: #ffffff;
                border-radius: 8px;
            }

            .scrollclick .prev,
            .scrollclick .next {
                font-size: 1.0em;
            }
        }

        @media (max-width: 576px) {
            .left-content h1 {
                font-size: 2.0em;
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="carousel">

        <!-- Slide 1 -->
        <div class="slide active">
            <div class="overlay">
                <div class="left-content">
                    <h1>Explore the Pearl of Indian Ocean</h1>
                    <p>Experience the adventures of Mirabilis: eat, sleep, hike, climb, fly, jump, swim, snorkel, surf,
                        and dive.</p>
                    <a href="tourpackages.php" class="button">Explore More</a>
                </div>
                <div class="right-content">
                    <p>Mirabilis awaits with endless experiences in a land of lush landscapes, stunning beaches, and
                        vibrant culture.</p>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="slide">
            <div class="overlay">
                <div class="left-content">
                    <h1>Let's Make Memories</h1>
                    <p>Make unforgettable memories with romantic and adventurous experiences.</p>
                    <a href="tourpackages.php" class="button">Explore More</a>
                </div>
                <div class="right-content">
                    <p>Find joy in every moment, from scenic sunsets to thrilling outdoor activities.</p>
                </div>
            </div>
        </div>

        <!-- Navigation buttons -->
        <div class="scrollclick">
            <button class="prev" onclick="changeSlide(-1)">&#10094;</button>
            <button class="next" onclick="changeSlide(1)">&#10095;</button>
        </div>
    </div>

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');

        function changeSlide(direction) {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + direction + slides.length) % slides.length;
            slides[currentSlide].classList.add('active');
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php include 'footer/footer.php'; ?>
</body>

</html>