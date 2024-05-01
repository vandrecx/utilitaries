<?php

//PDO (PHP DATA OBJECTS)

$pdo = new PDO("mysql:host=localhost; dbname=sistema; charset=UTF8", "root", ""); // REALIZA CONEXÃO COM PDO
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // EXCEPTIONS

?>