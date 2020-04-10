<?php

namespace ListTodo\Controllers;

use Exception;
use RuntimeException;
use InvalidArgumentException;
use PDO;
use DateTime;
use ListTodo\Models\{Deal, Query};

/** ***********************************************************************************************
 * Controller.
 *
 * @author  Barabash Ivan
 *************************************************************************************************/

class Controller
{
    private $query  = null;
    /**
     * @param PDO $pdoDb
     *
     */
    public function __construct(PDO $pdoDb)
    {
        $this->query = new Query($pdoDb);
    }

    /**
     * Get deal list
     *
     * @param DateTime $start
     * @param DateTime $finish
     *
     * @return Deal[]
     */
    public function getList(DateTime $start, DateTime $finish) : array
    {
        $result = [];
        $answerArray = $this->query->getList($start, $finish);
        foreach ($answerArray as $item) {
            $dealObj = $this->getNewDealObject($item);
            if (is_null($dealObj)) {
                continue;
            }
            $result[] = $dealObj;
        }
        return $result;
    }

    /**
     * Get deal by id
     *
     * @param int $id
     *
     * @return Deal
     *
     * @throws RuntimeException id not found
     */
    public function getDealById(int $id) : Deal
    {
        if ($id === 0) {
            throw new RuntimeException('ID is null');
        }
        $answerItemArray = $this->query->getItem($id)[0];
        $dealObject = $this->getNewDealObject($answerItemArray);
        if (is_null($dealObject)) {
            throw new RuntimeException('deal not found');
        }
        return $dealObject;
    }

    /**
     * save Deal
     *
     * @param Deal $deal Deal to save
     *
     * @return int itemId
     * @throws RuntimeException
     */
    public function saveDeal(Deal $deal) : int
    {
        $dealId = $deal->getId();
        $data = [
            'id'        => $dealId,
            'datetime'  => $deal->getDateTime()->format('Y-m-d H:i:s'),
            'comment'   => $deal->getComment()
        ];
        try {
            if ($dealId > 0) {
                $itemId = $this->query->updateItem($dealId, $data);
            } else {
                $itemId = $this->query->addItem($data);
            }
        } catch (RuntimeException $exception) {
            throw new RuntimeException("Error update/add item ID {$deal->getId()}", 0, $exception);
        }
        return $itemId;
    }

    /**
     * delete Deal
     *
     * @param int $dealId Deal to delete
     *
     * @return void
     * @throws RuntimeException
     */
    public function deleteDeal(int $dealId) : void
    {
        if ($dealId === 0) {
            throw new InvalidArgumentException('deal ID is null');
        }
        try {
            $this->query->deleteItem($dealId);
        } catch (RuntimeException $exception) {
            throw new RuntimeException("Error delete item ID $dealId", 0, $exception);
        }
    }

    /**
     * get new Deal from array
     *
     * @param array $dealArray
     *
     * @return Deal|null
     *
     */
    protected function getNewDealObject(array $dealArray) : ?Deal
    {
        $id = (int)($dealArray['id'] ?? 0);
        try {
            $dateTime   = new DateTime($dealArray['datetime']);
        } catch (Exception $exception) {
            $dateTime   = null;
        }
        $comment = $dealArray['comment'] ?? '';
        if ($id === 0 || is_null($dateTime)) {
            return null;
        }
        return new Deal($id, $dateTime, $comment);
    }
}
