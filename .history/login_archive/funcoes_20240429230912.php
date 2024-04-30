<?php

function sanitizeData($input, $type){
    switch ($type){
        case 'text':
            return filter_input(INPUT_POST, $input, FILTER_SANITIZE_SPECIAL_CHARS);
            break;
        case 'email':
            return filter_input(INPUT_POST, $input, FILTER_SANITIZE_EMAIL);
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

?>