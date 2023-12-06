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

$idNo = $_SESSION['idNo'];
$sqlUserInfo = "SELECT firstname, lastname, studentID, type, phoneNo, email FROM login WHERE idNo = $idNo";
$resultUserInfo = $conn->query($sqlUserInfo);

if ($resultUserInfo->num_rows > 0) {
$row = $resultUserInfo->fetch_assoc();

// Store user information in sessions
$_SESSION['firstname'] = $row['firstname'];
$_SESSION['lastname'] = $row['lastname'];
$_SESSION['studentID'] = $row['studentID'];
$_SESSION['type'] = $row['type'];
$_SESSION['phoneNo'] = $row['phoneNo'];
$_SESSION['email'] = $row['email'];
}

    
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications</title>
   

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
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
            if(isset($_SESSION['type']))
            {
                if (($_SESSION['type']) == 'admin') {
                    echo '<li><a href="postlogin.php">View Applications</a></li>';
                }
                elseif (($_SESSION['type']) == 'student'){
                    echo '<li><a href="studentpostlogin.php">My Applications</a></li>';
                }
            }
            else {
                
            };
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
    </div>
            <br>
    <form>
        <select name="level" id="levelSelect">
            <option value="">Select a level:</option>
            <option value="BS">BS</option>
            <option value="MS">MS</option>
            <option value="PhD">PhD</option>
        </select>
        <select name="degree" id="degreeSelect">
            <option value="">Select a major:</option>
            <option value="CS">CS</option>
            <option value="IT">IT</option>
            <option value="ECE">ECE</option>
            <option value="BSCS">BSCS</option>
        </select>
    </form>
    <br>
    <div id="txtHint" >Application info will be listed here...</div>

    <br>
    <script>
        function loadData(level, major) {
            const xhttp = new XMLHttpRequest();

            xhttp.onload = function() {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }

            xhttp.open("GET", "getapplication.php?level=" + level + "&major=" + major);
            xhttp.send();
        }

        document.addEventListener("DOMContentLoaded", function() {
            loadData('', '');
            
            document.getElementById("levelSelect").addEventListener("change", function() {
                var level = this.value;
                var major = document.getElementById("degreeSelect").value; 
                loadData(level, major);
            });

            document.getElementById("degreeSelect").addEventListener("change", function() { 
                var level = document.getElementById("levelSelect").value;
                var major = this.value;
                loadData(level, major);
            });
        });
    </script>

</body>

</html>
