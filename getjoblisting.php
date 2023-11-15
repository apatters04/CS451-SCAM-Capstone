<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "cs451r");
if($mysqli->connect_error) {
    exit('Could not connect');
}

$jobType = isset($_GET['jobType']) ? $_GET['jobType'] : "";
$department = isset($_GET['courseCode']) ? $_GET['courseCode'] : "";
$day = isset($_GET['day']) ? $_GET['day'] : "";

$sql = "SELECT jobType, courseCode, courseInstructor, courseDays, courseTime FROM activejobs WHERE 1 ";

if (!empty($jobType)) {
    $sql .= "AND jobType = '$jobType' ";
}

if (!empty($department)) {
    $sql .= "AND courseCode LIKE '%$department%' ";
}

if (!empty($day)) {
    $sql .= "AND courseDays LIKE '%$day%' ";
}

$result = $mysqli->query($sql);

if ($result) {
    echo "<table class='table table-hover'>
            <tr>
                <th scope='col'>Job Type</th>
                <th>Course</th>
                <th>Instructor</th>
                <th>Day</th>
                <th>Time</th>
            </tr>";

            while($row = $result->fetch_assoc()) {
                $courseTime = $row["courseTime"];
                $formattedCourseTime = date("h:i A", strtotime($courseTime));
                echo "<tr>
                        <td>" . $row["jobType"] . "</td>
                        <td>" . $row["courseCode"] . "</td>
                        <td>" . $row["courseInstructor"] . "</td>
                        <td>" . $row["courseDays"] . "</td>
                        <td>" . $formattedCourseTime . "</td>
                    </tr>";
            }

    echo "</table>";
} else {
    echo "Error in query execution: " . $mysqli->error;
}

$mysqli->close();
?>
