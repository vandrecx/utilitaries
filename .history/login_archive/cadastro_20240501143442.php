<?php 

require_once 'Conn.php';
include 'funcoes.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Página de Cadastro</title>
</head>
<body>
    <div class="card" style="width: 50%; justify-content: center; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <div class="card-header">
            Cadastro
        </div>
        <div class="card-body">
            <form method="POST" action="UserAuth.php">
            </form>
        </div>
    </div>
</body>
</html>