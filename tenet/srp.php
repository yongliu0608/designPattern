<?php
/**
 * Created by PhpStorm.
 * User: kok
 * Date: 2017/7/26
 * Time: 00:41
 */

//Sunny软件公司开发人员针对某CRM（Customer Relationship  Management，客户关系管理）系统中客户信息图形统计模块提出了如下方案：
//CustomerDataChart类中的方法说明如下：getConnection()方法用于连接数据库，findCustomers()用于查询所有的客户信息，createChart()用于创建图表，displayChart()用于显示图表。
//现使用单一职责原则对其进行重构。
//在图1中，CustomerDataChart类承担了太多的职责，既包含与数据库相关的方法，又包含与图表生成和显示相关的方法。
//如果在其他类中也需要连接数据库或者使用findCustomers()方法查询客户信息，则难以实现代码的重用。
//无论是修改数据库连接方式还是修改图表显示方式都需要修改该类，它不止一个引起它变化的原因，违背了单一职责原则。
//因此需要对该类进行拆分，使其满足单一职责原则，类CustomerDataChart可拆分为如下三个类：

// DBUtil：负责连接数据库，包含数据库连接方法getConnection()；
  //    (2) CustomerDAO：负责操作数据库中的Customer表，包含对Customer表的增删改查等方法，如findCustomers()；
    //  (3) CustomerDataChart：负责图表的生成和显示，包含方法createChart()和displayChart()。

    abstract  class CRM {
          abstract  function getConnection();
          abstract  function findCustomers();
          abstract  function createChart();
          abstract  function displayChart();
    }

    abstract class DBUtil {
        abstract  function getConnection();

    }

    abstract  class  CustomerDAO {
        abstract function findCustomers();
    }

    abstract  class CustomerDataChart {
        abstract function createChart();
        abstract function     displayChart();
    }