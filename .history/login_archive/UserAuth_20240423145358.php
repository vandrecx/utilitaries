<?php
require_once 'Conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT s_email_user, s_password_user FROM user WHERE s_email_user='$email' ";
    $result = $conn->query($sql);

    if($result->num_rows>0){

        $check_password = $sql . "AND s_password_user = '$password' ";
        $result_password = $conn->query($check_password);

        if($result_password->num_rows>0){

            $check_office = $check_password . "AND b_isadmin_user = 0";
            $result_office = $conn->query($check_office);

            if($result_office->num_rows>0){
                header("Location: userpage.php");
                exit();
            }else{
                header("Location: adminpage.php");
                exit();
            }    
        }else{
            header("Location: index.php?validation=1");
        }
    }else{
        header("Location: index.php?validation=0");
    }
} else {
    echo "Método de requisição inválido";
}
?>
