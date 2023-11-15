<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mysqli = new mysqli("localhost", "root", "", "cs451r");
    if ($mysqli->connect_error) {
        exit('Could not connect');
    }

    $statuses = isset($_POST['status']) ? $_POST['status'] : [];

    foreach ($statuses as $key => $status) {
        // Assuming studentID is the unique identifier for each application
        $studentID = $_POST['studentID'][$key];

        // Update the status in the database
        $updateSql = "UPDATE application SET status = ? WHERE studentID = ?";
        $updateStmt = $mysqli->prepare($updateSql);
        $updateStmt->bind_param("ss", $status, $studentID);
        $updateStmt->execute();
        $updateStmt->close();
    }

    $mysqli->close();
}

// Redirect back to the original page after updating status
header("Location: postlogin.php");
exit();
?>
