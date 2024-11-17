<?php
// Include your database connection file
include 'db.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    
    // Handle file upload (CV)
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] == UPLOAD_ERR_OK) {
        // Define allowed file types and max file size
        $allowedFileTypes = ['pdf', 'doc', 'docx'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB

        $fileName = $_FILES['cv']['name'];
        $fileTmpName = $_FILES['cv']['tmp_name'];
        $fileSize = $_FILES['cv']['size'];
        $fileError = $_FILES['cv']['error'];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Check file type
        if (!in_array($fileType, $allowedFileTypes)) {
            echo "Invalid file type. Only PDF, DOC, and DOCX are allowed.";
            exit();
        }

         // Check file size
         if ($fileSize > $maxFileSize) {
            echo "File size exceeds the limit of 5MB.";
            exit();
        }

        // Define upload directory and file path
        $uploadDir = 'uploads/cvs/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $newFileName = uniqid() . '.' . $fileType;
        $filePath = $uploadDir . $newFileName;

        // Move file to the uploads directory
        if (move_uploaded_file($fileTmpName, $filePath)) {
            // File upload successful
        } else {
            echo "Error uploading file.";
            exit();
        }
    } else {
        echo "No file uploaded or there was an error with the file upload.";
        exit();
    }
    // Insert the application data into the database
    $query = "INSERT INTO job_applications (name, address, email, position, cv_file) VALUES (?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("sssss", $name, $address, $email, $position, $filePath);

        if ($stmt->execute()) {
            // Successful submission
            echo "Application submitted successfully!";
            // You can redirect or display a success message here
        } else {
            echo "Error submitting the application. Please try again later.";
        }

        $stmt->close();
    } else {
        echo "Error preparing the query.";
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>