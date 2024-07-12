<?php
$servername = "localhost";
$username = "root"; // Seu nome de usuário do MySQL
$password = ""; // Sua senha do MySQL, se houver
$dbname = "4DREAM_bd"; // Nome do seu banco de dados

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
