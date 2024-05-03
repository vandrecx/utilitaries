<?php

require "Conn.php";
include "funcoes.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(isset($_POST['submit'])){

        $nome_empresa = sanitizeData($_POST['nome-empresa'], 'text');
        $email_empresa = sanitizeData($_POST['email-empresa'], 'email');
        $tel_empresa = formataTelefoneFixo($_POST['telefone-empresa']);
        $website = sanitizeData($_POST['website-empresa'], 'url');
        $cnpj = ;
        $banco = htmlspecialchars($_POST['banco-empresa']);
        $conta = htmlspecialchars($_POST['conta-empresa']);;
        $agencia = htmlspecialchars($_POST['agencia-empresa']);;
        $faturamento = ;
        $lucro = ;
        $despesas = ;
        $categoria = isset($_POST['select-empresa']) ? htmlspecialchars($_POST['select-empresa']) : '';

    }

}else{

    echo "Método de requisição inválido";

}

?>