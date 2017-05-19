<?php

class SingleController
{

    public function index()
    {
        $excluded = Session::getExcluded();

        $randQuestion = QuestionRepository::getInstance()->findRandom($excluded);

        if ($randQuestion instanceof Question) {
            Session::addToExluded($randQuestion->getId());
        } else {
            Session::resetExcluded();
        }

        $answer = AnswerRepository::getInstance()->findRandom();

        return View::render("single", [
                "question" => $randQuestion,
                "answer" => $answer
        ]);
    }

    public function checkAnswer()
    {
        $correctAnswerId = QuestionRepository::getInstance()->find($_POST['question'])->getAnswerId();

        $answer = $_POST['answer'];
        $answer_input = $_POST['answer_input'];


        AnswerCheck::answerCheckTf($correctAnswerId, $answer, $answer_input);

        if (Session::isFinished()) {
            header("Location: ?path=results");
        } else {
            header("Location: ?path=single");
        }
    }
}
