<?php
require_once 'Conn.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];

    $check_email = "SELECT s_email_user FROM user WHERE s_email_user = '$email'";
    $result_check = $conn->query($check_email);

    if($result_check->num_rows>0){
        $msg;
    }else{
        header("Location: index.php?validation=0");
    }
}