<?php

namespace BrainGames\Games\Even;

use function \cli\line;
use function \cli\prompt;

function init()
{
    line('Answer "yes" if number even otherwise answer "no".');
    $userName = prompt('May I have your name?');

    return $userName;
}

function start($userName, $maxCorrectAnswersCount = 3)
{
    $correctAnswersCount = 0;
    $questionMessage = 'Question: ';
    $answerMessage = 'Your answer';
    $onAnswerMessage = 'Correct!';
    $correctAnswerMap = [
        true  => 'yes',
        false => 'no'
    ];

    do {
        $hiddenNumber = rand();
        $hiddenNumberIsEven = ($hiddenNumber % 2) === 0;

        line($questionMessage.$hiddenNumber);
        $userAnswer = prompt($answerMessage);
        $correctAnswer = $correctAnswerMap[$hiddenNumberIsEven];
        $userAnswerIsCorrect = strtolower($userAnswer) === $correctAnswer;

        if ($userAnswerIsCorrect) {
            $correctAnswersCount += 1;
        } else {
            $onAnswerMessage = "'{$userAnswer}' is wrong answer ;(. Correct answer was '{$correctAnswer}'.";
        }

        line($onAnswerMessage);

        $gameIsEnd = !$userAnswerIsCorrect || ($correctAnswersCount >= $maxCorrectAnswersCount);
    } while (!$gameIsEnd);

    return $userAnswerIsCorrect;
}

function end($userName, $isWinner)
{
    $engGameMessageMap = [
        true  => "Congratulations, {$userName}!",
        false => "Let's try again, {$userName}!"
    ];

    line($engGameMessageMap[$isWinner]);
    
    return;
}
