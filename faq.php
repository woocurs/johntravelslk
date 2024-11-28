<?php include 'header/header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        html,
        body {
            font-family: Arial, sans-serif;
            background-color: #FAFAFA;
            margin: 0;
            color: #333;
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
            font-size: 1.8em;
            margin-top: -50px;
        }

        .back {
            background-color: #FAFAFA;
        }

        .faq-section {
            background-color: #FAFAFA;
            color: #333;
            padding: 30px;
            margin: 20px auto;
            max-width: 750px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .faq-item {
            margin-bottom: 20px;
        }

        .faq-item h3 {
            font-size: 1.2em;
            margin: 0 0 8px 0;
            color: #555555;
            cursor: pointer;
            display: flex;
            align-items: center;
            padding: 10px 0;
        }

        .faq-item h3 i {
            margin-right: 10px;
        }

        .faq-item p {
            margin: 0;
            font-size: 1em;
            line-height: 1.5;
            display: none;
            padding-left: 30px;
            transition: all 0.3s ease;
            color: #2A74D4;
        }

        .faq-item.active p {
            display: block;
        }

        .faq-item:hover h3 {
            color: #e57373;
        }

        @media (max-width: 1000px) and (min-width: 880px) {
            .tourpackagestitle::after {
                margin-bottom: -10px;
            }
        }

        @media (max-width: 880px) and (min-width: 768px) {
            .tourpackagestitle::after {
                margin-bottom: -40px;
            }
        }

        @media (max-width: 768px) {
            .tourpackagestitle {
                font-size: 2em;
                min-height: 40vh;
            }

            .tourpackagestitle h1 {
                font-size: 1.5em;
                margin-top: -30px;
            }

            .faq-section {
                padding: 20px;
                max-width: 100%;
                margin: 10px;
            }

            .faq-item h3 {
                font-size: 1em;
            }

            .faq-item p {
                font-size: 0.9em;
                padding-left: 20px;
            }

            .tourpackagestitle::after {
                margin-bottom: -20px;
            }
        }

        @media (max-width: 480px) {

            .tourpackagestitle {
                font-size: 1.5em;
                min-height: 35vh;
            }

            .tourpackagestitle h1 {
                font-size: 1.2em;
                margin-top: -20px;
            }

            .faq-section {
                padding: 15px;
            }

            .faq-item h3 {
                font-size: 0.9em;
            }

            .faq-item p {
                font-size: 0.8em;
                padding-left: 15px;
            }

            .tourpackagestitle::after {
                margin-bottom: -20px;
            }
        }
    </style>
    </style>
</head>

<body>
    <div class="back">
        <div class="tourpackagestitle">
            <h1>Frequently Asked Questions</h1>
        </div>

        <div class="faq-section">
            <div class="faq-item">
                <h3><i class="fas fa-chevron-right"></i> What types of trips does John Travels offer?</h3>
                <p>We provide two main types of tours:<br>
                    Generic Trips: Pre-scheduled trips to specific destinations in Sri Lanka, typically lasting 1-3
                    days. These trips are open to individuals and groups and include set itineraries.<br>
                    Tailor-Made Trips: Customized trips designed based on clients' preferences, including destinations,
                    duration, and activities.

                </p>
            </div>

            <div class="faq-item">
                <h3><i class="fas fa-chevron-right"></i> Are your tours only local?</h3>
                <p>Yes, all our tours focus on exploring the beauty and culture of Sri Lanka, offering both adventure
                    and relaxation opportunities.</p>
            </div>

            <div class="faq-item">
                <h3><i class="fas fa-chevron-right"></i> What activities are included in the trips?</h3>
                <p>Depending on the package, activities may include:<br>
                    Adventure sports<br>
                    Camping<br>
                    Grills & BBQs<br>
                    Snorkeling and diving<br>
                    Boat riding<br>
                    Group get-togethers<br>
                    Nature treks and cultural explorations</p>

            </div>

            <div class="faq-item">
                <h3><i class="fas fa-chevron-right"></i> What is included in the trip cost?</h3>
                <p>Costs typically cover :<br>Transportation (to and from the destination)<br>Accommodation<br>Meals
                    and refreshments<br> Activity fees (e.g., equipment rental, guide services)<br>Necessary permits.
                </p>
            </div>

            <div class="faq-item">
                <h3><i class="fas fa-chevron-right"></i> How do I book a trip?</h3>
                <p>Visit our website at johntravels.lk to view available packages. Use the booking form to confirm your
                    trip and complete payment online.
                </p>
            </div>

            <div class="faq-item">
                <h3><i class="fas fa-chevron-right"></i> Can I modify or cancel my booking?</h3>
                <p>Yes, you may request modifications or cancellations. Policies regarding refunds and changes vary by
                    trip type. Refer to our Terms and Conditions for full details.</p>
            </div>

            <div class="faq-item">
                <h3><i class="fas fa-chevron-right"></i> Are the trips safe?</h3>
                <p>Safety is our highest priority. We ensure:<br>
                    Certified equipment for activities<br>
                    Experienced and licensed guides<br>
                    Adherence to government safety protocols and regulations<br>

                </p>
            </div>

            <div class="faq-item">
                <h3><i class="fas fa-chevron-right"></i> Can I request special accommodations?</h3>
                <p>Yes, please inform us during booking about dietary restrictions, medical needs, or other special
                    requirements.</p>
            </div>

            <div class="faq-item">
                <h3><i class="fas fa-chevron-right"></i> What happens in case of bad weather or unforeseen
                    circumstances?</h3>
                <p>In such cases, we may adjust itineraries or reschedule trips. Clients will be informed promptly, and
                    alternative arrangements will be offered.</p>
            </div>
        </div>


        <script>
            // Toggle FAQ content visibility
            document.querySelectorAll('.faq-item h3').forEach(item => {
                item.addEventListener('click', () => {
                    const parent = item.parentElement;
                    parent.classList.toggle('active');
                });
            });
        </script>

        <?php include 'footer/footer.php'; ?>
    </div>
</body>

</html>