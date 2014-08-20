<?php

function handle_open_element($p,$element,$attribute){
	switch ($element) {
		case 'PRODUCT':
			echo '<div>';
			break;
		case 'NAME':
		case 'SEX':
	    	echo '<span class="attr">'.$element.'=</span>';
	    	break;
	}

}

function handle_close_element($p,$element){
	switch ($element) {
		case 'PRODUCT':
			echo '</div>';
			break;
		case 'NAME':
		case 'SEX':
			echo '<br>SIZE=';
			break;
	}
}

function handle_character_data($p,$cdata){echo $cdata;}

$p=xml_parser_create();

xml_set_element_handler($p, 'handle_open_element', 'handle_close_element');
xml_set_character_data_handler($p, 'handle_character_data');

$xmlFile="xmltest.xml";

$fp=@fopen($xmlFile,'r') or die("could not open file $xmlFile");

while ($data=fread($fp, 4096)) {
	xml_parse($p, $data,feof($fp));}

xml_parser_free($p);

?>