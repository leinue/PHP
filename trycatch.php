<?php

class WriteToFile{
	private $fp=NULL;

	function __construct($file){
		if(!file_exists($file) || !is_file($file)){
			throw new Exception('the file does not exist');
		}

		if(!$this->fp=@fopen($file,'w')){
			throw new Exception("Error Processing Request:could not open file");
		}

	}

	function write($data){
		if(@!fwrite($this->fp,$data."\n")){
			throw new Exception("Error Processing Request:could not write to file");
		}
	}

	function close(){
		if($this->fp){
			fclose($this->fp);
			$this->fp=NULL;
		}
	}

	function __destruct(){$this->close;}
}

try {
	$fp=new WriteToFile('data.txt');
	$fp->write('fuck');
	$fp->close();
	unset($fp);
	echo 'success';
} catch (Exception $e) {
	echo $e->getMessage();
}

?>