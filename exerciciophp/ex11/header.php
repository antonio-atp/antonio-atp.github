<header>

    <?php
    // htmlspecialchars() protege a saída HTML
    // caso o texto contenha caracteres especiais.
    ?>

    <h1><?= htmlspecialchars($nomeSite) ?></h1>

    <!-- Menu de navegação do site. -->
    <nav>
        <a href="index.php">Início</a>
        <a href="#">Cursos</a>
        <a href="#">Contacto</a>
    </nav>

</header>