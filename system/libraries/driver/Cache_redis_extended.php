<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

 class Cache_redis_extended extends CI_Cache_redis
{

    function __construct(){
         parent::self;
}

public function rpush($list, $data)
{
    $push = $this->_redis->multi(Redis::PIPELINE);      
    return $push->rpush($list, json_encode($data));
}

public function lrem($list, $data)
{
    if((is_string($data) && (is_object(json_decode($data)) ||      is_array(json_decode($data))))) {
        $data = $data;
    }else{
        json_encode($data);
    }
    return $this->_redis->lrem($list,-1, $data);
}


public function __destruct()
{
    if ($this->_redis)
    {
        $this->_redis->close();
    }
}
}

?>