<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id']) || $_SESSION['admin_id'] === null) {
    header("Location: admin_login.php");
    exit;
}

// Include database connection
require '../database/db.php';

// Handle approval of rejected booking
if (isset($_POST['approve_booking_id'])) {
    $bookingId = $_POST['approve_booking_id'];

    // Update the status of the rejected booking to "confirmed"
    $stmt = $conn->prepare("UPDATE tour_bookings SET status = 'confirmed' WHERE id = ?");
    $stmt->bind_param("i", $bookingId);

    if ($stmt->execute()) {
        // Redirect to dashboard after successful update
        header("Location: admin_dashboard.php");
        exit;
    } else {
        echo "<script>alert('Error approving booking.'); window.location.href = 'rejected_bookings.php';</script>";
    }
}

// Query to fetch rejected bookings
$sql = "SELECT * FROM tour_bookings WHERE status = 'rejected'";
$result = $conn->query($sql);
?>

<?php include('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejected Bookings</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        /* Add custom styles for rejected bookings table */
        body {
            font-family: Arial, sans-serif;
            background-image: url('../images/bannaer_15.jpg'); /* Background image path */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 8px;
            overflow: auto;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
            color: #fff;
        }

        th {
            background-color: #333333;
        }

        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.1);
        }

        tr:nth-child(odd) {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .action-btn {
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 14px;
            text-decoration: none;
            color: white;
            background-color: #007bff;
        }

        .action-btn:hover {
            background-color: #0056b3;
        }
        @media (max-width: 480px) {
    .dashboard {
        padding: 15px;
    }

    .btn-confirm, .btn-reject, .btn-send, .btn-logout {
        padding: 10px;
        font-size: 14px;
    }

    table {
        font-size: 12px;
    }

    th, td {
        padding: 6px;
    }

    .top-buttons .action-btn {
        width: 100%;
    }

    .filter-container select, .filter-container button {
        width: 100%;
    }
}
    </style>
</head>
<body>
<div class="container">
    <h2>Rejected Bookings</h2>

    
        <a href="admin_dashboard.php" class="action-btn" style="background-color:#ff6b6b; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;">Back to Dashboard</a>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Customer Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Package</th>
            <th>Reference Number</th>
            <th>Action</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['phone'] ?></td>
                    <td><?= $row['tour_package'] ?></td>
                    <td><?= $row['reference_number'] ?></td>
                    <td>
                        <form action="rejected_bookings.php" method="POST" style="display:inline;">
                            <input type="hidden" name="approve_booking_id" value="<?= $row['id'] ?>" />
                            <button type="submit" class="action-btn">Approve</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No rejected bookings found.</td>
            </tr>
        <?php endif; ?>
    </table>
    
</div>
<?php include "footer.php"; ?>
</body>
</html>