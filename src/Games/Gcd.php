<?php

namespace BrainGames\Games\Gcd;

const GAME_DESCRIPTION = 'Find the greatest common divisor of given numbers.';

function getQuestion()
{
    $num1 = rand(0, 100);
    $num2 = rand(0, 100);

    return "$num1 $num2";
}

function gcd($a, $b) {
    return ($a % $b) ? gcd($b, $a % $b) : $b;
}

function getCorrectAnswer(string $nums)
{
    [$num1, $num2] = explode(' ', $nums);

    return gcd($num1, $num2);
}

function run()
{
    \BrainGames\GameDriver\run(function ($handlerName, $data = null) {
        return ($handlerName === 'getQuestion') ? getQuestion() : getCorrectAnswer($data);
    }, GAME_DESCRIPTION);
}
