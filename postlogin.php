<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
    <script src="filter.js"></script>
</head>
<body>
    <h1>Applications</h1>
	<br>
    <label for="currentLevel">Filter by Level:</label>
    <select id="currentLevel">
        <option value="">All</option>
        <option value="BS">BS</option>
        <option value="MS">MS</option>
		<option value="PhD">PhD</option>
    </select>

	
	<label for="major">Filter by Major:</label>
    <select id="major">
        <option value="">All</option>
        <option value="CS">CS</option>
        <option value="IT">IT</option>
		<option value="ECE">ECE</option>
		<option value="EE">EE</option>
        <!-- Add more options based on your data -->
    </select>

	<label for="graduatingSemester">Filter by Semester:</label>
    <select id="graduatingSemester">
		<option value="">All</option>
        <option value="Fall">Fall</option>
        <option value="Spring">Spring</option>
    </select>
	
	<label for="graduatingYear">Filter by Year:</label>
    <select id="graduatingYear">
		<option value="">All</option>
        <option value="2023">2023</option>
        <option value="2024">2024</option>
		<option value="2025">2025</option>
		<option value="2026">2026</option>
		<option value="2027">2027</option>
        <option value="2028">2028</option>
    </select>
	
	<br>
	<br>
    
                    <?php
    // Database connection
    $servername = "localhost";
    $username = "root"; // Change this
    $password = ""; // Change this
    $dbname = "cs451r";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM application";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output table headers
        echo "<table class='table table-hover'>
                <tr>
                    <th scope='col'>First Name</th>
                    <th>Last Name</th>
                    <th>Student ID</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Current Level</th>
                    <th>Graduating Semester</th>
                    <th>Graduating Year</th>
                    <th>GPA</th>
                    <th>Hours Completed</th>
                    <th>Degree</th>
                    <th>Major</th>
                    <th>Applying Job</th>
                    <th>International Student</th>
                    <th>GTACert</th>
                    <th>Description</th>
                    <th>Serve Instructor</th>
                </tr>";

        // Output data from rows
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["firstName"]. "</td>
                    <td>" . $row["lastName"]. "</td>
                    <td>" . $row["studentID"]. "</td>
                    <td>" . $row["email"]. "</td>
                    <td>" . $row["phoneNumber"]. "</td>
                    <td>" . $row["currentLevel"]. "</td>
                    <td>" . $row["graduatingSemester"]. "</td>
                    <td>" . $row["graduatingYear"]. "</td>
                    <td>" . $row["GPA"]. "</td>
                    <td>" . $row["hoursCompleted"]. "</td>
                    <td>" . $row["degree"]. "</td>
                    <td>" . $row["major"]. "</td>
                    <td>" . $row["applyingJob"]. "</td>
                    <td>" . ($row["internationalStudentsCheckbox"] == 1 ? 'Yes' : 'No') . "</td>
                    <td>" . $row["GTACert"]. "</td>
                    <td>" . $row["description"]. "</td>
                    <td>" . $row["serveInstructor"]. "</td>
                </tr>";
        }

        // Close the table
        echo "</table>";
    } else {
        echo "0 results";
    }

    // Close the database connection
    $conn->close();
?>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        
</body>
</html>
