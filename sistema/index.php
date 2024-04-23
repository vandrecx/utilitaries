<?php

require_once 'conn.php';
include_once 'bd.php';

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste Geral do Banco de Dados</title>
</head>
<body>
    <h1>CRUD do Estoque</h1>
        <?php

        $result = select_all($conn, 'estoque');

        echo "<table>";
        echo "<tr><th>ID</th><th>Nome</th><th>Quantidade</th><th>Valor</th></tr>";

        while($estoque=$result->fetch_assoc()){

            //CRIPTOGRAFA ID
            $hash_id_256 = hash('sha256', $estoque['i_id_estoque']);

            echo "<tr>";
            echo "<td>{$estoque['i_id_estoque']}</td><td><a href='info_estoque.php?i_id_estoque=$hash_id_256'>{$estoque['s_productname_estoque']}</a></td><td>{$estoque['i_amount_estoque']}</td><td>{$estoque['f_unitaryvalue_estoque']}</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        ?>
</body>
</html>