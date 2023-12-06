<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "cs451r");
if ($mysqli->connect_error) {
    exit('Could not connect');
}

$level = isset($_GET['level']) ? $_GET['level'] : "";
$search = isset($_GET['search']) ? $_GET['search'] : "";

$statusOptions = array("Submitted", "Reviewing", "Rejected", "Interviewing");

$searchableColumns = array("firstName", "lastName", "currentLevel", "degree", "applyingJob", "internationalStudent", "serveInstructor");

$sql = "SELECT firstName, lastName, studentID, email, phoneNumber, currentLevel, GPA, degree, graduatingSemester,
    graduatingYear, hoursCompleted, applyingJob, internationalStudent, GTACert, description, serveInstructor, resume, timestamp, status FROM application WHERE 1 ";

if (!empty($level)) {
    $sql .= "AND currentLevel = ? ";
}

if (!empty($search)) {
    $sql .= "AND (";
    foreach ($searchableColumns as $column) {
        $sql .= "$column LIKE ? OR ";
    }
    $sql = rtrim($sql, " OR "); 
    $sql .= ") ";
}

$stmt = $mysqli->prepare($sql);

if ($stmt) {
    $paramTypes = "";
    $bindParams = array();

    if (!empty($level)) {
        $paramTypes .= "s";
        $bindParams[] = &$level;
    }

    if (!empty($search)) {
        for ($i = 0; $i < count($searchableColumns); $i++) {
            $paramTypes .= "s";
            $searchParam = "%$search%";
            $bindParams[] = &$searchParam;
        }
    }

    if (!empty($paramTypes)) {
        array_unshift($bindParams, $paramTypes);
        call_user_func_array([$stmt, "bind_param"], $bindParams);
    }

    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($fname, $lname, $sid, $email, $phoneNumber, $currentlevel, $gpa, $degree, $gsem, $gyear, $hcomplete, $applyjob, $istu, $gtacert, $desc, $serv, $resume, $timestamp, $status);

    echo "<form method='post' action='update_status.php'>";
    echo "<div style='max-height: 600px; overflow: auto; border: 5px inset #0072bb;'>";
    echo "<table class='table table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Name</th>";
    echo "<th>Student ID</th>";
    echo "<th>Email</th>";
    echo "<th>Phone Number</th>";
    echo "<th>Current Level</th>";
    echo "<th>GPA</th>";
    echo "<th>Degree</th>";
    echo "<th>Graduating Semester & Year</th>";
    echo "<th>Hours Completed</th>";
    echo "<th>Applying Job</th>";
    echo "<th>International Students</th>";
    echo "<th>GTA Certification</th>";
    echo "<th>Serve Instructor</th>";
    echo "<th>Resume</th>";
    echo "<th>Timestamp</th>";
    echo "<th>Status</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    while ($stmt->fetch()) {
        echo "<tr>";
        echo "<td>" . $fname . " ". $lname ."</td>";
        echo "<td>" . $sid . "</td>";
        echo "<td>" . $email . "</td>";
        $formattedPhoneNumber = sprintf("(%s) %s-%s",
            substr($phoneNumber, 0, 3),
            substr($phoneNumber, 3, 3),
            substr($phoneNumber, 6)
                );
        echo "<td>" . $formattedPhoneNumber . "</td>";
        echo "<td>" . $currentlevel . "</td>";
        echo "<td>" . $gpa . "</td>";
        echo "<td>" . $degree . "</td>";
        echo "<td>" . $gsem . " " .  $gyear . "</td>";
        echo "<td>" . $hcomplete . "</td>";
        echo "<td>" . $applyjob . "</td>";
        echo "<td>" . $istu . "</td>";
        echo "<td>";
        if ($gtacert != "" && $gtacert != "null") {
            echo "<a href='$gtacert' target='_blank'>View GTACert</a>";
        }
        echo "</td>";
        echo "<td>" . $serv . "</td>";
        echo "<td>";
        if ($resume != "" && $resume != "null") {
            echo "<a href='$resume' target='_blank'>View Resume</a>";
        }
        echo "</td>";
        echo "<td>" . date('m-d-Y', strtotime($timestamp)) . "</td>";
        echo "<td>";
        echo "<select name='status[]'>";
        foreach ($statusOptions as $option) {
            $selected = ($option == $status) ? "selected" : "";
            echo "<option value='$option' $selected>$option</option>";
        }
        echo "</select>";
        echo "</td>";
        echo "<td><input type='hidden' name='studentID[]' value='$sid'></td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";
    echo "<input type='submit' value='Update Status'>";
    echo "</form>";

    $stmt->close();
} else {
    echo "Error in query execution: " . $mysqli->error;
}

$mysqli->close();
?>
