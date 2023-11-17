<?php
session_start();

$_SESSION = array();


session_destroy();

header("Location: Login.php?message=You+have+been+logged+out.");
exit();
?>
