<?php
require_once 'Conn.php';

function generatePassword(){
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+';
    return substr(str_shuffle($chars), 0, 5) . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_=+'), 0, 1);
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];

    $check_email = "SELECT s_email_user, s_repair_user FROM user WHERE s_email_user = '$email'";
    $result_check = $conn->query($check_email);

    if($result_check->num_rows>0){
        $new_pass = generatePassword();

        $send_to = $result_check->fetch_assoc();
        $user_number = $send_to['s_repair_user'];

        $mensagem = urlencode("Sua nova senha é $new_pass. Não compartilhe esta senha com terceiros");
    }else{
        header("Location: recupera_senha.php?validation=0");
    }
}