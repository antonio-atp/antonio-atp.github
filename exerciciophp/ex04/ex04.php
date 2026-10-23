<?php
// Ex04 — Média de três números

// Pede o primeiro número inteiro.
$a = (int) readline("Primeiro número: ");

// Pede o segundo número inteiro.
$b = (int) readline("Segundo número: ");

// Pede o terceiro número inteiro.
$c = (int) readline("Terceiro número: ");

// Soma os três números e divide o resultado por 3.
// Os parênteses garantem que a soma é calculada primeiro.
$media = ($a + $b + $c) / 3;

// Arredonda a média a duas casas decimais.
// number_format() garante que as duas casas aparecem no resultado.
echo "A média de $a, $b e $c é "
    . number_format(round($media, 2), 2) . "\n";

?>