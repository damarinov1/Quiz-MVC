<?php

class Database
{

    private $pdo;

    /**
     * 
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param type $query
     * @param type $class
     * @param type $single
     * @return type
     */
    public function runQuery($query, $class = "", $single = true)
    {
        if ($single) {
            if (empty($class)) {
                return $this->pdo->query($query)->fetch();
            } else {
                return $this->executeTyped($query, $class);
            }
        } else {
            if (empty($class)) {
                return $this->pdo->query($query)->fetchAll();
            } else {
                return $this->pdo->query($query)->fetchAll(PDO::FETCH_CLASS, $class);
            }
        }
    }

    public function runPreparedQuery($query, $class = "", $stmt = [], $single = true)
    {
        $prepare_stmt = $this->pdo->prepare($query);
        $prepare_stmt->execute($stmt);

        if ($single) {
            if (empty($class)) {
                return $prepare_stmt->fetch();
            } else {
                return $prepare_stmt->fetchObject($class);
            }
        } else {
            if (empty($class)) {
                return $prepare_stmt->fetch();
            } else {
                return $prepare_stmt->fetchAll(PDO::FETCH_CLASS, $class);
            }
        }
    }

    public function executeTyped($query, $class)
    {
        $prepare_stmt = $this->pdo->prepare($query);
        $prepare_stmt->execute();
        return $prepare_stmt->fetchObject($class);
    }
}
