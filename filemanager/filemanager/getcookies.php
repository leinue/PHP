<?php
#echo '213213';
$callback = $_GET['jsoncallback'];
$PHPSESSID = $_COOKIE['PHPSESSID'];
$last_position = $_COOKE['last_position'];
#echo '{"PHPSESSID":"'.$PHPSESSID.'","last_position":"'.last_position.'"}';
#echo $callback.'('.$json_data.')';
echo "<script>function getc(data){alert(data.PHPSESSID);}</script>";
echo '<script>'.$callback.'({"PHPSESSID":"'.$PHPSESSID.'","last_position":"'.$last_position.'"});</script>';

?>
