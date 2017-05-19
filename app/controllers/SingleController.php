<?php

class SingleController
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

        $answer = container()->get("answerRepo")->findRandom();

        return View::render("single", [
                "question" => $randQuestion,
                "answer" => $answer
        ]);
    }

    public function checkAnswer()
    {
        $correctAnswerId = container()->get("questionRepo")->find($_POST['question'])->getAnswerId();

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
