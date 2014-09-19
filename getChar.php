<?php

/*
this is a function about get char by char
completed in 2014-9-19
*/

function getChar($str){

	static $pos=0;
	
	if($pos>=strlen($str)){
		return false;
	}

	$chr=substr($str,$pos,1);
	$pos++;
	return $chr;
}

echo getChar('fuck')."<br>";
echo getChar('fuck')."<br>";
echo getChar('fuck')."<br>";
echo getChar('fuck')."<br>";

?>