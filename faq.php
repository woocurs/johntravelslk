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
            color: #3C8DFF;
            cursor: pointer;
            display: flex;
            align-items: center;
            padding: 10px 0;
        }

        .faq-item h3 i {
            margin-right: 10px;
        }

        .faq-item p,
        .faq-item ul {
            margin: 0;
            font-size: 1em;
            line-height: 1.5;
            display: none;
            padding-left: 30px;
            transition: all 0.3s ease;
            color: #666;
        }

        .faq-item ul {
            list-style-type: disc;
            margin-top: 10px;
        }

        .faq-item.active p,
        .faq-item.active ul {
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
                <ul>
                    <li><strong>Generic Trips:</strong> These are pre-planned trips lasting 1-3 days, focused on a
                        single
                        destination in Sri Lanka. These trips are open to individuals, families, and groups. We manage
                        all
                        arrangements, from transportation to activities.</li>
                    <li><strong>Tailor-Made Trips:</strong> Customizable trips created to match your unique preferences,
                        including destination, duration, and activities. These are ideal for private groups or specific
                        needs.</li>
                </ul>
            </div>

            <div class="faq-item">
                <h3><i class="fas fa-chevron-right"></i> What activities can I expect on these trips?</h3>
                <p>Activities vary by package but may include:</p>
                <ul>
                    <li><strong>Adventure Sports:</strong> Such as zip-lining, trekking, or cycling.</li>
                    <li><strong>Water Activities:</strong> Snorkeling, diving, boat rides, or fishing.</li>
                    <li><strong>Camping:</strong> Overnight stays in scenic locations with all camping gear provided.
                    </li>
                    <li><strong>Grills & BBQs:</strong> Delicious outdoor meals in a relaxing environment.</li>
                    <li><strong>Cultural and Nature Tours:</strong> Visits to heritage sites, national parks, or
                        eco-friendly activities.</li>
                </ul>
            </div>

            <div class="faq-item">
                <h3><i class="fas fa-chevron-right"></i> How do I book a trip?</h3>
                <p>Browse our website at <a href="mailto:info@johntravels.lk">info@johntravels.lk</a>. to explore
                    available packages. Use the booking
                    form to secure your trip and make payments online or via specified methods.</p>
            </div>

            <div class="faq-item">
                <h3><i class="fas fa-chevron-right"></i> Are there any age or fitness restrictions?</h3>
                <p>While many trips are family-friendly, certain activities (e.g., snorkeling or adventure sports) may
                    have age, health, or fitness restrictions. These will be mentioned in the package details.</p>
            </div>

            <div class="faq-item">
                <h3><i class="fas fa-chevron-right"></i> What is included in the trip package?</h3>
                <p>Depending on the package, inclusions typically cover:</p>
                <ul>
                    <li>Round-trip transportation.</li>
                    <li>Accommodation (hotels, lodges, or campsites).</li>
                    <li>Meals and refreshments.</li>
                    <li>Activity fees and permits.</li>
                    <li>Professional guides and support staff.</li>
                </ul>
            </div>

            <div class="faq-item">
                <h3><i class="fas fa-chevron-right"></i> Can I cancel or reschedule a booking?</h3>
                <p>Yes, you may cancel or request a reschedule, subject to our cancellation policies outlined in the
                    Terms and Conditions.</p>
            </div>

            <div class="faq-item">
                <h3><i class="fas fa-chevron-right"></i> What happens in case of an emergency?</h3>
                <p>Our team is trained to handle emergencies. We provide first aid kits, emergency contact numbers, and
                    evacuation plans for all activities.</p>
            </div>

            <div class="faq-item">
                <h3><i class="fas fa-chevron-right"></i> What safety measures are in place?</h3>
                <ul>
                    <li>Certified and tested equipment is used for all activities.</li>
                    <li>Trained professionals supervise high-risk activities like diving or adventure sports.</li>
                    <li>Insurance coverage options may be available for participants.</li>

                </ul>
            </div>

            <div class="faq-item">
                <h3><i class="fas fa-chevron-right"></i> Can I request special arrangements?</h3>
                <p>Yes, we can accommodate dietary needs, medical concerns, or other special requests. Please inform us
                    during booking.</p>
            </div>

            <div class="faq-item">
                <h3><i class="fas fa-chevron-right"></i> What if the weather disrupts the trip?</h3>
                <p>In cases of extreme weather or unforeseen circumstances, we will either reschedule the trip or
                    provide alternative arrangements.</p>
            </div>

            <div class="faq-item">
                <h3><i class="fas fa-chevron-right"></i> What are the behavioral guidelines for trips?</h3>
                <p>For the safety and comfort of all participants, <strong>alcohol consumption, drug use, or disruptive
                        behavior
                        is strictly prohibited</strong> during trips. Violators may be removed from the trip without
                    refund.</p>
            </div>

            <div class="faq-item">
                <h3><i class="fas fa-chevron-right"></i> How are safety and security maintained during trips? </h3>
                <p>Our team enforces strict safety guidelines, including the prohibition of alcohol or drug use. Guides
                    and staff are trained to handle emergencies and maintain a secure environment.</p>
            </div>
            <div class="faq-item">
                <h3><i class="fas fa-chevron-right"></i> What happens if a participant violates the rules?</h3>
                <p>Violations of our code of conduct (e.g., drug use, harassment, or property damage) will result in
                    immediate removal from the trip, and any additional costs will be the responsibility of the
                    violator.</p>
            </div>

            <div class="faq-item">
                <h3><i class="fas fa-chevron-right"></i> What safety precautions are in place?</h3>
                <p>While we prioritize safety by providing certified equipment, experienced guides, and adhering to
                    government safety regulations, all activities are <strong>undertaken at the participant’s own
                        risk.</strong>
                    Participants are responsible for assessing their own fitness and readiness for any activity.</p>
            </div>

            <div class="faq-item">
                <h3><i class="fas fa-chevron-right"></i> What happens in case of injury or loss during the trip?</h3>
                <p>John Travels will assist with immediate support (e.g., first aid or arranging transport to medical
                    facilities). However, participants are required to sign a waiver acknowledging that they participate
                    in all activities at their <strong>own risk, </strong>and the company is not liable for injuries,
                    loss, or damage
                    caused by unforeseen events or personal negligence.</p>
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