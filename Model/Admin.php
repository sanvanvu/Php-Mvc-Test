<?php


namespace TestProject\Model;

use TestProject\Base\Db;

class Admin extends Db
{   public $tableName='users';
    public $primary='id';
    public function __construct()
    {
        parent::__construct($this->tableName, $this->primary);
    }

    public function login($sEmail)
    {
        $oStmt = $this->oDb->prepare('SELECT email, password FROM users WHERE email = :email LIMIT 1');
        $oStmt->bindValue(':email', $sEmail, \PDO::PARAM_STR);
        $oStmt->execute();
        $oRow = $oStmt->fetch(\PDO::FETCH_OBJ);

        return $oRow->password;
    }
}