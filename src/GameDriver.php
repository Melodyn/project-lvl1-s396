<?php

namespace BrainGames\GameDriver;

use function \cli\line;
use function \cli\prompt;

const MAX_CORRECT_ANSWERS_COUNT = 3;

const GAMES_MAP = [
    'even' => '\BrainGames\Games\Even',
];

function getGame($gameName)
{
    $pathToGame = GAMES_MAP[$gameName];
    
    return [
        $pathToGame . '\start',
        $pathToGame . '\getQuestion',
        $pathToGame . '\getCorrectAnswer'
    ];
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

function sendRequest(callable $cli, string $message)
{
    return $cli($message, true);
}

function sendResponse(callable $cli, string $message)
{
    $cli($message, false);
    return;
}

function run(callable $cli, string $gameName, string $userName)
{
    [$start, $getQuestion, $getCorrectAnswer] = getGame($gameName);
    $nextStep = process();
    $gameIsEnd = false;

    do {
        $question = $getQuestion();
        sendResponse($cli, 'Question: ' . $question);

        $userAnswer = sendRequest($cli, 'Your answer');
        $correctAnswer = $getCorrectAnswer($question);
        $userAnswerIsCorrect = strtolower($userAnswer) === $correctAnswer;
        $onAnswerMessage = $userAnswerIsCorrect ?
            'Correct!' :
            "'{$userAnswer}' is wrong answer ;(. Correct answer was '{$correctAnswer}'.";

        sendResponse($cli, $onAnswerMessage);

        $gameIsEnd = $nextStep($userAnswerIsCorrect);
    } while (!$gameIsEnd);

    $engGameMessage = $userAnswerIsCorrect ?
        "Congratulations, {$userName}!" :
        "Let's try again, {$userName}!";

    sendResponse($cli, $engGameMessage);
}
