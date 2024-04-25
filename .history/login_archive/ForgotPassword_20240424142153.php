<?php
require_once 'Conn.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];

    $check_email = "SELECT s_email_user, s_tel_user FROM user WHERE s_email_user = '$email'";
    $result_check = $conn->query($check_email);

    if($result_check->num_rows>0){
        $auth_code = mt_rand(100000, 999999);

        $send_to = $result_check->fetch_assoc();
        $user_number = $send_to['s_tel_user'];

        $mensagem = urlencode("[Celke] Codigo de verificacao: $auth_code");
    }else{
        header("Location: recupera_senha.php?validation=0");
    }
}