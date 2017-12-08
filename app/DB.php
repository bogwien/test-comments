<?php
/**
 * Created by PhpStorm.
 * User: bogwien
 * Date: 07.12.2017
 * Time: 23:28
 */

namespace app;

use mysqli;

/**
 * Class DB
 * @package app
 */
class DB extends Model
{
    public $name;
    public $host;
    public $username;
    public $password;

    /**
     * @var mysqli
     */
    protected $connection;

    /**
     * @throws HttpException
     */
    public function connect()
    {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->name);

        if (mysqli_connect_errno()) {
            throw new HttpException(500, 'DB connection was failed');
        }
    }

    /**
     * @param string $query
     * @return bool|array|null
     */
    public function queryAll($query)
    {
        if (!$this->connection) {
            $this->connect();
        }

        $result = $this->connection->query($query);

        if (is_bool($result)) {
            return $result;
        }

        if ($result->num_rows === 0) {
            return [];
        }

        $data = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();

        return $data;
    }

    /**
     * @param string $query
     * @return bool|array|null
     */
    public function queryOne($query)
    {
        if (!$this->connection) {
            $this->connect();
        }

        $result = $this->connection->query($query);

        if (is_bool($result)) {
            return $result;
        }

        if ($result->num_rows === 0) {
            return null;
        }

        $data = $result->fetch_assoc();
        $result->free();

        return $data;
    }

    public function __destruct()
    {
        if ($this->connection) {
            $this->connection->close();
        }
    }

    /**
     * @param $query
     * @return \mysqli_stmt
     */
    public function prepare($query)
    {
        return $this->connection->prepare($query);
    }
}
