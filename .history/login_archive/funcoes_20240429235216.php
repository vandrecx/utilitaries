<?php

function sanitizeData($input, $type){
    switch ($type){

        case 'text':
            return filter_input(INPUT_POST, $input, FILTER_SANITIZE_SPECIAL_CHARS);
            break;

        case 'email':
            $email = filter_input(INPUT_POST, $input, FILTER_SANITIZE_EMAIL); // FILTRA O E-MAIL

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // VALIDA O E-MAIL
                return $email;
            } else {
                return false; 
            }
            break;

        case 'url':
            return filter_input(INPUT_POST, $input, FILTER_SANITIZE_URL);
            break;

        case 'int':
            return filter_input(INPUT_POST, $input, FILTER_SANITIZE_NUMBER_INT);
            break;

        case 'float':
            return filter_input(INPUT_POST, $input, FILTER_SANITIZE_NUMBER_FLOAT);
            break;

        default:
            return $input;
    }
}

function generatePassword(){
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+';
    return substr(str_shuffle($chars), 0, 5) . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_=+'), 0, 1);
}

?>