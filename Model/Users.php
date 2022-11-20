<?php
namespace Test\Model;
use Test\Base\BaseModel;
use Test\DBConnection\ConnectDB;

class Users extends BaseModel {
    public  string $id;
    public string $name;
    public string $email;
    public string $telephone;
    public string $password ;
    const TABLE='users';

    /** lay ra tat ca nguoi dung */

    public  function getAll(){
//    return $this->All(self::TABLE);
        return [
            'id'=>1,
            'name'=>'san'
        ];
    }

}