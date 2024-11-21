<?php

include 'db.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    
    
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] == UPLOAD_ERR_OK) {
      
        $allowedFileTypes = ['pdf', 'doc', 'docx'];
        $maxFileSize = 5 * 1024 * 1024; 

        $fileName = $_FILES['cv']['name'];
        $fileTmpName = $_FILES['cv']['tmp_name'];
        $fileSize = $_FILES['cv']['size'];
        $fileError = $_FILES['cv']['error'];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        
        if (!in_array($fileType, $allowedFileTypes)) {
            echo "Invalid file type. Only PDF, DOC, and DOCX are allowed.";
            exit();
        }

        
         if ($fileSize > $maxFileSize) {
            echo "File size exceeds the limit of 5MB.";
            exit();
        }

       
        $uploadDir = 'uploads/cvs/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $newFileName = uniqid() . '.' . $fileType;
        $filePath = $uploadDir . $newFileName;

        
        if (move_uploaded_file($fileTmpName, $filePath)) {
            
        } else {
            echo "Error uploading file.";
            exit();
        }
    } else {
        echo "No file uploaded or there was an error with the file upload.";
        exit();
    }
   
    $query = "INSERT INTO job_applications (name, address, email, position, cv_file) VALUES (?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("sssss", $name, $address, $email, $position, $filePath);

        if ($stmt->execute()) {
           
            echo "Application submitted successfully!";
           
        } else {
            echo "Error submitting the application. Please try again later.";
        }

        $stmt->close();
    } else {
        echo "Error preparing the query.";
    }

   
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>