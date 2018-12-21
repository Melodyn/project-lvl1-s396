<?php

namespace BrainGames\GameDriver;

use function \cli\line;
use function \cli\prompt;

const HELLO_MESSAGE = 'Welcome to the Brain Game!';
const NAME_ASK_MESSAGE = 'May I have your name?';

const LAST_ROUND = 3;

function sayHi($gameDiscription)
{
    line(HELLO_MESSAGE);
    line($gameDiscription);
}

function getUsername()
{
    return prompt(NAME_ASK_MESSAGE);
}

function greetUser($userName)
{
    line("Hello, $userName!");
}

function run(callable $getGameAttributes, string $gameDiscription)
{
    sayHi($gameDiscription);
    $userName = getUsername();
    greetUser($userName);

    for ($round = 1; $round <= LAST_ROUND; $round += 1) {
        ['question' => $question, 'answer' => $correctAnswer] = $getGameAttributes();

        line('Question: ' . $question);
        $userAnswer = prompt('Your answer');

        if (strtolower($userAnswer) !== strtolower($correctAnswer)) {
            return line("Let's try again, {$userName}!");
        }

        line('Correct!');
    }

    line("Congratulations, {$userName}!");
}
