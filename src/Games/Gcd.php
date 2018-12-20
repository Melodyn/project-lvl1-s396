<?php

namespace BrainGames\Games\Gcd;

use function \BrainGames\GameDriver\run as runGame;

const GAME_DESCRIPTION = 'Find the greatest common divisor of given numbers.';

function getQuestion()
{
    $num1 = rand(1, 100);
    $num2 = rand(1, 100);

    return "$num1 $num2";
}

function gcd(int $a, int $b)
{
    return ($a % $b) ? gcd($b, $a % $b) : $b;
}

function getAnswer(string $nums)
{
    [$num1, $num2] = explode(' ', $nums);

    return gcd($num1, $num2);
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
