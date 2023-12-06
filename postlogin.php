<?php

session_start();
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "CS451R";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$idNo = $_SESSION['idNo'];
$sqlUserInfo = "SELECT firstname, lastname, studentID, type, phoneNo, email FROM login WHERE idNo = $idNo";
$resultUserInfo = $conn->query($sqlUserInfo);

if ($resultUserInfo->num_rows > 0) {
    $row = $resultUserInfo->fetch_assoc();

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
    <style>
        .confirmation-message{
            color: darkgreen;
            font-size: 15px;
            text-align: center;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }
        .error-message {
            color: red;
            font-size: 15px;
            text-align: center;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }
    </style>
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
    <div>
        <?php
        if (isset($_GET['statusUpdateSuccess']) && $_GET['statusUpdateSuccess'] == 1) {
            echo '<div class="confirmation-message">Status updated successfully.</div>';
        } elseif (isset($_GET['statusUpdateError']) && $_GET['statusUpdateError'] == 1) {
            echo '<div class="error-message">Error updating status. Please try again.</div>';
        }
        ?>
        <h4>You can view and update the status of submitted applications.</h4>
    </div>
    <form>
        <input type="text" id="searchInput" placeholder="Search...">
    </form>
    <div id="txtHint">Application info will be listed here...</div>
    <script>
        function loadData(search, level) {
            const xhttp = new XMLHttpRequest();

            xhttp.onload = function () {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }

            xhttp.open("GET", "getApplication.php?search=" + search + "&level=" + level);
            xhttp.send();
        }

        document.addEventListener("DOMContentLoaded", function () {
            loadData('', '');

            document.getElementById("searchInput").addEventListener("input", function () {
                var search = this.value;
                var level = ""; 
                loadData(search, level);
            });
        });
    </script>

</body>

</html>
