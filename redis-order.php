<?php
//$redis = new Redis();
//$redis->connect('127.0.0.1',6379);

require 'redis-instance.php';

$redis = RedisInstance::getInstance();

//写日志
function wlog($msg){
	global $redis;
	$redis->lpush('error_list',$msg);	
}
//获取 IP
function ip(){
	return $_SERVER["REMOTE_ADDR"];
}
//产生订单信息
function order(){
	return ['id'=>time().uniqid(),'buy_num'=>1,'sts'=>'0','msg'=>'抢购失败'];
}

$order = order();
//保存用户订单信息，并未真正抢购成功，只是添加初始状态
$redis->lpush('order_init',json_encode($order));

//list pop操作，原子性，依次抛出
$res = $redis->lpop('goods_store');
if(!$res){
	wlog('goods_store sail not!!!'.ip());
	echo 400;
	exit();
}
//抢购成功，更改订单状态
$order['sts']='1';
$order['msg']='抢购成功';
//保存成功操作，并且可以在这针对数据库的减操作
$redis->lpush('order_success',json_encode($order));

