<?php
// Importa os dados dos artigos.
require_once __DIR__ . "/dados.php";

// Verifica se foi indicada uma marca no endereço.
$marcaSelecionada = $_GET["marca"] ?? "";

// Cria uma lista com os artigos que correspondem ao filtro.
$artigosFiltrados = [];

foreach ($artigos as $cod => $artigo) {
    if (
        $marcaSelecionada === "" ||
        strcasecmp($artigo["marca"], $marcaSelecionada) === 0
    ) {
        $artigosFiltrados[$cod] = $artigo;
    }
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Lista de artigos</title>
</head>

<body>

    <h1>Lista de artigos</h1>

    <!-- Formulário para filtrar os artigos por marca. -->
    <form method="GET" action="lista.php">
        <label for="marca">Filtrar por marca:</label>

        <select name="marca" id="marca">
            <option value="">Todas as marcas</option>

            <?php
            $marcas = [];

            foreach ($artigos as $artigo) {
                $marcas[] = $artigo["marca"];
            }

            // Remove as marcas repetidas.
            $marcas = array_unique($marcas);
            sort($marcas);

            foreach ($marcas as $marca) {
                $selecionada = (
                    strcasecmp($marca, $marcaSelecionada) === 0
                ) ? "selected" : "";

                echo '<option value="' .
                    htmlspecialchars($marca, ENT_QUOTES, "UTF-8") .
                    '" ' . $selecionada . '>' .
                    htmlspecialchars($marca, ENT_QUOTES, "UTF-8") .
                    '</option>';
            }
            ?>
        </select>

        <button type="submit">Filtrar</button>
        <a href="lista.php">Limpar filtro</a>
    </form>

    <hr>

    <?php if (empty($artigosFiltrados)): ?>

        <p>Não foram encontrados artigos.</p>

    <?php else: ?>

        <ul>
            <?php foreach ($artigosFiltrados as $cod => $artigo): ?>

                <li>
                    <?php if ($artigo["stock"] == 0): ?>
                        <del>
                            <?= htmlspecialchars($artigo["nome"], ENT_QUOTES, "UTF-8") ?>
                        </del>
                        — Sem stock
                    <?php else: ?>
                        <?= htmlspecialchars($artigo["nome"], ENT_QUOTES, "UTF-8") ?>
                    <?php endif; ?>

                    — Marca:
                    <?= htmlspecialchars($artigo["marca"], ENT_QUOTES, "UTF-8") ?>

                    — Preço:
                    <?= number_format($artigo["preco"], 2, ",", ".") ?> €

                    — Stock:
                    <?= (int) $artigo["stock"] ?>

                    — <a href="detalhe.php?cod=<?= (int) $cod ?>">
                        Ver detalhes
                    </a>
                </li>

            <?php endforeach; ?>
        </ul>

    <?php endif; ?>

</body>

</html>