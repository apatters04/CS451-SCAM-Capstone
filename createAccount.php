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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $studentID = $_POST['studentID'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO login (firstName, lastName, studentID, username, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $firstName, $lastName, $studentID, $username, $password);

    if ($stmt->execute()) {
        $message = "Account created successfully. Please log in to continue.";
        header("Location: Login.php?message=" . urlencode($message)); 
        exit();

    } else {
        echo "Error creating account: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>