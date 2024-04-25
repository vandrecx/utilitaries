<?php 

session_start(); 

$email = $_SESSION['pass_repair'];
$encript_email = substr($email, 0, 5);
$result_email = $encript_email . str_repeat("*", strlen($email) - 5);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Senha alterada</title>
</head>
<body>
    <div class="card" style="width: 30%; justify-content: center; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <div class="card-body">
                <h5 class="card-title">Senha alterada com sucesso!</h5>
                <p class="card-text">Uma nova senha foi enviada para o e-mail <strong><?php echo "$result_email"?></strong>.</p>
                <a href="index.php" class="btn btn-primary">Login Page</a>
            </div>
    </div>
</body>
</html>

<?php session_destroy(); ?>