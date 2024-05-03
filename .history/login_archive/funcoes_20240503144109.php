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

        $update = $pdo->prepare("UPDATE entidade SET s_password_entidade = :new_pass WHERE s_enterpriseemail_entidade = :s_enterpriseemail_entidade");
        $update->bindParam(':new_pass', $newpass);
        $update->bindParam(':s_enterpriseemail_entidade', $email);
        $update->execute();

    } catch(PDOException $err) {

        echo 'Erro na atualização: ' . $err;

    }
    
}

//ESCONDE EMAIL DE RECUPERAÇÃO PASSADO POR SESSION
function hideEmail(){

    session_start();
    
    $email = $_SESSION['pass_repair'];
    $encript_email = substr($email, 0, 5);
    $result_email = $encript_email . str_repeat("*", strlen($email) - 5);

    session_destroy();

    return $result_email;
}

//FORMATA NÚMERO E RETORNA FORMATADO
function formataNumero($numero){

    $padrao = '/^\(\d{2}\) \d{5}-\d{4}$/';

    sanitizeData($numero, 'text');

    if(preg_match($padrao, $numero)){

        return $numero;

    }else{

        $numero = preg_replace('/\D/', '', $numero);

        if(strlen($numero)!=10){

            header("Location: index.php?validation=0"); // ERRO DE SENHA INVALIDA
            exit();

        }else{

            $numero_formatado = '(' . substr($numero, 0, 2) . ') ' . substr($numero, 2, 5) . '-' . substr($numero, 7);

            return $numero_formatado;
        }
    }
}

function formataTelefone($numero){

    $padrao = '/^\(\d{2}\) [2-9]\d{3}-\d{4}$/';

    sanitizeData($numero, 'text');

    if(preg_match($padrao, $numero)){

        return $numero;

    }else{

        $numero = preg_replace('/\D/', '', $numero);

        if(strlen($numero)!=8){

            header("Location: index.php?validation=0"); // ERRO DE SENHA INVALIDA
            exit();

        }else{

            $numero_formatado = '(' . substr($numero, 0, 2) . ') ' . substr($numero, 2, 5) . '-' . substr($numero, 7);

            return $numero_formatado;
        }
    }
}

?>