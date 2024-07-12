<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Ranking de Doadores</title>
    <link rel="stylesheet" href="css/form.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Estilo para destacar o doador em primeiro lugar */
        .top-donor {
            font-weight: bold;
            color: #28a745; /* Cor verde para destacar */
        }

        /* Estilo para os botões */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #28a745; /* Cor verde */
            border: none;
            border-radius: 4px;
            text-decoration: none;
            margin: 10px 10px 10px 0; /* Ajuste de margens para espaçamento adequado */
        }

        .btn:hover {
            background-color: #218838; /* Cor verde mais escura */
        }

        /* Estilo para centralizar o conteúdo */
        .btn-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        /* Caixa de texto para a premiação */
        .premiacao {
            background-color: #e2f7e2;
            border: 1px solid #28a745;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            color: #155724;
        }

        /* Centralizar o conteúdo do body */
        body > img {
            display: block;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="btn-container">
            <li style="list-style: none;"><a class="btn" href="index.php">Início</a></li>
            <li style="list-style: none;"><a class="btn" href="produtos.php">Doar</a></li>
        </div>
        <img src="img/fundo-tela-form.jpg" alt="" style="width: 100%; height: auto;">
        <h2>Ranking de Doadores</h2>

        <div class="premiacao">
            <h3>Premiação</h3>
            <p>Os top 10 doadores serão premiados de acordo com sua posição no ranking! As premiações incluem:</p>
            <ul>
                <li>1º lugar: Headphone</li>
                <li>2º lugar: Garrafa Térmica</li>
                <li>3º lugar: Caneca Personalizada</li>
                <li>4º ao 10º lugar: Mouse Pad</li>
            </ul>
            <p>Doe mais para aumentar suas chances de ganhar!</p>
        </div>

        <table id="rankingTable">
            <tr>
                <th>Posição</th>
                <th>Nome</th>
                <th>Quantidade de Doações</th>
                <th>O Que Doou</th>
            </tr>
            <!-- Aqui serão listados dinamicamente os top 10 doadores -->
            <?php
            // Conexão com o banco de dados e consulta SQL para obter os top 10 doadores
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

            // Consulta SQL para buscar os top 10 doadores ordenados por quantidade de doações
            $sql = "SELECT nome, quantidade_doacoes, o_que_doou FROM usuarios ORDER BY quantidade_doacoes DESC LIMIT 10";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Cria um array PHP com os dados dos doadores
                $doadores = array();
                while($row = $result->fetch_assoc()) {
                    $doadores[] = array(
                        'nome' => $row['nome'],
                        'quantidade' => $row['quantidade_doacoes'],
                        'doacao' => $row['o_que_doou']
                    );
                }
            } else {
                echo "Nenhum doador encontrado.";
            }

            $conn->close();

            // Exibe os doadores na tabela HTML
            if (!empty($doadores)) {
                $posicao = 1;
                foreach ($doadores as $doador) {
                    $classeCSS = $posicao === 1 ? 'top-donor' : '';
                    echo '<tr>';
                    echo '<td class="' . $classeCSS . '">' . $posicao . '</td>';
                    echo '<td class="' . $classeCSS . '">' . $doador['nome'] . '</td>';
                    echo '<td class="' . $classeCSS . '">' . $doador['quantidade'] . '</td>';
                    echo '<td class="' . $classeCSS . '">' . $doador['doacao'] . '</td>';
                    echo '</tr>';
                    $posicao++;
                }
            }
            ?>
        </table>
    </div>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px; /* Aumentei o padding para melhor espaçamento */
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Estilo para destacar o doador em primeiro lugar */
        .top-donor {
            font-weight: bold;
            color: #007bff; /* Cor azul para destacar */
        }
    </style>
</body>
</html>
