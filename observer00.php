<?php
/**
 * Created by PhpStorm.
 * User: kok
 * Date: 2017/4/1
 * Time: 下午8:19
//场景：一个气象站点，当温度、湿度或气压发生改变时都要像订阅了该气象服务的用户推送提醒，假设用户拥有三种电子产品：mac、iphone和apple watch
//非观察者模式
 * */
class WeatherData{
/**
 * 气温
 * @var string
 */
private $_temperature;
/**
 * 气压
 * @var string
 */
private $_pressure;
/**
 * 湿度
 * @var string
 */
private $_humidity;
/**
 * 用户设备之mac
 * @var object
 */
private $_mac;
/**
 * 用户设备之iphone
 * @var object
 */
private $_iphone;
/**
 * 用户设备之watch（壕啊，咱们做朋友吧。。。）
 * @var object
 */
private $_iwatch;

/**
 * 初始化用户设备
 * @param object $mac
 * @param object $iphone
 * @param object $iwatch
 */
public function __construct($mac, $iphone, $iwatch){
    $this->_mac = $mac;
    $this->_iphone = $iphone;
    $this->_iwatch = $iwatch;
}

/**
 * 当数据变更时向用户推送即时数据
 */
public function dataChanged(){
    $this->_temperature = $this->getTemperature();
    $this->_humidity = $this->getHumidity();
    $this->_pressure = $this->getPressure();

    $this->_mac->update($this->_humidity, $this->_temperature, $this->_pressure);
    $this->_iphone->update($this->_humidity, $this->_temperature, $this->_pressure);
    $this->_iwatch->update($this->_humidity, $this->_temperature, $this->_pressure);
}
}

/*
代码的坏味道：
气象站类WeatherData与用户的设备类mac、iphone、iwatch类之间存在着强耦合关系，而真实的场景中用户可能随时会取消业务，或者为新的电子产品订阅该业务，这就意味着我们今后将会频繁的修改这个文件中的代码。
*/

