<?php
header('Content-type: text/html; charset=utf-8');
$redis = new Redis();
$redis->connect('127.0.0.1',6379);

$order_init = $redis->llen('order_init');
$order_success = $redis->llen('order_success');

echo '<table><tr><th>订单号</th><th>状态</th></tr>';
for($i=0;$i<$order_init;$i++){
	$_tmpRs = $redis->lget('order_init',$i);
	$_tmpRs = json_decode($_tmpRs,true);	
	echo "<tr><td>{$_tmpRs['id']}</td><td>{$_tmpRs['msg']}</td></tr>";
}
echo '</table>';

echo '<br>成功的订单<br>';

echo '<table><tr><th>订单号</th><th>状态</th></tr>';
for($i=0;$i<$order_success;$i++){
	$_tmpRs = $redis->lget('order_success',$i);
	$_tmpRs = json_decode($_tmpRs,true);	
	echo "<tr><td>{$_tmpRs['id']}</td><td>{$_tmpRs['msg']}</td></tr>";
}
echo '</table>';
