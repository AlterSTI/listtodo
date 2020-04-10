<?php

namespace ListTodo\Models;

use PDO;
use Throwable;
use RuntimeException;
use DateTime;

class Query
{
    private $pdo    = null;
    private $table  = 'deals';

    /**
     * @param PDO $pdoDb
     */
    public function __construct(PDO $pdoDb)
    {
        $this->pdo = $pdoDb;
    }

    /**
     * Get items list for selected period
     *
     * @param DateTime $start
     * @param DateTime $finish
     *
     * @return array
     * @throws RuntimeException
     */
    public function getList(DateTime $start, DateTime $finish) : array
    {
        $startDate  = $start->format('Y-m-d H:i:s');
        $finishDate = $finish->format('Y-m-d H:i:s');
        $query = "SELECT * FROM {$this->table} WHERE (datetime BETWEEN '$startDate' AND '$finishDate')";
        return $this->runSelectQuery($query, 'Error getList');
    }

    /**
     * Get item by Id
     *
     * @param int $id
     *
     * @return array
     * @throws RuntimeException
     */
    public function getItem(int $id) : array
    {
        $query = "SELECT * FROM {$this->table} WHERE `id` = $id";
        return $this->runSelectQuery($query, "Error getItem $id");
    }

    /**
     * Update item by Id
     *
     * @param int $id
     * @param array $data
     *
     * @example $data = [
     *   'id'        => $dealId,
     *   'datetime'  => $deal->getDateTime(),
     *   'comment'   => $deal->getComment()
     *];
     * @return int
     * @throws RuntimeException
     */
    public function updateItem(int $id, array $data) : int
    {
        $statement = $this->pdo->prepare("
            UPDATE {$this->table} 
            SET `datetime` = :datetime, `comment` = :comment
            WHERE id = :id");

        $statement->execute([
            ':id'           => $id,
            ':datetime'     => $data['datetime'],
            ':comment'      => $data['comment'],
        ]);
        pre($statement);
        pre($statement->errorInfo());
        return (int)($statement->rowCount() ?? 0);
    }

    /**
     * Delete item by Id
     *
     * @param int $id
     *
     * @throws RuntimeException
     */
    public function deleteItem($id) : void
    {
        $statement = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $statement->bindParam(':id', $id);
        $statement->execute();
        if ($statement->rowCount() === 0) {
            throw new RuntimeException("Error delete deal id $id");
        }
    }

    /**
     * add item
     *
     * @param array $data
     *
     * @example $data = [
     *   'id'        => $dealId,
     *   'datetime'  => $deal->getDateTime(),
     *   'comment'   => $deal->getComment()
     *];
     * @return int
     * @throws RuntimeException
     */
    public function addItem($data) : int
    {
        $statement = $this->pdo->prepare("INSERT INTO {$this->table} (datetime, comment) 
                                                    VALUES(:datetime, :comment)");
        $fieldData = [
            ':datetime' => $data['datetime']->format('Y-m-d H:i:s'),
            ':comment'  => $data['comment']
        ];

        $statement->execute($fieldData);
        if ($statement->rowCount() === 0) {
            throw new RuntimeException("Error add item with data".var_export($data, true));
        }

        return (int)($this->pdo->lastInsertId() ?? 0);
    }

    /**
     * Query select work bee
     *
     * @param string $query
     * @param string $errorText
     *
     * @return array
     *
     * @throws RuntimeException
     */
    protected function runSelectQuery(string $query, string $errorText = 'Error') : array
    {
        $answer = [];
        try {
            $resultQuery = $this->pdo->query($query);
        } catch (Throwable $exception) {
            throw new RuntimeException($errorText, 0, $exception);
        }
        foreach ($resultQuery as $item) {
            $answer[] = $item;
        }
        return $answer;
    }


}
