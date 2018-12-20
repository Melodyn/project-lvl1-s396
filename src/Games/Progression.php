<?php

namespace BrainGames\Games\Progression;

use function \BrainGames\GameDriver\run as runGame;

const GAME_DESCRIPTION = 'What number is missing in the progression?';

const PROGRESSION_LENGTH = 10;
const HIDER = '..';

function getProgression()
{
    $firstNum = rand(1, 10);
    $step = rand(2, 10);
    $lastNum = $firstNum + $step * (PROGRESSION_LENGTH - 1);
    $progression = range($firstNum, $lastNum, $step);

    return array_combine($progression, $progression);
}

function hideRandomElement(array $numbers)
{
    $randomIndex = array_rand($numbers, 1);
    
    return array_replace($numbers, [$randomIndex => HIDER]);
}

function getQuestion()
{
    return hideRandomElement(getProgression());
}

function getAnswer(array $numbers)
{
    return array_search(HIDER, $numbers);
}

function run()
{
    $getGameAttributes = function () {
        $question = getQuestion();
        $answer = getAnswer($question);
    
        return [
            'question' => implode(' ', $question),
            'answer'   => $answer,
        ];
    };

    runGame($getGameAttributes, GAME_DESCRIPTION);
    return;
}
