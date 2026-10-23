<?php
// Ex13 — Cálculo de vencimentos e impostos

// Declara uma função que recebe dois parâmetros:
// $salarioBruto: valor antes dos descontos.
// $taxaDesconto: percentagem a descontar.
function processarVencimento($salarioBruto, $taxaDesconto) {

    // Converte a percentagem para um valor decimal
    // e calcula o desconto em euros.
    $desconto = $salarioBruto * ($taxaDesconto / 100);

    // Subtrai o desconto ao salário bruto.
    $liquido = $salarioBruto - $desconto;

    // Devolve os resultados num array associativo.
    // Cada valor é identificado por uma chave.
    return [
        "bruto" => $salarioBruto,
        "desconto" => $desconto,
        "liquido" => $liquido
    ];
}

// Chama a função com salário bruto de 1200 € e desconto de 15%.
$resultado = processarVencimento(1200.00, 15);

// Acede ao salário bruto através da chave "bruto".
echo "Salário bruto: "
    . number_format($resultado["bruto"], 2) . "€\n";

// Acede ao desconto através da chave "desconto".
echo "Desconto: "
    . number_format($resultado["desconto"], 2) . "€\n";

// Acede ao salário líquido através da chave "liquido".
echo "Salário líquido: "
    . number_format($resultado["liquido"], 2) . "€\n";

?>