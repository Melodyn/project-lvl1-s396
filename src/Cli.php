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
        $pathToGame . '\start',
        $pathToGame . '\getQuestion',
        $pathToGame . '\getCorrectAnswer'
    ];
}

function run($gameName = '', $gameDescription = '', $gameParams = 'default')
{
    line('Welcome to the Brain Game!');
    line($gameDescription);
    $userName = prompt('May I have your name?');
    line("Hello, %s!", $userName);
    
    if (!empty($gameName)) {
        [$start, $getQuestion, $getCorrectAnswer] = getGame($gameName);
        $nextStep = $start($gameParams);
        $gameIsEnd = false;

        do {
            $question = $getQuestion();
            line('Question: ' . $question);

            $userAnswer = prompt('Your answer');
            $correctAnswer = $getCorrectAnswer($question);
            $userAnswerIsCorrect = strtolower($userAnswer) === $correctAnswer;
            $onAnswerMessage = $userAnswerIsCorrect ?
                'Correct!' :
                "'{$userAnswer}' is wrong answer ;(. Correct answer was '{$correctAnswer}'.";

            line($onAnswerMessage);

            $gameIsEnd = $nextStep($userAnswerIsCorrect);
        } while (!$gameIsEnd);

        $engGameMessage = $userAnswerIsCorrect ? "Congratulations, {$userName}!" : "Let's try again, {$userName}!";

        line($engGameMessage);
    }
}
