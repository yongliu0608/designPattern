<?php
/**
 * Created by PhpStorm.
 * User: kok
 * Date: 2017/4/1
 * Time: 下午8:11


下面我们来看看观察者模式是怎么为我们解决这个难题的。

要理解观察者模式，可以结合真实的案例，比如说订阅报纸，仔细想想在这样的场景中存在哪几种元素：

1、报纸的发布者；

2、报纸的订阅者；

发布者与订阅者组成了观察者的两个基本要素。*/

class WeatherData extends Subject{
    private $_temperature;
    private $_pressure;
    private $_humidity;

    /* (non-PHPdoc)
     * @see Subject::notify()
     */
    public function notify() {
        foreach ($this->observers as $observer){
            $observer->update($this->_temperature, $this->_pressure, $this->_humidity);
        }
    }

    public function dataChange($temperature, $pressure, $humidity){
        $this->_temperature = $temperature;
        $this->_pressure = $pressure;
        $this->_humidity = $humidity;

        $this->notify();
    }


}

abstract class Subject{
    protected $observers;
    public function addObserver($key, Equipment $observer){
        $this->observers[$key] = $observer;
    }

    public function removeObserver($key){
        if(isset($this->observers[$key])){
            unset($this->observers[$key]);
        }
    }

    abstract function notify();
//      foreach ($this->observer as $observer){
//          $observer->update();
//      }
}

abstract class Equipment{
    abstract function update($temperature, $pressure, $humidity);
    abstract function display();
}

class Mac extends Equipment{
    private $_temperature;
    private $_pressure;
    private $_humidity;
    /* (non-PHPdoc)
     * @see Equipment::update()
     */
    public function update($temperature, $pressure, $humidity) {
        // TODO Auto-generated method stub
        $this->_temperature = $temperature;
        $this->_pressure = $pressure;
        $this->_humidity = $humidity;

        $this->display();
    }
    /* (non-PHPdoc)
     * @see Equipment::display()
     */
    public function display() {
        // TODO Auto-generated method stub
        echo "Current conditions:<br />  
                temperature:$this->_temperature;<br />  
                pressure:$this->_pressure;<br />  
                humidity:$this->_humidity;<br />  
                    --From Mac client<br />";
    }
}

class Iwatch extends Equipment{
    private $_temperature;
    private $_pressure;
    private $_humidity;
    /* (non-PHPdoc)
     * @see Equipment::update()
     */
    public function update($temperature, $pressure, $humidity) {
        // TODO: Auto-generated method stub
        $this->_temperature = $temperature;
        $this->_pressure = $pressure;
        $this->_humidity = $humidity;

        $this->display();
    }
    /* (non-PHPdoc)
     * @see Equipment::display()
     */
    public function display() {
        // TODO Auto-generated method stub
        echo "Current conditions:<br />  
                temperature:$this->_temperature;<br />  
                pressure:$this->_pressure;<br />  
                humidity:$this->_humidity;<br />  
                    --From Iwatch client<br />";
    }

}

class Iphone extends Equipment{
    private $_temperature;
    private $_pressure;
    private $_humidity;
    /* (non-PHPdoc)
     * @see Equipment::update()
     */
    public function update($temperature, $pressure, $humidity) {
        // TODO Auto-generated method stub
        $this->_temperature = $temperature;
        $this->_pressure = $pressure;
        $this->_humidity = $humidity;

        $this->display();
    }
    /* (non-PHPdoc)
     * @see Equipment::display()
     */
    public function display() {
        // TODO Auto-generated method stub
        echo "Current conditions:<br />  
                temperature:$this->_temperature;<br />  
                pressure:$this->_pressure;<br />  
                humidity:$this->_humidity;<br />  
                    --From Iphone client<br />";
    }



}

$subject = new WeatherData();
$observer1 = new Iwatch();
$observer2 = new Iphone();
$observer3 = new Mac();
$subject->addObserver('Iwatch', $observer1);
$subject->addObserver('Iphone', $observer2);
$subject->addObserver('Mac', $observer3);
$subject->dataChange('38摄氏度', '气压好高啊', '很湿润');

