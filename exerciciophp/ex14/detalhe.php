<?php
// Importa os dados dos artigos.
require_once __DIR__ . "/dados.php";

// Lê e valida o código recebido pelo endereço.
$cod = filter_input(INPUT_GET, "cod", FILTER_VALIDATE_INT);

// Verifica se o código existe na lista de artigos.
if ($cod === false || $cod === null || !array_key_exists($cod, $artigos)) {
    http_response_code(404);
    $artigo = null;
} else {
    $artigo = $artigos[$cod];
}

// Define o endereço para voltar à lista.
$paginaAnterior = $_SERVER["HTTP_REFERER"] ?? "lista.php";
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Detalhes do artigo</title>
</head>

<body>

    <h1>Detalhes do artigo</h1>

    <?php if ($artigo === null): ?>

        <p>Artigo não encontrado. Verifica o código indicado.</p>

    <?php else: ?>

        <p>
            <strong>Código:</strong>
            <?= (int) $cod ?>
        </p>

        <p>
            <strong>Nome:</strong>
            <?= htmlspecialchars($artigo["nome"], ENT_QUOTES, "UTF-8") ?>
        </p>

        <p>
            <strong>Marca:</strong>
            <?= htmlspecialchars($artigo["marca"], ENT_QUOTES, "UTF-8") ?>
        </p>

        <p>
            <strong>Preço:</strong>
            <?= number_format($artigo["preco"], 2, ",", ".") ?> €
        </p>

        <p>
            <strong>Stock:</strong>
            <?= (int) $artigo["stock"] ?>
        </p>

        <?php if ($artigo["stock"] == 0): ?>
            <p>Este artigo está sem stock.</p>
        <?php else: ?>
            <p>Artigo disponível.</p>
        <?php endif; ?>

    <?php endif; ?>

    <p>
        <a href="<?= htmlspecialchars($paginaAnterior, ENT_QUOTES, "UTF-8") ?>">
            Voltar
        </a>
    </p>

</body>

</html>