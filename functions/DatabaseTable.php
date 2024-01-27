<?php

namespace functions;
class DatabaseTable
{
    private $table;
    private $primaryKey;
//    private PDO $pdo;

    public function __construct($table, $primaryKey)
    {
        $this->pdo = new \PDO('mysql:dbname=job;host=mysql', 'student', 'student');
        $this->table = $table;
        $this->primaryKey = $primaryKey;
    }

    public function customFind($addStmt, $criteria)
    {
        $stmt = $this->pdo->prepare($addStmt);
        $stmt->execute($criteria);
        return $stmt->fetchAll();
    }

    public function findAll()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM " . $this->table);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find($field, $value)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $field . ' = :value LIMIT 10');
        $criteria = [
            'value' => $value
        ];
        $stmt->execute($criteria);

        return $stmt->fetch();
    }

    public function save($record)
    {
        if (empty($record[$this->primaryKey])) {
            unset($record[$this->primaryKey]);
        }
        try {
            $this->insert($record);
        } catch (Exception $e) {
            $this->update($record);
        }
    }

    public function insert($record)
    {
        $keys = array_keys($record);
        $values = implode(', ', $keys);
        $valuesWithColons = implode(', :', $keys);

        $query = 'INSERT INTO ' . $this->table . ' (' . $values . ') VALUES (:' . $valuesWithColons . ')';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($record);
    }

    public function update($record)
    {
        $query = 'UPDATE ' . $this->table . ' SET ';
        $tableArray = [];
        foreach ($record as $key => $value) {
            $tableArray[] = $key . '= :' . $key;
        }
        $query .= implode(', ', $tableArray);
        $query .= ' WHERE ' . $this->primaryKey . ' =:primaryKey';

        $record['primaryKey'] = $record[$this->primaryKey];

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($record);
    }

    public function delete($field, $value) {
        $stmt = $this->pdo->prepare('DELETE FROM ' . $this->table . ' WHERE ' . $field . ' = :value');
        $criteria = [
            'value' => $value
        ];
        $stmt->execute($criteria);

    }

//    public function raw($statement, $criteria)
//    {
//        $stmt = $this->pdo->prepare($statement);
//        $stmt->execute($criteria);
//        return $stmt->fetchAll();
//    }
}