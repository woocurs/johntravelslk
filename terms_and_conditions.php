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

        .back {
            background-color: #FAFAFA;
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

        .terms-container {
            background-color: #FAFAFA;
            color: #333;
            padding: 30px;
            margin: 20px auto;
            max-width: 800px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .terms-container h3 {
            font-size: 1.2em;
            margin-top: 15px;
            color: #3C8DFF;
        }

        .terms-container p {
            padding: 10px 15px;
            margin: 10px 0;
            color: #888;
        }

        .terms-container ul {
            margin: 10px 0;
            padding-left: 20px;
        }

        .terms-container ul li {
            color: #666;
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

        @media (max-width: 1200px) {
            .tourpackagestitle h1 {
                font-size: 2.2em;
            }
        }

        @media (max-width: 992px) {
            .tourpackagestitle h1 {
                font-size: 1.8em;
            }

            .terms-container {
                max-width: 90%;
                padding: 20px;
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

            .terms-container h3 {
                font-size: 1.1em;
            }

            .terms-container p,
            .terms-container ul {
                font-size: 0.9em;
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

            .terms-container h3 {
                font-size: 1em;
            }

            .terms-container p,
            .terms-container ul {
                font-size: 0.8em;
            }

            .tourpackagestitle::after {
                margin-bottom: -20px;
            }
        }
    </style>
</head>

<body>
    <div class="back">
        <div class="tourpackagestitle">
            <h1>Terms and Conditions</h1>
        </div>

        <div class="terms-container">
            <h3>1. Introduction</h3>
            <p>These Terms and Conditions govern the use of services provided by John Travels (referred to as “we,”
                “us,” or “our”). By booking a trip or using our website, you agree to these terms.</p>

            <h3>2. Booking and Payment Policies</h3>
            <p><strong>Booking Confirmation:</strong> Bookings are confirmed upon receipt of full payment or a specified
                deposit.</p>
            <p><strong>Payment Methods:</strong> Payments can be made via bank transfer, credit/debit cards, or other
                methods as specified on our website.</p>
            <p><strong>Late Payments:</strong> Delayed payments may result in booking cancellation or rescheduling fees.
            </p>

            <h3>3. Cancellation and Refund Policies</h3>
            <p><strong>Generic Trips:</strong></p>
            <ul>
                <li>Cancellations made more than 14 days prior: 80% refund.</li>
                <li>Cancellations made 7-14 days prior: 50% refund.</li>
                <li>Cancellations within 7 days: No refund.</li>
            </ul>
            <p><strong>Tailor-Made Trips:</strong> Refunds depend on specific arrangements with service providers.</p>
            <p><strong>Force Majeure:</strong> No refunds for cancellations due to natural disasters, political unrest,
                or other uncontrollable events.</p>

            <h3>4. Amendments to Itineraries</h3>
            <p>We reserve the right to modify itineraries due to weather, safety, or operational concerns. Clients will
                be notified promptly.</p>

            <h3>5. Participant Responsibilities</h3>
            <p><strong>Health and Fitness:</strong> Participants must ensure they are physically fit for activities.</p>
            <p><strong>Compliance:</strong> Clients must follow instructions from guides and staff. Failure to do so may
                result in removal from the trip without refund.</p>

            <h3>6. Liability</h3>
            <p>We are not liable for:</p>
            <ul>
                <li>Personal injury, loss, or damage due to negligence or unforeseen events.</li>
                <li>Delays or disruptions caused by third-party services or transportation issues.</li>
            </ul>

            <h3>7. Privacy and Data Use</h3>
            <p>Personal data collected during booking will be used per our Privacy Policy.</p>

            <h3>8. Intellectual Property</h3>
            <p>All content on our website, including logos, images, and text, is the intellectual property of John
                Travels. Reproduction without permission is prohibited.</p>

            <h3>9. Amendments to Terms</h3>
            <p>John Travels reserves the right to amend these Terms and Conditions at any time. Updated versions will be
                published on our website.</p>
        </div>

        <?php include 'footer/footer.php'; ?>
    </div>
</body>

</html>