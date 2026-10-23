<?php
// Ex05 — Divisão inteira

// Pede o primeiro número inteiro.
$a = (int) readline("Primeiro número: ");

// Pede o segundo número inteiro.
$b = (int) readline("Segundo número: ");

// Antes de dividir, verifica se o divisor é diferente de zero.
if ($b != 0) {

    // intdiv() calcula o quociente inteiro da divisão.
    // Por exemplo, intdiv(17, 5) devolve 3.
    $quociente = intdiv($a, $b);

    // O operador % calcula o resto da divisão.
    // Por exemplo, 17 % 5 devolve 2.
    $resto = $a % $b;

    // Apresenta o quociente e o resto.
    echo "$a / $b = $quociente (resto $resto)\n";

} else {

    // Evita uma divisão por zero.
    echo "Não é possível dividir por zero.\n";
}

?>