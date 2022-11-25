<?php

namespace TestProject\Model;

use mysql_xdevapi\Table;
use TestProject\Base\Db;
use TestProject\Middleware\GetData;

class Blog extends Db
{
    public $table='post';
    public $primary='id';
    protected $configsql;
 public function __construct( )
 {
     parent::__construct($this->table,$this->primary);
 }

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
        return $this->_getData([],null,null,'created_at',true);
    }

    /**
     * @param array $aData
     * @return bool
     */
    public function add(array $aData)
    {
     return   $this->insert($aData);
    }

    /**
     * @param $iId
     * @return mixed
     */
    public function getById($iId)
    {
        return $this->_getById($iId);
    }

    /**
     * @param array $aData
     * @return bool
     */
    public function update(array $aData)
    {
        return $this->aUpdate($aData);
    }

    /**
     * @param $iId
     * @return bool
     */
    public function delete($iId)
    {
        return $this->aDelete($iId);
    }
}