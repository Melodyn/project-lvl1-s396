<?php

namespace BrainGames\Games\Calc;

function getQuestion()
{
    $operators = ['+', '-', '*'];
    $operatorIndex = rand(0, (count($operators) - 1));
    $operator = $operators[$operatorIndex];

    $num1 = rand(0, 10);
    $num2 = rand(0, 10);

    return "$num1 $operator $num2";
}

function calculate(array $expression)
{
    $operations = [
        '+' => function ($num1, $num2) {
            return $num1 + $num2;
        },
        '-' => function ($num1, $num2) {
            return $num1 - $num2;
        },
        '*' => function ($num1, $num2) {
            return $num1 * $num2;
        },
    ];

    [$num1, $operator, $num2] = $expression;

    $handler = $operations[$operator];

    return $handler($num1, $num2);
}

function getCorrectAnswer(string $expression)
{
    return calculate(explode(' ', $expression));
}