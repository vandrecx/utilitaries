<?php

define('HOSTNAME', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DBNAME', 'sistema');

$conn = new mysqli(HOSTNAME, USERNAME, PASSWORD, DBNAME);

if($conn->errno){
    die("Falha na conexão: ".$conn->error);
}else{
    //echo "Conexão realizada com sucesso!";
}

?>