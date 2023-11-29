<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <title>Job Listings</title>
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
    <div class="my-container">
        <br>
        <br>
        <h1 id="blue"><u>Available Positions</u></h1>
        <p>All available positions can be viewed here for available courses and instructors in need of a grader or lab instructor.

        Please do not submit resumes or applications directly to professors.
        </p>
        <br>
        <form>
            <div class="row">
                <div class="col-4" style="float:left;">
                    <label>Filter By:</label>
                </div>
                
                <div class="col" style="float:right;">
                
                    <div class="row">
                        <div class="col" style="float:right;">
                            <label for="jobType">Job:</label>
                            <select name="jobType" id="jobType">
                                <option value="">Both</option>
                                <option value="Grader">Grader</option>
                                <option value="Lab Instructor">Lab Instructor</option>
                            </select>
                        </div>
                        <div class="col" style="float:right;">
                            <label for="courseCode">Department:</label>
                            <select name="courseCode" id="courseCode">
                                <option value="">All</option>
                                <option value="CS">CS</option>
                                <option value="IT">IT</option>
                                <option value="ECE">ECE</option>
                                <option value="BSCS">BSCS</option>
                            </select>
                        </div>    
                        <div class="col" style="float:right;">
                            <label for="day">Day:</label>
                            <select name="day" id="day">
                                <option value="">All</option>
                                <option value="M">Monday</option>
                                <option value="T">Tuesday</option>
                                <option value="W">Wednesday</option>
                                <option value="Th">Thursday</option>
                                <option value="F">Friday</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <br>
        <div id="jobListings" style="max-height: 500px; overflow: auto; border: 5px inset #0072bb">Job listings will be listed here...</div>
    </div>

    <script>
        function loadData() {
            const jobType = document.getElementById("jobType").value;
            const courseCode = document.getElementById("courseCode").value;
            const day = document.getElementById("day").value;

            const xhttp = new XMLHttpRequest();

            xhttp.onload = function() {
                document.getElementById("jobListings").innerHTML = this.responseText;
            }

            xhttp.open("GET", `getjoblisting.php?jobType=${jobType}&courseCode=${courseCode}&day=${day}`);
            xhttp.send();
        }

        document.addEventListener("DOMContentLoaded", function() {
            loadData();

            document.getElementById("jobType").addEventListener("change", loadData);
            document.getElementById("courseCode").addEventListener("change", loadData);
            document.getElementById("day").addEventListener("change", loadData);
        });
    </script>
</body>

</html>