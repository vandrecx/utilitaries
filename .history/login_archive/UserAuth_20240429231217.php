<?php
require_once 'Conn.php';
include 'funcoes.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['submit'])){
        $email = sanitizeData($_POST['email'], 'email');
        $password = $_POST['password'];

        $sql = "SELECT i_id_user, s_name_user, s_email_user, s_password_user FROM user WHERE s_email_user='$email' ";
        $result = $conn->query($sql);

        if($result->num_rows>0){

            $check_password = $sql . "AND s_password_user = '$password' ";
            $result_password = $conn->query($check_password);

            if($result_password->num_rows>0){

                $check_office = $check_password . "AND b_isadmin_user = 0";
                $result_office = $conn->query($check_office);

                $session_care = $result_password->fetch_assoc();

                if($result_office->num_rows>0){

                    $_SESSION['ID'] = $session_care['i_id_user'];
                    $_SESSION['Email'] = $session_care['s_email_user'];
                    $_SESSION['Name'] = $session_care['s_name_user'];
                    $_SESSION['Cargo'] = "User";
                    header("Location: userpage.php");
                    exit();

                }else{

                    $_SESSION['ID'] = $session_care['i_id_user'];
                    $_SESSION['Email'] = $session_care['s_email_user'];
                    $_SESSION['Name'] = $session_care['s_name_user'];
                    $_SESSION['Cargo'] = "Admin";
                    header("Location: adminpage.php");
                    exit();
                }    
            }else{
                header("Location: index.php?validation=1");
            }
        }else{
            header("Location: index.php?validation=0");
        }
    }
    
} else {
    echo "Método de requisição inválido";
}
?>
