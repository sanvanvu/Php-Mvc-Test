<?php
namespace TestProject\Base;
class Db {
    protected $oDb;
    protected $tableName;
    public function __construct()
    {
        $this->oDb = new \TestProject\Engine\Db;
    }
    public function getTable($table){
        $this->tableName=$table;
        return $this->tableName;
    }
}