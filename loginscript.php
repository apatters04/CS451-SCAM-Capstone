<?php
session_start();
$servername = "localhost";
$username = "root";
$password = ""; 
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
    $stmt = $conn->prepare("SELECT idNo, type FROM login WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $type = $row['type'];
        $idNo = $row['idNo'];

        $_SESSION['idNo'] = $idNo;

        if ($type == 'admin') {
            echo $idNo;
            header("Location: postlogin.php");
        } elseif ($type == 'student') {
            header("Location: studentpostlogin.php");
        }
        exit();
    } else {
        session_destroy();

        header("Location: Login.php?message=Invalid+username+or+password.+Please+create+an+account+below");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
