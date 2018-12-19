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
