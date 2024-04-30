<?php

require_once 'Conn.php';

// FUNÇÃO RESPONSÁVEL POR SANITIZAR OS DADOS PASSADOS POR POST
function sanitizeData($input_name, $type){
    switch ($type){

        case 'text':
            return filter_input(INPUT_POST, $input_name, FILTER_SANITIZE_SPECIAL_CHARS);
            break;

        case 'email':
            $email = filter_input(INPUT_POST, $input_name, FILTER_SANITIZE_EMAIL);
            //VALIDAR EMAIL AQUI NO MEIO
            return $email;
            break;

        case 'url':
            return filter_input(INPUT_POST, $input_name, FILTER_SANITIZE_URL);
            break;

        case 'int':
            return filter_input(INPUT_POST, $input_name, FILTER_SANITIZE_NUMBER_INT);
            break;

        case 'float':
            return filter_input(INPUT_POST, $input_name, FILTER_SANITIZE_NUMBER_FLOAT);
            break;

        default:
            return $input_name;
    }
}

// GERA SENHA ALEATÓRIA DE 6 CARACTERES
function generatePassword(){
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+';
    return substr(str_shuffle($chars), 0, 5) . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_=+'), 0, 1);
}

// ATUALIZA SENHA (usada em ForgotPassword.php)
function updatePass($newpass, $email, $pdo){

    try{

        $update = $pdo->prepare("UPDATE user SET s_password_user = :new_pass WHERE s_email_user = :s_email_user");
        $update->bindParam(':new_pass', $newpass);
        $update->bindParam(':s_email_user', $email);
        $update->execute();

    } catch(PDOException $err) {

        echo 'Erro na atualização: ' . $err;

    }
    
}

?>