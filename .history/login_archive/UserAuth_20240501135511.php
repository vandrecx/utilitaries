<?php
require_once 'Conn.php';
include 'funcoes.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // POST METHOD

    if (isset($_POST['submit'])) { // INPUT SUBMIT

        $email = sanitizeData('email', 'email'); // SANITIZA OS DADOS PREVININDO INJEÇÃO SQL E POSSÍVEIS XSS ... sanitizeData()=>funcoes.php
        $password = $_POST['password']; // SENHA NÃO PRECISA DE SANITIZAÇÃO

        try{

            $sql = $pdo->prepare("SELECT i_id_entidade, s_enterprisename_entidade, s_email_entidade, s_password_entidade FROM sistema WHERE s_enterpriseemail_entidade = :s_enterpriseemail_entidade"); // Prepara o statement para escapar os dados para execução
            $sql->bindParam(':s_email_entidade', $email); // ATRIBUI $email AO :s_email_user SEM UTILIZAR A VARÍAVEL NO SQL PREVININDO ATAQUES
            $sql->execute(); // EXECUTA A QUERY

            $user = $sql->fetch(PDO::FETCH_ASSOC); // TRANSFORMA A QUERY NUM ITERAVEL
    
            if ($user) { // VERIFICA O USUÁRIO
            
                if ($password == $user['s_password_entidade']) { // VERIFICA SENHA // ps: password_verify() só verifica senhas previamente criadas por password_hash()

                        $_SESSION['ID'] = $user['i_id_entidade'];
                        $_SESSION['Email'] = $user['s_enterpriseemail_entidade'];
                        $_SESSION['Name'] = $user['s_enterprisename_entidade'];
                        $_SESSION['Cargo'] = $user['fk_permissons_entidade'] == 1 ? "User" : "Admin"; // SETA O USER/ADMIN
                        
                        if ($_SESSION['Cargo'] == "User") {
                            header("Location: userpage.php"); // ENCAMINHA PRA PÁGINA DE USUÁRIO
                        } else {
                            header("Location: adminpage.php"); // ENCAMINHA PRA PÁGINA DE USUÁRIO
                        }

                } else {
                    header("Location: index.php?validation=1"); // ERRO DE SENHA INVALIDA
                    exit();
                }
            } else {
                
                header("Location: index.php?validation=0"); // ERRO DE E-MAIL E SENHA INVÁLIDA
                exit();
            }

        } catch (PDOException $err) {

            echo "Ocorreu um erro: " . $err->getMessage(); // TRATAMENTO DE ERRO 

        }
    }
    
} else {
    echo "Método de requisição inválido";
}

?>
