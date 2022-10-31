<?php
namespace app\Service;

use PDO;

class Db {

    public ?PDO $db;

    private array $_connect;

    public function __construct() {
        $this->_connect = [
            'host'     => 'db',
            'dbname'   => 'local_db',
            'user'     => 'root',
            'password' => '5311'
        ];
        $this->db = self::connectViaPDO();
    }

    public function connectViaPDO(): ?PDO {
        try {
            return new PDO(
                "mysql:host={$this->_connect['host']};dbname={$this->_connect['dbname']};",
                $this->_connect['user'],
                $this->_connect['password'],
                [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']
            );
        } catch (\PDOException $e) {
            echo "Сonnection failed {$e->getMessage()}";
            return null;
        }
    }

    /**
     * @param string $sql
     * @return string[]|null
     */
    public function getData(string $sql): ?array {
        $request   = $this->queryPDO($sql);
        $assocData = $request->fetchAll(PDO::FETCH_ASSOC);
        if ($assocData != null) {
            $result = $this->transformArray($assocData);
            return $result;
        }
        return null;
    }

    public function getAssocDataViaPDO($sql) {
        $request   = $this->queryPDO($sql);
        $assocData = $request->fetchAll(PDO::FETCH_ASSOC);
        return $assocData;
    }

    public function queryPDO(string $sql, array $params = []): bool|\PDOStatement {
        $request = $this->db->prepare($sql);
        if (count($params) > 0) {
            foreach ($params as $key => $val) {
                $request->bindValue(':'.$key, $val);
            }
        }
        $request->execute();
        return $request;
    }

    /**
     * @param array $data
     * @return string[]
     */
    public function transformArray(array $data): array {
        $assocArr = $data[0];
        $result   = [];
        foreach ($assocArr as $key => $value) {
            $result[$key] = $value;
        }
        return $result;
    }
}