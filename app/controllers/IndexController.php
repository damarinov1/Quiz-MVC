<?php

class IndexController
{

    public function index()
    {
        return View::render('index', [
                "id" => 23,
                "title" => "It's working",
        ]);
    }

    public function changeMode()
    {
        $mode = $_POST['mode'];

        $_SESSION[Session::mode] = $mode;

        if ($_SESSION[Session::answeredQuestionsCount_key] > 0) {
            Session::resetExcluded();
            Session::resetSession();
        }

        $map = [
            'tf' => 'single',
            'mc' => 'multiple',
        ];

        header("Location: ?path=" . $map[$mode]);
    }

    public function destroySession()
    {
        session_destroy();
        header("Location: ?path=single");
    }

    public function getResults()
    {
        return View::render('results');
    }
}
