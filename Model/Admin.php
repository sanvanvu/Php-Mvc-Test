<?php


namespace TestProject\Model;

use TestProject\Base\Db;

class Admin extends Db
{
    public function login($sEmail)
    {
        $oStmt = $this->oDb->prepare('SELECT email, password FROM users WHERE email = :email LIMIT 1');
        $oStmt->bindValue(':email', $sEmail, \PDO::PARAM_STR);
        $oStmt->execute();
        $oRow = $oStmt->fetch(\PDO::FETCH_OBJ);

        return $oRow->password; // Use the PHP 5.5 password function
    }
}