<?php
require_once 'Conn.php';
require "vendor/autoload.php";
include 'funcoes.php';

use PHPmailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'C:\xampp\htdocs\login_archive\vendor\phpmailer\phpmailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\login_archive\vendor\phpmailer\phpmailer\src\SMTP.php';


session_start();

// ENVIA EMAIL COM USO DO PHPMAILER 
function sendEmail($send_to, $user_name, $new_pass,){

    include 'variaveis_de_ambiente.php';

    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->Username = EMAIL; // CONSTANTES ARMAZENADAS NUM ARQUIVO DE VARIÁVEIS DE AMBIENTE
    $mail->Password = SMTP_PASSWORD; // CONSTANTES ARMAZENADAS NUM ARQUIVO DE VARIÁVEIS DE AMBIENTE

    $sender_email = EMAIL; // CONSTANTES ARMAZENADAS NUM ARQUIVO DE VARIÁVEIS DE AMBIENTE
    $who_send = "Equipe Consulte";
    $mail->setFrom($sender_email, $who_send);
    $mail->addAddress("$send_to", "$user_name");

    $mail->Subject = "Password recovery";
    $mail->Body = "Sua nova senha é $new_pass, você pode alterá-la posteriormente. Não compartilhe com terceiros.";

    $mail->send();
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $email = sanitizeData('email', 'email'); // SANITIZA EMAIL

    try{

        $check_email = $pdo->prepare("SELECT empresa.s_name_empresa, s_email_entidade, s_repairemail_entidade FROM entidade INNER JOIN empresa WHERE empresa.i_id_empresa = entidade.fk_enterprise_entidade AND s_email_entidade = :email");
        $check_email->bindParam(':email', $email);  // ATRIBUI $email AO :s_email_user SEM UTILIZAR A VARÍAVEL NO SQL PREVININDO ATAQUES
        $check_email->execute(); // EXECUTA A QUERY

        if ($check_email->rowCount()>0) { // CONFERE SE HÁ QUERIES CORRESPONDENTES

            $result = $check_email->fetch(PDO::FETCH_ASSOC); // TRANSFORMA QUERY EM ARRRAY
            $user_repair = $result['s_repairemail_entidade']; // ATRIBUI O E-MAIL DE REPARO A VARIAVEL $user_repair
            $user_name = $result['s_name_empresa']; // ATRIBUI O NOME DO USUÁRIO A VARIAVEL $user_name

            $new_pass = generatePassword(); // ATRIBUI SENHA ALEATÓRIA

            updatePass($new_pass, $email, $pdo); // ATUALIZA SENHA

            $_SESSION['pass_repair'] = $user_repair; // E-MAIL PASSADO PARA EXIBIÇÃO NA TELA INICIAL

            sendEmail($user_repair, $user_name, $new_pass); // ENVIA E-MAIL

            header("Location: index.php?validation=2"); // E-MAIL ENVIADO COM SUCESSO
            exit();

        } else {

            header("Location: recupera_senha.php?validation=0"); // SENHA INCORRETA
            exit();

        }   

    }catch(PDOException $err){

        echo "Erro de consulta: " . $err; // TRATA ERROS

    }
}