<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">        
        <h1>CSEE GTA Application</h1>
        <ul>
            <li><a href="Homepage.html">Homepage</a></li>            
            <li><a href="joblistings.php">Job Availability</a></li>
            <li><a href="Projectv1.html">Application</a></li>
            <li><a href="Login.html">Admin Login</a></li>
        </ul>
    </div>
    <div class="container">

        
    <form id=joblistingsForm>
        <label for="job" >Job Type:</label>
        <select name="job" id="levelSelect">
            <option value="">Both</option>
            <option value="Grader">Grader</option>
            <option value="Lab Instructor">Lab Instructor</option>
        </select>
        <label for="degree">Department:</label>
        <select name="degree" id="degreeSelect">
            <option value="">All</option>
            <option value="CS">CS</option>
            <option value="IT">IT</option>
            <option value="ECE">ECE</option>
            <option value="BSCS">BSCS</option>
        </select>
        <label for="day">Day:</label>
        <select name="day" id="day">
            <option value="">All</option>
            <option value="M">Monday</option>
            <option value="T">Tuesday</option>
            <option value="W">Wednesday</option>
            <option value="T">Thursday</option>
            <option value="F">Friday</option>
        </select>
    </form>
    <br>
    <div id="txtHint">Available job info will be listed here...</div>

    <?php
        $servername = "localhost";
        $username = "root"; 
        $password = ""; 
        $dbname = "cs451r";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


            $sql = "SELECT * FROM activejobs"; //connecting to active jobs table?
            $result = $conn->query($sql);



            if ($result->num_rows > 0) {
                // Output table headers
                echo "<table class='table table-hover' id='myTable'>
                        <tr>
                            <th scope='col'>Job Type</th>
                            <th>Course</th>
                            <th>Instructor</th>
                            <th>Day</th>
                            <th>Time</th>
                        </tr>";

                // Output data from rows
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["jobType"]. "</td>
                            <td>" . $row["courseCode"]. "</td>
                            <td>" . $row["courseInstructor"]. "</td>
                            <td>" . $row["courseDays"]. "</td>
                            <td>" . $row["courseTime"]. "</td>
                        </tr>";
                }

                // Close the table
                echo "</table>";
            } else {
                echo "0 results";
            }


        $conn->close();
        ?>
        
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	
    
</body>
</html>
