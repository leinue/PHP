<?php

$xml=simplexml_load_file("xmltest.xml");

//print_r($xml->product);
/*
echo $xml->product[0]->size[0];
echo $xml->product[1]->name;*/

$xml->product[0]->name='fuck';

foreach ($xml->product as $key => $product) {
	echo $product->name;
	echo $product->size;
}

?>