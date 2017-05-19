<?php

class Router
{

    private static $routes = [];

    public static function register($path, $action)
    {
        self::$routes[$path] = $action;
    }

    public static function dispatch()
    {
        $path = isset($_GET['path']) ? $_GET['path'] : "single";

        if (array_key_exists($path, self::$routes)) {
            echo call_user_func(self::$routes[$path]);
        } else {
            echo "<h1>404 - Not Found</h1>";
        }
    }
}
