<?php include("header/header.php"); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonials - John Travels LK</title>
	   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="styles/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-image: url('images/bannaer_3.jpg');
            background-size: cover;
            background-position: center;
        }

      .container {
    max-width: 1200px;
    margin: 30px auto;
    padding: 20px;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(230, 230, 250, 0.9));
    border-radius: 15px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2), 0 6px 6px rgba(0, 0, 0, 0.15);
    border: 1px solid rgba(0, 0, 0, 0.1);
    overflow: hidden;
    animation: fadeIn 1.2s ease-in-out;
}

/* Add fade-in animation for a smooth appearance */
@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Optional hover effect for dynamic styling */
.container:hover {
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3), 0 8px 8px rgba(0, 0, 0, 0.2);
    transform: scale(1.02);
    transition: all 0.3s ease;
}

        h1 {
            text-align: center;
           color:darkblue;
            margin-bottom: 20px;
        }

        .testimonial-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .testimonial {
            flex: 1 1 calc(33.333% - 20px);
            max-width: calc(33.333% - 20px);
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 10px;
            background-color: #f9f9f9;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .testimonial img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
            border: 2px solid #00B4D8;
        }

        .testimonial .message {
            font-style: italic;
            color: #555;
            margin: 10px 0;
        }

        .testimonial .customer-name {
            font-weight: bold;
            color: #00B4D8;
            margin-bottom: 5px;
        }

        .testimonial .rating {
            color: #ffcc00;
            font-size: 1.2rem;
        }

        @media (max-width: 768px) {
            .testimonial {
                flex: 1 1 calc(50% - 20px);
                max-width: calc(50% - 20px);
            }
        }

        @media (max-width: 480px) {
            .testimonial {
                flex: 1 1 100%;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>


<section class="testimonials">
    <div class="container">
        <h1>What Our Customers Say</h1>
        <div class="testimonial-list">
            <div class="testimonial">
                <img src="images/customer1.png" alt="Sarah W">
                <p class="message">"An amazing experience! The tour was well-organized, and the guides were very friendly and knowledgeable."</p>
                <p class="customer-name">- Sarah W.</p>
                <p class="rating">⭐⭐⭐⭐⭐</p>
            </div>
            <div class="testimonial">
                <img src="images/customer4.png" alt="Mark L">
                <p class="message">"John Travels made our vacation unforgettable. We visited beautiful locations and had a wonderful time!"</p>
                <p class="customer-name">- Mark L.</p>
                <p class="rating">⭐⭐⭐⭐⭐</p>
            </div>
            <div class="testimonial">
                <img src="images/customer2.png" alt="Priya D">
                <p class="message">"Great service and a fantastic tour! Highly recommended for anyone looking to explore the best spots."</p>
                <p class="customer-name">- Priya D.</p>
                <p class="rating">⭐⭐⭐⭐⭐</p>
            </div>
            <!-- Add more testimonials as needed -->
        </div>
    </div>
</section>

<?php include("footer/footer.php"); ?>
</body>
</html>