<?php

namespace BrainGames\Games\Even;

use function \cli\line;
use function \cli\prompt;

function getQuestion()
{
    return rand();
}

function getCorrectAnswer(int $hiddenNumber)
{
    $hiddenNumberIsEven = ($hiddenNumber % 2) === 0;

    return $hiddenNumberIsEven ? 'yes' : 'no';
}

function start($gameParams)
{
    $correctAnswersCount = 0;
    $maxCorrectAnswersCount = $gameParams === 'default' ? 3 : $gameParams;

    $gameisEnd = function ($userAnswerIsCorrect) use (&$correctAnswersCount, $maxCorrectAnswersCount) {
        if ($userAnswerIsCorrect) {
            $correctAnswersCount += 1;
        }

        return !$userAnswerIsCorrect || ($correctAnswersCount >= $maxCorrectAnswersCount);
    };

    return $gameisEnd;
}
