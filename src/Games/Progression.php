<?php

namespace BrainGames\Games\Progression;

use function \BrainGames\GameDriver\run as runGame;

const GAME_DESCRIPTION = 'What number is missing in the progression?';

const PROGRESSION_LENGTH = 10;
const HIDER = '..';

function getProgression(int $firstNum, int $step, int $progressionLength)
{
    $lastNum = $firstNum + $step * ($progressionLength - 1);
    $progression = range($firstNum, $lastNum, $step);

    return array_combine($progression, $progression);
}

function hideElement(int $index, array $array)
{
    return array_replace($array, [$index => HIDER]);
}

function getQuestion(array $progression)
{
    return implode(' ', $progression);
}

function createGameAttributes()
{
    $firstNum = rand(0, 10);
    $step = rand(0, 10);
    $progression = getProgression($firstNum, $step, PROGRESSION_LENGTH);

    $hiddenElement = array_rand($progression, 1);
    $progressionWithHiddenElement = hideElement($hiddenElement, $progression);

    $question = getQuestion($progressionWithHiddenElement);
    $answer = $hiddenElement;

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
