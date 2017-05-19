<?php

abstract class AbstractRepository
{

    /**
     *
     * @var Database
     */
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    abstract function find($id);

    abstract function findAll();

    abstract function findRandom($exclude = []);
}
