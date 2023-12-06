<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mysqli = new mysqli("localhost", "root", "", "cs451r");
    if ($mysqli->connect_error) {
        exit('Could not connect');
    }

    $statuses = isset($_POST['status']) ? $_POST['status'] : [];

    foreach ($statuses as $key => $status) {
        $studentID = $_POST['studentID'][$key];
        $updateSql = "UPDATE application SET status = ? WHERE studentID = ?";
        $updateStmt = $mysqli->prepare($updateSql);
        $updateStmt->bind_param("ss", $status, $studentID);

        $updateSuccessful = $updateStmt->execute();

        $updateStmt->close();
    }

    $mysqli->close();

    if ($updateSuccessful) {
        header("Location: postlogin.php?statusUpdateSuccess=1");
        exit();
    } else {
        header("Location: postlogin.php?statusUpdateError=1");
        exit();
    }
}
?>
