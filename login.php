<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css"><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">        
        <h1>CSEE GTA Application</h1>
        <ul>
            <li><a href="Homepage.html">Homepage</a></li>            
            <li><a href="joblistings.php">Job Availability</a></li>
            <li><a href="application.php">Application</a></li>
            <li><a href="Login.php">Login</a></li>
        </ul>
    </div>
    
    <form action="loginscript.php" method="post">
        <div>
            <div class="imgcontainer">
                <img src="UMKC_logo.png" alt="Logo" class="logo">
            </div>
            
            <?php
            // Display the message if it exists
            if (isset($_GET['message'])) {
                echo '<p style="color: red;">' . htmlspecialchars($_GET['message']) . '</p>';
            }
            ?>


            <div class="my-container">
                <br>
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username">
                <br>
                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password">
            
                <button type="submit" style="display: inline-block;">Login</button>
                <button type="submit" formaction="createAccount.html" style="display: inline-block; float: right;">Create Account</button>
            </div>

        </div>
        
    </form>
</body>
</html>
