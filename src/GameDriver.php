<?php

namespace BrainGames\GameDriver;

use function \cli\line;
use function \cli\prompt;

const HELLO_MESSAGE = 'Welcome to the Brain Game!';
const NAME_ASK_MESSAGE = 'May I have your name?';

const MAX_CORRECT_ANSWERS_COUNT = 3;

function sayHi($gameDiscription)
{
    line(HELLO_MESSAGE);
    line($gameDiscription);
    return;
}

function getUsername()
{
    return prompt(NAME_ASK_MESSAGE);
}

function greetUser($userName)
{
    line("Hello, $userName!");
    return;
}

function run(callable $getGameAttributes, string $gameDiscription)
{
    sayHi($gameDiscription);
    $userName = getUsername();
    greetUser($userName);
    $userAnswerIsCorrect = true;

    for ($correctAnswersCount = 0; $correctAnswersCount < MAX_CORRECT_ANSWERS_COUNT; $correctAnswersCount += 1) {
        ['question' => $question, 'answer' => $correctAnswer] = $getGameAttributes();

        line('Question: ' . $question);
        $userAnswer = prompt('Your answer');
        $userAnswerIsCorrect = strtolower($userAnswer) === strtolower($correctAnswer);

        $onAnswerMessage = $userAnswerIsCorrect ?
            'Correct!' :
            "'{$userAnswer}' is wrong answer ;(. Correct answer was '{$correctAnswer}'.";
        line($onAnswerMessage);

        if (!$userAnswerIsCorrect) {
            break;
        }
    }

    $engGameMessage = $userAnswerIsCorrect ?
        "Congratulations, {$userName}!" :
        "Let's try again, {$userName}!";

    line($engGameMessage);
    return;
}
