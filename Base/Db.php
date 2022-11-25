<?php
namespace TestProject\Base;
use Couchbase\User;
use TestProject\Middleware\GetData;

class Db {
    protected $oDb;
    protected $tableName;
    protected $primary;
    protected $orBy;
    public function __construct($tableName,$primary)
    {
        $this->orBy=new GetData();
        $this->oDb = new \TestProject\Engine\Db;
        $this->primary=$primary;
        $this->tableName=$tableName;
    }

    public function insert(array $aData)
    {
        $stmt='INSERT into '.$this->tableName.'(';
        $stmt.=" ". $this->implode_key(',',$aData)." ) VALUES ( :".$this->implode_key(', :',$aData)."  ) ";
        $stmt2 = $this->oDb->prepare($stmt);
        foreach($aData as  $key=>$values) {
            $stmt2->bindParam(':$values', $values);
        }
        return $stmt2->execute($aData);
    }
    /** output string key of data */
    function implode_key($glue, $arr){
        $arr2=array();
        foreach($arr as $key=>$value){
            $arr2[]=$key;
        }
        return implode($glue, $arr2);
    }
    function implode_arr($glue, $arr){
        $arr2=array();
        foreach($arr as $data){
            $arr2[]=$data;
        }
        return implode($glue, $arr2);
    }

    /**
     * @param $glue
     * @param $arr
     * @param string $id
     * @return string
     */
    function implode_key_key($glue, $arr){
        $arr2=array();
        foreach($arr as $key=>$value){
            if($key==$this->primary) continue;
            $arr2[]=$key ." = :".$key;
        }
        return implode($glue, $arr2);
    }

    /**
     * @param array $aData
     * @param $tableName
     * @param string $id -name cols in table database
     * @return bool
     */
    public  function aUpdate(array $aData){
        $stmt='UPDATE '.$this->tableName.' ';
        $stmt.=" SET ".$this->implode_key_key(',',$aData);
        $stmt.=" WHERE ".$this->primary." = :".$this->primary." LIMIT 1 ";
        $stmt2 = $this->oDb->prepare($stmt);
        foreach($aData as  $key=>$values) {
            $str=':'.$key;
            if ($key=$this->primary){
                $stmt2->bindValue($str, $values,\PDO::PARAM_INT);
            }
            else{
                $stmt2->bindValue($str, $values);
            }
        }
        return $stmt2->execute();
    }

    /**
     * @param $iId
     * @return bool
     */
    public function aDelete($iId)
    {
        $stmt="DELETE FROM ".$this->tableName.' WHERE '.$this->primary.'= :'.$this->primary. ' LIMIT 1';
        $stmt2 = $this->oDb->prepare($stmt);
        $stmt2->bindParam(':'.$this->primary, $iId, \PDO::PARAM_INT);
      return  $stmt2->execute();
    }

    /**
     * @param $iId
     * @return mixed
     */
    public function _getById($iId){
        $stmt='SELECT * FROM '.$this->tableName.'  WHERE '.$this->primary.' = :id LIMIT 1';
        $stmt2 = $this->oDb->prepare($stmt);
        $stmt2->bindParam(':id',$iId,\PDO::PARAM_INT);
        $stmt2->execute();
        return $stmt2->fetch(\PDO::FETCH_OBJ);
    }

    /**
     * @param array $array
     * @param $cond
     * @return mixed
     */
    public function _getData(array $array ,$cond,$value,$odb,bool $desc){

        $array2='*';
        if($array!=[]){
            $array2=$this->implode_arr(',',$array);
        }
        $stmt='SELECT '.$array2.' FROM '.$this->tableName;
        if($cond!=null&&$value!=null){
           $stmt= $this->orBy->selected($stmt,$cond);
        }
        if ($odb!=null){
            $stmt=$this->orBy->ordeyBy($stmt,$odb,$desc);
        }
        $stmt2 = $this->oDb->prepare($stmt);
        if($cond!=null&&$value!=null){
            $stmt2->bindValue(':'.$cond,$value,\PDO::PARAM_INT);

        }
        $stmt2->execute();
        return $stmt2->fetchAll(\PDO::FETCH_OBJ);

    }

}