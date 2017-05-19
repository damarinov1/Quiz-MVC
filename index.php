<?php
ini_set("display_errors", 1);

session_start();

require_once 'autoload.php';
require_once 'app/routes.php';
require_once 'app/ServiceContainer.php';
require_once 'app/services.php';


if (!isset($_SESSION[Session::isStarted_key])) {
    Session::init();
}

/**
 * 
 * @return \ServiceContainer
 */
function container()
{
    return $GLOBALS['container'];
}

Router::dispatch();
