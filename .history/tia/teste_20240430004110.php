<?php

$input = "tododia@gmail.com";

$email = filter_input(INPUT_POST, $input, FILTER_SANITIZE_EMAIL); // FILTRA O E-MAIL

            /*if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // VALIDA O E-MAIL
                echo "$email";
            } else {
                return false; 
            }*/
echo "$email";

?>