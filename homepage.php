<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>GTA Homepage</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
<script src="script.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
    <div class="header">        
        <h1 class="main">CSEE GTA Application</h1>
        <ul>
            <li><a href="Homepage.php">Homepage</a></li>
            <li><a href="joblistings.php">Job Availability</a></li>
            <li><a href="application.php">Application</a></li>
            <li><a href="Login.php">Login</a></li>
        </ul>
    </div>
    <br>

    <div class="my-container">
        <p><h1 id="blue">Welcome to the GTA Application!</h1></p>
    </div>

    <div class="imgcontainer">
        <img src="study-collab.jpg" alt="Students Studying and collaborating" style="width:40%; border-radius: 10px;">
    </div>

    <div class="my-container">
        <p>
            <h2 id="urgent"><u>Deadline to apply is November 1st!</u></h2>
            <br>
            
            The CSEE Department is always looking for students who excel in class to serve as a Grader or Lab Instructor alongside professors to aid classroom flow and efficiency. We are looking for students with excellent grades, communication skills, and time management. 
    
        </p>
        <div style="display:flex; justify-content: center; align-items: center;">
            <a href="application.html"><button class="homebutton">Apply Now!</button></a>        
        </div>

        <div class="row" >
            <div class="col-6" style="display:flex; justify-content: right; align-items: center;">
                <a href="joblistings.php"><button class="homebutton">Available Jobs</button></a>  
            </div>

            <div class="col-6" style="display:flex; justify-content: left; align-items: center;">
                <a href="Login.html"><button class="homebutton">Admin Login</button></a>  
            </div>          
                   
             
        </div>
    </div>
    
</body>
</html>