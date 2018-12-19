<?php

namespace BrainGames\Games\Even;

function getQuestion()
{
    return rand();
}

function getCorrectAnswer(int $hiddenNumber)
{
    $hiddenNumberIsEven = ($hiddenNumber % 2) === 0;

    return $hiddenNumberIsEven ? 'yes' : 'no';
}

function start()
{
    $correctAnswersCount = 0;
    $maxCorrectAnswersCount = 3;

    $gameisEnd = function ($userAnswerIsCorrect) use (&$correctAnswersCount, $maxCorrectAnswersCount) {
        if ($userAnswerIsCorrect) {
            $correctAnswersCount += 1;
        }

        return !$userAnswerIsCorrect || ($correctAnswersCount >= $maxCorrectAnswersCount);
    };

    return $gameisEnd;
}
