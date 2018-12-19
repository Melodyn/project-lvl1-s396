<?php

namespace BrainGames\Cli;

use function \cli\line;
use function \cli\prompt;

function run($gameName = '', $gameDescription = '')
{
    line('Welcome to the Brain Game!');
    line($gameDescription);
    $userName = prompt('May I have your name?');
    line("Hello, %s!", $userName);

    if (!empty($gameName)) {
        \BrainGames\GameDriver\run(function ($message, $isRequest) {
            return ($isRequest) ? prompt($message) : line($message);
        }, $gameName, $userName);
    }
}
