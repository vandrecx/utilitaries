<?php

require "Conn.php";
include "funcoes.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(isset($_POST['submit'])){

        $cep_empresa = sanitizeData('cep-empresa', 'text'); // VALIDAR 
        $estado_empresa = sanitizeData('estado-empresa', 'text');
        $cidade_empresa = sanitizeData('cidade-empresa', 'text');
        $bairro_empresa = sanitizeData('bairro-empresa', 'text');
        $rua_empresa = sanitizeData('rua-empresa', 'text');
        $residencia_empresa = sanitizeData('residencia-empresa', 'text');
        $complemento_empresa = sanitizeData('complemento-empresa', 'text');
        
        try{
            $sql = $pdo->prepare("INSERT INTO enderecos (s_name_empresa, 
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
                                            NOW(),NULL,1)");
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