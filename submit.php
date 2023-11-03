<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CS451R";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["GTACert"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

$counter = 1;

while (file_exists($target_file)) {
    $filename = pathinfo($_FILES["GTACert"]["name"], PATHINFO_FILENAME);
    $extension = pathinfo($_FILES["GTACert"]["name"], PATHINFO_EXTENSION);

    $target_file = $target_dir . $filename . ' (' . $counter . ').' . $extension;

    $counter++;
}

if ($_FILES["GTACert"]["size"] > 500000) {
    echo "Sorry, your file is too large. ";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded. ";
} else {
    if (move_uploaded_file($_FILES["GTACert"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["GTACert"]["name"])) . " has been uploaded. ";
        $GTACertFilePath = $target_file;
    } else {
        echo "Sorry, there was an error uploading your file. ";
    }
    
    $GTACertFilePath = $target_file; // Add this line after the file upload code
}

if ($_FILES["GTACert"]["error"] != UPLOAD_ERR_OK) {
    echo "File upload failed with error code: " . $_FILES["GTACert"]["error"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $studentID = $_POST['studentID'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $currentLevel = $_POST['currentLevel'];
    $graduatingSemester = $_POST['graduatingSemester'];
    $graduatingYear = $_POST['graduatingYear'];
    $GPA = $_POST['GPA'];
    $hoursCompleted = $_POST['hoursCompleted'];
    $degree = $_POST['degree'];
    $major = $_POST['major'];
    $applyingJob = $_POST['applyingJob'];
    if (isset($_POST['internationalStudentsCheckbox'])) {
        $internationalStudentsCheckbox  = 1;
    } else {
        $internationalStudentsCheckbox  = 0;
    }   
    $description = $_POST['description'];
    $serveInstructor = $_POST['serveInstructor'];

    $sql = "INSERT INTO application (firstName, lastName, studentID, email, phoneNumber, currentLevel, graduatingSemester, graduatingYear, GPA, hoursCompleted, degree, major, applyingJob, internationalStudentsCheckbox, description, serveInstructor, GTACert)
    VALUES ('$firstName', '$lastName', '$studentID', '$email', '$phoneNumber', '$currentLevel', '$graduatingSemester', '$graduatingYear', '$GPA', '$hoursCompleted', '$degree', '$major', '$applyingJob', '$internationalStudentsCheckbox', '$description', '$serveInstructor', '$GTACertFilePath')";

    if ($conn->query($sql) === true) {
        echo "Application submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

?>
