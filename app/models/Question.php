<?php

class Question
{

    private $id;
    private $question;
    private $a_id;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->question;
    }

    public function getAnswerId()
    {
        return $this->a_id;
    }

    public function isCorrect($answer_id)
    {
        return $this->a_id == $answer_id;
    }
}
