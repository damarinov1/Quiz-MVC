<?php
ini_set("display_errors", 1);

session_start();

require_once 'autoload.php';
require_once 'app/routes.php';
require_once 'app/ServiceContainer.php';

if (!isset($_SESSION[Session::isStarted_key])) {
    Session::init();
}

$container = new ServiceContainer();

$container->register("pdo", function() {
    return new A();
});

$container->register("db", function($c) {
    return new B($c->get("pdo"));
});

$container->get("db");


Router::dispatch();
