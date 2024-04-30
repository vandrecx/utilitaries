<?php
require_once 'Conn.php';
require "vendor/autoload.php";
include 'funcoes.php';

use PHPmailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'C:\xampp\htdocs\login_archive\vendor\phpmailer\phpmailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\login_archive\vendor\phpmailer\phpmailer\src\SMTP.php';


session_start();

function sendEmail($send_to, $user_name, $new_pass,){

    include 'variaveis_de_ambiente.php';

    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->Username = email;
    $mail->Password = smtp_password;

    $sender_email = email;
    $who_send = "Equipe Consulte";
    $mail->setFrom($sender_email, $who_send);
    $mail->addAddress("$send_to", "$user_name");

    $mail->Subject = "Password recovery";
    $mail->Body = "Sua nova senha é $new_pass, você pode alterá-la posteriormente. Não compartilhe com terceiros.";

    $mail->send();
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $email = sanitizeData($_POST['email'], 'email');

    try{

        $check_email = $pdo->prepare("SELECT s_name_user, s_email_user, s_repair_user FROM user WHERE s_email_user = :email");
        $check_email->bindParam(':email', $email);
        $check_email->execute();

        if ($check_email->rowCount()>0) {

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $user_repair = $result['s_repair_user'];
            $user_name = $result['s_name_user'];

            $new_pass = generatePassword();

            updatePass($new_pass, $email, $pdo);

            $_SESSION['pass_repair'] = $user_repair;

            sendEmail($user_repair, $user_name, $new_pass);

            header("Location: index.php?validation=2");
            exit();

        } else {

            header("Location: recupera_senha.php?validation=0");
            exit();

        }   

    }catch(PDOException $err){

        echo "Erro de consulta: " . $err;

    }
}