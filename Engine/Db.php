<?php


namespace TestProject\Engine;

class Db extends \PDO
{
    public function __construct()
    {
        $aDriverOptions[\PDO::MYSQL_ATTR_INIT_COMMAND] = 'SET NAMES UTF8';
        parent::__construct( Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';', Config::DB_USER, $_ENV['MYSQL_ROOT_PASSWORD'], $aDriverOptions);
        $this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
}