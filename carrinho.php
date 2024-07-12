<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Doações</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .back-link, .nav-link {
            display: block;
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
        }
        .back-link:hover, .nav-link:hover {
            background-color: #45a049;
        }
        .category-title {
            font-size: 1.2em;
            font-weight: bold;
            margin-top: 15px;
        }
        .cart-item {
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
            padding: 10px;
        }
        .item-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .item-details {
            flex: 2;
            margin-right: 20px;
        }
        .item-quantity {
            flex: 1;
            display: flex;
            align-items: center;
        }
        .item-name {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .item-description {
            color: #666;
        }
        .quantity-controls button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
            margin-left: 5px;
        }
        .quantity-controls button:hover {
            background-color: #45a049;
        }
        .remove-button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
            margin-left: 10px;
        }
        .remove-button:hover {
            background-color: #cc0000;
        }
        .finalize-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            display: block;
            margin-top: 20px;
            width: 100%;
            text-align: center;
            text-decoration: none;
        }
        .finalize-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="container">
    <a href="produtos.php" class="nav-link">Doar mais produtos</a>
    <a href="index.php" class="nav-link">Voltar ao Início</a>

    <hr>
    <h1 class="site-doacao">Carrinho de Doações</h1>
    <br>

    <div id="roupas-items">
        <h2 class="category-title">Roupas</h2>
        <!-- Itens de roupas do carrinho serão adicionados dinamicamente aqui -->
    </div>

    <div id="higiene-items">
        <h2 class="category-title">Produtos de Higiene</h2>
        <!-- Itens de higiene do carrinho serão adicionados dinamicamente aqui -->
    </div>

    <div id="alimentos-items">
        <h2 class="category-title">Alimentos</h2>
        <!-- Itens de alimentos do carrinho serão adicionados dinamicamente aqui -->
    </div>

    <div id="empty-cart-message" style="display: none; text-align: center;">
        <p>O carrinho está vazio.</p>
        <a href="produtos.php" class="back-link">Voltar para produtos</a>
    </div>

    <a href="#" id="finalize-donation-button" class="finalize-button" style="display: none;">
        Finalizar Doação
    </a>

    <form id="finalize-donation-form" action="formulario.php" method="POST" style="display: none;">
        <input type="hidden" name="cart" id="cart-input">
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const cartItems = JSON.parse(localStorage.getItem('cart')) || { roupas: [], higiene: [], alimentos: [] };
        const roupasItemsDiv = document.getElementById('roupas-items');
        const higieneItemsDiv = document.getElementById('higiene-items');
        const alimentosItemsDiv = document.getElementById('alimentos-items');
        const emptyCartMessage = document.getElementById('empty-cart-message');
        const finalizeButton = document.getElementById('finalize-donation-button');

        function renderCartItems() {
            const hasItems = cartItems.roupas.length > 0 || cartItems.higiene.length > 0 || cartItems.alimentos.length > 0;
            if (hasItems) {
                emptyCartMessage.style.display = 'none';
                finalizeButton.style.display = 'block';
                renderCategoryItems(cartItems.roupas, roupasItemsDiv, 'Roupas');
                renderCategoryItems(cartItems.higiene, higieneItemsDiv, 'Produtos de Higiene');
                renderCategoryItems(cartItems.alimentos, alimentosItemsDiv, 'Alimentos');
            } else {
                emptyCartMessage.style.display = 'block';
                finalizeButton.style.display = 'none';
                roupasItemsDiv.innerHTML = '';
                higieneItemsDiv.innerHTML = '';
                alimentosItemsDiv.innerHTML = '';
            }
        }

        function renderCategoryItems(categoryItems, categoryDiv, categoryName) {
            categoryDiv.innerHTML = ''; // Limpa o conteúdo atual da categoria

            if (categoryItems.length > 0) {
                categoryItems.forEach(item => {
                    const itemDiv = document.createElement('div');
                    itemDiv.classList.add('cart-item');

                    const itemInfo = document.createElement('div');
                    itemInfo.classList.add('item-info');

                    const itemDetails = document.createElement('div');
                    itemDetails.classList.add('item-details');

                    const itemName = document.createElement('div');
                    itemName.classList.add('item-name');
                    itemName.textContent = item; // Exibe o nome do item

                    itemDetails.appendChild(itemName);

                    const itemQuantity = document.createElement('div');
                    itemQuantity.classList.add('item-quantity');

                    const quantityText = document.createElement('span');
                    quantityText.textContent = 'Quantidade: ';
                    const quantityValue = document.createElement('span');
                    quantityValue.textContent = 1; // Quantidade padrão é 1
                    quantityValue.classList.add('quantity-value');

                    itemQuantity.appendChild(quantityText);
                    itemQuantity.appendChild(quantityValue);

                    const removeButton = document.createElement('button');
                    removeButton.textContent = 'Remover';
                    removeButton.classList.add('remove-button');
                    removeButton.addEventListener('click', () => {
                        const index = categoryItems.indexOf(item);
                        if (index > -1) {
                            categoryItems.splice(index, 1);
                            localStorage.setItem('cart', JSON.stringify(cartItems));
                            renderCartItems();
                        }
                    });

                    itemInfo.appendChild(itemDetails);
                    itemInfo.appendChild(itemQuantity);
                    itemInfo.appendChild(removeButton);

                    itemDiv.appendChild(itemInfo);
                    categoryDiv.appendChild(itemDiv);
                });
            } else {
                categoryDiv.innerHTML = `<p>Nenhum item de ${categoryName.toLowerCase()} no carrinho.</p>`;
            }
        }

        renderCartItems(); // Renderiza os itens do carrinho ao carregar a página

        document.getElementById('finalize-donation-button').addEventListener('click', () => {
            const cartInput = document.getElementById('cart-input');
            cartInput.value = JSON.stringify(cartItems);

            const finalizeForm = document.getElementById('finalize-donation-form');
            finalizeForm.submit();
        });
    });
</script>

</body>
</html>
