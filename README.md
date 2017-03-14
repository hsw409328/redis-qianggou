# redis-qianggou
高并发抢购 redis 队例实现

本项目只是简单的测试，并且进行实现。

环境：
* PHP7.0
* REDIS  LIST
* NGINGX VHOST
* APACHE AB工具

先在命令行 php redis-list.php 产生货物

在用ab压测或者其它并发测试工具访问redis-order.php

本地测试为：
ab -c 1000 -n 2000 http://qianggou.com/redis-order.php

url访问redis-order-list.php查看结果 

本地测试：http://qianggou.com/redis-order-list.php

真正的抢购可能比这个更复杂，本项目只是提供思路。

*  redis采用的是单例模式
*  订单的存储也在redis
*  可以根据业务需要在pop操作之后进行数据库的操作

官网：www.51hsw.com
