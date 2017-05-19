<?php

abstract class AbstractRepository
{

    /**
     *
     * @var Database
     */
    protected $db;

    private function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * 
     * @return $this
     */
    public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    abstract function find($id);

    abstract function findAll();

    abstract function findRandom($exclude = []);
}
