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
            <li><a href="Homepage.html">Homepage</a></li>            
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




    $username = $_GET['username'];
    echo $username;

    $stmt = $conn->prepare("SELECT * FROM ")



    ?>

    




</body>
</html>
