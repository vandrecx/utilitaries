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
    <div style="width: 50%; justify-content: center; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <p class="fs-2">Estamos quase lá...</p>
        <div class="card">
            <div class="card-header">
                Cadastro
            </div>
            <div class="card-body">
                <p class="fs-4">Endereço da Empresa</p>
                <form method="POST" action="EnderecoSignUp.php">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">CEP</span>
                        <input type="text" name="cep-empresa" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Estado</span>
                        <input type="text" name="estado-empresa" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                        <span class="input-group-text" id="inputGroup-sizing-default">Cidade</span>
                        <input type="text" name="cidade-empresa" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Bairro</span>
                        <input type="text" name="bairro-empresa" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Rua</span>
                        <input type="text" name="rua-empresa" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        <span class="input-group-text" id="inputGroup-sizing-default">Nº Residência</span>
                        <input type="text" name="residencia-empresa" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Complemento</label>
                        <textarea class="form-control" name="complemento" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Continue</button>
                </form>
                <br>
            </div>
        </div>
    </div>
    
</body>
</html>