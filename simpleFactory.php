<?php
/**
 * Created by PhpStorm.
 * User: kok
 * Date: 2017/4/1
 * Time: 上午00:11
 */

//简单工厂模式：
//①抽象基类：类中定义抽象一些方法，用以在子类中实现
//②继承自抽象基类的子类：实现基类中的抽象方法
//③工厂类：用以实例化对象
//从生活的角度来理解，就是一个人开了一家汽车商城，要是需要多卖一个东西呢 改起来很麻烦，
//另外一个人呢 则是汽配店 你要买啥 他都能买 调整方便 灵活度更高 看下面的代码


class Calc{
    /**
     * 计算结果
     *
     * @param int|float $num1
     * @param int|float $num2
     * @param string $operator
     * @return int|float
     */
    public function calculate($num1,$num2,$operator){
        try {
            $result=0;
            switch ($operator){
                case '+':
                    $result= $num1+$num2;
                    break;
                case '-':
                    $result= $num1-$num2;
                    break;
                case '*':
                    $result= $num1*$num2;
                    break;
                case '/':
                    if ($num2==0) {
                        throw new Exception("除数不能为0");
                    }
                    $result= $num1/$num2;
                    break;
            }
            return $result;
        }catch (Exception $e){
            echo "您输入有误:".$e->getMessage();
        }
    }
}
$test=new Calc();
//    echo $test->calculate(2,3,'+');//打印:5
echo $test->calculate(5,0,'/');//打印:您输入有误:除数不能为0

//、、想要增加一个“求余”运算，需要在switch语句块中添加一个分支语句

/**
 * 操作类
 * 因为包含有抽象方法，所以类必须声明为抽象类
 */
abstract class Operation{
    //抽象方法不能包含函数体
    abstract public function getValue($num1,$num2);//强烈要求子类必须实现该功能函数
}
/**
 * 加法类
 */
class OperationAdd extends Operation {
    public function getValue($num1,$num2){
        return $num1+$num2;
    }
}
/**
 * 减法类
 */
class OperationSub extends Operation {
    public function getValue($num1,$num2){
        return $num1-$num2;
    }
}
/**
 * 乘法类
 */
class OperationMul extends Operation {
    public function getValue($num1,$num2){
        return $num1*$num2;
    }
}
/**
 * 除法类
 */
class OperationDiv extends Operation {
    public function getValue($num1,$num2){
        try {
            if ($num2==0){
                throw new Exception("除数不能为0");
            }else {
                return $num1/$num2;
            }
        }catch (Exception $e){
            echo "错误信息：".$e->getMessage();
        }
    }
}
//如果需要增加一个方法的话 只要再多一次继承
/*我们只需要另外写一个类（该类继承虚拟基类）,在类中完成相应的功能（比如：求乘方的运算）,而且大大的降低了耦合度，方便日后的维护及扩展

现在还有一个问题未解决,就是如何让程序根据用户输入的操作符实例化相应的对象呢？
解决办法：使用一个单独的类来实现实例化的过程，这个类就是工厂*/
/**
 * 工程类，主要用来创建对象
 * 功能：根据输入的运算符号，工厂就能实例化出合适的对象
 *
 */
class Factory{
    public static function createObj($operate){
        switch ($operate){
            case '+':
                return new OperationAdd();
                break;
            case '-':
                return new OperationSub();
                break;
            case '*':
                return new OperationSub();
                break;
            case '/':
                return new OperationDiv();
                break;
        }
    }
}
$test=Factory::createObj('/');
$result=$test->getValue(23,0);
echo '<br/>';
echo $result;