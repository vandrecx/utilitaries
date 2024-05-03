<?php

require "Conn.php";
include "funcoes.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(isset($_POST['submit'])){

        $nome_empresa = sanitizeData($_POST['nome-empresa'], 'text');
        $email_empresa = sanitizeData($_POST['email-empresa'], 'email');
        $tel_empresa = formataTelefoneFixo($_POST['telefone-empresa']);
        $website = sanitizeData($_POST['website-empresa'], 'text');;
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