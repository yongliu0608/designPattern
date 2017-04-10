<?php
/**
 * Created by PhpStorm.
 * User: kok
 * Date: 2017/4/10
 * Time: 23:40
 * 命令链模式
 * 命令链 模式以松散耦合主题为基础，发送消息、命令和请求，或通过一组处理程序发送任意内容。每个处理程序都会自行判断自己能否处理请求。
 * 如果可以，该请求被处理，进程停止。您可以为系统添加或移除处理程序，而不影响其他处理程序。清单 5 显示了此模式的一个示例。
 */

interface ICommand {
    function onCommand($name, $args);
}

class CommandChain {
    private $_commands = [];
    public function addCommand( $cmd )
    {
        $this->_commands []= $cmd;
    }

    public function runCommand( $name, $args )
    {
        foreach( $this->_commands as $cmd )
        {
            if ( $cmd->onCommand( $name, $args ) )
                return;
        }
    }
}
class UserCommand implements ICommand
{
    public function onCommand( $name, $args )
    {
        if ( $name != 'addUser' ) return false;
        echo( "UserCommand handling 'addUser'\n" );
        return true;
    }
}

class MailCommand implements ICommand
{
    public function onCommand( $name, $args )
    {
        if ( $name != 'mail' ) return false;
        echo( "MailCommand handling 'mail'\n" );
        return true;
    }
}

$cc = new CommandChain();
$cc->addCommand( new UserCommand() );
$cc->addCommand( new MailCommand() );
$cc->runCommand( 'addUser', null );
$cc->runCommand( 'mail', null );