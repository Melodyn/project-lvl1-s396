<?php

namespace BrainGames\Cli;

use function \cli\line;
use function \cli\prompt;

const GAMES_MAP = [
    'even' => '\BrainGames\Games\Even',
];

function getGame($gameName)
{
    $pathToGame = GAMES_MAP[$gameName];
    
    return [
        $pathToGame.'\init',
        $pathToGame.'\start',
        $pathToGame.'\end'
    ];
}

function run($gameName = '')
{
    line('Welcome to the Brain Game!');
    
    if (empty($gameName)) {
        $name = prompt('May I have your name?');
        line("Hello, %s!", $name);
    } else {
        [$init, $start, $end] = getGame($gameName);
        
        $gameParams = $init();
        $gameResult = $start($gameParams);
        $end($gameParams, $gameResult);
    }
}
