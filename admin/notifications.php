

<?php 

session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id']) || $_SESSION['admin_id'] === null) {
    header("Location: admin_login.php");
    exit;
}

require '../database/db.php'; 


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
       
        
        html, body {
    margin: 0;
    padding: 0;
    height: 100%;
    overflow-y:auto; 
}


body {
    font-family: Arial, sans-serif;
    background-image: url('../images/bannaer_22.jpg'); 
    background-size: cover; 
    background-position: center; 
    background-attachment: fixed; 
    background-repeat: no-repeat; 
}


.container {
    width: 100%;
            max-width: 900px;
            background: rgba(0, 0, 0, 0.8); 
            padding: 30px;
            border-radius: 8px;
            color: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            overflow-y: auto;
            max-height: 90vh; 
}

.dashboard {
    background-color: rgba(0, 0, 0, 0.7); 
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

h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #fff;
        }

.container p{
    text-align: center;
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

    <a href="admin_dashboard.php" class="action-btn" style="background-color:#ff6b6b;  float: right; text-align: right;color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;">Back to Dashboard</a>
    
    <table>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Message</th>
			
			
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                <td><?= htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($row['phone'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($row['message'], ENT_QUOTES, 'UTF-8') ?></td>
					 
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

