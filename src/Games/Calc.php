<?php

namespace BrainGames\Games\Calc;

use function \BrainGames\GameDriver\run as runGame;

const GAME_DESCRIPTION = 'What is the result of the expression?';

const OPERATORS = ['+', '-', '*'];

function calculate(int $num1, int $num2, string $operator)
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

    $handler = $operations[$operator];

    return $handler($num1, $num2);
}

function getRandomOperator(array $operators)
{
    $operatorIndex = rand(0, (count($operators) - 1));
    return $operators[$operatorIndex];
}

function getQuestion(int $num1, int $num2, string $operator)
{
    return "$num1 $operator $num2";
}

function getAnswer(int $num1, int $num2, string $operator)
{
    return calculate($num1, $num2, $operator);
}

function createGameAttributes()
{
    $num1 = rand(0, 10);
    $num2 = rand(0, 10);
    $operator = getRandomOperator(OPERATORS);

    $question = getQuestion($num1, $num2, $operator);
    $answer = getAnswer($num1, $num2, $operator);

    return [
        'question' => $question,
        'answer'   => $answer,
    ];
}

function run()
{
    $getGameAttributes = function () {
        return createGameAttributes();
    };

    runGame($getGameAttributes, GAME_DESCRIPTION);
}
