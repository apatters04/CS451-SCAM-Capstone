<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="header">
    <img src="UMKC_header_logo.png" style="width:20%;">
        <hr class="solid">
        <ul>
            <li><a href="Homepage.php">Homepage</a></li>
            <li><a href="joblistings.php">Job Availability</a></li>
            <li><a href="application.php">Application</a></li>
            <?php
            if (($_SESSION['type']) == 'admin') {
                echo '<li><a href="postlogin.php">View Applications</a></li>';
            }
            elseif (($_SESSION['type']) == 'student'){
                echo '<li><a href="studentpostlogin.php">My Applications</a></li>';
            }
            // Check if the user is logged in
            if (isset($_SESSION['idNo']) && $_SESSION['idNo'] != NULL) {
                echo '<li><a href="logout.php" style="color: white;">' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' - <span style="color: #ffd30a;">Logout</span></a></li>';
            } else {
                echo '<li id="user"><a href="Login.php">Login</a></li>';
                echo '<li id="user"><a href="createAccount.html">Register</a></li>';
            }
            ?>
        </ul>
    </div>
    <br>
    <?php

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "CS451R";

    // Establishing database connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Function to handle file uploads
    function handleFileUpload($fileInputName, $targetDir)
    {
        if(isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]["error"] == UPLOAD_ERR_OK) {
            $target_file = $targetDir . basename($_FILES[$fileInputName]["name"]);

            $uploadOk = 1;

            // Check if file already exists
            if (file_exists($target_file)) {
                $counter = 1;
                while (file_exists($target_file)) {
                    $filename = pathinfo($_FILES[$fileInputName]["name"], PATHINFO_FILENAME);
                    $extension = pathinfo($_FILES[$fileInputName]["name"], PATHINFO_EXTENSION);

                    $target_file = $targetDir . $filename . ' (' . $counter . ').' . $extension;

                    $counter++;
                }
            }

            // Check file size
            if ($_FILES[$fileInputName]["size"] > 500000) {
                echo "<div style='text-align: center;'>";
                    echo "<p>";
                    echo "<h1 id='urgent'> Sorry, your file is too large.</h1>";
                    echo "Please submit your application again with smaller file size.";
                    echo "<br>";
                    echo "If problems persist please contact us as CSEESupport@umkc.edu";
                    echo "</p>";
                    echo "</div>";
                $uploadOk = 0;
                echo "<br>";
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "<br>";
                    echo "<div style='text-align: center;'>";
                    echo "<p>";
                    echo "<h1 id='urgent'> Sorry, your file was not uploaded.</h1>";
                    echo "Please submit your application again with a different file type.";
                    echo "<br>";
                    echo "If problems persist please contact us as CSEESupport@umkc.edu";
                    echo "</p>";
                    echo "</div>";
                    echo "<br>";
            } else {
                if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $target_file)) {
                   // echo "The file " . htmlspecialchars(basename($_FILES[$fileInputName]["name"])) . " has been uploaded. ";
                    return $target_file; // Return the file path
                    echo "<br>";
                } else {
                    echo "<br>";
                    echo "<div style='text-align: center;'>";
                    echo "<p>";
                    echo "<h1 id='urgent'> Sorry, there was an error uploading your file.</h1>";
                    echo "Please submit your application again with a different file type.";
                    echo "<br>";
                    echo "If problems persist please contact us as CSEESupport@umkc.edu";
                    echo "</p>";
                    echo "</div>";
                    echo "<br>";
                }
                
            }
            echo "<br>";

        }

        return null;
    }

    // Handle GTA Certification file upload
    $GTACertFilePath = handleFileUpload("GTACert", "uploads/");

    // Handle Resume file upload
    $resumeFilePath = handleFileUpload("resume", "resume/");

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $studentID = $_POST['studentID'];
        $email = $_POST['email'];
        $phoneNo = $_POST['phoneNo'];
        $currentLevel = $_POST['currentLevel'];
        $graduatingSemester = $_POST['graduatingSemester'];
        $graduatingYear = $_POST['graduatingYear'];
        $GPA = $_POST['GPA'];
        $hoursCompleted = $_POST['hoursCompleted'];
        $degree = $_POST['degree'];
        $major = $_POST['major'];
        $applyingJob = $_POST['applyingJob'];
        $internationalStudent = $_POST['internationalStudent'];
        $serveInstructor = $_POST['serveInstructor'];

        $idNo = $_SESSION['idNo'];
        $sql = "INSERT INTO application (idNo, firstName, lastName, studentID, email, phoneNumber, currentLevel, graduatingSemester, graduatingYear, GPA, hoursCompleted, degree, major, applyingJob, internationalStudent, serveInstructor, GTACert, resume)
        VALUES ('$idNo', '$firstName', '$lastName', '$studentID', '$email', '$phoneNo', '$currentLevel', '$graduatingSemester', '$graduatingYear', '$GPA', '$hoursCompleted', '$degree', '$major', '$applyingJob', '$internationalStudent', '$serveInstructor', '$GTACertFilePath', '$resumeFilePath')";

        if ($conn->query($sql) === true) {
            echo "<br>";
            echo "<div style='text-align: center;'>";
            echo "<p>";
            echo "<h1 id='blue'>Application submitted successfully!</h1>";
            echo "We will be reaching out to you about the status of your application soon!";
            echo "</p>";
            echo "</div>";
            echo "<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }


    // Close database connection
    $conn->close();

    ?>
    <br>
    <div class="my-container">
        <div class="row" >
            <div class="col-4" style="display:flex; justify-content: center; align-items: center;">
            <a href="application.php"><button class="homebutton">Apply Now!</button></a>     
            </div>
            <div class="col-4" style="display:flex; justify-content: center; align-items: center;">
                <a href="joblistings.php"><button class="homebutton">Available Jobs</button></a>  
            </div>

            <div class="col-4" style="display:flex; justify-content: center; align-items: center;">
                <a href="Login.php"><button class="homebutton">Admin Login</button></a>  
            </div>          
                    
                
        </div>
    </div>
</html>

   
