<?php
namespace TestProject\Engine\Pattern;

trait Singleton
{


protected static $_oInstance = null;

/**
* Get instance of class.
*
* @access public
* @static
* @return object tra ve 1 class duy nhat dau tien.
*/
public static function getInstance()
{
return (null === static::$_oInstance) ? static::$_oInstance = new static : static::$_oInstance;
}
}