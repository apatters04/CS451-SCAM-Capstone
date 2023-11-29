<?php
session_start();

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

// Check if the user is not logged in
if (!isset($_SESSION['idNo'])) {
    $message = $_SESSION['idNo'] . "You need to be logged in to access this page. Please log in below.";
    header("Location: Login.php?message=" . urlencode($message)); 
    exit();
}

// Get user information from the database and set it in the session
$idNo = $_SESSION['idNo'];
$sqlUserInfo = "SELECT firstname, lastname, studentID, email, phoneNo FROM login WHERE idNo = $idNo";
$resultUserInfo = $conn->query($sqlUserInfo);

if ($resultUserInfo->num_rows > 0) {
    $row = $resultUserInfo->fetch_assoc();

    // Store user information in sessions
    $_SESSION['firstname'] = $row['firstname'];
    $_SESSION['lastname'] = $row['lastname'];
    $_SESSION['studentID'] = $row['studentID'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['phoneNo'] = $row['phoneNo'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Student's Applications Page</title>
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
            if (isset($_SESSION['idNo']) && $_SESSION['idNo'] != NULL) {
                echo '<li><a href="postlogin.php"> View Applications</a></li>';
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
    

    <?php


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
