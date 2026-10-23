<?php
// Ex03 — Troco com gorjeta

// Pede o preço da compra.
$compra = (float) readline("Valor da compra: ");

// Pede o dinheiro entregue pelo cliente.
$entregue = (float) readline("Valor entregue: ");

// Verifica se o cliente entregou dinheiro suficiente.
// Se o valor entregue for inferior ao preço, não existe troco válido.
if ($entregue < $compra) {

    // Apresenta uma mensagem de erro.
    echo "O valor entregue é insuficiente.\n";

} else {

    // Calcula o troco inicial: dinheiro entregue menos a compra.
    $troco = $entregue - $compra;

    // Calcula uma gorjeta de 10% sobre o troco inicial.
    $gorjeta = $troco * 0.10;

    // Retira a gorjeta do troco para calcular o troco efetivo.
    $trocoEfetivo = $troco - $gorjeta;

    // Apresenta o troco antes de retirar a gorjeta.
    echo "Troco inicial: " . number_format($troco, 2) . "€\n";

    // Apresenta o valor da gorjeta.
    echo "Gorjeta: " . number_format($gorjeta, 2) . "€\n";

    // Apresenta o valor final a devolver ao cliente.
    echo "Troco efetivo: " . number_format($trocoEfetivo, 2) . "€\n";
}

?>