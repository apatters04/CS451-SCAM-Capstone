<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['idNo'])) {
    $message = $_SESSION['idNo'] . "You need to be logged in to access this page. Please log in below.";
    header("Location: Login.php?message=" . urlencode($message)); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css"><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Student's Applications Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">        
        <h1>Student's Applications Page</h1>
        <ul>
            <li><a href="Homepage.php">Homepage</a></li>            
            <li><a href="joblistings.php">Job Availability</a></li>
            <li><a href="application.php">Application</a></li>
            <li><a href="Login.php">Login</a></li>
        </ul>
    </div>
    

    <?php

    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $dbname = "CS451R";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $idNo = $_SESSION['idNo'];
$sqlUserInfo = "SELECT firstname, lastname, studentID FROM login WHERE idNo = $idNo";
    $resultUserInfo = $conn->query($sqlUserInfo);

if ($resultUserInfo->num_rows > 0) {
    $row = $resultUserInfo->fetch_assoc();

    // Store user information in sessions
    $_SESSION['firstname'] = $row['firstname'];
    $_SESSION['lastname'] = $row['lastname'];
    $_SESSION['studentID'] = $row['studentID'];
}

    $studentID = $_SESSION['studentID'];

    $result = $conn->prepare("SELECT firstName, lastName, studentID, email, phoneNumber, currentLevel, GPA, degree, graduatingSemester,
    graduatingYear, hoursCompleted, applyingJob, internationalStudentsCheckbox, description, serveInstructor, timestamp, status FROM application WHERE studentID IN (SELECT studentID FROM login WHERE studentID LIKE $studentID)");
   
    if ($result) {
        $result->execute();
        $result->store_result();
        $result->bind_result($fname, $lname, $sid, $email, $phoneNumber, $currentlevel, $gpa, $degree, $gsem, $gyear, $hcomplete, $applyjob, $istu, $desc, $serv, $timestamp, $status);
    
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>First Name</th>";
        echo "<th>Last Name</th>";
        echo "<th>Student ID</th>";
        echo "<th>Email</th>";
        echo "<th>Phone Number</th>";
        echo "<th>Current Level</th>";
        echo "<th>GPA</th>";
        echo "<th>Degree</th>";
        echo "<th>Graduating Semester</th>";
        echo "<th>Graduating Year</th>";
        echo "<th>Hours Completed</th>";
        echo "<th>Applying Job</th>";
        echo "<th>International Students Checkbox</th>";
        echo "<th>Description</th>";
        echo "<th>Serve Instructor</th>";
        echo "<th>Timestamp</th>";
        echo "<th>Status</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
    
        while ($result->fetch()) {
            echo "<tr>";
            echo "<td>" . $fname . "</td>";
            echo "<td>" . $lname . "</td>";
            echo "<td>" . $sid . "</td>";
            echo "<td>" . $email . "</td>";
            echo "<td>" . $phoneNumber . "</td>";
            echo "<td>" . $currentlevel . "</td>";
            echo "<td>" . $gpa . "</td>";
            echo "<td>" . $degree . "</td>";
            echo "<td>" . $gsem . "</td>";
            echo "<td>" . $gyear . "</td>";
            echo "<td>" . $hcomplete . "</td>";
            echo "<td>" . $applyjob . "</td>";
            echo "<td>" . $istu . "</td>";
            echo "<td>" . $desc . "</td>";
            echo "<td>" . $serv . "</td>";
            echo "<td>" . $timestamp . "</td>";
            echo "<td>" . $status . "</td>";
            echo "</tr>";
        }
    
        echo "</tbody>";
        echo "</table>";
    
        $result->close();
    } else {
        echo "Error in query execution: " . $mysqli->error;
    }
    ?>
</body>
</html>
