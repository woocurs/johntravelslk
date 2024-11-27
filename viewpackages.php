<?php

$packages = [
    [
        'title' => 'Kandy',
        'days' => 1,
        'places' => [
            'Kandy Royal Botanical Garden',
            'Sri Thalatha Sri Maligawa',
            'Ambuluwewa Tower – Gampola',
            'Matale Muththumariyamman Temple'
        ],
        'package_includes' => [
            'Up and Down',
            'Tickets',
            'Videos',
            'Excepts – Ride',
            'Tour Guide'
        ],
        'phone' => '+94762450858',
        'price' => 'Rs 3900 /person',
        'image' => 'kandy.jpg'
    ],
    [
        'title' => 'Galle',
        'days' => 2,
        'places' => [
            'Galle Dutch Fort',
            'Galle Light House',
            'Maritime Museum',
            'National Museum Clock Tower Galle',
            'Lotus Tower'
        ],
        'package_includes' => [
            'Up and Down',
            'Tickets',
            'Videos',
            'Excepts – Ride',
            'Tour Guide'
        ],
        'phone' => '+94762450858',
        'price' => 'Rs 11900 /person',
        'image' => 'colombo.jpg'
    ],
    [
        'title' => 'Batticaloa',
        'days' => 2,
        'places' => [
            'Pasikudah Beach',
            'Oluvil Lighthouse',
            'Kinniya Bridge',
            'Gal Oya National Park',
            'Batticaloa Lagoon'
        ],
        'package_includes' => [
            'Up and Down',
            'Tickets',
            'Videos',
            'Excepts – Ride',
            'Tour Guide'
        ],
        'phone' => '+94762450858',
        'price' => 'Rs 7900 /person',
        'image' => 'batticaloa.png'
    ],
    [
        'title' => 'Nuwara Eliya',
        'days' => 2,
        'places' => [
            'Post Office',
            'Gregory Park',
            'World End',
            'Deer'
        ],
        'package_includes' => [
            'Up and Down',
            'Tickets',
            'Videos',
            'Excepts – Ride',
            'Tour Guide'
        ],
        'phone' => '+94762450858',
        'price' => 'Rs 5900 /person',
        'image' => 'nuwara_eliya.jpg'
    ],
    [
        'title' => 'Badulla',
        'days' => 1,
        'places' => [
            'Bandarawela',
            'Haputale',
            'Ella',
            'Ravana Ella',
            'Dunhinda'
        ],
        'package_includes' => [
            'Up and Down',
            'Tickets',
            'Videos',
            'Excepts – Ride',
            'Tour Guide'
        ],
        'phone' => '+94762450858',
        'price' => 'Rs 4900 /person',
        'image' => 'badulla.jpg'
    ],
    [
        'title' => 'Matale',
        'days' => 1,
        'places' => [
            'Sembuwatta Lake',
            'Bambarakiri Ellla',
            'Reverston'
        ],
        'package_includes' => [
            'Up and Down',
            'Tickets',
            'Videos',
            'Excepts – Ride',
            'Tour Guide'
        ],
        'phone' => '+94762450858',
        'price' => 'Rs 3900 /person',
        'image' => 'matale.jpg'
    ],
    [
        'title' => 'Trincomalee',
        'days' => 1,
        'places' => [
            'Koneswaram Temple',
            'Dutch Fort',
            'Nilaveli Beach',
            'Kinniya Bridge',
            'Hot Water Springs'
        ],
        'package_includes' => [
            'Up and Down',
            'Tickets',
            'Videos',
            'Excepts – Ride',
            'Tour Guide'
        ],
        'phone' => '+94762450858',
        'price' => 'Rs 2900 /person',
        'image' => 'trincomalee.jpg'
    ],
    [
        'title' => 'Anuradhapura',
        'days' => 1,
        'places' => [
            'Sigiriya',
            'Pidurangala',
            'Dambulla Cave Temple',
            'Anuradhapura – Sacred City',
            'Museum'
        ],
        'package_includes' => [
            'Up and Down',
            'Tickets',
            'Videos',
            'Excepts – Ride',
            'Tour Guide'
        ],
        'phone' => '+94762450858',
        'price' => 'Rs 3700 /person',
        'image' => 'anuradhapura.jpg'
    ]
];


$location = isset($_GET['location']) ? $_GET['location'] : '';
$image = isset($_GET['image']) ? htmlspecialchars($_GET['image']) : '';


$package = null;
foreach ($packages as $p) {
    if (strcasecmp($p['title'], $location) === 0) {
        $package = $p;
        break;
    }
}
?>
<?php include 'header/header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Package</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            background: url('images/inner-banner.jpg') no-repeat center center / cover;
        }

        .package-header {
            color: white;
            padding: 50px 0;
            text-align: center;
            font-size: 30px;
        }

        .package-header h1 {
            font-size: 2.5em;
            margin: 0;
        }

        .row {
            margin-top: -50px;
        }

        .package-image {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            overflow: hidden;
            width: auto;
            max-width: 100%;
            min-height: 300px;
            max-height: 600px;
            box-sizing: border-box;
        }

        .package-details {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            overflow: hidden;
        }

        .package-details h3 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .package-details ul {
            list-style-type: none;
            padding: 0;
        }

        .package-details li {
            margin-bottom: 8px;
        }

        .btn-back {
            background-color: #009688;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s ease;
        }

        .btn-back:hover {
            background-color: #00796b;
            text-decoration: none;
            color: white;
            transform: scale(1.1);
        }

        .btn-back1 {
            background-color: #009688;
            margin-left: 20px;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s ease;
        }

        .btn-back1:hover {
            background-color: #00796b;
            text-decoration: none;
            color: white;
            transform: scale(1.1);
        }

        @media (max-width: 768px) {
            .package-header h1 {
                font-size: 1.5em;
            }

            .package-details {
                padding: 15px;
                font-size: 14px;
            }

            .btn-back {
                font-size: 14px;
                padding: 8px 20px;
            }

            .btn-back1 {
                font-size: 14px;
                padding: 8px 20px;
                margin-left: 20px;
            }

            .package-image {
                width: 100%;
                height: auto;
                margin: 0 auto;
                display: block;
            }
        }
    </style>
</head>

<body>

    <?php if ($package): ?>
        <div class="package-header">
            <h1><?php echo $package['title']; ?> Tour Package</h1>
        </div>

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <img src="images/<?php echo htmlspecialchars($image); ?>"
                        alt="<?php echo htmlspecialchars($location); ?>" class="package-image">
                </div>
                <div class="col-md-6">
                    <div class="package-details">
                        <p><strong>Duration:</strong> <?php echo $package['days']; ?> day</p>
                        <p><strong>Price:</strong> <?php echo $package['price']; ?></p>
                        <p><a href="tel:<?php echo htmlspecialchars($package['phone']); ?>"
                                style="text-decoration: none; color: inherit;"><strong>Phone:</strong> <span
                                    style="color: lightblue;"><?php echo htmlspecialchars($package['phone']); ?></span>
                            </a></p>

                        <h3>Places to Visit:</h3>
                        <ul>
                            <?php foreach ($package['places'] as $place): ?>
                                <li><?php echo $place; ?></li>
                            <?php endforeach; ?>
                        </ul>

                        <h3>Package Includes:</h3>
                        <ul>
                            <?php foreach ($package['package_includes'] as $include): ?>
                                <li><?php echo $include; ?></li>
                            <?php endforeach; ?>
                        </ul>

                        <a href="tourpackages.php" class="btn-back">Back to Packages</a>
                        <a href="booking.php?title=<?php echo $package['title']; ?>&image=<?php echo $image; ?>"
                            class="btn-back1">Book Now</a>

                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="container mt-5">
            <div class="alert alert-danger">
                <strong>Package not found!</strong>
            </div>
        </div>
    <?php endif; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php include 'footer/footer.php'; ?>
</body>

</html>