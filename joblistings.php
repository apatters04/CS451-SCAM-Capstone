<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cs451r";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$job = $_POST['job'];
$degree = $_POST['degree'];
$day = $_POST['day'];

$sql = "SELECT * FROM activejobs WHERE jobType = '$job' AND department = '$degree' AND day = '$day'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p>" . $row["jobType"] . " - " . $row["courseCode"] . "</p>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
