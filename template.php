<?php
/**
 * Created by PhpStorm.
 * User: kok
 * Date: 2017/4/10
 * Time: 23:49
 * 模板模式
 * 模板模式准备一个抽象类，将部分逻辑以具体方法以及具体构造形式实现，然后声明一些抽象方法来迫使子类实现剩余的逻辑。
 * 不同的子类可以以不同的方式实现这些抽象方法，从而对剩余的逻辑有不同的实现。先制定一个顶级逻辑框架，而将逻辑的细节留给具体的子类去实现。
 *   角色：
 *   抽象模板角色（MakePhone）：抽象模板类，定义了一个具体的算法流程和一些留给子类必须实现的抽象方法。
 *   具体子类角色（XiaoMi）：实现MakePhone中的抽象方法，子类可以有自己独特的实现形式，但是执行流程受MakePhone控制。
 *
 */


abstract class MakePhone
{
    protected $name;

    public function __construct($name)
    {
        $this->name=$name;
    }

    public function MakeFlow()
    {
        $this->MakeBattery();
        $this->MakeCamera();
        $this->MakeScreen();
        echo $this->name."手机生产完毕！<hr/>";
    }
    public abstract function MakeScreen();
    public abstract function MakeBattery();
    public abstract function MakeCamera();
}

//小米手机
class XiaoMi extends MakePhone
{
    public function __construct($name='小米')
    {
        parent::__construct($name);
    }

    public   function MakeBattery()
    {
        echo "小米电池生产完毕！<br/>";
    }
    public   function MakeCamera()
    {
        echo "小米相机生产完毕！<br/>";
    }

    public  function MakeScreen()
    {
        echo "小米屏幕生产完毕！<br/>";
    }
}

//魅族手机
class FlyMe  extends  MakePhone
{
    function __construct($name='魅族')
    {
        parent::__construct($name);
    }

    public   function MakeBattery()
    {
        echo "魅族电池生产完毕！<br/>";
    }
    public   function MakeCamera()
    {
        echo "魅族相机生产完毕！<br/>";
    }

    public   function MakeScreen()
    {
        echo "魅族屏幕生产完毕！<br/>";
    }
}
header("Content-Type:text/html;charset=utf-8");
$miui=new XiaoMi();
$flyMe=new FlyMe();

$miui->MakeFlow();
$flyMe->MakeFlow();