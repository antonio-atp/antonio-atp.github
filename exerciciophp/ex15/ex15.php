<?php
// Exercício 15 — Inscrição num evento

// Inicializa o array de erros.
// Os erros encontrados durante a validação serão guardados aqui.
$erros = [];

// Inicializa os dados para que o formulário funcione
// mesmo quando ainda não foi enviado.
$nome = "";
$email = "";
$idade = "";
$curso = "";
$modalidade = "";
$cidade = "";
$interesses = [];
$aceitouTermos = false;

// Verifica se o formulário foi enviado através do método POST.
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Obtém os valores enviados pelo formulário.
    // trim() remove espaços no início e no fim.
    $nome = trim($_POST["nome"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $idade = trim($_POST["idade"] ?? "");
    $curso = $_POST["curso"] ?? "";
    $modalidade = $_POST["modalidade"] ?? "";
    $cidade = trim($_POST["cidade"] ?? "");

    // Os interesses são enviados como um array.
    $interesses = $_POST["interesses"] ?? [];

    // A checkbox só existe em POST se estiver selecionada.
    $aceitouTermos = isset($_POST["termos"]);

    // Validação do nome: deve ter pelo menos três caracteres.
    if (strlen($nome) < 3) {
        $erros[] = "O nome deve ter pelo menos 3 caracteres.";
    }

    // filter_var() valida o formato do endereço de email.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "O email não é válido.";
    }

    // Verifica se a idade é numérica e está entre 16 e 99.
    if (!is_numeric($idade) || $idade < 16 || $idade > 99) {
        $erros[] = "A idade deve estar entre 16 e 99 anos.";
    }

    // Verifica se foi selecionado um curso.
    if ($curso === "") {
        $erros[] = "Seleciona um curso.";
    }

    // Verifica se a modalidade é presencial ou online.
    if (!in_array($modalidade, ["presencial", "online"], true)) {
        $erros[] = "Seleciona uma modalidade válida.";
    }

    // A cidade só é obrigatória na modalidade presencial.
    if ($modalidade === "presencial" && $cidade === "") {
        $erros[] = "A cidade é obrigatória para a modalidade presencial.";
    }

    // Verifica se o utilizador aceitou os termos.
    if (!$aceitouTermos) {
        $erros[] = "É necessário aceitar os termos.";
    }

    // Só grava os dados quando não existem erros.
    if (empty($erros)) {

        // Prepara os dados para guardar num ficheiro de texto.
        $linha = $nome . " | "
            . $email . " | "
            . $idade . " | "
            . $curso . " | "
            . $modalidade . " | "
            . implode(", ", $interesses) . "\n";

        // FILE_APPEND adiciona a inscrição ao fim do ficheiro.
        // LOCK_EX evita escritas simultâneas durante a operação.
        $gravado = file_put_contents(
            "inscritos.txt",
            $linha,
            FILE_APPEND | LOCK_EX
        );

        // Confirma se a gravação foi bem-sucedida.
        if ($gravado === false) {
            $erros[] = "Não foi possível guardar a inscrição.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Inscrição num evento</title>
</head>

<body>

    <h1>Inscrição numa formação</h1>

    <?php
    // Se existirem erros, apresenta cada mensagem.
    if (!empty($erros)) {
        echo "<ul>";

        foreach ($erros as $erro) {
            echo "<li>" . htmlspecialchars($erro) . "</li>";
        }

        echo "</ul>";
    }

    // Só apresenta a mensagem de sucesso depois de validar
    // os dados e guardar a inscrição.
    if (
        $_SERVER["REQUEST_METHOD"] === "POST" &&
        empty($erros)
    ) {

        // Protege os dados introduzidos pelo utilizador.
        echo "<h2>Inscrição realizada com sucesso!</h2>";
        echo "<p>Bem-vindo " . htmlspecialchars($nome) . "</p>";
        echo "<p>Email: " . htmlspecialchars($email) . "</p>";
        echo "<p>Curso: " . htmlspecialchars($curso) . "</p>";
        echo "<p>Modalidade: " . htmlspecialchars($modalidade) . "</p>";
        echo "<p>Interesses: "
            . htmlspecialchars(implode(", ", $interesses))
            . "</p>";
    }
    ?>

    <!-- O formulário envia os dados para o próprio ficheiro. -->
    <form method="post" id="formInscricao">

        <label>Nome:</label>

        <!-- htmlspecialchars() evita inserir texto não seguro no HTML. -->
        <input
            type="text"
            name="nome"
            value="<?= htmlspecialchars($nome) ?>">

        <br><br>

        <label>Email:</label>
        <input
            type="email"
            name="email"
            value="<?= htmlspecialchars($email) ?>">

        <br><br>

        <label>Idade:</label>
        <input
            type="number"
            name="idade"
            min="16"
            max="99"
            value="<?= htmlspecialchars($idade) ?>">

        <br><br>

        <label>Curso:</label>

        <select name="curso">
            <option value="">Seleciona um curso</option>

            <option value="PHP" <?= $curso === "PHP" ? "selected" : "" ?>>
                PHP
            </option>

            <option value="JavaScript" <?= $curso === "JavaScript" ? "selected" : "" ?>>
                JavaScript
            </option>
        </select>

        <br><br>

        <label>Modalidade:</label>

        <label>
            <input
                type="radio"
                name="modalidade"
                value="presencial"
                <?= $modalidade === "presencial" ? "checked" : "" ?>>
            Presencial
        </label>

        <label>
            <input
                type="radio"
                name="modalidade"
                value="online"
                <?= $modalidade === "online" ? "checked" : "" ?>>
            Online
        </label>

        <br><br>

        <!-- A cidade é exigida apenas para inscrições presenciais. -->
        <div id="campoCidade">
            <label>Cidade:</label>

            <input
                type="text"
                name="cidade"
                value="<?= htmlspecialchars($cidade) ?>">
        </div>

        <br>

        <label>Interesses:</label>

        <!-- Os [] fazem com que os interesses sejam enviados como array. -->
        <label>
            <input
                type="checkbox"
                name="interesses[]"
                value="Programação"
                <?= in_array("Programação", $interesses, true) ? "checked" : "" ?>>
            Programação
        </label>

        <label>
            <input
                type="checkbox"
                name="interesses[]"
                value="Bases de dados"
                <?= in_array("Bases de dados", $interesses, true) ? "checked" : "" ?>>
            Bases de dados
        </label>

        <br><br>

        <label>
            <input
                type="checkbox"
                name="termos"
                value="sim"
                <?= $aceitouTermos ? "checked" : "" ?>>
            Aceito os termos
        </label>

        <br><br>

        <div id="errosJS"></div>

        <button type="submit">Inscrever</button>

    </form>

    <script>
        // Obtém o formulário para poder validar os dados antes do envio.
        const formulario = document.getElementById("formInscricao");

        // Obtém a área onde serão apresentadas as mensagens de erro.
        const errosJS = document.getElementById("errosJS");

        // Obtém o campo da cidade.
        const campoCidade = document.getElementById("campoCidade");

        // Obtém os botões de seleção da modalidade.
        const modalidades = document.querySelectorAll(
            'input[name="modalidade"]'
        );

        // Função que mostra ou esconde o campo da cidade.
        function atualizarCidade() {

            // Procura a modalidade que está selecionada.
            const selecionada = document.querySelector(
                'input[name="modalidade"]:checked'
            );

            // Se a modalidade for online, esconde a cidade.
            // Caso contrário, mantém o campo visível.
            campoCidade.style.display =
                selecionada && selecionada.value === "online" ?
                "none" :
                "block";
        }

        // Atualiza o campo quando o utilizador muda a modalidade.
        modalidades.forEach(function(radio) {
            radio.addEventListener("change", atualizarCidade);
        });

        // Executa a função quando a página é carregada.
        atualizarCidade();

        // Valida os dados antes de enviar o formulário.
        formulario.addEventListener("submit", function(evento) {

            // Limpa os erros da tentativa anterior.
            errosJS.textContent = "";

            // Obtém os valores dos campos.
            const nome = formulario.elements["nome"].value.trim();
            const email = formulario.elements["email"].value.trim();
            const idade = Number(formulario.elements["idade"].value);

            // Guarda os erros encontrados.
            const erros = [];

            // Verifica se o nome tem pelo menos três caracteres.
            if (nome.length < 3) {
                erros.push("O nome deve ter pelo menos 3 caracteres.");
            }

            // Verifica o formato básico do email.
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                erros.push("Introduz um email válido.");
            }

            // Verifica se a idade está entre 16 e 99.
            if (!Number.isInteger(idade) || idade < 16 || idade > 99) {
                erros.push("A idade deve estar entre 16 e 99 anos.");
            }

            // Se existirem erros, impede o envio do formulário.
            if (erros.length > 0) {

                evento.preventDefault();

                // Cria uma lista para apresentar as mensagens.
                const lista = document.createElement("ul");

                erros.forEach(function(mensagem) {
                    const item = document.createElement("li");

                    // textContent apresenta texto sem o interpretar como HTML.
                    item.textContent = mensagem;

                    lista.appendChild(item);
                });

                errosJS.appendChild(lista);
            }
        });
    </script>

</body>

</html>