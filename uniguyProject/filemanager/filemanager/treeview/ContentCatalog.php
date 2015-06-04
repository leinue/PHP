<?php

error_reporting(E_ALL & ~E_NOTICE);
$dir = '../../source';
 
function recurDir($pathName) {
    $result = array();
    $tmp = array();
    if( !is_dir($pathName) || !is_readable($pathName) ){
        return null;
    }
    $allFiles = scandir($pathName);
    foreach($allFiles as $fileName){
        if( in_array($fileName, array('.', '..')) ) continue;
        $fullName = $pathName . '/' . $fileName;
        if( is_dir($fullName) ){
            $result[$fileName] = recurDir($fullName);
        }else{
            $temp[] = $fileName;
        }
    }
    if($temp){
        foreach( $temp as $f ){
            $result[] = $f;
        }
    }

    //print_r($result);
     
    return $result;
}
 
 
function bl($arr, $l = '-|'){
    static $l = '';
    static $str = '';
    foreach($arr as $key=>$val){
        if(is_array($arr[$key])){
            //echo $val . "<br>";
            //echo $l . $key . "<br>";
            $str .= $l . $key . "<br>";
            $l .= '-|';
            bl($arr[$key], $l);
        }else{
            //echo $l . $val . "<br>";
            $str .= $l . $val . "<br>";
        }
    }
    $l = '';
    return $str;
}
 
$tree = recurDir($dir);
//print_r($tree);
print_r(json_encode($tree));

?>