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
        $cnpj = formataCNPJ(validaCNPJ($_POST['cnpj']));
        $banco = htmlspecialchars($_POST['banco-empresa']);
        $conta = htmlspecialchars($_POST['conta-empresa']);;
        $agencia = htmlspecialchars($_POST['agencia-empresa']);;
        $faturamento = sanitizeData(formataFloat($_POST['faturamento-empresa']), 'float');
        $lucro = sanitizeData(formataFloat($_POST['lucro-empresa']), 'float');
        $despesas = sanitizeData(formataFloat($_POST['despesas-empresa']), 'float');
        $categoria = isset($_POST['select-empresa']) ? htmlspecialchars($_POST['select-empresa']) : '';
        
        try{
            $sql = $pdo->prepare("INSERT INTO empresa (s_name_empresa, 
                                            s_email_empresa, 
                                            s_tel_empresa, 
                                            s_website_empresa, 
                                            s_cnpj_empresa, 
                                            s_bankaccount_empresa, 
                                            s_accountnum_empresa,
                                            s_bankagency_empresa,
                                            f_invoicing_empresa,
                                            f_billing_empresa,
                                            f_expenses_empresa,
                                            s_category_empresa,
                                            dt_createdon_empresa,
                                            dt_changedon_empresa,
                                            b_active_empresa)
                                        VALUES (:nome,
                                            :email,
                                            :tel,
                                            :website,
                                            :cnpj,
                                            :bank,
                                            :account,
                                            :agency,
                                            :invoicing,
                                            :billing,
                                            :expenses,
                                            :category,
                                            NOW(),,1)");
            $sql->bindParam(':nome', $nome_empresa);
            $sql->bindParam(':email', $email_empresa);
            $sql->bindParam(':tel', $tel_empresa);
            $sql->bindParam(':website', $website);
            $sql->bindParam(':cnpj', $cnpj);
            $sql->bindParam(':bank', $banco);
            $sql->bindParam(':account', $conta);
            $sql->bindParam(':agency', $agencia);
            $sql->bindParam(':invoicing', $faturamento);
            $sql->bindParam(':billing', $lucro);
            $sql->bindParam(':expenses', $despesas);
            $sql->bindParam(':category', $categoria);

            if($sql->execute()){
                header("Location:endereco.php");
                exit();
            }else{
                echo "Erro na consulta";
            }

        }catch(PDOException $err){

            echo "Ocorreu um erro: " . $err->getMessage(); // TRATAMENTO DE ERRO

        }
    }

}else{

    echo "Método de requisição inválido";

}

?>