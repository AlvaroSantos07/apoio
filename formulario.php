<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Registrar Doação</title>
    <link rel="stylesheet" href = "assets/css/form.css">

</head>
<body>
    <img src="img/fundo-tela-form.jpg" alt="">
    <form action="conexao_bd.php" method="post">
        Nome: <input type="text" name="nome" required><br>
        Email: <input type="email" name="email" required><br>
        Telefone: <input type="text" name="telefone" required><br>
        Endereço: <input type="text" name="endereco" required><br>
        Quantidade de Doações: <input type="number" name="quantidade_doacoes" required><br>
        O Que Doou: <textarea name="o_que_doou" required></textarea><br>
        <input type="submit" value="Registrar Doação">
    </form>
</body>
</html>
