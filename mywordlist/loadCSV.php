<!DOCTYPE html>
<html lang="zh-cn">
 	<head>
 		<title>xieyang's word list</title>
		<link href="style/load_csv_css.css" rel="stylesheet">
 	</head>
	<body>
<?php

header("Content-Type:text/html;charset=gbk");
//mysql_query("set names utf-8")

echo '<h1>XieYang\'s word list</h1>';

try {
	$fp=fopen("words_list_2014-09-12-10-20-06.csv",'r');
} catch (Exception $e) {
	$e->getMessage();
}

$index=1;

while ($data=fgetcsv($fp)) {
	echo "<div class=\"mainlist\">";
	foreach ($data as $key => $value) {
		if($key==0){
			echo "NO.$index<br>$value<br>";
		}else{
			echo "$value<br>";
		}
	}
	echo "</div>";
	$index++;
}

fclose($fp);

?>
	<body>
</html>