<?php

namespace BrainGames\Games\Even;

const GAME_DESCRIPTION = 'Answer "yes" if number even otherwise answer "no".';

function getQuestion()
{
    return rand();
}

function isEven($num)
{
    return ($num % 2) === 0;
}

function getCorrectAnswer(int $hiddenNumber)
{
    return isEven($hiddenNumber) ? 'yes' : 'no';
}

function run()
{
    \BrainGames\GameDriver\run(function ($handlerName, $data = null) use {
        return ($handlerName === 'getQuestion') ? getQuestion() : getCorrectAnswer($data);
    }, GAME_DESCRIPTION);
}
