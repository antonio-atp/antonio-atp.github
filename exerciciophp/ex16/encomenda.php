<?php

// Define os produtos disponíveis para compra.
// Cada produto tem um identificador, nome e preço.
$produtos = [
    1 => ["nome" => "Rato", "preco" => 15.00],
    2 => ["nome" => "Teclado", "preco" => 30.00],
    3 => ["nome" => "Monitor", "preco" => 150.00]
];

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Simulador de encomenda</title>
</head>

<body>

    <h1>Encomenda de produtos</h1>

    <!--
    O formulário envia as quantidades e o cupão por POST.
    O PHP irá recalcular todos os valores no servidor.
-->
    <form action="resumo.php" method="post" id="formEncomenda">

        <table border="1">

            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Subtotal</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($produtos as $id => $produto): ?>

                    <tr
                        data-preco="<?= htmlspecialchars((string) $produto["preco"]) ?>">

                        <!-- Apresenta o nome do produto. -->
                        <td><?= htmlspecialchars($produto["nome"]) ?></td>

                        <!-- Apresenta o preço unitário. -->
                        <td>
                            <?= number_format($produto["preco"], 2) ?>€
                        </td>

                        <!--
                    qtd[ID] cria um array associativo em PHP.
                    Por exemplo, qtd[1] corresponde à quantidade do rato.
                    min="0" impede quantidades negativas na interface.
                -->
                        <td>
                            <input
                                type="number"
                                name="qtd[<?= $id ?>]"
                                min="0"
                                step="1"
                                value="0"
                                class="quantidade">
                        </td>

                        <!-- O JavaScript atualiza este subtotal. -->
                        <td class="subtotal">0.00€</td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

        <br>

        <!-- O utilizador pode introduzir um código de desconto. -->
        <label for="cupao">Cupão de desconto:</label>

        <input type="text" id="cupao" name="cupao">

        <!-- Apresenta o total estimado pelo JavaScript. -->
        <p>Subtotal: <span id="subtotalGeral">0.00€</span></p>

        <p>Desconto estimado: <span id="desconto">0.00€</span></p>

        <p>Total estimado: <span id="total">0.00€</span></p>

        <button type="submit">Confirmar encomenda</button>

    </form>

    <script>
        // Obtém todas as linhas dos produtos.
        const linhas = document.querySelectorAll("tbody tr");

        // Obtém os campos de quantidade.
        const quantidades = document.querySelectorAll(".quantidade");

        // Obtém o campo onde o utilizador escreve o cupão.
        const campoCupao = document.getElementById("cupao");

        // Função que recalcula os valores apresentados no navegador.
        function atualizarTotal() {

            // Inicializa o total antes dos descontos.
            let subtotalGeral = 0;

            // Percorre cada linha de produto.
            linhas.forEach(function(linha) {

                // Obtém o preço unitário definido no HTML.
                const preco = Number(linha.dataset.preco);

                // Obtém a quantidade introduzida pelo utilizador.
                const input = linha.querySelector(".quantidade");
                const quantidade = Math.max(0, Number(input.value) || 0);

                // Calcula o subtotal da linha.
                const subtotal = preco * quantidade;

                // Atualiza o subtotal visível no navegador.
                linha.querySelector(".subtotal").textContent =
                    subtotal.toFixed(2) + "€";

                // Adiciona o subtotal ao total geral.
                subtotalGeral += subtotal;
            });

            // Obtém o cupão e converte-o para maiúsculas.
            const cupao = campoCupao.value.trim().toUpperCase();

            // Esta pré-visualização usa uma taxa ilustrativa.
            // O PHP é que deverá validar o cupão verdadeiro.
            let taxaDesconto = 0;

            if (cupao === "OUT10") {
                taxaDesconto = 0.10;
            }

            // Calcula o desconto estimado no navegador.
            const valorDesconto = subtotalGeral * taxaDesconto;

            // Calcula o total estimado depois do desconto.
            const total = subtotalGeral - valorDesconto;

            // Atualiza os valores apresentados.
            document.getElementById("subtotalGeral").textContent =
                subtotalGeral.toFixed(2) + "€";

            document.getElementById("desconto").textContent =
                valorDesconto.toFixed(2) + "€";

            document.getElementById("total").textContent =
                total.toFixed(2) + "€";
        }

        // Atualiza os cálculos quando uma quantidade é alterada.
        quantidades.forEach(function(input) {
            input.addEventListener("input", atualizarTotal);
        });

        // Atualiza os cálculos quando o cupão é alterado.
        campoCupao.addEventListener("input", atualizarTotal);

        // Executa o cálculo inicial quando a página é carregada.
        atualizarTotal();
    </script>

</body>

</html>