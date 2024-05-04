<?php

require "Conn.php";
include "funcoes.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(isset($_POST['submit'])){

        $cep_empresa = validaCEP('cep-empresa', 'text'); // VALIDAR 
        $estado_empresa = sanitizeData('estado-empresa', 'text');
        $cidade_empresa = sanitizeData('cidade-empresa', 'text');
        $bairro_empresa = sanitizeData('bairro-empresa', 'text');
        $rua_empresa = sanitizeData('rua-empresa', 'text');
        $residencia_empresa = sanitizeData('residencia-empresa', 'text');
        $complemento_empresa = sanitizeData('complemento-empresa', 'text');
        
        try{
            $sql = $pdo->prepare("INSERT INTO enderecos (s_cep_enderecos, 
                                            s_state_enderecos, 
                                            s_city_enderecos, 
                                            s_district_enderecos, 
                                            s_streetname_enderecos, 
                                            s_housenumber_enderecos, 
                                            t_complement_enderecos)
                                        VALUES (:cep,
                                            :estado,
                                            :cidade,
                                            :bairro,
                                            :rua,
                                            :numero,
                                            :complemento)");
            $sql->bindParam(':cep', $cep_empresa);
            $sql->bindParam(':estado', $estado_empresa);
            $sql->bindParam(':cidade', $cidade_empresa);
            $sql->bindParam(':bairro', $bairro_empresa);
            $sql->bindParam(':rua', $rua_empresa);
            $sql->bindParam(':numero', $residencia_empresa);
            $sql->bindParam(':complemento', $complemento_empresa);

            if($sql->execute()){
                header("Location:entidade.php");
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