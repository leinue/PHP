<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>sorting multidimensional arrays</title>
</head>

<body>
<?php
$stu=array(
	256=>array('name'=>'john','grade'=>98.5),
	2=>array('name'=>'tom','grade'=>80),
	9=>array('name'=>'rob','grade'=>94)
);

function name_sort($x,$y){
	return strcasecmp($x['name'], $y['name']);}

function grade_sort($x,$y){
	return ($x['grade']<$y['grade']);}

uasort($stu,'name_sort');
echo 'name_sort'.print_r($stu);

uasort($stu,'grade_sort');
echo 'grade_sort'.print_r($stu);

?>
</body>
</html>