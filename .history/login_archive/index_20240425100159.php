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
    <title>Página de Login</title>
</head>
<body>
    <div class="card" style="width: 30%; justify-content: center; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <div class="card-header">
            Login
        </div>
        <div class="card-body">
            <form method="POST" action="UserAuth.php">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                    <div id="emailHelp" class="form-text">Seu e-mail não será compartilhado com terceiros.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                </div>
                <div class="mb-3">
                    <a href="recupera_senha.php">Esqueceu a senha?</a>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Continue</button>
            </form>
                <?php if(isset($_GET['validation']) && $_GET['validation'] == '0'){ ?>
                    <br>
                    <div class="alert alert-danger" role="alert">
                        E-mail ou senha estão incorretos!
                    </div>
                <?php }else if(isset($_GET['validation']) && $_GET['validation'] == '1'){ ?>
                    <br>
                    <div class="alert alert-danger" role="alert">
                        Senha incorreta!
                    </div>
                <?php }else if(isset($_GET['validation']) && $_GET['validation'] == '2'){ ?>
                    <br>
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Senha alterada com sucesso!</h4>
                        <hr>
                        <p class="mb-0">Uma nova senha foi enviada para o e-mail <strong><?php echo hideEmail(); ?></strong></p>
                    </div>
                <?php } ?>
        </div>
    </div>
</body>
</html>