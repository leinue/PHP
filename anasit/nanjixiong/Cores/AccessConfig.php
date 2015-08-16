<?php

namespace Cores;

class AccessConfig{
    
    protected $path;
    protected $wholePath;
    protected $configs = array();

    function __construct($path){
        $this->path = $path;
    }

    function offsetGet($key){
        
        if (empty($this->configs[$key])){

            $this->wholePath = $this->path.'/'.$key.'.php';

            if($this->isConfigExists($this->wholePath)){
	            $config = require $this->wholePath;
	            $this->configs[$key] = $config;
            return $this->configs[$key];
            }else{
            	return false;
            }
        }

        return $this->configs[$key];
    }

    function offsetSet($key, $value){
        $this->offsetGet($key);
        if($this->configs){
        	$this->configs[$key]=$value;
        }
    }

    function offsetExists($key){
        return isset($this->configs[$key]);
    }

    function offsetUnset($key){
        unset($this->configs[$key]);
    }

    function isConfigExists(){
    	return file_exists($this->wholePath);
    }
}
