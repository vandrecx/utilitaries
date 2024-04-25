<?php
require_once 'Conn.php';
require "vendor/autoload.php";

use PHPmailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'C:\xampp\htdocs\login_archive\vendor\phpmailer\phpmailer\src\PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


session_start();

function generatePassword(){
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+';
    return substr(str_shuffle($chars), 0, 5) . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_=+'), 0, 1);
}

function sendEmail($send_to, $user_name, $new_pass){

    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->Username = "vcortesoliveira@gmail.com";
    $mail->Password = "invhshahtgmrvbgc";

    $mail->setFrom($send_to, $user_name);
    $mail->addAddress("vcortesoliveira@gmail.com", "Equipe Consulte");

    $mail->Subject = "Password recovery";
    $mail->Body = "Sua nova senha é $new_pass, você pode alterá-la posteriormente. Não compartilhe com terceiros.";

    $mail->send();
}

function updatePass($newpass, $email, $conn){
    $update = "UPDATE user SET s_password_user = '$newpass' WHERE s_email_user = '$email'";
    $conn->query($update);
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];

    $check_email = "SELECT s_name_user, s_email_user, s_repair_user FROM user WHERE s_email_user = '$email'";
    $result_check = $conn->query($check_email);

    if($result_check->num_rows>0){
        $new_pass = generatePassword();

        $send_to = $result_check->fetch_assoc();
        $user_repair = $send_to['s_repair_user'];
        $user_name = $send_to['s_name_user'];

        $_SESSION['pass_repair'] = $user_repair;

        updatePass($new_pass, $email, $conn);

        sendEmail($user_repair, $user_name, $new_pass);

        header("Location: confirma_senha.php");
    }else{
        header("Location: recupera_senha.php?validation=0");
    }
}