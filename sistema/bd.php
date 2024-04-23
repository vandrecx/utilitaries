<?php

//Passa o arquivo de conexão como parâmetro e o nome da tabela
//Dá o select all na tabela em questão
function select_all(mixed $conn, string $tablename){
    $sql = "SELECT * FROM " . $tablename . " WHERE b_isavaible_" . $tablename . " = 1";
     return $conn->query($sql);
}

//Aqui ele reduz um trabalho que temos geralmente
//Você manda o arquivo de redirecionamento como string
//O nome da tabela como string
//A variável que armazena o id (ex: '$estoque['i_id_estoque']')
//O nome do botão que deseja
function table_form( $archivename, $tablename, $foreachname, $actionbutton){
    echo "<form action='$archivename' method='POST'>";
    echo "<td>";
    echo "<input type='hidden' value='{$foreachname}' name='i_id_$tablename'>";
    echo "<input type='hidden' value='$tablename' name='tablename'>";
    echo "<input type='submit' value='$actionbutton'>";
    echo "</td>";
    echo "</form>";
}

?>