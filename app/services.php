<?php

$container = new ServiceContainer();

$container->register("pdo", function() {
    $dsn = "mysql:host=192.168.1.212;dbname=quiz;charset=utf8";
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    return new PDO($dsn, "vagrant", "local", $opt);
});

$container->register("db", function($c) {
    return new Database($c->get("pdo"));
});

$container->register("questionRepo", function($c) {
    return new QuestionRepository($c->get("db"));
});

$container->register("answerRepo", function($c) {
    return new AnswerRepository($c->get("db"));
});

$GLOBALS['container'] = $container;
