<?php

abstract class ShapeFactory{
	static function Create($type,array $size){
		switch ($type) {
			case 'rect':
				return new rect($size[0],$size[1]);
				break;
			case 'tri':
				return new tri($size[0],$size[1],$size[2]);
			    break;
		}
	}
}

$dimension=array();
$dimension[]=1;
$dimension[]=2;

$obj=ShapeFactory::Create('tri',$dimension);

?>