<?php

namespace BrainGames\GameDriver;

use function \BrainGames\Cli\request as sendRequest;
use function \BrainGames\Cli\response as sendResponse;

const HELLO_MESSAGE = 'Welcome to the Brain Game!';
const NAME_ASK_MESSAGE = 'May I have your name?';

const MAX_CORRECT_ANSWERS_COUNT = 3;

function sayHi($gameDiscription)
{
    sendResponse(HELLO_MESSAGE);
    sendResponse($gameDiscription);
}

function getUsername()
{
    return sendRequest(NAME_ASK_MESSAGE);
}

function greetUser($userName)
{
    sendResponse("Hello, $userName!");
}

function process()
{
    $correctAnswersCount = 0;

    $gameisEnd = function ($userAnswerIsCorrect) use (&$correctAnswersCount) {
        if ($userAnswerIsCorrect) {
            $correctAnswersCount += 1;
        }

        return !$userAnswerIsCorrect || ($correctAnswersCount >= MAX_CORRECT_ANSWERS_COUNT);
    };

    return $gameisEnd;
}

function run(callable $handler, $gameDiscription)
{
    sayHi($gameDiscription);
    $userName = getUsername();
    greetUser($userName);

    $nextStep = process();
    $gameIsEnd = false;

    do {
        $question = $handler('getQuestion');
        sendResponse('Question: ' . $question);

        $userAnswer = sendRequest('Your answer');
        $correctAnswer = $handler('getCorrectAnswer', $question);
        $userAnswerIsCorrect = strtolower($userAnswer) === strtolower($correctAnswer);
        $onAnswerMessage = $userAnswerIsCorrect ?
            'Correct!' :
            "'{$userAnswer}' is wrong answer ;(. Correct answer was '{$correctAnswer}'.";

        sendResponse($onAnswerMessage);

        $gameIsEnd = $nextStep($userAnswerIsCorrect);
    } while (!$gameIsEnd);

    $engGameMessage = $userAnswerIsCorrect ?
        "Congratulations, {$userName}!" :
        "Let's try again, {$userName}!";

    sendResponse($engGameMessage);
}
