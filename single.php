<?php
/**
 * Created by PhpStorm.
 * User: kok
 * Date: 2017/4/8
 * Time: 23:11
 */
//单例模式

class Single {
    static $obj=null;
    public $number='';
    /**
     * @param null $obj
     */
    public static function setObj($obj)
    {
        self::$obj = $obj;
    }
    protected function __construct()
    {
        $this->number = mt_rand();
    }

    public static function getInstance(){
        if(self::$obj == null ){
            self::$obj = new Single();
        }
        return self::$obj;
    }

    public function printNumber(){
        echo $this->number;
    }

}

$obj = Single::getInstance();
$obj->printNumber();
echo '<br/>';
$obj = Single::getInstance();
$obj->printNumber();