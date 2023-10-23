<?php
$servername = "localhost";
$username = "root"; // Change this
$password = ""; // Change this
$dbname = "CS451R";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM login WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Successful login, redirect to postlogin.php
        header("Location: postlogin.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
}

$conn->close();
?>
