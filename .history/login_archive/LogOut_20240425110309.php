<?php

session_start();

$_SESSION['ID'];
$_SESSION['Email'];
$_SESSION['Name'];

session_destroy();

header("location: index.php");
exit();
?>