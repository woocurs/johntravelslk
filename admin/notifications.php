

<?php 

session_start();
require '../database/db.php'; // Include the database connection

// Functions for actions
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    if($action == 'send_sms') {
        $response = sendSMS($id, $conn);
        echo "<script>alert('$response'); window.location.href = 'notifications.php';</script>";
    } elseif ($action == 'send_email') {
        $response = sendEmail($id, $conn);
        echo "<script>alert('$response'); window.location.href = 'notifications.php';</script>";
    }
}


// Function to send SMS using Notify.lk API
function sendSMS($id, $conn) {
    $sql = "SELECT phone, name FROM contact_us WHERE id='$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $phone = $row['phone'];
        $customerName = $row['name'];

        // Add country code if not present
        $country_code = "94"; // Country code for Sri Lanka
        if (strpos($phone, $country_code) !== 0) {
            $phone = $country_code . ltrim($phone, '0'); // Remove leading zero if present
        }

        $api_url = "https://app.notify.lk/api/v1/send";
        $api_key = "EbwoEq3OkOozTLm7qnAz"; // Replace with your Notify.lk API key
        $sender_id = "28423"; // Replace with your sender ID

        $message = "Dear $customerName, Thank you for reaching out. We have received your message and will get back to you shortly. Best regards, Johnstravels lk";;

        // Prepare data for POST request
        $data = array(
            'user_id' => $sender_id,
            'api_key' => $api_key,
            'to' => $phone,
            'message' => $message,
            'sender_id' => 'NotifyDEMO'
        );

        // Initialize cURL
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        // Execute request and capture response
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Get HTTP status code
        curl_close($ch);

        // Decode and log response for debugging
        $result = json_decode($response, true);
        if (isset($result['status']) && $result['status'] == "success") {
            return "SMS sent successfully!";
        } else {
            // Log both response and HTTP code
            $error_message = isset($result['message']) ? $result['message'] : "Unknown error";
            return "Failed to send SMS. HTTP Code: $httpcode, Error: $error_message";
        }
    }
    return "No phone number found for this booking.";
}

// Function to send Email using mailto
function sendEmail($id, $conn) {
    $sql = "SELECT email, name FROM tour_bookings WHERE id='$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];
        $customerName = $row['name'];
        
        // Prepare mailto link
        $subject = urlencode("Booking Confirmation - John Travels");
        $body = urlencode("Dear $customerName,\n\nThank you for reaching out. We have received your message and will get back to you shortly.\n\nBest regards,\nJohnstravels lk");
        $headers = "From: noreply@johntravels.com";

        // Open mailto link in a new tab
        echo "<script>window.open('mailto:$email?subject=$subject&body=$body', '_blank');</script>";
        return "Email prompt opened in a new tab.";
    }
    return "No email address found for this booking.";
}



// Fetch notifications from contact_us table
$sql = "SELECT id, name, phone, email, message FROM contact_us";
$result = $conn->query($sql);
?>
<?php include('header.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
        <style>
        /* Internal CSS styling */
        
        html, body {
    margin: 0;
    padding: 0;
    height: 100%;
    overflow-y:auto; /* This prevents scrolling */
}

/* Background setup */
body {
    font-family: Arial, sans-serif;
    background-image: url('../images/bannaer_22.jpg'); /* Background image path */
    background-size: cover; /* Make the image cover the entire screen */
    background-position: center; /* Center the background image */
    background-attachment: fixed; /* Make background fixed */
    background-repeat: no-repeat; /* Prevent repeating the background image */
}

/* Container styling */
.container {
    width: 100%;
            max-width: 900px;
            background: rgba(0, 0, 0, 0.8); /* Dark semi-transparent background */
            padding: 30px;
            border-radius: 8px;
            color: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            overflow-y: auto;
            max-height: 90vh; /* Prevent overflow of content */
}

.dashboard {
    background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
    padding: 20px;
    border-radius: 8px;
}

.dashboard h2 {
    text-align: center;
    color: #ffffff;
}

.dashboard p {
    text-align: center;
    color: #cccccc;
}

/* Table styling */
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

.top-buttons {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-bottom: 15px;
}
    </style>
</head>
<body>
<div class="container">
    <h2>Contact Notifications</h2>
    <p>List of all notifications from the contact us form.</p>
    <a href="admin_dashboard.php" class="action-btn btn-back" style="background-color: #ff6b6b; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;">Back</a>
    <table>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Message</th>
			<th>Actions</th>
			
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['phone'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['message'] ?></td>
					 <td>
                    <a href="?action=send_email&id=<?= $row['id'] ?>" class="action-btn btn-send">Send Email</a>
                    <a href="?action=send_sms&id=<?= $row['id'] ?>" class="action-btn btn-confirm">Send SMS</a>
                    
                </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="5">No notifications found.</td></tr>
        <?php endif; ?>
    </table>
</div>
<?php
include "footer.php";

?>
</body>
</html>

