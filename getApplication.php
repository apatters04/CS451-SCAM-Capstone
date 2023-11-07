<?php
$mysqli = new mysqli("localhost", "root", "", "cs451r");
if($mysqli->connect_error) {
    exit('Could not connect');
}

$level = isset($_GET['level']) ? $_GET['level'] : "";
$major = isset($_GET['major']) ? $_GET['major'] : "";

$sql = "SELECT firstName, lastName, studentID, email, phoneNumber, currentLevel, GPA, degree, graduatingSemester,
    graduatingYear, hoursCompleted, applyingJob, internationalStudentsCheckbox, GTACert, description, serveInstructor, resume, timestamp  FROM application WHERE 1 ";

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
    $stmt->bind_result($fname, $lname, $sid, $email, $phoneNumber, $currentlevel, $gpa, $degree, $gsem, $gyear, $hcomplete, $applyjob, $istu, $gtacert, $desc, $serv, $resume, $timestamp);

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
    echo "<th>Timestamp</th>";
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
        echo "<td>" . $timestamp . "</td>";
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
