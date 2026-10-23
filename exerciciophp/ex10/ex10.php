<?php
// Ex10 — Validador de prazos

// Define o fuso horário de Portugal continental.
date_default_timezone_set("Europe/Lisbon");

// Cria um objeto DateTime com a data atual.
$hoje = new DateTime();

// Define a data limite de inscrição.
// A data é um exemplo indicado na ficha.
$limite = new DateTime("2026-10-15");

// Calcula a diferença entre a data atual e a data limite.
$diferenca = $hoje->diff($limite);

// %r permite conservar o sinal da diferença.
// %a devolve o número total de dias.
$dias = (int) $diferenca->format("%r%a");

// Apresenta a data atual no formato dia/mês/ano.
echo "Data atual: " . $hoje->format("d/m/Y") . "\n";

// Apresenta quantos dias faltam ou quantos dias passaram.
echo "Diferença: $dias dias\n";

// Se hoje for anterior ou igual à data limite, as inscrições estão abertas.
if ($hoje <= $limite) {

    echo "Inscrições Abertas\n";

} else {

    // Se a data atual ultrapassar a data limite, estão encerradas.
    echo "Inscrições Encerradas\n";
}

?>