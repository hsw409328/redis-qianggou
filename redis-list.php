<?php

$redis = new Redis();
$redis->connect('127.0.0.1',6379);
//提前写入商品到队列
for($i=0;$i<10;$i++){
	$redis->lpush('goods_store',1);
}




