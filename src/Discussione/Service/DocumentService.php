<?php

namespace Discussione\Service;

use Doctrine\MongoDB\Connection;
use Doctrine\MongoDB\LoggableDatabase;
use Doctrine\MongoDB\Cursor;
use Doctrine\MongoDB\Collection;
use MongoId;

class DocumentService
{
    private $connection;

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
        return $this->getCollection()->insert($data);
    }

    /**
     * @return Cursor
     */
    public function all()
    {
        return $this->getCollection()->find();
    }

    /**
     * @param $id
     * @return array|int|MongoCursor|null
     */
    public function getById($id)
    {
        return $this->getCollection()->findOne([
            '_id' => new MongoId($id)
        ]);
    }

    /**
     * @return Collection
     */
    private function getCollection($collection = 'discussion')
    {
        return $this->getDatabase()->selectCollection($collection);
    }

    /**
     * @return LoggableDatabase
     */
    private function getDatabase()
    {
        return $this->connection->selectDatabase('discussione');
    }
}