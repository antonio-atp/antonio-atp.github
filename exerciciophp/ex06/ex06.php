<?php
// Ex06 — Antecedente e sucessor

// Solicita ao utilizador um número inteiro.
$n = (int) readline("Introduza um número: ");

// Guarda o valor original para não o perder durante os cálculos.
$original = $n;

// O antecedente é o número imediatamente anterior.
// Subtrair 1 permite obter esse valor.
$antecedente = $n - 1;

// O sucessor é o número imediatamente seguinte.
// Somar 1 permite obter esse valor.
$sucessor = $n + 1;

// Apresenta o número anterior.
echo "Antecedente: $antecedente\n";

// Apresenta o número introduzido pelo utilizador.
echo "Número: $original\n";

// Apresenta o número seguinte.
echo "Sucessor: $sucessor\n";

?>