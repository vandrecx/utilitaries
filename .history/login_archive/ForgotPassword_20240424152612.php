<?php
require_once 'Conn.php';

session_start();

function generatePassword(){
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+';
    return substr(str_shuffle($chars), 0, 5) . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_=+'), 0, 1);
}

function sendEmail($send_to, $new_pass){
    $headers = "From: no_reply@contact.com\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $subject = "Recuperação de Senha";
    $message = "Sua nova senha é $new_pass. Não compartilhe com terceiros.";

    mail($send_to, $subject, $message, $headers);
}

function updatePass($newpass, $email, $conn){
    $update = "UPDATE user SET s_password_user = '$newpass' WHERE s_email_user = '$email'";
    $conn->query($update);
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];

    $check_email = "SELECT s_email_user, s_repair_user FROM user WHERE s_email_user = '$email'";
    $result_check = $conn->query($check_email);

    if($result_check->num_rows>0){
        $new_pass = generatePassword();

        $send_to = $result_check->fetch_assoc();
        $user_repair = $send_to['s_repair_user'];

        $_SESSION['pass_repair'] = $user_repair;

        updatePass($new_pass, $email, $conn);

        sendEmail($user_repair, $new_pass);

        header("Location: confirma_senha.php");
    }else{
        header("Location: recupera_senha.php?validation=0");
    }
}