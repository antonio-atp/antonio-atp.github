<?php
// Ex08 — Calculadora

// Solicita os dois números ao utilizador.
$a = (float) readline("Primeiro número: ");
$b = (float) readline("Segundo número: ");

// Solicita a operação matemática pretendida.
$operacao = readline("Operação (+, -, *, /, %): ");

// switch permite escolher uma ação conforme o valor de $operacao.
switch ($operacao) {

    // Se o utilizador escolher +, soma os números.
    case '+':
        $resultado = $a + $b;
        break; // Termina este caso.

    // Se escolher -, subtrai o segundo número ao primeiro.
    case '-':
        $resultado = $a - $b;
        break;

    // Se escolher *, multiplica os números.
    case '*':
        $resultado = $a * $b;
        break;

    // Se escolher /, verifica primeiro se o divisor é zero.
    case '/':
        if ($b == 0) {
            echo "Não é possível dividir por zero.\n";
            exit; // Termina o programa.
        }

        // Executa a divisão quando o divisor é válido.
        $resultado = $a / $b;
        break;

    // O operador % calcula o resto da divisão entre inteiros.
    case '%':
        if ((int) $b == 0) {
            echo "Não é possível dividir por zero.\n";
            exit;
        }

        // Converte os valores para inteiros antes de calcular o resto.
        $resultado = (int) $a % (int) $b;
        break;

    // Executa este bloco se a operação não for reconhecida.
    default:
        echo "Operação inválida.\n";
        exit;
}

// Só chega aqui se uma operação válida tiver sido executada.
echo "Resultado: $resultado\n";

?>