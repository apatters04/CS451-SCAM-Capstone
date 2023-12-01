<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <title>GTA Homepage</title>
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

    <br>
    <p><h1 id="blue">Welcome to the GTA Application!</h1></p>


    <div class="imgcontainer">
        <img src="study-collab.jpg" alt="Students Studying and collaborating" style="width:40%; border-radius: 10px;">
    </div>

    <div style="padding-left: 300px; padding-right: 300px;">
        <p>
            <h2 id="urgent"><u>Deadline to apply is November 1st!</u></h2>
            <br>
            
            The CSEE Department is always looking for students who excel in class to serve as a Grader or Lab Instructor alongside professors to aid classroom flow and efficiency. We are looking for students with excellent grades, communication skills, and time management. 
    
        </p>
    <div style="display:flex; justify-content: center; align-items: center;">
             
    </div>
    <br>
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
                
     <br>
    </div>      
     <br>      
     <br>
</div>
    
</body>
</html>