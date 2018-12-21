<?php

namespace BrainGames\Games\Even;

use function \BrainGames\GameDriver\run as runGame;

const GAME_DESCRIPTION = 'Answer "yes" if number even otherwise answer "no".';

function getQuestion()
{
    return rand();
}

function isEven(int $num)
{
    return ($num % 2) === 0;
}

function getAnswer(int $hiddenNumber)
{
    return isEven($hiddenNumber) ? 'yes' : 'no';
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
}
