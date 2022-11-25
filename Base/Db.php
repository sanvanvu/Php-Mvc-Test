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
    public function insert(array $aData,$tableName)
    {

        $stmt='INSERT into '.$tableName.'(';

        $stmt.=" ". $this->implode_key(',',$aData)." ) VALUES ( :".$this->implode_key(', :',$aData)."  ) ";
        $stmt2 = $this->oDb->prepare($stmt);
        foreach($aData as  $key=>$values) {
            $stmt2->bindParam(':$values', $values);
        }
        return $stmt2->execute($aData);
    }
    function implode_key($glue, $arr){
        $arr2=array();
        foreach($arr as $key=>$value){
            $arr2[]=$key;
        }
        return implode($glue, $arr2);
    }
}