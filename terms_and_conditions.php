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
            margin-top: 30px;
            color: #3C8DFF;
        }

        .terms-container p {
            padding: 10px 15px;
            color: #888;
            margin-bottom: -10px;
        }

        .terms-container ul {
            margin: 10px 30px;
            padding-left: 20px;
        }

        .terms-container ul li {
            color: #666;
            margin-bottom: 15px;

        }

        .terms-container {
            margin-bottom: 10px;

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
            <h3>1. Agreement Overview</h3>
            <p>By booking a trip or using our website, you agree to comply with the Terms and Conditions outlined below.
                These terms apply to all services provided by Woocurs Tours and may be amended without prior notice.</p>

            <h3>2. Bookings and Payments</h3>
            <ul>
                <li><strong>Booking Process:</strong>
                    <ul>
                        <li>All bookings are subject to availability.</li>
                        <li>A booking is confirmed only upon receipt of full payment or a specified deposit.</li>
                    </ul>
                </li>
                <li><strong>Payment Terms:</strong>
                    <ul>
                        <li>Payments can be made online or via other methods mentioned on our
                            website. Any additional charges (e.g., taxes, late fees) will be communicated during
                            booking.</li>
                    </ul>
                </li>
                <li><strong>Late or Partial Payments:</strong>
                    <ul>
                        <li> Failure to complete payment by the due date may result in
                            cancellation.</li>
                    </ul>
                </li>
            </ul>

            <h3>3. Cancellation and Refund Policies</h3>
            <ul>
                <li><strong>Generic Trips:</strong>
                    <ul>
                        <li>Cancellation made 14+ days prior: 80% refund.</li>
                        <li>Cancellation made 7-14
                            days prior: 50% refund.</li>
                        <li>Cancellation within 7 days: No refund.</li>
                    </ul>
                </li>
                <li><strong>Tailor-Made Trips:</strong> Cancellations are subject to specific arrangements with
                    third-party service providers. Refunds will depend on those arrangements.</li>
                <li><strong>Rescheduling:</strong> Rescheduling is permitted for Generic Trips, subject to availability
                    and at least 7 days' notice. Tailor-Made Trips may involve additional costs.</li>
                <li><strong>Force Majeure:</strong> Refunds are not provided for cancellations due to events beyond our
                    control, including natural disasters, government restrictions, or political instability.</li>
            </ul>

            <h3>4. Safety and Responsibilities</h3>
            <ul>
                <li><strong>Client Responsibilities:</strong>
                    <ul>
                        <li>Clients must disclose medical conditions or special
                            requirements at the time of booking.</li>
                        <li>Compliance with instructions from guides is mandatory for
                            safety.</li>
                    </ul>
                </li>
                <li><strong>Company Responsibilities:</strong>
                    <ul>
                        <li> We ensure activities are conducted with proper equipment
                            and certified professionals.</li>
                        <li>While we take all necessary precautions, Woocurs Tours is not liable for
                            injuries, accidents, or loss of belongings due to negligence or unforeseen events.</li>
                    </ul>
                </li>
            </ul>

            <h3>5. Amendments and Changes</h3>
            <p>We reserve the right to modify itineraries, pricing, or policies at any time. Clients will be notified of
                significant changes promptly.</p>

            <h3>6. Intellectual Property</h3>
            <p>All content, including website text, images, and branding, is the exclusive property of John Travels.
                Unauthorized use is prohibited.</p>

            <h3>7. Jurisdiction and Dispute Resolution</h3>
            <p>These terms are governed by the laws of Sri Lanka. Any disputes must be resolved through arbitration or
                local courts.</p>

            <h3>8. Behavioral Code of Conduct</h3>
            <ul>
                <li><strong>No Alcohol or Drugs:</strong>
                    <ul>
                        <li>Consumption, possession, or distribution of alcohol or illegal
                            drugs is strictly prohibited during all trips.</li>
                        <li>Participants found violating this rule will be
                            removed from the trip immediately without refund.</li>
                    </ul>
                </li>
                <li><strong>No Violence or Harassment:</strong>
                    <ul>
                        <li>Physical violence, verbal abuse, harassment, or any form
                            of discrimination is not tolerated.</li>
                        <li>Violators may face legal action and be banned from future trips.
                        </li>
                    </ul>
                </li>
                <li><strong>Respect for Property and Environment:</strong>
                    <ul>
                        <li>Participants are required to respect
                            accommodations, vehicles, equipment, and natural sites. Any damage caused intentionally or
                            through
                            negligence must be compensated by the responsible party.</li>

                    </ul>
                </li>

            </ul>
            <h3>9. Responsibilities of Participants</h3>
            <ul>
                <li>Ensure you are in a sober and fit state to participate in activities.</li>
                <li>Comply with the instructions and safety guidelines provided by guides or staff at all times.
                </li>
                <li>Avoid any behavior that disrupts the group or endangers others.</li>
            </ul>

            <h3>10. Assumption of Risk</h3>
            <ul>
                <li>Participation in trips and activities offered by Woocurs Tours is entirely at the
                    participant's own
                    risk.</li>
                <li>Adventure activities, including but not limited to snorkeling, diving, trekking, or camping,
                    involve
                    inherent risks, such as injuries, accidents, or equipment failures.</li>
                <li>Participants must assess their physical and mental fitness before engaging in activities.
                </li>
            </ul>

            <h3>11. Liability Waiver</h3>
            <ul>
                <li>By booking a trip, participants agree to waive any claims against Woocurs Tours for:
                    <ul>
                        <li>Injuries, accidents, or health issues that occur during the trip.</li>
                        <li>Loss or damage of personal belongings.</li>
                        <li>Delays or disruptions caused by third-party service providers or natural events.</li>
                    </ul>
                </li>
            </ul>

            <h3>12. Participant Responsibilities</h3>
            <ul>
                <li><strong>Safety Compliance:</strong> Participants must follow all safety instructions
                    provided by
                    guides and staff. Failure to do so may result in removal from the trip without refund.</li>
                <li><strong>Personal Safety:</strong> Carry any necessary personal safety equipment, such as
                    medication,
                    as needed for specific activities. Use provided safety gear (e.g., helmets, life jackets)
                    correctly.
                </li>
                <li><strong>Insurance:</strong> Participants are strongly encouraged to have personal travel or
                    health
                    insurance that covers adventure activities.</li>
            </ul>

            <h3>13. Release of Liability</h3>
            <ul>
                <li>Woocurs Tours is not liable for:
                    <ul>
                        <li>Risks associated with participant negligence, failure to follow instructions, or
                            health
                            issues.</li>
                        <li>Unpredictable events, including but not limited to weather conditions, wildlife
                            interactions, or equipment malfunction.</li>
                    </ul>
                </li>
            </ul>

            <h3>14. Participant Responsibilities</h3>
            <ul>
                <li><strong>Health and Fitness:</strong> Participants must ensure they are physically fit for
                    activities.</li>
                <li><strong>Compliance:</strong> Clients must follow instructions from guides and staff. Failure
                    to do
                    so may result in removal from the trip without refund.</li>
            </ul>

            <h3>15. Privacy and Data Use</h3>
            <p>Personal data collected during booking will be used per our Privacy Policy.</p>

            <h3>16. Intellectual Property</h3>
            <p>All content on our website, including logos, images, and text, is the intellectual property of
                Woocurs Tours. Reproduction without permission is prohibited.</p>

            <h3>17. Amendments to Terms</h3>
            <p>Woocurs Tours reserves the right to amend these Terms and Conditions at any time. Updated versions
                will be
                published on our website.</p>
        </div>

        <?php include 'footer/footer.php'; ?>
    </div>

</body>

</html>