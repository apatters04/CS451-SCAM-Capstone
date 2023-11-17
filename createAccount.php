<?php
session_start();
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cs451r";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phoneNo = $_POST['phoneNo'];
    $studentID = $_POST['studentID'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("INSERT INTO login (firstName, lastName, email, phoneNo, studentID, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiiss", $firstName, $lastName, $email, $phoneNo, $studentID, $username, $password);


    if ($stmt->execute()) {
        $message = "Account created successfully. Please log in to";
        header("Location: Login.php?message=" . urlencode($message)); 
        exit();

    } else {
        echo "Error creating account: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>