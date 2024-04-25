<?php require_once 'Conn.php'; ?>

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
                    <a href="ForgotPassword.php">Esqueceu a senha?</a>
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
                <?php } ?>
        </div>
    </div>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="..." class="rounded me-2" alt="...">
      <strong class="me-auto">Bootstrap</strong>
      <small>11 mins ago</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      Hello, world! This is a toast message.
    </div>
  </div>
</div>
</body>
</html>