<?php
$servername = "localhost";
$usuario = "root"; // Substitua por seu nome de usuário, se diferente
$password = ""; // Substitua por sua senha, se houver
$dbname = "4DREAM_bd";
$conn = new mysqli($servername, $usuario, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Criar a tabela usuarios se não existir
$sql = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    quantidade_doacoes INT NOT NULL,
    o_que_doou TEXT NOT NULL
)";

if ($conn->query($sql) === FALSE) {
    die("Erro ao criar tabela: " . $conn->error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $quantidade_doacoes = $_POST['quantidade_doacoes'];
    $o_que_doou = $_POST['o_que_doou'];

    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, telefone, endereco, quantidade_doacoes, o_que_doou) 
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nome, $email, $telefone, $endereco, $quantidade_doacoes, $o_que_doou);

    if ($stmt->execute()) {
        echo "Nova doação registrada com sucesso";
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
