<?php
require_once 'Conn.php';
include 'funcoes.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // POST METHOD

    if (isset($_POST['submit'])) { // INPUT SUBMIT

        $email = sanitizeData('email', 'email'); // SANITIZA OS DADOS PREVININDO INJEÇÃO SQL E POSSÍVEIS XSS ... sanitizeData()=>funcoes.php
        $password = $_POST['password']; // SENHA NÃO PRECISA DE SANITIZAÇÃO

        try{

            $sql = $pdo->prepare("SELECT i_id_user, s_name_user, s_email_user, s_password_user FROM user WHERE s_email_user = :s_email_user"); // Prepara o statement para escapar os dados para execução
            $sql->bindParam(':s_email_user', $email); // ATRIBUI $email AO :s_email_user SEM UTILIZAR A VARÍAVEL NO SQL PREVININDO ATAQUES
            $sql->execute(); // EXECUTA A QUERY

            $user = $sql->fetch(PDO::FETCH_ASSOC); // TRANSFORMA A QUERY NUM ITERAVEL
    
            if ($user) { // VERIFICA O USUÁRIO
            
                if ($password == $user['s_password_user']) { // VERIFICA SENHA

                        $_SESSION['ID'] = $user['i_id_user'];
                        $_SESSION['Email'] = $user['s_email_user'];
                        $_SESSION['Name'] = $user['s_name_user'];
                        $_SESSION['Cargo'] = $user['b_isadmin_user'] == 0 ? "User" : "Admin"; // SETA O USER/ADMIN
                        
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
