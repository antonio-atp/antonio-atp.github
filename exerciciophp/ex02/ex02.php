<?php
// Ex02 — Total a pagar com IVA

// Pede ao utilizador o valor da mercadoria.
$valor = (float) readline("Valor da mercadoria: ");

// Calcula o IVA de 25% sobre o valor da mercadoria.
// 25 / 100 = 0.25.
$iva = $valor * 0.25;

// Inicializa o total com o valor original.
$total = $valor;

// Adiciona o IVA ao total usando o operador +=.
// Esta instrução equivale a: $total = $total + $iva.
$total += $iva;

// Apresenta o valor da mercadoria com duas casas decimais.
echo "Valor: " . number_format($valor, 2) . "€\n";

// Apresenta o valor calculado do IVA.
echo "IVA (25%): " . number_format($iva, 2) . "€\n";

// Apresenta o valor final a pagar.
echo "Total: " . number_format($total, 2) . "€\n";

?>