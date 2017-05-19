<?php

class MultipleController
{
    private $questionRepo;
    private $answerRepo;
    
    public function __construct(QuestionRepository $questionRepo, AnswerRepository $answerRepo)
    {
        echo __CLASS__ . "<br>";
        $this->questionRepo = $questionRepo;
        $this->answerRepo = $answerRepo;
    }
    
    public function index()
    {
        $excluded = Session::getExcluded();
        $randQuestion = container()->get("questionRepo")->findRandom($excluded);

        if ($randQuestion instanceof Question) {
            Session::addToExluded($randQuestion->getId());
        } else {
            Session::resetExcluded();
        }

        $correctAnswerId = $randQuestion->getAnswerId();
        $correctAnswer = container()->get("answerRepo")->find($correctAnswerId);
        $randomAnswer1 = container()->get("answerRepo")->findRandom();

        if ($randomAnswer1->getId() == $correctAnswerId) {
            $randomAnswer1 = container()->get("answerRepo")->findRandom();
        }
        do {
            $randomAnswer2 = container()->get("answerRepo")->findRandom();
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
        $correntAnswerId = container()->get("questionRepo")->find($_POST['question'])->getAnswerId();
        $answer = $_POST['answer'];

        AnswerCheck::answerCheckMc($correntAnswerId, $answer);

        if (Session::isFinished()) {
            header("Location: ?path=results");
        } else {
            header("Location: ?path=multiple");
        }
    }
}
