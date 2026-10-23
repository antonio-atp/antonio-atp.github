<?php
// Ex09 — Processamento de vendas

// Cria um array com os valores das vendas realizadas no dia.
$vendas = [12.50, 45.00, 3.20, 150.00, 8.90, 85.40, 12.50];

// array_sum() soma todos os valores do array.
$total = array_sum($vendas);

// min() devolve o valor mais baixo.
$menor = min($vendas);

// max() devolve o valor mais alto.
$maior = max($vendas);

// count() conta quantas vendas existem.
// A média é o total dividido pelo número de vendas.
$media = $total / count($vendas);

// Apresenta o total faturado com duas casas decimais.
echo "Total faturado: " . number_format($total, 2) . "€\n";

// Apresenta a venda de menor valor.
echo "Menor venda: " . number_format($menor, 2) . "€\n";

// Apresenta a venda de maior valor.
echo "Maior venda: " . number_format($maior, 2) . "€\n";

// Apresenta a média de cada venda.
echo "Média: " . number_format($media, 2) . "€\n";

// rsort() ordena os valores por ordem decrescente.
// O array original fica ordenado da venda mais cara para a mais barata.
rsort($vendas);

// implode() transforma os valores do array numa única cadeia de texto.
echo "Vendas ordenadas: " . implode(", ", $vendas) . "\n";

// shuffle() baralha os valores do array aleatoriamente.
shuffle($vendas);

// O índice 0 corresponde ao primeiro elemento do array.
// Seleciona esse elemento para simular o sorteio.
echo "Venda sorteada: " . number_format($vendas[0], 2) . "€\n";

?>