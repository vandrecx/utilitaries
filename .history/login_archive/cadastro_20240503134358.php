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
        <p class="fs-2">Fale-nos sobre sua empresa.</p>
        <div class="card">
            <div class="card-header">
                Cadastro
            </div>
            <div class="card-body">
                <p class="fs-4">Dados da Empresa</p>
                <form method="POST" action="UserSignUp.php">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Nome da Empresa *</span>
                        <input type="text" name="nome-empresa" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">E-mail da Empresa *</span>
                        <input type="text" name="email-empresa" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">CNPJ *</span>
                        <input type="text" name="cnpj" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Telefone *</span>
                        <input type="text" name="telefone-empresa" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                        <span class="input-group-text" id="inputGroup-sizing-default">Website</span>
                        <input type="text" name="website-empresa" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <p class="fs-4">Informações Financeiras</p>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Banco</span>
                        <input type="text" name="banco-empresa" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Conta</span>
                        <input type="text" name="conta-empresa" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        <span class="input-group-text" id="inputGroup-sizing-default">Agência</span>
                        <input type="text" name="agencia-empresa" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Faturamento</span>
                        <input type="text" name="faturamento-empresa" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        <span class="input-group-text" id="inputGroup-sizing-default">Lucro Líquido</span>
                        <input type="text" name="lucro-empresa" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Despesas</span>
                        <input type="text" name="despesas-empresa" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        <span class="input-group-text" id="inputGroup-sizing-default">Categoria *</span>
                        <select class="form-select form-select-sm" name="select-empresa" aria-label="Large select example" required>
                            <option selected>Categoria da sua empresa</option>
                            <option value="ps">Prestação de Serviços</option>
                            <option value="industria">Indústria</option>
                            <option value="vendas">Vendas</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Continue</button>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>