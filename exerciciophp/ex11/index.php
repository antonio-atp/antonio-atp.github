<?php
// Ex11 — Estrutura modular com cabeçalho e rodapé
// Este exercício utiliza quatro ficheiros. Coloca-os na mesma pasta. 


// require_once inclui config.php.
// Se o ficheiro não existir, o PHP interrompe a execução.
// O sufixo _once impede que seja incluído novamente.
require_once "config.php";

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($nomeSite) ?></title>
</head>

<body>

    <?php
    // include_once inclui o cabeçalho apenas uma vez.
    // Se não existir, o PHP emite um aviso e tenta continuar.
    include_once "header.php";
    ?>

    <!-- Conteúdo principal da página. -->
    <main>
        <h2>Bem-vindo ao Portal QNQ</h2>
        <p>Portal de formação web.</p>
    </main>

    <?php
    // Inclui o rodapé apenas uma vez.
    include_once "footer.php";
    ?>

</body>
</html>