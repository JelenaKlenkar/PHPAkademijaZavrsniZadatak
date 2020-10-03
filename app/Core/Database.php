<?php
declare(strict_types=1);

namespace App\Core;



class Database extends \PDO
{
    private static $instance;

    public function __construct()
    {
        $dbConfig = Config::get('Database');

        $dsn = 'mysql:host=' . $dbConfig['host'] . ';dbname=' . $dbConfig['name'] . ';charset=utf8';
        parent::__construct($dsn, $dbConfig['user'], $dbConfig['password']);

        $this->setAttribute(
            \PDO::ATTR_DEFAULT_FETCH_MODE,
            \PDO::FETCH_OBJ
        );
    }

    private function __clone()
    {
    }

    public static function getInstance(): self
    {
        if (static::$instance === null) {
            self::$instance = new static();
        }

        return self::$instance;
    }
}