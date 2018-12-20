<?php

namespace BrainGames\Games\Calc;

use function \BrainGames\GameDriver\run as runGame;

const GAME_DESCRIPTION = 'What is the result of the expression?';

const OPERATORS = ['+', '-', '*'];

function getQuestion()
{
    $operatorIndex = rand(0, (count(OPERATORS) - 1));
    $operator = OPERATORS[$operatorIndex];

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

function getAnswer(string $expression)
{
    return calculate(explode(' ', $expression));
}

function run()
{
    $getGameAttributes = function () {
        $question = getQuestion();
        $answer = getAnswer($question);
    
        return [
            'question' => $question,
            'answer'   => $answer,
        ];
    };

    runGame($getGameAttributes, GAME_DESCRIPTION);
    return;
}
