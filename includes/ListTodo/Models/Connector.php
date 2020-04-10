<?php

namespace ListTodo\Models;

use PDO;
use PDOException;
use RuntimeException;
use InvalidArgumentException;
/** ***********************************************************************************************
 * DB Connector.
 *
 * @author  Barabash
 *************************************************************************************************/

class Connector
{
    private $connection = null;
    /** ***********************************************************************************************
     * Construct
     *
     * @param string $host
     * @param string $dbUserName
     * @param string $dbPassword
     * @param string $dbName
     *
     * @throws RuntimeException errors
     *************************************************************************************************/
    public function __construct($host, $dbUserName, $dbPassword, $dbName)
    {
        if (strlen($host) === 0 || strlen($dbUserName) === 0 || strlen($dbName) === 0) {
            throw new InvalidArgumentException("Host, userName or tableName is empty");
        }
        try {
            $this->connection = new PDO("mysql:dbname=$dbName;host=$host;charset=utf8", $dbUserName, $dbPassword, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            throw new RuntimeException('Подключение не удалось: ' . $e->getMessage());
        }
    }
    /** ***********************************************************************************************
     * Get PDO connector
     *
     * @return PDO $pdo
     *************************************************************************************************/
    public function getConnection()
    {
        return $this->connection;
    }
}