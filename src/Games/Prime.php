<?php

namespace BrainGames\Games\Prime;

use function \BrainGames\GameDriver\run as runGame;

const GAME_DESCRIPTION = 'Answer "yes" if given number is prime. Otherwise answer "no".';
const MAX_NUM = 30;

function eratosthenes_sieve(int $desiredNum)
{
    $startNum = 2;
    $numbers = range($startNum, $desiredNum);

    $primeNumbersGenerator = function ($currentNum, $acc) use (&$primeNumbersGenerator, $desiredNum) {
        $checkSquareNum = $currentNum ** 2;
        if ($checkSquareNum > $desiredNum) {
            return $acc;
        }

        $newAcc = array_filter($acc, function ($number) use ($checkSquareNum, $currentNum) {
            return ($number < $checkSquareNum) || ($number % $currentNum) !== 0;
        });

        return $primeNumbersGenerator($currentNum + 1, $newAcc);
    };

    return $primeNumbersGenerator($startNum, $numbers);
}

function isPrime(int $number)
{
    if ($number <= 3) {
        return $number;
    }

    $primeNumbers = eratosthenes_sieve($number);
    return in_array($number, $primeNumbers);
}

function getQuestion(int $maxNum)
{
    return rand(0, $maxNum);
}

function getAnswer(int $number)
{
    return isPrime($number) ? 'yes' : 'no';
}

function createGameAttributes()
{
    $question = getQuestion(MAX_NUM);
    $answer = getAnswer($question);

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
