<?php

require_once 'conn.php';

$id = $_GET['i_id_estoque'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    //DESCRIPTOGRAFA O ID QUE FOI PASSADO CRIPTOGRAFADO POR GET
    $sql_descript = "SELECT i_id_estoque FROM estoque";
    $result_descript = $conn->query($sql_descript);

    while($estoque_descript = $result_descript->fetch_assoc()){
        foreach ($estoque_descript as $id_estoque) {
            if(hash('sha256', $id_estoque)===$id){
                $id_venda = $id_estoque;
                $sql_estoque = "SELECT entidade.s_name_entidade, 
                                        permissoes.s_office_permissoes,
                                        estoque.i_id_estoque, 
                                        estoque.s_productname_estoque,
                                        estoque.i_amount_estoque,
                                        estoque.f_unitaryvalue_estoque,
                                        estoque.t_description_estoque,
                                        estoque.b_isavaible_estoque,
                                        estoque.dt_createdon_estoque,
                                        estoque.dt_changedon_estoque
                                        FROM estoque
                                        INNER JOIN entidade ON entidade.i_id_entidade = estoque.fk_adder_estoque 
                                        INNER JOIN permissoes ON permissoes.i_id_permissoes = entidade.fk_permissions_entidade
                                        WHERE i_id_estoque = $id_estoque";
                $result_estoque = $conn->query($sql_estoque);
            }
        }
    }

    echo "<h1>Situação no Estoque</h1>";

    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Responsável</th><th>Cargo</th><th>Nome do Produto</th><th>Quantidade</th><th>Valor</th><th>Disponível</th><th>Criado em</th><th>Editado em</th></tr>";

    while($estoque = $result_estoque->fetch_assoc()){
        echo "<tr>";
        echo "<td>{$estoque['i_id_estoque']}</td><td>{$estoque['s_name_entidade']}</td><td>{$estoque['s_office_permissoes']}</td><td>{$estoque['s_productname_estoque']}</td><td>{$estoque['i_amount_estoque']}</td><td>{$estoque['f_unitaryvalue_estoque']}</td><td>{$estoque['b_isavaible_estoque']}</td><td>{$estoque['dt_createdon_estoque']}</td><td>{$estoque['dt_changedon_estoque']}</td>";
        echo "</tr>";
    }

    echo "</table>";

    echo "<hr>";

    $sql_venda = "SELECT saida.i_id_saida, 
                        venda.i_id_venda, 
                        entidade.s_name_entidade, 
                        estoque.s_productname_estoque, 
                        saida.i_amount_saida, 
                        saida.f_valuesold_saida, 
                        saida.dt_saletime_saida 
                        FROM saida 
                        INNER JOIN venda ON venda.i_id_venda = saida.fk_sellingcode_saida
                        INNER JOIN entidade ON entidade.i_id_entidade = venda.fk_seller_venda 
                        INNER JOIN estoque ON estoque.i_id_estoque = saida.fk_productid_saida 
                        WHERE saida.fk_productid_saida = $id_venda";
    $result_venda = $conn->query($sql_venda);

    echo "<h1>Situação em Vendas</h1>";

    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>ID Venda</th><th>Responsável</th><th>Nome do Produto</th><th>Quantidade</th><th>Valor</th><th>Data de Saída</th>";

    while($vendas = $result_venda->fetch_assoc()){
        echo "<tr>";
        echo "<td>{$vendas['i_id_saida']}</td><td>{$vendas['i_id_venda']}</td><td>{$vendas['s_name_entidade']}</td><td>{$vendas['s_productname_estoque']}</td><td>{$vendas['i_amount_saida']}</td><td>{$vendas['f_valuesold_saida']}</td><td>{$vendas['dt_saletime_saida']}</td>";
        echo "</tr>";
    }

    echo "</table>";

    ?>    
</body>
</html>

