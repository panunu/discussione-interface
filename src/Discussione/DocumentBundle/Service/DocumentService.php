<?php

namespace Discussione\DocumentBundle\Service;

use Doctrine\MongoDB\Connection;
use Doctrine\MongoDB\LoggableDatabase;
use Doctrine\MongoDB\Cursor;

class DocumentService
{
    private $connection;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function __destruct()
    {
        $this->connection->close();
    }

    /**
     * @param array $data
     * @return array|bool
     */
    public function insert(array $data)
    {
        return $this->getDatabase()->selectCollection('discussions')->insert($data);
    }

    /**
     * @return Cursor
     */
    public function all()
    {
        return $this->getDatabase()->selectCollection('discussions')->find();
    }

    /**
     * @return LoggableDatabase
     */
    private function getDatabase()
    {
        return $this->connection->selectDatabase('discussione');
    }
}