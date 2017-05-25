<?php
// Mensagens de Erro
$msg = array();
$msg[0] = "Conexão com o banco falhou!";
$msg[1] = "Não foi possível selecionar o banco de dados!";
$msg[2] = "Erro ao executar instrução SQL!";
// Fazendo a conexão com o servidor MySQL
$conexao = mysqli_connect("localhost", "usuario", "senha","banco_de_dados")  or die("Error " . mysqli_error($connection));

?>