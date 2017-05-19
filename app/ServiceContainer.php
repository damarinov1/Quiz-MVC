<?php
    ini_set("display_errors", 1);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractServiceContainer
 *
 * @author denis
 */
class ServiceContainer
{

    /**
     *
     * @var object 
     */
    private $instances = [];
    private $services = [];

    public function register($name, $method)
    {
        if (isset($this->services[$name])) {
            throw new Exception("Service '$name' already exists");
        }

        $this->services[$name] = $method;
    }

    /**
     * 
     * @param string $name
     * @return object
     */
    public function get($name)
    {
        if (!isset($this->services[$name])) {
            throw new Exception("Unknown service '$name'");
        }

        if (!isset($this->instances[$name])) {
            $this->instances[$name] = call_user_func_array($this->services[$name], [$this]);
        }

        return $this->instances[$name];
    }
}


class A {
    public function __construct()
    {
        echo __CLASS__ . " it works! <br>";
    }
}

class B {
    /**
     * 
     * @param A $a
     */
    public function __construct(A $a)
    {
        echo __CLASS__ . " <br>";
    }
}



