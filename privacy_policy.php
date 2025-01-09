<?php include 'header/header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy</title>
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
            margin-top: 20px;
            color: #3C8DFF;
        }

        .terms-container p {
            padding: 10px 15px;
            margin: 10px 0;
            color: #888;
            margin-bottom: -10px;
        }

        .terms-container ul {
            margin: 10px 30px;
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
            <h1>Privacy Policy</h1>
        </div>

        <div class="terms-container">
            <h3>1. Introduction</h3>
            <p>This Privacy Policy explains how Woocurs Tours collects, uses, and protects your personal data.</p>

            <h3>2. Data Collection</h3>
            <p>We collect the following:</p>
            <ul>
                <li>Personal Information: Name, contact details, identification documents.</li>
                <li>Payment Information: Necessary details to process bookings.</li>
                <li>Preferences: Information provided about trip requirements.</li>
            </ul>

            <h3>3. Use of Data</h3>
            <p>Data is used for:</p>
            <ul>
                <li>Processing bookings and payments.</li>
                <li>Customizing and improving customer experience.</li>
                <li>Sending promotional updates (with consent).</li>
            </ul>

            <h3>4. Sharing of Data</h3>
            <p>Data is shared only with trusted partners required to deliver services (e.g., accommodations, activity
                providers, payment processing platforms).</p>

            <h3>5. Security Measures</h3>
            <ul>
                <li>SSL encryption is used for all online transactions.</li>
                <li>Data access is limited to authorized personnel.</li>
            </ul>

            <h3>6. Cookies and Analytics</h3>
            <ul>
                <li>Cookies are used to track website performance and enhance user experience.</li>
                <li>You can disable cookies in your browser settings.</li>
            </ul>

            <h3>7. Your Rights</h3>
            <ul>
                <li>You can request access to your personal data, correction of inaccuracies, or deletion of data.</li>
                <li>Withdraw consent for marketing communications at any time.</li>
            </ul>

            <h3>8. Changes to Policy</h3>
            <p>Woocurs Tours reserves the right to update this policy at any time. Changes will be posted on our
                website.
            </p>

            <h3>9. Contact Us</h3>
            <p>For questions or concerns about your data, email us at <a
                    href="mailto:info@johntravels.lk">info@johntravels.lk</a>.</p>
        </div>


        <?php include 'footer/footer.php'; ?>
    </div>
</body>

</html>