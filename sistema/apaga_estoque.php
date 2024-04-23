<?php

require_once "conn.php";

$id = $_POST['i_id_estoque'];
$tablename = $_POST['tablename'];

$sql = "UPDATE " . $tablename . " SET b_isavaible_" . $tablename . " = 0 WHERE i_id_" . $tablename . " =" . $id;
$conn->query($sql);

header("Location: index.php");

?>