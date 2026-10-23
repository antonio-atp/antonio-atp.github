<?php

// Ex01 — Produto de dois números

// Pede ao utilizador o primeiro número.
// readline() lê o valor introduzido no terminal.
// (float) converte o valor para um número decimal.
$a = (float) readline("Introduza o primeiro número: ");

// Pede o segundo número e também o converte para decimal.
$b = (float) readline("Introduza o segundo número: ");

// Multiplica os dois números e guarda o resultado.
$produto = $a * $b;

// Apresenta uma frase com o resultado.
// number_format() permite apresentar duas casas decimais.
echo "O produto de $a e $b é "
    . number_format($produto, 2, '.', '') . "\n";

?>