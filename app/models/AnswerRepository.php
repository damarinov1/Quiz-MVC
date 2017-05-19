<?php

class AnswerRepository extends AbstractRepository
{

    protected static $instance = null;
    private $model = "Answer";

    public function find($id)
    {
        $query = "SELECT * FROM answers WHERE id=? LIMIT 1";
        $stmt = [$id];

        return $this->db->runPreparedQuery($query, $this->model, $stmt);
    }

    public function findAll()
    {
        $query = "SELECT * FROM answers";

        return $this->db->runQuery($query, $this->model, false);
    }

    public function findRandom($exclude = [])
    {
        if (empty($exclude)) {
            $query = "SELECT * FROM answers ORDER BY RAND() LIMIT 1";

            return $this->db->runQuery($query, $this->model);
        } else {
            $aMarks = str_repeat("?,", count($exclude) - 1) . "?";
            $query = "SELECT * FROM answers WHERE id NOT IN ($aMarks) ORDER BY RAND() LIMIT 1";

            return $this->db->runPreparedQuery($query, $this->model, $exclude);
        }
    }
}
