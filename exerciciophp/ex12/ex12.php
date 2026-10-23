<?php
// Ex12 — Sistema de autenticação

// Define a palavra-passe correta.
$senhaCorreta = "php2026";

// Inicializa o contador de tentativas falhadas.
$tentativas = 0;

// Define o número máximo de tentativas permitidas.
$maxTentativas = 3;

// Repete o pedido enquanto o número de falhas for inferior a 3.
while ($tentativas < $maxTentativas) {

    // Pede a palavra-passe através do terminal.
    $senha = readline("Introduza a palavra-passe: ");

    // Compara a palavra-passe introduzida com a correta.
    // === compara o valor e o tipo.
    if ($senha === $senhaCorreta) {

        // Informa que o acesso foi autorizado.
        echo "Acesso Concedido!\n";

        // Termina imediatamente o programa.
        exit;
    }

    // Se a palavra-passe estiver errada, aumenta o contador.
    $tentativas++;

    // Calcula quantas tentativas ainda restam.
    $restantes = $maxTentativas - $tentativas;

    // Só mostra tentativas restantes se ainda houver alguma.
    if ($restantes > 0) {
        echo "Palavra-passe incorreta. Tentativas restantes: $restantes\n";
    }
}

// Se o ciclo terminar, significa que as três tentativas falharam.
echo "Conta Bloqueada por segurança!\n";

?>