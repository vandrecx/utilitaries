<?php

require "Conn.php";
include "funcoes.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(isset($_POST['submit'])){

        $nome_empresa = sanitizeData($_POST['nome-empresa']);
        $email_empresa = ;
        $tel_empresa = ;
        $website = ;
        $cnpj = ;
        $banco = ;
        $conta = ;
        $agencia = ;
        $faturamento = ;
        $lucro = ;
        $despesas = ;
        $categoria = ;

    }

}else{

    echo "Método de requisição inválido";

}

?>