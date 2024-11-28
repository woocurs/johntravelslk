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
            <h1>Privacy Policy</h1>
        </div>

        <div class="terms-container">
            <h3>1. Introduction</h3>
            <p>This policy outlines how John Travels collects, uses, and protects your personal data in compliance with
                applicable privacy laws.</p>

            <h3>2. Data Collection</h3>
            <p>We may collect:</p>
            <ul>
                <li>Personal information (name, contact details, identification)</li>
                <li>Payment details for bookings</li>
                <li>Preferences and feedback</li>
            </ul>

            <h3>3. Use of Data</h3>
            <p>Your data is used to:</p>
            <ul>
                <li>Process bookings and payments</li>
                <li>Customize trip experiences</li>
                <li>Send updates, promotions, and notifications</li>
            </ul>

            <h3>4. Data Sharing</h3>
            <p>We do not share your data with third parties except:</p>
            <ul>
                <li>Service providers essential to trip operations (e.g., accommodations, transport)</li>
                <li>Payment processing platforms</li>
            </ul>

            <h3>5. Security Measures</h3>
            <p>All transactions are secured using SSL encryption. Access to personal data is restricted to authorized
                personnel only.</p>

            <h3>6. Cookies and Tracking</h3>
            <p>We use cookies to improve website functionality and user experience. You can manage cookie preferences in
                your browser settings.</p>

            <h3>7. Your Rights</h3>
            <p>You have the right to:</p>
            <ul>
                <li>Access, correct, or delete your personal data</li>
                <li>Withdraw consent for marketing communications</li>
                <li>File complaints with relevant authorities regarding data misuse</li>
            </ul>

            <h3>8. Changes to the Policy</h3>
            <p>John Travels may update this Privacy Policy to reflect new practices. Changes will be posted on our
                website, and the revised date will be indicated.</p>

            <h3>9. Contact Us</h3>
            <p>For queries about this policy, contact us at <a href="mailto:info@johntravels.lk">info@johntravels.lk</a>
            </p>
        </div>

        <?php include 'footer/footer.php'; ?>
    </div>
</body>

</html>