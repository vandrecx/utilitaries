<?php

function sanitizeData($string){
    $formated_string = filter_input(INPUT_POST, $string, FILTER_SANITIZE_SPECIAL_CHARS);
    return $formated_string;
}

?>