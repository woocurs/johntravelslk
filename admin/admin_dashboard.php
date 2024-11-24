<?php
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION['admin_id']) || $_SESSION['admin_id'] === null) {
    // Redirect to login page if the user is not logged in
    header("Location: admin_login.php");
    exit;
}

require '../database/db.php'; // Include the database connection

// Fetch all unique tour packages for the filter dropdown
$tourPackagesQuery = "SELECT DISTINCT tour_package FROM tour_bookings";
$tourPackagesResult = $conn->query($tourPackagesQuery);

// Handle filtering by tour package
$filter = "";
$sql = "SELECT * FROM tour_bookings WHERE status != 'rejected'"; // Exclude rejected bookings
if (isset($_GET['tour_package']) && !empty($_GET['tour_package'])) {
    $filter = $_GET['tour_package'];
    $stmt = $conn->prepare("SELECT * FROM tour_bookings WHERE status != 'rejected' AND tour_package = ?");
    $stmt->bind_param("s", $filter);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query($sql);
}

// Handle POST actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id']; // Cast to integer for safety

    if (isset($_POST['action']) && $_POST['action'] === 'confirm_booking') {
        $seatNumber = htmlspecialchars($_POST['seat_number']);
        $paymentDetails = htmlspecialchars($_POST['payment_details']);

        // Validation for unique seat number in the same tour package
        $stmt = $conn->prepare("
            SELECT id FROM tour_bookings 
            WHERE seat_number = ? 
            AND tour_package = (
                SELECT tour_package 
                FROM tour_bookings 
                WHERE id = ?
            ) 
            AND id != ? 
            AND status = 'confirmed'
        ");
        $stmt->bind_param("sii", $seatNumber, $id, $id);
        $stmt->execute();
        $seatValidationResult = $stmt->get_result();

        if ($seatValidationResult->num_rows > 0) {
            echo "<script>alert('Error: Seat number $seatNumber is already assigned for this tour package.'); window.location.href = 'admin_dashboard.php';</script>";
            exit; 
        }

        $stmt = $conn->prepare("UPDATE tour_bookings SET status = 'confirmed', seat_number = ?, payment_details = ? WHERE id = ?");
        $stmt->bind_param("ssi", $seatNumber, $paymentDetails, $id);

        if ($stmt->execute()) {
            $dbSuccess = true;
            $emailSuccess = sendConfirmationEmail($id, $seatNumber, $paymentDetails, $conn);
            $smsSuccess = sendSMS($id, $seatNumber, $paymentDetails, $conn);

            $alertMessage = "Booking confirmed successfully.\n";
            $alertMessage .= $dbSuccess ? "Data stored successfully.\n" : "Database update failed.\n";
            $alertMessage .= $emailSuccess ? "Email sent successfully.\n" : "Failed to send email.\n";
            $alertMessage .= $smsSuccess ? "SMS sent successfully.\n" : "Failed to send SMS.\n";

            echo "<script>alert('$alertMessage'); window.location.href = 'admin_dashboard.php';</script>";
        } else {
            echo "<script>alert('Error confirming booking.'); window.location.href = 'admin_dashboard.php';</script>";
        }
		header("location: admin_dashboard");
		exit;
    } elseif (isset($_POST['action']) && $_POST['action'] === 'reject_booking') {
        $stmt = $conn->prepare("UPDATE tour_bookings SET status = 'rejected' WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo "<script>alert('Booking rejected successfully.'); window.location.href = 'admin_dashboard.php';</script>";
        } else {
            echo "<script>alert('Error rejecting booking.'); window.location.href = 'admin_dashboard.php';</script>";
        }
    }
}

function sendConfirmationEmail($id, $seatNumber, $paymentDetails, $conn) {
    $stmt = $conn->prepare("SELECT email, name, reference_number FROM tour_bookings WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];
        $customerName = $row['name'];
        $referenceNumber = $row['reference_number'];
        $subject = "Booking Confirmation - John Travels";
        $message = "Dear $customerName,\n\nYour booking is confirmed.\nReference: $referenceNumber\nSeat Number: $seatNumber\nPayment Details: $paymentDetails\n\nThank you for choosing John Travels!";
        return mail($email, $subject, $message, "From: noreply@johntravels.com");
    }
    return false;
}

function sendSMS($id, $seatNumber, $paymentDetails, $conn) {
    $stmt = $conn->prepare("SELECT phone, name, reference_number FROM tour_bookings WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $phone = preg_replace("/[^0-9]/", "", $row['phone']);
        if (substr($phone, 0, 1) == '0') {
            $phone = '94' . substr($phone, 1);
        }
        $message = "Dear {$row['name']}, your booking is confirmed. Reference_No: {$row['reference_number']}, Seat Number: $seatNumber, Payment Details: $paymentDetails. Thank you for choosing John Travels!";
        $data = [
            'user_id' => "28355",
            'api_key' => "jpWXAHATeXbXA4jAP1i3",
            'to' => $phone,
            'message' => $message,
            'sender_id' => "JohnTravels"
        ];
        $ch = curl_init("https://app.notify.lk/api/v1/send");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response, true);
        return isset($result['status']) && $result['status'] === "success";
    }
    return false;
}
?>


<?php include('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow-y: auto;
        }

        body {
            font-family: Arial, sans-serif;
            background-image: url('../images/bannaer_15.jpg'); /* Background image path */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        .container {
            max-width: 900px;
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, 0.7);
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            color: white;
            padding: 30px;
            box-sizing: border-box;
            border-radius: 8px;
            overflow: hidden;
        }

        .dashboard {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 8px;
            overflow: auto;
        }

        .dashboard h2 {
            text-align: center;
            color: #ffffff;
        }

        .dashboard p {
    text-align: center;
    color: #ffffff; /* Set font color to white */
    font-size: 18px; /* Adjust font size for readability */
    margin-bottom: 20px; /* Add spacing below the paragraph */
}

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            color: #ffffff;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
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
            margin: 5px;
            border-radius: 4px;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
            color: #fff;
        }

        .btn-confirm { background-color: #28a745; }
        .btn-reject { background-color: #dc3545; }
        .btn-send { background-color: #007bff; }
        .btn-notification { background-color: #ffc107; }
        .btn-logout { background-color: #ff6b6b; }

        .filter-container {
    display: inline-block;
    float: right; /* Align to the right */
    text-align: right;
    margin: 10px;
}

.top-buttons {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.top-buttons .action-btn {
    margin-left: 10px;
}
.btn-reject {
    background-color: #dc3545;
    color: white;
    cursor: pointer;
}

.btn-reject:hover {
    background-color: #a71d2a;
	text-decoration:none;
}

select, button {
    padding: 8px;
    font-size: 14px;
    margin: 5px;
    border-radius: 4px;
    border: 1px solid #ddd;
}

button {
    background-color: #007bff;
    color: white;
    cursor: pointer;
}

button:hover {
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
    <script>
        function confirmBooking(bookingId) {
            const seatNumber = prompt("Enter Seat Number:");
            if (seatNumber) {
                const paymentDetails = prompt("Enter Payment Details:");
                if (paymentDetails) {
                    submitAction('confirm_booking', bookingId, seatNumber, paymentDetails);
                }
            }
        }

        function rejectBooking(bookingId) {
            if (confirm("Are you sure you want to reject this booking?")) {
                submitAction('reject_booking', bookingId);
            }
        }

        function submitAction(action, bookingId, seatNumber = '', paymentDetails = '') {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'admin_dashboard.php';

            const idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = 'id';
            idInput.value = bookingId;
            form.appendChild(idInput);

            const actionInput = document.createElement('input');
            actionInput.type = 'hidden';
            actionInput.name = 'action';
            actionInput.value = action;
            form.appendChild(actionInput);

            if (seatNumber) {
                const seatInput = document.createElement('input');
                seatInput.type = 'hidden';
                seatInput.name = 'seat_number';
                seatInput.value = seatNumber;
                form.appendChild(seatInput);
            }

            if (paymentDetails) {
                const paymentInput = document.createElement('input');
                paymentInput.type = 'hidden';
                paymentInput.name = 'payment_details';
                paymentInput.value = paymentDetails;
                form.appendChild(paymentInput);
            }

            document.body.appendChild(form);
            form.submit();
        }
    </script>
</head>
<body>
<div class="dashboard">
    <h2>Admin Dashboard</h2>
    <p>Manage tour bookings, confirmations, and customer notifications here.</p>
    
    <div class="filter-container">
        <form method="get" action="admin_dashboard.php">
            <select name="tour_package" id="tour_package">
                <option value="all">select the Tour Package</option>
                <?php while ($package = $tourPackagesResult->fetch_assoc()): ?>
                    <option value="<?= $package['tour_package'] ?>" <?= ($filter == $package['tour_package']) ? 'selected' : '' ?>>
                        <?= $package['tour_package'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <button type="submit">Filter</button>
            <a href="admin_dashboard.php" style="text-decoration: none; color: white; background-color: #007bff; padding: 10px 15px; border-radius: 5px;">Reset</a>
        </form>
    </div>

  
    <a href="rejected_bookings.php" class="action-btn btn-reject" style="background-color:#ffc107;; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;">View Rejected Bookings</a>
    <a href="admin_logout.php" class="action-btn btn-logout">Logout</a>

    <table>
        <tr>
            <th>Booking ID</th>
            <th>Customer Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Tour Package</th>
            <th>Reference Number</th>
            <th>Status</th>
            <th>seat Number</th>
            <th>Payment </th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['phone'] ?></td>
                <td><?= $row['tour_package'] ?></td>
                <td><?= $row['reference_number'] ?></td>
                <td><?= $row['status'] ?></td>
                <td><?= $row['seat_number'] ?: 'Not Assigned' ?></td>
                <td><?= $row['payment_details'] ?: 'Not Assigned' ?></td>
                <td>
                    <button class="action-btn btn-confirm" onclick="confirmBooking(<?= $row['id'] ?>)">Confirm Booking</button>
                    <button class="action-btn btn-reject" onclick="rejectBooking(<?= $row['id'] ?>)">Reject Booking</button>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>
<script>
  
    window.onclick = function(event) {
        const modal = document.getElementById('modal');
        if (event.target === modal) {
            closeModal();
        }
    };
</script>

<?php include "footer.php"; ?>
</body>
</html>