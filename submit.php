<?php

	// Insert data into the database (you need to set up database connection)
    // Replace the following with your database connection code
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "CS451R";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	$target_dir = "uploads/"; // Create a directory named 'uploads' in your www directory
	$target_file = $target_dir . $_FILES["GTACert"]["name"];
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	// Check if file already exists
	$counter = 1;

	while (file_exists($target_file)) {
    $filename = pathinfo($_FILES["GTACert"]["name"], PATHINFO_FILENAME);
    $extension = pathinfo($_FILES["GTACert"]["name"], PATHINFO_EXTENSION);

    // Generate a new target file name with an incremented counter
    $target_file = $target_dir . $filename . ' (' . $counter . ').' . $extension;
    
    $counter++;
	
	
	}

// Check file size
if ($_FILES["GTACert"]["size"] > 500000) {
    echo "Sorry, your file is too large. ";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded. ";
} else {
    if (move_uploaded_file($_FILES["GTACert"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["GTACert"]["name"])) . " has been uploaded. ";
		$GTACertFilePath = $target_file;
    } else {
        echo "Sorry, there was an error uploading your file. ";
    }
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
	if(isset($_POST['internationalStudentsCheckbox'])){
    // Checkbox is checked
		$internationalStudentsCheckbox  = 1; // Set to 1 for true
		} else {
		// Checkbox is not checked
		$internationalStudentsCheckbox  = 0; // Set to 0 for false
	} 	
	$GTACertFilePath = $_POST['GTACert'];
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
