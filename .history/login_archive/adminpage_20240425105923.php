<?php 

require_once 'Conn.php';

session_start();

if (!isset($_SESSION['ID'])) {
    header("Location: index.php");
    exit();
}else{
    $user_id = $_SESSION['ID'];
    $user_email = $_SESSION['Email'];
    $user_name = $_SESSION['Name'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Página do Administrador</title>
</head>
<body>
    <ul class="nav justify-content-end">
        <li class="nav-item">
            <a class="nav-link disabled" aria-current="page" ><?php echo "$user_name"?></a>
        </li>
        <li class="nav-item">
            <a href="LogOut.php" class="btn btn-primary">Logout</a>
        </li>
    </ul>
    <div class='card' style='width: 30%; justify-content: center; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);'>
        <div class="card-header">
            Selecione o arquivo para envio
        </div>
        <div class="card-body">
            <form>
                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="inputGroupFile02">
                    <label class="input-group-text" for="inputGroupFile02">Enviar</label>
                </div>
            </form>
        </div>
    </div>
</body>
</html>