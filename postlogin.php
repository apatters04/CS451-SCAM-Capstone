<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-rI+9KnFlrW97RCNfOWAW+K0t5uvCY2z2mXm9CrquO67Fbmu1JwPbE6P3JskOozA3" crossorigin="anonymous"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const table = document.querySelector("table");

            function sortTable(column) {
                const rows = Array.from(table.querySelectorAll("tbody tr"));

                rows.sort((a, b) => {
                    const aVal = a.children[column].textContent.trim();
                    const bVal = b.children[column].textContent.trim();

                    return isNaN(aVal) ? aVal.localeCompare(bVal) : aVal - bVal;
                });

                rows.forEach(row => table.querySelector("tbody").appendChild(row));
            }

            table.querySelectorAll("thead th").forEach((header, index) => {
                header.addEventListener("click", () => {
                    sortTable(index);
                });
            });
        });
    </script>

</head>

<body>
    <div class="header">
        <h1>CSEE GTA Admin Application View</h1>
        <ul>
            <li><a href="Homepage.html">Homepage</a></li>
            <li><a href="joblistings.php">Job Availability</a></li>
            <li><a href="application.html">Application</a></li>
            <li><a href="Login.html">Admin Login</a></li>
        </ul>
    </div>

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
    <div id="txtHint">Application info will be listed here...</div>

    
    <?php
    $mysqli = new mysqli("localhost", "root", "", "cs451r");
    if ($mysqli->connect_error) {
        exit('Could not connect');
    }

    $level = isset($_GET['level']) ? $_GET['level'] : "";
    $major = isset($_GET['major']) ? $_GET['major'] : "";

    $sql = "SELECT firstName, lastName, studentID, email, phoneNumber, currentLevel, GPA, degree, graduatingSemester,
        graduatingYear, hoursCompleted, applyingJob, internationalStudentsCheckbox, GTACert, description, serveInstructor, resume  FROM application WHERE 1 ";

    if (!empty($level) && !empty($major)) {
        $sql .= "AND currentLevel = ? AND degree = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ss", $level, $major);
    } elseif (!empty($level)) {
        $sql .= "AND currentLevel = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $level);
    } elseif (!empty($major)) {
        $sql .= "AND degree = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $major);
    } else {
        $stmt = $mysqli->prepare($sql);
    }

    if ($stmt) {
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($fname, $lname, $sid, $email, $phoneNumber, $currentlevel, $gpa, $degree, $gsem, $gyear, $hcomplete, $applyjob, $istu, $gtacert, $desc, $serv, $resume);

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
        echo "<th>GTA Certification</th>";
        echo "<th>Description</th>";
        echo "<th>Serve Instructor</th>";
        echo "<th>Resume</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        while ($stmt->fetch()) {
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
            if ($gtacert != "" && $gtacert != "null") {
                echo "<td><a href='$gtacert' target='_blank'>View GTACert</a></td>";
            } else {
                echo "<td></td>";
            }
            echo "<td>" . $desc . "</td>";
            echo "<td>" . $serv . "</td>";
            if ($resume != "" && $resume != "null") {
                echo "<td><a href='$resume' target='_blank'>View Resume</a></td>";
            } else {
                echo "<td></td>";
            }
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";

        $stmt->close();
    } else {
        echo "Error in query execution: " . $mysqli->error;
    }

    $mysqli->close();
    ?>
</body>

</html>
