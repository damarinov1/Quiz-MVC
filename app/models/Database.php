<?php

class Database
{

    private $DB_HOST = "192.168.1.212";
    private $DB_USER = "vagrant";
    private $DB_PASS = "local";
    private $DB_NAME = "quiz";
    private $DB_CHARSET = "utf8";
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        $dsn = "mysql:host=" . $this->DB_HOST . ";dbname=" . $this->DB_NAME . ";charset=" . $this->DB_CHARSET;
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        $this->pdo = new PDO($dsn, $this->DB_USER, $this->DB_PASS, $opt);
    }

    /**
     * 
     * @return $this
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
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
                return self::$instance->pdo->query($query)->fetch();
            } else {
                return $this->executeTyped($query, $class);
            }
        } else {
            if (empty($class)) {
                return self::$instance->pdo->query($query)->fetchAll();
            } else {
                return self::$instance->pdo->query($query)->fetchAll(PDO::FETCH_CLASS, $class);
            }
        }
    }

    public function runPreparedQuery($query, $class = "", $stmt = [], $single = true)
    {
        $prepare_stmt = self::$instance->pdo->prepare($query);
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
