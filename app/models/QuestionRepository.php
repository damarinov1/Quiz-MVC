<?php

class QuestionRepository extends AbstractRepository
{

    protected static $instance = null;
    private $model = "Question";

    /**
     * 
     * @param type $id
     * @return Question
     */
    public function find($id)
    {
        $query = "SELECT * FROM questions WHERE id=? LIMIT 1";
        $stmt = [$id];

        return $this->db->runPreparedQuery($query, $this->model, $stmt);
    }

    public function findAll()
    {
        $query = "SELECT * FROM questions";

        return $this->db->runQuery($query, $this->model, false);
    }

    public function findRandom($exclude = [])
    {
        if (empty($exclude)) {
            $query = "SELECT * FROM questions ORDER BY RAND() LIMIT 1";

            return $this->db->runQuery($query, $this->model);
        } else {
            $qMarks = str_repeat('?,', count($exclude) - 1) . '?';
            $query = "SELECT * FROM questions WHERE id NOT IN ($qMarks) ORDER BY RAND() LIMIT 1";

            return $this->db->runPreparedQuery($query, $this->model, $exclude);
        }
    }
}
