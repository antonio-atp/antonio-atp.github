<?php
// Ex07 — Classificação de aluno

// Pede a nota ao utilizador.
// O tipo float permite aceitar notas decimais.
$nota = (float) readline("Introduza a nota: ");

// Verifica se a nota está fora do intervalo permitido, de 0 a 20.
if ($nota < 0 || $nota > 20) {

    // || significa OU: basta uma das condições ser verdadeira.
    echo "Nota inválida.\n";

// Se a nota for inferior a 10, o aluno está reprovado.
} elseif ($nota < 10) {

    echo "Reprovado.\n";

// Se chegou aqui, a nota é pelo menos 10.
// Como é inferior a 14, a classificação é suficiente.
} elseif ($nota < 14) {

    echo "Suficiente.\n";

// Se chegou aqui, a nota é pelo menos 14.
// Como é inferior a 17, a classificação é bom.
} elseif ($nota < 17) {

    echo "Bom.\n";

// Se nenhuma das condições anteriores se verificar,
// a nota é igual ou superior a 17 e não ultrapassa 20.
} else {

    echo "Muito bom.\n";
}

?>