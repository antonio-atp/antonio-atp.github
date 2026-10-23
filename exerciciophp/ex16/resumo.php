<?php

// Define os mesmos produtos no servidor.
// Estes preços são a fonte de verdade para o cálculo.
$produtos = [
    1 => ["nome" => "Rato", "preco" => 15.00],
    2 => ["nome" => "Teclado", "preco" => 30.00],
    3 => ["nome" => "Monitor", "preco" => 150.00]
];

// Define os cupões válidos exclusivamente no servidor.
// OUT10 dá um desconto de 10%.
$cuponsValidos = [
    "OUT10" => 0.10
];

// Inicializa os totais.
$subtotalGeral = 0;
$linhasFatura = [];

// Obtém as quantidades enviadas pelo formulário.
// Se não existir um array de quantidades, utiliza um array vazio.
$quantidades = $_POST["qtd"] ?? [];

// Confirma que o valor recebido é um array.
if (!is_array($quantidades)) {
    $quantidades = [];
}

// Percorre os produtos definidos no servidor.
// Não utiliza os preços enviados pelo navegador.
foreach ($produtos as $id => $produto) {

    // Obtém a quantidade enviada para este produto.
    $quantidade = $quantidades[$id] ?? 0;

    // Ignora quantidades que não sejam números inteiros válidos.
    if (
        !is_scalar($quantidade) ||
        filter_var($quantidade, FILTER_VALIDATE_INT) === false ||
        (int) $quantidade <= 0
    ) {
        continue;
    }

    // Converte a quantidade validada para inteiro.
    $quantidade = (int) $quantidade;

    // Calcula o subtotal com o preço definido no servidor.
    $subtotal = $produto["preco"] * $quantidade;

    // Guarda os dados da linha da fatura.
    $linhasFatura[] = [
        "nome" => $produto["nome"],
        "preco" => $produto["preco"],
        "quantidade" => $quantidade,
        "subtotal" => $subtotal
    ];

    // Atualiza o subtotal geral.
    $subtotalGeral += $subtotal;
}

// Obtém o cupão enviado pelo formulário.
$cupao = $_POST["cupao"] ?? "";

// Só aceita um cupão se o valor recebido for texto.
if (!is_string($cupao)) {
    $cupao = "";
}

// Remove espaços e converte o cupão para maiúsculas.
$cupao = strtoupper(trim($cupao));

// Inicializa a taxa de desconto a zero.
$taxaDesconto = 0;

// Verifica se o cupão existe na lista de cupões válidos.
if (isset($cuponsValidos[$cupao])) {

    // Utiliza a taxa definida no servidor.
    $taxaDesconto = $cuponsValidos[$cupao];
}

// Calcula o desconto com base no subtotal confirmado.
$valorDesconto = $subtotalGeral * $taxaDesconto;

// Calcula o total final.
$totalFinal = $subtotalGeral - $valorDesconto;

// Verifica se foi pedido um resumo em JSON através do URL.
// $_REQUEST pode recolher dados de GET, POST e COOKIE,
// dependendo da configuração do PHP.
$formato = $_REQUEST["formato"] ?? "";

// Se o formato pedido for JSON, devolve os dados nesse formato.
if ($formato === "json") {

    // Define o tipo de conteúdo da resposta.
    header("Content-Type: application/json; charset=utf-8");

    // Converte os dados da fatura para JSON e termina a execução.
    echo json_encode([
        "produtos" => $linhasFatura,
        "subtotal" => $subtotalGeral,
        "cupao" => $cupao,
        "taxa_desconto" => $taxaDesconto,
        "desconto" => $valorDesconto,
        "total" => $totalFinal
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    exit;
}

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Resumo da encomenda</title>
</head>

<body>

    <h1>Fatura da encomenda</h1>

    <table border="1">

        <thead>
            <tr>
                <th>Produto</th>
                <th>Preço unitário</th>
                <th>Quantidade</th>
                <th>Subtotal</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Percorre as linhas da fatura calculadas no servidor.
            foreach ($linhasFatura as $linha):
            ?>

                <tr>
                    <td><?= htmlspecialchars($linha["nome"]) ?></td>

                    <td>
                        <?= number_format($linha["preco"], 2) ?>€
                    </td>

                    <td><?= $linha["quantidade"] ?></td>

                    <td>
                        <?= number_format($linha["subtotal"], 2) ?>€
                    </td>
                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

    <!-- Apresenta os totais calculados pelo PHP. -->
    <p>
        Subtotal:
        <?= number_format($subtotalGeral, 2) ?>€
    </p>

    <p>
        Cupão:
        <?= htmlspecialchars($cupao) ?>
    </p>

    <p>
        Desconto:
        <?= number_format($valorDesconto, 2) ?>€
    </p>

    <h2>
        Total final: <?= number_format($totalFinal, 2) ?>€
    </h2>

    <a href="encomenda.php">Voltar à encomenda</a>

</body>

</html>