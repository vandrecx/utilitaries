<?php 

require_once 'Conn.php'; 

function hideEmail(){

    session_start();
    
    $email = $_SESSION['pass_repair'];
    $encript_email = substr($email, 0, 5);
    $result_email = $encript_email . str_repeat("*", strlen($email) - 5);

    session_destroy();

    return $result_email;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Recuperar Senha</title>
</head>
<body>
    <div class="card" style="width: 30%; justify-content: center; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <div class="card-header">
                Recuperar Senha
            </div>
            <div class="card-body">
                <form method="POST" action="ForgotPassword.php">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                        <div id="emailHelp" class="form-text">Insira seu endereço de e-mail para recuperação</div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Enviar</button>
                </form>
                <?php if(isset($_GET['validation']) && $_GET['validation'] == '0' ){ ?>
                    <br>
                    <div class="alert alert-danger" role="alert">
                        Insira um endereço de e-mail cadastrado!
                    </div>
                <?php } ?>
            </div>
        </div>
</body>
</html>