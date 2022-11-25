<?php

namespace TestProject\Model;

use mysql_xdevapi\Table;
use TestProject\Base\Db;

class Blog extends Db
{
    public $table='post';

    public function get($iOffset, $iLimit)
    {
        $oStmt = $this->oDb->prepare('SELECT * FROM '.$this->table.' ORDER BY created_at DESC LIMIT :offset, :limit');
        $oStmt->bindParam(':offset', $iOffset, \PDO::PARAM_INT);
        $oStmt->bindParam(':limit', $iLimit, \PDO::PARAM_INT);
        $oStmt->execute();
        return $oStmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getAll()
    {
        $oStmt = $this->oDb->query('SELECT * FROM '.$this->table.' ORDER BY created_at DESC');
        return $oStmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function add(array $aData)
    {
     return   $this->insert($aData,$this->table);
    }

    public function getById($iId)
    {
        $oStmt = $this->oDb->prepare('SELECT * FROM '.$this->table.'  WHERE id = :id LIMIT 1');
        $oStmt->bindParam(':id', $iId, \PDO::PARAM_INT);
        $oStmt->execute();
        return $oStmt->fetch(\PDO::FETCH_OBJ);
    }

    public function update(array $aData)
    {
        $oStmt = $this->oDb->prepare('UPDATE '.$this->table.' SET title = :title, content = :content WHERE id = :id LIMIT 1');
        $oStmt->bindValue(':id', $aData['id'], \PDO::PARAM_INT);
        $oStmt->bindValue(':title', $aData['title']);
        $oStmt->bindValue(':content', $aData['content']);
        return $oStmt->execute();
    }

    public function delete($iId)
    {
        $oStmt = $this->oDb->prepare('DELETE FROM '.$this->table.'  WHERE id = :id LIMIT 1');
        $oStmt->bindParam(':id', $iId, \PDO::PARAM_INT);
        return $oStmt->execute();
    }
}