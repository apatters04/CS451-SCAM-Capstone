<?php
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
                let courseTime = formatTime($row["courseTime"]);
                console.log(courseTime);
            
                let newRow = "<tr>" +
                    "<td>" + $row["jobType"] + "</td>" +
                    "<td>" + $row["courseCode"] + "</td>" +
                    "<td>" + $row["courseInstructor"] + "</td>" +
                    "<td>" + $row["courseDays"] + "</td>" +
                    "<td>" + courseTime + "</td>" +
                    "</tr>";
            
                document.getElementById("jobListings").innerHTML += newRow;
            }
            
            function formatTime(time) {
                let date = new Date("2023-01-01 " + time);
                let options = { hour: 'numeric', minute: 'numeric', hour12: true };
                return new Intl.DateTimeFormat('en-US', options).format(date);
            }
  

    echo "</table>";
} else {
    echo "Error in query execution: " . $mysqli->error;
}

$mysqli->close();
?>
