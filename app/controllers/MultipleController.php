<?php

class MultipleController
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

        $correctAnswerId = $randQuestion->getAnswerId();
        $correctAnswer = AnswerRepository::getInstance()->find($correctAnswerId);
        $randomAnswer1 = AnswerRepository::getInstance()->findRandom();

        if ($randomAnswer1->getId() == $correctAnswerId) {
            $randomAnswer1 = AnswerRepository::getInstance()->findRandom();
        }
        do {
            $randomAnswer2 = AnswerRepository::getInstance()->findRandom();
        } while ($randomAnswer1->getId() == $randomAnswer2->getId() ||
        $randomAnswer2->getId() == $correctAnswerId);

        $answerList = [$randomAnswer1, $randomAnswer2, $correctAnswer];
        shuffle($answerList);

        return View::render("multiple", [
                "question" => $randQuestion,
                "answers" => $answerList
        ]);
    }

    public function checkAnswer()
    {
        $correntAnswerId = QuestionRepository::getInstance()->find($_POST['question'])->getAnswerId();
        $answer = $_POST['answer'];

        AnswerCheck::answerCheckMc($correntAnswerId, $answer);

        if (Session::isFinished()) {
            header("Location: ?path=results");
        } else {
            header("Location: ?path=multiple");
        }
    }
}
