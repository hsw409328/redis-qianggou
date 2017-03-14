<?php
class RedisInstance{

	private static $_instance;

	private static $_connectSource;

	private function __construct(){

	}

	public static function getInstance(){
		if (!(static::$_instance instanceof \Redis)) {
            		static::$_instance = new \Redis();
            		self::getInstance()->connect('127.0.0.1', 6379, 9000);
        	}
       		 return static::$_instance;
	}
     
     /**
     * Redis数据库是否连接成功
     * @return bool|string
     */
    public static function connect()
    {
        // 如果连接资源不存在，则进行资源连接
        if (!self::$_connectSource)
        {
            //@return bool TRUE on success, FALSE on error.
            self::$_connectSource = self::getInstance()->connect('127.0.0.1',6379,9000);
            // 没有资源返回
            if (!self::$_connectSource)
            {
                return 'Redis Server Connection Fail';
            }
        }
        return self::$_connectSource;
    }
}

//RedisInstance::getInstance()->set('test','test');
