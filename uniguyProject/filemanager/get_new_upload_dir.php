<?php
header("Content-Type:text/html;charset=UTF-8");
if(file_exists("new_upload_file.fm")){
	echo file_get_contents("new_upload_file.fm");
	unlink("new_upload_file.fm");
}else{
	echo '-1';
}
?>