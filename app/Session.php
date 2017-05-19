<?php

class Session
{

    const totalQuestionsCount_key = 'totalQuestionsCount';
    const answeredQuestionsCount_key = 'answeredQuestionsCount';
    const correctAnswersCount_key = 'correctAnswersCount';
    const isStarted_key = 'isStarted';
    const excluded_id = 'excludedId';
    const mode = 'mode';

    public static function init()
    {
        $_SESSION[self::totalQuestionsCount_key] = 10;
        $_SESSION[self::answeredQuestionsCount_key] = 0;
        $_SESSION[self::correctAnswersCount_key] = 0;
        $_SESSION[self::isStarted_key] = true;
        $_SESSION[self::mode] = 'tf';
        $_SESSION[self::excluded_id] = [];
    }

    public static function getTotalQuestions()
    {
        return $_SESSION[self::totalQuestionsCount_key];
    }

    public static function getCorrectAnswers()
    {
        return $_SESSION[self::correctAnswersCount_key];
    }

    public static function incrementAnsweredQuestions()
    {
        $_SESSION[self::answeredQuestionsCount_key] ++;
    }

    public static function incrementCorrectQuestions()
    {
        $_SESSION[self::correctAnswersCount_key] ++;
    }

    public static function addToExluded($id)
    {
        $_SESSION[self::excluded_id][] = $id;
    }

    public static function getExcluded()
    {
        return $_SESSION[self::excluded_id];
    }

    public static function resetExcluded()
    {
        $_SESSION[self::excluded_id] = [];
    }

    public static function resetSession()
    {
        $_SESSION[self::answeredQuestionsCount_key] = 0;
        $_SESSION[self::correctAnswersCount_key] = 0;
    }

    public static function isFinished()
    {
        if ($_SESSION[self::answeredQuestionsCount_key] == $_SESSION[self::totalQuestionsCount_key]) {
            return true;
        } else {
            return false;
        }
    }
}
