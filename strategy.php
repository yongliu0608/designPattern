<?php
/**
 * Created by PhpStorm.
 * User: kok
 * Date: 2017/4/10
 * Time: 23:26
 */
//策略模式 是指程序中设计决策控制的一种模式 策略模式定义一组算法，将每个算法都封装起来，并且使他们之间可以呼唤。
//策略模式使这些算法在客户端调用他们的时候能够互不影响的变化

interface IStrategyOld {
    function  onTheWay();
}

class WorkStrategy implements IStrategyOld {

    function onTheWay()
    {
        // TODO: Implement onTheWay() method.
        echo "walk in the way\n";
    }
}


class RideStrategy implements IStrategyOld {
    function onTheWay()
    {
        // TODO: Implement onTheWay() method.
        echo "在路上骑车";
    }
}

class Context {
    function find($strategy)
    {
        $strategy->onTheWay();
    }
}

$obj = new Context();
$obj->find(new WorkStrategy());
$obj->find(new RideStrategy());
//我们讲述的最后一个设计模式是策略 模式。在此模式中，算法是从复杂类提取的，因而可以方便地替换。例如，如果要更改搜索引擎中排列页的方法，则策略模式是一个不错的选择。思考一下搜索引擎的几个部分 —— 一部分遍历页面，一部分对每页排列，另一部分基于排列的结果排序。在复杂的示例中，这些部分都在同一个类中。通过使用策略模式，您可将排列部分放入另一个类中，以便更改页排列的方式，而不影响搜索引擎的其余代码。
//作为一个较简单的示例，清单 6 显示了一个用户列表类，它提供了一个根据一组即插即用的策略查找一组用户的方法。

interface IStrategy
{
    function filter( $record );
}

class FindAfterStrategy implements IStrategy
{
    private $_name;

    public function __construct( $name )
    {
        $this->_name = $name;
    }

    public function filter( $record )
    {
        return strcmp( $this->_name, $record ) <= 0;
    }
}

class RandomStrategy implements IStrategy
{
    public function filter( $record )
    {
        return rand( 0, 1 ) >= 0.5;
    }
}

class UserList
{
    private $_list = array();

    public function __construct( $names )
    {
        if ( $names != null )
        {
            foreach( $names as $name )
            {
                $this->_list []= $name;
            }
        }
    }

    public function add( $name )
    {
        $this->_list []= $name;
    }

    public function find( $filter )
    {
        $recs = array();
        foreach( $this->_list as $user )
        {
            if ( $filter->filter( $user ) )
                $recs []= $user;
        }
        return $recs;
    }
}

$ul = new UserList( array( "Andy", "Jack", "Lori", "Megan" ) );
$f1 = $ul->find( new FindAfterStrategy( "J" ) );
print_r( $f1 );

$f2 = $ul->find( new RandomStrategy() );
print_r( $f2 );